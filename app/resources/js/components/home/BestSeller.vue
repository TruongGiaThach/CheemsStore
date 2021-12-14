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
<style scoped>
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
.col-md-3{
  display: inline-block;
  margin-left:-0.3em;
  padding-top: 2em;
}
</style>