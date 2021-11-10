<template>
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
                            <img :src="require('../../../../../public/images/category.webp').default" class="d-block" alt="...">
                        </router-link>
                    </div>
                    <div class="col col-8 product-category">
                        <div class="row">
                            <div class="col col-6 border-right border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>MSI Gaming</h5>
                                    <p>Sức mạnh từ nhà rồng</p>
                                    <img :src="require('../../../../../public/images/product.webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Lễ hội HP</h5>
                                    <p>Siêu khuyến mãi</p>
                                    <img :src="require('../../../../../public/images/product(1).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 border-right border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>LG Gram</h5>
                                    <p>Siêu nhẹ siêu tiện lợi</p>
                                    <img :src="require('../../../../../public/images/product(2).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Lenovo</h5>
                                    <p>Dành cho doanh nhân</p>
                                    <img :src="require('../../../../../public/images/product(3).webp').default" class="d-block" alt="...">
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
                            <img :src="require('../../../../../public/images/category(1).webp').default" class="d-block" alt="...">
                        </router-link>
                    </div>
                    <div class="col col-8 product-category">
                        <div class="row">
                            <div class="col col-6 border-right border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>PC Cheems Store</h5>
                                    <p>Làm việc chuẩn mực</p>
                                    <img :src="require('../../../../../public/images/product(4).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>SSD</h5>
                                    <p>Load nhanh trong tích tắc</p>
                                    <img :src="require('../../../../../public/images/product(5).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 border-right border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Màn Hình Gaming</h5>
                                    <p>Giảm tới 50%</p>
                                    <img :src="require('../../../../../public/images/product(6).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>RTX 30 Series</h5>
                                    <p>Hiệu năng vượt bậc</p>
                                    <img :src="require('../../../../../public/images/product(7).webp').default" class="d-block" alt="...">
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
                            <img :src="require('../../../../../public/images/category(2).webp').default" class="d-block" alt="...">
                        </router-link>
                    </div>
                    <div class="col col-8 product-category">
                        <div class="row">
                            <div class="col col-6 border-right border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Smart TV</h5>
                                    <p>Sale khủng lên tới 49%++</p>
                                    <img :src="require('../../../../../public/images/product(8).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Tủ Lạnh</h5>
                                    <p>Cho thực phẩm luôn tươi</p>
                                    <img :src="require('../../../../../public/images/product(9).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 border-right border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Máy Lọc Khí</h5>
                                    <p>Cho không gian xanh sạch</p>
                                    <img :src="require('../../../../../public/images/product(10).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Máy Hút Bụi Cầm Tay</h5>
                                    <p>Hút bụi như hút cỏ</p>
                                    <img :src="require('../../../../../public/images/product(11).webp').default" class="d-block" alt="...">
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
                            <img :src="require('../../../../../public/images/category(3).webp').default" class="d-block" alt="...">
                        </router-link>
                    </div>
                    <div class="col col-8 product-category">
                        <div class="row">
                            <div class="col col-6 border-right border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Xiaomi Redmi Note 10</h5>
                                    <p>Hấp dẫn trên từng đường nét</p>
                                    <img :src="require('../../../../../public/images/product(12).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Tablet</h5>
                                    <p>Tập trung làm việc muôn nơi</p>
                                    <img :src="require('../../../../../public/images/product(13).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 border-right border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Máy Ảnh</h5>
                                    <p>Lưu giữ khoảnh khắc</p>
                                    <img :src="require('../../../../../public/images/product(14).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Smartwatch</h5>
                                    <p>năng động và phong cách</p>
                                    <img :src="require('../../../../../public/images/product(15).webp').default" class="d-block" alt="...">
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
                            <img :src="require('../../../../../public/images/category(4).webp').default" class="d-block" alt="...">
                        </router-link>
                    </div>
                    <div class="col col-8 product-category">
                        <div class="row">
                            <div class="col col-6 border-right border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Chuột Gaming</h5>
                                    <p>Tốc độ chuyên nghiệp</p>
                                    <img :src="require('../../../../../public/images/product(16).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Tai Nghe Bluetooth</h5>
                                    <p>Âm cuốn hút, giá mê ly</p>
                                    <img :src="require('../../../../../public/images/product(17).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 border-right border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Ô Cứng Di Động</h5>
                                    <p>Lưu trữ không giới hạn</p>
                                    <img :src="require('../../../../../public/images/product(18).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Bàn Phím Gaming</h5>
                                    <p>Phím cực hay, giá vừa tay</p>
                                    <img :src="require('../../../../../public/images/product(19).webp').default" class="d-block" alt="...">
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
                            <img :src="require('../../../../../public/images/category(5).webp').default" class="d-block" alt="...">
                        </router-link>
                    </div>
                    <div class="col col-8 product-category">
                        <div class="row">
                            <div class="col col-6 border-right border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>PC Văn Phòng</h5>
                                    <p>Lag không biên giới</p>
                                    <img :src="require('../../../../../public/images/product(20).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-bottom">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Combo Máy In</h5>
                                    <p>In hình trắng đen sống động</p>
                                    <img :src="require('../../../../../public/images/product(21).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 border-right border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Phần mềm bản quyền</h5>
                                    <p>Có ai ở Việt Nam mua hả?</p>
                                    <img :src="require('../../../../../public/images/product(22).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                            <div class="col col-6 border-left border-top">
                                <router-link :to="{name: 'product'}" id="banner-interaction">
                                    <h5>Giải pháp camera</h5>
                                    <p>Soi từng lỗ chân lông</p>
                                    <img :src="require('../../../../../public/images/product(23).webp').default" class="d-block" alt="...">
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
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
</style>