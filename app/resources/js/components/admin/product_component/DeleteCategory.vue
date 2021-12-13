<template>
  <v-dialog
    v-model="dialog"
    max-width="600px"
    min-width="600px"
    @click:outside="close"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn :disabled="isDisabled" icon v-bind="attrs" v-on="on" @click="ok">
        <v-icon> mdi-transfer </v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title class="bg-info mx-auto" max-width="inherit">
        <span class="text-h5 mx-auto white--text">Tùy chỉnh danh mục</span>
      </v-card-title>
      <v-card-text>
        <v-container fluid>
          <v-row>
            <v-col cols="12" md="12">
              <v-select
                v-model="categoryId"
                :items="categoryList"
                item-value="_id"
                item-text="name"
                label="Danh mục được chọn"
                required
                :readonly="categoryChecked"
              ></v-select>
              <v-subheader
                :class="this.checkResultColor"
                v-if="categoryChecked"
              >
                {{ this.checkResult }}
              </v-subheader>
            </v-col>
            <v-col cols="12" md="4">
              <v-btn
                color="primary"
                dark
                @click="checkCategory"
                :disabled="categoryChecked"
                :loading="categoryChecking"
                >Kiểm tra</v-btn
              >
            </v-col>
          </v-row>

          <v-subheader v-if="categoryChecked && productOfCategory.length != 0">
            <v-row justify="start">
              <v-col cols="12" md="2">
                <v-checkbox small v-model="tickAllProduct" class="AllCheckBox">
                  <template v-slot:label>
                    <v-row align-center justify-end>
                      <v-col>
                        <h6>All</h6>
                      </v-col>
                    </v-row>
                  </template>
                </v-checkbox>
              </v-col>
              <template v-if="tickAllProduct">
                <v-col cols="12" md="3">
                  <v-select
                    v-model="tickAllProduct_ActionSelect"
                    :items="[
                      { name: 'Danh mục', value: 'CHANGE' },
                      { name: 'Thùng rác', value: 'DELETE' },
                    ]"
                    item-text="name"
                    item-value="value"
                    label="Nơi chuyển"
                    single-line
                    required
                  ></v-select>
                </v-col>
              </template>
              <template
                v-if="tickAllProduct_ActionSelect == 'CHANGE' && tickAllProduct"
              >
                <v-col cols="12" md="7">
                  <v-select
                    v-model="tickAllProduct_CateSelect"
                    :items="categoryChosenList"
                    item-text="name"
                    return-object
                    label="Chọn danh mục để chuyển sản phẩm"
                    single-line
                    required
                  ></v-select>
                </v-col>
              </template>
            </v-row>
          </v-subheader>
          <v-list
            class="overflow-y-auto"
            width="100%"
            v-if="categoryChecked && productOfCategory.length != 0"
            color="transparent"
            max-height="300"
          >
            <template v-for="(item, index) in productOfCategory">
              <v-list-item :key="item.name">
                <product-listitem
                  @ActionCommand="productProcessing"
                  @turnOffAll="turnOffTickAll"
                  :productIndex="index"
                  :product="item"
                  :categoryList="categoryChosenList"
                  :SelectAllToggle="tickAllProduct"
                  :SelectAllACtion="tickAllProduct_ActionSelect"
                  :SelectAllCate="tickAllProduct_CateSelect"
                  ref="ProductListItem"
                />
              </v-list-item>
              <v-divider
                v-if="index < productOfCategory.length - 1"
                :key="index"
                class="item_divider"
              ></v-divider>
            </template>
          </v-list>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="error"
          type="submit"
          text
          :disabled="invalid"
          @click="save"
        >
          {{ this.productOfCategory.length == 0 ? "Xóa danh mục này" : "Chuyển" }}
        </v-btn>
        <v-btn color="blue darken-1" text @click="close"> Đóng </v-btn>
        
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { eventBus } from "../../../app";
import productListitem from "./deleteCategory_component/ProductList_item.vue";

export default {
  data: () => ({
    dialog: false,
    categoryChecking: false,
    categoryChecked: false,
    tickAllProduct: false,
    //triggerChildAction: false,

    categoryId: "",
    categoryName: "",
    categoryDescription: "",
    checkResult: "",
    checkResultColor: "",

    tickAllProduct_ActionSelect: null,
    tickAllProduct_CateSelect: null,

    productOfCategory: [],
    selected: [],

    numOfProductCheck: 0,
    removeProduct: 0,
    changeProduct: 0,
  }),
  components: {
    productListitem,
  },
  props: {
    category: [Object],
    categoryList: [Array],
  },
  
  computed: {
    
    isDisabled() {
      if (this.category == undefined) {
        return true;
      } else {
        this.categoryId = this.category._id;
        this.categoryName = this.category.name;
        this.categoryDescription = this.category.description;
        return false;
      }
    },

    invalid() {
      if (this.categoryChecked) {
        if (this.productOfCategory.length == 0) {
          if (this.numOfProductCheck > 0) {
            console.log("all product have been move or delete");
            this.checkResult = "Đã xóa/di chuyển hết sản phẩm. Có thể xóa";
            this.checkResultColor = "green--text";
            return false;
          } else {
            console.log("no product found");
            this.checkResult = "Danh mục không có sản phẩm. Có thể xóa";
            this.checkResultColor = "green--text";
            return false;
          }
        } else {
          return false;
        }
      }
      return true;
    },
    noTurningBack() {
      if (this.numOfProductCheck > 0) {
        if (this.productOfCategory.length != this.numOfProductCheck) {
          return true;
        }
      }
      return false;
    },
    categoryChosenList() {
      return this.categoryList.filter((e) => {
        return e._id != this.categoryId;
      });
    },
  },
  methods: {
    ok(){
      this.categoryId = this.category._id;
    },
    checkCategory() {
      this.categoryChecking = true;
      axios
        .get(`/api/products/find`, {
          params: {
            type: "category_id",
            condition: this.categoryId,
          },
        })
        .then((response) => {
          this.productOfCategory = response.data;
          this.numOfProductCheck = response.data.length;
          this.categoryChecking = false;
          this.categoryChecked = true;
          this.checkResult =
            "có " + response.data.length + " sản phẩm cần xử lí";
          this.checkResultColor = "orange--text";
        })
        .catch((error) => {
          console.error(error);
          this.categoryChecked = false;
          this.checkResult = "xảy ra lỗi khi lấy thông tin sản phẩm";
          this.checkResultColor = "red--text";
        });
    },
    productProcessing(event) {
      if (event[0]) {
        if (event[1] == "DELETE") {
          console.log(event[2] + " " + event[3]);
          this.productOfCategory.splice(event[1], 1);
        } else {
          console.log("change category of" + event[3] + " to " + event[4]);
          this.productOfCategory.splice(event[1], 1);
        }
      } else {
        this.checkResult = "vẫn còn sản phẩm chưa xử lí";
        this.checkResultColor = "red--text";
        console.log("there still product left");
        //this.triggerChildAction = false;
      }
    },

    turnOffTickAll() {
      this.tickAllProduct_ActionSelect = null;
      this.tickAllProduct = false;
    },

    async close() {
      if (this.numOfProductCheck != this.productOfCategory.length)
        this.$emit("resetAll");

      this.productOfCategory = [];
      this.removeProduct = [];
      this.changeProduct = [];

      this.categoryChecking = false;
      this.categoryChecked = false;
      //this.triggerChildAction = false;
      this.tickAllProduct = false;

      this.checkResult = "";
      this.checkResultColor = "";

      this.tickAllProduct_ActionSelect = null;
      this.tickAllProduct_CateSelect = null;

      (this.numOfProductCheck = 0), (this.removeProduct = 0);
      this.changeProduct = 0;

      this.dialog = false;

      
    },

    async save() {
      //this.triggerChildAction = true;
      eventBus.$emit("TriggerChildAction", true);
      if (this.productOfCategory.length == 0) {
        axios
          .delete(`/api/category/${this.categoryId}`)
          .then((res) => {
            console.log("delete category success");
            this.close();
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
  },
};
</script>

<style>
.item_divider {
  margin-top: 5px !important;
  margin-bottom: 5px !important;
  margin-left: 16px !important;
  margin-right: 16px !important;
  color: rgba(0, 0, 0, 0);
}
.AllCheckBox {
  text-align: start;
}
</style>
