<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="receipts"
      :search="search"
      sort-by="calories"
      class="elevation-1"
    >
    <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title class="info--text">DANH SÁCH HÓA ĐƠN</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
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
                            <h3>Cheems #ID bill</h3>
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
                            <span>{{ customerItem.name }}</span>
                            </div>
                            <div class="column2">
                            <span><b style="display:inline">email:</b></span>
                            <span>{{ customerItem.email }}</span>
                            </div>
                        </div>
                        <v-data-table max-width="inherit"
                            v-model="tableDetail"
                            :headers="headDetail"
                            :items="tableDetail"
                            hide-default-footer
                            class="elevation-1 "
                        ></v-data-table>
                        <br />
                        <div class="column2">
                            <span><h5 style="display:inline">Tổng:</h5></span>
                            <span ><b style="color: green; font-size: 110%">{{ total }} VNĐ</b></span>
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
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <b-button
          variant="outline-info"
          class="hovertext"
          @click="getDataToTable(item)"
          >Detail</b-button
        >
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
.non  {
    position: fixed;
}
</style>

<script>
export default {
  data: () => ({
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
        text: "Tên Sản Phẩm",
        align: "left",sortable: false, value: "name", class: "info--text", width:"50vh"
      },
      { text: "Số lượng", value: "amount", class: "info--text",width:"20vh"},
      { text: "Đơn giá", value: "total", class: "info--text" },
    ],
    headers: [
      {
        text: "ID orders",
        align: "left",sortable: false,value: "_id",class: "info--text",
      },
      { text: "Total", value: "total", class: "info--text" },
      { text: "VAT", value: "VAT", class: "info--text" },
      { text: "Creation date", value: "createDay", class: "info--text" },
      {
        text: "Detail",
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
    createDay: '',
    billId:'',
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
    printDetail(){
        this.dialog=true;
        window.print('page');
      },
    getDataToTable(item) {
      console.log(item)
      this.tableDetail = [];
      this.total = item.total;
      this.createDay =item.createDay;
      this.billId = item._id.toString();
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
          total: element.unitPrice,
        });
      });
      console.log(this.tableDetail);

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

