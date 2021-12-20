<template>
    <!--Top Sellers Slider -->
    <div class = "top-sellers-slider">
        <div class="title">
            <h3>Bán chạy trong tháng</h3>
        </div>
        <div class ="slider-tab">
            <div id="carouseBestSeller" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
            <!--Sliders-->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <span class ="box-container" v-for="(product,index) in best1" :key="index">
                            <v-card class = "product-box col-xs-3 col-sm-3 col-md-3" :href="'/product/' + product._id">
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
                    </div>
                    <div class="carousel-item">
                        <span class ="box-container" v-for="(product,index) in best2" :key="index">
                            <v-card class = "product-box col-xs-3 col-sm-3 col-md-3" :href="'/product/' + product._id">
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
                    </div>
                    <div class="carousel-item">
                        <span class ="box-container" v-for="(product,index) in best3" :key="index">
                            <v-card class = "product-box col-xs-3 col-sm-3 col-md-3" :href="'/product/' + product._id">
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
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouseBestSeller" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Trước</span>
                </a>
                <a class="carousel-control-next" href="#carouseBestSeller" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Sau</span>
                </a>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data() {
        return{
            baseUrl: window.location.origin,
            products: [],
            best1: [],
            best2: [],
            best3: [],
        }
    },
    beforeMount() {
        axios
        .get("/api/products")
        .then((response) => {
          this.products = response.data;

          //initialize
          this.best1.push(this.products[0]);
          this.best1.push(this.products[1]);
          this.best1.push(this.products[2]);
          this.best1.push(this.products[3]);

          this.best2.push(this.products[4]);
          this.best2.push(this.products[5]);
          this.best2.push(this.products[6]);
          this.best2.push(this.products[7]);

          this.best3.push(this.products[8]);
          this.best3.push(this.products[11]);
          this.best3.push(this.products[12]);
          this.best3.push(this.products[14]);
        })
        .catch((error) => {
          console.error(error);
        });
    }
}
</script>

<style scoped>
/******************************
*******Top Sellers CSS*********
*******************************/
.top-sellers-slider{
    height: auto;
    background-color: orangered;
    border-radius: 10px;
}
.top-sellers-slider .title{
    padding-left:1em;
}
.top-sellers-slider #carouseBestSeller{
    margin-left:2%;
}
.col-md-3{
  display: inline-block;
  padding-top: 2em;
}
.product-box{
    margin: 0.15em;
    border: solid 0.04em rgba(128, 128, 128, 0.4);
    background-color: white;
    overflow: hidden;
    text-decoration: none;
    width: 24%;
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