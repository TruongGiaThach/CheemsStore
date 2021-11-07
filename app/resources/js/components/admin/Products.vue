<template>
  <v-card
    height="100%"
    outlined
    class="pa-md-4 mx-lg-auto grey lighten-3">
  <v-data-table
    :headers="headers"
    :items="products"
    :search="search"
    :expanded.sync="expanded"
    :single-expand="singleExpand"
    item-key="name"
    show-expand
    rounded-xl
    class="elevation-1"
    min-height="100vh"
    @click:row="clickRow"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Products</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              New Item
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Product Name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.units"
                      label="Amount"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.price"
                      label="Price"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      v-model="editedItem.description"
                      color="teal"
                    >
                      <template v-slot:label>
                        <div>
                        Description <small>(optional)</small>
                        </div>
                      </template>
                    </v-textarea>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h6">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template #expanded-item="{ headers, item }">
      <td :colspan="headers.length">
        <v-row>
          <v-col cols="12" md="4">
            <v-img
              :src="item.poster"
              :lazy-src="lazy">

            </v-img>
          </v-col>
          <v-col cols="12" md="8">
            <h3> {{ item.name }} </h3>
            <p class="text-justify">
              {{ item.description }}
            </p>
          </v-col>
        </v-row>
      </td>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <h6 class="text-center"> 
          No data found!
      </h6>
      <v-btn
        small
        fab
        @click="initialize"
      >
        <v-icon dark>
            mdi-restart
        </v-icon>
      </v-btn>
    </template>
  </v-data-table>
  </v-card>
</template>

<script>
    import Modal from './ProductModal'
	export default {
        data(){
            return {
                products : [],
                search: '',
                editingItem : null,
                addingProduct : null,
                dialog: false,
                dialogDelete: false,
                lazy: `https://goo.gl/jbJWmK`,
                expanded: [],
                singleExpand: true,
                headers: [
                    {
                      text: 'Name',
                      align: 'left',
                      sortable: false,
                      value: 'name',
                    },
                    { text: 'Units', value: 'units' },
                    { text: 'Price', value: 'price' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    units: 0,
                    price: 0,
                    image: null,
                    description: '',
                },
                defaultItem: {
                    name: '',
                    units: 0,
                    price: 0,
                    image: null,
                    description: '',
                },
            }
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
            val || this.closeDelete()
            },
        },

        created () {
            this.initialize()
        },

        beforeMount(){
            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })     
        },
        methods : {
            clickRow(item, event) {
              if(event.isExpanded) {
                const index = this.expanded.findIndex(i => i === item);
                this.expanded.splice(index, 1)
              } else {
                this.expanded.push(item);
              }
            },
            initialize () {
                axios.get('/api/products/')
                .then(response => {
                    this.products = response.data
                })
                .catch(error => {
                    console.error(error);
                })  
            },

            newProduct(){
                this.addingProduct = {
                    name : null, 
                    units : null, 
                    price : null,
                    description : null,
                    image : null
                }
            },
            endEditing(product){
                this.editingItem = null
                let index = this.products.indexOf(product)
                axios.put(`/api/products/${product.id}`,{
                    name  : product.name,
                    units : product.units,
                    price : product.price,
                    description : product.description,
                })
                .catch(response => {
                })
            },
            addProduct(product){
                this.addingProduct = null
                axios.post("/api/products/",{
                    name  : product.name,
                    units : product.units,
                    price : product.price,
                    description : product.description,
                    image : product.image
                })
                .catch(response => {
                })
            },
            editItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },

            deleteItemConfirm () {
                this.products.splice(this.editedIndex, 1)
                this.closeDelete()
            },

            close () {
                this.dialog = false
                this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                })
            },

            closeDelete () {
                this.dialogDelete = false
                this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                })
            },

            save () {
                if (this.editedIndex > -1) {
                Object.assign(this.products[this.editedIndex], this.editedItem)
                this.endEditing(this.editedItem)
                } else {
                this.addProduct(this.editedItem)
                this.products.push(this.editedItem)
                }
                this.close()
            },
        }
    }
</script>