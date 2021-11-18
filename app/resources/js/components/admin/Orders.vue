<template>
  <div>
    <v-data-table
      style="
        height: 91vh;
        overflow: auto;
        width: 80%;
        align: center;
        margin-left: auto;
        margin-right: auto;
      "
      :headers="headers"
      :items="receipts"
      :search="search"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title class="info--text"
            >DANH SÁCH HÓA ĐƠN</v-toolbar-title
          >
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
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
                        <h5>Cheems #ID {{ billId }}</h5>
                        <p style="display: inline">
                          <b>Ngày thanh toán :</b> {{ createDay }}
                        </p>
                      </div>
                      <div>
                        <div class="column2 align-left">
                          <p style="margin-top: 5px; display: inline">
                            <b>Trạng thái:</b>Đã thanh toán
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="clear">
                      <div class="column2" style="margin-bottom: 5px">
                        <span><b style="display: inline">Khách hàng:</b></span>
                        <span>{{ customerItem.name }}</span>
                      </div>
                      <div class="column2">
                        <span><b style="display: inline">Email:</b></span>
                        <span>{{ customerItem.email }}</span>
                      </div>
                      <div class="column2">
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
                            <v-icon color="info" dark v-bind="attrs" v-on="on"
                              >mdi-apps-box</v-icon
                            >
                          </template>

                          <v-card :color="item.color" dark>
                            <div
                              class="d-flex flex-no-wrap justify-space-between"
                            >
                              <v-avatar class="ma-4" size="140" tile>
                                <v-img
                                  style="border-radius: 5px"
                                  :src="require('../../../../public/images/' + item.image).default"
                                ></v-img>
                              </v-avatar>
                              <div>
                                <v-card-title
                                  class="text-h5"
                                  v-text="item.name"
                                ></v-card-title>

                                <v-card-subtitle>
                                  <p>ID: {{ item.id }}</p>
                                  <p>Số lượng còn lại: {{ item.amount }}</p>
                                  <p>Giá nhập vào: {{ item.importPrice }}</p>
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
        <v-btn color="primary"> Reset </v-btn>
      </template>
    </v-data-table>
  </div>
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
export default {
  data: () => ({
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
        text: "ID Sản Phẩm",
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

  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  beforeMount() {
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
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get("/api/products")
      .then((response) => {
        this.products = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get("/api/receipt_detail")
      .then((response) => {
        this.receiptdetails = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get("/api/customer")
      .then((response) => {
        this.customers = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    printDetail() {
      this.dialog = true;
      window.print("page");
    },
    getDataToTable(item) {
      console.log(item);
      this.tableDetail = [];
      this.total = item.total;
      this.createDay = item.createDay;
      this.billId = item._id.toString();
      this.VAT = item.VAT;
      // lay  receipt detail
      this.detailItem = this.receiptdetails.filter((e) => {
        return e.receipt_id === item._id;
      });
      console.log(this.detailItem);

      // lay  product and table detail
      this.detailItem.forEach((element) => {
        this.defaultItem = this.products.filter((e) => {
          return e._id === element.product_id;
        })[0];
        this.tableDetail.push({
          name: this.defaultItem.name,
          amount: element.amount,
          total: Number(element.unitPrice).toLocaleString() + " VNĐ",
          importPrice: this.defaultItem.importPrice,
          image: this.defaultItem.image,
          id: this.defaultItem._id,
          color: "info",
        });
      });
      console.log(this.tableDetail[0].image);

      // lay index cua customer
      this.customerIndex = this.customers
        .map(function (e) {
          return e._id;
        })
        .indexOf(item.user_id);
      if (this.customerIndex != -1)
        this.customerItem = this.customers[this.customerIndex];
      console.log(this.customerItem);
      this.dialog = true;
    },
    close() {
      this.dialog = false;
    },
  },
};
</script>

