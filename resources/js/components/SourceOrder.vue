<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title" style="font-weight: bold; font-size: 20px;">
          <i class="fa fa-file-text-o"></i> Source Order Count
        </h3>
      </div>
      <div class="row" style="margin: 0px 0px 10px 0px">
        <div class="col-lg-12">
          <div class="col-md-6 table-toolbar-left"></div>
          <div class="col-md-6 table-toolbar-right">
            <button
              class="btn btn-primary btn-rounded shadow"
              @click="printBtn()"
              :disabled="!customer.data.data.length"
            >
              <i class="fa fa-print"> </i> Print Report/s ({{ customer.data.data.length }})
            </button>
            <button
              class="btn btn-success btn-rounded shadow"
              @click="printBtn('excel')"
              :disabled="!customer.data.data.length"
            >
              <i class="fa fa-print"> </i> Export to Excel ({{ customer.data.data.length }})
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel-body">
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
                      ></datetime>
                    </div>
                    <label
                      class="col-lg-2 control-label"
                      style="text-align: right"
                    >
                      <h5>To</h5>
                    </label>
                    <div class="col-lg-3">
                      <datetime2
                        v-model="date2"
                        value-zone="Asia/Manila"
                        zone="Asia/Manila"
                      ></datetime2>
                    </div>
                  </form>
                </div>
                <div class="col-md-6 table-toolbar-right">
                  <input 
                    type="search" 
                    v-model="searchcustomer" 
                    placeholder="Search"
                    class="form-control"
                    style="width: 300px; float: right;"
                  >
                </div>
              </div>
              <table
                id="top_products"
                class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                width="100%"
              >
                <thead>
                  <!-- <tr>
                    <th style="text-align:center;">Customer</th>
                    <th style="text-align:center;">Salesman App<br>(Order Count)</th>
                    <th style="text-align:center;">Salesman App<br>(Amount)</th>
                    <th style="text-align:center;">Customer App<br>(Order Count)</th>
                    <th style="text-align:center;">Customer App<br>(Amount)</th>
                    <th style="text-align:center;">Total Orders</th>
                    <th style="text-align:center;">Total Amount</th>
                  </tr> -->
                  <tr>
                      <th rowspan="2" style="text-align:center;">
                          Customer
                      </th>
                      <th colspan="2" style="text-align:center;">
                          Salesman App
                      </th>
                      <th colspan="2" style="text-align:center;">
                          Customer App
                      </th>
                      <th colspan="2" style="text-align:center;">
                          Backend
                      </th>
                      <th colspan="2" style="text-align:center;">
                          TOTAL
                      </th>
                  </tr>
                  <tr>
                      <th style="text-align:center;">Order Count</th>
                      <th style="text-align:center;">Amount</th>
                      <th style="text-align:center;">Order Count</th>
                      <th style="text-align:center;">Amount</th>
                      <th style="text-align:center;">Order Count</th>
                      <th style="text-align:center;">Amount</th>
                      <th style="text-align:center;">Total Orders</th>
                      <th style="text-align:center;">Total Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!customer.data.data.length">
                    <td colspan="9" style="text-align: center">
                      No data available.
                    </td>
                  </tr>
                  <tr
                    v-for="(Mgacustomer, index) in customer.data.data"
                    :key="index"
                  >
                    <td>{{ Mgacustomer.store_name }}</td>

                    <!-- salesman -->
                    <td>
                      {{ Mgacustomer.salesman_order_count }}
                    </td>
                    <td style="text-align:right">
                      {{ Mgacustomer.salesman_amount | toCurrency }}
                    </td>

                    <!-- customer -->
                    <td>
                      {{ Mgacustomer.customer_order_count }}
                    </td>
                    <td style="text-align:right">
                      {{ Mgacustomer.customer_amount | toCurrency }}
                    </td>

                    <!-- backend -->
                    <td>
                      {{ Mgacustomer.backend_order_count }}
                    </td>
                    <td style="text-align:right">
                      {{ Mgacustomer.backend_amount | toCurrency }}
                    </td>

                    <td>
                      {{ Mgacustomer.salesman_order_count 
                      + Mgacustomer.customer_order_count
                      + Mgacustomer.backend_order_count }}
                    </td>
                    <td style="text-align:right">
                      {{ (Mgacustomer.salesman_amount 
                      + Mgacustomer.customer_amount
                      + Mgacustomer.backend_amount) | toCurrency }}
                    </td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <th>{{ customer.data.salesman_order_count_total }}</th>
                    <th style="text-align: right;">{{ customer.data.salesman_amount_total | toCurrency }}</th>
                    
                    <th>{{ customer.data.customer_order_count_total }}</th>
                    <th style="text-align: right;">{{ customer.data.customer_amount_total | toCurrency }}</th>
                    
                    <th>{{ customer.data.backend_order_count_total }}</th>
                    <th style="text-align: right;">{{ customer.data.backend_amount_total | toCurrency }}</th>
                    
                    <th>{{ (customer.data.salesman_order_count_total 
                      + customer.data.customer_order_count_total
                      + customer.data.backend_order_count_total) }}</th>
                    <th style="text-align: right;">{{ (customer.data.salesman_amount_total 
                      + customer.data.customer_amount_total
                      + customer.data.backend_amount_total) | toCurrency }}</th>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <!-- <div class="col-md-12">
                  <div class="col-md-6">
                    Showing {{ customer.from }} to {{ customer.to }} of
                    {{ customer.total }} entries
                    <span v-if="searchcustomer && !date"
                      >(Filtered from {{ form.total_result }} total
                      entries)</span
                    >
                    <span v-if="searchcustomer && date"
                      >(Filtered from {{ form.total_result }} total
                      entries)</span
                    >
                  </div>
                  <div class="col-md-6">
                    <div class="text-right">
                      <pagination
                        style="margin: 0 0 20px 0"
                        :limit="1"
                        :show-disabled="true"
                        :data="customer"
                        @pagination-change-page="getResults"
                      ></pagination>
                    </div>
                  </div>
                </div> -->
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
import { serialize } from 'object-to-formdata'
import _ from 'lodash'
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import { DateTime } from 'luxon'

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
      customer: {
        data: {
          data: [],
        },
        current_page: null,
        to: null,
        from: null,
        total: null,
        per_page: null
      },
      searchcustomer: '',
      date: DateTime.local().toString(),
      date2: DateTime.local().toString(),
      total_result: null
    }
  },
  components: {
    datetime: Datetime,
    datetime2: Datetime
  },
  computed: {
    // salesmanOrderCountTotal() {
    //   return this.customer.data.reduce((prev, cur)=>{
    //     return prev + cur;
    //   });
    // }
  },

  watch: {
    date() {
      this.getResults(this, this.searchcustomer)
    },
    date2() {
      this.getResults(this, this.searchcustomer)
    },
    searchcustomer(val) {
      this.getResults(this, val)
    },
  },
  methods: {
    printBtn(type='pdf') {
      document.location.href = `/topReports/printsourceOrderCount?dateFrom=${this.date}&dateTo=${this.date2}&storeName=${this.searchcustomer}&type=${type}`
    },

    getResults: _.debounce((vm, searchKey, page = 1) => {
      let url = null

      url = `/topReports/sourceOrderCount?dateFrom=${vm.date}&dateTo=${vm.date2}&storeName=${searchKey}&page=`

      axios.get(url + page).then(response => {
        vm.customer.data = response.data
        // vm.total_result = response.data.total
      })
    }, 500),

  },
  mounted() {}
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
</style>
