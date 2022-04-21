<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px;">
            <i class="fa fa-server"></i> Export Files
          </h3>
        </div>

        <div class="tab-base">
          <!--Nav Tabs-->
          <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#demo-lft-tab-1">
                Ordered Transaction Files
                <!-- <span class="badge badge-warning">{{ items.total }}</span> -->
              </a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-2">
                Returned Transaction Files
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
              </a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-3">
                Export Aris Files
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div id="demo-lft-tab-1" class="tab-pane fade active in">
              <div class="panel-body">
                <!-- <div class="row" style="margin: 0px 0px 10px 0px;"> -->
                  <!-- <div class="col-lg-12"> -->
                    <!-- <button class="btn btn-success btn-rounded pull-right">
            <i class="fa fa-plus-circle"></i> Salesman
                    </button>-->
                  <!-- </div> -->
                <!-- </div> -->
                <!-- <div class="row">
                  <div class="col-md-6">
                    <form
                      action="order"
                      @submit.prevent="submitformorder"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="col-lg-3">
                        <h5>Select a date :</h5>
                      </div>
                      <div class="col-lg-4">
                        <datetime
                          v-model="date"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                        ></datetime>
                      </div>
                    </form>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6 table-toolbar-left">
                        <!-- kaloy 2021-10-14 -->
                        <div class="row" style="">
                          <!-- <br />
                          <br /> -->
                          <div class="col-md-4">
                            <button
                              v-if="dl_bcom === 0"
                              id="dl_bcom"
                              class="btn btn-primary btn-rounded btn-block"
                              @click="download1()"
                              style
                              disabled="disabled"
                            >
                              Download BCOM
                            </button>
                            <button
                              v-if="dl_bcom === 1"
                              id="dl_bcom1"
                              class="btn btn-primary btn-rounded btn-block"
                              @click="download1()"
                              style
                            >
                              Download BCOM
                            </button>
                          </div>

                          <div class="col-md-4">
                            <button
                              v-if="dl_bulk === 0"
                              id="dl_bulk"
                              class="btn btn-primary btn-rounded btn-block"
                              @click="download2()"
                              style
                              disabled="disabled"
                            >
                              Download BULK
                            </button>
                            <button
                              v-if="dl_bulk === 1"
                              id="dl_bulk1"
                              class="btn btn-primary btn-rounded btn-block"
                              @click="download2()"
                              style
                            >
                              Download BULK
                            </button>
                          </div>

                          <div class="col-md-4">
                            <button
                              v-if="dl_flowrack === 0"
                              id="dl_flowrack"
                              class="btn btn-primary btn-rounded btn-block"
                              @click="download3()"
                              style
                              disabled="disabled"
                            >
                              Download FLOWRACK
                            </button>
                            <button
                              v-if="dl_flowrack === 1"
                              id="dl_flowrack1"
                              class="btn btn-primary btn-rounded btn-block"
                              @click="download3()"
                              style
                            >
                              Download FLOWRACK
                            </button>
                          </div>

                        </div> <!-- /kaloy 2021-10-14 -->
                      </div>

                      <!-- SEARCH -->
                      <div class="col-md-6 table-toolbar-right">
                        <form class="form-horizontal">
                          <div class="form-group">
                            <label class="col-md-6 control-label">Search:</label>
                            <div class="col-md-6">
                              <input
                                type="text"
                                class="form-control"
                                @keyup="search_bcom"
                                v-model="searchBcom"
                                placeholder="Search" />
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">

                      <!-- kaloy 2021-10-26 -->
                      <!-- refresh_export -->
                      <div style="padding-top:2px; padding-bottom:2px;background-color:#eeeeee;"
                        class="text-right">
                        <a href="javascript:void(0)" 
                          @click="getBcomResults()"
                          class="text-info"
                          title="Click to refresh list"
                          style="margin-right:7px;"><span class="fa fa-refresh"> Refresh List</span></a>
                      </div>

                      <table
                        class="table table-hover table-bordered table-striped table-vcenter"
                        width="100%"
                      >
                        <thead>
                          <tr>
                            <th>Sales Form #</th>
                            <th>Account Code</th>
                            <th>Account Name</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>UOM</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!bcom.data.length">
                            <td colspan="9" class="text-center">
                              No data available
                            </td>
                          </tr>
                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="9" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>
                          <tr
                            v-for="MgaBcom in bcom.data"
                            :key="MgaBcom.sef_id"
                          >
                            <td>{{ MgaBcom.sef_no }}</td>
                            <td>{{ MgaBcom.acct_code }}</td>
                            <td>{{ MgaBcom.acct_name }}</td>
                            <td>{{ MgaBcom.product_code }}</td>
                            <td>{{ MgaBcom.product_name }}</td>
                            <td>{{ MgaBcom.product_uom }}</td>
                            <!-- kaloy 2021-10-11 -->
                            <td>{{ MgaBcom.qty_ordered }}</td>
                            <td>{{ MgaBcom.file_type }}</td>
                            <td>
                              &nbsp;
                              <button
                                @click="details(MgaBcom)"
                                class="btn btn-info btn-xs"
                              >
                                <i class="fa fa-list-alt"></i>
                              </button>
                              <!-- &nbsp;
                            <button @click="orderDetails(MgaBcom.tran_no)" class="btn btn-info btn-xs">
                            <i class="fa fa-cart-arrow-down"></i>
                              </button>-->
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            Showing {{ bcom.from }} to {{ bcom.to }} of
                            {{ bcom.total }} entries
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <pagination
                                style="margin: 0 0 20px 0;"
                                :limit="1"
                                :show-disabled="true"
                                :data="bcom"
                                @pagination-change-page="getBcomResults"
                              ></pagination>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- dl_btns -->
                </div>
              </div>
              <hr class="new-section-xs bord" />
              <!------------------------------------------------------------->
            </div>
            <div id="demo-lft-tab-2" class="tab-pane fade">
              <div class="panel-body">
                <div class="row" style="margin: 0px 0px 10px 0px">
                  <div class="col-lg-12"></div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table
                          id="unserved_dl_table"
                          class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                          width="100%"
                        >
                          <thead>
                            <tr>
                              <th>Sales Form #</th>
                              <th>Account Name</th>
                              <th>Product Code</th>
                              <th>Product Name</th>
                              <th>UOM</th>
                              <th>Type</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- kaloy 2021-09-29 -->
                            <tr v-if="isLoadingTextVisible === 1">
                              <td colspan="8" class="text-center text-success">
                                Fetching data from the server, please wait...
                                <spinner></spinner>
                              </td>
                            </tr>
                            <tr
                              v-for="(MgaUnserved, index) in unserved"
                              :key="index"
                            >
                              <td>{{ MgaUnserved.sef_no }}</td>
                              <td>{{ MgaUnserved.acct_name }}</td>
                              <td>{{ MgaUnserved.product_code }}</td>
                              <td>{{ MgaUnserved.product_name }}</td>
                              <td>{{ MgaUnserved.product_uom }}</td>
                              <td>{{ MgaUnserved.file_type }}</td>
                              <td>{{ MgaUnserved.tag }}</td>
                              <td class="text-center">
                                <div class="btn-group">
                                  <a
                                    class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                                    href="#"
                                    data-original-title="View User Details"
                                    data-container="body"
                                    title="View Details"
                                  ></a>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                      <br />
                      <br />
                      <button
                        v-if="dl_bcom1 === 0"
                        id="dl_bcom2"
                        class="btn btn-lg btn-primary btn-rounded"
                        @click="download11()"
                        style
                        disabled="disabled"
                      >
                        Download BCOM
                      </button>
                      <button
                        v-if="dl_bcom1 === 1"
                        id="dl_bcom3"
                        class="btn btn-lg btn-primary btn-rounded"
                        @click="download11()"
                        style
                      >
                        Download BCOM
                      </button>
                      &nbsp;&nbsp;&nbsp;
                      <button
                        v-if="dl_bulk1 === 0"
                        id="dl_bulk2"
                        class="btn btn-lg btn-primary btn-rounded"
                        @click="download21()"
                        style
                        disabled="disabled"
                      >
                        Download BULK
                      </button>
                      <button
                        v-if="dl_bulk1 === 1"
                        id="dl_bulk3"
                        class="btn btn-lg btn-primary btn-rounded"
                        @click="download21()"
                        style
                      >
                        Download BULK
                      </button>
                      &nbsp;&nbsp;&nbsp;
                      <button
                        v-if="dl_flowrack1 === 0"
                        id="dl_flowrack2"
                        class="btn btn-lg btn-primary btn-rounded"
                        @click="download31()"
                        style
                        disabled="disabled"
                      >
                        Download FLOWRACK
                      </button>
                      <button
                        v-if="dl_flowrack1 === 1"
                        id="dl_flowrack3"
                        class="btn btn-lg btn-primary btn-rounded"
                        @click="download31()"
                        style
                      >
                        Download FLOWRACK
                      </button>
                    </div>
                  </div>
                </div>
                <hr class="new-section-xs bord" />
              </div>
            </div>
            <div id="demo-lft-tab-3" class="tab-pane fade">
              <div class="panel-body">
                <div class="row" style="margin: 0px 0px 10px 0px;">
                  <div class="col-lg-12">
                    <!-- <button class="btn btn-success btn-rounded pull-right">
            <i class="fa fa-plus-circle"></i> Salesman
                    </button>-->
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <form
                      action="order"
                      @submit.prevent="submitformorder"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="col-lg-2">
                        <h5>Select date range</h5>
                      </div>
                      <div class="col-lg-3">
                        <span><h5>From :</h5></span>
                        <datetime
                          v-model="dateFrom"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                        ></datetime>
                      </div>
                      <div class="col-lg-3">
                        <span><h5>To :</h5></span>
                        <datetime
                          v-model="dateTo"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                        ></datetime>
                      </div>
                    </form>
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table
                        id="aris_dl_table"
                        class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                        width="100%"
                      >
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Account Code</th>
                            <th>Sales Invoice</th>
                            <th>Payment Amt</th>
                            <th>Payment Type</th>
                            <th>Cheque #</th>
                            <th>Due Date</th>
                            <th>Account #</th>
                            <th>Account Name</th>
                            <th>Cheque Bank</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="8" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>
                          <tr v-for="(MgaAris, index) in aris" :key="index">
                            <td>{{ MgaAris.date_app }}</td>
                            <td>{{ MgaAris.account_code }}</td>
                            <td>{{ MgaAris.nav_invoice_no }}</td>
                            <td>{{ MgaAris.tot_del_amt }}</td>
                            <td>{{ MgaAris.pmeth_type }}</td>
                            <td>{{ MgaAris.cheque_no }}</td>
                            <td>{{ MgaAris.cheque_date }}</td>
                            <td>{{ MgaAris.account_no }}</td>
                            <td>{{ MgaAris.payor_name }}</td>
                            <td>{{ MgaAris.bank_name }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12" style="text-align: center;">
                    <br />
                    <br />
                    <!-- <button
                v-if="dl_aris === 0"
                id="dl_aris"
                class="btn btn-lg btn-primary btn-rounded"
                @click="download1()"
                style
                disabled="disabled"
              >
                Download ARIS
              </button> -->
                    <!-- <button
                v-if="dl_aris === 1"
                id="dl_aris1"
                class="btn btn-lg btn-primary btn-rounded"
                @click="download1()"
                style
              >
                Download ARIS
              </button> -->
                    <button
                      id="dl_aris1"
                      class="btn btn-lg btn-primary btn-rounded"
                      @click="download69()"
                      style
                    >
                      Download ARIS
                    </button>
                  </div>
                </div>
              </div>
              <hr class="new-section-xs bord" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
/** @format */

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
@media screen and (max-width: 768px) {
  ul.nav-tabs > li {
    float: none;
  }

  /* #div-total-amt h4 {
  } */
  div.tab-content div.panel-body {
    padding: 2px;
  }
  div.tab-content div.panel-body form.row {
    padding-top: 8px;
  }

  div.col-md-4 {
    padding-bottom: 5px;
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

/* kaloy 2021-10-14 */
.nav-tabs li.active {
  border-bottom: 3px solid #ff5722;
}
</style>
<script>
/** @format */
import Vue from 'vue'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import { serialize } from 'object-to-formdata'
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
// import moment from 'moment'
import { DateTime } from 'luxon'

Vue.use(require('vue-moment'))
Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

export default {
  data() {
    return {
      aris: [],
      bcom: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      unserved: [],
      bulk: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      flowrack: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      form: new Form({
        item_masterfiles_id: '',
        prdct_name: '',
        prdct_shrt_name: '',
        description: '',
        company_code: '',
        itemcode: '',
        barcode: '',
        brand: '',
        principal: '',
        prdct_family: '',
        keywords: '',
        uom: '',
        price_wout_tax: '',
        price_wt_tax: '',
        conversion_qty: '',
        conversion_uom: '',
        item_masterfiles_id: '',
        status: '',
        image: ''
      }),
      form1: new Form({
        item_masterfiles_id: '',
        prdct_name: '',
        prdct_shrt_name: '',
        description: '',
        company_code: '',
        itemcode: '',
        barcode: '',
        brand: '',
        principal: '',
        prdct_family: '',
        keywords: '',
        uom: '',
        price_wout_tax: '',
        price_wt_tax: '',
        conversion_qty: '',
        conversion_uom: '',
        item_masterfiles_id: '',
        status: '',
        image: ''
      }),
      date1: null,
      date: DateTime.local().toString(),
      dateTo: DateTime.local().toString(),
      dateFrom: DateTime.local().toString(),
      isActive: 1,
      searchAris: null,
      searchBcom: null,
      searchBulk: null,
      searchUnserved: null,
      bcomTable: {},
      bulkTable: {},
      unservedTable: {},
      arisTable: null,
      dl_aris: 0,
      dl_aris1: 0,
      dl_bcom: 0,
      dl_bulk: 0,
      dl_flowrack: 0,
      dl_bcom1: 0,
      dl_bulk1: 0,
      dl_flowrack1: 0,
      // kaloy 2021-09-29
      isLoadingTextVisible: 1
    }
  },
  components: {
    datetime: Datetime
  },
  watch: {
    date() {
      // this.getBcomResults()
    },
    dateFrom() {
      this.getArisResults()
    },
    dateTo() {
      this.getArisResults()
    }
  },
  methods: {
    search_aris() {
      this.searchForAris(this.searchAris, this)
    },
    searchForAris: _.debounce((search_aris, vm) => {
      axios
        .get(
          `/export/getExportAris/aris?dateFrom=${btoa(
            vm.dateFrom
          )}&dateTo=${btoa(vm.dateTo)}&name=${search_aris}&page=1`
        )
        .then(response => {
          vm.aris = response.data
        })
    }, 500),

    async getArisResults(page = 1) {
      // console.log(this.dateFrom)
      // console.log(this.dateTo)

      // this.aris = {
      //   data: [],
      //   current_page: null,
      //   from: null,
      //   to: null,
      //   total: null,
      //   per_page: null
      // }

      // this.dl_aris = 0
      // this.dl_bulk = 0
      // this.dl_flowrack = 0

      let url = null
      this.aris = []
      if (!this.searchAris) {
        url = `/export/getExportAris?dateFrom=${btoa(
          this.dateFrom
        )}&dateTo=${btoa(this.dateTo)}&page=`
      } else {
        url = `/export/getExportAris/aris?dateFrom=${btoa(
          this.dateFrom
        )}&dateTo=${btoa(this.dateTo)}&name=${this.searchAris}&page=`
      }

      /* kaloy 2021-09-29 */
      // const { data } = await axios.get(url + page).then(this.isLoadingTextVisible = 1)
      // this.isLoadingTextVisible = 1;
      const { data } = await axios.get(url + page)

      this.aris = data

      if (this.arisTable !== null) {
        this.arisTable.clear().destroy()
      }

      setTimeout(() => {
        this.arisTable = $('#aris_dl_table').DataTable({
          destroy: true
        })
      }, 250)

      // this.aris.data.forEach(datas => {
      //   console.log(datas.downloaded)
      //   this.downloaded = datas.downloaded
      //   this.dl_aris = 0;

      //   console.log(datas.file_type == "BCOM" && datas.downloaded == "no");
      //   if (datas.file_type == 'BCOM' && datas.downloaded == 'no') {
      //     this.dl_aris = 1
      //   }
      // })
    },

    download69() {
      // console.log(this.dateFrom)
      // console.log(this.dateTo)
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_aris?dateFrom=${btoa(
              this.dateFrom
            )}&dateTo=${btoa(this.dateTo)}`
            this.getArisResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },

    clearTable() {
      this.aris = {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      }
    },
    search_bcom() {
      this.searchForBcom(this.searchBcom, this)
    },
    search_bulk() {
      this.searchForBulk(this.searchBulk, this)
    },
    searchForBcom: _.debounce((search_bcom, vm) => {
      axios
        .get(
          `/export/getExportBcom/bcom?date=${btoa(
            vm.date
          )}&name=${search_bcom}&page=1`
        )
        .then(response => {
          vm.bcom = response.data
        })
    }, 500),
    searchForBulk: _.debounce((search_bulk, vm) => {
      axios
        .get(`/export/getExportBulk/bulk?name=${search_bulk}&page=1`)
        .then(response => {
          vm.bulk = response.data
        })
    }, 500),

    getUnservedResults(page = 1) {
      

      let url = null
      if (!this.searchUnserved) {
        url = '/export/getExportUnserved?page='
      } else {
        url = `/export/getExportUnserved/unserved?name=${this.searchUnserved}&page=`
      }
      // // kaloy 2021-09-29
      //   this.isLoadingTextVisible = 1
      axios.get(url + page).then(response => {
        
        this.unserved = response.data

        this.unserved.forEach(datas => {
          // console.log(datas.downloaded)
          // this.downloaded = datas.downloaded
          if (datas.file_type == 'BCOM' && datas.downloaded == 'no') {
            this.dl_bcom1 = 1
          }
          if (datas.file_type == 'BULK' && datas.downloaded == 'no') {
            this.dl_bulk1 = 1
          }
          if (datas.file_type == 'FLOWRACK' && datas.downloaded == 'no') {
            this.dl_flowrack1 = 1
          }
        })
        // kaloy 2021-09-29
        // this.isLoadingTextVisible = 0
        setTimeout(() => {
          this.unservedTable = $('#unserved_dl_table').DataTable()
        }, 500)
      })
    },

    download1() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_bcom`
            this.getBcomResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },
    download2() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_bulk`
            this.getBcomResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },
    download3() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_flowrack`
            this.getBcomResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },

    download11() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_bcom_unserved?date=${btoa(
              this.date
            )}`
            this.getBcomResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },
    download21() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_bulk_unserved?date=${btoa(
              this.date
            )}`
            this.getBcomResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },
    download31() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons
        .fire({
          title: 'Are you sure?',
          text: 'Do you want to download this?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        })
        .then(result => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_flowrack_unserved?date=${btoa(
              this.date
            )}`
            this.getBcomResults()
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: 'Download Success!',
                  text: 'File has been downloaded successfully!.',
                  icon: 'success',
                  confirmButtonText: 'Ok'
                })
                .then(result => {
                  window.location.reload()
                })
            }, 2500)
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Download has been cancelled! :)',
              'error'
            )
          }
        })
    },
    getBcomResults(page = 1) {

      this.dl_bcom = 0
      this.dl_bulk = 0
      this.dl_flowrack = 0

      let url = null
      if (!this.searchBcom) {
        url = `/export/getExportBcom?page=`
      } else {
        url = `/export/getExportBcom/bcom?name=${this.searchBcom}&page=`
      }
      // kaloy 2021-09-29
      this.isLoadingTextVisible = 1
      axios.get(url + page).then(response => {
        
        this.bcom = response.data

        // console.log(this.bcom.data.forEach)

        this.bcom.data.forEach(datas => {
          // console.log(datas.downloaded)
          // this.downloaded = datas.downloaded
          // this.dl_bcom = 0;
          // this.dl_bulk = 0;
          // this.dl_flowrack = 0;

          // console.log(datas.file_type == "BCOM" && datas.downloaded == "no");

          if (datas.file_type == 'BCOM' && datas.downloaded == 'no') {
            this.dl_bcom = 1
          }
          if (datas.file_type == 'BULK' && datas.downloaded == 'no') {
            this.dl_bulk = 1
          }
          if (datas.file_type == 'FLOWRACK' && datas.downloaded == 'no') {
            this.dl_flowrack = 1
          }
        })

        // $.each(this.bcom, function(key, value) {
        //   alert(value);
        // });
        // kaloy 2021-09-29
        this.isLoadingTextVisible = 0
      })
    },
    getBulkResults(page = 1) {
      let url = null
      if (!this.searchBulk) {
        url = '/export/getExportBulk?page='
      } else {
        url = `/export/getExportBulk/bulk?name=${this.searchBulk}&page=`
      }
      axios.get(url + page).then(response => {
        this.bulk = response.data
      })
    },
    clearTable() {
      this.bcom = {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      }
    },
    details(MgaItems) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Item Details')
      $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.item_masterfiles_id = MgaItems.item_masterfiles_id
      this.form.prdct_name = MgaItems.product_name
      this.form.prdct_shrt_name = MgaItems.product_shrt_name
      this.form.description = MgaItems.description
      this.form.company_code = MgaItems.company_code
      this.form.itemcode = MgaItems.itemcode
      this.form.barcode = MgaItems.barcode
      this.form.brand = MgaItems.brand
      this.form.principal = MgaItems.principal
      this.form.prdct_family = MgaItems.product_family
      this.form.keywords = MgaItems.keywords
      this.form.uom = MgaItems.uom
      this.form.price_wout_tax = formatter.format(MgaItems.list_price_wouttax)
      this.form.price_wt_tax = formatter.format(MgaItems.list_price_wtax)
      this.form.conversion_qty = MgaItems.conversion_qty
      this.form.conversion_uom = MgaItems.conversion_uom
      this.form.image = 'storage/' + MgaItems.image
      this.form.noimage = 'storage/items/no_image.jpg'

      if (MgaItems.status === 1) {
        this.form.status = 'Active'
      } else {
        this.form.status = 'Inactive'
      }
    },
    details1(MgaItems1) {
      $('#setupMdl1').modal('show')
      $('#MdlTitle1').html('Item Details')
      $('#submitformreupload1').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form1.item_masterfiles_id = MgaItems1.item_masterfiles_id
      this.form1.prdct_name = MgaItems1.product_name
      this.form1.prdct_shrt_name = MgaItems1.product_shrt_name
      this.form1.description = MgaItems1.description
      this.form1.company_code = MgaItems1.company_code
      this.form1.itemcode = MgaItems1.itemcode
      this.form1.barcode = MgaItems1.barcode
      this.form1.brand = MgaItems1.brand
      this.form1.principal = MgaItems1.principal
      this.form1.prdct_family = MgaItems1.product_family
      this.form1.keywords = MgaItems1.keywords
      this.form1.uom = MgaItems1.uom
      this.form1.price_wout_tax = formatter.format(MgaItems1.list_price_wouttax)
      this.form1.price_wt_tax = formatter.format(MgaItems1.list_price_wtax)
      this.form1.conversion_qty = MgaItems1.conversion_qty
      this.form1.conversion_uom = MgaItems1.conversion_uom
      this.form1.image = 'storage/' + MgaItems1.image
      this.form1.noimage = 'storage/items/no_image.jpg'

      if (MgaItems1.status === 1) {
        this.form1.status = 'Active'
      } else {
        this.form1.status = 'Inactive'
      }
    },
    closeModal() {
      document.getElementById('close').click()
    }
  },

  // kaloy 2021-10-26
  created() {
    this.getBcomResults()
    setTimeout(this.getUnservedResults(), 500)
    // this.getBulkResults();
  },

  mounted() {
    console.log('Component mounted.')
    this.$root.currentPage = this.$route.meta.name
    
  }
}
</script>
