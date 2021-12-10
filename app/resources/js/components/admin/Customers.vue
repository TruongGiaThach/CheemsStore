<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
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
        :items="customers"
        :search="search"
        :footer-props="{
          itemsPerPageOptions: [10, 20, 50, 100, -1],
          itemsPerPageText: 'Số lượng',
          pageText: '{0}-{1} trên {2}',
        }"
        item-key="email"
        rounded-xl
        class="elevation-1"
        min-height="70vh"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title class="info--text">Khách hàng</v-toolbar-title>
            <v-divider inset class="mx-4" vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Tìm kiếm khách hàng"
              single-line
              hide-details
            ></v-text-field>
            <v-dialog
              v-model="dialog"
              max-height="100vh"
              max-width="100vh"
              fullscreen
              hide-overlay
              transition="dialog-bottom-transition"
              scrollable
            >
              <v-card
                class="p-3 m-2 overflow-x-hidden"
                max-height="inherit"
                max-width="inherit"
              >
                <div id="receipt_page">
                   
                  <v-card-title class="bg-info mx-auto" max-width="inherit" >
                    <v-card-actions max-width="inherit">
                      <v-spacer></v-spacer>
                      <v-btn pill color="normal" @click="close">Trở về </v-btn>
                    </v-card-actions>
                    <span class="text-h5 mx-auto white--text">
                      HÓA ĐƠN ĐÃ MUA</span
                    >
                   
                  </v-card-title>

                  <v-data-table
                    style="
                      height: 91vh;
                      overflow: auto;
                      width: 80%;
                      align: center;
                      margin-left: auto;
                      margin-right: auto;
                    "
                    max-width="inherit"
                    :headers="headers_receipt"
                    :items="receipts"
                    hide-default-footer
                    class="elevation-1"
                    @click:row="clickRow"
                    item-key="_id.$oid"
                  >
                    <template v-slot:no-data>
                      <b-button
                        variant="info"
                        @click="getDataToTable(selectedCustomer)"
                      >
                        Reset
                      </b-button>
                    </template>
                    <template v-slot:[`item.actions`]="{ item }">
                      <b-button
                        variant="outline-info"
                        class="hovertext"
                        @click="getListReceiptDetail(item)"
                        >Xem chi tiết
                      </b-button>
                    </template>
                  </v-data-table>
                  <v-dialog
                    v-model="detail_dialog"
                    max-height="100vh"
                    max-width="100vh"
                    scrollable
                    transition="dialog-bottom-transition"
                  >
                    <v-card
                      class="p-3 m-2 overflow-x-hidden"
                      max-height="inherit"
                      max-width="inherit"
                    >
                      <div>
                        <v-card-title
                          class="bg-info mx-auto"
                          max-width="inherit"
                        >
                          <span class="text-h5 mx-auto white--text">
                            CHI TIẾT HÓA ĐƠN</span
                          >
                        </v-card-title>
                        <v-container fluid>
                          <v-data-table
                            :items="details"
                            :headers="detail_header"
                            hide-default-footer
                            class="elevation-1"
                            max-width="inherit"
                          >
                            <p>{{ details }}</p>
                          </v-data-table>
                        </v-container>
                      </div>
                    </v-card>
                  </v-dialog>
                </div>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>

        <!-- -->
        <template v-slot:[`item.actions`]="{ item }">
          <b-button
            variant="outline-info"
            class="hovertext"
            @click="getDataToTable(item)"
            >Xem hóa đơn
          </b-button>
        </template>
        <!-- reload -->
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize"> Reset </v-btn>
        </template>
      </v-data-table>
    </div>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      headers: [
        {
          text: "Tên khách hàng",
          align: "start",
          sortable: false,
          value: "name",
          class: "info--text",
        },
        { text: "Email", value: "email", class: "info--text" },
        { text: "Số điện thoại", value: "number", class: "info--text" },
        {
          text: "Hóa đơn",
          value: "actions",
          sortable: false,
          class: "info--text",
        },
      ],
      headers_receipt: [
        {
          text: "ID Hóa đơn",
          align: "left",
          sortable: false,
          value: "_id.$oid",
          class: "info--text",
        },
        { text: "Tổng (đ)", value: "total", class: "info--text" },
        { text: "VAT (đ)", value: "VAT", class: "info--text" },
        { text: "Ngày tạo", value: "createDay", class: "info--text" },
        { text: "Chi tiết", value: "actions", class: "info--text" },
      ],
      detail_header: [
        {
          text: "ID",
          align: "left",
          sortable: false,
          value: "_id.$oid",
          class: "info--text",
        },
        { text: "Tên sản phẩm", value: "product_name", class: "info--text" },
        { text: "Số lượng", value: "amount", class: "info--text" },
        { text: "Đơn giá", value: "unitPrice", class: "info--text" },
      ],
      state: true,
      selectedReceipt: null,
      customers: [],
      receipts: [],
      selectedCustomer: null,
      dialog: false,
      editedIndex: -1,
      expanded: [],
      singleExpand: true,
      details: [],
      detail_dialog: false,
    };
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    detail_dialog(val) {
      val || this.closeDetail();
    },
  },

  created() {
    this.initialize();
  },
  beforeMount() {
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
    initialize() {
      axios
        .get("/api/customer")
        .then((response) => {
          this.customers = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getDataToTable(item) {
      // get customer receipt
      this.selectedCustomer = item;
      console.log(item._id);
      axios
        .post("/api/receipts", { customerID: item._id })
        .then((response) => {
          this.receipts = response.data.receipt;
          console.log(this.receipts);
        })
        .catch((error) => {
          console.error(error);
        });

      this.dialog = true;
    },
    async getListReceiptDetail(item) {
      await axios
        .post("/api/receipt_details", { receiptID: item._id.$oid })
        .then((response) => {
          console.log(response.data.receipt_details);
          this.details = response.data.receipt_details;
        })
        .catch((error) => {
          console.error(error);
        });
      this.detail_dialog = true;
    },
    close() {
      this.dialog = false;
    },
    closeDetail() {
      this.detail_dialog = false;
    },
    async clickRow(item, event) {
      if (event.isExpanded) {
        await this.getListReceiptDetail(item);
        const index = this.expanded.findIndex((i) => i === item);
        this.expanded.splice(index, 1);
      } else {
        this.expanded.push(item);
      }
    },
  },
};
</script>