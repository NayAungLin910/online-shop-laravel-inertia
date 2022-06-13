<template>
    <div>
        <!-- Header -->
        <div class="container-fluid" id="header">
                <nav class="navbar navbar-expand-lg">
                        <inertia-link class="navbar-brand text-white" :href="`/`">MM-Shop</inertia-link>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                                <a class="nav-link" href="">Home </a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link" href="#">Your Order</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        User
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <div v-if="$page.props.auth == null">
                                                                <inertia-link class="dropdown-item" :href="`/login`">Login</inertia-link>
                                                                <inertia-link class="dropdown-item" :href="`/register`">Register</inertia-link>
                                                        </div>
                                                        <div v-if="$page.props.auth !== null">
                                                                <a class="dropdown-item" href="#">Welcome {{ $page.props.auth.name }}</a>
                                                                <inertia-link class="dropdown-item" :href="`/logout`">Logout</inertia-link>
                                                        </div>
                                                       
                                                </div>
                                        </li>
                                        <li class="nav-item">
                                                <inertia-link class="nav-link " :href="`/cart`">
                                                        Cart
                                                        <small class="badge badge-danger">
                                                                {{ $page.props.cart_count }}
                                                        </small>
                                                </inertia-link>
                                        </li>
                                </ul>
                                <form class="form-inline" @submit.prevent="searchProduct">
                                        <input 
                                          class="form-control mr-sm-2" 
                                          type="search" 
                                          v-model="search"
                                          placeholder="Search"
                                          aria-label="Search"
                                        >
                                        <button class="btn btn-primary" type="submit">Search</button>
                                </form>
                        </div>
                </nav>
                <div class="container mt-1">
                        <div class="row">
                                <div class="col-md-6">
                                        <h1>Welcome From MM-Coder Shopping Website</h1>
                                        <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium
                                                sequi voluptas similique sed minima rerum labore reprehenderit, illo
                                                recusandae quasi tempore placeat aliquam autem, a soluta nisi totam
                                                temporibus dolorem!
                                        </p>
                                        <div v-if="$page.props.auth == null">
                                                <inertia-link :href="`/register`" class="btn btn-outline-primary">Register</inertia-link>
                                                <inertia-link :href="`/login`" class="btn btn-primary">Login</inertia-link>
                                        </div>
                                        <h1 v-if="$page.props.auth !== null">Welcome {{ $page.props.auth.name }}</h1>
                                </div>
                                <div class="col-md-6 text-center">
                                        <img class=""
                                                src="https://wp.xpeedstudio.com/seocify/home-fifteen/wp-content/uploads/sites/27/2020/03/home17-banner-image-min.png"
                                                alt="">
                                </div>
                        </div>
                </div>
        </div>
        <!-- End Header -->
        <div class="container mt-3">
                <div class="row">
                        <!-- For Category and Information -->
                        <div class="col-md-4">
                                <div class="card">
                                        <div class="card-body">
                                                <ul class="list-group">
                                                        <li class="list-group-item bg-dark text-white">
                                                                Your Order List
                                                        </li>
                                                        <li class="list-group-item bg-danger text-white">
                                                                Your Profile Info
                                                        </li>
                                                </ul>
                                        </div>
                                </div>
                                <div class="card">
                                        <div class="card-body">
                                                <ul class="list-group">
                                                        <li class="list-group-item bg-primary text-white">
                                                                All Category

                                                        </li>
                                                        <inertia-link :href="`/`">
                                                                <li class="list-group-item">
                                                                       All
                                                                </li>
                                                        </inertia-link>
                                                        <inertia-link :href="`/product/category/${c.slug}`" v-for="c in $page.props.category" :key="c.id">
                                                                <li class="list-group-item">
                                                                        {{ c.name }}
                                                                        <span class="badge badge-primary float-right">{{ c.product_count }}</span>
                                                                </li>
                                                        </inertia-link>
                                                        
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-8">
                                <div class="card">
                                        <div class="card-body">
                                                <slot />
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Master",
    data(){
        return{
                search: "",
                shown: false,
        }
    },
    created(){
        if(this.$page.props.success){
                this.$toast.success(this.$page.props.success, {
                        position: "top-right",
                        duration: 2000,
                });
        }
        if(this.$page.props.info){
                this.$toast.info(this.$page.props.info, {
                        position: "top-right",
                        duration: 2000,
                });
        }
        if(this.$page.props.error){
                this.$toast.error(this.$page.props.error, {
                        position: "top-right",
                        duration: 2000,
                });
        }
    },
    methods: {
        searchProduct(){
                if(this.search){
                        this.$inertia.get("/product/search/" + this.search);
                }
        }
    },
    watch: {
            '$page.props.success': function(value){
                    this.$toast.success(value, {
                            position: "top-right",
                            duration: 2000,
                    })
            },
            '$page.props.info': function(value){
                    this.$toast.info(value, {
                            position: "top-right",
                            duration: 2000,
                    })
            },
            '$page.props.error': function(value){
                    this.$toast.error(value, {
                            position: "top-right",
                            duration: 2000,
                    })
            }
    } // it is not required since the creation alone can handle redirect()->back() sesssoin flusing
}
</script>