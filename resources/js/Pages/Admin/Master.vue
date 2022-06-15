<template>
    <div class="container">
                <div class="row">
                        <div class="col-md-3">
                                <div class="card">
                                        <div class="card-body">
                                                <ul class="list-group">
                                                        <a>
                                                                <li class="list-group-item bg-primary text-white">
                                                                        Admin Management
                                                                </li>
                                                        </a>
                                                        <inertia-link href="/admin/category">
                                                                <li class="list-group-item">
                                                                        Category
                                                                </li>
                                                        </inertia-link>
                                                        <inertia-link href="/admin/product">
                                                                <li class="list-group-item">
                                                                        Product
                                                                </li>
                                                        </inertia-link>
                                                        <inertia-link :href="`/admin/order/pending`">
                                                                <li class="list-group-item">
                                                                        Pending Order
                                                                </li>
                                                        </inertia-link>
                                                        <inertia-link :href="`/admin/order/success`">
                                                                <li class="list-group-item">
                                                                        Completed Order
                                                                </li>
                                                        </inertia-link> 
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-9">
                                <div class="card">
                                        <div class="card-header bg-primary">
                                                <h3 class="text-white">
                                                        <slot name="header"/>
                                                </h3>
                                        </div>
                                        <div class="card-body">
                                            <slot name="body"/>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</template>
<script>
export default {
    name: "Master",
    created(){
        const {successC, infoC, errorC} = this.$page.props;

        if(successC){
                this.$toast.success(successC, {
                        position: "top-right",
                        duration: 2500,
                });
        }
        if(infoC){
                this.$toast.info(infoC, {
                        position: "top-right",
                        duration: 2500,
                });
        }
        if(errorC){
                this.$toast.error(errorC, {
                        position: "top-right",
                        duration: 2500,
                });
        }
    },
    watch: {
            '$page.props.success': function(value){
                    this.$toast.success(value, {
                            position: "top-right",
                            duration: 2500,
                    })
            },
            '$page.props.info': function(value){
                    this.$toast.info(value, {
                            position: "top-right",
                            duration: 2500,
                    })
            },
            '$page.props.error': function(value){
                    this.$toast.error(value, {
                            position: "top-right",
                            duration: 2500,
                    })
            }
    },
}
</script>
