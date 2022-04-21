<!-- @format -->

<template>
  <div id="page-body">
    <div class="tab-base">
      <!--Nav Tabs-->
      <ul class="nav nav-tabs">
        <li class="active">
          <a data-toggle="tab" href="#salesman-tab" aria-expanded="true"
            >Salesman List
            <!-- <span class="badge badge-purple">27</span> -->
          </a>
        </li>
        <li class="">
          <a data-toggle="tab" href="#jefe-tab" aria-expanded="false"
            >Jefe de Viaje</a
          >
        </li>
        <!-- <li class="">
          <a data-toggle="tab" href="#demo-lft-tab-3" aria-expanded="false"
            >Salesman Route</a
          >
        </li> -->
      </ul>

      <!--Tabs Content-->
      <div class="tab-content">
        <div id="salesman-tab" class="tab-pane fade active in">
          <Salesman></Salesman>
        </div>
        <div id="jefe-tab" class="tab-pane fade">
          <Jefe></Jefe>
        </div>
        <!-- <div id="demo-lft-tab-3" class="tab-pane fade">
          <SalesmanRoutes></SalesmanRoutes>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script>
import Salesman from './SalesmanComponent.vue'
import Jefe from './HepedeViajeComponent.vue'
import SalesmanRoutes from './SalesmanRoutes.vue'

export default {
  data() {
    return {}
  },
  components: {
    Salesman,
    Jefe,
    SalesmanRoutes
  },
  methods: {},
  mounted() {}
}
</script>

<style lang="scss" scoped></style>
