<!-- @format -->

<template>
  <div id="page-body">
    <!-- <div class="tab-base">
      <ul class="nav nav-tabs">
        <li class="active">
          <a data-toggle="tab" href="#products-tab" aria-expanded="true"
            >Top Products
          </a>
        </li>
        <li class="">
          <a data-toggle="tab" href="#customers-tab" aria-expanded="false"
            >Top Customers</a
          >
        </li>
        <li class="">
          <a data-toggle="tab" href="#salesman-tab" aria-expanded="false"
            >Top Salesman</a
          >
        </li>
        <li class="">
          <a data-toggle="tab" href="#jefe-tab" aria-expanded="false"
            >Top Jefe de Viaje</a
          >
        </li>
      </ul>

      <div class="tab-content">
        <div id="products-tab" class="tab-pane fade active in">
          <TopProducts></TopProducts>
        </div>
        <div id="customers-tab" class="tab-pane fade">
          <TopCustomer></TopCustomer>
        </div>
        <div id="salesman-tab" class="tab-pane fade">
          <TopSalesman></TopSalesman>
        </div>
      </div>
    </div> -->
    <div class="panel">
      <!-- <div class="panel-body">
        <div
          class="panel-heading pad-top pad-btm mar-btm"
          id="showTitle"
          v-if="!show_div"
        >
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px;">
            <i class="fa fa-file-text-o"></i> Sales Report
          </h3>
        </div>
        <div class="panel-body" v-if="!show_div">
          <ul>
            <li style="margin-bottom: 10px">
              <a
                href="javascript:;"
                @click=";(show_div = true), (report = 'Sales Report')"
                class="text-warning"
                ><u>Sales Report per Salesman/ Customer</u></a
              >
            </li>
            <li style="margin-bottom: 10px">
              <a
                href="javascript:;"
                @click=";(show_div = true), (report = 'Sales Report Jepe')"
                class="text-warning"
                ><u>Sales Report per Jepe de Viaje</u></a
              >
            </li>

            <li style="margin-bottom: 10px">
              <a
                href="javascript:;"
                @click=";(show_div = true), (report = 'Top Products')"
                class="text-warning"
              >
                <u> Top Products </u>
              </a>
            </li>
            <li style="margin-bottom: 10px">
              <a
                href="javascript:;"
                @click=";(show_div = true), (report = 'Top Customer')"
                class="text-warning"
              >
                <u> Top Customer</u>
              </a>
            </li>
            <li style="margin-bottom: 10px">
              <a
                href="javascript:;"
                @click=";(show_div = true), (report = 'Top Salesman')"
                class="text-warning"
              >
                <u> Top Salesman</u>
              </a>
            </li>
            <li style="margin-bottom: 10px">
              <a
                href="javascript:;"
                @click=";(show_div = true), (report = 'Top Jepe de Viaje')"
                class="text-warning"
              >
                <u> Top Jepe de Viaje</u>
              </a>
            </li>
          </ul>
        </div>
      </div> -->
      <div class="panel-body">
        <div class="fixed-fluid" v-if="!show_div">
          <div class="fluid faq-accordion">
            <h4 class="pad-btm bord-btm">
              <i
                class="fa fa-file-text-o icon-fw v-middle"
                style="font-size: 18px;"
              ></i>
              Sales Report
            </h4>
            <div
              id="demo-gen-faq"
              class="panel-group panel-group-trans panel-group-condensed accordion"
              style="padding-left: 10px"
            >
              <div class="panel">
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click=";(show_div = true), (report = 'Sales Report')"
                    >
                      <i class="pci-chevron chevron-right"></i> Sales Report per
                      Salesman/ Customer
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click="
                        ;(show_div = true), (report = 'Sales Report Jepe')
                      "
                    >
                      <i class="pci-chevron chevron-right"></i> Sales Report per
                      Jepe de Viaje
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click=";(show_div = true), (report = 'Top Products')"
                    >
                      <i class="pci-chevron chevron-right"></i> Top Products
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click=";(show_div = true), (report = 'Top Customer')"
                    >
                      <i class="pci-chevron chevron-right"></i> Top Customer
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click=";(show_div = true), (report = 'Top Salesman')"
                    >
                      <i class="pci-chevron chevron-right"></i> Top Salesman
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click="
                        ;(show_div = true), (report = 'Top Jepe de Viaje')
                      "
                    >
                      <i class="pci-chevron chevron-right"></i> Top Jepe de
                      Viaje
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click="
                        ;(show_div = true), (report = 'Customer Order Count')
                      "
                    >
                      <i class="pci-chevron chevron-right"></i>
                      Customer Order Count
                    </a>
                  </p>
                </div>
                <div class="panel-heading">
                  <p class="panel-title">
                    <a
                      class="collapsed"
                      href="javascript:;"
                      @click="
                        ;(show_div = true), (report = 'Source Order Count')
                      "
                    >
                      <i class="pci-chevron chevron-right"></i>
                      Source Order Count
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body" v-if="show_div">
          <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
              <button
                class="btn btn-primary btn-rounded pull-right"
                @click="show_div = false"
              >
                <i class="fa fa-arrow-left"></i> Back
              </button>
            </div>
          </div>
          <SalesReport v-if="report == 'Sales Report'" />
          <SalesReportJepe v-if="report == 'Sales Report Jepe'" />
          <TopProducts v-if="report == 'Top Products'" />
          <TopCustomer v-if="report == 'Top Customer'" />
          <TopSalesman v-if="report == 'Top Salesman'" />
          <TopJepe v-if="report == 'Top Jepe de Viaje'" />
          <CustomerOrderCount v-if="report == 'Customer Order Count'" />
          <SourceOrderCount v-if="report == 'Source Order Count'" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SalesReport from './SalesReport.vue'
import SalesReportJepe from './SalesReportJepe.vue'
import TopProducts from './TopProducts.vue'
import TopCustomer from './TopCustomer.vue'
import TopSalesman from './TopSalesman.vue'
import TopJepe from './TopJepe.vue'
import CustomerOrderCount from './CustomerOrderCount.vue'
import SourceOrderCount from './SourceOrder.vue'

export default {
  data() {
    return {
      show_div: false,
      report: null
    }
  },
  components: {
    SalesReport,
    SalesReportJepe,
    TopProducts,
    TopCustomer,
    TopSalesman,
    TopJepe,
    CustomerOrderCount,
    SourceOrderCount
  },
  methods: {},
  mounted() {
    this.$root.currentPage = this.$route.meta.name
  }
}
</script>

<style lang="scss" scoped>
.panel-group.accordion .panel-title a:hover,
.panel-group.accordion .panel-title a:focus {
  color: #db9a00;
  background-color: rgba(0, 0, 0, 0.05);
}
</style>
