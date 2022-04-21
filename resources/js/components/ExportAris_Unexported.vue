<!-- @format -->

<template>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-9">
        <!-- <form
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
            </form> -->
        <button
          v-if="status != 'Exported'"
          class="btn btn-primary btn-rounded"
          @click="downloadAris()"
          :disabled="aris.data.length < 1"
        >
          Download ARIS
        </button>
      </div>
      <div class="col-md-3">
        <input
          type="search"
          v-model="searchKey"
          class="form-control"
          placeholder="Search"
        />
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 py-0 my-0" style="text-align:right;">
        <button
          class="btn btn-sm btn-secondary"
          @click="getArisResults(1, status)"
        >
          Refresh List
        </button>
      </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table
            id="aris_dl_table"
            class="
              table table-bordered table-hover
              dt-responsive
              nowrap
              table-vcenter
            "
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
              <tr v-if="aris.data.length < 1">
                <td colspan="12">No available data to display...</td>
              </tr>
              <tr v-if="isLoadingTextVisible === 1">
                <td colspan="12" class="text-center text-success">
                  Fetching data from the server, please wait...
                  <spinner></spinner>
                </td>
              </tr>
              <tr
                v-for="(MgaAris, index) in aris.data"
                :key="index"
                :style="MgaAris.returned_total_amount > 0 ? 'color:red; ' : ''"
              >
                <td>{{ MgaAris.sales_invoice }}</td>
                <td>{{ MgaAris.posting_date }}</td>
                <td>{{ MgaAris.customer_code }}</td>
                <td style="text-align: right">
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
          <!-- custom_pagination -->
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                Showing {{ aris.from }} to
                {{ aris.to }} of {{ aris.total }} entries
              </div>
              <div class="col-md-6">
                <div class="text-right">
                  <pagination
                    style="margin: 0 0 20px 0"
                    :limit="1"
                    :show-disabled="true"
                    :data="aris"
                    @pagination-change-page="getArisResults"
                  ></pagination>
                </div>
              </div>
            </div>
          </div>
          <!-- /custom_pagination -->
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
Vue.use(require("vue-moment"));
Vue.component("pagination", require("laravel-vue-pagination"));

export default {
  props: ["status"],

  data() {
    return {
      aris: {
        data: []
      },

      // dateTo: DateTime.local().toString(),
      // dateFrom: DateTime.local().toString(),

      // kaloy 2021-09-29
      isLoadingTextVisible: 0,
      searchKey: "",
    };
  },

  components: {
    datetime: Datetime,
  },

  watch: {
    // dateFrom() {
    //   this.getArisResults(1, this.status);
    // },
    // dateTo() {
    //   this.getArisResults(1, this.status);
    // },
    searchKey: _.debounce(function () {
      this.getArisResults();
    }, 250),
  },

  methods: {
    getArisResults(page = 1) {
      this.isLoadingTextVisible = 1;

      // kaloy 2022-04-07
      const url = `/export/getExportAris?status=${this.status}&searchKey=${this.searchKey}&page=`;
      axios.get(url + page).then((response) => {
        this.aris = response.data;
        this.isLoadingTextVisible = 0;
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
    this.getArisResults();
  },

  mounted() {
    console.log("ExportAris_Unexported mounted");
  },
};
</script>
