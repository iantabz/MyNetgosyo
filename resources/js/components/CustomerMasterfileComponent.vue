<!-- @format -->
<template>
  <div id="page-body" v-cloak>
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title" style="font-weight: bold">
          <i class="fa fa-vcard-o"></i> Customer Masterfile
        </h3>
      </div>
      <div class="panel-body">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-12">
            <!--<router-link to="/add_customer">-->
            <!--  <a href="javascript:;">-->
            <!--    <button class="btn btn-primary btn-rounded btn-sm pull-right">-->
            <!--      <i class="fa fa-plus-circle"></i> Customer-->
            <!--    </button>-->
            <!--  </a>-->
            <!--</router-link>-->
            <router-link to="/import_customer">
              <a href="javascript:;">
                <button
                  class="btn btn-primary btn-rounded btn-sm pull-right"
                  style="margin-right: 8px; margin-left: 8px"
                >
                  <i class="fa fa-cloud-upload"></i> Import File
                </button>
              </a>
            </router-link>
            <!-- <button
              class="btn btn-primary btn-rounded btn-sm pull-right"
              @click="printBtn"
            >
              <i class="fa fa-print"></i> Print Customers
            </button> -->
          </div>
        </div>
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
          class="table table-hover table-bordered table-striped table-vcenter"
          width="100%"
        >
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Code</th>
              <!--<th>Group Name</th>-->
              <th>Description</th>
              <!-- <th><i class="fa fa-credit-card-alt"></i> Credit Limit</th> -->
              <th><i class="fa fa-mobile"></i> Mobile No.</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!customers.data.length">
              <td colspan="7" class="text-center">No data available</td>
            </tr>
            <tr
              v-for="MgaCustomers in customers.data"
              :key="MgaCustomers.customer_id"
            >
              <td class="text-bold" style="font-size: 12px">
                {{ MgaCustomers.account_name }}
              </td>
              <td style="font-size: 12px">{{ MgaCustomers.account_code }}</td>
              <!--<td style="font-size: 12px">-->
              <!--  {{ MgaCustomers.account_group_name }}-->
              <!--</td>-->
              <td style="font-size: 12px">
                {{ MgaCustomers.account_description }}
              </td>
              <td>
                <!-- <input
                  class="form-control text-right"
                  @keydown.enter="amount(MgaCustomers.customer_id)"
                  @blur="amount(MgaCustomers.customer_id)"
                  v-model.lazy="
                    form.account_credit_limit[MgaCustomers.customer_id]
                  "
                  v-money="money"
                  style="height: 27px"
                /> -->
                {{ phone(MgaCustomers) }}
              </td>
              <td>
                <div
                  class="btn-group dropdown"
                  v-if="MgaCustomers.status == '1'"
                >
                  <button
                    class="btn btn-xs btn-info btn-active-blue dropdown-toggle dropdown-toggle-icon"
                    data-toggle="dropdown"
                    type="button"
                  >
                    Active
                    <i class="dropdown-caret"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a
                        href="#"
                        style="color: blue"
                        @click="btn_activation(MgaCustomers.customer_id, '1')"
                        >Active</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        style="color: red"
                        @click="btn_activation(MgaCustomers.customer_id, '0')"
                        >Inactive</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="btn-group dropdown" v-else>
                  <button
                    class="btn btn-xs btn-danger btn-active-blue dropdown-toggle dropdown-toggle-icon"
                    data-toggle="dropdown"
                    type="button"
                  >
                    Inactive
                    <i class="dropdown-caret"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a
                        href="#"
                        style="color: blue"
                        @click="btn_activation(MgaCustomers.customer_id, '1')"
                        >Active</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        style="color: red"
                        @click="btn_activation(MgaCustomers.customer_id, '0')"
                        >Inactive</a
                      >
                    </li>
                  </ul>
                </div>
                <button
                  @click="editCustomer(MgaCustomers)"
                  class="btn btn-info btn-xs"
                >
                  <i class="fa fa-pencil-square-o"></i>
                </button>
                <button
                  class="btn btn-info btn-xs"
                  @click="principalMdl(MgaCustomers.customer_id)"
                >
                  <i class="fa fa-shopping-bag"></i>
                </button>
                <button
                  class="btn btn-warning btn-xs"
                  :disabled="MgaCustomers.cus_password"
                  @click="setPassword(MgaCustomers.customer_id)"
                >
                  <i class="fa fa fa-lock"></i>
                </button>
                &nbsp;
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ customers.from }} to {{ customers.to }} of
              {{ customers.total }} entries
              <span v-if="searchCustomer"
                >(Filtered from {{ form.total_result }} total entries)</span
              >
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <pagination
                  style="margin: 0 0 20px 0"
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
    </div>

    <div
      class="modal fade"
      id="setupMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg"
        style="width: 1200px; padding-top: 35px"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Customer Discount Setup
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closePrincipalMdl()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 table-toolbar-left">
                <button class="btn btn-sm btn-info" @click="pList()">
                  <i class="fa fa-plus"></i> Add Principal
                </button>
              </div>
              <div class="col-md-6 table-toolbar-right">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-6 control-label">Search:</label>
                    <div class="col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Search Principal"
                        v-model="searchPrincipal"
                        @keyup="search2"
                      />
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <table
              id="customerAssignTbl"
              class="table table-striped table-hover table-vcenter nowrap"
              width="100%"
            >
              <thead>
                <tr>
                  <th>Principal/ Company</th>
                  <th>Contract Under (Based on filed doc.)</th>
                  <th>Contract Under (Based on receipt)</th>
                  <th>
                    <i class="fa fa-credit-card-alt"></i> Discount Percentage
                  </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!principalList.data.length">
                  <td colspan="5" class="text-center text-bold">
                    No data available
                  </td>
                </tr>
                <tr
                  v-for="(principal, index) in principalList.data"
                  :key="index"
                >
                  <td class="text-bold">{{ principal.principal_name }}</td>
                  <td v-if="principal.contract_under_via_doc == ' '">
                    <em>null</em>
                  </td>
                  <td v-else>{{ principal.contract_under_via_doc }}</td>
                  <td v-if="principal.contract_under_via_receipt == ' '">
                    <em>null</em>
                  </td>
                  <td v-else>{{ principal.contract_under_via_receipt }}</td>
                  <td>
                    <input
                      class="form-control text-right discount"
                      style="height: 27px"
                      placeholder="%"
                      maxlength="2"
                      @keydown.enter="
                        discountAmt(principal.id, form.customer_id)
                      "
                      @blur="discountAmt(principal.id, form.customer_id)"
                      @keyup.delete="log($event)"
                      v-model="discount[principal.id]"
                    />
                  </td>
                  <td>
                    <button
                      class="btn btn-icon btn-rounded btn-xs btn-danger"
                      @click="removePBtn(principal.id, form.customer_id)"
                    >
                      <i class="fa fa-trash-o"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                  Showing {{ principalList.from }} to {{ principalList.to }} of
                  {{ principalList.total }} entries
                  <span v-if="searchPrincipal"
                    >(Filtered from {{ form.total_principal_result }} total
                    entries)</span
                  >
                </div>
                <div class="col-md-6">
                  <div class="text-right">
                    <pagination
                      style="margin: 0 0 20px 0"
                      :limit="1"
                      :show-disabled="true"
                      :data="principalList"
                      @pagination-change-page="getPrincipal"
                    ></pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
          </div>-->
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="PMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg"
        style="width: 800px; padding-top: 35px"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <i class="fa fa-plus"></i> Add Principal to Customer
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="PMdlClose()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                        placeholder="Search Principal"
                        v-model="searchPList"
                        @keyup="search3"
                      />
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <table
              id="customerAssignTbl"
              class="table table-striped table-hover table-vcenter nowrap"
              width="100%"
            >
              <thead>
                <tr>
                  <th>Principal/ Company</th>
                  <th style="font-size: 12px">
                    Contract Under (Based on filed doc.)
                  </th>
                  <th style="font-size: 12px">
                    Contract Under (Based on receipt)
                  </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!PList.data.length">
                  <td colspan="4" class="text-center text-bold">
                    No data available
                  </td>
                </tr>
                <tr v-for="(principal, index) in PList.data" :key="index">
                  <td class="text-bold" style="font-size: 12px">
                    {{ principal.principal_name }}
                  </td>
                  <td v-if="principal.contract_under_via_doc == ' '">
                    <em>null</em>
                  </td>
                  <td v-else>{{ principal.contract_under_via_doc }}</td>
                  <td v-if="principal.contract_under_via_receipt == ' '">
                    <em>null</em>
                  </td>
                  <td v-else>{{ principal.contract_under_via_receipt }}</td>
                  <td>
                    <button
                      class="btn btn-icon btn-xs btn-info btn-rounded"
                      @click="addPList(principal.id, form.customer_id)"
                    >
                      <i class="fa fa-thumbs-up"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                  Showing {{ PList.from }} to {{ PList.to }} of
                  {{ PList.total }} entries
                  <span v-if="searchPList"
                    >(Filtered from {{ form.total_PList_result }} total
                    entries)</span
                  >
                </div>
                <div class="col-md-6">
                  <div class="text-right">
                    <pagination
                      style="margin: 0 0 20px 0"
                      :limit="1"
                      :show-disabled="true"
                      :data="PList"
                      @pagination-change-page="getPlist"
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
</template>

<script>
/** @format */
import Vue from 'vue'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import { Money } from 'v-money'
Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

export default {
  components: { Money },
  data() {
    return {
      customers: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      editCustomerDetails: null,
      form: new Form({
        customer_id: '',
        status: '',
        total_result: null,
        account_credit_limit: {},
        total_principal_result: null,
        total_PList_result: null
      }),
      isActive: 1,
      searchCustomer: null,
      payment_terms: '',
      money: {
        decimal: '.',
        thousands: ',',
        prefix: '₱ ',
        suffix: '',
        precision: 2,
        masked: true
      },
      principalList: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
        cus_id: ''
      },
      discount: {},
      searchPrincipal: null,
      PList: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
        cus_id: ''
      },
      searchPList: null
    }
  },
  methods: {
      setPassword(id) {
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Set default password',
        text: 'Are you sure with this action?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          axios
            .post(`/customer/setDefaultPassword?id=${id}`)
            .then(({ data, status }) => {
              if (status == 200) {
                $('#container').css('position', 'relative')
                this.getResults()
                $.niftyNoty({
                  type: 'success',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-check-circle'></i> Success, default password has been set.",
                  container: 'floating',
                  timer: 5000
                })
              }
            })
            .catch(error => {
              console.log(error)
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: status,
                container: 'floating',
                timer: 5000
              })
            })
        } else {
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              '<i class="fa fa-exclamation-circle"></i> Action has been canceled.',
            container: 'floating',
            timer: 5000
          })
          $('#container').css('position', 'relative')
        }
      })
    },
    phone(data) {
      if (!data.cus_mobile_number) return ''
      return '+63' + data.cus_mobile_number
    },
    printBtn() {
      document.location.href = `/customer/forPrint`
    },
    removePBtn(principal_id, cus_id) {
      $('#setupMdl').modal('hide')
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Remove Principal',
        text: 'Are you sure with this action?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          axios
            .post('/customer/untagPrincipal', { principal_id, cus_id })
            .then(({ data, status }) => {
              if (data == 'Success') {
                $('#container').css('position', 'relative')
                $.niftyNoty({
                  type: 'success',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-check-circle'></i> Success, Principal has been removed.",
                  container: 'floating',
                  timer: 5000
                })
                $('#setupMdl').modal('show')
                this.getPrincipal()
              } else {
                $('#container').css('position', 'relative')
              }
            })
            .catch(error => {
              console.log(error)
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: status,
                container: 'floating',
                timer: 5000
              })
            })
        } else {
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              '<i class="fa fa-exclamation-circle"></i> Action has been canceled.',
            container: 'floating',
            timer: 5000
          })
          $('#container').css('position', 'relative')
          $('#setupMdl').modal('show')
        }
      })
    },
    addPList(principal, cus_id) {
      axios.post('/customer/tagPList', { principal, cus_id }).then(response => {
        $.niftyNoty({
          type: 'success',
          icon: 'pli-cross icon-2x',
          message:
            "<i class='fa fa-check-circle'></i> Success, Principal has been added.",
          container: 'floating',
          timer: 5000
        })
        this.searchPList = null
        this.getPlist()
        this.getPrincipal()
      })
    },
    search3() {
      this.searchForPList(this.searchPList, this.form.customer_id, this)
    },
    searchForPList: _.debounce((search, cus_id, vm) => {
      axios
        .get(`/customer/getPList/name/?name=${search}&cus_id=${cus_id}&page=1`)
        .then(response => {
          vm.PList = response.data
        })
    }, 100),
    getPlist(page = 1) {
      let url = null
      if (!this.searchPrincipal) {
        url = `/customer/getPList/?cus_id=${this.form.customer_id}&page=`
        axios.get(url + page).then(response => {
          this.form.total_PList_result = response.data.total
        })
      } else {
        // url = `/customer/get_principal/name/?cus_id=${this.form.customer_id}&name=${this.searchPrincipal}&page=`
        // this.principalList.data.forEach(value => {
        //   this.discount[value.id] = value.discount
        // })
      }
      axios.get(url + page).then(response => {
        this.PList = response.data
      })
    },
    PMdlClose() {
      $('#setupMdl').modal('show')
      this.searchPList = null
    },
    pList() {
      $('#setupMdl').modal('hide')
      $('#PMdl').modal('show')
      this.getPlist()

      $('#submitForm').on('click', function(e) {
        e.preventDefault()
      })
    },
    log(e) {
      e.target.value = ''
    },
    closePrincipalMdl() {
      this.searchPrincipal = null
      this.form.customer_id = ''
    },
    search2() {
      this.searchForPrincipal(this.searchPrincipal, this.form.customer_id, this)
    },
    searchForPrincipal: _.debounce((search, cus_id, vm) => {
      axios
        .get(
          `/customer/get_principal/name/?name=${search}&cus_id=${cus_id}&page=1`
        )
        .then(response => {
          vm.principalList = response.data

          setTimeout(() => {
            $('.discount').blur(function() {
              $(this).val(function(index, old) {
                return old.replace(/[^0-9]/g, '') + ' %'
              })
            })
          }, 100)
        })
    }, 100),
    principalMdl(cus_id) {
      $('#setupMdl').modal('show')
      this.form.customer_id = cus_id
      this.getPrincipal()
    },
    getPrincipal(page = 1) {
      let url = null
      if (!this.searchPrincipal) {
        url = `/customer/get_principal/?cus_id=${this.form.customer_id}&page=`
        axios.get(url + page).then(response => {
          this.form.total_principal_result = response.data.total
        })
      } else {
        url = `/customer/get_principal/name/?cus_id=${this.form.customer_id}&name=${this.searchPrincipal}&page=`
        this.principalList.data.forEach(value => {
          this.discount[value.id] = value.discount
        })
      }
      axios.get(url + page).then(response => {
        this.principalList = response.data
        this.principalList.data.forEach(value => {
          // console.log(value)
          // if (value.cus_id == this.form.customer_id) {
          if (value.discount == null) {
            this.discount[value.id] = ''
          } else {
            this.discount[value.id] = value.discount + ' %'
          }
          // } else {
          //   this.discount[value.id] = ''
          // }
        })
        setTimeout(() => {
          // $('.discount').mask('9?%')
          $('.discount').blur(function() {
            $(this).val(function(index, old) {
              return old.replace(/[^0-9]/g, '') + ' %'
            })
          })
        }, 100)
      })
    },
    discountAmt(id, cus_id) {
      const [amt, sign] = this.discount[id].split(' ')
      // console.log(sign)
      this.changeDisAmt(id, amt, cus_id, this)
    },
    changeDisAmt: _.debounce((id, val, cus_id, vm) => {
      axios
        .post('/customer/postDiscount', { id, val, cus_id })
        .then(response => {
          $.niftyNoty({
            type: 'success',
            icon: 'pli-cross icon-2x',
            message:
              "<i class='fa fa-check-circle'></i> Success, discount has been added/changed.",
            container: 'floating',
            timer: 5000
          })
        })
        .catch(error => {
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              '<i class="fa fa-exclamation-circle"></i> Given data is invalid.',
            container: 'floating',
            timer: 5000
          })
          // $('#setupMdl').modal('show')
          $('#container').css('position', 'relative')
        })
    }, 100),
    amount(customerId) {
      const [currency, value] = this.form.account_credit_limit[
        customerId
      ].split(' ')
      this.changeAmount(customerId, value, this)
    },
    changeAmount: _.debounce((id, val, vm) => {
      // if (val == this.form.account_credit_limit) {
      // } else {
      axios.post('/customer/postCredit', { id, val }).then(response => {
        $.niftyNoty({
          type: 'success',
          icon: 'pli-cross icon-2x',
          message:
            "<i class='fa fa-check-circle'></i> Success, account credit limit has been changed.",
          container: 'floating',
          timer: 5000
        })
        // this.getResults()
      })
      // }
    }, 100),
    search() {
      this.searchForItem(this.searchCustomer, this)
    },
    searchForItem: _.debounce((search, vm) => {
      axios
        .get(`/customer/getCustomers2/customer/?name=${search}&page=1`)
        .then(response => {
          vm.customers = response.data
        })
    }, 100),
    getResults(page = 1) {
      let url = null
      if (!this.searchCustomer) {
        url = '/customer/getCustomers2?page='
        
      } else {
        url = `/customer/getCustomers2/customer?name=${this.searchCustomer}&page=`
      }
      axios.get(url + page).then(response => {
        this.customers = response.data
        // const account_credit_limit = this.customers.data.map(
        //   ({ customer_id, account_credit_limit }) => {
        //     customer_id, account_credit_limit
        //   }
        // )
        this.customers.data.forEach(value => {
          this.form.account_credit_limit[value.customer_id] =
            value.account_credit_limit
        })
        setTimeout(() => {
          $('.payment_terms').mask('9 ' + 'DAYS')
        }, 100)
      })
    },
    editCustomer(MgaCustomers) {
      this.$router.push('/edit_customer/' + btoa(MgaCustomers.customer_id))
    },
    btn_activation(id, status) {
      this.form.customer_id = id
      this.form.status = status
      this.form
        .post('/customer/activate_customer')
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == '1') {
              $.niftyNoty({
                type: 'success',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'success',
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
    console.log('Component mounted.')
    $('#container').css('position', 'relative')
    this.$root.currentPage = this.$route.meta.name

    setTimeout(() => {
      this.getResults()
    }, 50)
  }
}
</script>
<style scoped>
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

.modal-header {
  background-color: #ff5722;
}

.modal-title {
  color: #ffffff;
}
.close {
  color: #ffffff;
}
</style>
