<template>
    <v-app class="product-main">
        <div class="category-title">
            <h3>
                Danh mục: {{breadcrumb}}
            </h3>
        </div>
        <v-container class="products">
            <div class= "cant-find">
                <h4 v-if="products.length < 1">Không tìm thấy sản phẩm nào!</h4>
            </div>
            <span class ="box-container" v-for="(product,index) in productsList" :key="index">
                    <v-card style="text-decoration: none" class = "product-box" :href="'/product/' + product._id">
                        <div>
                            <img :src = "baseUrl +'/images/' + product.image">
                        </div>
                        <div class="small-description">
                            <p id="name">{{product.name}}</p>
                            <p id="amount">Còn {{product.amount}} sản phẩm</p>
                            <p id="price">{{Number(product.outportPrice).toLocaleString()}} đ</p>
                        </div>
                    </v-card>
                </span>
            <v-pagination
                class="pagination mb-2" 
                v-model="page" 
                :length="pages"
                @input="updatePage"
            ></v-pagination>
        </v-container>
    </v-app>
</template>

<script>
import { eventBus } from '../../../app';

export default {
    props: {
        category: {
            type: String,
            default: 'all',
            },
        search: {
            type: String,
            default: '',
            },
    },
    data() {
        return{
            baseUrl: window.location.origin,
            products: [],
            category_list: [],
            page: 1,
			pageSize: 30,
            listCount: 0,
           productsList: [],
        }
    },
    beforeMount() {
        axios
        .get("/api/products")
        .then((response) => {
          this.products = response.data.filter(product => {
                    if(this.sameCategory(product))
                    return product.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                });
            this.initPage();
		    this.updatePage(this.page);
        })
        .catch((error) => {
          console.error(error);
        });

        axios
        .get("/api/category")
        .then((response) => {
          this.category_list = response.data;
        })
        .catch((error) => {
          console.error(error);
        });

    },
    created() {
        // Using the event bus
       eventBus.$emit('categorySelected' , this.category);
       //create products pages 
    },
     computed: {
        breadcrumb() {
            if(this.category == 'all'){
            return "Tất cả";
            }else{
                for(var i  = 0; i < this.category_list.length; i++){
                    if(this.category == this.category_list[i]._id){
                        return this.category_list[i].name;
                    }
                } return "Không tồn tại";
            }
        },
        pages() {
			if (this.pageSize == null || this.listCount == null) return 0;
			return Math.ceil(this.listCount / this.pageSize);
		},
     },
     methods: {
        sameCategory(product) {
            if(this.category == 'all'){
                return true;
            }
            else if(this.category == product.category_id) {
                return true;
            }
            else return false;
            },
        initPage() {
			this.listCount = this.products.length;
			if (this.listCount < this.pageSize) {
				this.productsList = this.products;
			} else {
				this.productsList = this.products.slice(0, this.pageSize);
			}
		},
		updatePage(pageIndex) {
			let start = (pageIndex - 1) * this.pageSize;
			let end = pageIndex * this.pageSize;
			this.productsList = this.products.slice(start, end);
			this.page = pageIndex;
		},
     },
}
</script>

<style scoped>
.cant-find{
    margin-top: 5%;
    margin-bottom: 5%;
}
.product-main{
    width: 80%;
    margin: auto;
}
.category-title{
    margin: 0.5em;
    margin-left: 1.5em;
}
.box-container{
    position: relative;
    width: 20%;
    display: inline-block;
}
.product-box{
    margin: 0.15em;
    border: solid 0.04em rgba(128, 128, 128, 0.4);
    background-color: white;
    overflow: hidden;
}
.product-box:active{
   transform:scale(0.95);
   box-shadow: 0.4em 0.4em 0.2em grey;
}
.product-box:hover img{
    -webkit-transform: scale(1.05); 
    transform: scale(1.05);
}
.product-box img{
    transition: all 0.4s;
    height: 10em;
    width: 10em;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.product-box p{
    margin-bottom: -0.2em;
}
.product-box .small-description{
    margin: 1em;
}
.product-box #name{
    color:rgb(100, 100, 100);
    font-size: 90%;
    display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;   
}
.product-box #amount{
    font-size: 75%;
    color:chocolate;
}   
.product-box #price{
    font-size: 115%;
    font-weight: 700;
    color:blue;
    margin-top: 0.2em;
}
</style>