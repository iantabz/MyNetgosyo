<template>
  <!-- box-shadow: rgba(0, 0, 0, 0.1) -4px 9px 25px -6px; -->
  <!-- box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; -->
  <!-- box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; -->
  <div class="list-group" style="background-color:#fff;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
    <div class="list-group-item"  
      style="padding:0;padding-left:12px;background-color:#f2f2f2;">
        <h5>{{ title }}</h5>
    </div>
    <div class="list-group-item">
        <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
    props: ['title'],
    data() {
        return {

        }
    },

    
};
</script>

<style scoped></style>
