<template>
    <Master>
        <form @submit.prevent="checkout">
            <div class="form-group">
                <label for="">Enter Your Phone</label>
                <input 
                  type="number" 
                  class="form-control border"
                  :class="{ 'border-danger': errors.phone }" 
                  v-model="phone"
                >
                <small 
                     class="text text-danger"
                     v-show="errors.phone"
                     >{{ errors.phone }}
                </small>
            </div>
            <div class="form-group">
                <label for="">Enter Your Address</label>
                <input 
                  type="text" 
                  class="form-control border"
                  :class="{ 'border-danger': errors.address }"  
                  v-model="address"
                >
                <small 
                     class="text text-danger"
                     v-show="errors.address"
                     >{{ errors.address }}
                </small>
            </div>
            <button 
                  :disabled="loading"
                  type="submit" 
                  class="btn btn-primary">
                    Check Out
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
    name: "CheckOut",
    components: { Master },
    props: {
        errors: Object,
    },
    data(){
        return{
            phone: "",
            address: "",
            loading: false,
        }
    },
    methods: {
        checkout(){
            const data = {
                phone: this.phone, 
                address: this.address,
            }
            this.$inertia.post("/checkout", data, {
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