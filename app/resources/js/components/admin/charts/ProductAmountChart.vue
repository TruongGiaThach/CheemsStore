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
    data(){
        return{
          time: [],
          productAmount: [],
          total: [],
        }
    },
    beforeMount() {
      axios.get('/api/receipt_detail/')
            .then(response => {
              if(response.data.length > 0){
                this.total = response.data.length;
                var count = 0;
                var month = 0;
                var day = new Date(response.data[0].created_at).getMonth();
                  for(var i = 0; i < response.data.length; i++){
                    if(new Date(response.data[i].created_at).getMonth() != day){
                      day = new Date(response.data[i].created_at).getMonth();
                      this.productAmount.push(count);
                      count = 1;
                      month++;
                      if(month > 6) return;
                    }else{count += response.data[i].amount;}
                  }
                this.productAmount.push(count);
              }
            })
            .catch(error => {
                console.error(error);
            })

        for(var i = 5; i > -2; i--){
          this.time.push("Tháng " + (new Date().getMonth() - i).toString());
        }
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
                data: this.productAmount,
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
  padding-bottom: 1.5em;
}
.graph {
  padding-right: 0.1em;
  padding-left: 0.1em;
}
</style>