<template>
  <v-dialog
      v-model="dialog"
      max-width="600px"
      min-width="600px"
      @click:outside="close"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          icon
          v-bind="attrs"
          v-on="on"
        >
            <v-icon>
                mdi-cash-refund
            </v-icon>
        </v-btn>
      </template>
      <v-card class="mx-auto grey lighten-3">
        <v-toolbar
          dark
        >
          <v-toolbar-title>Trả hàng</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        
        <template v-if="!orderChecked">
          <v-card-text>
            <v-container fluid>
              <v-row>
                <v-col cols="12" md="8">
                    <v-text-field
                        v-model="orderID"
                        label="Mã hóa đơn"
                        hide-details="auto"
                        :readonly="alreadyHasId"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-btn
                        dark
                        @click="checkOrder"
                        :disabled="orderChecked"
                        :loading="orderChecking"
                    >Tìm Kiếm</v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
        </template>
        <template v-else>
          <v-card-text>
            <v-container fluid>
              <div class="clear">
                <div class="column2">
                  <h5>Cheems #ID {{ orderID }}</h5>
                  <p style="display: inline">
                    <b>Ngày thanh toán :</b> {{ order.createDay }}
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
                  <span>{{ user.name }}</span>
                </div>
                <div class="column2">
                  <span><b style="display: inline">Email:</b></span>
                  <span>{{ user.email }}</span>
                </div>
                <div class="column2">
                  <span><b style="display: inline">Sđt:</b></span>
                  <span>{{ user.number }}</span>
                </div>
              </div>
              <v-data-table
                :headers="headers"
                :items="orderDetail"

                fixed-header
                item-key="name"
                rounded-xl
              >
                <template v-slot:[`item.product.name`]="{ item }">
                  <div>
                    {{ item }}
                  </div>
                </template>

                <!--data table header------------------------------------------------------------------------------------------------------------------------>
                <template v-slot:top>
                  <v-toolbar flat>
                    <v-toolbar-title>
                      <div :class="'text-subtitle-2'">
                        Sản phẩm đã mua
                      </div>
                    </v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                  </v-toolbar>
                </template>
                <!-------------------------------------------------------------------------------------------------------------------------------------------->
              </v-data-table>
            </v-container>
          </v-card-text>
        </template>
        
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="close"
          >
            Đóng
          </v-btn>
          <v-btn
            color="blue darken-1"
            type="submit"
            text
            @click="save"
          >
            Xác nhận
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
    data: () => ({
        dialog: false, 
        orderChecked: false,
        orderChecking: false,
        
        orderID: '',

        order: null,
        user: null,

        orderDetail: [],

        headers: [
          {
            text: "Tên",
            align: "left",
            value: "product.name",
          },
          {
            text: "Số lượng",
            value: "amount",
          },
          {
            text: "giá bán",
            value: "unitPrice",
          },
          {
            text: "",
            value: "actions",
            sortable: false,
          },
        ],
    }),

    props: {
      order_id: [String],
    },

    computed: {
      alreadyHasId() {
        if(this.order_id != undefined) {
          this.orderID = this.order_id;
          
          return true;
        }
        else {
          
          return false;
        }
        return false;
      },
    },

    watch: {

    },

    methods: {
      checkOrder() {
        if(this.orderID != '')
        {
          this.orderChecking = true;
          axios
          .get('/api/receipt/getReceipt', {
            params: {
              type: '_id',
              condition: this.orderID,
            }
          })
          .then((response) =>{
            console.log(`recevie order of ${this.orderID}`);
            this.order = response.data[0];
            if(this.order != undefined) {
              //get customer info
              axios
              .get('/api/customer/find', {
                params: {
                  type: '_id',
                  condition: this.order.user_id,
                }
              })
              .then((response) => {
                this.user = response.data[0];
              })
              .catch((error) => {
                console.log('there something wrong when get customer');
                this.orderChecking = false;
              })

              //get product
              axios
              .get('/api/receipt_detail/find', {
                params: {
                  type: 'receipt_id',
                  condition: this.orderID,
                }
              })
              .then((response) => {
                console.log(`get order detail of order ${this.orderID}`)
                var j = 0;
                this.orderDetail = response.data;
                for (var i = 0, l = this.orderDetail.length; i < l; i++)
                  {
                    axios
                    .get('/api/products/find', {
                      params: {
                        type: '_id',
                        condition: this.orderDetail[i].product_id,
                      }
                    })
                    .then((response) => {
                      console.log(`get product of ${this.orderDetail[j].product_id}`)
                      this.orderDetail[j].product = response.data[0];
                      j++;
                      this.orderChecked = true;
                      this.orderChecking = false;
                    })
                    .catch((error) => {
                      console.log(`error when get product`)
                      console.log(error)
                      this.orderChecking = false;
                    })
                  }
              })
              .catch((error) => {
                console.log(`error when get order detail`)
                console.log(`${error}`)
              })
            }
          })
          .catch((error) => {
            console.log('there something wrong when get order');
            this.orderChecking = false;
          }) 
        }
      },

      async close() {
        this.orderID = '';
        this.orderChecked = false;
        this.order = null;

        this.$emit('resetAll');
        this.dialog = false;
      },

      async save() {
        this.close();
      },
    }
}
</script>

<style>

</style>