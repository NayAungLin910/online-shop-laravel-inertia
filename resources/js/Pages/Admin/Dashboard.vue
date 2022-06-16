<template>
    <Master>
        <template v-slot:header>
            Admin Dashboard
        </template>
        <template v-slot:body>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Category
                        </div>
                        <h4 class="text-center">
                            {{ data.category }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            Product
                        </div>
                        <h4 class="text-center">
                            {{ data.product }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Pending Order
                        </div>
                        <h4 class="text-center">
                            {{ data.pending }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Success Order
                        </div>
                        <h4 class="text-center">
                            {{ data.success }}
                        </h4>
                    </div>
                </div>
            </div>
            <h3>Latest 5 Users</h3>
            <table class="table table-striped">
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                </tr>
                <tr v-for="user in data.users" :key="user.id">
                    <td>
                        {{ user.name }}
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                </tr>
            </table>
        </template>
    </Master>
</template>
<script>
import Master from './Master.vue'
export default {
    name: "Dashboard",
    props: {
        data: Object,
    },
    components: { Master },
}
</script>