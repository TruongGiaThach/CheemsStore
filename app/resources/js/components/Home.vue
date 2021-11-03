<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Welcome to the CheemsStore</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" v-if="products.length > 0">
                            <div class="col-md-4, product-box" 
                                v-for="(product,index) in products" :key = "index">
                                <router-link :to="{ path: '/products/' + product.id}">
                                    <img :src="product.image" :alt="product.name">
                                    <h5>
                                        <span v-html="product.name"></span>
                                        <span class="small-text text-muted float-right" >$ {{product.price}}</span>
                                    </h5>
                                    <button class="col-md-4 btn btn-sm btn-primary float-right ">Buy Now</button>
                                </router-link>
                            </div>
                        </div>
                        <div class="row" v-else> There are some errors when loading data. Please reload</div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return {
                products : []
            }
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)      
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #3f3f3f;
        padding: 10px 15px;
        width: 300;
        height: 500;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>