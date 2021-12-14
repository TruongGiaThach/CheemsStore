<template>
    <!--Brand Sliders -->
    <div class="brand-slider">
        <div class="title">
            <h3>Thương hiệu nổi bật</h3>
        </div>
        <div class ="slider-tab">
            <div id="carouseBrands" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
            <!--Sliders-->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-1.webp').default" class="d-block" alt="...">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-2.webp').default" class="d-block" alt="...">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-3.webp').default" class="d-block" alt="...">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-4.webp').default" class="d-block" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-2.webp').default" class="d-block" alt="...">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-3.webp').default" class="d-block" alt="...">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-4.webp').default" class="d-block" alt="...">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <img :src="require('../../../../public/images/brand-5.webp').default" class="d-block" alt="...">
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
</template>
<style scoped>
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
    width: 16em;
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
</style>