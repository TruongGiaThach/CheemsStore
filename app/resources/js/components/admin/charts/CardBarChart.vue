<template>
  <v-card
    class="
      relative
      flex flex-col
      min-w-0
      break-words
      w-full
      mb-6
      shadow-lg
      rounded
    "
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
            Chi tiết
          </h6>
          <div class="d-flex flex-no-wrap justify-space-between mr-5">
            <h2 class="text-info text-xl font-semibold">
              Số Lượng
            </h2>
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <div class="relative h-350-px" style="height: 400px">
        <bar-chart :data="data1" :options="options"></bar-chart>
      </div>
    </div>
  </v-card>
</template>
<script>
import BarChart from "./BarChart.js";
export default {
  props: {
    customers: {
      type: Array,
      default: [],
    },
    orders: {
      type: Array,
      default: [],
    },
    labels: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      data1: [],
      options: [],
    };
  },
  components: {
    BarChart,
  },
  beforeUpdate() {
    (this.data1 = {
      labels: this.labels,
      datasets: [
        {
          label: "Khách hàng",
          backgroundColor: "#F37E21",
          borderColor: "#F37E21",
          data: this.customers,
          fill: false,
          barThickness: 10,
        },
        {
          label: "Sản phẩm",
          fill: false,
          backgroundColor: "#4c51bf",
          borderColor: "#4c51bf",
          data: this.orders,
          barThickness: 10,
        },
      ],
    }),
      (this.options = {
        maintainAspectRatio: false,
        responsive: true,
        title: {
          display: false,
          text: "Số lượng",
        },
        tooltips: {
          mode: "index",
          intersect: false,
        },
        hover: {
          mode: "nearest",
          intersect: true,
        },
        legend: {
          labels: {
            fontColor: "rgb(100, 100, 100)",
          },
          align: "end",
          position: "bottom",
        },
        scales: {
          xAxes: [
            {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Thời gian",
              },
              gridLines: {
                borderDash: [2],
                borderDashOffset: [2],
                color: "rgba(100, 100, 100, 0.5)",
                zeroLineColor: "rgb(100, 100, 100)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
          ],
          yAxes: [
            {
              display: true,
              scaleLabel: {
                display: false,
                labelString: "Value",
              },
              gridLines: {
                borderDash: [2],
                drawBorder: false,
                borderDashOffset: [2],
                color: "rgba(100, 100, 100, 0.5)",
                zeroLineColor: "rgb(100, 100, 100)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
          ],
        },
      });
  },
};
</script>
