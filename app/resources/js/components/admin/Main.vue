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
          <v-card color="#321fdb" height="180"><customer-chart></customer-chart> </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#39f" height="180"> </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card color="#f9b115" height="180"> </v-card>
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
            <card-line-chart :items="items">
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
                  @click="createLabelWithDay()"
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
import CardBarChart from "./charts/CardBarChart";
import CardLineChart from "./charts/CardLineChart";
export default {
  data() {
    return {
      profit: [],
      revenue: [],
      customers: [],
      receipts: [],
      products: [],
      receiptDetails: [],
      receiptsDay: [],
      values: [],
      items: [40, 500, 120, 200, 56, 300, 87],
      dayinWeek: ["Sun", "Mon", "Tue", "Web", "Thur", "Fri", "Sar"],
      labels: [],
      startDay: new Date().toISOString().slice(0, 10),
      endDay: new Date().toISOString().slice(0, 10),
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
  methods: {
    createDataWithDay() {
      this.revenue = [];
      this.profit = [];
      this.receiptsDay = [];
      var receiptsDay = this.receipts.fliter((e) => {
        return (
          new Date(e.createDay).getTime() <= this.endDay.getTime() &&
          new Date(e.createDay).getTime() >= this.endDay.getTime()
        );
      });
      //doanh thu
      this.revenue = receiptsDay.map((e) => {
        var receiptDetailDay = this.receiptDetails.filter((f) => {
          return f.receipt_id === e._id;
        });
        this.receiptsDay.push(receiptDetailDay);
        return parseInt(e.total);
      });
      // loi nhuan
      this.receiptsDay.forEach((element) => {
        var amount = element.map((value) => {
          return value.amount;
        });
        var product = this.products.fliter((e) => {
          return e._id === element[0].product_id;
        });
        var importPrices = product.reduce((acc, value, index) => {
          return acc + parseInt(value.importPrice * amount[index]);
        });
        this.profit.push(this.revenue - importPrices);
      });
    },
    createLabelWithDay() {
      // push tuần đầu tiên
      this.labels = [];
      var currentDay = new Date(this.startDay).getDay();
      this.labels.push(
        ...this.dayinWeek.filter((e, i) => {
          return i >= currentDay;
        })
      );
      var allweek = Math.floor((this.daysdifference() - (7 - currentDay)) / 7);
      var residualDays = (this.daysdifference() - (7 - currentDay)) % 7;
      // push các tuần trong năm
      for (var i = 0; i < allweek; ++i) {
        this.labels.push(...this.dayinWeek);
      }
      console.log(this.labels);
      // push các ngày còn lại
      this.labels.push(
        ...this.dayinWeek.filter((e, i) => {
          return i <= residualDays;
        })
      );
    },
    daysdifference() {
      var startDay = new Date(this.startDay);
      var endDay = new Date(this.endDay);

      var millisBetween = startDay.getTime() - endDay.getTime();
      var days = millisBetween / (1000 * 3600 * 24);

      return Math.round(Math.abs(days));
    },
  },
};
</script>

<style scoped>
</style>
