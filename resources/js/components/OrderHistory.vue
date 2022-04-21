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
      <div class="panel-body">
        <div class="panel-heading">
          <h3
            style="font-weight: bold; font-size: 20px; padding: 15px 0 0 25px"
          >
            <i class="fa fa-print"></i> Order History
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6 table-toolbar-left">
              <form class="form-horizontal">
                <div class="row" style="padding: 25px 15px 15px 10px">
                  <label
                    class="col-md-3 control-label text-bold"
                    style="text-align: right"
                  >
                    <h5>Filter By :</h5></label
                  >
                  <div class="col-md-6" style="padding-top: 5px;">
                    <select
                      class="demo_select2 form-control"
                      id="distributor"
                      data-placeholder="Select Option to begin"
                      @change="getOrderHistory(option)"
                      data-target="#demo-panel-ref"
                      v-model="option"
                    >
                      <option value="">Select</option>
                      <option value="Date Requested">Date Requested</option>
                      <option value="Export Date">Export Date</option>
                      <option value="Date Transit">Date Transit</option>
                      <option value="Date Delivered">Date Delivered</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-lg-6 table-toolbar-right"></div>
          </div>
          <hr class="new-section-sm bord-no" style="margin: 0px" />
          <div class="row">
            <div class="col-md-6 table-toolbar-left">
              <form
                action="consolidate"
                @submit.prevent="submitformorder"
                method="post"
                enctype="multipart/form-data"
              >
                <label class="col-lg-3 control-label" style="text-align: right">
                  <h5>Filter Date :</h5>
                </label>
                <div class="col-lg-4">
                  <datetime
                    v-model="date"
                    value-zone="Asia/Manila"
                    zone="Asia/Manila"
                    :disabled="this.option == ''"
                  ></datetime>
                </div>
                <label class="col-lg-2 control-label">
                  <h5 style="text-align: right">To</h5>
                </label>
                <div class="col-lg-3">
                  <datetime
                    v-model="date2"
                    value-zone="Asia/Manila"
                    zone="Asia/Manila"
                    :disabled="this.option == ''"
                  ></datetime>
                </div>
              </form>
            </div>
            <div class="col-md-6 table-toolbar-right">
              <div class="col-md-9">
                <div class="box-inline mar-btm pad-rgt">
                  <span class="text-main text-bold">Payment Type</span>
                  :
                  <div class="select">
                    <select
                      id="demo-ease"
                      :disabled="!this.customer"
                      v-model="payment_type"
                    >
                      <option value="All" selected="selected">All</option>
                      <option value="CASH">CASH</option>
                      <option value="CHEQUE">CHEQUE</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <button
                  class="btn btn-primary btn-rounded"
                  :disabled="!transactions.data.length"
                  @click="printSummary()"
                >
                  <i class="fa fa-print"></i> Print Report ({{
                    transactions.data.length
                  }})
                </button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table
              class="table table-hover table-bordered nowrap table-vcenter"
              id="demo-panel-ref"
            >
              <thead>
                <tr>
                  <th>Location</th>
                  <th>SO No.</th>
                  <th>Customer Name</th>
                  <th>Date Submitted</th>
                  <th>Date Exported</th>
                  <th>Date Transit</th>
                  <th>Date Delivered</th>
                  <th>Salesman</th>
                  <th>Jefe</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!transactions.data.length">
                  <td colspan="12" style="text-align: center">
                    No data available.
                  </td>
                </tr>
                <tr v-for="(trans, index) in transactions.data" :key="index">
                  <td>{{ trans.get_customer_details.address3 }}</td>
                  <td>{{ trans.tran_no }}</td>
                  <td>{{ trans.store_name }}</td>
                  <td>{{ trans.date_req | formatDate }}</td>
                  <td>{{ trans.export_date | formatDate }}</td>
                  <td>{{ trans.date_transit | formatDate }}</td>
                  <td>{{ trans.date_del | formatDate }}</td>
                  <td style="font-size: 12px">
                    {{ salesmanDetails(trans) }}
                  </td>
                  <td style="font-size: 12px">
                    {{ jepeDetails(trans) }}
                  </td>
                  <td style="text-align: right; padding-right: 30px">
                    {{ amount(trans) | toCurrency }}
                  </td>
                </tr>
                <tr>
                  <th colspan="9" style="text-align: right; font-size: 18px">
                    Grand Total
                  </th>
                  <th
                    style="
                    font-size: 18px;
                    text-align: right;
                    padding-right: 30px;
                  "
                  >
                    {{ orderSummary().grandTotal | toCurrency }}
                  </th>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">
                <hr style="margin-top: 25px; margin-bottom: 15px;" />

                <div class="col-md-6">
                  Showing {{ transactions.from }} to {{ transactions.to }} of
                  {{ transactions.total }} entries
                  <span v-if="search"
                    >(Filtered from {{ form.total_result }} total entries)</span
                  >
                </div>
                <div class="col-md-6">
                  <div class="text-right">
                    <pagination
                      style="margin: 0 0 20px 0"
                      :limit="1"
                      :show-disabled="false"
                      :data="transactions"
                      @pagination-change-page="getOrderHistory"
                    ></pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

import { serialize } from 'object-to-formdata'
import _ from 'lodash'
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import { DateTime } from 'luxon'

Vue.component('v-select', vSelect)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'))

Vue.filter('toCurrency', function(value) {
  if (typeof value !== 'number') {
    return value
  }
  var formatter = new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
    minimumFractionDigits: 2
  })
  return formatter.format(value)
})

export default {
  data() {
    return {
      totalDelAmount: 0,
      date: DateTime.local().toString(),
      date2: DateTime.local().toString(),
      payment_type: 'All',
      salesman: '',
      option: '',
      jepe: '',
      customer: '',
      customerList: {},
      salesmanList: {},
      jepeList: {},
      transactions: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      search: '',
      form: new Form({
        total_result: null
      })
    }
  },
  components: {
    datetime: Datetime
  },
  watch: {
    date() {
      if (this.option) this.getOrderHistory(this.option)
    },
    date2() {
      if (this.option) this.getOrderHistory(this.option)
    },
    payment_type() {
      if (this.customer) {
        if (this.payment_type == 'All') {
          if (this.customer == 'All') {
            this.selectAll()
          } else {
          }
        } else {
          if (this.customer == 'All') {
          } else {
            const salesMan = this.customerList.filter(
              sm => sm.account_code == this.customer
            )[0]
            this.ptype(salesMan.account_code)
          }
        }
      }
    }
  },
  methods: {
    date_req(trans) {
      if (!trans.date_req) return ''
      return trans.date_req
    },
    date_transit(trans) {
      if (!trans.date_transit) return ''
      return trans.date_transit
    },
    export_date(trans) {
      if (!trans.export_date) return ''
      return trans.export_date
    },
    date_del(trans) {
      if (!trans.date_del) return ''
      return trans.date_del
    },
    salesmanDetails(trans) {
      if (!trans.get_salesman_details) return ''

      return `${trans.get_salesman_details.first_name} ${trans.get_salesman_details.last_name}`
    },
    jepeDetails(trans) {
      if (!trans.get_jepe_details) return ''

      return `${trans.get_jepe_details.first_name} ${trans.get_jepe_details.last_name}`
    },
    amount(trans) {
      if (trans.tot_del_amt == 0) return trans.tot_amt
      return trans.tot_del_amt
    },
    orderSummary() {
      let grandTotal = 0,
        amount = 0

      this.transactions.data.forEach(order => {
        if (order.tot_del_amt) {
          amount = order.tot_del_amt
        } else {
          amount = order.tot_amt
        }
        grandTotal += amount
      })

      return {
        grandTotal
      }
    },
    printTopReport(val) {
      // console.log(val)
      if (val == 'product')
        document.location.href = `/topReports/printTopProducts/?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}`
      if (val == 'customer')
        document.location.href = `/topReports/printTopCustomer/?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}`
      if (val == 'salesman')
        document.location.href = `/topReports/printTopCustomer/?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}`
    },
    ptype(e) {
      axios
        .get(
          `/salesreport/ptype/?code=${e}&ptype=${this.payment_type}&date=${btoa(
            this.date
          )}&date2=${btoa(this.date2)}`
        )
        .then(response => {
          this.totalDelAmount = 0
          this.transactions = response.data
          this.transactions.data.forEach(trans => {
            this.totalDelAmount += parseFloat(trans.tot_del_amt)
          })
        })
    },
    printSummary() {
      // const ids = this.transactions.data.map(item => item.tran_no)
      document.location.href = `/salesreport/printOrderHistory/?date=${btoa(
        this.date
      )}&date2=${btoa(this.date2)}&option=${this.option}`
    },
    printBtn() {
      const ids = this.transactions.data.map(item => item.tran_no)
      // if (this.customer == "All") {
      // console.log(salesMan);
      document.location.href = `/salesreport/printReport/?data=${ids}&date=${btoa(
        this.date
      )}&date2=${btoa(this.date2)}&salesman=${this.salesman}`
      // } else {
      //   document.location.href = `/salesreport/printReport/?data=${ids}`;
      // }
      // const ids = this.transactions.data.map((item) => item.tran_no);
      // console.log(ids);
      // document.location.href = `/salesreport/printReport/?tran=${ids}`;
    },
    getOrderHistory(e) {
      this.transactions.data = []
      this.totalDelAmount = 0
      axios
        .get(
          `/salesreport/getOrderHistory/?option=${e}&date=${btoa(
            this.date
          )}&date2=${btoa(this.date2)}`
        )
        .then(response => {
          // console.log(response)
          this.transactions = response.data
          this.transactions.data.forEach(trans => {
            this.totalDelAmount += parseFloat(trans.tot_del_amt)
          })
        })
        .catch(response => {
          console.log('error')
        })
    },
    getResults(e) {
      // const selectedJepe = e.target.value

      const jepe = this.jepeList.filter(sm => sm.hepe_code == selectedJepe)[0]
      this.jepe = jepe.hepe_code
      this.payment_type = 'All'

      if (selectedJepe == 'All') {
        this.selectAll()
      } else {
        this.transactions.data = []
        this.selectCustomer(jepe.hepe_code)
      }
    },
    selectAll() {
      axios
        .get(
          `/salesreport/selectAll/?code=${this.salesman}&date=${btoa(
            this.date
          )}&date2=${btoa(this.date2)}`
        )
        .then(response => {
          this.totalDelAmount = 0
          this.transactions = response.data
          this.transactions.data.forEach(trans => {
            this.totalDelAmount += parseFloat(trans.tot_del_amt)
          })
        })
    },
    selectCustomer(e) {
      axios
        .get(
          `/salesreport/getOrderHistory/?option=${this.option}&date=${btoa(
            this.date
          )}&date2=${btoa(this.date2)}`
        )
        .then(response => {
          this.totalDelAmount = 0
          this.transactions = response.data
          this.transactions.data.forEach(trans => {
            this.totalDelAmount += parseFloat(trans.tot_del_amt)
          })
        })
    }
  },
  mounted() {
    this.$root.currentPage = this.$route.meta.name

    setTimeout(() => {
      $('#customer').select2()
      var selectDropDown = $('#distributor')
        .select2()
        .niftyOverlay({
          iconClass: 'demo-psi-repeat-2 spin-anim icon-4x',
          desc: 'Please wait while the content is loading.'
        })
      selectDropDown.on('select2:select', function(e) {
        var event = new Event('change')
        e.target.dispatchEvent(event)

        var $el = $(this),
          relTime
        $el.niftyOverlay('show')

        // Do something...

        relTime = setInterval(function() {
          // Hide the screen overlay
          $el.niftyOverlay('hide')

          clearInterval(relTime)
        }, 500)
      })
    }, 100)
  }
}
</script>
<style lang="scss" scoped>
#container .table th {
  font-size: 1.05em;
  font-weight: 600;
  border-bottom: 3px solid rgba(0, 0, 0, 0.07);
  border-top: 1px solid rgba(0, 0, 0, 0.07);
  border-left: 1px solid rgba(0, 0, 0, 0.07);
  border-right: 1px solid rgba(0, 0, 0, 0.07);
  color: #4d627b;
}

#container .table > tbody > tr > td {
  padding: 8px;
}

// #container .table > tbody > tr > td:hover {
//   background-color: rgb(0 0 0 / 5%);
// }

#container .table-bordered > tbody > tr:nth-child(2n + 1) {
  background-color: rgba(0, 0, 0, 0.05);
}

@media screen and (min-width: 768px) {
  .modal-dialog {
    width: 700px; /* New width for default modal */
  }
  .modal-sm {
    width: 350px; /* New width for small modal */
  }
  .modal-header {
    background-color: #ff5722;
  }
  .modal-title {
    color: #ffffff;
  }
  .close {
    color: #ffffff;
  }
}
@media screen and (min-width: 992px) {
  .modal-lg {
    width: 1250px; /* New width for large modal */
  }
  .modal-header {
    background-color: #ff5722;
  }
  .modal-title {
    color: #ffffff;
  }
  .close {
    color: #ffffff;
  }
}
</style>
