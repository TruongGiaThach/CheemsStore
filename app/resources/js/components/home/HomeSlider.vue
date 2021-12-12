<template>
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
                <img :src="require('../../../../public/images/1.webp').default" class="d-block w-120" alt="...">
                </div>
                <div class="carousel-item">
                <img :src="require('../../../../public/images/2.webp').default" class="d-block w-120" alt="...">
                </div>
                <div class="carousel-item">
                <img :src="require('../../../../public/images/3.webp').default" class="d-block w-120" alt="...">
                </div>
            </div>
        </div>
</template>
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

</style>