<template>
    <div class="container">
                <div class="row">
                        <div class="col-md-4">
                                <div class="card">
                                        <div class="card-body">
                                                <ul class="list-group">
                                                        <a>
                                                                <li class="list-group-item bg-primary text-white">
                                                                        Admin Management
                                                                </li>
                                                        </a>
                                                        <a>
                                                                <li class="list-group-item">
                                                                        Category
                                                                </li>
                                                        </a>
                                                        <a>
                                                                <li class="list-group-item">
                                                                        Product
                                                                </li>
                                                        </a>
                                                        <a>
                                                                <li class="list-group-item">
                                                                        Order
                                                                </li>
                                                        </a>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-8">
                                <div class="card">
                                        <div class="card-header bg-primary">
                                            <slot name="header"/>
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
}
</script>
