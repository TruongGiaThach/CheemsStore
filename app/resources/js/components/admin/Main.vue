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
          <v-card color="#321fdb" height="180"
            ><customer-chart></customer-chart>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#39f" height="180"> </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#f9b115" height="180"> </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#e55353" height="180">
            <input type="date" id="startDay1" v-model="startDay1" />
            <input type="date" id="endDay1" v-model="endDay1" />
            <input type="date" id="startDay2" v-model="startDay2" />
            <input type="date" id="endDay2" v-model="endDay2" />
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
                  class="btn btn-outline-primary white--text"
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
                  class="btn btn-outline-primary white--text"
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
                  class="btn btn-outline-primary white--text"
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
            <card-bar-chart
            :labels ="labels2"
            :customers="sCustomers"
            :others="sOrder"
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
                  class="btn btn-outline-primary white--text"
                  for="btnradio1"
                  @click="createStatisticWithDay2(1)"
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
                  class="btn btn-outline-primary white--text"
                  for="btnradio2"
                  @click="createStatisticWithMonth2(2)"
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
                  class="btn btn-outline-primary white--text"
                  for="btnradio3"
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
import CardBarChart from "./charts/CardBarChart";
import CardLineChart from "./charts/CardLineChart";
export default {
  data() {
    return {
      // du lieu thong ke bang 1
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
      // du lieu thong ke bang 2
      sCustomers:[],
      sOrder: [],
      labels2: [],
      values: [],
      dayinWeek: ["Sun", "Mon", "Tue", "Web", "Thur", "Fri", "Sar"],
      monthinYear: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
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
  /*created() {
    setInterval(() => {
      if (this.check === 1)   this.createStatisticWithDay();
      if (this.check === 2)   this.createStatisticWithMonth();
      if (this.check === 3)   this.createStatisticWithYear();
      if (this.check2 === 1)   this.createStatisticWithDay2();
      if (this.check2 === 2)   this.createStatisticWithMonth2();
      if (this.check2 === 3)   this.createStatisticWithYear2();
    }, 5000);
  },*/
  methods: {
    // bang thong ke 1
    createStatisticWithYear(index) {
      this.labels = this.createLabelWithYear(this.startDay1, this.endDay1);
      this.creatDataWithYear();
      this.check = index;
    },
    createStatisticWithMonth(index) {
      this.labels=this.createLabelWithMonth(this.startDay1, this.endDay1);
      this.createDataWithMonth();
      this.check = index;
    },
    createStatisticWithDay(index) {
      this.labels=this.createLabelWithDay(this.startDay1, this.endDay1);
      this.createDataWithDay();
      this.check = index;
    },
    //bang thong ke 2
    createStatisticWithYear2(index) {
      this.labels2 = this.createLabelWithYear(this.startDay2, this.endDay2);
      this.creatData2WithYear();
      this.check2 = index;
    },
    createStatisticWithMonth2(index) {
      this.labels2=this.createLabelWithMonth(this.startDay2, this.endDay2);
      this.createData2WithMonth();
      this.check2 = index;
    },
    createStatisticWithDay2(index) {
      this.labels2=this.createLabelWithDay(this.startDay2, this.endDay2);
      this.createData2WithDay();
      this.check2 = index;
    },
    createData2WithYear()
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
    creatData2WithMonth()
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
    createData2WithDay()
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
    creatDataWithYear() {
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
      return labels;
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
      var allweek = Math.floor(
        (rangeDay + 1 - (7 - currentDay)) / 7
      );
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
