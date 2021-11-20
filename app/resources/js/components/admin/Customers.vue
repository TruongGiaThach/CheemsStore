<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3">
    <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Tìm kiếm khách hàng"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <div
      style="width: 80%; align: center; margin-left: auto; margin-right: auto"
    >
      <v-data-table
        :headers="headers"
        :items="customers"
        :search="search"
        :expanded.sync="expanded"
        :single-expand="singleExpand"
        show-expand
        @item-expanded="clickRow"
        item-key="email"
        rounded-xl
        class="elevation-1"
        min-height="70vh"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Khách hàng</v-toolbar-title>
            <v-divider inset class="mx-4" vertical></v-divider>
            <v-spacer></v-spacer>
          </v-toolbar>
        </template>
        <!-- expand 1 row -->
        <template v-slot:expanded-item="{ headers, item }">
          <td :colspan="headers.length">
            <v-container fluid>
              <v-row no-gutters>
                <table class="table_style">
                  <tr>
                    <h5>Thông tin các hóa đơn đã mua</h5>
                  </tr>
                  <tr>
                    <div v-for="(receipt, index) in item.receipts" :key="index">
                      <v-list class="text-justify">
                        <tr>
                          <td>Ngày tạo hóa đơn:</td>
                          <td>
                            {{ receipt.createDay }}
                          </td>
                        </tr>
                        <tr>
                          <td>VAT:</td>
                          <td>
                            {{ receipt.VAT }}
                          </td>
                        </tr>
                        <tr>
                          <td>Tổng tiền:</td>
                          <td>
                            {{ receipt.total }}
                          </td>
                        </tr>
                      </v-list>
                    </div>
                  </tr>
                </table>
              </v-row>
            </v-container>
          </td>
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
        },
        { text: "Email", value: "email" },
        { text: "Số điện thoại", value: "number" },
      ],
      state: true,
      customers: [],

      editingItem: null,
      addingUser: null,
      dialog: false,
      dialogDelete: false,
      editedIndex: -1,
      expanded: [],
      singleExpand: true,
      editedItem: {
        _id: "",
        name: "",
        email: "",
        cmnd: "",
        numOfDayOff: 0,
        salary: 0,
        dateBegin: new Date(Date.now()).toLocaleString().split(",")[0],
      },
      defaultItem: {
        _id: "",
        name: "",
        email: "",
        cmnd: "",
        numOfDayOff: 0,
        salary: 0,
        dateBegin: new Date(Date.now()).toLocaleString().split(",")[0],
      },
    };
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
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
    clickRow({ item }, event) {
      axios
        .get("/api/receipts", { customerID: item._id })
        .then((response) => {
          item.receipts = response.data;
          
        })
        .catch((response) => {});
    },
  },
};
</script>