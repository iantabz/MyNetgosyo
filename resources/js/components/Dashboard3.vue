<!-- @format -->

<template>
  <div id="page-content">
    <!--Activated Users Chart-->
    <!--===================================================-->

    <div class="panel">
      <div class="panel-body">
        <!-- <div class="row mar-top">
          <div class="col-md-2">
            <h3 class="text-main text-normal text-2x mar-no">Total Users</h3>
            <hr class="new-section-xs" />
            <div class="row mar-top">
              <div class="col-sm-12">
                <div class="text-lg">
                  <p class="text-5x text-thin text-main mar-no">{{ user.length }}</p>
                </div>
                <p class="text-sm">Total users that are already registered</p>
              </div>
            </div>
          </div>
          <div class="col-md-10">
            <div class="panel">
              <div class="panel-heading">
                <button
                  @click="add_new_user()"
                  class="btn btn-primary btn-rounded pull-right btn-sm"
                  style="margin-left: 8px; margin-right: 8px;"
                >
                  <i class="fa fa-plus"></i> Add New User
                </button>
                <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
                  <i class="fa fa-user-circle"></i> Admin Users
                </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="admin_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userA.length">
                        <td colspan="6" class="text-center">No data available</td>
                      </tr>
                      <tr v-for="(MgaAdmin, index) in userA" :key="index">
                        <td>
                          <a class="btn-link" href="#">{{ MgaAdmin.name }}</a>
                        </td>
                        <td>
                          <span
                            v-if="MgaAdmin.type === 'Admin'"
                            class="label label-table label-success"
                          >{{ MgaAdmin.type }}</span>
                          <span
                            v-if="MgaAdmin.type === 'Supervisor'"
                            class="label label-table label-success"
                          >{{ MgaAdmin.type }}</span>
                        </td>
                        <td>
                          <span class="label label-info" v-if="MgaAdmin.status === 1">Active</span>

                          <span class="label label-danger" v-else>Inactive</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a
                              class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                              href="#"
                              data-original-title="View User Details"
                              data-container="body"
                              title="View User Details"
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> -->

        <div
          class="modal fade"
          id="setupMdl1"
          tabindex="-1"
          role="dialog"
          data-backdrop="static"
          data-keyboard="false"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="MdlTitle1">Modal title</h5>
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
                action="addnewuser"
                @submit.prevent="submitformadd"
                method="post"
                enctype="multipart/form-data"
              >
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name">Full Name</label>

                        <input
                          type="text"
                          class="form-control"
                          v-model="form.name"
                          id="name"
                          name="name"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="email">Email Address</label>

                        <input
                          type="text"
                          class="form-control"
                          v-model="form.email"
                          id="email"
                          name="email"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="username">Username</label>

                        <input
                          type="text"
                          class="form-control"
                          v-model="form.username"
                          id="username"
                          name="username"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="password">Password</label>

                        <input
                          type="password"
                          placeholder="Password"
                          class="form-control"
                          v-model="form.password"
                          id="password"
                          name="password"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="cpassword">Confirm Password</label>

                        <input
                          type="password"
                          placeholder="Password"
                          class="form-control"
                          v-model="form.cpassword"
                          id="cpassword"
                          name="cpassword"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="type">Account Type</label>

                        <select
                          class="selectpicker form-control"
                          v-model="form.type"
                          id="type"
                          tabindex="-98"
                        >
                          <option value>Select Account Type</option>
                          <option value="Admin">Admin</option>
                          <option value="Supervisor">Supervisor</option>
                          <option value="Manager">Manager</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <button
                    type="submit"
                    class="btn btn-primary"
                    id="submitformadd"
                  >
                    Save
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row mar-top">
          <!-- <div class="col-md-2"></div> -->
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3
                  class="panel-title"
                  style="font-weight: bold; font-size: 20px"
                >
                  <i class="fa fa-truck"></i> Salesman Users
                </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="salesman_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userS.length">
                        <td colspan="6" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr v-for="(MgaSalesman, index) in userS" :key="index">
                        <td>
                          <a class="btn-link" href="#">
                            {{ MgaSalesman.name }}
                          </a>
                        </td>
                        <td>
                          <span class="label label-table label-success">
                            {{ MgaSalesman.type }}
                          </span>
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaSalesman.status === 1"
                            >Active</span
                          >

                          <span class="label label-danger" v-else
                            >Inactive</span
                          >
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a
                              class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                              href="#"
                              data-original-title="View User Details"
                              data-container="body"
                              title="View User Details"
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mar-top">
          <!-- <div class="col-md-2"></div> -->
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3
                  class="panel-title"
                  style="font-weight: bold; font-size: 20px"
                >
                  <i class="fa fa-truck"></i> Hepe de Viaje Users
                </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="hepe_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userH.length">
                        <td colspan="6" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr v-for="(MgaHepe, index) in userH" :key="index">
                        <td>
                          <a class="btn-link" href="#">{{ MgaHepe.name }}</a>
                        </td>
                        <td>
                          <span class="label label-table label-success">
                            {{ MgaHepe.type }}
                          </span>
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaHepe.status === 1"
                            >Active</span
                          >

                          <span class="label label-danger" v-else
                            >Inactive</span
                          >
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a
                              class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                              href="#"
                              data-original-title="View User Details"
                              data-container="body"
                              title="View User Details"
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mar-top">
          <!-- <div class="col-md-2"></div> -->
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3
                  class="panel-title"
                  style="font-weight: bold; font-size: 20px"
                >
                  <i class="fa fa-user-circle-o"></i> Customer Users
                </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
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
                              @keyup="searchC"
                              v-model="searchUserC"
                              placeholder="Search"
                            />
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <table
                    id="customer_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userC.data.length">
                        <td colspan="6" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr
                        v-for="MgaCustomer in userC.data"
                        :key="MgaCustomer.customer_id"
                      >
                        <td>
                          <a class="btn-link" href="#">
                            {{ MgaCustomer.account_name }}
                          </a>
                        </td>
                        <td>
                          <span class="label label-table label-success"
                            >Customer</span
                          >
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaCustomer.status === 1"
                            >Active</span
                          >

                          <span class="label label-danger" v-else
                            >Inactive</span
                          >
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a
                              class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                              href="#"
                              data-original-title="View User Details"
                              data-container="body"
                              title="View User Details"
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        Showing {{ userC.from }} to {{ userC.to }} of
                        {{ userC.total }} entries
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <pagination
                            style="margin: 0 0 20px 0;"
                            :limit="1"
                            :show-disabled="true"
                            :data="userC"
                            @pagination-change-page="getResultsC"
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
    </div>
    <!--===================================================-->
    <!--End Activated Users chart-->

    <div class="row">
      <div class="col-xs-6">
        <div class="panel">
          <!--Data Table-->
          <!--===================================================-->
          <div class="panel-body">
            <div class="pad-btm form-inline">
              <div class="panel-heading">
                <h3
                  class="panel-title"
                  style="font-weight: bold; font-size: 20px"
                >
                  <i class="fa fa-truck"></i> Top Salesman
                </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="top_salesman_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userS.length">
                        <td colspan="6" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr v-for="(MgaSalesman, index) in userS" :key="index">
                        <td>
                          <a class="btn-link" href="#">
                            {{ MgaSalesman.name }}
                          </a>
                        </td>
                        <td>
                          <span class="label label-table label-success">
                            {{ MgaSalesman.type }}
                          </span>
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaSalesman.status === 1"
                            >Active</span
                          >

                          <span class="label label-danger" v-else
                            >Inactive</span
                          >
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a
                              class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                              href="#"
                              data-original-title="View User Details"
                              data-container="body"
                              title="View User Details"
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="panel">
          <!--Data Table-->
          <!--===================================================-->
          <div class="panel-body">
            <div class="pad-btm form-inline">
              <div class="panel-heading">
                <h3
                  class="panel-title"
                  style="font-weight: bold; font-size: 20px"
                >
                  <i class="fa fa-group"></i> Top Customer
                </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="top_customer_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userS.length">
                        <td colspan="6" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr v-for="(MgaSalesman, index) in userS" :key="index">
                        <td>
                          <a class="btn-link" href="#">
                            {{ MgaSalesman.name }}
                          </a>
                        </td>
                        <td>
                          <span class="label label-table label-success">
                            {{ MgaSalesman.type }}
                          </span>
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaSalesman.status === 1"
                            >Active</span
                          >

                          <span class="label label-danger" v-else
                            >Inactive</span
                          >
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a
                              class="btn btn-sm btn-default btn-hover-success fa fa-list-ul add-tooltip"
                              href="#"
                              data-original-title="View User Details"
                              data-container="body"
                              title="View User Details"
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mar-top">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-body">
            <div class="panel-heading">
              <h3
                class="panel-title"
                style="font-weight: bold; font-size: 20px"
              >
                <i class="fa fa-list"></i> Top Items
              </h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <form
                  action="order"
                  @submit.prevent="submitformorder"
                  method="post"
                  enctype="multipart/form-data"
                >
                  <div class="col-lg-1">
                    <h5>Day :</h5>
                  </div>
                  <div class="col-lg-3">
                    <div id="ddate">
                      <datetime
                        v-model="date"
                        value-zone="Asia/Manila"
                        zone="Asia/Manila"
                      ></datetime>
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <h5>Month :</h5>
                  </div>
                  <div class="col-lg-3">
                    <v-select
                      v-model="selected"
                      :options="options"
                      :value="options.id"
                      @input="setSelected"
                      label="category_name"
                    ></v-select>
                  </div>
                  <div class="col-lg-1">
                    <h5>Year :</h5>
                  </div>
                  <div class="col-lg-3">
                    <v-select
                      v-model="selected1"
                      :options="options1"
                      :value="options1.id1"
                      @input="setSelected1"
                      label="category_name"
                    ></v-select>
                  </div>
                </form>
              </div>
              <br />
              <div class="table-responsive">
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
                            @keyup="search2"
                            v-model="searchItem2"
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
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Item Code</th>
                      <th>UOM</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="!items.data.length">
                      <td colspan="6" class="text-center">No data available</td>
                    </tr>
                    <tr
                      v-for="MgaItems in items.data"
                      :key="MgaItems.item_masterfiles_id"
                    >
                      <td>{{ MgaItems.product_name }}</td>
                      <td>{{ MgaItems.brand }}</td>
                      <td>{{ MgaItems.itemcode }}</td>
                      <td>{{ MgaItems.uom }}</td>
                      <td>
                        {{ parseFloat(MgaItems.list_price_wtax) | toCurrency }}
                      </td>
                      <td>
                        <span
                          class="label label-info"
                          v-if="MgaItems.status === 1"
                          >Active</span
                        >

                        <span class="label label-danger" v-else>Inactive</span>

                        <button
                          @click="detailsI(MgaItems)"
                          class="btn btn-info btn-xs"
                        >
                          <i class="fa fa-list-alt"></i>
                        </button>
                        &nbsp;
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      Showing {{ items.from }} to {{ items.to }} of
                      {{ items.total }} entries
                    </div>
                    <div class="col-md-6">
                      <div class="text-right">
                        <pagination
                          style="margin: 0 0 20px 0;"
                          :limit="1"
                          :show-disabled="true"
                          :data="items"
                          @pagination-change-page="getResultsTI"
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

    <!----------------------------------Form Modal------------------------------------------->
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
import _ from 'lodash'
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
// import moment from 'moment'
import { DateTime } from 'luxon'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import 'vue-select/src/scss/vue-select.scss'

Vue.component('v-select', vSelect)

Vue.use(require('vue-moment'))
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
  async beforeCreate() {
    const { data } = await axios.get('/getAuthUser')

    if (data.type !== 'MIS') {
      if (data.type === 'Admin') {
        location.replace('/dashboard')
      }
      if (data.type === 'Supervisor') {
        location.replace('/dashboard1')
      }
      if (data.type === 'Manager') {
        location.replace('/dashboard1')
      }
      if (data.type === 'Customer Service') {
        location.replace('/dashboard2')
      }
      if (data.type === 'Accounting') {
        location.replace('/dashboard2')
      }
      if (data.type === 'Internal Audit') {
        location.replace('/dashboard2')
      }
    }
  },
  data() {
    return {
      items: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      user: [],
      userA: [],
      userH: [],
      userS: [],
      userC: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      code: '',
      fullname: '',
      type: '',
      status: '',
      isActive: 1,
      usersTable: {},
      usersATable: {},
      usersHTable: {},
      usersSTable: {},
      usersCTable: {},
      searchUserA: null,
      searchUserH: null,
      searchUserS: null,
      searchUserC: null,
      searchUser: null,
      transaction: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      order: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      form: new Form({
        name: '',
        email: '',
        username: '',
        password: '',
        cpassword: '',
        type: ''
      }),
      form1: new Form({
        doc_no: '',
        tran_no2: '',
        itm_code: '',
        item_desc: '',
        req_qty: '',
        del_qty: '',
        uom: '',
        amt: '',
        tot_amt2: '',
        itm_cat: '',
        itm_stat: ''
      }),
      form2: new Form({
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
      id: '',
      id1: '',
      selected: null,
      selected1: null,
      options: [],
      options1: [],
      isActive: 1,
      searchItem2: null,
      date: DateTime.local().toString(),
      order_details: [],
      searchTrans: null,
      searchItemLog: null,
      total_amt_tran: 0,
      total_amt_line: 0,
      orderTable: {}
    }
  },
  components: {
    datetime: Datetime
  },
  watch: {
    date() {
      this.getResultsT()
    }
  },
  methods: {
    search2() {
      this.searchForItem2(this.searchItem2, this)
    },

    searchForItem2: _.debounce((search2, vm) => {
      axios
        .get(`/item/getItem2/item2/?name=${search2}&page=1`)
        .then(response => {
          vm.items = response.data
        })
    }, 500),
    search() {
      this.searchForUser(this.searchUser, this)
    },
    searchT() {
      this.searchForTrans(this.searchTrans, this)
    },
    searchA() {
      this.searchForUserA(this.searchUserA, this)
    },
    searchH() {
      this.searchForUserH(this.searchUserH, this)
    },
    searchS() {
      this.searchForUserS(this.searchUserS, this)
    },
    searchC() {
      this.searchForUserC(this.searchUserC, this)
    },
    searchForUser: _.debounce((search, vm) => {
      axios.get(`/user/getUser/users/?name=${search}&page=1`).then(response => {
        vm.user = response.data
      })
    }, 500),
    searchForTrans: _.debounce((searchT, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction/?date=${btoa(
            vm.date
          )}&name=${searchT}&page=1`
        )
        .then(response => {
          vm.transaction = response.data
        })
    }, 500),
    searchForUserA: _.debounce((searchA, vm) => {
      axios
        .get(`/user/getAdmin/admin/?name=${searchA}&page=1`)
        .then(response => {
          vm.userA = response.data
        })
    }, 500),
    searchForUserH: _.debounce((searchH, vm) => {
      axios
        .get(`/user/getHepedeViaje/hepedeviaje/?name=${searchH}&page=1`)
        .then(response => {
          vm.userH = response.data
        })
    }, 500),
    searchForUserS: _.debounce((searchS, vm) => {
      axios
        .get(`/user/getSalesman/salesman/?name=${searchS}&page=1`)
        .then(response => {
          vm.userS = response.data
        })
    }, 500),
    searchForUserC: _.debounce((searchC, vm) => {
      axios
        .get(`/user/getCustomer/customer/?name=${searchC}&page=1`)
        .then(response => {
          vm.userC = response.data
        })
    }, 500),
    add_new_user() {
      $('#setupMdl1').modal('show')
      $('#MdlTitle1').html('New User')
    },
    submitformadd() {
      this.form
        .post('/user/add_new_user')
        .then(({ data, status }) => {
          if (data == 'Success') {
            $('#setupMdl1').modal('hide')
            Swal.fire({
              title: 'Success!',
              text: 'User has been',
              icon: 'success',
              allowOutsideClick: false
            }).then(result => {
              if (result.value) {
                setTimeout(() => {
                  window.location.href = '/dashboard'
                }, 500)
              }
            })
          } else if (data == 'Error') {
            // $.niftyNoty({
            //   type: "danger",
            //   icon: "pli-cross icon-2x",
            //   message: "Please fill the blank.",
            //   container: "floating",
            //   timer: 5000,
            // });

            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Please fill the blank!.",
              container: 'floating',
              timer: 5000
            })
          } else if (data == 'Unmatched') {
            // $.niftyNoty({
            //   type: "danger",
            //   icon: "pli-cross icon-2x",
            //   message: "Password did not match!",
            //   container: "floating",
            //   timer: 5000,
            // });

            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Password did not match!.",
              container: 'floating',
              timer: 5000
            })
          } else if (data == 'Exists') {
            // $.niftyNoty({
            //   type: "danger",
            //   icon: "pli-cross icon-2x",
            //   message: "Account is already exists!",
            //   container: "floating",
            //   timer: 5000,
            // });

            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Account is already exists!.",
              container: 'floating',
              timer: 5000
            })
          }
          //else {
          //   // console.log(data);
          //   $.niftyNoty({
          //     type: "danger",
          //     icon: "pli-cross icon-2x",
          //     message: status,
          //     container: "floating",
          //     timer: 5000,
          //   });
          // }
        })
        .catch(error => {
          $.niftyNoty({
            type: 'danger',
            icon: 'fa fa-exclamation-triangle',
            message: 'Input fields are required.',
            container: 'floating',
            timer: 5000
          })
        })
      // Swal.fire({
      //   title: "Are you sure?",
      //   text: "",
      //   icon: "warning",
      //   showCancelButton: true,
      //   confirmButtonColor: "#3085d6",
      //   cancelButtonColor: "#d33",
      //   confirmButtonText: "Yes",
      //   allowOutsideClick: false,
      // }).then((result) => {
      //   if (result.value) {

      //   } else {
      //     $.niftyNoty({
      //       type: "danger",
      //       icon: "pli-cross icon-2x",
      //       message:
      //         "<i class='fa fa-exclamation-circle'></i> Action has been canceled.",
      //       container: "floating",
      //       timer: 5000,
      //     });
      //     $("#container").css("position", "relative");
      //   }
      // });
    },
    getMonth() {
      axios.get(`/user/get_month`).then(response => {
        this.options = response.data
      })
    },
    getYear() {
      axios.get(`/user/get_year`).then(response => {
        this.options1 = response.data
      })
    },
    setSelected(selected) {
      //  trigger a mutation, or dispatch an action
      if (selected === null || selected === 'undefined' || selected === '') {
        this.getMonth()
      } else {
        const res = Object.keys(selected).map(function(key) {
          return [selected[key]]
        })

        this.id = res[0]
        this.name = res[1]
        this.image = res[2]

        this.getMonth()
      }
    },
    setSelected1(selected1) {
      //  trigger a mutation, or dispatch an action
      if (selected1 === null || selected1 === 'undefined' || selected1 === '') {
        this.getYear()
      } else {
        const res = Object.keys(selected1).map(function(key) {
          return [selected1[key]]
        })

        this.id = res[0]
        this.name = res[1]
        this.image = res[2]

        this.getYear()
      }
    },
    getResults(page = 1) {
      let url = null
      if (!this.searchUserA) {
        url = '/user/getUser/?page='
      } else {
        url = `/user/getUser/users/?name=${this.searchUserA}&page=`
      }
      axios.get(url + page).then(response => {
        this.user = response.data

        setTimeout(() => {
          this.usersTable = $('#all_users').DataTable()
        }, 500)
      })
    },
    getResultsT(page = 1) {
      this.total_amt_tran = 0
      let url = null
      if (!this.searchTrans) {
        url = `/transaction/getTransaction/transaction/?date=${btoa(
          this.date
        )}&page=`
      } else {
        url = `/transaction/getTransaction/transaction/?date=${btoa(
          this.date
        )}&name=${this.searchTrans}&page=`
      }
      axios.get(url + page).then(response => {
        this.transaction = response.data

        this.transaction.data.forEach(datas => {
          // console.log(datas.downloaded)
          // this.downloaded = datas.downloaded

          this.total_amt_tran =
            this.total_amt_tran + parseFloat(datas['tot_amt'])
        })
      })
    },
    getResultsA(page = 1) {
      let url = null
      if (!this.searchUserA) {
        url = '/user/getAdmin/?page='
      } else {
        url = `/user/getAdmin/admin/?name=${this.searchUserA}&page=`
      }
      axios.get(url + page).then(response => {
        this.userA = response.data

        setTimeout(() => {
          this.usersATable = $('#admin_users').DataTable()
        }, 500)
      })
    },
    getResultsH(page = 1) {
      let url = null
      if (!this.searchUserH) {
        url = '/user/getHepedeViaje/?page='
      } else {
        url = `/user/getHepedeViaje/hepedeviaje/?name=${this.searchUserH}&page=`
      }
      axios.get(url + page).then(response => {
        this.userH = response.data

        setTimeout(() => {
          this.usersHTable = $('#hepe_users').DataTable()
        }, 500)
      })
    },
    getResultsS(page = 1) {
      let url = null
      if (!this.searchUserS) {
        url = '/user/getSalesman/?page='
      } else {
        url = `/user/getSalesman/salesman/?name=${this.searchUserS}&page=`
      }
      axios.get(url + page).then(response => {
        this.userS = response.data

        setTimeout(() => {
          this.usersSTable = $('#salesman_users').DataTable()
        }, 500)
      })
    },
    getResultsC(page = 1) {
      let url = null
      if (!this.searchUserC) {
        url = '/user/getCustomer/?page='
      } else {
        url = `/user/getCustomer/customer/?name=${this.searchUserC}&page=`
      }
      axios.get(url + page).then(response => {
        this.userC = response.data

        // setTimeout(() => {
        //   this.usersCTable = $('#customer_users').DataTable()
        // }, 500)
      })
    },
    getResultsTS(page = 1) {
      let url = null
      if (!this.searchUserS) {
        url = '/user/getSalesman/?page='
      } else {
        url = `/user/getSalesman/salesman/?name=${this.searchUserS}&page=`
      }
      axios.get(url + page).then(response => {
        this.userS = response.data

        setTimeout(() => {
          this.usersSTable = $('#top_salesman_users').DataTable()
        }, 500)
      })
    },
    getResultsTC(page = 1) {
      let url = null
      if (!this.searchUserS) {
        url = '/user/getSalesman/?page='
      } else {
        url = `/user/getSalesman/salesman/?name=${this.searchUserS}&page=`
      }
      axios.get(url + page).then(response => {
        this.userS = response.data

        setTimeout(() => {
          this.usersSTable = $('#top_customer_users').DataTable()
        }, 500)
      })
    },
    getResultsTI(page = 1) {
      let url = null
      if (!this.searchItem2) {
        url = '/item/getItem2/?page='
      } else {
        url = `/item/getItem2/item2/?name=${this.searchItem2}&page=`
      }
      axios.get(url + page).then(response => {
        this.items = response.data
      })
    },
    details(MgaUsers) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Item Details')
      $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.item_masterfiles_id = MgaUsers.item_masterfiles_id
      this.form.prdct_name = MgaUsers.product_name
      this.form.prdct_shrt_name = MgaUsers.product_shrt_name
      this.form.description = MgaUsers.description
      this.form.company_code = MgaUsers.company_code
      this.form.itemcode = MgaUsers.itemcode
      this.form.barcode = MgaUsers.barcode
      this.form.brand = MgaUsers.brand
      this.form.principal = MgaUsers.principal
      this.form.prdct_family = MgaUsers.product_family
      this.form.keywords = MgaUsers.keywords
      this.form.uom = MgaUsers.uom
      this.form.price_wout_tax = formatter.format(MgaUsers.list_price_wouttax)
      this.form.price_wt_tax = formatter.format(MgaUsers.list_price_wtax)
      this.form.conversion_qty = MgaUsers.conversion_qty
      this.form.conversion_uom = MgaUsers.conversion_uom
      this.form.image = 'storage/' + MgaUsers.image
      this.form.noimage = 'storage/items/no_image.jpg'

      if (MgaUsers.status === 1) {
        this.form.status = 'Active'
      } else {
        this.form.status = 'Inactive'
      }
    },
    closeModal() {
      document.getElementById('close').click()
      $('#setupMdl1').modal('hide')
      this.form.name = ''
      this.form.email = ''
      this.form.username = ''
      this.form.password = ''
      this.form.cpassword = ''
      this.form.type = ''
    },
    clearData() {
      this.orderTable.clear().destroy()
      this.order = {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      }

      this.form.tran_no = ''
      this.form.date_req = ''
      this.form.date_app = ''
      this.form.date_del = ''
      this.form.account_code = ''
      this.form.store_name = ''
      this.form.p_meth = ''
      this.form.itm_count = ''
      this.form.tot_amt = ''
      this.form.tran_stat = ''
      this.form.sm_name = ''
      this.form.sm_code = ''
      this.form1.tran_no2 = ''
      this.form1.itm_code = ''
      this.form1.item_desc = ''
      this.form1.req_qty = ''
      this.form1.uom = ''
      this.form1.amt = ''
      this.form1.tot_amt2 = ''
      this.form1.itm_cat = ''
      this.form1.itm_stat = ''
    },
    orderDetails(tran_no) {
      this.total_amt_line = 0
      axios
        .get(`/transaction/getOrderTransaction/order_detail/?id=${tran_no}`)
        .then(response => {
          this.order = response.data

          this.order.data.forEach(datas => {
            // console.log(datas.downloaded)
            // this.downloaded = datas.downloaded
            this.total_amt_line =
              this.total_amt_line + parseFloat(datas['tot_amt'])
          })

          if (Object.keys(this.order).length) {
            setTimeout(() => {
              this.orderTable = $('#OrderTable').DataTable()
            }, 500)
          }

          $('#setupMdl1').modal('show')
          $('#MdlTitle1').html('Order')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })

      this.getResultsT()
    },

    detailsI(MgaItems) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Item Details')
      $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form2.item_masterfiles_id = MgaItems.item_masterfiles_id
      this.form2.prdct_name = MgaItems.product_name
      this.form2.prdct_shrt_name = MgaItems.product_shrt_name
      this.form2.description = MgaItems.description
      this.form2.company_code = MgaItems.company_code
      this.form2.itemcode = MgaItems.itemcode
      this.form2.barcode = MgaItems.barcode
      this.form2.brand = MgaItems.brand
      this.form2.principal = MgaItems.principal
      this.form2.prdct_family = MgaItems.product_family
      this.form2.keywords = MgaItems.keywords
      this.form2.uom = MgaItems.uom
      this.form2.price_wout_tax = formatter.format(MgaItems.list_price_wouttax)
      this.form2.price_wt_tax = formatter.format(MgaItems.list_price_wtax)
      this.form2.conversion_qty = MgaItems.conversion_qty
      this.form2.conversion_uom = MgaItems.conversion_uom
      this.form2.image = 'storage/' + MgaItems.image
      this.form2.noimage = 'storage/items/no_image.jpg'

      if (MgaItems.status === 1) {
        this.form2.status = 'Active'
      } else {
        this.form2.status = 'Inactive'
      }
    },

    detailsOrder(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle2').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form1.tran_no2 = order_d.tran_no
            this.form1.itm_code = order_d.itm_code
            this.form1.item_desc = order_d.item_desc
            this.form1.req_qty = order_d.req_qty
            this.form1.uom = order_d.uom
            this.form1.amt = formatter.format(order_d.amt)
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form1.itm_cat = order_d.itm_cat
            this.form1.itm_stat = order_d.itm_stat
          })
        })

      this.getResultsT()
    },

    details(MgaTransaction) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.tran_no = MgaTransaction.tran_no
      this.form.date_req = MgaTransaction.date_req
      this.form.date_app = MgaTransaction.date_app
      this.form.date_del = MgaTransaction.date_del
      this.form.account_code = MgaTransaction.account_code
      this.form.store_name = MgaTransaction.store_name
      this.form.p_meth = MgaTransaction.p_meth
      this.form.itm_count = MgaTransaction.itm_count
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form.tran_stat = MgaTransaction.tran_stat
      this.form.sm_code = MgaTransaction.sm_code
      this.form.sm_name =
        MgaTransaction.first_name + ' ' + MgaTransaction.last_name

      this.getResultsT()
    }
  },
  mounted() {
    setTimeout(this.getResults(), 500)
    setTimeout(this.getResultsA(), 500)
    setTimeout(this.getResultsH(), 500)
    setTimeout(this.getResultsS(), 500)
    setTimeout(this.getResultsC(), 500)
    setTimeout(this.getResultsTS(), 500)
    setTimeout(this.getResultsTC(), 500)
    setTimeout(this.getResultsTI(), 500)
    this.$root.currentPage = this.$route.meta.name
    console.log('Component Mounted')
  }
}
</script>
