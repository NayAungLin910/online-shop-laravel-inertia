<template>
    <Master>
        <template v-slot:header>
            Create Category
        </template>
        <template v-slot:body>
            <inertia-link href="/admin/category" class="btn btn-sm btn-dark">
                Back
            </inertia-link>
            <form @submit.prevent="store">
                <div class="form-group">
                    <label for="">Enter Name</label>
                    <input
                      type="text" 
                      v-model="name" 
                      class="form-control border"
                      :class="{ 'border-danger': errors.name }"  />
                    <small 
                     class="text text-danger"
                     v-show="errors.name"
                     >{{ errors.name }}</small>
                </div>
                <button 
                  :disabled="loading"
                  type="submit" 
                  class="btn btn-primary">
                    Create
                    <div
                      v-show="loading"  
                      class="spinner-grow spinner-grow-sm" 
                      role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </form>
        </template>
    </Master>
</template>
<script>
import Master from '../Master.vue'
export default {
    name: "create-category",
    components: { Master },
    props: {
        errors: Object,
    },
    data(){
        return{
            name: "",
            loading: false,
        }
    },
    methods: {
        store(){
            this.loading = true;    
            this.$inertia.post('/admin/category', {name:this.name}, {
                onSuccess:() => {
                    this.name = "";
                    this.loading = false;
                },
            });
        }
    }
}
</script>