<template>
  <v-card height="100%" outlined class="pa-md-4 mx-lg-auto grey lighten-3" max-height="680">
    <v-row>
      <v-col cols="12" md="3">
  <v-card
    height="100%"
    class="mx-auto"
  >
    <v-toolbar
      dark
    >
      <v-toolbar-title>Category</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-toolbar>
    <v-list>
      <v-list-item-group
        v-model="selected"
        active-class="gray--text"
      >
        <template v-for="(cate) in category">

          <v-list-item :key="cate.name" :value="cate._id">
            <template v-slot:default="{ active }">
              <v-list-item-content>
                <v-list-item-title v-text="cate.name"></v-list-item-title>
              </v-list-item-content>

              <v-list-item-action>
                <v-icon
                  v-if="active"
                  color="grey lighten-1"
                >
                  mdi-star-outline
                </v-icon>
              </v-list-item-action>
            </template>
          </v-list-item>
        </template>
      </v-list-item-group>
    </v-list>
  </v-card>
      </v-col>
      <v-col cols="12" md="9">
    <v-data-table
      :headers="headers"
      :items="tableData"
      :search="search"
      :single-expand="singleExpand"
      :expanded.sync="expanded"
      
      fixed-header
      item-key="name"
      show-expand
      rounded-xl
      class="elevation-1"
      min-height="100vh"
      height="73vh"
      @click:row="clickRow"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Products</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn dark class="mb-2" v-bind="attrs" v-on="on">
                New Item
              </v-btn>
            </template>
            <ValidationObserver ref="observer" v-slot="{invalid}">
            <v-card class="elevation-12">
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>


              <v-card-text>
                <v-container>
                  <V-form @submit.prevent="save">
                    <v-row>
                      <v-col cols="12" sm="6" md="8">
                        <ValidationProvider v-slot="{ errors }" name="Name" rules="required">
                          <v-text-field
                            v-model="editedItem.name"
                            :error-messages="errors"
                            label="Product Name"
                            required
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="12" sm="4" md="4">
                        <ValidationProvider v-slot="{ errors }" name="Amount" rules="required">
                          <v-text-field
                            v-model.number="editedItem.amount"
                            :error-messages="errors"
                            label="Amounts"
                            required
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="12" sm="6" md="6">
                        <ValidationProvider v-slot="{ errors }" name="ImportPrice" rules="required">
                          <v-text-field
                            v-model.number="editedItem.importPrice"
                            :error-messages="errors"
                            label="Import Price"
                            required
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="12" sm="6" md="6">
                        <ValidationProvider v-slot="{ errors }" name="OutportPrice" rules="required">
                          <v-text-field
                            v-model.number="editedItem.outportPrice"
                            :error-messages="errors"
                            label="Outport Price"
                            required
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="12" sm="6" md="8">
                        <ValidationProvider v-slot="{ errors }" name="manufacture" rules="required">
                          <v-text-field
                            v-model="editedItem.manufacture"
                            :error-messages="errors"
                            label="Manufacure"
                            required
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="12" sm="4" md="4">
                        <ValidationProvider v-slot="{ errors }" name="warrantyPeriod" rules="required">
                          <v-text-field
                            v-model.number="editedItem.warrantyPeriod"
                            :error-messages="errors"
                            label="Warranty Period"
                            required
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="12" md="8">
                        <ValidationProvider v-slot="{ errors }" name="category" rules="required">
                          <v-select
                            v-model="editedItem.category_id"
                            :items="category"
                            :error-messages="errors"
                            item-text="name"
                            item-value="_id"
                            label="Category"
                            single-line
                            required
                          ></v-select>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="12" md="4">
                          <v-text-field
                            v-model="editedItem.tag"
                            label="Tags"
                            required
                          ></v-text-field>
                      </v-col>
                    </v-row>

                    <v-row>
                      <div class="col-md-6">
                          <input 
                          type="file" 
                          class="form-control-file" 
                          id="image" 
                          accept="image/*"
                          >
                      </div>
                    </v-row>

                    <v-row>
                      <v-col cols="12">
                          <v-textarea v-model="editedItem.description" color="teal">
                            <template v-slot:label>
                              <div>Description <small>(optional)</small></div>
                            </template>
                          </v-textarea>
                      </v-col>
                    </v-row>
                  </V-form>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" type="submit" :disabled="invalid" text @click="save"> Save </v-btn>
              </v-card-actions>
            </v-card>
            </ValidationObserver>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h6"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.tag`]="{ items }">
        <v-row v-for="tag in items" :key="tag">
          <v-chip
            :color="green"
            dark
          >
            {{ tag }}
          </v-chip>
        </v-row>
      </template>

      <template #expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          <v-row no-gutters>
            <v-col cols="12" md="4">
              <img width="100px" height="100px" :src="item.image"> 
            </v-col>
            <v-col cols="12" md="8">
              <h3 class="text-justify">{{ item.name }}</h3>
              <p> nhà sản xuất: {{ item.manufacture }}</p>
              <p> thời hạn bảo hành: {{ item.warrantyPeriod }} tháng</p>
              <p class="text-justify">{{ item.description }}</p>
            </v-col>
          </v-row>
        </td>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <h6 class="text-center">No data found!</h6>
        <v-btn small fab @click="initialize">
          <v-icon dark> mdi-restart </v-icon>
        </v-btn>
      </template>
    </v-data-table>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>

import { required, digits, max, regex } from 'vee-validate/dist/rules'
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'

setInteractionMode('eager')

extend('required', {
    ...required,
    message: '{_field_} can not be empty',
  })


export default {
  data() {
    return {
      selected: undefined,
      categorySelected: '',
      products: [],
      category: [],
      search: "",
      addingProduct: null,
      dialog: false,
      dialogDelete: false,
      lazy: `https://goo.gl/jbJWmK`,
      singleExpand: true,
      expanded: [],
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: false,
          value: "name",
        },
        { 
          text: "Amounts", 
          value: "amount" 
        },
        { 
          text: "Buy Price", 
          value: "importPrice" 
        },
        { 
          text: "Sell Price", 
          value: "outportPrice" 
        },
        { 
          text: "Sell Price", 
          value: "outportPrice" 
        },
        { 
          text: "Tag", 
          value: "tag" 
        },
        { 
          text: "Actions", 
          value: "actions", 
          sortable: false 
        },
      ],
      editedIndex: -1,
      editedItem: {
        id: '',
        name: '',
        amount: 0,
        importPrice: 0,
        outportPrice: 0,
        manufacture: '',
        warrantyPeriod: 0,
        category_id: '',
        description: '',
        image: '',
        tag: '',
      },
      DefaultItem: {
        id: '',
        name: '',
        amount: 0,
        importPrice: 0,
        outportPrice: 0,
        manufacture: '',
        warrantyPeriod: 0,
        category_id: '',
        description: '',
        image: '',
        tag: '',
      },

    };
  },

  components: {
    ValidationProvider,
    ValidationObserver
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
    tableData() {
      for(const item of this.products){
        item.image = require(`../../../../public/images/${item.image}`).default;
      };
      if (this.selected != undefined) {
        console.log(this.selected)
        return this.products.filter((e) => {
          return (e.category_id == this.selected);
        });
      } else if (this.selected == undefined) {
        return this.products
      }
    },
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

  
  methods: {
    nameExists: function () {
        if (this.editItem.name !== '') {
          var exists = this.products.some(function() {
            return products.name === this.editItem.name
          });
          if(exists) {
            this.nameMessage = 'Name has exist'
            this.rules.existingName = false
          }
        }
      },
    clickRow(item, event) {
      if (event.isExpanded) {
        const index = this.expanded.findIndex((i) => i === item);
        this.expanded.splice(index, 1);
      } else {
        this.expanded.push(item);
      }
    },
    initialize(){
      this.initialize_product();
      
      this.initialize_category();
    },

    initialize_product() {
      axios
      .get("/api/products")
      .then((response) => {
        this.products = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
    },


    initialize_category() {
      axios
        .get("/api/category")
        .then((response) => {
          this.category = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getCategory() {
      axios
        .get("/api/products/")
        .then((response) => {
          this.products = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    newProduct() {
      this.addingProduct = {
        name: null,
        image: null,
        amount: null,
        importPrice: null,
        outportPrice: null,
        manufacture: null,
        warrantyPeriod: null,
        category_id: null,
        description: null,
        tag: null,
      };
    },
    endEditing(product) {
      let formData = new FormData();
      formData.append('_id', this.editedItem._id);
      formData.append('name', this.editedItem.name);
      formData.append('amount', this.editedItem.amount);
      formData.append('importPrice', this.editedItem.importPrice);
      formData.append('outportPrice', this.editedItem.outportPrice);
      formData.append('manufacture', this.editedItem.manufacture);
      formData.append('warrantyPeriod', this.editedItem.warrantyPeriod);
      formData.append('category_id', this.editedItem.category_id);
      formData.append('description', this.editedItem.description);
      formData.append('tag', this.editedItem.tag);
      formData.append('name', this.editedItem.name);

      if (document.getElementById('image').files[0])
      {
        formData.append('image', document.getElementById("image").files[0]);
        this.editedItem.image =  this.editedItem.name + '.' + document.getElementById("image").files[0].name.split('.')[1];
        console.log(document.getElementById('image').files[0]);
        console.log(this.editedItem.image);
      };

      axios
        .put(`/api/products/${product._id}`, formData, {
          header:{
            'Content-Type':"multipart/form-data"
          }
        })
        .catch((response) => {});
    },
    addProduct() {
      
      this.addingProduct = null;
      
      let formData = new FormData();
      formData.append('name', this.editedItem.name);
      formData.append('amount', this.editedItem.amount);
      formData.append('importPrice', this.editedItem.importPrice);
      formData.append('outportPrice', this.editedItem.outportPrice);
      formData.append('manufacture', this.editedItem.manufacture);
      formData.append('warrantyPeriod', this.editedItem.warrantyPeriod);
      formData.append('category_id', this.editedItem.category_id);
      formData.append('description', this.editedItem.description);
      formData.append('tag', this.editedItem.tag);
      formData.append('name', this.editedItem.name);
      
      if (document.getElementById('image').files[0])
      {
        formData.append('image', document.getElementById("image").files[0]);
        this.editedItem.image =  this.editedItem.name + '.' + document.getElementById("image").files[0].name.split('.')[1];
      };

      axios
        .post("/api/products/", formData, {
          header:{
            'Content-Type':"multipart/form-data"
          }
        })
        .then(
          res => {
            console.log("worked");
            this.initialize();
          }
        )
        .catch((response) => {});

},

    endDelete(product) {
      axios
        .delete(`/api/products/${product._id}`, formData, {
          header:{
            'Content-Type':"multipart/form-data"
          }
        })
        .then(
          res => {
            console.log("updated.")
          }
        )
        .catch((response) => {});
    },

    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.endDelete(this.editedItem);
      this.products.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    async close() {
      this.$refs.observer.reset()
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async save() {
      const reuslt = await this.$refs.observer.validate()
      if (this.editedIndex > -1) {
        this.endEditing(this.editedItem);
        Object.assign(this.products[this.editedIndex], this.editedItem);
      } else {
        await this.addProduct();
        this.products.push(this.editedItem);
        //this.initialize();
      }
      this.close();
    },
  },
};
</script>