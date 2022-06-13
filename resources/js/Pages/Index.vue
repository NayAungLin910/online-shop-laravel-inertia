<template>
    <Master>
        <div class="row">
                                                        <!-- Loop Product -->
                                                        <div class="col-md-4" v-for="p in product.data" :key="p.id">
                                                                <inertia-link :href="`/product/${p.slug}`">
                                                                        <div class="card">
                                                                                <img class="card-img-top"
                                                                                        :src="`/${p.image}`"
                                                                                        alt="">
                                                                                <div class="card-body">
                                                                                        <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                        <h4>
                                                                                                            {{ p.name }}
                                                                                                        </h4>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                                <div class="col-md-4">
                                                                                                        <a href=""
                                                                                                                class="badge badge-primary"
                                                                                                        >
                                                                                                            {{ p.price }}
                                                                                                        </a>
                                                                                                </div>
                                                                                                <div class="col-md-8">
                                                                                                        <a href=""
                                                                                                                class="badge badge-warning">
                                                                                                            {{ p.category.name }}
                                                                                                        </a>
                                                                                                        <inertia-link :href="`add/cart/${p.id}`" class="float-right">
                                                                                                                <i class="fas fa-shopping-cart text-danger"></i>
                                                                                                        </inertia-link>
                                                                                                </div>
                                                                                        </div>


                                                                                </div>
                                                                        </div>
                                                                </inertia-link>

                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6 offset-3">
                                                            <Pagination :data="product.links" />
                                                        </div>
                                                </div>
    </Master>
</template>
<script>
import Master from './Layout/Master.vue';
import Pagination from './Admin/Share/Pagination.vue';
export default {
    name: "Index",
    components: { Master, Pagination },
    props: {
        product: Object,
    }
}
</script>