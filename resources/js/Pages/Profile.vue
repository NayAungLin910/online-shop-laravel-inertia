<template>
    <Master>
        <form @submit.prevent="changeProfile">
            <div class="form-group">
                <label for="">Name</label>
                <input 
                  type="text" 
                  class="form-control border"
                  :class="{ 'border-danger': errors.name }" 
                  v-model="name"
                >
                <small 
                     class="text text-danger"
                     v-show="errors.name"
                     >{{ errors.name }}
                </small>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input 
                  type="email" 
                  class="form-control border"
                  :class="{ 'border-danger': errors.email }"  
                  v-model="email"
                >
                <small 
                     class="text text-danger"
                     v-show="errors.email"
                     >{{ errors.email }}
                </small>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input 
                  type="text" 
                  class="form-control border"
                  :class="{ 'border-danger': errors.password }"  
                  v-model="password"
                >
                <small 
                     class="text text-danger"
                     v-show="errors.password"
                     >{{ errors.password }}
                </small>
            </div>
            <button 
                  :disabled="loading"
                  type="submit" 
                  class="btn btn-primary">
                    Update
                    <div
                      v-show="loading"  
                      class="spinner-grow spinner-grow-sm" 
                      role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
            </button>
        </form>
    </Master>
</template>
<script>
import Master from './Layout/Master.vue'
export default {
    name: "Profile",
    components: { Master },
    props: {
        errors: Object,
    },
    data(){
        return{
            name: "",
            email: "",
            password: "",
            loading: false,
        }
    },
    created(){
        const { name, email} = this.$page.props.auth;
        this.name = name;
        this.email = email;
    },
    methods: {
        changeProfile(){
            const data = {
                name: this.name, 
                address: this.address,
            }
            this.$inertia.post("/profile", data, {
                onStart: () => {
                    this.loading = true;
                },
                onFinish:() => {
                    this.loading = false;
                },
                onSuccess:() => {
                    this.phone = "";
                    this.address = "";
                    this.loading = false;
                }
            });
        }
    }
}
</script>