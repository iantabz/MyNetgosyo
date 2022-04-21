<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="row mar-top">
          <!-- <div class="col-md-2"></div> -->
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3
                  class="panel-title"
                  style="font-weight: bold; font-size: 20px"
                >
                  <i class="fa fa-group"></i>Backend Users Account
                </h3>

                <span style="position:relative;bottom:40px; float:right;">
                  <button class="btn btn-info" @click="add_new()">
                    <i class="fa fa-plus"></i> Add New
                  </button>
                </span>
              </div>

              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="acct_users"
                    class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!userAcct.length">
                        <td colspan="6" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr v-for="(MgaAccount, index) in userAcct" :key="index">
                        <td>
                          <a class="btn-link" href="#">
                            {{ MgaAccount.name }}
                          </a>
                        </td>
                        <td>
                          <span class="label label-table label-success">
                            {{ MgaAccount.type }}
                          </span>
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaAccount.status === 1"
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
                              @click="view_account(MgaAccount)"
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

    <!----------------------------------Form Modal------------------------------------------->

    <div
      class="modal fade"
      id="view_account"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title1" id="MdlTitle1">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closeModal1()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="resetpassword">
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Name:</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  v-model="form1.name"
                  placeholder="Enter user full name"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="email">Email: &#40;Optional&#41;</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  v-model="form1.email"
                  placeholder="Enter email address"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="username">Username:</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  v-model="form1.username"
                  placeholder="Enter username"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>

              <div class="form-group">
                <label for="type">Type:</label>
                <input
                  type="text"
                  class="form-control"
                  id="type"
                  v-model="form1.type"
                />
                <input type="hidden" id="id" name="id" v-model="form1.id" />

                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="closeModal1()"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-success"
                @click="resetpassword()"
              >
                Reset Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="add_new_account"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closeModal()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Name:</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  v-model="form.name"
                  placeholder="Enter user full name"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="email">Email: &#40;Optional&#41;</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  v-model="form.email"
                  placeholder="Enter email address"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="username">Username:</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  v-model="form.username"
                  placeholder="Enter username"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  v-model="form.password"
                  placeholder="Enter password"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="cpassword">Confirm Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="cpassword"
                  v-model="form.cpassword"
                  placeholder="Re-enter password"
                />
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
              <div class="form-group">
                <label for="type">Type:</label>
                <select
                  name="type"
                  id="type"
                  v-model="form.type"
                  class="form-control"
                >
                  <option value="">Select</option>
                  <option value="Admin">Admin</option>
                  <option value="MIS">MIS</option>
                  <option value="Supervisor">Supervisor</option>
                  <option value="Manager">Manager</option>
                  <option value="Internal Audit">Internal Audit</option>
                  <option value="Accounting">Accounting</option>
                  <option value="Customer Service">Customer Service</option>
                </select>
                <!-- <has-error :form="dataForm" field="group_code"></has-error> -->
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="closeModal()"
              >
                Close
              </button>
              <button type="button" class="btn btn-success" @click="submit()">
                Save
              </button>
            </div>
          </form>
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
  .modal-title1 {
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
  .modal-title1 {
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
    if (data.type !== 'Admin') {
      location.replace('/dashboard1')
    }
  },
  data() {
    return {
      userAcct: [],
      usersAcctTable: {},
      form: new Form({
        name: '',
        email: '',
        username: '',
        password: '',
        cpassword: '',
        type: ''
      }),
      form1: this.newForm(),
      date: DateTime.local().toString()
    }
  },
  components: {
    datetime: Datetime
  },
  methods: {
    newForm() {
      return new Form({
        id: '',
        name: '',
        email: '',
        username: '',
        type: ''
      })
    },
    add_new() {
      $('#add_new_account').modal('show')
      $('.modal-title').html('<i class="fa fa-plus-circle"></i> New Account')
    },
    view_account(MgaItems) {
      $('#view_account').modal('show')
      $('.modal-title1').html('<i class="fa fa-eye"></i> View Account')

      this.form1.id = MgaItems.id
      this.form1.name = MgaItems.name
      this.form1.email = MgaItems.email
      this.form1.username = MgaItems.username
      this.form1.type = MgaItems.type
    },
    resetpassword() {
      this.form1
        .put(`/user/reset_password/${this.form1.id}`)
        .then(({ data }) => {
          $.niftyNoty({
            type: 'success',
            icon: 'fa fa-exclamation-triangle',
            message: data.message,
            container: 'floating',
            timer: 5000
          })
        })
        .catch(error => console.error(error.response))
    },
    submit() {
      this.form
        .post('/user/add_new_user')
        .then(({ data, status }) => {
          if (data == 'Success') {
            $('#add_new_account').modal('hide')
            Swal.fire({
              title: 'Success!',
              text: 'User has been',
              icon: 'success',
              allowOutsideClick: false
            }).then(result => {
              if (result.value) {
                setTimeout(() => {
                  window.location.href = '/setup_user'
                }, 500)
              }
            })
          } else if (data == 'Error') {
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Please fill the blank!.",
              container: 'floating',
              timer: 5000
            })
          } else if (data == 'Unmatched') {
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Password did not match!.",
              container: 'floating',
              timer: 5000
            })
          } else if (data == 'Exists') {
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Account is already exists!.",
              container: 'floating',
              timer: 5000
            })
          }
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
    },

    searchAcct() {
      this.searchForUserAcct(this.searchAcct, this)
    },

    searchForUserAcct: _.debounce((searchAcct, vm) => {
      axios
        .get(`/user/getUserAcct/usersAcct/?name=${searchAcct}&page=1`)
        .then(response => {
          vm.userAcct = response.data
        })
    }, 500),

    getResultsAcct(page = 1) {
      let url = null
      if (!this.searchUserAcct) {
        url = '/user/getUserAcct/?page='
      } else {
        url = `/user/getUserAcct/usersAcct/?name=${this.searchUserAcct}&page=`
      }
      axios.get(url + page).then(response => {
        this.userAcct = response.data

        setTimeout(() => {
          this.usersAcctTable = $('#acct_users').DataTable()
        }, 500)
      })
    },

    closeModal() {
      $('#add_new_account').modal('hide')
      this.form.name = ''
      this.form.email = ''
      this.form.username = ''
      this.form.password = ''
      this.form.cpassword = ''
      this.form.type = ''
    },
    closeModal1() {
      $('#view_account').modal('hide')
      this.form1.reset()
    }
  },
  mounted() {
    setTimeout(this.getResultsAcct(), 500)

    this.$root.currentPage = this.$route.meta.name
    console.log('Component Mounted')
  }
}
</script>
