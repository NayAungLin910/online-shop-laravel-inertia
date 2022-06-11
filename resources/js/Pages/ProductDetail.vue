<template>
    <Master>
        <div class="row">
                                                        <div class="col-md-12">
                                                            <inertia-link class="btn btn-sm btn-dark" :href="`/`">Back</inertia-link>
                                                                <h1>
                                                                    {{ product.name }}
                                                                </h1>
                                                        </div>
                                                </div>

                                                <div class="card">
                                                        <div class="card-body">
                                                                <div class="row">
                                                                        <div class="col-md-4">
                                                                                <a href=""
                                                                                        class="btn btn-primary rounded">
                                                                                        <i
                                                                                                class="fas fa-cart-arrow-down"></i>
                                                                                        <span class="badge badge-secondary">{{ product.price }}</span>
                                                                                </a>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                <small>
                                                                                        <i class="fas fa-eye"></i>
                                                                                        {{ product.view_count }}
                                                                                </small>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                <a href=""
                                                                                        class="badge badge-primary">
                                                                                        {{ product.category.name }}
                                                                                </a>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="row text-center">
                                                        <div class="col-md-12">
                                                                <img :src="`/${product.image}`" class="w-30" salt="">
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-12">
                                                                <p>
                                                                        {{ product.description }}
                                                                </p>
                                                        </div>
                                                </div>
    </Master>
</template>
<script>
import Master from './Layout/Master.vue'
export default {
    name: "ProductDetail",
    components: { Master },
    props: {
        product: Object,
    }
}
</script>