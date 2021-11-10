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
                                v-model="catagories"
                                :headers="headers"
                                :items="value.products"
                                :items-per-page="5"
                                class="elevation-1"
                                @click:row="Khmoc"  single-select
                            ></v-data-table>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
        <div class="o-invoice">
            <div class="o-distance-table">
                <div class="o-change-table">
                        <div class="o-background-des">
                            <h4 class="o-title">{{ invoice }}</h4>
                        </div>
                    <br>
                    <div class="o-product-table-size">
                        <v-data-table
                            v-model="detailInvoice"
                            :headers="invoiceHeader"
                            :items="detailInvoice"
                            hide-default-footer
                        >
                        <template v-slot:[`item.actions`]="{ item }">
                            <v-icon
                            small
                            class="mr-2"
                            @click="editItem(item)"
                            >
                            mdi-plus
                            </v-icon>
                            <v-icon
                            small
                            @click="deleteItem(item)"
                            >
                            mdi-minus
                            </v-icon>
                        </template>
                        </v-data-table>
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
                                units:6,
                                description:"Dell là dòng máy",
                                price:111,
                                image:null
                            },
                            {
                                name:"Dell2",
                                units:6,
                                description:"Dell là dòng máy",
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
                                units:16,
                                description:"Galaxy là dòng máy ",
                                price: 10000,
                                image:null
                            },
                            {
                                name:"Nokia",
                                units:10,
                                description:"Nokia là một dòng máy của mọi nhà của mọi người, vừa đập được đá vừa chọi được người",
                                price: 100000,
                                image:null
                            },
                            {
                                name:"cangnha",
                                units:16,
                                description:"Galaxy là dòng máy ",
                                price: 10000,
                                image:null
                            },
                            {
                                name:"Metmoi",
                                units:16,
                                description:"Galaxy là dòng máy ",
                                price: 10000,
                                image:null
                            },
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
                        class:'green--text',
                        width:"1%"
                    },
                    { text:'Amount', value:'amount', class:'green--text', width:"1%"},
                    { text:'Price', value:'price', class:'green--text', width:"1%"},
                    { text: 'Actions', value: 'actions', sortable: false, class:'green--text', width:"1%"},
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
            },
            editItem(item){
                let temp=""
                console.log(item.name)
                let index= this.catagories.map(function(e){
                    return e.products.map(function(ep) {
                        return temp==ep.name
                    }).indexOf(item.name);
                }).indexOf(item);
                console.log(index)
                if(this.catagories[index[1]+1].products[index[0]+1].units > 0) {
                    this.catagories[index[1]+1].products[index[0]+1].units-=1
                    item.amount+=1
                }
                
            },
            deleteItem(item)
            {
                if(item.amount<=1){
                    let index= this.detailInvoice.indexOf(item)
                    this.detailInvoice.splice(index, 1)
                    console.log(index)
                }
                else item.amount-=1

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
        }
    }
</script>