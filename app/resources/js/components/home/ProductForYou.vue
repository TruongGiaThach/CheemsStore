<template>
    <!--Products 4 you Slider -->
    <v-app class = "product-4-you">
            <div class="title">
                <h1>| &nbsp;Dành cho bạn</h1>
            </div>
            <div>
                
            </div>
    </v-app> 
</template>

<script>
export default {
    data() {
        return{
            products: [],
        }
    },
    beforeMount() {
        axios
        .get("/api/products")
        .then((response) => {
          this.products = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
}
</script>

<style scoped>
/*********************************
*******Products 4 You CSS*********
**********************************/
</style>