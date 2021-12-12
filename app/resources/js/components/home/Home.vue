<template>
        <v-app>
            <home-slider></home-slider>
            <div class="overlap">
                <div class="category-menu-area">
                    <div class="side-menu">
                        <side-menu></side-menu>
                    </div>
                </div>
            </div>
            <!--Home body -->
            <div class = "body">
                <brand-slider></brand-slider>
                <side-by-side-category></side-by-side-category> 
                <best-seller></best-seller>
                <product-for-you></product-for-you>
            </div>
        </v-app>

</template>

<script>
import HomeSlider from './HomeSlider.vue'
import SideMenu from './SideMenu.vue'
import BrandSlider from './BrandSlider.vue'
import SideBySideCategory from './SideBySideCategory.vue'
import BestSeller from './BestSeller.vue'
import ProductForYou from './ProductForYou.vue'

    export default {
        components: {
            HomeSlider,
            SideMenu,
            BrandSlider,
            SideBySideCategory,
            BestSeller,
            ProductForYou,
        },
    }
</script>
<style>

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
    top: 1.6em;
    left: 11em;
    border-radius: 10px;
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
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 950;
    font-size: 100%;
}
.body .title h3{
    font-weight: 700;
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
</style>