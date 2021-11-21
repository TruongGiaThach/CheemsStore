<template>
  <div
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
    :revenue="revenue"
    :labels="labels"
    :profit="profit"
    style="background: white"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold" style="color: rgb(100, 100, 100); ">
            Tổng quan
          </h6>
          <div class="d-flex flex-no-wrap justify-space-between mr-5">
            <h2 class="text-info text-xl font-semibold">Doanh thu & Lợi nhuận</h2>            <slot></slot>
          </div>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <!-- Chart -->
      <div class="relative h-500-px" height="400">
        <line-chart :data="data1" :options="options"></line-chart>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";
import LineChart from ".././LineChart.js";
export default {
  components: {
    LineChart,
  },
  props: {
    labels: {
      type: Array,
      default: [],
    },
    revenue: {
      type: Array,
      default: [],
    },
    profit: {
      type: Array,
      default: [],
    },
  },
  beforeUpdate() {
      if(this.labels.length!=0){
    this.data1 = {
      labels: this.labels,
      datasets: [
        {
          label: "Doanh thu",
          backgroundColor: "#2196f3",
          borderColor: "#2196f3",
          data: this.revenue,
          fill: false,
        },
        {
          label: "Lợi nhuận",
          fill: false,
          backgroundColor: "#F37E21",
          borderColor: "#F37E21",
          data: this.profit,
        },
      ],
    },
    this.options = {
        maintainAspectRatio: false,
        responsive: true,
        title: {
          display: false,
          text: "Bán Hàng",
          fontColor: "info",
        },
        legend: {
          labels: {
            fontColor: "rgb(100, 100, 100)",
          },
          align: "end",
          position: "bottom",
        },
        tooltips: {
          mode: "index",
          intersect: false,
        },
        hover: {
          mode: "nearest",
          intersect: true,
        },
        scales: {
          xAxes: [
            {
              ticks: {
                fontColor: "rgb(100, 100, 100)",
              },
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Thời gian", //
                fontColor: "black",
              },
              gridLines: {
                display: true,
                borderDash: [2],
                borderDashOffset: [2],
                color: "rgb(255,255,255)",
                zeroLineColor: "rgba(0, 0, 0, 0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                fontColor: "rgb(100, 100, 100)",
              },
              display: true,
              scaleLabel: {
                display: true,
                labelString: "VNĐ",
                fontColor: "black",
              },
              gridLines: {
                display: true,
                borderDash: [3],
                borderDashOffset: [3],
                drawBorder: false,
                color: "rgba(0, 0, 0, 0.15)",
                zeroLineColor: "rgba(33, 37, 41, 0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
          ],
        },
      };
    }
  },
  data() {
    return {
      data1:
      {
      labels:  ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
      datasets: [
        {
          label: "Doanh thu",
          backgroundColor: "#2196f3",
          borderColor: "#2196f3",
          data: [2,3,4,5,6, 20],
          fill: false,
        },
        {
          label: "Lợi nhuận",
          fill: false,
          backgroundColor: "#F37E21",
          borderColor: "#F37E21",
          data: [20,2,3,4,5,6],
        },
      ],
    },
      options:{
        maintainAspectRatio: false,
        responsive: true,
        title: {
          display: false,
          text: "Sales Charts",
          fontColor: "info",
        },
        legend: {
          labels: {
            fontColor: "#FFF",
          },
          align: "end",
          position: "bottom",
        },
        tooltips: {
          mode: "index",
          intersect: false,
        },
        hover: {
          mode: "nearest",
          intersect: true,
        },
        scales: {
          xAxes: [
            {
              ticks: {
                fontColor: "rgba(141, 238, 238,.7)",
              },
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Thời gian", //
                fontColor: "#FFFFFF",
              },
              gridLines: {
                display: true,
                borderDash: [2],
                borderDashOffset: [2],
                color: "blue",
                zeroLineColor: "rgba(0, 0, 0, 0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                fontColor: "rgba(141, 238, 238,.7)",
              },
              display: true,
              scaleLabel: {
                display: true,
                labelString: "VNĐ",
                fontColor: "white",
              },
              gridLines: {
                display: true,
                borderDash: [3],
                borderDashOffset: [3],
                drawBorder: false,
                color: "rgba(255, 255, 255, 0.15)",
                zeroLineColor: "rgba(33, 37, 41, 0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
          ],
        },
      },
    };
  },
};
</script>
