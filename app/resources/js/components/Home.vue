<template>
        <div>
        <!--Carousel Slider -->
        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
            <!--Slider indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselIndicators" data-slide-to="1"></li>
            <li data-target="#carouselIndicators" data-slide-to="2"></li>
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
        <!--Slider Arrow -->
        </div>


            <!--Overlap -->
            <div class = "overlap">
                <div class = "categorty-menu-area">
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
            <!-- End of overlap - Start body -->
            <div class="body">
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

    .overlap{
        position: absolute;
        bottom:0px;
        z-index: 1;
        background-color:transparent;
        width: 100%;
        height: 566px;
    }
    .overlap .categorty-menu-area{
        position: absolute;
        width: 1200px;
        height: 447px;
        top: 10px;
        left: 150px;
        border-radius: 10px;
    }
    .overlap .categorty-menu-area .side-menu{
        position: absolute;
        background-color: white;
        width: 230px;
        height: inherit;
        border-radius: inherit;
    }
    .overlap .categorty-menu-area .mega-dropdown{
        display: none;
        position: absolute;
        height: 447px;
        background-color: white;
        width: 960px;
        left: 240px;
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
</style>