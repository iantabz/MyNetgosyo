<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-heading">
        <h3 style="font-weight: bold; font-size: 20px; padding: 15px 0 0 25px">
          <i class="fa fa-print"></i> Sales Report per Jepe de Viaje
        </h3>
      </div>
      <div class="row" style="margin: 0px 0px 10px 0px">
        <div class="col-lg-12"></div>
      </div>
      <div class="row">
        <div class="col-lg-8 table-toolbar-left">
          <form class="form-horizontal">
            <div class="row" style="padding: 25px 15px 15px 10px">
              <label class="col-md-3 control-label text-bold"
                >Select Jepe de Viaje:</label
              >
              <div class="col-md-6">
                <select
                  class="demo_select2 form-control"
                  id="distributor"
                  data-placeholder="Select Jepe de Viaje to begin"
                  @change="getResults($event)"
                  data-target="#demo-panel-ref"
                >
                  <option value="">Select Jepe de Viaje:</option>
                  <!-- <option value="All">All</option> -->
                  <option
                    v-for="option in jepeList"
                    :key="option.hepe_code"
                    :value="option.hepe_code"
                  >
                    {{
                      '[ ' +
                        option.hepe_code +
                        ' ] - ' +
                        option.first_name +
                        ' ' +
                        option.last_name
                    }}
                  </option>
                </select>
              </div>
            </div>
            <!-- <div class="row" style="padding: 0px 15px 15px 10px">
              <label class="col-md-3 control-label text-bold"
                >Select Customer:</label
              >
              <div class="col-md-6">
                <select
                  class="demo_select2 form-control"
                  id="customer"
                  data-placeholder="Select Customer"
                  @change="getResults($event)"
                  data-target="#demo-panel-ref"
                  :disabled="!customerList.length"
                  v-model="customer"
                >
                  <option value="All">All Customers</option>
                  <option
                    v-for="option in customerList"
                    :key="option.account_code"
                    :value="option.account_code"
                  >
                    {{
                      '[ ' + option.account_code + ' ] - ' + option.account_name
                    }}
                  </option>
                </select>
              </div>
            </div> -->
          </form>
        </div>
        <div class="col-lg-4 table-toolbar-right"></div>
      </div>

      <hr class="new-section-sm bord-no" />
      <div class="row">
        <div class="col-md-6 table-toolbar-left">
          <form
            action="consolidate"
            @submit.prevent="submitformorder"
            method="post"
            enctype="multipart/form-data"
          >
            <label class="col-lg-3 control-label">
              <h5>Filter Date :</h5>
            </label>
            <div class="col-lg-4">
              <datetime
                v-model="date"
                value-zone="Asia/Manila"
                zone="Asia/Manila"
                :disabled="this.jepe == ''"
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
                :disabled="this.jepe == ''"
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
            <!-- <div class="dropdown">
              <button
                class="btn btn-primary btn-rounded dropdown-toggle"
                data-toggle="dropdown"
                type="button"
                aria-expanded="false"
                :disabled="!transactions.data.length"
              >
                Print Report ({{ transactions.data.length }})
                <i class="dropdown-caret"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-right" style="">
                <li class="dropdown-header">Select Type of Report</li>
                <li class="active">
                  <a href="javascript:;" @click="printBtn2">Summary</a>
                </li>
                <li>
                  <a href="javascript:;" @click="printBtn">Detailed</a>
                </li>
                <li class="divider"></li>
              </ul>
            </div> -->
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

      <table
        class="table table-hover table-bordered nowrap table-vcenter"
        id="demo-panel-ref"
      >
        <thead>
          <tr>
            <th>Salesman</th>
            <th>User Code</th>
            <th>Total Sales</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!transactions.data.length">
            <td colspan="3" style="text-align: center">
              No data available.
            </td>
          </tr>
          <tr v-for="(trans, index) in transactions.data" :key="index">
            <td>{{ trans.name }}</td>
            <td style="font-size: 12px">{{ trans.sm_code }}</td>
            <td style="text-align: right; padding-right: 30px">
              {{ trans.tot_del_amt | toCurrency }}
            </td>
          </tr>
          <tr>
            <th colspan="2" style="text-align: right; font-size: 18px">
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
                @pagination-change-page="getResults"
              ></pagination>
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
      if (this.jepe) this.selectCustomer(this.jepe)
    },
    date2(val) {
      if (this.jepe) this.selectCustomer(this.jepe)
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
            // console.log(salesMan.account_code);
            this.ptype(salesMan.account_code)
          }
        }
      }
    }
  },
  methods: {
    orderSummary() {
      let grandTotal = 0

      this.transactions.data.forEach(order => {
        grandTotal += order.tot_del_amt
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
      document.location.href = `/salesreport/salesReportJepe/printSummary/?date=${btoa(
        this.date
      )}&date2=${btoa(this.date2)}&jepe=${this.jepe}`
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
    selectSalesman(e) {
      const selectedSalesman = e.target.value
      if (selectedSalesman == 'All') {
        this.salesman = 'All'
      } else {
        const salesMan = this.salesmanList.filter(
          sm => sm.salesman_code == selectedSalesman
        )[0]
        this.salesman = salesMan.salesman_code
      }

      this.customer = 'All'
      this.transactions.data = []
      this.totalDelAmount = 0
      axios
        .get(`/salesreport/getCustomer/?code=${this.salesman}`)
        .then(response => {
          this.customerList = response.data
          setTimeout(() => {
            var selectDropDown = $('#customer').select2()
            selectDropDown.on('select2:select', function(e) {
              var event = new Event('change')
              e.target.dispatchEvent(event)
            })
          }, 100)
        })
        .catch(response => {
          console.log('error')
        })
    },
    getJepe() {
      axios
        .get('/salesreport/getJepe')
        .then(response => {
          this.jepeList = response.data
          setTimeout(() => {
            var selectDropDown = $('#salesman').select2()
            selectDropDown.on('select2:select', function(e) {
              var event = new Event('change')
              e.target.dispatchEvent(event)
            })
          }, 100)
        })
        .catch(response => {
          console.log('error')
        })
    },
    getResults(e) {
      const selectedJepe = e.target.value

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
          `/salesreport/getJepeSales/?code=${e}&date=${btoa(
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
    this.getJepe()
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
