<template>
<div>
  <form @submit.prevent="submit()">
    <div class="form-group">
      <span>Old password</span>
      <input type="password"
        class="form-control" v-model="form.old_password"
        required autocomplete="off"
      >
      <div style="color:red;" v-if="form.errors.has('old_password')" 
        v-html="form.errors.get('old_password')" />
    </div>
    <div class="form-group">
      <span>New Password</span>
      <input type="password"
        class="form-control" v-model="form.new_password"
        required
      >
      <div style="color:red;" v-if="form.errors.has('new_password')" 
        v-html="form.errors.get('new_password')" />
    </div>
    <div class="form-group">
      <span>Confirm Password</span>
      <input type="password"
        class="form-control" v-model="form.new_password_confirmation"
        required
      >
      <div style="color:red;" v-if="form.errors.has('new_password_confirmation')" 
        v-html="form.errors.get('new_password_confirmation')" />
    </div>
    <div class="form-group">
      <br>
      <button
        class="btn btn-success"
      >
        Update Password
      </button>
    </div>
  </form>
</div>
</template>

<script>
import { Form } from "vform";
import Swal from "sweetalert2";

export default {
  props: ['username'],

  data() {
    return {
      form: new Form({
        username: '',
        old_password: '',
        new_password: '',
        new_password_confirmation: '',
      }),

    }
  },

  methods: {
    async submit() {
      this.form.username = this.username;
      const response = await this.form.post('/user/change-password');
      if(response.data.success) {
        Swal.fire('Success',response.data.message,'success');
        setTimeout(function(){ window.location.reload() }, 1000);
      } else {
        Swal.fire('Oops!',response.data.message,'error');
      }
    },
  },

  created() {
  },
}
</script>