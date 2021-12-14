<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-row full-width>
      <v-col cols="12" md="3" sm="3" style="margin-top: 13px">
        <v-row full-width class="mb-5">
          <v-card>
            <v-card-title class="pb-0"
              ><h5 class="title-number">Nhân viên tạo</h5>
              <v-spacer></v-spacer
              ><v-icon color="black"
                >mdi-account-cog-outline</v-icon
              ></v-card-title
            >
            <hr class="charlie ml-6 mr-6 mt-0 pt-0" />
            <h3 class="pb-4 title-number">{{nameStaff}}</h3>
          </v-card>
        </v-row>
        <v-row full-width>
          <v-card >
            <v-card-title class="pb-0"
              ><h5 class="title-number">Sản phẩm được bán</h5>
              <v-spacer></v-spacer
              ><v-icon color="black"
                >mdi-cart</v-icon
              ></v-card-title
            >
            <hr class="charlie ml-6 mr-6 mt-0 pt-0 mb-0" />
            <v-card-text>
            <v-timeline align-top dense>
              <v-timeline-item
                v-for="message in listProduct"
                :key="message.name"
                :color="message.color"
                small
              >
              <div class="product-list">{{ message.name }}</div>
              </v-timeline-item>
            </v-timeline>
            </v-card-text>
          </v-card>
        </v-row>
      </v-col>
      <v-col cols="12" md="9" sm="9">
        <v-data-table
          style="
            height: 91vh;
            overflow: auto;
            width: 100%;
            align: center;
            margin-left: auto;
            margin-right: auto;
          "
          :headers="headers"
          :items="receipts"
          :search="search"
          :footer-props="{
            itemsPerPageOptions: [10, 20, 50, 100, -1],
            itemsPerPageText: 'Số lượng',
            pageText: '{0}-{1} trên {2}',
          }"
          class="elevation-1"
          @click:row="handleClick"
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title style ="color:#2196f3;"
                >Danh sách hóa đơn</v-toolbar-title
              >
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>

              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Tìm kiếm"
                single-line
                hide-details
              ></v-text-field>

              <return-product @refundFinish="initialize" />
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
                            <span>{{ customerItem.name }}</span>
                          </div>
                          <div class="marginheadLine">
                            <span><b style="display: inline">Email:</b></span>
                            <span>{{ customerItem.email }}</span>
                          </div>
                          <div class="marginheadLine">
                            <span><b style="display: inline">Sđt:</b></span>
                            <span>{{ customerItem.number }}</span>
                          </div>
                        </div>
                        <v-data-table
                          max-width="inherit"
                          v-model="tableDetail"
                          :headers="headDetail"
                          :items="tableDetail"
                          hide-default-footer
                          class="elevation-1"
                        >
                          <template v-slot:[`item.actions`]="{ item }">
                            <v-menu
                              :close-on-content-click="true"
                              :nudge-width="200"
                              offset-x
                            >
                              <template v-slot:activator="{ on, attrs }">
                                <v-icon
                                  color="info"
                                  dark
                                  v-bind="attrs"
                                  v-on="on"
                                  >mdi-apps-box</v-icon
                                >
                              </template>

                              <v-card :color="item.color" dark>
                                <div
                                  class="
                                    d-flex
                                    flex-no-wrap
                                    justify-space-between
                                  "
                                >
                                  <v-avatar class="ma-4" size="140" tile>
                                    <v-img
                                      style="border-radius: 5px"
                                      :src="baseUrl + '/images/' + item.image"
                                    ></v-img>
                                  </v-avatar>
                                  <div>
                                    <v-card-title
                                      class="text-h5"
                                      v-text="item.name"
                                    ></v-card-title>

                                    <v-card-subtitle>
                                      <p>ID: {{ item.id }}</p>
                                      <p>
                                        Số lượng còn lại:
                                        {{ item.amountProduct }}
                                      </p>
                                      <p>
                                        Giá nhập vào: {{ item.importPrice }}
                                      </p>
                                    </v-card-subtitle>
                                  </div>
                                </div>
                              </v-card>
                            </v-menu>
                          </template>
                        </v-data-table>
                        <br />
                        <div class="column2">
                          <span><h5 style="display: inline">Tổng:</h5></span>
                          <span
                            ><b style="color: #2196f3; font-size: 110%">{{
                              total
                            }}</b></span
                          >
                        </div>
                        <div class="column2">
                          <span><h5 style="display: inline">VAT:</h5></span>
                          <span
                            ><b style="color: #2196f3; font-size: 110%">{{
                              VAT
                            }}</b></span
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
            </v-toolbar>
          </template>
          <template v-slot:[`item.actions`]="{ item }">
            <b-button
              variant="outline-info"
              class="hovertext"
              @click="getDataToTable(item)"
              >Chi tiết
            </b-button>
          </template>
          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize()"> Reset </v-btn>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>
.hovertext:hover {
  color: white;
}
.non {
  position: fixed;
}
</style>

<script>
import returnProduct from "./product_component/reuturnProduct_component/returnProdut.vue";

export default {
  data: () => ({
    colorsProduct: ['#2196f3','#F37E21'],
    nameStaff: '',
    listProduct: [],
    baseUrl: window.location.origin,
    fav: true,
    menu: false,
    message: false,
    hints: true,
    dialog: false,
    //receipts
    receipts: [],
    receiptdetails: [],
    products: [],
    customers: [],
    search: "",
    lazy: `https://goo.gl/jbJWmK`,
    headDetail: [
      {
        text: "",
        align: "left",
        sortable: false,
        value: "actions",
        class: "info--text",
        width: "10vh",
      },
      {
        text: "Tên Sản Phẩm",
        value: "name",
        class: "info--text",
        width: "40vh",
      },
      { text: "Số Lượng", value: "amount", class: "info--text", width: "15vh" },
      { text: "Đơn Giá", value: "total", class: "info--text" },
    ],
    headers: [
      {
        text: "ID Hóa đơn",
        align: "left",
        sortable: false,
        value: "_id",
        class: "info--text",
      },
      { text: "Tổng", value: "total", class: "info--text" },
      { text: "VAT", value: "VAT", class: "info--text" },
      { text: "Ngày tạo", value: "createDay", class: "info--text" },
      {
        text: "Chi tiết",
        value: "actions",
        sortable: false,
        class: "info--text",
      },
    ],
    editedIndex: -1,
    customerIndex: -1,
    detailItem: [],
    customerItem: {},
    defaultItem: {},
    //receipt detail
    tableDetail: [],
    total: 0,
    VAT: 0,
    createDay: "",
    billId: "",
  }),

  components: {
    returnProduct,
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  beforeMount() {
    this.initialize();
  },
  created(){
      this.initialize();
  },
  methods: {
    initialize() {
      axios
        .get("/api/receipt")
        .then((response) => {
          this.receipts = response.data;
          for (var i = 0; i < this.receipts.length; i++) {
            this.receipts[i].total =
              Number(this.receipts[i].total).toLocaleString() + " VNĐ";
            this.receipts[i].VAT =
              Number(this.receipts[i].VAT).toLocaleString() + " VNĐ";
          }
          this.receipts.reverse();
        })
        .catch((error) => {
          console.error(error);
        });
    },
    printDetail() {
      this.dialog = true;
      window.print("page");
    },
    async getDataToTable(item) {
      this.tableDetail = [];
      this.total = item.total;
      this.createDay = item.createDay;
      this.billId = item._id.toString();
      this.VAT = item.VAT;
      await axios
        .get("/api/getBill/"+ `${item._id}`)
        .then((response) => {
          this.detailItem = response.data.receipt_details;
          this.detailItem.forEach((element) => {
            this.tableDetail.push({
              name: element.product_name,
              amount: element.amount,
              total: Number(element.unitPrice).toLocaleString() + " VNĐ",
              importPrice: element.importPriceProduct,
              image: element.imageProduct,
              id: element._id,
              amountProduct: element.amountProduct,
              color: "info",
            });
          });
          console.log(this.tableDetail)
        })
        .catch((error) => {
          console.log(error.message);
        });
      // lay index cua customer
      axios
        .get("/api/getCustomer/" + `${item._id}`)
        .then((response) => {
          this.customerItem = response.data[0];
          console.log(response.data);
        })
        .catch((error) => {});
      this.dialog = true;
    },
    close() {
      this.dialog = false;
    },
    async handleClick(item)
    {
        this.listProduct =[];
        if(item.staff_id==null) {
            this.nameStaff ="Admin"
        } else {
        await axios.get('/api/getStaffWithID/'+`${item.staff_id}`).then((response)=>{
            this.nameStaff = response.data.name;
        });
        }
        let index= 0;
        await axios
        .get("/api/getBill/"+ `${item._id}`)
        .then((response) => {
            response.data.receipt_details.forEach((element)=>{
                if(index > 1) index = 0;
                this.listProduct.push({
                    name: element.product_name,
                    color: this.colorsProduct[index++],
                })
            })
        });
    }

  },
};
</script>
<style scoped>
.marginheadLine {
  margin-left: 15px;
}
.charlie {
  height: 0px;
  border-radius: 2px;
  color: #2196f3;
  border: 2px solid currentColor;
  width: 80%;
}
.title-number {
  text-align: center;
  font-weight: bold;
}
.product-list {
      font-weight: bold;
}
.card-title {
  font-weight: bold;
}
</style>

