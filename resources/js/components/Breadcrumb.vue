<template>
  <div class="no-print" id="page-head">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
      <h1 class="page-header text-overflow">{{ currentPage }}</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="demo-pli-home"></i>
        </a>
      </li>
      <li>
        <a href="#">Pages</a>
      </li>
      <li class="active">{{ currentPage }}</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->
  </div>
</template>

<script>
/** @format */

export default {
  computed: {
    currentPage() {
      return this.$root.currentPage
    }
  }
}
</script>