<template>
    <Master>
        <template v-slot:header>
            Product Detail
        </template>
        <template v-slot:body>
            <inertia-link :href="`/admin/product`" class="btn btn-sm btn-dark">Back</inertia-link>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>View Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ product.category.name }}</td>
                        <td>{{ product.name }}</td>
                        <td>
                            <img :src="`/${product.image}`" width="70" style="border-radius:20%" alt="">
                        </td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.view_count }}</td>
                    </tr>
                </tbody>
            </table>
            <p>
                {{ product.description }}
            </p>
        </template>
    </Master>
</template>
<script>
import Master from '../Master.vue'
export default {
    name: "Detail",
    components: { Master },
    props: {
        product: Object,
    }
}
</script>