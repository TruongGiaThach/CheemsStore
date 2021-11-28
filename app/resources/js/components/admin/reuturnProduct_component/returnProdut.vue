<template>
  <v-dialog
      v-model="dialog"
      max-width="800px"
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
              <v-row align="start" no-gutters>
                <v-col cols="12" md="1">
                  <b>Id: </b>
                </v-col>
                <v-col cols="12" md="11" a>
                  <h5>{{ orderID }}</h5>
                </v-col>
              </v-row>
              <v-row>
                  <v-col cols="12" md="6">
                    <p style="display: inline">
                      <b>Ngày thanh toán :</b> {{ order.createDay }}
                  </p>
                </v-col>
                <v-col cols="12" md="6">
                  <div class="align-left">
                    <p style="display: inline">
                      <b>Trạng thái:</b>Đã thanh toán
                    </p>
                  </div>
                </v-col>
              </v-row>
              <v-row >
                <v-col cols="12" md="4" style="margin-bottom: 5px">
                  <span><b style="display: inline">Khách hàng:</b></span>
                  <span>{{ user.name }}</span>
                </v-col>
                <v-col cols="12" md="4">
                  <span><b style="display: inline">Email:</b></span>
                  <span>{{ user.email }}</span>
                </v-col>
                <v-col cols="12" md="4">
                  <span><b style="display: inline">Sđt:</b></span>
                  <span>{{ user.number }}</span>
                </v-col>
              </v-row>
              <v-data-table
                :headers="headers"
                :items="dataTable"

                height="30vh"

                dense
                hide-default-footer
                fixed-header
                item-key="name"
                rounded-xl
              >
                <template v-slot:[`item.actions`]="{ item }">
                  <v-container
                    width="10px"
                  >
                    <v-text-field
                      v-model.number="changeAmount[item.index]"
                      hide-details
                      single-line
                      type="number"
                    />
                  </v-container>
                </template>
                <!--data table header------------------------------------------------------------------------------------------------------------------------>
                
                <!-------------------------------------------------------------------------------------------------------------------------------------------->
                <template v-slot:footer>
                  <p> {{ changeAmout }} </p>
                </template>
              </v-data-table>
              <v-row>
                <v-col cols="12" md="3">
                  <span><h5 style="display: inline">Tổng:</h5></span>
                  <span
                    ><b style="color: #2196f3; font-size: 110%">{{
                      totalMoney
                    }}</b></span
                  >
                </v-col>
                <v-col cols="12" md="3">
                  <span><h5 style="display: inline">VAT:</h5></span>
                  <span
                    ><b style="color: #2196f3; font-size: 110%">{{
                      VATmoney
                    }}</b></span
                  >
                </v-col>
                <v-col cols="12" md="3">
                  <v-spacer></v-spacer>
                </v-col>
                <v-col cols="12" md="3" align-self="end">
                  <v-btn
                    small
                    color="primary"
                    @click="calculateTotal"
                  >
                    Cập nhật
                  </v-btn>
                </v-col>
              </v-row>
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

        totalMoney: 0,
        VATmoney: 0,

        order: null,
        user: null,

        orderDetail: [],
        changeAmount: [],

        headers: [
          {
            text: "Tên",
            align: "left",
            width: "40%",
            value: "product.name",
          },
          {
            text: "Số lượng",
            align: "left",
            width: "20%",
            value: "amount",
          },
          {
            text: "giá bán",
            align: "left",
            width: "20%",
            value: "unitPrice",
          },
          {
            text: "số lượng trả",
            align: "left",
            width: "20%",
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
      dataTable() {
        if(this.orderChecked) {
          if(this.orderDetail != undefined && this.orderDetail.length != 0) {
          return this.orderDetail;
        }
        }
      },
      changeAmout(item) {
        return item.amount;
      },
    },

    watch: {
      changeAmount: function() {
        for(i in this.orderDetail.length)
        {
          this.totalMoney = (this.orderDetail[i].amount - this.changeAmount[i]) * this.orderDetail[i].unitPrice
        }
      }
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
              this.totalMoney = this.order.total;
              this.VATmoney = this.order.VAT;
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
                      this.orderDetail[j].index = j;
                      this.orderDetail[j].product = response.data[0];
                      this.changeAmount[j] = 0;
                      j++;
                      if(j == this.orderDetail.length) {
                        this.orderChecked = true;
                        this.orderChecking = false;
                      }
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

      updateOrder() {
        axios
        .put(`/api/receipt/${this.orderID}`, {
          VAT: this.VATmoney,
          createDay: this.order.createDay,
          total: this.totalMoney,
          user_id: this.order.user_id,
        })
        .then((res) => {
          console.log('update order')
        })
      },

      updateOrderDetail() {
        
      },

      updateProductAmount() {

      },

      calculateTotal() {
        var total = 0;
        var vat = 0;
        for(var i in this.orderDetail)
        {
          total = total + (parseInt(this.orderDetail[i].amount) - parseInt(this.changeAmount[i])) * parseFloat(this.orderDetail[i].unitPrice)
        }
        vat = total * 0.1;
        total = total + vat;
        this.totalMoney = total;
        this.VATmoney = vat;
      },

      async close() {
        this.orderID = '';
        this.orderChecked = false;
        this.order = null;

        this.orderDetail = [];
        this.changeAmount = [];

        this.user = null;

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