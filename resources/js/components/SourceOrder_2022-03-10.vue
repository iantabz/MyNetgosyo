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
              :disabled="!customer.data.length"
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
              </div>
              <table
                id="top_products"
                class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>Source</th>
                    <th style="text-align: center">Total Order Count</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!customer.data.length">
                    <td colspan="2" style="text-align: center">
                      No data available.
                    </td>
                  </tr>
                  <tr
                    v-for="(Mgacustomer, index) in customer.data"
                    :key="index"
                  >
                    <td>{{ Mgacustomer.order_by }}</td>
                    <td style="text-align: center">
                      {{ Mgacustomer.total_order }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
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

export default {
  data() {
    return {
      customer: {
        data: [],
        current_page: null,
        to: null,
        from: null,
        total: null,
        per_page: null
      },
      searchcustomer: null,
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
      document.location.href = `/topReports/printsourceOrderCount?date=${btoa(
        this.date
      )}&date2=${btoa(this.date2)}`
    },
    getResults(page = 1) {
      let url = null

      url = `/topReports/sourceOrderCount?date=${btoa(this.date)}&date2=${btoa(
        this.date2
      )}&page=`

      axios.get(url + page).then(response => {
        this.customer = response.data
        this.total_result = response.data.total
      })
    },
    search() {}
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
