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
                    Khách hàng
                </h6>
                </div>
            </div>
        </div>
      <!-- Chart -->
      <div>
        <canvas class="pl-5 pr-2  s" id="customer-chart" height="84em"></canvas>
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
          customerNum: [],
          total: [],
        }
    },
    beforeMount() {
      axios.get('/api/customer/')
            .then(response => {
              if(response.data.length > 0){
                this.total = response.data.length;
                var count = 0;
                var month = 0;
                var day = new Date(response.data[0].created_at).getMonth();
                  for(var i = 0; i < response.data.length; i++){
                    if(new Date(response.data[i].created_at).getMonth() != day){
                      day = new Date(response.data[i].created_at).getMonth();
                      this.customerNum.push(count);
                      count = 1;
                      month++;
                      if(month > 6) return;
                    }else{count++;}
                  }
                this.customerNum.push(count);
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
                label: "Khách hàng",
                backgroundColor: "#321fdb",
                borderColor: "rgba(255, 255, 255, 0.6)",
                borderWidth: 1,
                data: this.customerNum,
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
        var ctx = document.getElementById("customer-chart").getContext("2d");
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
</style>