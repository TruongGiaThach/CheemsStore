
  
<template>
	<div class="o-background-order">
        <div v-for="value of catagories" :key="value">
            <product-table 
            :catagory="value.name"
            :desCatagory="value.description"
            :products="value.products" 
            >
            </product-table>
        </div>
        <br>
        <button class="btn btn-primary" @click="newProduct">Add New Product</button>
    </div>
</template>
<script>
    import Modal from './ProductModal'
import productTable from './productTable'
	export default {
        data(){
            return {
                catagories:[
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
        methods : {
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