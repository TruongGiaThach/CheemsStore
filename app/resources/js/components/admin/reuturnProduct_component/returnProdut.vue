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
              <v-row>
                <p style="color: red" > 
                  {{ this.notifycationText }}
                </p>
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

                v-model="selected"
                height="30vh"
                show-select
                dense
                hide-default-footer
                fixed-header
                item-key="_id"
                rounded-xl
              >
                <template v-slot:[`item.actions`]="{ item }">
                  <v-container
                    fluid
                  >
                    <v-row 
                      align="center"
                      justify="center"
                      no-gutters
                    >
                      <v-col>
                        <v-text-field
                          v-model.number="changeAmount[item.index].num"
                          hide-details
                          single-line
                          type="number"
                          class="d-flex justify-center align-center"
                          style="padding-top: 0px; margin-top: 0px;"
                        />
                      </v-col>
                      <v-col>
                        <v-icon :color="changeAmount[item.index].action == 'DELETE'?'red':'gray'" @click="deleteSelect(item.index)"> mdi-delete </v-icon>
                      </v-col>
                    </v-row>
                  </v-container>
                </template>
                <!--data table header------------------------------------------------------------------------------------------------------------------------>
                <template v-slot:top>
                  <v-container fluid>
                    <v-spacer></v-spacer>
                    <v-icon  @click="deleteSelectAll"> mdi-delete </v-icon>
                  </v-container>
                </template>
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
                  <span><h5 style="display: inline">trả lại:</h5></span>
                  <span
                    ><b style="color: #2196f3; font-size: 110%">{{
                      refundMoney
                    }}</b></span
                  >
                </v-col>
                <v-col cols="12" md="3" align-self="end">
                  <v-btn
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
            :loading="updateLoading"
            :disabled="!isChange"
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
        updateLoading: false,
        isChange: false,
        
        orderID: '',
        notifycationText: '',

        totalMoney: 0,
        VATmoney: 0,
        refundMoney: 0,

        order: null,
        user: null,

        orderDetail: [],
        changeAmount: [],
        selected: [],

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
            if(response.data.length != 0) {
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
                  if(this.orderDetail.length != 0) {
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
                        this.changeAmount[j] = {action: 'CHANGE', num: 0};
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
                  }
                  else {
                    this.orderChecked = true;
                    this.orderChecking = false;
                  }
                })
                .catch((error) => {
                  console.log(`error when get order detail`)
                  console.log(`${error}`)
                })
              }
            }
            else {
              console.log('no order founded');
              this.notifycationText = 'không tìm thấy hóa đơn';
              this.orderChecking = false;
            }
          })
          .catch((error) => {
            console.log('there something wrong when get order');
            this.orderChecking = false;
          }) 
        }
      },

      async updateOrder() {
        return axios
        .put(`/api/receipt/${this.orderID}`, {
          VAT: this.VATmoney,
          createDay: this.order.createDay,
          total: this.totalMoney,
          user_id: this.order.user_id,
        })
        .then((res) => {
          console.log('update order');
          return "update order success";
        })
        .catch((error) => {
          console.log('error when update order');
          return "error when update order"
        })
      },

      async deleteOrderDetail(receiptDetailId) {
        return axios
          .delete(`/api/receipt_detail/${receiptDetailId}`)
          .then(
            res => {
              console.log('delete order detail success');
              return "delete order detail success";
            }
          )
          .catch((error) => {
              console.error(error);
              return "delete order detail success";
          });
      },

      async updateOrderDetailAmount(receiptDetailId, oldAmount, newAmount) {
        if(oldAmount != newAmount)
        {
          return axios
          .put(`/api/amount/receipt_detail/${receiptDetailId}`, {
            amount: newAmount,
          })
          .then((res) => {
            console.log('update order detail');
            return "update order detail success";
          })
          .catch((error) => {
            console.log('error when update order');
            return "error when update order detail"
          })
        }
        else return 'nothing to update';
      },

      async updateProductAmount(productId, oldAmount, newAmount) {
        if(oldAmount != newAmount)
        {
          return axios
          .put(`/api/amount/products/${productId}`, {
            amount: newAmount,
          })
          .then((res) => {
            console.log('update product');
            return "update product amount success";
          })
          .catch((error) => {
            console.log('error when update order');
            return "error when update product amount"
          })
        }
        else return 'nothing to update';
      },

      deleteSelect(index) {
        console.log(index);
        if(this.changeAmount[index].action == 'CHANGE') {
          console.log('change action to delete');
          console.log(this.changeAmount[index].action);
          this.changeAmount[index].action = "DELETE";
        }
        else {
          console.log('change action to change');
          console.log(this.changeAmount[index].action);
          this.changeAmount[index].action = 'CHANGE';
        }
      },

      deleteSelectAll() {
        for (var i = 0, l = this.selected.length; i < l; i++) {
          this.changeAmount[i].action = "DELETE";
        }
      },

      calculateTotal() {                      
        var total = 0;
        var vat = 0;
        for(var i in this.orderDetail)
        {
          if(this.changeAmount[i].action == 'CHANGE') {
            total = total + (parseInt(this.orderDetail[i].amount) - parseInt(this.changeAmount[i].num)) * parseFloat(this.orderDetail[i].unitPrice)
          }
          else {
            total = total + (0) * parseFloat(this.orderDetail[i].unitPrice)
          }
        }
        vat = total * 0.1;
        total = total + vat;
        this.refundMoney = this.totalMoney - total;
        this.totalMoney = total;
        this.VATmoney = vat;
        if(this.order.total != this.totalMoney) this.isChange = true;
        else this.isChange = false;
      },

      async close() {
        this.orderID = '';
        this.notifycationText = '',

        this.orderChecked = false;
        this.updateLoading = false;
        this.isChange = false;

        this.order = null;

        this.orderDetail = [];
        this.changeAmount = [];
        this.selected = [];

        this.refundMoney = 0;

        this.user = null;

        this.$emit('resetAll');
        this.dialog = false;
      },

      async updateAndDelete(index) {
        if(this.changeAmount[index].action == 'CHANGE') {
          console.log('order detail number ' + index);
          this.updateOrderDetailAmount(this.orderDetail[index]._id, parseInt(this.orderDetail[index].amount), parseInt(this.orderDetail[index].amount) - parseInt(this.changeAmount[index].num))
          .then((response) => {
            console.log('product number ' + index);
            this.updateProductAmount(this.orderDetail[index].product_id, parseInt(this.orderDetail[index].product.amount), parseInt(this.orderDetail[index].product.amount) + parseInt(this.changeAmount[index].num))
            .then((res) => {
              console.log(res);
              if(index == this.orderDetail.length-1) {
                this.close();
              }
            })
            .catch((error) => {
              console.log('error: ' + error);
            })
          })
          .catch((error) => {
            console.log('error: ' + error);
          })
        }
        else {
          console.log('order detail number ' + index);
          this.deleteOrderDetail(this.orderDetail[index]._id)
          .then((response) => {
            this.updateProductAmount(this.orderDetail[index].product_id, parseInt(this.orderDetail[index].product.amount), parseInt(this.orderDetail[index].product.amount) + parseInt(this.orderDetail[index].amount))
            .then((res) => {
              console.log(res);
              if(index == this.orderDetail.length-1) {
                this.close();
              }
            })
            .catch((error) => {
              console.log('error: ' + error);
            })
            
          })
          .catch((error) => {
            console.log('error: ' + error);
          })
        }
      },

      async save() {
        this.updateLoading = true;
        if(this.orderChecked && this.orderDetail.length != 0) {
          if(this.isChange) {
            this.updateOrder()
            .then((res) => {
              console.log(res);
              console.log(this.orderDetail.length);
              var j = 0;
              for (var i = 0, l = this.orderDetail.length; i < l; i++) {
                this.updateAndDelete(i)
              }
              this.$emit('refundFinish');
            })
            .catch((error) => {
              console.log(error);
            })
          }
          else {
            //
            this.updateLoading = false;
          }
        }
        else {
          this.updateLoading = false;
        }
      },
    }
}
</script>

<style>

</style>