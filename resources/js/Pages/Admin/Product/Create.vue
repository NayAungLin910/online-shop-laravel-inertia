<template>
    <Master>
        <template v-slot:header>
            Create Product
        </template>
        <template v-slot:body>
            <inertia-link href="/admin/product" class="btn btn-sm btn-dark">
                Back
            </inertia-link>
            <form @submit.prevent="store" enctype="multipart/form-data">
                <!--Category ID-->
                <div class="form-group">
                    <label for="">Choose Category</label>
                    <select
                      v-model="category_id" 
                      class="form-control border" 
                      :class="{ 'border-danger': errors.category_id }">
                        <option v-for="c in cat" :value="c.id" :key="c.id">
                            {{ c.name  }}
                        </option>
                    </select>
                    <small 
                     class="text text-danger"
                     v-show="errors.category_id"
                     >{{ errors.category_id }}</small>
                </div>
                <!--Name-->
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
                <!--Price-->
                <div class="form-group">
                    <label for="">Enter Price</label>
                    <input
                      type="number" 
                      v-model="price" 
                      class="form-control border"
                      :class="{ 'border-danger': errors.price }"  />
                    <small 
                     class="text text-danger"
                     v-show="errors.price"
                     >{{ errors.price }}</small>
                </div>
                <!--Image-->
                <div class="form-group">
                    <label for="">Choose Image</label>
                    <input
                      type="file" 
                      @change="chooseImage"
                      class="form-control border"
                      :class="{ 'border-danger': errors.image }"  />
                    <small 
                     class="text text-danger"
                     v-show="errors.image"
                     >{{ errors.image }}</small>
                </div>
                <!--Description-->
                <div class="form-group">
                    <label for="">Enter Description</label>
                    <textarea 
                      v-model="description" 
                      class="form-control border"
                      :class="{ 'border-danger': errors.description }">
                    </textarea>
                    <small 
                     class="text text-danger"
                     v-show="errors.description"
                     >{{ errors.description }}</small>
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
    name: "create-product",
    components: { Master },
    props: {
        errors: Object,
        cat: Array,
    },
    data(){
        return{
            category_id: "",
            name: "",
            image: "",
            description: "",
            price: "",
            loading: false,
        }
    },
    methods: {
        chooseImage(e){
            this.image = e.target.files[0];
        },
        store(){
            this.loading = true;
            const data = new FormData();
            data.append('name', this.name);
            data.append('category_id', this.category_id);
            data.append('image', this.image);
            data.append('price', this.price);
            data.append('description', this.description);
            setTimeout(() => {
                if(this.errors){
                    this.loading = false;
                }
            }, 500);
            this.$inertia.post('/admin/product', data, {
                onSuccess:() => {
                    this.name = "";
                    this.category_id = "";
                    this.image = "";
                    this.price = "";
                    this.description = "";
                    this.loading = false;
                },
            });
        }
    },
}
</script>