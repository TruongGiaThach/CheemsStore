<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-card-title>
      <v-spacer></v-spacer>
    </v-card-title>
    <div
      style="width: 80%; align: center; margin-left: auto; margin-right: auto"
    >
      <v-data-table
        :headers="headers"
        :items="customers"
        :search="search"
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
            <v-dialog v-model="dialog" max-height="100vh" max-width="100vh">
              <v-card
                class="p-3 m-2 overflow-x-hidden"
                max-height="inherit"
                max-width="inherit"
              >
                <div id="receipt_page">
                  <v-card-title class="bg-info mx-auto" max-width="inherit">
                    <span class="text-h5 mx-auto white--text">
                      HÓA ĐƠN ĐÃ MUA</span
                    >
                  </v-card-title>

                  <v-data-table
                    max-width="inherit"
                    :headers="headers_receipt"
                    :items="receipts"
                    hide-default-footer
                    class="elevation-1"
                  >
                    <template v-slot:no-data>
                      <b-button
                        variant="info"
                        @click="getDataToTable(selectedCustomer)"
                      >
                        Reset
                      </b-button>
                    </template>
                  </v-data-table>
                </div>
                <v-card-actions max-width="inherit">
                  <v-spacer></v-spacer>
                  <v-btn pill color="primary" @click="close">Thoát </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>

        <!-- -->
        <template v-slot:[`item.actions`]="{ item }">
          <b-button variant="outline-info" class="hovertext" @click="getDataToTable(item)"
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
          text: "Chi tiết hóa đơn",
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
      ],
      state: true,

      customers: [],
      receipts: [],
      selectedCustomer: null,
      dialog: false,
      editedIndex: -1,
      expanded: [],
      singleExpand: true,
    };
  },

  watch: {
    dialog(val) {
      val || this.close();
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
      // get customer receipt detail
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
    close() {
      this.dialog = false;
    },
  },
};
</script>