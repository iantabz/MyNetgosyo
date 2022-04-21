<!-- @format -->

<template>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-8"
            v-if="status!='Exported'"
          >
            <form
              action="order"
              @submit.prevent="submitformorder"
              method="post"
              enctype="multipart/form-data"
            >
              <div class="col-lg-4">
                <h5>Posting Date Range:</h5>
              </div>
              <div class="col-lg-4">
                <strong>From:</strong>
                <datetime
                  v-model="dateFrom"
                  value-zone="Asia/Manila"
                  zone="Asia/Manila"
                  input-class="form-control"
                ></datetime>
              </div>
              <div class="col-lg-4">
                <strong>To:</strong>
                <datetime
                  v-model="dateTo"
                  value-zone="Asia/Manila"
                  zone="Asia/Manila"
                  input-class="form-control"
                ></datetime>
              </div>
            </form>
          </div>
          <!-- kaloy 2022-03-30 -->
          <div class="col-md-4" style="text-align:right;">
            <button
              v-if="status!='Exported'"
              class="btn btn-lg btn-primary btn-rounded"
              @click="downloadAris()"
              :disabled="aris.length < 1"
            >
              Download ARIS
            </button>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-6 py-0 my-0">
        <button class="btn btn-sm btn-secondary"
          @click="getArisResults(1,status)"
        >
          Refresh List
        </button>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table
            id="aris_dl_table"
            class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
            width="100%"
          >
            <thead>
              <tr>
                <th>Sales Invoice</th>
                <th>Posting Date</th>
                <th>Account Code</th>
                <th>Payment Amount</th>
                <th>Payment Type</th>
                <th>Cheque #</th>
                <th>Due Date</th>
                <th>Account #</th>
                <th>Account Name</th>
                <th>Cheque Bank</th>
                <th>Salesman Code</th>
                <th>Reference #</th>
              </tr>
            </thead>
            <tbody>
              <!-- kaloy 2021-09-29 -->
              <tr v-if="aris.length < 1">
                <td colspan="12">No available data to display...</td>
              </tr>
              <tr v-if="isLoadingTextVisible === 1">
                <td colspan="12" class="text-center text-success">
                  Fetching data from the server, please wait...
                  <spinner></spinner>
                </td>
              </tr>
              <tr
                v-for="(MgaAris, index) in aris"
                :key="index"
                :style="MgaAris.returned_total_amount > 0 ? 'color:red; ' : ''"
              >
                <td>{{ MgaAris.sales_invoice }}</td>
                <td>{{ MgaAris.posting_date }}</td>
                <td>{{ MgaAris.customer_code }}</td>
                <td style="text-align:right;">
                  {{ MgaAris.sales_invoice_total_amount | toCurrency }}
                </td>
                <td>{{ MgaAris.pmeth_type }}</td>
                <td>{{ MgaAris.cheque_no }}</td>
                <td>{{ MgaAris.cheque_date }}</td>
                <td>{{ MgaAris.account_no }}</td>
                <td>{{ MgaAris.payor_name }}</td>
                <td>{{ MgaAris.bank_name }}</td>
                <td>{{ MgaAris.salesman_code }}</td>
                <td>{{ MgaAris.reference_no }}</td>
              </tr>
              <!-- /kaloy 2022-03-30 -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<style>

</style>
<script>
/** @format */
import Vue from "vue";
import Swal from "sweetalert2";
import { Datetime } from "vue-datetime";
// You need a specific loader for CSS files
import "vue-datetime/dist/vue-datetime.css";
// import moment from 'moment'
import { DateTime } from "luxon";

Vue.use(require("vue-moment"));
Vue.component("pagination", require("laravel-vue-pagination"));
// Vue.component(HasError.name, HasError);
// Vue.component(AlertError.name, AlertError);

export default {
  props: ['status'],

  data() {
    return {
      aris: [],

      dateTo: DateTime.local().toString(),
      dateFrom: DateTime.local().toString(),

      arisTable: {},

      // kaloy 2021-09-29
      isLoadingTextVisible: 0,

      searchAris: null,
    };
  },

  components: {
    datetime: Datetime,
  },

  watch: {
    dateFrom() {
      this.getArisResults(1, this.status);
    },
    dateTo() {
      this.getArisResults(1, this.status);
    },
  },

  methods: {
    search_aris() {
      this.searchForAris(this.searchAris, this);
    },
    searchForAris: _.debounce((search_aris, vm) => {
      axios
        .get(
          `/export/getExportAris/aris?dateFrom=${btoa(
            vm.dateFrom
          )}&dateTo=${btoa(vm.dateTo)}&name=${search_aris}&page=1`
        )
        .then((response) => {
          vm.aris = response.data;
        });
    }, 500),


    getArisResults(page = 1, status = "") {
      
      this.isLoadingTextVisible = 1;

      let url = null;
      this.aris = [];
      if (!this.searchAris) {
        url = `/export/getExportAris?status=${status}&dateFrom=${btoa(
          this.dateFrom
        )}&dateTo=${btoa(this.dateTo)}&page=`;
      } else {
        url = `/export/getExportAris/aris?status=${status}&dateFrom=${btoa(
          this.dateFrom
        )}&dateTo=${btoa(this.dateTo)}&name=${this.searchAris}&page=`;
      }

      axios.get(url+page)
      .then(response => {
        this.aris = response.data;
        this.isLoadingTextVisible = 0;

        // if (Object.keys(this.arisTable).length) {
        //   this.arisTable.clear().destroy()
        // }
        // setTimeout(() => {
        //   this.arisTable = $('#aris_dl_table').DataTable({
        //     destroy:true
        //   })
        // }, 250)

      });
    },


    // download ARIS
    downloadAris() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "Do you want to download this?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, proceed!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            document.location.href = `/export/get_export_files_aris?dateFrom=${btoa(
              this.dateFrom
            )}&dateTo=${btoa(this.dateTo)}`;
            this.getArisResults();
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {

          }
        });
    },

    closeModal() {
      document.getElementById("close").click();
    },
  },

  // kaloy 2021-10-26
  created() {
    this.getArisResults(1, this.status);
  },

  mounted() {
    console.log('ExportAris_Unexported mounted');
  },
};
</script>
