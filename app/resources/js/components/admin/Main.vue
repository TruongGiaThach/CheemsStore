<template>
  <v-app id="inspire">
    <v-container
      fluid
      outlined
      align-start
      class="pa-4 mx-lg-auto grey lighten-3"
    >
      <v-row align-content-end full-width>
        <v-col cols="12" md="3">
          <v-card color="#321fdb" height="180">
            <customer-chart :customers="customer_c" :time="time" :total="customer_total"></customer-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#39f" height="180">
            <receipt-amount-chart :receipts="receipt_c" :time="time" :total="receipt_total"></receipt-amount-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#f9b115" height="180">
            <product-amount-chart :products="product_c" :time="time" :total="product_total"></product-amount-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#e55353" height="180">
            <buy-ratio-chart :ratio="ratio_c" :time="time" :total="ratio_total"></buy-ratio-chart>
          </v-card>
        </v-col>
      </v-row>
      <v-row align-content-end full-width>
        <v-col>
          <v-card>
            <input type="date" id="startDay" v-model="startDay1" />
            <input type="date" id="endDay" v-model="endDay1" />
            <card-line-chart
              v-model="startDay1"
              :labels="labels"
              :revenue="revenue"
              :profit="profit"
            >
              <div
                class="btn-group"
                role="group"
              >
                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio1"
                  id="btnradio1"
                  autocomplete="off"
                  checked
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio1"
                  @click="createStatisticWithDay(1)"
                  >Ngày</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio1"
                  id="btnradio2"
                  autocomplete="off"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio2"
                  @click="createStatisticWithMonth(2)"
                  >Tháng</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio1"
                  id="btnradio3"
                  autocomplete="off"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio3"
                  @click="createStatisticWithYear(3)"
                  >Năm</label
                >
              </div>
            </card-line-chart>
          </v-card>
        </v-col>
      </v-row>
      <v-row align-content-end full-width>
        <v-col>
          <v-card>
            <input type="date" id="startDay" v-model="startDay2" />
            <input type="date" id="endDay" v-model="endDay2" />
            <card-bar-chart
            :labels ="labels2"
            :customers="sCustomers"
            :orders="sOrder"
            >
                <div
                class="btn-group"
                role="group"
              >
                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio2"
                  id="btnradio4"
                  autocomplete="off"
                  checked
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio4"
                  @click="createStatisticWithDay2(1)"
                  >Ngày</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio2"
                  id="btnradio5"
                  autocomplete="off"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio5"
                  @click="createStatisticWithMonth2(2)"
                  >Tháng</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio2"
                  id="btnradio6"
                  autocomplete="off"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio6"
                  @click="createStatisticWithYear2(3)"
                  >Năm</label
                >
              </div>
            </card-bar-chart>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import CustomerChart from "./charts/CustomerChart";
import ReceiptAmountChart from "./charts/ReceiptAmountChart";
import ProductAmountChart from "./charts/ProductAmountChart";
import BuyRatioChart from "./charts/BuyRatioChart";
import CardBarChart from "./charts/CardBarChart";
import CardLineChart from "./charts/CardLineChart";
export default {
  data() {
    return {
      // du lieu thong ke
      check: 1,
      profit: [],
      revenue: [],
      labels: [],
      receiptsDay: [],
      customer_c: [],
      customer_total: '',
      receipt_c: [],
      receipt_total: '',
      product_c: [],
      product_total: '',
      ratio_c: [],
      ratio_total: '',
      // dư lieu duoc lay len
      customers: [],
      receipts: [],
      products: [],
      receiptDetails: [],

      values: [],
      dayinWeek: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
      monthinYear: [
        "Tháng 1",
        "Tháng 2",
        "Tháng 3",
        "Tháng 4",
        "Tháng 5",
        "Tháng 6",
        "Tháng 7",
        "Tháng 8",
        "Tháng 9",
        "Tháng 10",
        "Tháng 11",
        "Tháng 12",
      ],
      time: [],
      //du lieu thogn ke bang 2
      sOrder: [],
      sCustomers: [],
      labels2: [],
      startDay1: new Date("2021-11-12").toISOString().slice(0, 10),
      endDay1: new Date().toISOString().slice(0, 10),
      startDay2: new Date("2021-11-12").toISOString().slice(0, 10),
      endDay2: new Date().toISOString().slice(0, 10),
    };
  },
  components: {
    CardLineChart,
    CardBarChart,
    CustomerChart,
    ReceiptAmountChart,
    ProductAmountChart,
    BuyRatioChart,
  },
  beforeMount() {
    var ratio = [];
    var ratioTotal = 0;

    axios
      .get("/api/customer/")
      .then((response) => {
        if(response.data.length > 0){
          this.customers = response.data;
                this.customer_total = response.data.length;
                var count = 0;
                var month = 0;
                var day = new Date(response.data[0].created_at).getMonth();
                  for(var i = 0; i < response.data.length; i++){
                    if(new Date(response.data[i].created_at).getMonth() != day){
                      day = new Date(response.data[i].created_at).getMonth();
                      this.customer_c.push(count);
                      count = 1;
                      month++;
                      if(month > 6) return;
                    }else{count++;}
                  }
                this.customer_c.push(count);
              }
      })
      .catch((error) => {
        console.error(error);
      });
      axios
      .get("/api/receipt_detail")
      .then((response) => {
        if(response.data.length > 0){
          this.receiptDetails = response.data;
                this.product_total = response.data.length;
                var count = 0;
                var month = 0;
                var day = new Date(response.data[0].created_at).getMonth();
                  for(var i = 0; i < response.data.length; i++){
                    if(new Date(response.data[i].created_at).getMonth() != day){
                      day = new Date(response.data[i].created_at).getMonth();
                      ratio[month] = count;
                      this.product_c.push(count);
                      count = 1;
                      month++;
                      if(month > 6) return;
                    }else{count += response.data[i].amount;}
                  }
                this.product_c.push(count);
                ratio[month] = count;
              }
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get("/api/receipt/")
      .then((response) => {
        if(response.data.length > 0){
          this.receipts = response.data;
          for (var i = 0; i < response.data.length; i++) {
            this.values.push(response.data[i].total);
          }
                this.receipt_total = response.data.length;
                var count = 0;
                var month = 0;
                var day = new Date(response.data[0].created_at).getMonth();
                  for(var i = 0; i < response.data.length; i++){
                    if(new Date(response.data[i].created_at).getMonth() != day){
                      day = new Date(response.data[i].created_at).getMonth();
                      //add Ratio (tù vl, nhưng mà đel làm khác đc ae à, ngồi cả ngày chỉ còn cách nhét vô đây thôi)
                      ratio[month] = (ratio[month] / count);
                      ratioTotal += ratio[month];
                      this.ratio_c.push(ratio[month]);
                      this.receipt_c.push(count);
                      count = 1;
                      month++;
                      if(month > 6) return;
                    }else{count++;}
                  }
                this.receipt_c.push(count);
                ratio[month] = (ratio[month] / count);
                ratioTotal += ratio[month];
                ratioTotal = ratioTotal / 7;
                this.ratio_c.push(ratio[month]);
                this.ratio_total = ratioTotal.toFixed(2);

              }
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

    for(var i = 5; i > -2; i--){
      this.time.push("Tháng " + (new Date().getMonth() - i).toString());
    }


  },
  created() {
    setInterval(() => {
      if (this.check === 1) this.createStatisticWithDay();
      if (this.check === 2) this.createStatisticWithMonth();
      if (this.check === 3) this.createStatisticWithYear();
    }, 500);
  },
  methods: {
    createStatisticWithYear(index) {
      this.labels =this.createLabelWithYear(this.startDay1, this.endDay1);
      this.createDataWithYear();
      this.check = index;
    },
    createStatisticWithMonth(index) {
      this.labels =this.createLabelWithMonth(this.startDay1, this.endDay1);
      this.createDataWithMonth();
      this.check = index;
    },
    createStatisticWithDay(index) {
      this.labels = this.createLabelWithDay(this.startDay1, this.endDay1);
      this.createDataWithDay();
      this.check = index;
    },
    //bang thong ke 2
    createStatisticWithYear2(index) {
      this.labels2 = this.createLabelWithYear(this.startDay2, this.endDay2);
      this.createDataWithYear2();
      this.check2 = index;
    },
    createStatisticWithMonth2(index) {
      this.labels2=this.createLabelWithMonth(this.startDay2, this.endDay2);
      this.createDataWithMonth2();
      this.check2 = index;
    },
    createStatisticWithDay2(index) {
      this.labels2=this.createLabelWithDay(this.startDay2, this.endDay2);
      this.createDataWithDay2();
      this.check2 = index;
    },
    createDataWithYear2()
    {
        this.sCustomers=[]
        this.sOrder =[]
        var receiptsDay = this.receipts.filter((e) => {
            return (
                new Date(e.createDay).getYear() <= new Date(this.endDay2).getYear() &&
                new Date(e.createDay).getYear() >= new Date(this.startDay2).getYear()
            );
        });
        var productAmount = []
        var CustomerAmount = []
        receiptsDay.forEach(element => {
            var receiptDetailDay = this.receiptDetails.filter((f) => {
                return f.receipt_id === element._id;
            });
            productAmount.push(receiptDetailDay.reduce((total,value)=>{
                return total + parseInt(value.amount)
            },0))
            CustomerAmount.push(1)
        });
        for(var i=0; i< receiptsDay.length-1;i++)
        {
            if (
            new Date(receiptsDay[i].createDay).getYear() ===
            new Date(receiptsDay[i + 1].createDay).getYear()
            )  {
                productAmount[i]+=productAmount[i+1]
                CustomerAmount[i]+=1
                CustomerAmount.splice(i+1,1)
                productAmount.splice(i+1,1)
                receiptsDay.splice(i + 1, 1);
                if(receiptsDay.length===1) break;
                i--;
            }
        }
         var j = 0;
      var i = 0;
      var yearcheck = new Date(this.startDay2);
      var lengths = this.labels2.length;
      for (; i <= lengths; i++) {
        var yearRec = new Date(receiptsDay[j].createDay);
        if (yearcheck.getYear() < yearRec.getYear()) {
          this.sCustomers.push(0)
          this.sOrder.push(0)
        } else if (yearcheck.getYear() === yearRec.getYear()) {
          this.sCustomers.push(CustomerAmount[j])
          this.sOrder.push(productAmount[j])
          j++;
          if (j >= receiptsDay.length) { i++;break;}
        } else {
          break;
        }
        yearcheck.setFullYear(yearcheck.getFullYear()+1)
      }
      for(;i<lengths;i++)
      {
        this.sCustomers.push(0)
          this.sOrder.push(0)
      }

    },
    createDataWithMonth2()
    {
        this.sCustomers=[]
        this.sOrder =[]
        var receiptsDay = this.receipts.filter((e) => {
            return (
            new Date(e.createDay).getYear() <= new Date(this.endDay2).getYear() &&
            (new Date(e.createDay).getYear() >
                new Date(this.startDay2).getYear() ||
                ((new Date(e.createDay).getYear() ===
                new Date(this.startDay2).getYear()) &&
                (new Date(e.createDay).getMonth() >=
                    new Date(this.startDay2).getMonth())))
            );
        });
        var productAmount = []
        var CustomerAmount = []
        receiptsDay.forEach(element => {
            var receiptDetailDay = this.receiptDetails.filter((f) => {
                return f.receipt_id === element._id;
            });
            productAmount.push(receiptDetailDay.reduce((total,value)=>{
                return total + parseInt(value.amount)
            },0))
            CustomerAmount.push(1)
        });
        for(var i=0; i< receiptsDay.length-1;i++)
        {
            if (
          (new Date(receiptsDay[i].createDay).getMonth() ===
            new Date(receiptsDay[i + 1].createDay).getMonth()) &&
          (new Date(receiptsDay[i].createDay).getYear() ===
            new Date(receiptsDay[i + 1].createDay).getYear())
            ){
                productAmount[i]+=productAmount[i+1]
                CustomerAmount[i]+=1
                CustomerAmount.splice(i+1,1)
                productAmount.splice(i+1,1)
                receiptsDay.splice(i + 1, 1);
                if(receiptsDay.length===1) break;
                i--;
            }
        }
      var j = 0;
      var i = 0;
      var monthcheck = new Date(this.startDay2);
      var lengths = this.labels2.length;
      for (; i < lengths; i++) {
        var monthRec = new Date(receiptsDay[j].createDay);
        if (monthcheck.getYear() < monthRec.getYear()) {
          this.sCustomers.push(0)
          this.sOrder.push(0)
        } else if (monthcheck.getYear() === monthRec.getYear()) {
          if (monthcheck.getMonth() === monthRec.getMonth()) {
            this.sCustomers.push(CustomerAmount[j])
          this.sOrder.push(productAmount[j]);
            j++;
            if (j >= receiptsDay.length){ i++;break;}
          } else
          {
            this.sCustomers.push(0)
         this.sOrder.push(0)
          }
        } else {
          break;
        }
        monthcheck.setMonth(monthcheck.getMonth()+1);
      }
      for(;i<lengths;i++)
      {
         this.sCustomers.push(0)
         this.sOrder.push(0)
      }
    },
    createDataWithDay2()
    {
        this.sCustomers=[]
        this.sOrder =[]
        var receiptsDay = this.receipts.filter((e) => {
            return (
            new Date(e.createDay).getTime() <= new Date(this.endDay2).getTime() &&
            new Date(e.createDay).getTime() >= new Date(this.startDay2).getTime()
            );
        });
        var productAmount = []
        var CustomerAmount =[]
        receiptsDay.forEach(element => {
            var receiptDetailDay = this.receiptDetails.filter((f) => {
                return f.receipt_id === element._id;
            });
            productAmount.push(receiptDetailDay.reduce((total,value)=>{
                return total + parseInt(value.amount)
            },0))
            CustomerAmount.push(1)
        });
        for(var i=0; i< receiptsDay.length-1;i++)
        {
            if (receiptsDay[i].createDay === receiptsDay[i + 1].createDay) {
                productAmount[i]+=productAmount[i+1]
                CustomerAmount[i]+=1
                CustomerAmount.splice(i+1,1)
                productAmount.splice(i+1,1)
                receiptsDay.splice(i + 1, 1);
                if(receiptsDay.length===1) break;
                i--;
            }
        }
        var lengths = this.daysdifference(this.startDay2, this.endDay2);
        var j = 0;
        var i= 0;
        var datecheck = new Date(this.startDay2);
      for (; i <= lengths; i++) {
        var dateRec = new Date(receiptsDay[j].createDay);
        if (datecheck.getTime() < dateRec.getTime()) {
          this.sOrder.push(0)
          this.sCustomers.push(0)
        } else if (datecheck.getTime() === dateRec.getTime()) {
          this.sCustomers.push(CustomerAmount[j])
          this.sOrder.push(productAmount[j])
          j++;
          if (j >= receiptsDay.length) { i++;break;}
        } else {
          break;
        }
        datecheck.setDate(datecheck.getDate() + 1);
      }
      for(;i<=lengths;i++)
      {
          this.sOrder.push(0)
          this.sCustomers.push(0)
      }
    },
    createDataWithYear() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.filter((e) => {
        return (
          new Date(e.createDay).getYear() <= new Date(this.endDay1).getYear() &&
          new Date(e.createDay).getYear() >= new Date(this.startDay1).getYear()
        );
      });
      receiptsDay.sort(this.compareDay);
      var revenue = receiptsDay.map((e) => {
        var receiptDetailDay = this.receiptDetails.filter((f) => {
          return f.receipt_id === e._id;
        });
        this.receiptsDay.push(receiptDetailDay);
        return parseInt(e.total);
      });
      // loi nhuan chua sap xep
      var profit = [];
      this.receiptsDay.forEach((element, ind) => {
        var amount = element.map((value) => {
          return value.amount;
        });
        var product = this.products.filter((e) => {
          return e._id === element[0].product_id;
        });
        var importPrices = product.reduce((acc, value, index) => {
          return acc + parseInt(value.importPrice) * parseInt(amount[index]);
        }, 0);
        profit.push(revenue[ind] - importPrices);
      });
      for (var i = 0; i < receiptsDay.length - 1; i++) {
        if (
          new Date(receiptsDay[i].createDay).getYear() ===
          new Date(receiptsDay[i + 1].createDay).getYear()
        ) {
          revenue[i] += revenue[i + 1];
          profit[i] += profit[i + 1];
          revenue.splice(i + 1, 1);
          profit.splice(i + 1, 1);
          receiptsDay.splice(i + 1, 1);
          if(receiptsDay.length===1) break;
          i--;
        }
      }
      console.log(revenue)
      var j = 0;
      var i = 0;
      var yearcheck = new Date(this.startDay1);
      var lengths = this.labels.length;
      for (; i <= lengths; i++) {
        var yearRec = new Date(receiptsDay[j].createDay);
        if (yearcheck.getYear() < yearRec.getYear()) {
          this.revenue.push(0);
          this.profit.push(0);
        } else if (yearcheck.getYear() === yearRec.getYear()) {
          this.revenue.push(revenue[j]);
          this.profit.push(profit[j]);
          j++;
          if (j >= receiptsDay.length) { i++;break;}
        } else {
          break;
        }
        yearcheck.setFullYear(yearcheck.getFullYear()+1)
      }
      for(;i<lengths;i++)
      {
        this.revenue.push(0);
        this.profit.push(0);
      }
    },
    createLabelWithYear(startDay, endDay) {
      var labels = [];
      var yearStart = new Date(startDay).getFullYear();
      var yearEnd = new Date(endDay).getFullYear();
      for (var i = yearStart; i <= yearEnd; i++) {
        labels.push(i);
      }
      return labels
    },
    createDataWithMonth() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.filter((e) => {
        return (
          new Date(e.createDay).getYear() <= new Date(this.endDay1).getYear() &&
          (new Date(e.createDay).getYear() >
            new Date(this.startDay1).getYear() ||
            ((new Date(e.createDay).getYear() ===
              new Date(this.startDay1).getYear()) &&
              (new Date(e.createDay).getMonth() >=
                new Date(this.startDay1).getMonth())))
        );
      });
      receiptsDay.sort(this.compareDay);
      var revenue = receiptsDay.map((e) => {
        var receiptDetailDay = this.receiptDetails.filter((f) => {
          return f.receipt_id === e._id;
        });
        this.receiptsDay.push(receiptDetailDay);
        return parseInt(e.total);
      });
      // loi nhuan chua sap xep
      var profit = [];
      this.receiptsDay.forEach((element, ind) => {
        var amount = element.map((value) => {
          return value.amount;
        });
        var product = this.products.filter((e) => {
          return e._id === element[0].product_id;
        });
        var importPrices = product.reduce((acc, value, index) => {
          return acc + parseInt(value.importPrice) * parseInt(amount[index]);
        }, 0);
        profit.push(revenue[ind] - importPrices);
      });
      for (var i = 0; i < receiptsDay.length - 1; i++) {
        if (
          (new Date(receiptsDay[i].createDay).getMonth() ===
            new Date(receiptsDay[i + 1].createDay).getMonth()) &&
          (new Date(receiptsDay[i].createDay).getYear() ===
            new Date(receiptsDay[i + 1].createDay).getYear())
        ) {
          revenue[i] += revenue[i + 1];
          profit[i] += profit[i + 1];
          revenue.splice(i + 1, 1);
          profit.splice(i + 1, 1);
          receiptsDay.splice(i + 1, 1);
          if(receiptsDay.length===1) break;
          i--;
        }
      }
      var j = 0;
      var i = 0;
      var monthcheck = new Date(this.startDay1);
      var lengths = this.labels.length;
      for (; i < lengths; i++) {
        var monthRec = new Date(receiptsDay[j].createDay);
        if (monthcheck.getYear() < monthRec.getYear()) {
          this.revenue.push(0);
          this.profit.push(0);
        } else if (monthcheck.getYear() === monthRec.getYear()) {
          if (monthcheck.getMonth() === monthRec.getMonth()) {
            this.revenue.push(revenue[j]);
            this.profit.push(profit[j]);
            j++;
            if (j >= receiptsDay.length){ i++;break;}
          } else
          {
            this.revenue.push(0);
            this.profit.push(0);
          }
        } else {
          break;
        }
        monthcheck.setMonth(monthcheck.getMonth()+1);
      }
      for(;i<lengths;i++)
      {
         this.revenue.push(0);
         this.profit.push(0);
      }
      console.log(this.revenue)
    },
    createLabelWithMonth(startDay, endDay) {
      var labels = [];
      var monthStart = new Date(startDay).getMonth();
      var monthEnd = new Date(endDay).getMonth();
      var yearStart = new Date(startDay).getFullYear();
      var yearEnd = new Date(endDay).getFullYear();
      if (yearStart < yearEnd) {
        labels.push(
          ...this.monthinYear.filter((e, i) => {
            return i >= monthStart;
          })
        );
        for (var i = 0; i < yearEnd - yearStart - 1; i++) {
          labels.push(...this.monthinYear);
        }
        labels.push(
          ...this.monthinYear.filter((e, i) => {
            return i <= monthEnd;
          })
        );
      } else {
        labels.push(
          ...this.monthinYear.filter((e, i) => {
            return i >= monthStart && i <= monthEnd;
          })
        );
      }
      return labels
    },
    createDataWithDay() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.filter((e) => {
        return (
          new Date(e.createDay).getTime() <= new Date(this.endDay1).getTime() &&
          new Date(e.createDay).getTime() >= new Date(this.startDay1).getTime()
        );
      });
      receiptsDay.sort(this.compareDay);
      //doanh thu chua sap xep
      var revenue = receiptsDay.map((e) => {
        var receiptDetailDay = this.receiptDetails.filter((f) => {
          return f.receipt_id === e._id;
        });
        this.receiptsDay.push(receiptDetailDay);
        return parseInt(e.total);
      });
      // loi nhuan chua sap xep
      var profit = [];
      this.receiptsDay.forEach((element, ind) => {
        var amount = element.map((value) => {
          return value.amount;
        });
        var product = this.products.filter((e) => {
          return e._id === element[0].product_id;
        });
        var importPrices = product.reduce((acc, value, index) => {
          return acc + parseInt(value.importPrice) * parseInt(amount[index]);
        }, 0);
        profit.push(revenue[ind] - importPrices);
      });
      //1 troi yeu thuong:)))
      for (var i = 0; i < receiptsDay.length - 1; i++) {
        if (receiptsDay[i].createDay === receiptsDay[i + 1].createDay) {
          revenue[i] += revenue[i + 1];
          profit[i] += profit[i + 1];
          revenue.splice(i + 1, 1);
          profit.splice(i + 1, 1);
          receiptsDay.splice(i + 1, 1);
          if(receiptsDay.length===1) break;
          i--;
        }
      }
      var j = 0;
      var i= 0;
      var datecheck = new Date(this.startDay1);
      var lengths = this.daysdifference(this.startDay1, this.endDay1);
      for (; i <= lengths; i++) {
        var dateRec = new Date(receiptsDay[j].createDay);
        if (datecheck.getTime() < dateRec.getTime()) {
          this.revenue.push(0);
          this.profit.push(0);
        } else if (datecheck.getTime() === dateRec.getTime()) {
          this.revenue.push(revenue[j]);
          this.profit.push(profit[j]);
          j++;
          if (j >= receiptsDay.length) { i++;break;}
        } else {
          break;
        }
        datecheck.setDate(datecheck.getDate() + 1);
      }
      for(;i<=lengths;i++)
      {
          this.revenue.push(0);
          this.profit.push(0);
      }
    },
    createLabelWithDay(startDay, endDay) {
      // push tuần đầu tiên
      var labels = [];
      var rangeDay = this.daysdifference(startDay, endDay)
      var currentDay = new Date(startDay).getDay();
      if (7 - currentDay <= rangeDay + 1) {
        labels.push(
          ...this.dayinWeek.filter((e, i) => {
            return i >= currentDay;
          })
        );
      }
      var allweek = Math.floor((rangeDay + 1 - (7 - currentDay)) / 7);
      var residualDays = (rangeDay + 1 - (7 - currentDay)) % 7;
      // push các tuần trong năm
      for (var i = 0; i < allweek; ++i) {
        labels.push(...this.dayinWeek);
      }

      // push các ngày còn lại
      labels.push(
        ...this.dayinWeek.filter((e, i) => {
          return i < residualDays;
        })
      );
      return labels;
    },
    // tim ngay giua 2 thoi diem
    daysdifference(startDay, endDay) {
      var startDay1 = new Date(startDay);
      var endDay1 = new Date(endDay);

      var millisBetween = startDay1.getTime() - endDay1.getTime();
      var days = millisBetween / (1000 * 3600 * 24);

      return Math.round(Math.abs(days));
    },
    //so sanh ngay de sort
    compareDay(date1, date2) {
      var datemot = new Date(date1.createDay);
      var datehai = new Date(date2.createDay);
      if (datehai.getFullYear() > datemot.getFullYear()) {
        return -1;
      }
      if (datehai.getMonth() > datemot.getMonth()) {
        return -1;
      }
      if (datehai.getDate() > datemot.getDate()) {
        return -1;
      }
      return 1;
    },
  },
};
</script>

<style scoped>
</style>

