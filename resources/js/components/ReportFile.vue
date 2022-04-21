<!-- @format -->
<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold">
            <i class="fa fa-file-text-o"></i> Transaction Reports
          </h3>
        </div>
        <div class="tab-base">
          <!--Nav Tabs-->
          <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#demo-lft-tab-1">Returned Items</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-2">Unserved Items</a>
            </li>
            <!-- <li>
              <a data-toggle="tab" href="#demo-lft-tab-3">Returned Items</a>
            </li>-->
          </ul>
        </div>
        <div class="tab-content">
          <div id="demo-lft-tab-1" class="tab-pane fade active in">
            <div class="row" style="margin: 0px 0px 10px 0px">
              <div class="col-lg-12">
                <div class="col-md-6 table-toolbar-left"></div>
                <div class="col-md-6 table-toolbar-right">
                  <button
                    class="btn btn-primary btn-rounded"
                    @click="print()"
                    :disabled="!returned_items.total"
                  >
                    <i class="fa fa-print"> </i> Print Returned Report/s ({{
                      returned_items.total
                    }})
                  </button>
                </div>
              </div>
              <div class="row">
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
                        <label class="col-lg-2 control-label">
                          <h5 style="text-align: right">To</h5>
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
                      <!-- <form class="form-horizontal">
                          <div class="form-group">
                            <label class="col-md-6 control-label"
                              >Search:</label
                            >
                            <div class="col-md-6">
                              <input
                                type="text"
                                class="form-control"
                                v-model="searchReturned"
                                @keyup="search(date, date2)"
                                placeholder="Search company name"
                              />
                            </div>
                          </div>
                        </form> -->
                    </div>
                  </div>
                  <table
                    id="returned_table"
                    class="table table-hover table-bordered table-striped table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Transaction No</th>
                        <th>Store/Owner Name</th>
                        <th>Account Code</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!returned_items.data.length">
                        <td colspan="5" style="text-align: center">
                          No data available.
                        </td>
                      </tr>
                      <tr
                        v-for="(MgaReturned, index) in returned_items.data"
                        :key="index"
                      >
                        <td>{{ MgaReturned.tran_no }}</td>
                        <td>{{ MgaReturned.store_name }}</td>
                        <td>{{ MgaReturned.account_code }}</td>
                        <td>{{ MgaReturned.date_req | formatDate }}</td>
                        <td>{{ MgaReturned.tran_stat }}</td>
                        <!-- <td>{{ parseFloat(MgaReturned.tot_amt) | toCurrency }}</td>
                            <td>{{ parseFloat(MgaReturned.tot_del_amt) | toCurrency }}</td>-->
                        <!-- <td>
                                <button @click="details(MgaReturned)" class="btn btn-info btn-xs">
                                  <i class="fa fa-list-alt"></i>
                                </button>
                                &nbsp;
                            </td>-->
                      </tr>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        Showing {{ returned_items.from }} to
                        {{ returned_items.to }} of
                        {{ returned_items.total }} entries
                        <span v-if="searchReturned && !date"
                          >(Filtered from {{ form.total_result }} total
                          entries)</span
                        >
                        <span v-if="searchReturned && date"
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
                            :data="returned_items"
                            @pagination-change-page="getResults"
                          ></pagination>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                  <div class="col-md-12" style="text-align: center;">
                    <br />
                    <br />
                    <button class="btn btn-lg btn-primary btn-rounded" @click="print()">Print</button>
                  </div>
                </div> -->
            </div>
          </div>
          <div id="demo-lft-tab-2" class="tab-pane fade">
            <div class="row" style="margin: 0px 0px 10px 0px">
              <div class="col-lg-12">
                <div class="col-md-6 table-toolbar-left"></div>
                <div class="col-md-6 table-toolbar-right">
                  <button
                    class="btn btn-primary btn-rounded"
                    @click="print2()"
                    :disabled="!unservedItems.total"
                  >
                    <i class="fa fa-print"></i> Print Unserved Report/s ({{
                      unservedItems.total
                    }})
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
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
                            v-model="date3"
                            value-zone="Asia/Manila"
                            zone="Asia/Manila"
                          ></datetime>
                        </div>
                        <label class="col-lg-2 control-label">
                          <h5 style="text-align: right">To</h5>
                        </label>
                        <div class="col-lg-3">
                          <datetime
                            v-model="date4"
                            value-zone="Asia/Manila"
                            zone="Asia/Manila"
                          ></datetime>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-6 table-toolbar-right">
                      <!-- <form class="form-horizontal">
                          <div class="form-group">
                            <label class="col-md-6 control-label text-bold"
                              >Search :</label
                            >
                            <div class="col-md-6">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="Search Transaction No, Store or Owner name/s"
                                v-model="searchUnserved"
                                @keyup="search2(date3, date4)"
                              />
                            </div>
                          </div>
                        </form> -->
                    </div>
                  </div>
                  <table
                    class="table table-hover table-bordered table-striped table-vcenter"
                  >
                    <thead>
                      <tr>
                        <th>Transaction No.</th>
                        <th>Store/Owner Name</th>
                        <th>Account Code</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!unservedItems.data.length">
                        <td colspan="5" style="text-align: center">
                          No data available.
                        </td>
                      </tr>
                      <tr
                        v-for="(MgaUnserved, index) in unservedItems.data"
                        :key="index"
                      >
                        <td>{{ MgaUnserved.tran_no }}</td>
                        <td>{{ MgaUnserved.store_name }}</td>
                        <td>{{ MgaUnserved.account_code }}</td>
                        <td>{{ MgaUnserved.date_req | formatDate }}</td>
                        <td>{{ MgaUnserved.tran_stat }}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        Showing {{ unservedItems.from }} to
                        {{ unservedItems.to }} of
                        {{ unservedItems.total }} entries
                        <span v-if="searchUnserved && !date3"
                          >(Filtered from {{ form.total_result2 }} total
                          entries)</span
                        >
                        <span v-if="searchUnserved && date3"
                          >(Filtered from {{ form.total_result2 }} total
                          entries)</span
                        >
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <pagination
                            style="margin: 0 0 20px 0"
                            :limit="1"
                            :show-disabled="true"
                            :data="unservedItems"
                            @pagination-change-page="getResults2"
                          ></pagination>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="demo-lft-tab-3" class="tab-pane fade">
            <div class="panel-body">
              <div class="row" style="margin: 0px 0px 10px 0px">
                <div class="col-lg-12"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">tab 3</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!----------------------------------Form Modal------------------------------------------->

    <div
      class="modal fade"
      id="setupMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              id="close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            action="reupload"
            @submit.prevent="submitformreupload"
            method="post"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tran_no">Transaction No.</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.tran_no"
                      id="tran_no"
                      name="tran_no"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="date_req">Date Requested</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.date_req"
                      id="date_req"
                      name="date_req"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="date_app">Date Approved</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.date_app"
                      id="date_app"
                      name="date_app"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="date_del">Date Delivered</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.date_del"
                      id="date_del"
                      name="date_del"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="p_meth">Payment Method</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.p_meth"
                      id="p_meth"
                      name="p_meth"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="acct_name">Customer Name</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.acct_name"
                      id="acct_name"
                      name="acct_name"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="acct_desc">Store Type</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.acct_desc"
                      id="acct_desc"
                      name="acct_desc"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="address">Address</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.address"
                      id="address"
                      name="address"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label
                      for="salesman"
                      style="color: green; font-weight: bold"
                      >Salesman</label
                    >

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.salesman"
                      id="salesman"
                      name="salesman"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="principal">Principal</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.principal"
                      id="principal"
                      name="principal"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdct_family">Product Family</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.prdct_family"
                      id="prdct_family"
                      name="prdct_family"
                    />
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="uom">UOM</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.uom"
                      id="uom"
                      name="uom"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_wout_tax">Price without Tax</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.price_wout_tax"
                      id="price_wout_tax"
                      name="price_wout_tax"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_wt_tax">Price with Tax</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.price_wt_tax"
                      id="price_wt_tax"
                      name="price_wt_tax"
                      style="text-align: right"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="itemcode">Item Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.itemcode"
                      id="itemcode"
                      name="itemcode"
                    />
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="req_qty">Request Qty</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.req_qty"
                      id="req_qty"
                      name="req_qty"
                    />
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="del_qty" style="color: red"
                      >Qty Delivered</label
                    >

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.del_qty"
                      id="del_qty"
                      name="del_qty"
                      style="color: red"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="amt">Price</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.amt"
                      id="amt"
                      name="amt"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="tot_amt_order"
                      >Total Amt &#40;Ordered&#41;</label
                    >

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.tot_amt_order"
                      id="tot_amt_order"
                      name="tot_amt_order"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="tot_amt_undeliver" style="color: red"
                      >Total Amt &#40;Undelivered&#41;</label
                    >

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.tot_amt_undeliver"
                      id="tot_amt_undeliver"
                      name="tot_amt_undeliver"
                      style="color: red; text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="status">Item Status</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.status"
                      id="status"
                      name="status"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                      placeholder="Description"
                      id="description"
                      name="description"
                      rows="8"
                      class="form-control"
                      v-model="form.description"
                    ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="filename">Image</label>
                    <!-- <input type="file" id="image" name="image" ref="image" /> -->
                    <input
                      type="hidden"
                      id="id"
                      name="id"
                      v-model="form.doc_no"
                    />
                  </div>
                  <section id="image">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-2">
                          <div
                            class="thumbnail"
                            v-if="form.image !== 'storage/'"
                          >
                            <img
                              v-bind:src="form.image"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6 v-if="form.image !== 'storage/'">
                                {{ form.description }}
                              </h6>
                            </div>
                          </div>
                          <div class="thumbnail" v-else>
                            <img
                              v-bind:src="form.noimage"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6></h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <!-- <button type="submit" class="btn btn-primary" id="submitformreupload"></button> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
/** @format */
#container .table th {
  font-size: 1.05em;
  font-weight: 600;
  border-bottom: 3px solid rgba(0, 0, 0, 0.07);
  color: #4d627b;
}

#container .table-hover > tbody > tr:hover {
  background-color: rgb(0 0 0 / 5%);
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

<script>
/** @format */
import Vue from 'vue'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import { serialize } from 'object-to-formdata'
import _ from 'lodash'
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
// import moment from 'moment'
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
      returned_items: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      form: new Form({
        doc_no: '',
        description: '',
        tran_no: '',
        date_req: '',
        date_app: '',
        date_del: '',
        p_meth: '',
        acct_name: '',
        acct_desc: '',
        address: '',
        salesman: '',
        principal: '',
        prdct_family: '',
        uom: '',
        price_wout_tax: '',
        price_wt_tax: '',
        itemcode: '',
        req_qty: '',
        del_qty: '',
        amt: '',
        tot_amt_order: '',
        tot_amt_undeliver: '',
        doc_no: '',
        status: '',
        image: '',
        total_result: null,
        total_result2: null
      }),
      date: DateTime.local().toString(),
      date2: DateTime.local().toString(),
      searchReturned: null,
      date3: DateTime.local().toString(),
      date4: DateTime.local().toString(),
      unservedItems: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      searchUnserved: null
    }
  },
  components: {
    datetime: Datetime,
    datetime2: Datetime
  },
  watch: {
    date(val, date2) {
      // console.log(val, date2);
      this.getResults()
    },
    date2(val) {
      // console.log(this.date, val);
      this.getResults()
    },
    date3(val, date3) {
      this.getResults2()
    },
    date4(val, date4) {
      this.getResults2()
    }
  },
  methods: {
    print2() {
      if (!this.searchUnserved) {
        const ids = this.unservedItems.data.map(item => item.tran_no)
        document.location.href = `/item/getUnservedItems/print?date=${btoa(
          this.date3
        )}&date2=${btoa(this.date4)}&tran=${ids}`
      } else {
        // alert("has search");
        const ids = this.unservedItems.data.map(item => item.tran_no)
        document.location.href = `/item/getUnservedItems/print?date=${btoa(
          this.date3
        )}&date2=${btoa(this.date4)}&tran=${ids}`
      }
    },
    search2(date3, date4) {
      this.searchForUnserved(this.searchUnserved, date3, date4, this)
    },
    searchForUnserved: _.debounce((search, date3, date4, vm) => {
      axios
        .get(
          `/item/getUnservedItems/item?date=${btoa(vm.date3)}&date2=${btoa(
            vm.date4
          )}&name=${search}&page=1`
        )
        .then(response => {
          vm.unservedItems = response.data
        })
    }, 500),
    getResults2(page = 1) {
      let url = null
      if (!this.searchUnserved) {
        url = `/item/getUnservedItems?date=${btoa(this.date3)}&date2=${btoa(
          this.date4
        )}&page=`
      } else {
        url = `/item/getUnservedItems/item?date=${btoa(
          this.date3
        )}&date2=${btoa(this.date4)}&name=${this.searchUnserved}&page=`
      }

      axios.get(url + page).then(response => {
        this.unservedItems = response.data
        this.form.total_result2 = response.data.total
      })
    },
    search(date, date2) {
      this.searchForReturned(this.searchReturned, date, date2, this)
    },
    searchForReturned: _.debounce((search, date, date2, vm) => {
      axios
        .get(
          `/item/getReturnedItems/item_returned?date=${btoa(
            vm.date
          )}&date2=${btoa(vm.date2)}&name=${search}&page=1`
        )
        .then(response => {
          vm.returned_items = response.data
        })
    }, 500),

    getResults(page = 1) {
      let url = null
      if (!this.searchReturned) {
        url = `/item/getReturnedItems?date=${btoa(this.date)}&date2=${btoa(
          this.date2
        )}&page=`
      } else {
        url = `/item/getReturnedItems/item_returned?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}&name=${this.searchReturned}&page=`
      }
      axios.get(url + page).then(response => {
        this.returned_items = response.data
        this.form.total_result = response.data.total
      })
    },

    print() {
      // document.location.href = `/item/getReturnedItems2`;
      if (!this.searchReturned) {
        const ids = this.returned_items.data.map(item => item.tran_no)
        document.location.href = `/item/getReturnedItems2?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}&tran=${ids}`
      } else {
        // alert("has search");
        const ids = this.returned_items.data.map(item => item.tran_no)
        document.location.href = `/item/getReturnedItems2?date=${btoa(
          this.date
        )}&date2=${btoa(this.date2)}&tran=${ids}`
      }
    },

    details(MgaReturned) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Item Details')
      $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.doc_no = MgaReturned.doc_no
      this.form.description = MgaReturned.item_desc
      this.form.tran_no = MgaReturned.tran_no
      this.form.date_req = MgaReturned.date_req
      this.form.date_app = MgaReturned.date_app
      this.form.date_del = MgaReturned.date_del
      this.form.p_meth = MgaReturned.p_meth
      this.form.acct_name = MgaReturned.account_name
      this.form.acct_desc = MgaReturned.account_description

      let addresss =
        MgaReturned.address2 +
        ',' +
        MgaReturned.address3 +
        ',' +
        MgaReturned.address1

      this.form.address = addresss

      let salesmann = MgaReturned.first_name + ' ' + MgaReturned.last_name

      this.form.salesman = salesmann

      this.form.principal = MgaReturned.principal
      this.form.prdct_family = MgaReturned.product_family
      this.form.uom = MgaReturned.uom
      this.form.price_wout_tax = formatter.format(
        MgaReturned.list_price_wouttax
      )
      this.form.price_wt_tax = formatter.format(MgaReturned.list_price_wtax)
      this.form.itemcode = MgaReturned.itm_code
      this.form.req_qty = MgaReturned.req_qty
      this.form.del_qty = MgaReturned.del_qty
      this.form.amt = formatter.format(MgaReturned.amt)
      this.form.tot_amt_order = formatter.format(
        MgaReturned.req_qty * parseFloat(MgaReturned.amt)
      )

      let tot_amt_undeliver =
        MgaReturned.req_qty * parseFloat(MgaReturned.amt) -
        parseFloat(MgaReturned.tot_amt)

      this.form.tot_amt_undeliver = formatter.format(tot_amt_undeliver)

      this.form.image = 'storage/' + MgaReturned.image
      this.form.noimage = 'storage/items/no_image.jpg'

      if (MgaReturned.status === 1) {
        this.form.status = 'Active'
      } else {
        this.form.status = 'Inactive'
      }
    },

    closeModal() {
      document.getElementById('close').click()
    },
    submitformreupload() {
      this.form.image = this.$refs.image.files[0]

      this.form
        .submit('post', '/item/saved_item_image', {
          // Transform form data to FormData
          transformRequest: [
            function(data, headers) {
              return serialize(data)
            }
          ],

          onUploadProgress: e => {
            // Do whatever you want with the progress event
            // console.log(e)
          }
        })
        .then(({ data }) => {
          console.log(data)
          if (data.trim() == 'Success') {
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message: '<i class="fa fa-check"></i> Items has been updated.',
              container: 'floating',
              timer: 5000
            })
          } else {
            if (data.trim() == 'Error') {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: "<i class='fa fa-exclamation-circle'></i> Error.",
                container: 'floating',
                timer: 5000
              })
            }
          }
        })
        .catch(error => {})

      this.getResults()
      $('#setupMdl').modal('hide')
    },

    btn_activation(id, status) {
      axios
        .get(`/item/activate_item?id=${id}&status=${status}`)
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == '1') {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  "<i class='fa fa-check'></i> Status now changed to Inactive.",
                container: 'floating',
                timer: 5000
              })
            }
            this.getResults()
          } else {
            if (data.trim() == 'Error') {
              if (status == '1') {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already active.",
                  container: 'floating',
                  timer: 5000
                })
              } else {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already inactive.",
                  container: 'floating',
                  timer: 5000
                })
              }
            }
          }
        })
        .catch(error => {})
    }
  },

  mounted() {
    // console.log("Component mounted.");
    // this.getResults();
    this.$root.currentPage = this.$route.meta.name
    $('#container').css('position', 'relative')
  }
}
</script>
