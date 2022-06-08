<template>
    <Master>
        <template v-slot:header>
            All categories
        </template>
        <template v-slot:body>
            <inertia-link href="/admin/category/create" class="btn btn-sm btn-primary">
                Create
            </inertia-link>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in cat.data" :key="c.id">
                        <td>{{ c.name  }}</td>
                        <td>
                            <inertia-link class="btn btn-sm btn-primary">Update</inertia-link>
                            <span @click="destroy(c.id)" class="btn btn-sm btn-danger">Delete</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data="cat.links" />
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
        cat: Object,
    },
    methods: {
        destroy(id){
            if(confirm('Are you share about deleting?')){
                const data = { id, _method: "DELETE" };
                this.$inertia.delete("/admin/category/" + id, data);
            }
        }
    }
}
</script>