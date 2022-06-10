<template>
    <Master>
        <template v-slot:header>
            Admin Dashboard
        </template>
        <template v-slot:body>
            <h1>Dashboard</h1>
        </template>
    </Master>
</template>
<script>
import Master from './Master.vue'
export default {
    name: "Dashboard",
    components: { Master },
}
</script>