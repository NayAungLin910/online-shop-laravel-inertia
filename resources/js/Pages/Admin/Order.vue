<template>
    <Master>
        <template v-slot:header>
            <span v-show="!isSuccess">
                Pending Order
            </span>
            <span v-show="isSuccess">
                Completed Order
            </span>
        </template>
        <template v-slot:body>
            <form class="form-row">
                <div class="form-group">
                    <label for="">From</label>
                    <input 
                      type="date"
                      class="form-control"
                      v-model="start_date"
                    >
                </div>
                <div class="form-group">
                    <label for="">To</label>
                    <input 
                      type="date"
                      class="form-control"
                      v-model="end_date"
                    >
                </div>
            </form>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Product</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in order.data" :key="c.id">
                        <td>{{ c.user.name  }}</td>
                        <td>
                            {{ c.product.name }}
                        </td>
                        <td>
                            {{ c.phone }}
                        </td>
                        <td>
                            {{ c.address }}
                        </td>
                        <td>
                            <inertia-link 
                              :href="`/admin/order/success/${c.id}`" 
                              class="btn btn-sm btn-primary"
                              v-show="!isSuccess && !isSearchByDate"
                            >
                              Complete
                            </inertia-link>
                            <inertia-link 
                              :href="`/admin/order/success/${start_date}/${end_date}/${c.id}`" 
                              class="btn btn-sm btn-primary"
                              v-show="!isSuccess && isSearchByDate"
                            >
                              Complete
                            </inertia-link>
                            <span
                              v-show="isSuccess"
                              style="color:rgba(51, 51, 49, 0.3)"
                            >
                                No option
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data="order.links" />
        </template>
    </Master>
</template>
<script>
import Master from './Master.vue';
import Pagination from './Share/Pagination.vue';
export default {
    name: "Order",
    components: { Master, Pagination },
    props: {
        order: Object,
        start_date: String,
        end_date: String,   
    },
    data(){
        return{
            start_date: this.$page.props.start_date,
            end_date: this.$page.props.end_date,
        }
    },
    computed: {
        isSuccess(){
                if(location.pathname == "/admin/order/success" || location.pathname.includes("/admin/order/success")){
                        return true;  
                }else{
                        return false;
                }
        },
        isSearchByDate(){
            if(this.start_date && this.end_date){
                return true;
            }else{
                return false;
            }
        },
    },
    watch: {
        "start_date": function(newDate){
            if(this.end_date !== "" && !this.isSuccess){
                this.$inertia.get(`/admin/order/pending/${this.start_date}/${this.end_date}`);
            }
            if(this.end_date !== "" && this.isSuccess){
                this.$inertia.get(`/admin/order/success/${this.start_date}/${this.end_date}`);
            }
        },
        "end_date": function(newData){
            if(this.start_date !== "" &&!this.isSuccess){
                this.$inertia.get(`/admin/order/pending/${this.start_date}/${this.end_date}`);
            }
            if(this.start_date !== "" && this.isSuccess){
                this.$inertia.get(`/admin/order/success/${this.start_date}/${this.end_date}`);
            }
        }
    }
}
</script>