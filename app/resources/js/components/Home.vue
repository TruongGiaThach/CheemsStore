<template>
        <div>
        <!--Carousel Slider -->
        <div id="carouselControls" class="carousel slide" data-ride="carousel">
                <!--Slider indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselControls" data-slide-to="0" class="active"></li>
                <li data-target="#carouselControls" data-slide-to="1"></li>
                <li data-target="#carouselControls" data-slide-to="2"></li>
            </ol>
            <!--Sliders-->
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img :src="require('../../images/home/sliders/1.webp').default" class="d-block w-120" alt="...">
                </div>
                <div class="carousel-item">
                <img :src="require('../../images/home/sliders/2.webp').default" class="d-block w-120" alt="...">
                </div>
                <div class="carousel-item">
                <img :src="require('../../images/home/sliders/3.webp').default" class="d-block w-120" alt="...">
                </div>
            </div>
        </div>


            <!--Product category sidebar -->
            <div class = "overlap">
                <div class = "category-menu-area">
                    <div class = "side-menu">
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-washing-machine-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Điện máy - Điện gia dụng
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-laptop-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Laptop - Macbook
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-tv-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Tv - Màn hình Tv
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-touchscreen-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Điện thoại & Thiết bị thông minh
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-workstation-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Pc - Máy tính đồng bộ
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-monitor-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Màn hình máy tính
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-electronics-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Linh kiện máy tính
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-game-controller-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        High - End Gaming
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-computer-mouse-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Phụ kiện & Thiết bị ngoại vi
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-subwoofer-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Thiết bị âm thanh
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-camera-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Máy ảnh - Máy quay phim
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-print-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Thiết bị văn phòng
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-wi-fi-lock-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Thiết bị mạng - An ninh
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="side-menu-section">
                            <table>
                                <a href="#Cheems">
                                <tr>
                                    <td>
                                        <img :src= "require('../../images/home/icons/icons8-account-50.png').default" width="20px">
                                    </td>
                                    <td>
                                        Giải pháp doanh nghiệp
                                    </td>
                                </tr>
                                </a>
                            </table>

                            <div class ="mega-dropdown">
                                <table class = "mega-dropdown-content">
                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Home body -->
            <div class = "body">
                <!--Brand Sliders -->
                <div class="brand-slider">
                    <div class="title-tab">
                        <h3>Thương hiệu nổi bật</h3>
                    </div>
                    <div class ="slider-tab">
                        <div id="carouseBrands" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!--Sliders-->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-1.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-2.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-3.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-4.webp').default" class="d-block" alt="...">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-1.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-2.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-3.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-4.webp').default" class="d-block" alt="...">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-1.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-2.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-3.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../images/home/sliders/brand-4.webp').default" class="d-block" alt="...">
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouseBrands" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouseBrands" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                        </div>

                    </div>
                </div>
                <!--Products -->
                <div class="products">
                    <div class = "container mr-auto">
                        <div class="row">
                            <div>

                            </div>
                        </div>
                    </div>
                    <div class = "container ml-auto">
                        
                    </div>
                </div>
                <!--Top Sellers Slider -->
                <div class = "top-sellers-slider">

                </div>    
            </div>

<!--        <div class="body">
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
            </div>          -->

            <div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
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
/***************************
*******Sliders CSS**********
****************************/
.carousel-indicators li{
    background-color: #d2691e;
    height: 0.8em;
    width: 0.8em;
    border-radius: 100%;
    margin-bottom: 5.1em;
}
.carousel-indicators{
    z-index: 2;
}
.overlap{
    position: absolute;
    bottom:0;
    background-color:transparent;
    width: 100%;
    height: 39em;
}
.overlap .category-menu-area{
    position: absolute;
    top: 0.8em;
    left: 11em;
    border-radius: 10px;
}
.overlap .category-menu-area .side-menu{
    z-index: 2;
    position: absolute;
    background-color: white;
    width: 16em;
    height: inherit;
    border-radius: inherit;
}
.overlap .category-menu-area .mega-dropdown{
    z-index: 2;
    display: none;
    position: absolute;
    height: 30.75em;
    background-color: white;
    width: 66.9em;
    left: 16.7em;
    border-radius: 10px;
    top: 0;
}
.side-menu .side-menu-section table{
    width: 100%;
    font-size: 13px;
    border-radius: 10px;
}
.side-menu .side-menu-section table td{
    padding: 0.4em;
}
.side-menu .side-menu-section table:hover{
    background-color: #9bc7f328;
}
.side-menu .side-menu-section a{
    text-decoration: none;
    color: rgb(36, 36, 36);
}
.side-menu .side-menu-section a:hover{
    color: #005ba6;
}
.side-menu .side-menu-section table:hover + .mega-dropdown{
    display:block;
}
.side-menu .side-menu-section .mega-dropdown:hover{
    display:block;
}
/********************************
*******Home body CSS*************
*********************************/
.body{
    
}
/********************************
*******Brand Sliders CSS*********
*********************************/
.brand-slider{
    z-index: 4;
    position: absolute;
    background-color: transparent;
    margin-top: -5.5em;
    width: 79.4%;
    text-align: right;
    margin-left: 11em;
}
.brand-slider .title-tab{
    background-color: cadetblue;
    display:inline-block;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    width: 20em;
    text-align: center;
    padding-top: 0.6em;
    font-weight: 900;
    color:#ffff;
}
.brand-slider .slider-tab{
    background-color: cadetblue;
    height: 14em;
    border-top-left-radius: 20px;
    border-bottom-right-radius: 20px;
    border-bottom-left-radius: 20px;
}
.brand-slider .col-md-3{
  display: inline-block;
  margin-left:-0.3em;
  padding-top: 2em;
}
.brand-slider .col-md-3 img{
  width:100%;
  height:9.8em;
  border-radius: 10px;
}
/***************************
*******Products CSS*********
****************************/
.small-text {
    font-size: 14px;
}
.product-box {
    border: 1px solid #3f3f3f;
    padding: 10px 15px;
    width: 300;
    height: 500;
}
</style>