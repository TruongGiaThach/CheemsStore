<template>
        <div>
            <home-slider></home-slider>
            <side-menu></side-menu>
            <!--Home body -->
            <div class = "body">
                <brand-slider></brand-slider>
                <side-by-side-category></side-by-side-category> 
                <best-seller></best-seller>
                <product-for-you></product-for-you>
            </div>
        </div>

</template>

<script>
import HomeSlider from './homepage_components/section/HomeSlider.vue'
import SideMenu from './homepage_components/section/SideMenu.vue'
import BrandSlider from './homepage_components/section/BrandSlider.vue'
import SideBySideCategory from './homepage_components/section/SideBySideCategory.vue'
import BestSeller from './homepage_components/section/BestSeller.vue'
import ProductForYou from './homepage_components/section/ProductForYou.vue'
    export default {
        data(){
            return {
                products : []
            }
        },
        components: {
            HomeSlider,
            SideMenu,
            BrandSlider,
            SideBySideCategory,
            BestSeller,
            ProductForYou
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)      
        }
    }
</script>
<style>

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

</style>