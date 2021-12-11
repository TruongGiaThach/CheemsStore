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
            <customer-chart
              :customers="customer_c"
              :time="time"
              :total="customer_total"
            ></customer-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#39f" height="180">
            <receipt-amount-chart
              :receipts="receipt_c"
              :time="time"
              :total="receipt_total"
            ></receipt-amount-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#f9b115" height="180">
            <product-amount-chart
              :products="product_c"
              :time="time"
              :total="product_total"
            ></product-amount-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#e55353" height="180">
            <buy-ratio-chart
              :ratio="ratio_c"
              :time="time"
              :total="ratio_total"
            ></buy-ratio-chart>
          </v-card>
        </v-col>
      </v-row>
      <v-row align-content-end full-width>
        <v-col>
          <v-card>
            <card-line-chart
              v-model="startDay1"
              :labels="labels"
              :revenue="revenue"
              :profit="profit"
            >
              <div class="btn-group" role="group">
                <div class="calender">
                  <input
                    type="date"
                    id="endDay"
                    v-model="endDay1"
                    :max="this.today"
                    v-on:input="changeDate1()"
                  />
                </div>

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio1"
                  id="btnradio1"
                  autocomplete="off"
                  value="1"
                  v-model="check"
                  checked
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio1"
                  @click="createStatisticWithDay()"
                  >Ngày</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio1"
                  id="btnradio2"
                  autocomplete="off"
                  value="2"
                  v-model="check"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio2"
                  @click="createStatisticWithMonth()"
                  >Tháng</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio1"
                  id="btnradio3"
                  autocomplete="off"
                  value="3"
                  v-model="check"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio3"
                  @click="createStatisticWithYear()"
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
            <card-bar-chart
              v-model="startDay2"
              :labels="labels2"
              :customers="sCustomers"
              :orders="sOrder"
            >
              <div class="btn-group" role="group">
                <div class="calender">
                  <input
                    type="date"
                    id="endDay"
                    v-model="endDay2"
                    :max="this.today"
                    v-on:input="changeDate2()"
                  />
                </div>
                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio2"
                  id="btnradio4"
                  autocomplete="off"
                  value="1"
                  v-model="check2"
                  checked
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio4"
                  @click="createStatisticWithDay2()"
                  >Ngày</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio2"
                  id="btnradio5"
                  autocomplete="off"
                  value="2"
                  v-model="check2"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio5"
                  @click="createStatisticWithMonth2()"
                  >Tháng</label
                >

                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio2"
                  id="btnradio6"
                  autocomplete="off"
                  value="3"
                  v-model="check2"
                />
                <label
                  class="btn btn-outline-primary --text"
                  for="btnradio6"
                  @click="createStatisticWithYear2()"
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
      check2: 1,
      profit: [],
      revenue: [],
      productrRevert: [],
      cost: [],
      labels: [],
      receiptsDay: [],
      customer_c: [],
      customer_total: 0,
      receipt_c: [],
      receipt_total: 0,
      product_c: [],
      product_total: 0,
      ratio_c: [],
      ratio_total: 0.00,
      // dư lieu duoc lay len
      customers: [],
      receipts: [],
      products: [],
      receiptDetails: [],
      labelYears:[],
      values: [],
      // dayinWeek: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
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
      today: new Date().toISOString().slice(0, 10),
      startDay1: new Date(new Date().valueOf() - 86400000 * 7)
        .toISOString()
        .slice(0, 10),
      endDay1: new Date().toISOString().slice(0, 10),
      startDay2: new Date(new Date().valueOf() - 86400000 * 7)
        .toISOString()
        .slice(0, 10),
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
        if (response.data.length > 0) {
          this.customers = response.data;
          this.customer_total = response.data.length;
          var count = 0;
          var month = 0;
          var day = new Date(response.data[0].created_at).getMonth();
          for (var i = 0; i < response.data.length; i++) {
            if (new Date(response.data[i].created_at).getMonth() != day) {
              day = new Date(response.data[i].created_at).getMonth();
              this.customer_c.push(count);
              count = 1;
              month++;
              if (month > 6) return;
            } else {
              count++;
            }
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
        if (response.data.length > 0) {
          this.receiptDetails = response.data;
          this.product_total = response.data.length;
          var count = 0;
          var month = 0;
          var day = new Date(response.data[0].created_at).getMonth();
          for (var i = 0; i < response.data.length; i++) {
            if (new Date(response.data[i].created_at).getMonth() != day) {
              day = new Date(response.data[i].created_at).getMonth();
              ratio[month] = count;
              this.product_c.push(count);
              count = 1;
              month++;
              if (month > 6) return;
            } else {
              count += response.data[i].amount;
            }
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
        if (response.data.length > 0) {
          this.receipts = response.data;
          for (var i = 0; i < response.data.length; i++) {
            this.values.push(response.data[i].total);
          }
          this.receipt_total = response.data.length;
          var count = 0;
          var month = 0;
          var day = new Date(response.data[0].created_at).getMonth();
          for (var i = 0; i < response.data.length; i++) {
            if (new Date(response.data[i].created_at).getMonth() != day) {
              day = new Date(response.data[i].created_at).getMonth();
              //add Ratio (tù vl, nhưng mà đel làm khác đc ae à, ngồi cả ngày chỉ còn cách nhét vô đây thôi)
              ratio[month] = ratio[month] / count;
              ratioTotal += ratio[month];
              this.ratio_c.push(ratio[month].toFixed(2));
              this.receipt_c.push(count);
              count = 1;
              month++;
              if (month > 6) return;
            } else {
              count++;
            }
          }
          this.receipt_c.push(count);
          ratio[month] = ratio[month] / count;
          ratioTotal += ratio[month];
          ratioTotal = ratioTotal / ratio.length;
          this.ratio_c.push(ratio[month].toFixed(2));
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
        this.revertAmountProduct()
      })
      .catch((error) => {
        console.error(error);
      });

    for (var i = 5; i > -2; i--) {
      this.time.push("Tháng " + (new Date().getMonth() - i).toString());
    }
  },
  created() {
    //Tạo line chart
    setTimeout(() => {
      this.createStatisticWithDay();
      this.createStatisticWithDay2();
    }, 500);
  },
  methods: {
    revertAmountProduct(){
        this.receiptDetails.forEach((e)=>{
            let a =this.products.findIndex(c=>c._id == e.product_id)
            if(a!=-1){
                this.products[a].amount+=e.amount
                console.log(e)
            }
        })
    },
    changeDate1() {
      if (this.check == 1) {
        this.createStatisticWithDay();
      } else if (this.check == 2) {
        this.createStatisticWithMonth();
      } else {
        this.createStatisticWithYear();
      }
    },
    changeDate2() {
      if (this.check2 == 1) {
        this.createStatisticWithDay2();
      } else if (this.check2 == 2) {
        this.createStatisticWithMonth2();
      } else {
        this.createStatisticWithYear2();
      }
    },
    createStatisticWithYear() {
      this.startDay1 = new Date(
        new Date(this.endDay1).valueOf() - 31536000000 * 7
      )
        .toISOString()
        .slice(0, 10);
      this.labels = this.createLabelWithYear(this.startDay1, this.endDay1);
      this.crData("year");
    },
    createStatisticWithMonth() {
      this.startDay1 = new Date(
        new Date(this.endDay1).valueOf() - 2678400000 * 7
      )
        .toISOString()
        .slice(0, 10);
      this.labels = this.createLabelWithMonth(this.startDay1, this.endDay1);
      this.crData("month");
    },
    createStatisticWithDay() {
      this.startDay1 = new Date(new Date(this.endDay1).valueOf() - 86400000 * 7)
        .toISOString()
        .slice(0, 10);
      this.labels = this.createLabelWithDay(this.startDay1);
      this.crData("day");
    },
    //bang thong ke 2
    createStatisticWithYear2() {
      this.startDay2 = new Date(
        new Date(this.endDay2).valueOf() - 31536000000 * 7
      )
        .toISOString()
        .slice(0, 10);
      this.labels2 = this.createLabelWithYear(this.startDay2, this.endDay2);
      this.crData2("year");
    },
    createStatisticWithMonth2() {
      this.startDay2 = new Date(
        new Date(this.endDay2).valueOf() - 2678400000 * 7
      )
        .toISOString()
        .slice(0, 10);
      this.labels2 = this.createLabelWithMonth(this.startDay2, this.endDay2);
      this.crData2("month");
    },
    createStatisticWithDay2() {
      this.startDay2 = new Date(new Date(this.endDay2).valueOf() - 86400000 * 7)
        .toISOString()
        .slice(0, 10);
      this.labels2 = this.createLabelWithDay(this.startDay2);
      this.crData2("day");
    },
    createLabelWithYear(startDay, endDay) {
      var labels = [];
      var yearStart = new Date(startDay).getFullYear();
      var yearEnd = new Date(endDay).getFullYear();
      for (var i = yearStart; i <= yearEnd; i++) {
        labels.push(i);
      }
      return labels;
    },
        createLabelWithMonth(startDay, endDay) {
      this.labelYears = []
      var labels = [];
      var monthStart = new Date(startDay).getMonth();
      var monthEnd = new Date(endDay).getMonth();
      var yearStart = new Date(startDay).getFullYear();
      var yearEnd = new Date(endDay).getFullYear();
      if (yearStart < yearEnd) {
        labels.push(
          ...this.monthinYear.filter((e, i) => {
              if(i >= monthStart) this.labelYears.push(yearStart)
            return i >= monthStart;
          })
        ); console.log(this.labelYears)
        for (var i = 0; i < yearEnd - yearStart - 1; i++) {
          labels.push(...this.monthinYear);
        }
        labels.push(
          ...this.monthinYear.filter((e, i) => {
              if(i <= monthEnd) this.labelYears.push(yearEnd)
            return i <= monthEnd;
          })
        );
      } else {
        labels.push(
          ...this.monthinYear.filter((e, i) => {
              if(i >= monthStart && i <= monthEnd) this.labelYears.push(yearEnd)
            return i >= monthStart && i <= monthEnd;
          })
        );
      }
      console.log(labels)
      return labels;
    },
    createLabelWithDay(startDay) {
      // push tuần đầu tiên
      // var labels = [];
      // var rangeDay = 7; //this.daysdifference(startDay, endDay)
      // var currentDay = new Date(startDay).getDay();
      // if (7 - currentDay <= rangeDay + 1) {
      //   labels.push(
      //     ...this.dayinWeek.filter((e, i) => {
      //       return i >= currentDay;
      //     })
      //   );
      // }
      // var allweek = Math.floor((rangeDay + 1 - (7 - currentDay)) / 7);
      // var residualDays = (rangeDay + 1 - (7 - currentDay)) % 7;
      // // push các tuần trong năm
      // for (var i = 0; i < allweek; ++i) {
      //   labels.push(...this.dayinWeek);
      // }

      // // push các ngày còn lại
      // labels.push(
      //   ...this.dayinWeek.filter((e, i) => {
      //     return i < residualDays;
      //   })
      // );
      var labels = [];
      this.labelYears = []
      var currentDay = new Date(startDay).getDate();
      var currentMonth = new Date(startDay).getMonth() + 1;
      var currentYear = new Date(startDay).getFullYear();
      if (currentMonth == 2) {
        var i = 0;
        for (; i < 8; i++) {
          if (currentDay > 28) break;
          labels.push(currentDay++ + "/" + currentMonth);
          this.labelYears.push(currentYear)
        }
        ++i;
        if (this.checkNamNhuan(currentYear)==true && currentDay > 28) {
          labels.push(currentDay + "/" + currentMonth);
          this.labelYears.push(currentYear)
        }
        currentDay = 1;
        currentMonth += 1;
        for (; i < 8; i++) {
          labels.push(currentDay++ + "/" + currentMonth);
          this.labelYears.push(currentYear)
        }
        console.log(labels)
        return labels;
      } else {
        var i = 0;
        for (; i < 8; i++) {
          if (currentDay > 30) break;
          labels.push(currentDay++ + "/" + currentMonth);
          this.labelYears.push(currentYear)
        }
        console.log(labels)
        ++i;
        if(this.checkMonth(currentMonth)=="chan" && currentDay > 30)
        {
            labels.push(currentDay + "/" + currentMonth);
            this.labelYears.push(currentYear)
        }
        if(this.currentMonth==12){
            currentMonth =1
            currentYear+=1
        }
        else currentMonth +=1;
        currentDay =1;
        for (; i < 8; i++) {
          labels.push(currentDay++ + "/" + currentMonth);
          this.labelYears.push(currentYear)
        }
        return labels;
      }
    },
    checkNamNhuan(year) {
      if (
        ((year % 4 === 0 && year % 100 !== 0) || year % 400 !== 0)
      ){
        return true;
      }
      return false;
    },
    checkMonth(month) {
      if (month == 4 || month == 6 || month == 9 || month == 11) return "le";
      else if (month == 2) return "2";
      else return "chan";
    },
    compareTime(time1,year1,time2,cate)
    {
        if(cate== "day"){
            let temp = time1.split('/')
            let d = new Date(time2)
            if(year1!= d.getFullYear()) return fasle;
            return ((d.getMonth()+1) == temp[1] && d.getDate()== temp[0])
        } else if( cate =="month")
        {
            let cut = time1.slice(6,time1.length)
            let day = new Date(time2)
            if(year1 != day.getFullYear()) return false;
            return cut == (day.getMonth()+1)
        } else {
            let day = new Date(time2)
            return time1 == day.getFullYear()
        }
    },
    crData(cate)
    {
        this.revenue=[]
        this.profit =[]
        this.cost = []
        let moneyOfCost = 0
        let moneyOfRevenue = 0
        this.labels.forEach((element, index)=>{
            this.receipts.forEach((e)=>{
                if(this.compareTime(element,this.labelYears[index], e.created_at, cate)){
                    moneyOfRevenue+=parseInt(e.total)
                    moneyOfCost+=parseInt(e.VAT)
                }
            })
            this.products.forEach((e)=>{
                if(this.compareTime(element,this.labelYears[index], e.created_at, cate)){
                    moneyOfCost+=parseInt(e.importPrice)*parseInt(e.amount)
                }
            })
            this.revenue.push(moneyOfRevenue)
            this.cost.push(moneyOfCost)
            this.profit.push(moneyOfRevenue-moneyOfCost)
            moneyOfRevenue = 0
            moneyOfCost = 0
        })
    },
    crData2(cate)
    {
        this.sCustomers = []
        this.sOrder = []
        let customerAmount =[]
        let productAmount = []
        this.labels2.forEach((element, index)=>{
            customerAmount = this.customers.filter((e)=>{
                return (this.compareTime(element,this.labelYears[index], e.created_at, cate))
            })
            productAmount = this.receiptDetails.filter((e)=>{
                return (this.compareTime(element,this.labelYears[index], e.created_at, cate))
            })
            this.sCustomers.push(customerAmount.length)
            this.sOrder.push(productAmount.length)
        })
    },
  },
};
</script>

<style scoped>
.calender {
  border: 1px solid #2196f3;
  height: 2.6em;
  border-radius: 3px;
  margin-right: 1em;
}
.calender #endDay {
  padding: 0.5em;
  vertical-align: center;
  color: rgb(100, 100, 100);
}
.calender #endDay:focus {
  outline-color: #2196f3;
}
::-webkit-calendar-picker-indicator {
  filter: invert(40%) sepia(0%) saturate(0%) hue-rotate(50deg) brightness(96%)
    contrast(89%);
}
</style>
