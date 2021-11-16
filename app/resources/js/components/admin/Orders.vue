<template>
  <div id="non">
  <v-data-table
    :headers="headers"
    :items="receipts"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title class="info--text" >ORDERS LIST</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog 
          v-model="dialog"
          max-width="500px"
        >
          <v-card  id="page"> 
            <v-card-title class="bg-info mx-auto"> 
              <span class="text-h5 mx-auto white--text" >RECEIPT DETAILS</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <div class="clear">
                    <div class="column2" style="margin-bottom: 5px;">
                        <span><b>customer:</b></span>
                        <span>Dung Kun</span>
                    </div>   
                    <div class="column2">
                        <span><b>email:</b></span>
                        <span>vandungkitty@gmail.com</span>
                    </div>  
                </div>      
                <v-data-table
                  v-model="tableDetail"
                  :headers="headDetail"
                  :items="tableDetail"
                  hide-default-footer
                  class="elevation-1"
                ></v-data-table>
              </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <b-button  pill variant="info" @click ="close">Cancel</b-button>
                <b-button  pill variant="info" @click ="printDetail">Print</b-button>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <b-button 
      variant="outline-info" 
      class="hovertext" 
      @click="editItem(item)"
      >Detail</b-button>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
  </div>
</template>

<style scoped>
  .hovertext:hover {
    color: white;
  }
</style>

<script>
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      receipts: [],
      receiptdetails: [],
      products:[],
      customers:[],
      tableDetail:[
        {
          name: "Máy rung",
          units: 10,
          total: 2000,
        },
        {
          name: "Máy rung",
          units: 10,
          total: 2000,
        },
        {
          name: "Máy rung",
          units: 10,
          total: 2000,
        },
      ],
      search: "",
      editingItem: null,
      addingProduct: null,
      lazy: `https://goo.gl/jbJWmK`,
      headDetail: [
        {
          text: "Product",
          align: "left",
          sortable: false,
          value: "name",
          class: "info--text",
        },
        { text: "Units", value: "units", class: "info--text" },
        { text: "Total", value: "total", class: "info--text" },
      ],
      headers: [
        {
          text: "ID orders",
          align: "left",
          sortable: false,
          value: "_id",
          class: "info--text",
        },
        { text: "Total", value: "total", class: "info--text" },
        { text: "VAT", value: "VAT", class: "info--text" },
        { text: "Creation date", value: "createDay", class: "info--text" },
        { text: "Detail", value: "actions", sortable: false, class: "info--text" },
      ],
      editedIndex: -1,
      detailIndex: -1, 
      customerIndex: -1,
      detailItem:[],
      editedItem: {
        name: "",
        units: 0,
        price: 0,
        image: null,
        description: "",
      },
      defaultItem: {
        name: "",
        units: 0,
        price: 0,
        image: null,
        description: "",
      },
    }),

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
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
        var newstr = document.getElementById('non').innerHTML;
        var data = document.getElementById('page').innerHTML;
        document.body.innerHTML = data;
        window.print()
        // Reload the page to refresh the data
        window.location.reload()
      },
      editItem (item) {
        // lay index cua receipt detail 
        this.detailIndex = this.receiptdetails.map(function(e){
          return e.receipt_id;
        }).indexOf(item._id);
        this.detailItem = Object.assign({}, this.receiptdetails[this.detailIndex]);

        // lay index cua product
        this.editedIndex = this.products.map(function(e){
          return e._id;
        }).indexOf(this.detailItem.product_id);
        this.editedItem = Object.assign({}, this.products[this.editedIndex]);

        // lay index cua customer 
        this.customerIndex = this.customers.map(function(e){
          return e._id;
        }).indexOf(item.user_id);
        this.dialog = true
      },
      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.products[this.editedIndex], this.editedItem)
        } else {
          this.products.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>

