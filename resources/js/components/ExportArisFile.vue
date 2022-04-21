<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px;">
            <i class="fa fa-server"></i> Export Aris Files
          </h3>
        </div>

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
                @click="download1()"
                style
              >
                Download ARIS
              </button>
            </div>
          </div>
        </div>
        <hr class="new-section-xs bord" />
        <!------------------------------------------------------------->
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
      dateTo: DateTime.local().toString(),
      dateFrom: DateTime.local().toString(),
      isActive: 1,
      searchAris: null,
      searchBulk: null,
      searchUnserved: null,
      bcomTable: {},
      bulkTable: {},
      unservedTable: {},
      arisTable: null,
      dl_aris: 0,
      dl_bulk: 0,
      dl_flowrack: 0,
      dl_aris1: 0,
      dl_bulk1: 0,
      dl_flowrack1: 0
    }
  },
  components: {
    datetime: Datetime
  },
  watch: {
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
          `/export/getExportAris/aris/?dateFrom=${btoa(
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
        url = `/export/getExportAris/?dateFrom=${btoa(
          this.dateFrom
        )}&dateTo=${btoa(this.dateTo)}&page=`
      } else {
        url = `/export/getExportAris/aris/?dateFrom=${btoa(
          this.dateFrom
        )}&dateTo=${btoa(this.dateTo)}&name=${this.searchAris}&page=`
      }
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

    download1() {
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
            document.location.href = `/export/get_export_files_aris/?dateFrom=${btoa(
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
    closeModal() {
      document.getElementById('close').click()
    }
  },

  mounted() {
    console.log('Component mounted.')
    this.$root.currentPage = this.$route.meta.name
    // setTimeout(, 500)
    this.getArisResults()
    //this.getArisResults()
  }
}
</script>
