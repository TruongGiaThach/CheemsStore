<template>
	<div class="create-order">
        <div class="product-search-menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" v-for="(cate,index) in category" :key="index">
                                <div v-model:="cate.name">
                                    <a class="dropdown-item" href="#">{{cate.name}}</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                        <form class="form-inline search-box">
                            <input class="form-control mr-sm-2 " type="search" placeholder="Nhập từ khóa cần tìm" aria-label="Search" size="50">
                            <button class="btn btn-outline-success my-2 my-sm-0 cheems-color" type="submit">
                                <i class="fas fa-search fa-lg"></i>
                            </button>
                        </form>
                    </div>
            </nav>
            <div class="products-showcase">
                <span class ="box-container" v-for="(product,index) in products" :key="index" @click="addItemToBill = product">
                    <div class = "product-box">
                        <div v-model:="product.outportPrice">
                            <div class="price">{{product.outportPrice}}</div>
                        </div>
                        <div v-model:="product.image">
                            <img :src = "require('../../../../../../public/images/' + product.image).default">
                        </div>
                        <div v-model:="product.name">
                            <p>{{product.name}}</p>
                        </div>
                    </div>
                </span>
            </div>
        </div><div class="sell-menu">

        </div>

    </div>
</template>
<script>
	export default {
        data(){
            return {
                products : [],
                category : [],
            }
        },
        components : {
        },
        beforeMount(){
            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })

            axios.get('/api/category/')
            .then(response => {
                this.category = response.data
            })
            .catch(error => {
                console.error(error);
            })          
        },
        methods : {
            addItemToBill(){

            },
        }
    }
</script>

<style scoped>
.create-order{
    position: relative;
    height: 100vh
}
.product-search-menu{
    position: relative;
    background-color: white;
    height: 100%;
    width: 60%;
    display: inline-block;
}
.sell-menu{
    position: absolute;
    background-color: blue;
    height: 100%;
    width: 40%;
    display: inline-block;
}
.navbar{
    height: 7%;
}
.products-showcase{
    height: 93%;
    overflow: auto;
}
.box-container{

    position: relative;
    width: 20%;
    display: inline-block;
    
}
.product-box{
    margin: 0.15em;
    border: solid 0.04em rgba(128, 128, 128, 0.4);
    
}
.product-box:active{
   transform:scale(0.95);
   box-shadow: 0.4em 0.4em 0.2em grey;
}
.product-box .price{
    position: absolute;
    right: 0;
    background-color: darkcyan;
    color: white;
    padding-right: 0.2em;
    padding-left: 0.4em;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}
.product-box img{
    height: 9em;
    width: 9em;
}
.product-box p{
    height: 2.87em;
    overflow: hidden;
    color:#d2691e;
    font-weight: bold;
}
</style>