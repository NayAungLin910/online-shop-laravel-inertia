<template>
    <Master>
        <h2 v-show="isCompleteRoute">Completed Order List</h2>
        <h2 v-show="!isCompleteRoute">Pending Order List</h2>
                                                <table class="table table-striped">
                                                        <thead>
                                                                <tr>
                                                                        <th>Name</th>
                                                                        <th>Image</th>
                                                                        <th>Total</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                <tr v-for="c in order.data" :key="c.id">
                                                                        <td>{{ c.product.name }}</td>
                                                                        <td>
                                                                                <img :src="`/${c.product.image}`"
                                                                                        style="width:50px;border-radius:30%"
                                                                                        alt="">
                                                                        </td>
                                                                        <td>{{ c.qty }}</td>
                                                                </tr>
                                                        </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <Pagination :data="order.links" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <inertia-link href="/checkout" class="btn btn-sm btn-primary">Check Out</inertia-link>
                                                    </div>
                                                </div>
    </Master>
</template>
<script>
import Master from './Layout/Master.vue'
import Pagination from './Admin/Share/Pagination.vue'
export default {
    name: "OrderList",
    components: { Master, Pagination },
    props: {
        order: Object,
    },
    computed: {
        isCompleteRoute(){
            const conRoute = location.pathname;
            if(conRoute == "/order/complete"){
                return true;
            }else{
                return false;
            }
        }
    }
}
</script>