

<template>
     <div class="flex d-flex-wrap">
      <div class="w-full  mb-12 xl:mb-0 px-4 mt-5">
        <card-line-chart :items="items" />
      </div>
      <div class="w-full xl:w-4/12 px-4 mt-5">
        <card-bar-chart />
      </div>
    </div>
</template>

<script>
import CardBarChart from "./CardBarChart";
import CardLineChart from "./CardLineChart"
  export default {
    data () {
      return {
          items:[40, 500, 120, 200, 56, 300, 87],
      }
    },
    computed: {
    },
    methods: {
    },
    components: {
      CardBarChart,
      CardLineChart
    }
  }
</script>
