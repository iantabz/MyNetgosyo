<template>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data table</h4>
          <div class="d-flex flex-row-reverse">
            <button class="btn btn-outline-primary btn-sm" @click="addUserType()">
              <i class="ti-plus"></i> Add
            </button>
          </div>
          <Br />
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="spence" class="table">
                  <thead>
                    <tr>
                      <th>User Type</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>New York</td>
                      <td>
                        <label class="badge badge-info">On hold</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
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
</template>

<script>
import Swal from "sweetalert2";
import { Form, HasError, AlertError } from "vform";
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

export default {
  data() {},
  methods: {},
  mounted() {
    console.log("Component mounted.");
    $("#spence").dataTable();
  }
};
</script>