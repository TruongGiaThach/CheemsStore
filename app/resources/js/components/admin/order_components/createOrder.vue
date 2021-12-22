<template>
  <v-app class="create-order">
    <!--Product Search-->
    <v-card class="product-search-menu">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <v-select class="category-select"
            :menu-props="{ bottom: true, offsetY: true }"
            outlined
            dense
            label="Tất cả"
            v-model="category_sort"
            :items="category"
            item-text="name"
            item-value="_id"
            return-object        
            single-line
          ></v-select>
          </ul>
          <div class="form-inline search-box">
            <input
              class="form-control mr-sm-2"
              v-model="search"
              type="search"
              placeholder="Nhập từ khóa cần tìm"
              aria-label="Search"
              size="50"
            />
          </div>
        </div>
      </nav>
      <!--Product List-->
      <v-container class="products-showcase">
        <span
          class="box-container"
          v-for="(product, index) in filteredProducts"
          :key="index"
          v-on:click="addItemToBill(product)"
          disable
        >
          <v-card class="product-box">
            <div>
              <div class="price">
                {{ Number(product.outportPrice).toLocaleString() }} VNĐ
              </div>
            </div>
            <div>
              <img :src="baseUrl + '/images/' + product.image" />
            </div>
            <div>
              <p id="name">{{ product.name }}</p>
            </div>
            <div
              class="amount"
              :style="'background-color :' + chooseColor(product.amount)"
            >
              {{ chooseText(product.amount) }}
            </div>
          </v-card>
        </span>
      </v-container>
    </v-card>
    <v-card class="sell-menu">
      <div class="customer-info">
        <form>
          <div class="form-row">
            <div class="form-group col-md-8">
              <input
                type="text"
                v-model="c_name"
                class="form-control"
                id="NameInput"
                placeholder="Tên khách hàng"
              />
            </div>
            <div class="form-group form-group col-md-4">
              <input
                type="text"
                v-model="c_number"
                class="form-control"
                id="NumberInput"
                maxlength="10"
                placeholder="Số điện thoại"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
              />
            </div>
          </div>

          <div class="form-group">
            <input
              type="email"
              v-model="c_email"
              class="form-control"
              id="EmailInput"
              placeholder="Địa chỉ email"
            />
          </div>
        </form>
      </div>
      <!--Bill Product List-->
      <div class="product-list">
        <v-data-table
          class="table table-responsive"
          :headers="headDetail"
          :items="items"
          hide-default-footer
        >
          <template v-slot:item="row">
            <tr>
              <td>{{ row.item.name }}</td>
              <td>
                <v-form>
                  <v-icon
                    small
                    style="color: green"
                    @click="plusItem(row.index)"
                    >mdi-plus</v-icon
                  >
                  <input
                    type="number"
                    v-model="row.item.amount"
                    min="1"
                    onkeydown="return false"
                  />
                  <v-icon small style="color: red" @click="minusItem(row.index)"
                    >mdi-minus</v-icon
                  >
                </v-form>
              </td>
              <td>{{ Number(row.item.price).toLocaleString() }}</td>
              <td>
                <v-btn
                  class="mx-2"
                  fab
                  dark
                  x-small
                  color="red"
                  v-on:click="deleteItem(row.index)"
                >
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
            <h5>
              Tổng tiền (VNĐ):
              <p>{{ Number(totalPrice).toLocaleString() }} </p>
            </h5>
            <h5>
              Thuế VAT (VNĐ):
              <p>{{ Number(vat).toLocaleString() }} </p>
            </h5>
            <h5>
              Phải trả (VNĐ):
              <p>{{ Number(endPrice).toLocaleString() }} </p>
            </h5>
          </span>
        </div>
        <div class="conclusion-buttons">
          <button
            type="button"
            class="btn btn-danger btn-block btn-cancel"
            v-on:click="close()"
          >
            Hủy
          </button>
          <button
            type="button"
            class="btn btn-success btn-block btn-finish py-5"
            data-target="#ConfirmModal"
            v-bind:disabled="!okToGo"
            v-on:click="checkExistingCustomer()"
          >
            Thanh toán
          </button>
        </div>
        <!-- Modal -->
        <v-dialog v-model="dialog" max-height="100vh" max-width="100vh">
          <v-card
            class="p-3 m-2 overflow-x-hidden"
            max-height="inherit"
            max-width="inherit"
          >
            <div id="page">
              <v-card-title class="bg-info mx-auto" max-width="inherit">
                <span class="text-h5 mx-auto white--text">
                  THÔNG TIN HÓA ĐƠN</span
                >
              </v-card-title>

              <v-card-text style="right: 0px" max-width="inherit">
                <v-container>
                 <div class="clear">
                          <div class="column2">
                            <h5><b>CheemsStore</b></h5>
                          </div>
                            <div class="column2" style="text-align: left;">
                              <p style="margin-top: 5px; display: inline">
                                <b>Trạng thái:</b>Đã thanh toán
                              </p>
                          </div>
                        </div>
                        <div class="clear">
                            <h5><b>ID: </b> {{billId}}</h5>
                        </div>
                        <hr style="margin-left: 20px; margin-right: 37vh; color: #2196f3;">
                  <div class="clear">
                            <p style="display: inline">
                              <b>Ngày thanh toán :</b> {{ createDay }}
                            </p>
                          <div class="marginheadLine">
                            <span
                              ><b style="display: inline">Khách hàng:</b></span
                            >
                            <span>{{ c_name }}</span>
                          </div>
                          <div class="marginheadLine">
                            <span><b style="display: inline">Email:</b></span>
                            <span>{{ c_email }}</span>
                          </div>
                          <div class="marginheadLine">
                            <span><b style="display: inline">Sđt:</b></span>
                            <span>{{ c_number }}</span>
                          </div>
                        </div>
                  <v-data-table
                    max-width="inherit"
                    v-model="items_print"
                    :headers="receiptDetail"
                    :items="items_print"
                    hide-default-footer
                    class="elevation-1"
                  ></v-data-table>
                  <br />
                  <div class="column2">
                    <span><h5 style="display: inline">Tổng (VNĐ):</h5></span>
                    <span
                      ><b style="color: #2196f3; font-size: 110%"
                        >{{ Number(endPrice).toLocaleString() }} </b
                      ></span
                    >
                  </div>
                  <div class="column2">
                    <span><h5 style="display: inline">VAT (VNĐ):</h5></span>
                    <span
                      ><b style="color: #2196f3; font-size: 110%"
                        >{{ Number(vat).toLocaleString() }} </b
                      ></span
                    >
                  </div>
                </v-container>
              </v-card-text>
            </div>
            <v-card-actions max-width="inherit">
              <v-spacer></v-spacer>
              <b-button pill variant="info" @click="close">Hủy</b-button>
              <b-button pill variant="info" @click="printDetail"
                >In hóa đơn</b-button
              >
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog width="300px" v-model="outOfStock">
          <v-card>
            <v-card-title class="text-h4 red">
              <span class="text-h4 mx-auto white--text">HẾT HÀNG</span>
            </v-card-title>
          </v-card>
        </v-dialog>
      </div>
    </v-card>
  </v-app>
</template>
<script>
export default {
  name: "create-order",
  data() {
    return {
      staff: [],
      outOfStock: false,
      baseUrl: window.location.origin,
      products: [],
      category: [],
      items: [],
      items_print: [],
      category_sort: {
        name: "Tất cả",
        _id: "0",
      },
      havetoprice: 0,
      search: "",
      c_id: "",
      c_name: "",
      c_number: "",
      c_email: "",
      // receipt detail
      dialog: false,
      total: 0,
      VAT: 0,
      Payment: 0,
      createDay: "",
      billId: "",
      headDetail: [
        {
          text: "Tên Sản Phẩm",
          align: "left",
          sortable: false,
          value: "name",
          class: "info--text",
        },
        { text: "Số lượng", value: "amount", class: "info--text" },
        { text: "Đơn giá (VNĐ)", value: "price", class: "info--text" },
      ],
      receiptDetail: [
        {
          text: "Tên Sản Phẩm",
          align: "left",
          sortable: false,
          value: "name",
          class: "info--text",
          width: "50vh",
        },
        {
          text: "Số lượng",
          value: "amount",
          class: "info--text",
          width: "15vh",
        },
        { text: "Đơn giá (VNĐ)", value: "price", class: "info--text" },
      ],
    };
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  beforeMount() {
    axios
      .get("/api/products/")
      .then((response) => {
        this.products = response.data.filter((element) => {
          return element.amount > 0;
        });
      })
      .catch((error) => {
        console.error(error);
      });

    axios
      .get("/api/category/")
      .then((response) => {
        this.category = response.data;
        this.category.unshift(this.category_sort);
      })
      .catch((error) => {
        console.error(error);
      });
      let user = JSON.parse(localStorage.getItem("bigStore.user"));
      axios.get(`/api/getStaffs/${user.email}`).then((response) => {
      this.staff = response.data;
    });
  },
  computed: {
    filteredProducts() {
      return this.products.filter((product) => {
        if (this.sameCategory(product))
          return (
            product.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
          );
      });
    },
    totalPrice() {
      var total = 0;
      if (this.items.length > 0) {
        for (var i = 0; i < this.items.length; i++) {
          total += parseInt(this.items[i].amount * this.items[i].price);
        }
      }
      this.total = total;
      return this.total;
    },
    vat() {
      this.VAT = (this.totalPrice * 0.1).toFixed(1);
      return this.VAT;
    },
    endPrice() {
      this.Payment = parseInt(this.totalPrice) + parseFloat(this.VAT);
      return this.Payment;
    },
    okToGo() {
      if (
        this.c_name != "" &&
        this.c_number.length == 10 &&
        this.c_email != "" &&
        this.items.length > 0
      ) {
        return true;
      } else return false;
    },
  },
  methods: {
    chooseColor(item) {
      if (Number(item) < 1) {
        return "red";
      } else return "green";
    },
    chooseText(item) {
      if (Number(item) < 1) {
        return "Hết hàng";
      } else return "Số lượng: " + item;
    },
    addItemToBill(product) {
      if (product.amount > 0) {
        if (this.items.length > 0) {
          for (var i = 0; i < this.items.length; i++) {
            if (this.items[i].id == product._id) {
              this.items[i].amount++;
              product.amount -= 1;
              return;
            }
          }
          this.items.push({
            id: product._id,
            name: product.name,
            amount: 1,
            price: product.outportPrice,
          });
        } else {
          this.items.push({
            id: product._id,
            name: product.name,
            amount: 1,
            price: product.outportPrice,
          });
        }
        product.amount -= 1;
      } else {
        this.outOfStock = true;
      }
    },
    deleteItem(index) {
      if (this.items.length > 0) {
        var indexProduct = this.products.findIndex(
          (element) => element._id === this.items[index].id
        );
        this.products[indexProduct].amount += this.items[index].amount;
        this.items.splice(index, 1);
      }
    },
    plusItem(index) {
      if (this.items.length > 0) {
        var indexProduct = this.products.findIndex(
          (element) => element._id === this.items[index].id
        );
        if (this.products[indexProduct].amount > 0) {
          this.products[indexProduct].amount -= 1;
          this.items[index].amount += 1;
        } else {
          this.outOfStock = true;
        }
      }
    },
    minusItem(index) {
      if (this.items.length > 0) {
        var indexProduct = this.products.findIndex(
          (element) => element._id === this.items[index].id
        );
        this.products[indexProduct].amount += 1;
        this.items[index].amount -= 1;
        if (this.items[index].amount === 0) {
          this.items.splice(index, 1);
        }
      }
    },
    sameCategory(product) {
      if (this.category_sort.name == "Tất cả") {
        return true;
      } else if (this.category_sort._id == product.category_id) {
        return true;
      } else return false;
    },
    //Create new user for each new receipt with new email
    checkExistingCustomer() {
      this.updateProductAmount()
      axios
        .get("/api/customer/")
        .then((response) => {
          var length = response.data.length;
          for (var i = 0; i < length; i++) {
            if (response.data[i].email == this.c_email) {
              return this.addRecepit(response.data[i]);
            }
          }
          return this.newCustomer();
        })
        .catch((error) => {
          console.error(error);
        });
    },
    updateProductAmount() {
      this.products.forEach((element) => {
        axios
          .post(`/api/productUpdate/${element._id}`, {
            amount: element.amount,
          })
      });
    },
    newCustomer() {
      axios
        .post("/api/customer/", {
          name: this.c_name,
          email: this.c_email,
          number: this.c_number,
        })
        .then((response) => {
          this.addRecepit(response.data);
        });
    },
    addRecepit(item) {
      let day = this.addHoursAndDays();
      axios
        .post("/api/receipt/", {
          user_id: item._id.toString(),
          createDay: day,
          total: this.Payment,
          VAT: this.VAT,
          staff_id: this.staff._id,
        })
        .then((response) => {
          this.addRecepitDetail(response.data);
          this.addItemToPrint();
          this.dialog = true;
        });
    },
    addRecepitDetail(rec) {
      this.billId = rec._id;
      this.createDay = rec.createDay;
      var length = this.items.length;
      for (var i = 0; i < length; i++) {
        axios.post("/api/receipt_detail/", {
          receipt_id: rec._id.toString(),
          product_id: this.items[i].id.toString(),
          unitPrice: this.items[i].price,
          amount: this.items[i].amount,
        });
      }
    },
    addItemToPrint() {
      var length = this.items.length;
      for (var i = 0; i < length; i++) {
        this.items_print.push({
          id: this.items[i].id,
          name: this.items[i].name,
          amount: this.items[i].amount,
          price: Number(this.items[i].price).toLocaleString(),
        });
      }
    },
    printDetail() {
      this.dialog = true;
      window.print("page");
      window.location.reload();
    },
    close() {
      this.dialog = false;
      window.location.reload();
    },
    addHoursAndDays() {
      let day = new Date();
      let date =
        day.getDate().toString() +
        "/" +
        (day.getMonth()+1) +
        "/" +
        day.getFullYear();
      let hours =
        day.getHours() + ":" + day.getMinutes() + ":" + day.getSeconds() + "  ";
      return hours + date;
    },
  },
};
</script>
<style scoped>
/***********************
*******Body CSS*********
************************/
.create-order {
  position: relative;
  height: 100vh;
}
.product-search-menu {
  position: relative;
  height: 100%;
  width: 60%;
  display: inline-block;
}
.sell-menu {
  position: absolute;
  right: 0;
  max-height: 100%;
  height: 100%;
  width: 40%;
  overflow: hidden;
}
/*******************************
*******Product menu CSS*********
********************************/
.product-search-menu .navbar {
  height: 7%;
}
.product-search-menu .category-select{
  margin-top: 3em;
  max-width: 16em;
}
.product-search-menu .products-showcase {
  height: 93%;
  overflow: auto;
}
.product-search-menu .box-container {
  position: relative;
  width: 20%;
  display: inline-block;
}
.product-search-menu .product-box {
  margin: 0.15em;
  border: solid 0.04em rgba(128, 128, 128, 0.4);
  background-color: white;
  overflow: hidden;
}
.product-search-menu .product-box:active {
  transform: scale(0.95);
  box-shadow: 0.4em 0.4em 0.2em grey;
}
.product-search-menu .product-box .price {
  position: absolute;
  left: 0;
  background-color: #2196f3;
  color: white;
  font-weight: bold;
  padding-right: 0.2em;
  padding-left: 0.4em;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}
.product-search-menu .product-box .amount {
  color: white;
  font-weight: bold;
  padding-left: 0.4em;
}
.product-search-menu .product-box img {
  height: 9em;
  width: 9em;
}
.product-search-menu .product-box p {
  color: rgb(100, 100, 100);
  height: 2.87em;
  overflow: hidden;
  font-weight: bold;
}
.product-search-menu .product-box #name{
  padding:0.2em; 
  display: -webkit-box !important;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  white-space: normal;
}
/****************************
*******Sell menu CSS*********
*****************************/
.sell-menu {
  border-left: solid 0.2em #2196f3;
  display: table;
}
.customer-info,
.product-list,
.conclusion {
  min-height: 10%;
}
.sell-menu .customer-info { 
  position: relative;
  padding-left: 1em;
  padding-right: 1em;
  top: 0;
}
.sell-menu .product-list {
  position: relative;
  height: 60%;
  overflow: scroll;
}
.sell-menu .conclusion {
  width: 100%;
  position: absolute;
  bottom: 0;
  height: 22%;
  overflow: auto;
  background: rgba(0, 139, 139, 0.3);
}
.sell-menu .product-list input {
  width: 1.5em;
  margin: 0px;
}
.sell-menu .product-list tr:hover input {
  background-color: #eeeeee;
}

/*****************************
*******Conclusion CSS*********
******************************/
.conclusion {
  padding: 1em;
}
.conclusion .conclusion-info {
  position: relative;
  width: 80%;
  display: inline-block;
}
.conclusion .conclusion-buttons {
  position: absolute;
  width: 20%;
  display: inline-block;
}
.conclusion .conclusion-buttons .btn {
  font-weight: bold;
}
.conclusion .conclusion-buttons .btn-finish {
  height: 6em;
}
.conclusion .conclusion-info h5 {
  padding-bottom: 1em;
  font-weight: bold;
  font-size: 120%;
}
.conclusion .conclusion-info p {
  color: #2196f3;
  display: inline;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
