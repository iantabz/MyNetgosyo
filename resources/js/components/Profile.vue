<!-- @format -->
<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-body">
        <div class="fixed-fluid">
          <div class="fixed-md-200 pull-sm-left fixed-right-border">
            <!-- Simple profile -->
            <div class="text-center">
              <div class="pad-ver">
                <img
                  src="assets/img/profile-photos/1.png"
                  class="img-lg img-circle"
                  alt="Profile Picture"
                />
              </div>
              <h4 class="text-lg text-overflow mar-no">
                {{ $root.authUser.name }}
              </h4>
              <p class="text-sm text-muted">{{ $root.authUser.type }}</p>
            </div>
            <hr />
          </div>
          <div class="fluid">
            <div class="text-right">
              <button class="btn btn-sm btn-primary" @click="edit_profile()">
                Edit Profile
              </button>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-12">
                  <h4 class="pad-btm bord-btm" style="font-weight: bold">
                    Personal Information
                  </h4>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label text-main text-bold">
                      Fullname:
                    </label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.name"
                    />
                  </div>

                  <div class="form-group">
                    <label class="control-label text-main text-bold">
                      Username:
                    </label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.username"
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label text-main text-bold">
                      Email Address:
                    </label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.email"
                    />
                  </div>
                  <div class="form-group">
                    <label class="control-label text-main text-bold">
                      AccountType:
                    </label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.type"
                    />
                  </div>
                </div>
              </div>
            </div>

            <hr />
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="edit_profile"
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
          <form @submit.prevent="editprofile">
            <div class="modal-body">
              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('name') }"
              >
                <label for="name">Name:</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  v-model="form.name"
                  placeholder="Enter user full name"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('email') }"
              >
                <label for="email">Email: (Optional)</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  v-model.trim="form.email"
                  placeholder="Enter email address"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('username') }"
              >
                <label for="username">Username:</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  v-model.trim="form.username"
                  placeholder="Enter username"
                />
                <has-error :form="form" field="username"></has-error>
              </div>

              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('old_password') }"
              >
                <label for="username">Old Password:</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  v-model.trim="form.old_password"
                  placeholder="Enter old password"
                />
                <has-error :form="form" field="old_password"></has-error>
              </div>

              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('new_password') }"
              >
                <label for="username">New Password: &#40;Optional&#41;</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  v-model.trim="form.new_password"
                  placeholder="Enter new password"
                />
                <has-error :form="form" field="new_password"></has-error>
              </div>

              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('type') }"
              >
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
                <has-error :form="form" field="type"></has-error>

                <input type="hidden" id="id" name="id" v-model="form.id" />
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
              <button type="button" class="btn btn-success" @click="savebtn()">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
/** @format */
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import Vue from 'vue'
import _ from 'lodash'

Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

export default {
  data() {
    return {
      form: new Form({
        id: '',
        name: '',
        email: '',
        username: '',
        old_password: '',
        new_password: '',
        type: ''
      })
    }
  },
  methods: {
    edit_profile() {
      $('#edit_profile').modal('show')
      $('.modal-title').html('<i class="fa fa-plus-circle"></i> Update Account')
    },
    // savebtn() {
    //   this.form
    //     .put(`/user/edit_profile/${this.form.id}`)
    //     .then(({ data }) => {
    //       $.niftyNoty({
    //         type: 'success',
    //         icon: 'fa fa-exclamation-triangle',
    //         message: data.message,
    //         container: 'floating',
    //         timer: 5000
    //       })
    //     })
    //     .catch(error => console.error(error.response))
    // },
    savebtn() {
      this.form
        .post('/user/edit_profile')
        .then(({ data, status }) => {
          if (data == 'Success') {
            $('#edit_profile').modal('hide')
            Swal.fire({
              title: 'Success!',
              text: 'User has been',
              icon: 'success',
              allowOutsideClick: false
            }).then(result => {
              if (result.value) {
                setTimeout(() => {
                  window.location.href = '/profile'
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
          } else if (data == 'Password Required') {
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i> Password Required to edit.",
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
    closeModal() {
      $('#edit_profile').modal('hide')
    }
  },
  mounted() {
    this.$root.currentPage = this.$route.meta.name

    this.form.id = this.$root.authUser.id
    this.form.name = this.$root.authUser.name
    this.form.email = this.$root.authUser.email
    this.form.username = this.$root.authUser.username
    this.form.type = this.$root.authUser.type
  }
}
</script>
<style scoped>
/** @format */
</style>
