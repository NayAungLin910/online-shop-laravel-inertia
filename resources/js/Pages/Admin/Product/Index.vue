<template>
    <Master>
        <template v-slot:header>
            All Products
        </template>
        <template v-slot:body>
            <inertia-link href="/admin/product/create" class="btn btn-sm btn-primary">
                Create
            </inertia-link>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in products.data" :key="c.id">
                        <td>
                            <img :src="`/${c.image}`" width="70" style="border-radius:20%" alt="">
                        </td>
                        <td>{{ c.name  }}</td>
                        <td>{{ c.price }}</td>
                        <td>
                            <inertia-link
                              :href="`/admin/product/${c.id}/edit`" 
                              class="btn btn-sm btn-primary"
                            >
                                Edit
                            </inertia-link>
                            <inertia-link
                              class="btn btn-sm btn-success"
                              :href="`/admin/product/${c.id}`"
                            >
                                Detail
                            </inertia-link>
                            <span @click="destroy(c.id)" class="btn btn-sm btn-danger">Delete</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data="products.links" />
        </template>
    </Master>
</template>
<script>
import Master from '../Master.vue';
import Pagination from '../Share/Pagination.vue';
export default {
    name: "Index",
    components: { Master, Pagination },
    props: {
        products: Object,
    },
    methods: {
        destroy(id){
            if(confirm('Are you share about deleting?')){
                const data = { id, _method: "DELETE" };
                this.$inertia.delete("/admin/product/" + id, data);
            }
        }
    }
}
</script>