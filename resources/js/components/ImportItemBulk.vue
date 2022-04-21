<template>
  <div id="page-body">
    <div class="panel">
      <div class="tab-base">
        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
          <li class="active" @click="tab(1)">
            <a data-toggle="tab" href="#demo-lft-tab-1">
              BULK
              <!-- <span class="badge badge-purple">27</span> -->
            </a>
          </li>
          <li @click="tab(2)">
            <a data-toggle="tab" href="#demo-lft-tab-2">FLOWRACK</a>
          </li>
          <li @click="tab(3)">
            <a data-toggle="tab" href="#demo-lft-tab-3">BCOM</a>
          </li>
        </ul>

        <!--Tabs Content-->
        <div class="tab-content">
          <div id="demo-lft-tab-1" class="tab-pane fade active in">
            <div class="panel-heading">
              <h3 class="panel-title" style="font-weight:bold;">
                <i class="fa fa-address-card-o"></i> Import Items by Bulk
              </h3>
            </div>
            <div class="panel-body">
              <p>
                Import Customer File using
                <b>(.CSV)</b> format
              </p>
              <div class="bord-top pad-ver">
                <form id="myForm" @submit.prevent="submitFiles">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input
                          type="file"
                          id="input-file-import"
                          ref="excel"
                          accept=".csv"
                          class="btn btn-primary fileinput-button dz-clickable"
                          style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;"
                          @change="test()"
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
                            id="dz-remove-btn"
                            class="btn btn-danger cancel"
                            type="reset"
                            @click="clearData()"
                          >
                            <i class="demo-psi-trash"></i>
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
          <!-- 2nd TAB -->
          <div id="demo-lft-tab-2" class="tab-pane fade">
            <div class="panel-heading">
              <h3 class="panel-title" style="font-weight:bold;">
                <i class="fa fa-address-card-o"></i> Import Items Flowrack
              </h3>
            </div>
            <div class="panel-body">
              <p>
                Import Items Flowrack
                <b>(.CSV)</b> format
              </p>
              <div class="bord-top pad-ver">
                <form id="myFormFlowrack" @submit.prevent="submitFilesFlowrack">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input
                          type="file"
                          id="input-file-import"
                          ref="excelFlowrack"
                          accept=".csv"
                          class="btn btn-primary fileinput-button dz-clickable"
                          style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;"
                          @change="test()"
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
                            id="dz-remove-btn"
                            class="btn btn-danger cancel"
                            type="reset"
                            @click="clearData()"
                          >
                            <i class="demo-psi-trash"></i>
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
          </div>
          <div id="demo-lft-tab-3" class="tab-pane fade">
            <div class="panel-heading">
              <h3 class="panel-title" style="font-weight:bold;">
                <i class="fa fa-address-card-o"></i> Import Items BCOM
              </h3>
            </div>
            <div class="panel-body">
              <p>
                Import Items using
                <b>(.CSV)</b> file format
              </p>
              <div class="bord-top pad-ver">
                <form id="myFormBCOM" @submit.prevent="submitFilesBCOM">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <input
                          type="file"
                          id="input-file-import"
                          ref="excelBCOM"
                          accept=".csv"
                          class="btn btn-primary fileinput-button dz-clickable"
                          style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;"
                          @change="test()"
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
                            id="dz-remove-btn"
                            class="btn btn-danger cancel"
                            type="reset"
                            @click="clearData()"
                          >
                            <i class="demo-psi-trash"></i>
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
          </div>
        </div>
      </div>
    </div>
    <div class="panel">
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
                      v-model="searchItems"
                      placeholder="Search"
                      v-if="this.category == null"
                    />
                    <input
                      type="text"
                      class="form-control"
                      @keyup="search"
                      v-model="searchItems"
                      placeholder="Search"
                      v-else-if="this.category == 1"
                    />
                    <input
                      type="text"
                      class="form-control"
                      @keyup="searchFlowrack"
                      v-model="searchItemsFlowrack"
                      placeholder="Search"
                      v-else-if="this.category == 2"
                    />
                    <input
                      type="text"
                      class="form-control"
                      @keyup="searchBCOM"
                      v-model="searchItemsBCOM"
                      placeholder="Search"
                      v-else-if="this.category == 3"
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
                <th>Item Code</th>
                <th>Item Description</th>
                <th>UOM</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!items.data.length">
                <td colspan="3" class="text-center">No data available</td>
              </tr>
              <tr v-for="item in items.data" :key="item.id">
                <td>{{ item.item_code }}</td>
                <td>{{ item.item_description }}</td>
                <td>{{ item.uom }}</td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ items.from }} to {{ items.to }} of
              {{ items.total }} entries
              <span
                v-if="searchItems || searchItemsFlowrack || searchItemsBCOM"
              >
                (Filtered from
                <span v-if="this.category =='1'">{{ form.total_entries }}</span>
                <span v-else-if="this.category =='2'">{{ form.total_flowrack_entries }}</span>
                <span v-else-if="this.category =='3'">{{ form.total_bcom_entries }}</span>
                total entries.)
              </span>
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <pagination
                  v-if="this.category == '1'"
                  style="margin: 0 0 20px 0;"
                  :limit="1"
                  :show-disabled="true"
                  :data="items"
                  @pagination-change-page="getResults"
                ></pagination>
                <pagination
                  v-else-if="this.category == '2'"
                  style="margin: 0 0 20px 0;"
                  :limit="1"
                  :show-disabled="true"
                  :data="items"
                  @pagination-change-page="getResultsFlowrack"
                ></pagination>
                <pagination
                  v-else-if="this.category == '3'"
                  style="margin: 0 0 20px 0;"
                  :limit="1"
                  :show-disabled="true"
                  :data="items"
                  @pagination-change-page="getResultsBCOM"
                ></pagination>
              </div>
            </div>
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
            <h3 style="text-align: center; padding-top: 35px; color:#427cc0">Please wait...</h3>
          </div>
        </div>
      </div>
    </div>

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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
              <strong>{{ error[0] }}</strong>
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
      disabled: 0,
      isSubmitting: false,
      import_file: '',
      error: {},
      excelErrors: [],
      searchItems: null,
      searchItemsFlowrack: null,
      searchItemsBCOM: null,
      category: null,
      active_tab: null,
      items: {
        data: [],
        current_page: null,
        to: 0,
        from: 0,
        total: 0,
        per_page: null
      },
      items_flowrack: {
        data: [],
        current_page: null,
        to: 0,
        from: 0,
        total: 0,
        per_page: null
      },
      items_BCOM: {
        data: [],
        current_page: null,
        to: null,
        from: null,
        total: null,
        per_page: null
      },
      form: new Form({
        total_entries: null,
        total_flowrack_entries: null,
        total_bcom_entries: null
      })
    }
  },
  methods: {
    tab: function (num) {
      this.category = num
      // alert(this.category)
      if (this.category == '1') {
        this.items = []
        this.getResults()
      } else if (this.category == '2') {
        this.items = []
        this.getResultsFlowrack()
      } else if (this.category == '3') {
        this.items = []
        this.getResultsBCOM()
      }
    },
    submitFiles() {
      this.isSubmitting = true
      let formData = new FormData()
      formData.append('import_file', this.$refs.excel.files[0])
      $('#loadMdl').modal('show')
      axios
        .post('/importitemsbulk', formData, {
          headers: { 'content-type': 'multipart/form-data' }
        })
        .then(({ status, data }) => {
          this.isSubmitting = false
          if (status === 200) {
            // codes here after the file is upload successfully
            // alert(data.message)
            $('#loadMdl').modal('hide')
            $('#container').css('position', 'sticky')
            Swal.fire('Success!', data.message, 'success').then(result => {
              if (result.value) {
                setTimeout(() => {
                  $('#container').css('position', 'relative')
                  $('#show').hide()
                  this.getResults()
                  this.clearData()
                  this.disabled = 0
                  this.category = 1
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
              //   $('#show').show()
            }
            $('#exampleModal').modal('show')
          }
          this.uploading = false
          this.error = error.response.data
          console.log('check error: ', this.error)
        })
    },
    submitFilesFlowrack() {
      this.isSubmitting = true
      let formData = new FormData()
      formData.append('import_file', this.$refs.excelFlowrack.files[0])
      $('#loadMdl').modal('show')
      axios
        .post('/importItemsFlowrack', formData, {
          headers: { 'content-type': 'multipart/form-data' }
        })
        .then(({ status, data }) => {
          this.isSubmitting = false
          if (status === 200) {
            // codes here after the file is upload successfully
            // alert(data.message)
            $('#loadMdl').modal('hide')
            $('#container').css('position', 'sticky')
            Swal.fire('Success!', data.message, 'success').then(result => {
              if (result.value) {
                setTimeout(() => {
                  $('#container').css('position', 'relative')
                  $('#show').hide()
                  this.clearData()
                  this.getResultsFlowrack()
                  this.disabled = 0
                  this.category = 2
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
              //   $('#show').show()
            }
            $('#exampleModal').modal('show')
          }
          this.uploading = false
          this.error = error.response.data
          console.log('check error: ', this.error)
        })
    },
    submitFilesBCOM() {
      this.isSubmitting = true
      let formData = new FormData()
      formData.append('import_file', this.$refs.excelBCOM.files[0])
      $('#loadMdl').modal('show')
      axios
        .post('/importItemsBCOM', formData, {
          headers: { 'content-type': 'multipart/form-data' }
        })
        .then(({ status, data }) => {
          this.isSubmitting = false
          if (status === 200) {
            // codes here after the file is upload successfully
            // alert(data.message)
            $('#loadMdl').modal('hide')
            $('#container').css('position', 'sticky')
            Swal.fire('Success!', data.message, 'success').then(result => {
              if (result.value) {
                setTimeout(() => {
                  $('#container').css('position', 'relative')
                  $('#show').hide()
                  this.clearData()
                  this.getResultsBCOM()
                  this.disabled = 0
                  this.category = 3
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
              //   $('#show').show()
            }
            $('#exampleModal').modal('show')
          }
          this.uploading = false
          this.error = error.response.data
          console.log('check error: ', this.error)
        })
    },
    clearData() {
      document.getElementById('myForm').reset()
      document.getElementById('myFormFlowrack').reset()
      document.getElementById('myFormBCOM').reset()
      this.disabled = 0
      // this.category = null
    },
    test() {
      this.disabled = 1
      // this.category = num
    },
    search() {
      this.searchForItem(this.searchItems, this)
    },
    searchForItem: _.debounce((search, vm) => {
      axios.get(`/getItemsBulk/item/?name=${search}&page=1`).then(response => {
        vm.items = response.data
      })
    }, 500),
    getResults(page = 1) {
      let url = null
      if (!this.searchItems) {
        url = '/getItemsBulk/?page='
        axios.get(url + page).then(response => {
          this.form.total_entries = response.data.total
        })
      } else {
        url = `/getItemsBulk/item/?name=${this.searchItems}&page=`
      }
      axios.get(url + page).then(response => {
        this.items = response.data
      })
    },
    searchFlowrack() {
      this.searchForItemFlowrack(this.searchItemsFlowrack, this)
    },
    searchForItemFlowrack: _.debounce((search, vm) => {
      axios
        .get(`/getItemsFlowrack/item/?name=${search}&page=1`)
        .then(response => {
          vm.items = response.data
        })
    }, 500),
    getResultsFlowrack(page = 1) {
      let url = null
      if (!this.searchItemsFlowrack) {
        url = '/getItemsFlowrack/?page='
        axios.get(url + page).then(response => {
          this.form.total_flowrack_entries = response.data.total
        })
      } else {
        url = `/getItemsFlowrack/item/?name=${this.searchItemsFlowrack}&page=`
      }
      axios.get(url + page).then(response => {
        this.items = response.data
      })
    },
    searchBCOM() {
      this.searchForItemBCOM(this.searchItemsBCOM, this)
    },
    searchForItemBCOM: _.debounce((search, vm) => {
      axios.get(`/getItemsBCOM/item/?name=${search}&page=1`).then(response => {
        vm.items = response.data
      })
    }, 500),
    getResultsBCOM(page = 1) {
      let url = null
      if (!this.searchItemsBCOM) {
        url = '/getItemsBCOM/?page='
        axios.get(url + page).then(response => {
          this.form.total_bcom_entries = response.data.total
        })
      } else {
        url = `/getItemsBCOM/item/?name=${this.searchItemsBCOM}&page=`
      }
      axios.get(url + page).then(response => {
        this.items = response.data
      })
    }
  },
  mounted() {
    this.getResults()
    this.$root.currentPage = this.$route.meta.name
    console.log('Component Mounted.')
  }
}
</script>

<style scoped>
/** @format */

#container .table th {
  border-bottom: 3px solid rgba(0, 0, 0, 0.07);
}
</style>