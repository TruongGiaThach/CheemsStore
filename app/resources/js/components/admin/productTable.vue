<template>
    <div class="o-distance-table">
        <div class="o-change-table">
                <div class="o-background-des">
                    <h4 class="o-title">{{ catagory }}</h4>
                    <p>{{ desCatagory }}</p>
                </div>
            <br>
            <div class="o-product-table">
                <v-data-table
                    :headers="headers"
                    :items="products"
                    :items-per-page="5"
                    class="elevation-1"
                    @click:row="Khmoc"  single-select
                ></v-data-table>
            </div>
        </div>
    </div>

</template>

<style scoped>
    
</style>

<script>
export default {
    name:"product-table",
    props: {
        Khmoc: Function,
        products: Array,
        catagory: String,
        desCatagory: String,
    },
}
</script>