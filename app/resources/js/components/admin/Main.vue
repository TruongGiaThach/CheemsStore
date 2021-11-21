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
            <customer-chart></customer-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#39f" height="180"> 
            
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#f9b115" height="180"> 
            <product-amount-chart></product-amount-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#e55353" height="180">
            <input type="date" id="startDay" v-model="startDay" />
            <input type="date" id="endDay" v-model="endDay" />
          </v-card>
        </v-col>
      </v-row>
      <v-row align-content-end full-width>
        <v-col>
          <v-card>
            <card-line-chart
              :labels="labels"
              :revenue="revenue"
              :profit="profit"
            >
              <div
                class="btn-group"
                role="group"
                aria-label="Basic radio toggle button group"
              >
                <input
                  type="radio"
                  class="btn-check"
                  name="btnradio"
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
                  name="btnradio"
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
                  name="btnradio"
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
            <card-bar-chart />
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import CustomerChart from "./charts/CustomerChart";
import ProductAmountChart from "./charts/ProductAmountChart";
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
      startDay: new Date("2021-11-12").toISOString().slice(0, 10),
      endDay: new Date().toISOString().slice(0, 10),
    };
  },
  components: {
    CardLineChart,
    CardBarChart,
    CustomerChart,
    ProductAmountChart,
  },
  beforeMount() {
    axios
      .get("/api/customer/")
      .then((response) => {
        this.customers = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get("/api/receipt/")
      .then((response) => {
        this.receipts = response.data;
        for (var i = 0; i < response.data.length; i++) {
          this.values.push(response.data[i].total);
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
    axios
      .get("/api/receipt_detail")
      .then((response) => {
        this.receiptDetails = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
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
      this.createLabelWithYear();
      this.creatDataWithYear();
      this.check = index;
    },
    createStatisticWithMonth(index) {
      this.createLabelWithMonth();
      this.createDataWithMonth();
      this.check = index;
    },
    createStatisticWithDay(index) {
      this.createLabelWithDay();
      this.createDataWithDay();
      this.check = index;
    },
    creatDataWithYear() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.filter((e) => {
        return (
          new Date(e.createDay).getYear() <= new Date(this.endDay).getYear() &&
          new Date(e.createDay).getYear() >= new Date(this.startDay).getYear()
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
      var yearcheck = new Date(this.startDay);
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
    createLabelWithYear() {
      this.labels = [];
      var yearStart = new Date(this.startDay).getFullYear();
      var yearEnd = new Date(this.endDay).getFullYear();
      for (var i = yearStart; i <= yearEnd; i++) {
        this.labels.push(i);
      }
    },
    createDataWithMonth() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.filter((e) => {
        return (
          new Date(e.createDay).getYear() <= new Date(this.endDay).getYear() &&
          (new Date(e.createDay).getYear() >
            new Date(this.startDay).getYear() ||
            ((new Date(e.createDay).getYear() ===
              new Date(this.startDay).getYear()) &&
              (new Date(e.createDay).getMonth() >=
                new Date(this.startDay).getMonth())))
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
      var monthcheck = new Date(this.startDay);
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
    },
    createLabelWithMonth() {
      this.labels = [];
      var monthStart = new Date(this.startDay).getMonth();
      var monthEnd = new Date(this.endDay).getMonth();
      var yearStart = new Date(this.startDay).getFullYear();
      var yearEnd = new Date(this.endDay).getFullYear();
      if (yearStart < yearEnd) {
        this.labels.push(
          ...this.monthinYear.filter((e, i) => {
            return i >= monthStart;
          })
        );
        for (var i = 0; i < yearEnd - yearStart - 1; i++) {
          this.labels.push(...this.monthinYear);
        }
        this.labels.push(
          ...this.monthinYear.filter((e, i) => {
            return i <= monthEnd;
          })
        );
      } else {
        this.labels.push(
          ...this.monthinYear.filter((e, i) => {
            return i >= monthStart && i <= monthEnd;
          })
        );
      }
    },
    createDataWithDay() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.filter((e) => {
        return (
          new Date(e.createDay).getTime() <= new Date(this.endDay).getTime() &&
          new Date(e.createDay).getTime() >= new Date(this.startDay).getTime()
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
      var datecheck = new Date(this.startDay);
      var lengths = this.daysdifference();
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
    createLabelWithDay() {
      // push tuần đầu tiên
      this.labels = [];
      var currentDay = new Date(this.startDay).getDay();
      if (7 - currentDay <= this.daysdifference() + 1) {
        this.labels.push(
          ...this.dayinWeek.filter((e, i) => {
            return i >= currentDay;
          })
        );
      }
      var allweek = Math.floor(
        (this.daysdifference() + 1 - (7 - currentDay)) / 7
      );
      var residualDays = (this.daysdifference() + 1 - (7 - currentDay)) % 7;
      // push các tuần trong năm
      for (var i = 0; i < allweek; ++i) {
        this.labels.push(...this.dayinWeek);
      }

      // push các ngày còn lại
      this.labels.push(
        ...this.dayinWeek.filter((e, i) => {
          return i < residualDays;
        })
      );
    },
    // tim ngay giua 2 thoi diem
    daysdifference() {
      var startDay = new Date(this.startDay);
      var endDay = new Date(this.endDay);

      var millisBetween = startDay.getTime() - endDay.getTime();
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
