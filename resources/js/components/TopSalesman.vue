<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title" style="font-weight: bold; font-size: 20px;">
          <i class="fa fa-file-text-o"></i> Top Salesman
        </h3>
      </div>
      <div class="row" style="margin: 0px 0px 10px 0px">
        <div class="col-lg-12">
          <div class="col-md-6 table-toolbar-left"></div>
          <div class="col-md-6 table-toolbar-right">
            <button
              class="btn btn-primary btn-rounded shadow"
              @click="printBtn()"
              :disabled="!salesman.data.length"
            >
              <i class="fa fa-print"> </i> Print Report/s ({{ total_result }})
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
                <!-- <div class="col-md-6 table-toolbar-right">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-6 control-label">Search:</label>
                      <div class="col-md-6">
                        <input
                          type="text"
                          class="form-control shadow"
                          v-model="searchSalesman"
                          @keyup="search(date, date2)"
                          placeholder="Search company name"
                        />
                      </div>
                    </div>
                  </form>
                </div> -->
              </div>
              <table
                id="top_products"
                class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>Salesman</th>
                    <th>User Code</th>
                    <th>Total Sales</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!salesman.data.length">
                    <td colspan="3" style="text-align: center">
                      No data available.
                    </td>
                  </tr>
                  <tr
                    v-for="(MgaSalesman, index) in salesman.data"
                    :key="index"
                  >
                    <td>{{ MgaSalesman.name }}</td>
                    <td>{{ MgaSalesman.user_code }}</td>
                    <td style="text-align: right">
                      <span class="text-semibold">
                        {{ MgaSalesman.tot_del_amt | toCurrency }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    Showing {{ salesman.from }} to {{ salesman.to }} of
                    {{ salesman.total }} entries
                    <span v-if="searchSalesman && !date"
                      >(Filtered from {{ form.total_result }} total
                      entries)</span
                    >
                    <span v-if="searchSalesman && date"
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
                        :data="salesman"
                        @pagination-change-page="getResults"
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

Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

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
      salesman: {
        data: [],
        current_page: null,
        to: null,
        from: null,
        total: null,
        per_page: null
      },
      searchSalesman: null,
      date: DateTime.local().toString(),
      date2: DateTime.local().toString(),
      total_result: null
    }
  },
  components: {
    datetime: Datetime,
    datetime2: Datetime
  },
  watch: {
    date() {
      this.getResults()
    },
    date2() {
      this.getResults()
    }
  },
  methods: {
    printBtn() {
      document.location.href = `/topReports/printTopSalesman/?date=${btoa(
        this.date
      )}&date2=${btoa(this.date2)}`
    },
    getResults(page = 1) {
      let url = null
      if (!this.searchSalesman) {
        url = `/topReports/topSalesman/?date=${btoa(this.date)}&date2=${btoa(
          this.date2
        )}&page=`
      } else {
        url = `/topReports/topSalesman/search/?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}&name=${this.searchSalesman}&page=`
      }
      axios.get(url + page).then(response => {
        this.salesman = response.data
        this.total_result = response.data.total
      })
    },
    search() {}
  },
  mounted() {
    // this.$root.currentPage = this.$route.meta.name
  }
}
</script>

<style lang="scss" scoped>
#container .table th {
  font-size: 1.05em;
  font-weight: 600;
  border-bottom: 3px solid rgba(0, 0, 0, 0.07);
  color: #4d627b;
}

// #container .table-hover > tbody > tr:hover {
//   background-color: rgb(0 0 0 / 5%);
// }

#container .table-bordered > tbody > tr:nth-child(2n + 1) {
  background-color: rgba(0, 0, 0, 0.05);
}
</style>
