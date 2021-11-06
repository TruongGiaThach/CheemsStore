<template>
  <ScrollTopComponent>
      <a class="btn btn-light">
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
  color: #d2691ed5;
  background-color: transparent;
  border-width:0;
}
</style>
