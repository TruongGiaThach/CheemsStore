<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="receipts"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title class="info--text">ORDERS LIST</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <v-card id="page" class="p-3 m-2 overflow-x-hidden" max-width="500px">
              <v-card-title class="bg-info mx-auto" max-width="500px">
                <span class="text-h5 mx-auto white--text">RECEIPT DETAILS</span>
              </v-card-title>

              <v-card-text max-width="500px">
                <v-container>
                  <div class="clear">
                    <div class="column2">
                      <h3>Cheems #ID bill</h3>
                      <p><b>Ngày thanh toán :</b> {{ createDay }}</p>
                    </div>
                    <div>
                      <div class="column2 align-right">
                        <p style="left: 0px; margin-top: 5px">
                          <b>Trạng thái:</b>Đã thanh toán
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="clear">
                    <div class="column2" style="margin-bottom: 5px">
                      <span><b>customer:</b></span>
                      <span>{{ customerItem.name }}</span>
                    </div>
                    <div class="column2">
                      <span><b>email:</b></span>
                      <span>{{ customerItem.email }}</span>
                    </div>
                  </div>
                  <v-data-table max-width="500px"
                    v-model="tableDetail"
                    :headers="headDetail"
                    :items="tableDetail"
                    hide-default-footer
                    class="elevation-1 "
                  ></v-data-table>
                  <br />
                  <div class="column2">
                    <span><h5>Tổng:</h5></span>
                    <span>{{ total }}</span>
                  </div>
                </v-container>
              </v-card-text>
              <v-card-actions max-width="500px">
                <v-spacer></v-spacer>
                <b-button pill variant="info" @click="close">Cancel</b-button>
                <b-button pill variant="info" @click="printDetail">Print</b-button>
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
        text: "Product",
        align: "left",sortable: false, value: "name", class: "info--text",
      },
      { text: "Amount", value: "amount", class: "info--text" },
      { text: "Total", value: "total", class: "info--text" },
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

