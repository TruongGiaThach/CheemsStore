<template>
  <ScrollTopComponent>
      <a class="btn">
        <i class="fas fa-chevron-circle-up fa-3x"></i>
      </a>
  </ScrollTopComponent>
</template>

<script>
import ScrollTopComponent from './ScrollTopComponent'
export default {
  components: {
    ScrollTopComponent
  }
}
</script>

<style scoped>
.btn {
  color: #d2691eb7;
  background-color: transparent;
  border-width:0;
}
.btn:active{
  color: #d2691e;
  background-color: transparent;
}
</style>
