<template>
    <Master>
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text text-white">
                    Login
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="errors.errors">
                    {{ errors.errors }}
                </div>
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="">
                            Enter Your Email
                        </label>
                        <input 
                          type="email" 
                          v-model="email" 
                          class="form-control border"
                          :class="{ 'border-danger': errors.email }"
                        >
                        <small 
                           class="text text-danger"
                           v-show="errors.email"
                        >
                            {{ errors.email }}
                        </small>
                    </div>
                    <div class="form-group border">
                        <label for="">
                            Enter Password
                        </label>
                        <input 
                          type="password" 
                          v-model="password" 
                          class="form-control border"
                          :class="{ 'border-danger': errors.password }"
                        >
                        <small 
                           class="text text-danger"
                           v-show="errors.password"
                        >
                            {{ errors.password }}
                        </small>
                    </div>
                    <button 
                      :disabled="loading"
                      type="submit" 
                      class="btn btn-primary"
                    >
                        Login
                        <div
                          v-show="loading"  
                          class="spinner-grow spinner-grow-sm" 
                          role="status"
                        >
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
        
    </Master>
</template>
<script>
import Master from '../Layout/Master.vue';
export default {
    name: "Login",
    components: { Master },
    props: {
        errors: Object,
    },
    data(){
        return{
            email: "",
            password: "",
            loading: false,
        }
    },
    methods: {
        login(){
            const data = {
                email: this.email,
                password: this.password,
            };
            this.$inertia.post("/login", data, {
                onStart: () => {
                    this.loading = true;
                },
                onFinish: () => {
                    this.loading = false;
                }
            });
        }
    },
    computed: {
    }
}
</script>