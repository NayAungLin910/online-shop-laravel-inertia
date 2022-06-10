<template>
    <div class="row">
        <div class="col-md-4 offset-4">
            <div class="card">
                <div class="card-header">
                    <h3>Login Form</h3  >
                </div>
                <div class="card-body">
                    <form @submit.prevent="login">
                        <div class="form-group">
                            <label for="">Enter Email</label>
                            <input v-model="email" type="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="">Enter Password</label>
                            <input v-model="password" type="password" class="form-control" />
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
            
        </div>
    </div>
</template>
<script>
export default {
    name: "Login",
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
            }
            this.$inertia.post('/admin/login', data, {
                onStart: () => {
                    this.loading = true;
                },
                onFinish: () => {
                    this.loading = false;  
                }
            });
        }
    },
    watch: {
            '$page.props.success': function(value){
                    this.$toast.success(value, {
                            position: "top-right",
                            duration: 2000,
                    })
            },
            '$page.props.info': function(value){
                    this.$toast.info(value, {
                            position: "top-right",
                            duration: 2000,
                    })
            },
            '$page.props.error': function(value){
                    this.$toast.error(value, {
                            position: "top-right",
                            duration: 2000,
                    })
            }
    }
}
</script>