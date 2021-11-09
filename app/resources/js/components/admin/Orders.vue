
  
<template>
    <div class="o-divide">
        <div class="o-background-order">
            <div v-for="value of catagories" :key="value.name" class="com">
                <div class="o-distance-table">
                    <div class="o-change-table">
                            <div class="o-background-des">
                                <h4 class="o-title">{{ value.name }}</h4>
                                <p>{{ value.description }}</p>
                            </div>
                        <br>
                        <div class="o-product-table">
                            <v-data-table
                                :headers="headers"
                                :items="value.products"
                                :items-per-page="5"
                                class="elevation-1"
                                @click:row="Khmoc"  single-select
                            ></v-data-table>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <button class="btn btn-primary" @click="newProduct">Add New Product</button>
        </div>
        <div class="o-invoice">
            <div class="o-distance-table">
                <div class="o-change-table">
                        <div class="o-background-des">
                            <h4 class="o-title">{{ invoice }}</h4>
                        </div>
                    <br>
                    <div class="o-product-table">
                        <v-data-table
                            v-model="detailInvoice"
                            :headers="invoiceHeader"
                            :items="detailInvoice"
                            hide-default-footer
                        ></v-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    p {
        font-size: 14px;
        padding-left: 14px;
        color: rgb(218, 218, 211);
        margin: 5px; 
    }
</style>
<script>
import productTable from './productTable'
	export default {
        data(){
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
                catagories: [
                    {
                        products: [
                            {
                                name:"Dell",
                                units:"6",
                                description:"Dell là dòng máy ngu vl",
                                price:111,
                                image:null
                            },
                            {
                                name:"Dell",
                                units:"6",
                                description:"Dell là dòng máy ngu vl",
                                price: 2000,
                                image:null
                            }
                        ] ,
                        name:"Máy tính",
                        description: "Máy tính là một mặt hàng phổ biến nha",
                    },
                    {
                        products: [
                            {
                                name:"GalaxyS1",
                                units:"6",
                                description:"Galaxy là dòng máy ngu vl",
                                price: 10000,
                                image:null
                            },
                            {
                                name:"Nokia",
                                units:"10",
                                description:"Nokia là một dòng máy của mọi nhà của mọi người, vừa đập được đá vừa chọi được người",
                                price: 100000,
                                image:null
                            }
                        ] ,
                        name:"Điện thoại",
                        description: "Điện thoại là một thứ gi đó bây giờ tôi rất cần"

                    }

                ],
                invoiceHeader:[
                    {
                        text: 'Name',
                        align: 'start',
                        sortable: false,
                        value: 'name',
                        class:'green--text'
                    },
                    { text:'Amount', value:'amount', class:'green--text'},
                    { text:'Price', value:'price', class:'green--text'}
                ],
                invoice:"Hóa đơn",
                detailInvoice: [
                    {
                        name: "dungkun",
                        amount: 6,
                        price: 100000,
                    }
                ],
            }
        },
        components : {
            productTable
        },
        /*beforeMount(){
            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })     
        },*/
        create (){
            this.initialize()
        },

        methods: {
            Khmoc(item, row){
                let a= this.detailInvoice.map(function(e){
                    return e.name;
                }).indexOf(item.name);
                if(a===-1)
                    this.detailInvoice.push({name:item.name, amount: 1, price: item.price })
                else {
                    this.detailInvoice[a].amount+=1;
                    this.detailInvoice[a].price+=item.price;
                }
            },
            initialize() {
                this.catagories = [
                    {
                        products: [
                            {
                                name:"Dell",
                                units:"6",
                                description:"Dell là dòng máy ngu vl",
                                price:"1000.000",
                                image:null
                            },
                            {
                                name:"Dell",
                                units:"6",
                                description:"Dell là dòng máy ngu vl",
                                price:"1000.000",
                                image:null
                            }
                        ] ,
                        name:"Máy tính",
                        description: "Máy tính là một mặt hàng phổ biến nha",
                    },
                    {
                        products: [
                            {
                                name:"GalaxyS4",
                                units:"6",
                                description:"Galaxy là dòng máy ngu vl",
                                price:"1000.000",
                                image:null
                            },
                            {
                                name:"Nokia",
                                units:"10",
                                description:"Nokia là một dòng máy của mọi nhà của mọi người, vừa đập được đá vừa chọi được người",
                                price:"1000.000",
                                image:null
                            }
                        ] ,
                        name:"Điện thoại",
                        description: "Điện thoại là một thứ gi đó bây giờ tôi rất cần"

                    }

                ]
            },
            newProduct(){
                this.addingProduct = {
                    name : null, 
                    units : null, 
                    price : null,
                    description : null,
                    image : null
                }
            },
            endEditing(product){
                this.editingItem = null
                let index = this.products.indexOf(product)
                axios.put(`/api/products/${product.id}`,{
                    name  : product.name,
                    units : product.units,
                    price : product.price,
                    description : product.description,
                })
                .then(response =>{
                    this.products[index] = product
                })
                .catch(response => {
                })
            },
            addProduct(product){
                this.addingProduct = null
                axios.post("/api/products/",{
                    name  : product.name,
                    units : product.units,
                    price : product.price,
                    description : product.description,
                    image : product.image
                })
                .then(response =>{
                    this.products.push(product)
                })
                .catch(response => {
                })
            }
        }
    }
</script>