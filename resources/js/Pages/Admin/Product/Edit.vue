<template>
    <Master>
        <template v-slot:header>
            Update Category
        </template>
        <template v-slot:body>
            <inertia-link href="/admin/category" class="btn btn-sm btn-dark">
                Back
            </inertia-link>
            <form @submit.prevent="update">
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
                    Update
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
    name: "edit-category",
    components: { Master },
    props: {
        errors: Object,
        cat: Object,
    },
    data(){
        return{
            name: "",
            loading: false,
        }
    },
    created(){
        this.name = this.cat.name;
    },
    methods: {
        update(){
            this.loading = true;  
            setTimeout(() => {
                if(this.errors){
                    this.loading = false;
                }
            }, 500);
            this.$inertia.put('/admin/category/' + this.cat.id, { name:this.name, _method: "PUT" }, {
                onSuccess:() => {
                    this.loading = false;
                },
            });
        }
    },
}
</script>