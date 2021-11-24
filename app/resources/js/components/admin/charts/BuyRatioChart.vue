<template>
  <div>
    <div class="p-4 flex-auto">
        <div class="rounded-t mb-0 px-2  bg-transparent">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full max-w-full flex-grow flex-1">
                <h4 class = "title-number">
                    {{total}}
                </h4>
                <h6 class = "title-name">
                    Tỉ lệ sản phẩm / đơn hàng
                </h6>
                </div>
                <div class="icon">
                  <v-icon x-large dark>mdi-percent</v-icon>
                </div>
            </div>
        </div>
      <!-- Chart -->
      <div>
        <canvas class="pl-5 pr-2 s" id="ratio-chart" height="84em"></canvas>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";

export default {
    props: {
      ratio: {
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
          type: "bar",
          data: {
            labels: this.time,
            datasets: [
              {
                label: "Tỉ lệ",
                backgroundColor: "#e08282",
                borderColor: "rgba(255, 255, 255, 0.6)",
                borderWidth: 1,
                data: this.ratio,
                pointStyle: 'circle',
                pointRadius: 4,
              },
            ],
          },
          options: {
                layout: {
                padding: 4
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
        var ctx = document.getElementById("ratio-chart").getContext("2d");
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
.icon{
  position: absolute;
  display: inline;
  right: 3.5em;
  top: 1.7em;
}
</style>