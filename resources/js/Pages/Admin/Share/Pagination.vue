<template>
    <nav>
  <ul class="pagination justify-content-center">
    <li class="page-item" v-for="(d, index) in data" :key="index" :class="{'disabled': d.url == null, active: d.active}">
        <!--For Previous-->
        <inertia-link class="page-link" :href="d.url" v-show="index == 0">
            <i class="fa fa-angle-left"></i>
            <span class="sr-only">Right</span>
        </inertia-link>
        <inertia-link 
          class="page-link" 
          :href="d.url" 
          v-show="index !== 0 && index !== data.length - 1"
        >
            {{ d.label }}
        </inertia-link>

        <!--For Next-->
        <inertia-link class="page-link" :href="d.url" v-show="index == data.length - 1">
            <i class="fa fa-angle-right"></i>
            <span class="sr-only">Next</span>
        </inertia-link>
    </li>
  </ul>
</nav>
</template>
<script>
export default {
    name: "Pagination",
    props: {
        data: Array,
    },
}
</script>