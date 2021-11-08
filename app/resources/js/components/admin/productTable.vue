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
                ></v-data-table>
            </div>
        </div>
    </div>

</template>

<style scoped>
    p {
        font-size: 14px;
        padding-left: 14px;
        color: rgb(218, 218, 211);
    }
</style>

<script>
export default {
    name:"product-table",
    props: {
        products: Array,
        catagory: String,
        desCatagory: String,
    },
    data (){
        return {
            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                    class:'green--text'
                },
                { text: 'Units', value: 'units', class:'green--text' },
                { text: 'Description', value: 'description', class:'green--text'},
                { text: 'Price', value: 'price', class:'green--text' },
                { text: 'Image', value: 'image', class:'green--text' },
            ],
        }
    }

}
</script>