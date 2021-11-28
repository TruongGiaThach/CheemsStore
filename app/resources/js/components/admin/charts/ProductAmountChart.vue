<template>
  <div>
    <div class=" flex-auto">
        <div class="chart pt-6 pl-8 pr-6  rounded-t mb-0 px-2  bg-transparent">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full max-w-full flex-grow flex-1">
                <h4 class = "title-number">
                    {{total}}
                </h4>
                <h6 class = "title-name">
                    Sản phẩm bán ra
                </h6>
                </div>
                <div class="icon">
                  <v-icon x-large dark>mdi-package-variant</v-icon>
                </div>
            </div>
        </div>
      <!-- Chart -->
      <div>
        <canvas class="graph s" id="product-chart" height="84em"></canvas>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";

export default {
    props: {
      products: {
        type: Array,
        default: [],
      },
      time: {
        type: Array,
        default: [],
      },
      total: Number,
    },
    mounted() {
      this.$nextTick(function () {
        var config = {
          type: "line",
          data: {
            labels: this.time,
            datasets: [
              {
                label: "Sản phẩm",
                backgroundColor: "#f7c251",
                borderColor: "yellow",
                borderWidth: 1,
                data: this.products,
              },
            ],
          },
          options: {
            elements: {
                point:{
                    radius: 0,
                }
            },
            maintainAspectRatio: false,
            responsive: true,
            title: {
              display: false,
            },
            legend: {
              display: false,
            },
            hover: {
              mode: "nearest",
              intersect: true,
            },
            scales: {
              xAxes: [
                {
                  display: false,
                },
              ],
              yAxes: [
                {
                  display: false,
                },
              ],
            },
          },
        };
        var ctx = document.getElementById("product-chart").getContext("2d");
        var charts = new Chart(ctx, config);
        setTimeout(function() { charts.update(); },300);
      });
    },
};
</script>
<style scoped>
.title-number {
    color: white;
    font-weight: bold;
}
.title-name {
    color: white;
}
.chart {
  padding-bottom: 0.9em;
}
.graph {
  padding-right: 0.1em;
  padding-left: 0.1em;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
}
.icon{
  position: absolute;
  display: inline;
  right: 3.5em;
  top: 1.7em;
}
</style>