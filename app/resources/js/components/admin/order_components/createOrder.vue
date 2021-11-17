<template>
	<v-app class="create-order">
        <!--Product Search-->
        <v-card class="product-search-menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                <a>{{category_sort.name}}</a>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                                <div>
                                    <a class="dropdown-item" v-on:click="allCategorySort()">Tất cả</a>
                                </div>
                                <div v-for="(cate,index) in category" :key="index">
                                    <v-a v-model="cate.name" class="dropdown-item" v-on:click="changeCategorySort(cate)">{{cate.name}}</v-a>
                                </div>
                            </div>
                        </li>
                    </ul>
                        <form class="form-inline search-box">
                            <input class="form-control mr-sm-2 " v-model="search" type="search" placeholder="Nhập từ khóa cần tìm" aria-label="Search" size="50">
                        </form>
                    </div>
            </nav>
            <!--Product List-->
            <v-container class="products-showcase">
                <span class ="box-container" v-for="(product,index) in filteredProducts" :key="index" v-on:click="addItemToBill(product)">
                    <v-card class = "product-box">
                        <div>
                            <div class="price">{{product.outportPrice}}</div>
                        </div>
                        <div>
                            <img :src = "require('../../../../../public/images/' + product.image).default">
                        </div>
                        <div>
                            <p>{{product.name}}</p>
                        </div>
                    </v-card>
                </span>
            </v-container>
        </v-card><v-card class="sell-menu">
            <div class ="customer-info">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="text" v-model="c_name" class="form-control" id="NameInput" placeholder="Tên khách hàng">
                        </div>
                        <div class="form-group form-group col-md-4">
                            <input type="text" v-model="c_number" class="form-control" id="NumberInput" maxlength="10" placeholder="Số điện thoại"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="email" v-model="c_email" class="form-control" id="EmailInput" placeholder="Địa chỉ email">
                    </div>
                </form>
            </div>
            <!--Bill Product List-->
            <div class="product-list">
                <v-data-table class="table table-responsive" :headers="headDetail" :items="items" hide-default-footer>
                    <template v-slot:item="row">
                        <tr>
                            <td>{{row.item.name}}</td>
                            <td>
                                <v-form >
                                    <input type="number" v-model="row.item.amount" min="1" onkeydown="return false" >
                                </v-form>
                            </td>
                            <td>{{row.item.price}}</td>
                            <td>
                                <v-btn class="mx-2" fab dark x-small color="red" v-on:click="deleteItem(index)">
                                    <v-icon dark>x</v-icon>
                                </v-btn>
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </div>
            
            
            <!--Bill Conclusion-->
            <div class="conclusion">
                <div class="conclusion-info">
                    <span>
                    <h5>Tổng tiền: <p>{{totalPrice}} VNĐ</p></h5>
                    <h5>Thuế VAT: <p>{{vat}} VNĐ</p></h5>
                    <h5>Phải trả: <p>{{endPrice}} VNĐ</p></h5>
                    </span>
                </div>
                <div class="conclusion-buttons">
                    <button type="button" class="btn btn-danger btn-block btn-cancel">Hủy</button>
                    <button type="button" class="btn btn-success btn-block btn-finish py-5" data-target="#ConfirmModal" v-bind:disabled="!okToGo" v-on:click="checkExistingCustomer()">Thanh toán </button>
                </div>
                <!-- Modal -->
                <v-dialog v-model="dialog" max-height="100vh" max-width="100vh">
                    <v-card class="p-3 m-2 overflow-x-hidden" max-height="inherit" max-width="inherit">
                        <div id="page">
                            <v-card-title class="bg-info mx-auto" max-width="inherit">
                                <span class="text-h5 mx-auto white--text"> THÔNG TIN HÓA ĐƠN</span>
                            </v-card-title>

                            <v-card-text style="right:0px" max-width="inherit">
                                <v-container>
                                <div class="clear">
                                    <div class="column2">
                                    <h5>Cheems #ID: {{billId}}</h5>
                                    <p style="display:inline"><b>Ngày thanh toán :</b> {{ createDay }}</p>
                                    </div>
                                    <div>
                                    <div class="column2 align-left">
                                        <p style=" margin-top: 5px ;display:inline">
                                        <b>Trạng thái:</b>Đã thanh toán
                                        </p>
                                    </div>
                                    </div>
                                </div>
                                <div class="clear">
                                    <div class="column2" style="margin-bottom: 5px">
                                    <span><b style="display:inline">Khách hàng:</b></span>
                                    <span>{{ c_name }}</span>
                                    </div>
                                    <div class="column2">
                                    <span><b style="display:inline">email:</b></span>
                                    <span>{{ c_email }}</span>
                                    </div>
                                    <div class="column2">
                                    <span><b style="display:inline">Sđt:</b></span>
                                    <span>{{ c_number }}</span>
                                    </div>
                                </div>
                                <v-data-table max-width="inherit"
                                    v-model="items"
                                    :headers="receiptDetail"
                                    :items="items"
                                    hide-default-footer
                                    class="elevation-1 "
                                ></v-data-table>
                                <br />
                                <div class="column2">
                                    <span><h5 style="display:inline">Tổng:</h5></span>
                                    <span ><b style="color: green; font-size: 110%">{{endPrice}} VNĐ</b></span>
                                </div>
                                <div class="column2">
                                    <span><h5 style="display:inline">VAT:</h5></span>
                                    <span ><b style="color: green; font-size: 110%">{{vat}} VNĐ</b></span>
                                </div>
                                </v-container>
                            </v-card-text>
                        </div>
                    <v-card-actions max-width="inherit">
                        <v-spacer></v-spacer>
                        <b-button pill variant="info" @click="close">Hủy</b-button>
                        <b-button pill variant="info" @click="printDetail">In hóa đơn</b-button>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </v-card>

    </v-app>
</template>
<script>
	export default {
        name: "create-order",
        data(){
            return {
                products : [],
                category : [],
                items : [],
                category_sort: {
                    name: "Tất cả",
                    id: "0"
                },
                search: '',
                c_id: '',
                c_name: '',
                c_number: '',
                c_email: '',
                // receipt detail
                dialog: false,
                total: 0,
                VAT: 0,
                createDay: '',
                billId:'',
                headDetail: [
                    {
                        text: "Tên Sản Phẩm",
                        align: "left",sortable: false, value: "name", class: "info--text",
                    },
                    { text: "Số lượng", value: "amount", class: "info--text",},
                    { text: "Đơn giá", value: "price", class: "info--text" },
                ],
                receiptDetail: [
                    {
                        text: "Tên Sản Phẩm",
                        align: "left",sortable: false, value: "name", class: "info--text",width:"50vh"
                    },
                    { text: "Số lượng", value: "amount", class: "info--text", width:"20vh"},
                    { text: "Đơn giá", value: "price", class: "info--text" },
                ],
            }
        },
        watch: {
            dialog(val) {
            val || this.close();
            },
        },
        beforeMount(){
            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })

            axios.get('/api/category/')
            .then(response => {
                this.category = response.data
            })
            .catch(error => {
                console.error(error);
            })
        },
        computed: {
            filteredProducts() {
                return this.products.filter(product => {
                    if(this.sameCategory(product))
                    return product.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            },
            totalPrice() {
                var total = 0;
                if(this.items.length > 0){
                    for(var i = 0; i < this.items.length; i++){
                        total += parseInt(this.items[i].amount * this.items[i].price);
                    }
                }
                return total;
            },
            vat() {
                return (this.totalPrice * 0.1).toFixed(1);
            },
            endPrice() {
                return (parseInt(this.totalPrice) + parseFloat(this.vat));
            },
            okToGo() {
                if(this.c_name != '' && this.c_number.length == 10 && this.c_email != '' && this.items.length > 0){
                    return true;
                }else return false;
            }
        },
        methods : {
            addItemToBill(product){
                if(this.items.length > 0)
                {
                    for(var i = 0; i < this.items.length; i++){
                        if(this.items[i].id == product._id){
                            this.items[i].amount++;
                            return;
                        }
                    }
                    this.items.push({
                        id: product._id,
                        name: product.name,
                        amount: 1,
                        price: product.outportPrice
                    })
                }else{
                    this.items.push({
                        id: product._id,
                        name: product.name,
                        amount: 1,
                        price: product.outportPrice
                    })
                }
            },
            deleteItem(index){
                if(this.items.length > 0)
                {
                    this.items.splice(index, 1);
                }
            },
            sameCategory(product) {
                if(this.category_sort.name == 'Tất cả') {
                    return true;
                }
                else if(this.category_sort.id == product.category_id) {
                    return true;
                }
                else return false;
            },
            allCategorySort() {
                this.category_sort.name = 'Tất cả';
            },
            changeCategorySort(cate) {
                this.category_sort.name = cate.name;
                this.category_sort.id = cate._id;
            },
            //Create new user for each new receipt with new email
            checkExistingCustomer() {
                axios.get('/api/customer/')
                .then(response => {
                    for(var i = 0; i < response.data.length; i++){
                        if(response.data[i].email == this.c_email){
                            return this.addRecepit(response.data[i]);
                        }
                    }return this.newCustomer();
                })
                .catch(error => {
                    console.error(error);
                })
                this.dialog=true;
            },
            newCustomer() {
                axios.post("/api/customer/", {
                    name: this.c_name,
                    email: this.c_email,
                    number: this.c_number,
                    })
                    .then(response => {
                    console.log(response.data);
                    this.addRecepit(response.data);
                })
            },
            addRecepit(item) {
                let day = new Date();
                axios.post('/api/receipt/',{
                user_id: item._id.toString(),
                createDay: day.toISOString().substring(0, 10),
                total: this.endPrice,
                VAT: this.vat,
                })
                .then(response => {this.addRecepitDetail(response.data)
                })
            },
            addRecepitDetail(rec) {
                this.billId = rec._id;
                this.createDay = rec.createDay;
                console.log(rec);
                for(var i = 0; i < this.items.length; i++){
                    axios.post('/api/receipt_detail/',{
                        receipt_id: rec._id.toString(),
                        product_id: this.items[i].id.toString(),
                        unitPrice: this.items[i].price,
                        amount: this.items[i].amount,
                    })
                }
                this.dialog = true;
            },
            printDetail(){
                this.dialog=true;
                window.print('page');
            },
            close() {
                this.dialog = false;
            },
        }
    }
</script>
<style scoped>
/***********************
*******Body CSS*********
************************/
.create-order{
    position: relative;
    height:91vh;
    overflow: hidden;
}
.product-search-menu{
    position: relative;
    height: 100%;
    width: 60%;
    display: inline-block;
}
.sell-menu{
    position: absolute;
    right:0;
    height: 100%;
    width: 40%;
    display: inline-block;
}
/*******************************
*******Product menu CSS*********
********************************/
.product-search-menu .navbar{
    height: 7%;
}
.product-search-menu .products-showcase{
    height: 93%;
    overflow: auto;
}
.product-search-menu .box-container{
    position: relative;
    width: 20%;
    display: inline-block;
}
.product-search-menu .product-box{
    margin: 0.15em;
    border: solid 0.04em rgba(128, 128, 128, 0.4);
    background-color: white;
    overflow: hidden;
}
.product-search-menu .product-box:active{
   transform:scale(0.95);
   box-shadow: 0.4em 0.4em 0.2em grey;
}
.product-search-menu .product-box .price{
    position: absolute;
    right: 0;
    background-color: darkcyan;
    color: white;
    padding-right: 0.2em;
    padding-left: 0.4em;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}
.product-search-menu .product-box img{
    height: 9em;
    width: 9em;
}
.product-search-menu .product-box p{
    color:rgb(100, 100, 100);
    height: 2.87em;
    overflow: hidden;
    font-weight: bold;
}
/****************************
*******Sell menu CSS*********
*****************************/
.sell-menu{
    Border-left: solid 0.2em darkcyan;
}
.sell-menu .customer-info{
    padding-left: 1em;
    padding-right: 1em;

}
.sell-menu .product-list{
    height: 55%;
    overflow: scroll;
}
.sell-menu .conclusion{
    height: 25%;
    background: rgba(0, 139, 139, 0.3);
}
.sell-menu .product-list input{
    background-color: white;
    width: 3em;
}
.sell-menu .product-list tr:hover input{
    background-color: #EEEEEE;
}

/*****************************
*******Conclusion CSS*********
******************************/
.conclusion{
    position: relative;
    padding: 1em;
    overflow: auto;
}
.conclusion .conclusion-info{
    position: relative;
    width: 80%;
    display: inline-block;
}
.conclusion .conclusion-buttons{
    position: absolute;
    width: 20%;
    display: inline-block;
}
.conclusion .conclusion-buttons .btn{
    font-weight: bold;
}
.conclusion .conclusion-buttons .btn-finish{
    height: 6em;
}
.conclusion .conclusion-info h5{
    padding-bottom: 1em;
    font-weight: bold;
    font-size: 120%;
}
.conclusion .conclusion-info p{
    color:darkgreen;
    display: inline;
}
</style>
