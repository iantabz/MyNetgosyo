<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-heading">
        <div class="row" style="margin: 0px 0px 10px 0px;">
          <div class="col-lg-6" style="padding: 2px;">
            <h3 class="panel-title" style="font-weight:bold;">
              <i class="fa fa-address-card-o"></i> Import Customer File
            </h3>
          </div>
          <div class="col-lg-6" style="padding: 15px;">
            <router-link to="/customer_masterfile">
              <a href="javascript:;">
                <button class="btn btn-primary btn-rounded pull-right">
                  <i class="fa fa-arrow-left"></i> Back
                </button>
              </a>
            </router-link>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <p>
          Import Customer File using
          <b>(.CSV)</b> format
        </p>
        <button
          class="btn btn-danger btn-sm"
          id="show"
          style="margin: 10px; display: none;"
          @click="showErrorMdl()"
        >
          <i class="fa fa-exclamation-triangle"></i> What is this error?
        </button>
        <!-- <button class="btn btn-info btn-sm" style="margin: 10px" @click="test()">
          <i class="fa fa-exclamation-triangle"></i> Show
        </button>-->
        <div class="bord-top pad-ver">
          <!-- <span class="btn btn-success fileinput-button dz-clickable">
            <i class="fa fa-plus"></i>
            <span>Add files...</span>
          </span>-->

          <form id="myForm" @submit.prevent="submitFiles">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-4">
                  <label class="control-label">
                    <h5 class="text-main">
                      Select Salesman Code:
                      <span style="color:red">*</span>
                    </h5>
                  </label>
                  <select
                    class="demo_select2 form-control"
                    v-model="form.selectvalue"
                    data-placeholder="Select Salesman Code"
                    id="salesman_code"
                    @change="selectCode(1)"
                  >
                    <optgroup label="User Code">
                      <option value="0">No Salesman Code</option>
                      <option
                        v-for="option in code_option"
                        :key="option.id"
                        :value="option.user_code"
                        >{{ option.user_code }}</option
                      >
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="row" style="padding-top:10px; padding-bottom: 10px;">
                <div class="col-sm-12">
                  <input
                    type="file"
                    id="input-file-import"
                    ref="excel"
                    accept=".csv"
                    class="btn btn-info fileinput-button dz-clickable"
                    style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer; width: 400px;"
                    :class="{ ' is-invalid': error.message }"
                    :disabled="!disabled"
                    @change="onFileChange()"
                  />

                  <div class="btn-group pull-right">
                    <button
                      :disabled="isSubmitting || !disabled"
                      type="submit"
                      id="submitform"
                      class="btn btn-primary"
                    >
                      <i class="fa fa-cloud-upload"></i> Upload
                    </button>
                    <button
                      :disabled="!disabled"
                      id="dz-remove-btn"
                      class="btn btn-danger cancel"
                      type="reset"
                      @click="clearData()"
                    >
                      <i class="demo-psi-trash"></i> Clear
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div id="dz-previews">
          <div v-if="error.message" class="invalid-feedback"></div>
        </div>
      </div>
      <hr class="new-section-xs bord" />
    </div>
    <!-- <div class="panel">
      <div class="panel-body">
        <div class="table-responsive">
          <hr class="new-section bord-no" />
          <div class="row">
            <div class="col-md-6 table-toolbar-left"></div>
            <div class="col-md-6 table-toolbar-right">
              <form class="form-horizontal">
                <div class="form-group">
                  <label class="col-md-6 control-label">Search:</label>
                  <div class="col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      @keyup="search"
                      v-model="searchCustomer"
                      placeholder="Search"
                    />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <table
            id="customersTbl"
            class="table table-bordered table-hover nowrap table-vcenter"
            width="100%"
          >
            <thead>
              <tr>
                <th>Customer Name</th>
                <th>Customer Code</th>
                <th>Customer Group Code</th>
                <th>Customer Group Name</th>
                <th>Customer Description</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!customers.data.length">
                <td colspan="6" class="text-center">No data available</td>
              </tr>
              <tr v-for="MgaCustomers in customers.data" :key="MgaCustomers.customer_id">
                <td>{{ MgaCustomers.account_name }}</td>
                <td>{{ MgaCustomers.account_code }}</td>
                <td>{{ MgaCustomers.account_group_code }}</td>
                <td>{{ MgaCustomers.account_group_name }}</td>
                <td>{{ MgaCustomers.account_description }}</td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ customers.from }} to {{ customers.to }} of
              {{ customers.total }} entries
              <span
                v-if="searchCustomer"
              >(Filtered from {{ form.total_entries }} total entries.)</span>
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <pagination
                  style="margin: 0 0 20px 0;"
                  :limit="1"
                  :show-disabled="true"
                  :data="customers"
                  @pagination-change-page="getResults"
                ></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <i class="fa fa-exclamation-circle"></i> Error Message
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div
              class="alert alert-danger"
              v-for="(error, errorIndex) in excelErrors"
              :key="errorIndex"
              style="margin-bottom: 10px;"
            >
              <strong v-if="error[0] == 'The import file must be a file.'"
                >No file chosen.</strong
              >
              <strong v-else>{{ error[0] }}</strong>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">
              <i class="fa fa-close"></i> Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade bd-example-modal-lg"
      id="loadMdl"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      style="background-color: transparent;
    border: none;"
    >
      <div class="modal-dialog modal">
        <div class="modal-body">
          <div class="load6">
            <div class="loader" style="font-size: 60px"></div>
            <h3 style="text-align: center; padding-top: 35px; color:#427cc0">
              Please wait...
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div id="errorMdl" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <i class="pci-cross pci-circle"></i>
            </button>
            <h4 class="modal-title" id="myLargeModalLabel">
              <i class="fa fa-exclamation-circle"></i> Error Notice
            </h4>
          </div>
          <div class="modal-body">
            <h5>Sample Error:</h5>
            <div class="alert alert-danger" style="margin-bottom: 10px;">
              <strong>
                There was an error on row 2. The Location Code has already been
                taken.
              </strong>
            </div>
            <div class="alert alert-danger" style="margin-bottom: 10px;">
              <strong>
                There was an error on row 2. The Account Code has already been
                taken.
              </strong>
            </div>
            <div class="alert alert-danger" style="margin-bottom: 10px;">
              <strong>
                There was an error on row 2. The Branch Code has already been
                taken.
              </strong>
            </div>
            <img class="img-responsive" v-bind:src="'/assets/img/' + pic" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
/** @format */
import Swal from 'sweetalert2'
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
Vue.component('pagination', require('laravel-vue-pagination'))
export default {
  data() {
    return {
      customers: {
        data: [],
        current_page: null,
        to: null,
        from: null,
        total: null,
        per_page: null
      },
      form: new Form({
        selectvalue: '',
        total_entries: null
      }),
      code_option: [],
      error: {},
      import_file: '',
      excelErrors: [],
      isSubmitting: false,
      pic: 'Excel.jpg',
      searchCustomer: null,
      salesman_code: '',
      disabled: 0
    }
  },
  methods: {
    search() {
      this.searchForItem(this.searchCustomer, this)
    },
    searchForItem: _.debounce((search, vm) => {
      axios
        .get(`/customer/getCustomers2/customer/?name=${search}&page=1`)
        .then(response => {
          vm.customers = response.data
        })
    }, 500),
    getResults(page = 1) {
      let url = null
      if (!this.searchCustomer) {
        url = '/customer/getCustomers2/?page='
        axios.get(url + page).then(response => {
          this.form.total_entries = response.data.total
        })
      } else {
        url = `/customer/getCustomers2/customer/?name=${this.searchCustomer}&page=`
      }
      axios.get(url + page).then(response => {
        this.customers = response.data
      })
    },
    onFileChange(e) {
      // this.import_file = e.target.files[0]
      this.disabled = 1
    },
    selectCode: function(ya) {
      // if (this.form.selectvalue == 0) {
      //   this.disabled = 0
      // } else {
      //   this.disabled = ya
      // }
      this.disabled = ya
    },
    submitFiles() {
      this.isSubmitting = true
      let formData = new FormData()
      formData.append('import_file', this.$refs.excel.files[0])
      formData.append('salesman_code', this.form.selectvalue)
      $('#loadMdl').modal('show')
      axios
        .post('/customer/import/customer', formData, {
          headers: { 'content-type': 'multipart/form-data' }
        })
        .then(({ status, data }) => {
          this.isSubmitting = false
          if (data == 'Choose Salesman Code!') {
            $('#loadMdl').modal('hide')
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-triangle'></i> Salesman code is required.",
              container: 'floating',
              timer: 5000
            })
          } else if (status === 200) {
            // codes here after the file is upload successfully
            // alert(data.message)
            $('#loadMdl').modal('hide')
            $('#container').css('position', 'sticky')
            Swal.fire({
              title: 'Success!',
              text: data.message,
              icon: 'success',
              allowOutsideClick: false
            }).then(result => {
              if (result.value) {
                setTimeout(() => {
                  // if ($.fn.DataTable.isDataTable('#customersTbl')) {
                  //   $('#customersTbl')
                  //     .DataTable()
                  //     .clear()
                  //     .destroy()
                  // }
                  // $('#container').css('position', 'relative')
                  // $('#show').hide()
                  // this.getResults()
                  this.clearData()
                  this.disabled = 0
                }, 50)
              }
            })
          }
        })
        .catch(({ response }) => {
          $('#loadMdl').modal('hide')
          $('.pace-done').css('padding-right', '0px')
          this.isSubmitting = false
          // code here when an upload is not valid
          const { status, data } = response
          if (status === 422) {
            const { errors } = data
            // alert(errors.import_file[0])
            this.excelErrors = errors
            if (!data.errors.import_file) {
              $('#show').show()
            }
            $('#exampleModal').modal('show')
          }
          // alert('No file chosen')

          this.uploading = false
          this.error = error.response.data
          console.log('check error: ', this.error)
        })
    },
    clearData() {
      document.getElementById('myForm').reset()
      this.form.selectvalue = 0
      this.disabled = 0
      $('#salesman_code')
        .val(null)
        .trigger('change')
    },
    showErrorMdl() {
      $('#errorMdl').modal('show')
    },
    test() {
      $('#show').hide()
    },
    populate() {
      axios
        .get('/customer/getSalesmanCode')
        .then(response => {
          this.code_option = response.data
          setTimeout(() => {
            var selectDropDown = $('#salesman_code').select2()
            selectDropDown.on('select2:select', function(e) {
              var event = new Event('change')
              e.target.dispatchEvent(event)
            })
          }, 100)
        })
        .catch(response => {
          console.log('error')
        })
    }
  },
  mounted() {
    // console.log('Component Mounted.')
    // this.getResults()
    this.populate()
    setTimeout(() => {
      $('#salesman_code').select2()
    }, 100)
    this.$root.currentPage = this.$route.meta.name
  }
}
</script>
<style scoped>
/** @format */

#container .table th {
  border-bottom: 3px solid rgba(0, 0, 0, 0.07);
}
</style>
