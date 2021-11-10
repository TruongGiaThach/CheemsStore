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
                <img :src="require('../../../public/images/1.webp').default" class="d-block w-120" alt="...">
                </div>
                <div class="carousel-item">
                <img :src="require('../../../public/images/2.webp').default" class="d-block w-120" alt="...">
                </div>
                <div class="carousel-item">
                <img :src="require('../../../public/images/3.webp').default" class="d-block w-120" alt="...">
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
                                        <img :src= "require('../../../public/images/icons8-washing-machine-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-laptop-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-tv-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-touchscreen-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-workstation-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-monitor-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-electronics-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-game-controller-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-computer-mouse-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-subwoofer-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-camera-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-print-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-wi-fi-lock-50.png').default" width="20px">
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
                                        <img :src= "require('../../../public/images/icons8-account-50.png').default" width="20px">
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
                    <div class="title">
                        <h3>Thương hiệu nổi bật</h3>
                    </div>
                    <div class ="slider-tab">
                        <div id="carouseBrands" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!--Sliders-->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-1.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-2.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-3.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-4.webp').default" class="d-block" alt="...">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-1.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-2.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-3.webp').default" class="d-block" alt="...">
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img :src="require('../../../public/images/brand-4.webp').default" class="d-block" alt="...">
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouseBrands" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Trước</span>
                            </a>
                            <a class="carousel-control-next" href="#carouseBrands" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Sau</span>
                            </a>
                        </div>

                    </div>
                </div>
                <!--Products -->
                <div class="products">
                    <div class="row category-row">
                        <div class = "col mr-auto">
                            <div class="title">
                                <h1>| &nbsp;LAPTOP - MACBOOK</h1>
                            </div>
                            <div class="row">
                                <div class="col col-4 banner">
                                    <router-link :to="{name: 'product'}" id="banner-interaction">
                                        <img :src="require('../../../public/images/category.webp').default" class="d-block" alt="...">
                                    </router-link>
                                </div>
                                <div class="col col-8 product-category">
                                    <div class="row">
                                        <div class="col col-6 border-right border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>MSI Gaming</h5>
                                                <p>Sức mạnh từ nhà rồng</p>
                                                <img :src="require('../../../public/images/product.webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Lễ hội HP</h5>
                                                <p>Siêu khuyến mãi</p>
                                                <img :src="require('../../../public/images/product(1).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6 border-right border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>LG Gram</h5>
                                                <p>Siêu nhẹ siêu tiện lợi</p>
                                                <img :src="require('../../../public/images/product(2).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Lenovo</h5>
                                                <p>Dành cho doanh nhân</p>
                                                <img :src="require('../../../public/images/product(3).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "col ml-auto">
                            <div class="title">
                                <h1>| &nbsp;PC - MÀN HÌNH - LINH KIỆN MÁY TÍNH</h1>
                            </div>
                            <div class="row">
                                <div class="col col-4 banner">
                                    <router-link :to="{name: 'product'}" id="banner-interaction">
                                        <img :src="require('../../../public/images/category(1).webp').default" class="d-block" alt="...">
                                    </router-link>
                                </div>
                                <div class="col col-8 product-category">
                                    <div class="row">
                                        <div class="col col-6 border-right border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>PC Cheems Store</h5>
                                                <p>Làm việc chuẩn mực</p>
                                                <img :src="require('../../../public/images/product(4).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>SSD</h5>
                                                <p>Load nhanh trong tích tắc</p>
                                                <img :src="require('../../../public/images/product(5).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6 border-right border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Màn Hình Gaming</h5>
                                                <p>Giảm tới 50%</p>
                                                <img :src="require('../../../public/images/product(6).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>RTX 30 Series</h5>
                                                <p>Hiệu năng vượt bậc</p>
                                                <img :src="require('../../../public/images/product(7).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row category-row">
                        <div class = "col mr-auto">
                            <div class="title">
                                <h1>| &nbsp;TIVI - ĐIỆN MÁY - GIA DỤNG</h1>
                            </div>
                            <div class="row">
                                <div class="col col-4 banner">
                                    <router-link :to="{name: 'product'}" id="banner-interaction">
                                        <img :src="require('../../../public/images/category(2).webp').default" class="d-block" alt="...">
                                    </router-link>
                                </div>
                                <div class="col col-8 product-category">
                                    <div class="row">
                                        <div class="col col-6 border-right border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Smart TV</h5>
                                                <p>Sale khủng lên tới 49%++</p>
                                                <img :src="require('../../../public/images/product(8).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Tủ Lạnh</h5>
                                                <p>Cho thực phẩm luôn tươi</p>
                                                <img :src="require('../../../public/images/product(9).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6 border-right border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Máy Lọc Khí</h5>
                                                <p>Cho không gian xanh sạch</p>
                                                <img :src="require('../../../public/images/product(10).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Máy Hút Bụi Cầm Tay</h5>
                                                <p>Hút bụi như hút cỏ</p>
                                                <img :src="require('../../../public/images/product(11).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "col ml-auto">
                            <div class="title">
                                <h1>| &nbsp;ĐIỆN THOẠI - MÁY ẢNH - THIẾT BỊ THÔNG MINH</h1>
                            </div>
                            <div class="row">
                                <div class="col col-4 banner">
                                    <router-link :to="{name: 'product'}" id="banner-interaction">
                                        <img :src="require('../../../public/images/category(3).webp').default" class="d-block" alt="...">
                                    </router-link>
                                </div>
                                <div class="col col-8 product-category">
                                    <div class="row">
                                        <div class="col col-6 border-right border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Xiaomi Redmi Note 10</h5>
                                                <p>Hấp dẫn trên từng đường nét</p>
                                                <img :src="require('../../../public/images/product(12).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Tablet</h5>
                                                <p>Tập trung làm việc muôn nơi</p>
                                                <img :src="require('../../../public/images/product(13).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6 border-right border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Máy Ảnh</h5>
                                                <p>Lưu giữ khoảnh khắc</p>
                                                <img :src="require('../../../public/images/product(14).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Smartwatch</h5>
                                                <p>năng động và phong cách</p>
                                                <img :src="require('../../../public/images/product(15).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row category-row">
                        <div class = "col mr-auto">
                            <div class="title">
                                <h1>| &nbsp;LOA - TAI NGHE - THIẾT BỊ NGOẠI VI</h1>
                            </div>
                            <div class="row">
                                <div class="col col-4 banner">
                                    <router-link :to="{name: 'product'}" id="banner-interaction">
                                        <img :src="require('../../../public/images/category(4).webp').default" class="d-block" alt="...">
                                    </router-link>
                                </div>
                                <div class="col col-8 product-category">
                                    <div class="row">
                                        <div class="col col-6 border-right border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Chuột Gaming</h5>
                                                <p>Tốc độ chuyên nghiệp</p>
                                                <img :src="require('../../../public/images/product(16).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Tai Nghe Bluetooth</h5>
                                                <p>Âm cuốn hút, giá mê ly</p>
                                                <img :src="require('../../../public/images/product(17).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6 border-right border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Ô Cứng Di Động</h5>
                                                <p>Lưu trữ không giới hạn</p>
                                                <img :src="require('../../../public/images/product(18).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Bàn Phím Gaming</h5>
                                                <p>Phím cực hay, giá vừa tay</p>
                                                <img :src="require('../../../public/images/product(19).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "col ml-auto">
                            <div class="title">
                                <h1>| &nbsp;THIẾT BỊ MẠNG - VĂN PHÒNG</h1>
                            </div>
                            <div class="row">
                                <div class="col col-4 banner">
                                    <router-link :to="{name: 'product'}" id="banner-interaction">
                                        <img :src="require('../../../public/images/category(5).webp').default" class="d-block" alt="...">
                                    </router-link>
                                </div>
                                <div class="col col-8 product-category">
                                    <div class="row">
                                        <div class="col col-6 border-right border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>PC Văn Phòng</h5>
                                                <p>Lag không biên giới</p>
                                                <img :src="require('../../../public/images/product(20).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-bottom">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Combo Máy In</h5>
                                                <p>In hình trắng đen sống động</p>
                                                <img :src="require('../../../public/images/product(21).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6 border-right border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Phần mềm bản quyền</h5>
                                                <p>Có ai ở Việt Nam mua hả?</p>
                                                <img :src="require('../../../public/images/product(22).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                        <div class="col col-6 border-left border-top">
                                            <router-link :to="{name: 'product'}" id="banner-interaction">
                                                <h5>Giải pháp camera</h5>
                                                <p>Soi từng lỗ chân lông</p>
                                                <img :src="require('../../../public/images/product(23).webp').default" class="d-block" alt="...">
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Top Sellers Slider -->
                <div class = "top-sellers-slider">
                     <div class="title">
                        <h3>Thương hiệu nổi bật</h3>
                    </div>
                </div>    
                <!--Products 4 you Slider -->
                <div class = "product-4-you">
                     <div class="title">
                         <h1>| &nbsp;Dành cho bạn</h1>
                     </div>
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
    position: relative;
    bottom:0;
    background-color:transparent;
    width: 100%;
    height: 39em;
    margin-top: -39em;
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
    width: 79.4%;
    margin-left: 11em;
    background-color: #ffff;
}
.body .products{
    margin-top: 4em;
}
.body .top-sellers-slider{
    margin-top: 4em;
}
.body .product-4-you{
    margin-top: 4em;
}
.body .title h1{
    font-weight: 950;
    font-size: 135%;
}
.body .title h3{
    font-weight: 900;
    color:#ffff;
    padding-top: 0.7em;
}
.body img{
    transition: all 1s;
}
.body img:hover{
    -webkit-transform: scale(1.05); 
    transform: scale(1.05);
}
.carousel{
    display: flex;
    align-items: center;
}
.carousel-control-prev{
    background-color: rgba(0, 0, 0, 0.4);
    width: 4em;
    height: 3em;
    margin: 0;
    position: absolute;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    border-top-right-radius: 45%;
    border-bottom-right-radius: 45%;
}
.carousel-control-next{
    background-color: rgba(0, 0, 0, 0.4);
    width: 4em;
    height: 3em;
    margin: 0;
    position: absolute;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    border-top-left-radius: 45%;
    border-bottom-left-radius: 45%;
}
/********************************
*******Brand Sliders CSS*********
*********************************/
.brand-slider{
    z-index: 4;
    position: relative;
    background-color: transparent;
    margin-top: -5.5em;
    max-width: 100%;
    text-align: right;
}
.brand-slider .title{
    background-color: #008b8b;
    display:inline-block;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    width: 20em;
    text-align: center;
}
.brand-slider .slider-tab{
    background-color:#008b8b;
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
.products .category-row{
    margin-top: 2em;
}
.products .banner{
    overflow: hidden;
}
.products .product-category .row .col {
    text-align: center;
    padding: 1em;
}
.products .product-category .row .col :link{
    color: #000000;
}
.products .product-category .row .col :visited{
    color: #000000;
}
.products .product-category .row .col :hover{
    text-decoration: none;
    color:#005ba6;
}
.products .product-category .row .col h5{
    font-size: 100%;
    font-weight: bold;
}
.products .product-category .row .col p{
    font-size: 90%;
}
.products .product-category .row .col img{
    width: 7em;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
/******************************
*******Top Sellers CSS*********
*******************************/
.top-sellers-slider{
    height: 20em;
    background-color: orangered;
    border-radius: 10px;
}
.top-sellers-slider .title{
    padding-left:1em;
}
/*********************************
*******Products 4 You CSS*********
**********************************/
</style>