<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
    style="background: black;"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold">
            Overview
          </h6>
          <div class="d-flex flex-no-wrap justify-space-between mr-5">
          <h2 class="text-info text-xl font-semibold">
            Sales value
          </h2>
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <!-- Chart -->
      <div class="relative h-500-px" >
        <canvas height="400" id="line-chart"></canvas>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";

export default {
    props:{
        items:{
            type:Array,
            default: [],
        }
    },
    data(){
        return{}
    },
  mounted: function () {
    this.$nextTick(function () {
      var config = {
        type: "line",
        data: {
          labels: [
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
            "Dec"
          ],
          datasets: [
            {
              label: "Doang thu",
              backgroundColor: "#2196f3",
              borderColor: "#2196f3",
              data: [0, 78, 66, 44, 56, 67,101,100],
              fill: false,
            },
            {
              label: "Lợi nhuận",
              fill: false,
              backgroundColor: "#F37E21",
              borderColor: "#F37E21",
              data: this.items,
            },
          ],
        },
        options: {
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
                  labelString: "Month",//
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
                    display:true,
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
      var ctx = document.getElementById("line-chart").getContext("2d");
      window.myLine = new Chart(ctx, config);
    });
  },
};
</script>
