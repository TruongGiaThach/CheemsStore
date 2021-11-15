<template>
	<div class="create-order">
        <!--Product Search-->
        <div class="product-search-menu">
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
                                    <a v-model:="cate.name" class="dropdown-item" v-on:click="changeCategorySort(cate)">{{cate.name}}</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                        <form class="form-inline search-box">
                            <input class="form-control mr-sm-2 " v-model="search" type="search" placeholder="Nhập từ khóa cần tìm" aria-label="Search" size="40">
                        </form>
                    </div>
            </nav>
            <!--Product List-->
            <div class="products-showcase">
                <span class ="box-container" v-for="(product,index) in filteredProducts" :key="index" v-on:click="addItemToBill(product)">
                    <div class = "product-box">
                        <div v-model:="product.outportPrice">
                            <div class="price">{{product.outportPrice}}</div>
                        </div>
                        <div v-model:="product.image">
                            <img :src = "require('../../../../../public/images/' + product.image).default">
                        </div>
                        <div v-model:="product.name">
                            <p>{{product.name}}</p>
                        </div>
                    </div>
                </span>
            </div>
        </div><div class="sell-menu">
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
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <td id ="stt">STT</td>
                            <td id ="name">Tên sản phẩm</td>
                            <td id ="amount">Số lượng</td>
                            <td id ="price">Đơn giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in items" :key="index" >
                            <td id ="stt">{{index+1}}</td>
                            <td id ="name" v-html="item.name"></td>
                            <td id ="amount" v-model:="item.amount">
                                <form>
                                    <input type="number" v-model="item.amount" size="4" min="1">
                                </form>
                                </td>
                            <td id ="price" v-model:="item.price">{{item.price}}</td>
                            <td id ="delete">
                                <button class="btn" v-on:click="deleteItem(index)">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                    <button type="button" class="btn btn-success btn-block btn-finish py-5" data-toggle="modal" data-target="#ConfirmModal" v-bind:disabled="!okToGo">Thanh toán </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="ConfirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ConfirmModalLabel">Xác nhận đơn hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Tên khách hàng: <p>{{this.c_name}}</p></h5>
                            <h5>Số điện thoại: <p>{{this.c_number}}</p></h5>
                            <h5>Địa chỉ email: <p>{{this.c_email}}</p></h5>
                            <h5>Tổng tiền: <p>{{totalPrice}} VNĐ</p></h5>
                            <h5>Thuế VAT: <p>{{vat}} VNĐ</p></h5>
                            <h5>Phải trả: <p>{{endPrice}} VNĐ</p></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="checkExistingCustomer()">Xác nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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
            }
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
                return (this.totalPrice * 0.1);
            },
            endPrice() {
                return (this.totalPrice + this.vat);
            },
            okToGo() {
                if(this.c_name != '' && this.c_number != '' && this.c_email != '' && this.items.length > 0){
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
            },
            newCustomer() {
                axios.post("/api/customer/", {
                    name: this.c_name, 
                    email: this.c_email, 
                    number: this.c_number,
                    })
                    .then(response => {this.addRecepit(response.data.data)
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
                .then(response => {this.addRecepitDetail(response.data.data)
                })
            },
            addRecepitDetail(rec) {
                console.log(rec);
                for(var i = 0; i < this.items.length; i++){
                    axios.post('/api/receipt_detail/',{
                        receipt_id: rec._id.toString(),
                        product_id: this.items[i].id.toString(),
                        unitPrice: this.items[i].price.toString(),
                        amount: this.items[i].amount.toString(),
                    }).then(response => {console.log(response.data.data)})
                }
            }
        }
    }
</script>

<style scoped>
/***********************
*******Body CSS*********
************************/
.create-order{
    position: relative;
}
.product-search-menu{
    position: relative;
    height: 100%;
    width: 60%;
    display: inline-block;
}
.sell-menu{
    position: absolute;
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
    height: 60%;
    overflow: scroll;
}
.sell-menu .conclusion{
    height: 25%;
    background: rgba(0, 139, 139, 0.3);
}
.sell-menu table #stt{
    width: 2%;
}
.sell-menu table #name{
    width: 45%;
}
.sell-menu table #amount{
    width: 15%;
}
.sell-menu table #amount input{
    width: 100%;
}
.sell-menu table #price{
    width: 35%;
}
.sell-menu table #delete{
    width: 3%;
}
.sell-menu table #delete .btn{
    color:red;
    font-weight: 900;
}
/*****************************
*******Conclusion CSS*********
******************************/
.conclusion{
    position: relative;
    padding: 1em;
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
.conclusion .conclusion-info h5{
    font-weight: bold;
    font-size: 120%;
    display: inline;
}
.conclusion .conclusion-info p{
    padding-left: 3em;
    color:darkgreen
}
</style>