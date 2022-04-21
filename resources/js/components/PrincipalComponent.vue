<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-heading">
        <!-- <h3 class="panel-title text-bold">Suppliers</h3> -->
      </div>
      <div class="panel-body">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-12">
            <button
              class="btn btn-success btn-rounded pull-right btn-sm"
              @click="addBtn()"
            >
              <i class="fa fa-plus-circle"></i> Principal
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 table-toolbar-left" style="padding-bottom: 0px">
            <form class="form-horizontal">
              <div class="form-group" style="margin-bottom: 0px">
                <!-- <label class="col-md-6 control-label">Search:</label> -->
                <div class="col-md-6">
                  <small class="text-main" style="padding-bottom: 25px"
                    >Search by Distributor:</small
                  >
                  <br />
                  <!-- class="selectpicker" -->
                  <select
                    class="demo_select2 form-control"
                    id="distributor"
                    v-model="distributor"
                    @change="select(distributor)"
                    data-placeholder="Select Distributor"
                  >
                    <option value="0">Select all</option>
                    <option value="LDI">LDI</option>
                    <option value="NETMAN">NETMAN</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div
            class="col-lg-6 table-toolbar-right"
            style="padding-bottom: 0px"
          ></div>
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
                    v-model="searchCompany"
                    @keyup="search"
                    placeholder="Search company name"
                  />
                </div>
              </div>
            </form>
          </div>
        </div>
        <table
          class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
        >
          <thead>
            <tr>
              <th>Principal/ Company</th>
              <th>Contract Under (Based on filed doc.)</th>
              <th>Contract Under (Based on receipt)</th>
              <!-- <th>
                <i class="fa fa-credit-card-alt"></i> Discount Percentage
              </th>-->
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!supplierList.data.length">
              <td colspan="4" class="text-center text-main">
                No data available.
              </td>
            </tr>
            <tr v-for="supplier in supplierList.data" :key="supplier.id">
              <td class="text-bold">{{ supplier.principal_name }}</td>
              <td v-if="supplier.contract_under_via_doc == ' '">
                <em>null</em>
              </td>
              <td v-else>{{ supplier.contract_under_via_doc }}</td>
              <td v-if="supplier.contract_under_via_receipt == ' '">
                <em>null</em>
              </td>
              <td v-else>{{ supplier.contract_under_via_receipt }}</td>
              <!-- <td>
                <input
                  class="form-control text-right discount"
                  style="height: 27px;"
                  placeholder="%"
                  @keydown.enter="amount(supplier.id)"
                  @blur="amount(supplier.id)"
                  v-model="discount[supplier.id]"
                  maxlength="2"
                />
              </td>-->
              <td>
                <div class="btn-group dropdown" v-if="supplier.status == '1'">
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
                        @click="btn_activation(supplier.id, '1')"
                        >Active</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        style="color: red"
                        @click="btn_activation(supplier.id, '0')"
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
                        @click="btn_activation(supplier.id, '1')"
                        >Active</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        style="color: red"
                        @click="btn_activation(supplier.id, '0')"
                        >Inactive</a
                      >
                    </li>
                  </ul>
                </div>
                <button @click="editBtn(supplier)" class="btn btn-info btn-xs">
                  <i class="fa fa-pencil-square-o"></i>
                </button>
                &nbsp;
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ supplierList.from }} to {{ supplierList.to }} of
              {{ supplierList.total }} entries
              <span v-if="searchCompany && !distributor"
                >(Filtered from {{ form.total_result }} total entries)</span
              >
              <span v-if="searchCompany && distributor"
                >(Filtered from {{ form.total_dis_result }} total entries)</span
              >
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <pagination
                  style="margin: 0 0 20px 0"
                  :limit="1"
                  :show-disabled="false"
                  :data="supplierList"
                  @pagination-change-page="getResults"
                  v-if="!distributor"
                ></pagination>
                <pagination
                  style="margin: 0 0 20px 0"
                  :limit="1"
                  :show-disabled="false"
                  :data="supplierList"
                  @pagination-change-page="withDis"
                  v-else
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              New Supplier Setup
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closeMdl()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div
                class="form-group"
                :class="{
                  'has-error': form.errors.has('principal_name'),
                }"
              >
                <label for="group_code" class="text-main text-bold"
                  >Principal/Company name</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="principal_name"
                  placeholder="Principal/Company name"
                  v-model="form.principal_name"
                  @input="form.errors.clear('principal_name')"
                />
                <has-error :form="form" field="principal_name"></has-error>
              </div>
              <div class="form-group">
                <label for="group_code" class="text-main text-bold"
                  >Contract Under (Based on filed doc.)</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="group_code"
                  placeholder="Contract Under"
                  v-model="form.contract_under_via_doc"
                />
              </div>
              <div class="form-group">
                <label for="group_code" class="text-main text-bold"
                  >Contract Under (Based on receipt)</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="group_code"
                  placeholder="Contract Under"
                  v-model="form.contract_under_via_receipt"
                />
              </div>
              <div class="form-group">
                <label for="group_code" class="text-main text-bold"
                  >Distributor</label
                >
                <!-- <input
                  type="text"
                  class="form-control"
                  id="group_code"
                  placeholder="Distributor"
                  v-model="form.distributor"
                />-->

                <select
                  class="selectpicker form-control"
                  v-model="form.distributor"
                  id="payment_type"
                >
                  <option disabled>Select Distributor</option>
                  <option value="LDI">LDI</option>
                  <option value="NETMAN">NETMAN</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="closeMdl()"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="submitBtn()"
              >
                Save changes
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
import Vue from 'vue'
import Swal from "sweetalert2";
import { Form, HasError, AlertError } from "vform";

Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

export default {
  data() {
    return {
      searchCompany: "",
      form: new Form({
        id: "",
        principal_name: "",
        contract_under_via_doc: "",
        contract_under_via_receipt: "",
        distributor: "",
        total_result: null,
        total_dis_result: null,
      }),
      supplierList: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      distributor: "",
      discount: {},
    };
  },
  methods: {
    amount(id) {
      // const [amount, value] = this.discount[id]
      this.changeAmount(id, this.discount[id], this);
    },
    changeAmount: _.debounce((id, val, vm) => {
      axios.post("/principal/postDiscount", { id, val }).then((response) => {
        $.niftyNoty({
          type: "success",
          icon: "pli-cross icon-2x",
          message:
            "<i class='fa fa-check-circle'></i> Success, discount has been added/changed.",
          container: "floating",
          timer: 5000,
        });
      });
    }, 100),
    closeMdl() {
      this.form.reset();
    },
    editBtn(data) {
      // console.log(data)
      $("#setupMdl").modal("show");
      setTimeout(() => {
        $("#payment_type").selectpicker("refresh");
      }, 100);

      this.form.fill(data);
      $("#container").css("position", "relative");
    },
    withDis(page = 1) {
      let url = null;

      url = `/principal/get_supplier/dis/?distributor=${this.distributor}&page=`;
      axios.get(url + page).then((response) => {
        this.supplierList = response.data;
        this.form.total_dis_result = response.data.total;
      });
    },
    select(dis) {
      // alert(dis)
      if (dis == "") {
        this.getResults();
      } else {
        this.withDis(dis);
      }
    },
    search() {
      this.searchForSupplier(this.searchCompany, this);
    },
    searchForSupplier: _.debounce((search, vm) => {
      if (!vm.distributor) {
        axios
          .get(`/principal/get_supplier/name/?name=${search}&page=1`)
          .then((response) => {
            vm.supplierList = response.data;
          });
      } else if (search && distributor) {
        axios
          .get(
            `/principal/get_supplier/name/?distributor=${vm.distributor}&name=${search}&page=1`
          )
          .then((response) => {
            vm.supplierList = response.data;
          });
      } else {
        axios
          .get(
            `/principal/get_supplier/name/?distributor=${vm.distributor}&page=1`
          )
          .then((response) => {
            vm.supplierList = response.data;
          });
      }
    }, 100),
    getResults(page = 1) {
      let url = null;
      if (!this.searchCompany) {
        url = "/principal/get_supplier/?page=";
        axios.get(url + page).then((response) => {
          this.form.total_result = response.data.total;
        });
      } else {
        url = `/principal/get_supplier/name/?name=${this.searchCompany}&page=`;
        this.supplierList.data.forEach((value) => {
          this.discount[value.id] = value.discount;
        });
      }
      axios.get(url + page).then((response) => {
        this.supplierList = response.data;

        this.supplierList.data.forEach((value) => {
          this.discount[value.id] = value.discount;
        });
        // setTimeout(() => {
        //   $('.discount').mask('9?9%')
        // }, 100)
      });
    },
    addBtn() {
      $("#setupMdl").modal("show");
      $("#container").css("position", "relative");
    },
    clear() {
      this.form.reset();
      this.form.clear();
    },
    submitBtn() {
      $("#setupMdl").modal("hide");
      $("#container").css("position", "sticky");
      Swal.fire({
        title: "Are you sure?",
        text: "Please check the information before submitting",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, I am sure!",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          this.form
            .post("/principal/create_supplier")
            .then(({ data, status }) => {
              if (data == "Success") {
                Swal.fire({
                  title: "Success!",
                  text: "Information has been saved.",
                  icon: "success",
                  allowOutsideClick: false,
                }).then((result) => {
                  if (result.value) {
                    this.clear();
                    this.getResults();
                  }
                });
              } else {
                Swal.fire({
                  title: "Success!",
                  text: "Information has been updated.",
                  icon: "success",
                  allowOutsideClick: false,
                }).then((result) => {
                  if (result.value) {
                    this.clear();
                    this.search();
                  }
                });
              }
            })
            .catch((error) => {
              $.niftyNoty({
                type: "danger",
                icon: "pli-cross icon-2x",
                message:
                  '<i class="fa fa-exclamation-circle"></i> Given data is invalid.',
                container: "floating",
                timer: 5000,
              });
              $("#setupMdl").modal("show");
              $("#container").css("position", "relative");
            });
        } else {
          $.niftyNoty({
            type: "danger",
            icon: "pli-cross icon-2x",
            message:
              "<i class='fa fa-exclamation-triangle'></i> Action has been canceled.",
            container: "floating",
            timer: 5000,
          });
        }
      });
    },
    btn_activation(id, status) {
      this.form.id = id;
      this.form.status = status;
      this.form
        .post("/principal/toggleSupplier")
        .then(({ data }) => {
          if (data.trim() == "Success") {
            if (status == "1") {
              $.niftyNoty({
                type: "success",
                icon: "pli-cross icon-2x",
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: "floating",
                timer: 5000,
              });
            } else {
              $.niftyNoty({
                type: "success",
                icon: "pli-cross icon-2x",
                message:
                  "<i class='fa fa-check'></i> Status now changed to Inactive.",
                container: "floating",
                timer: 5000,
              });
            }
            this.getResults();
          } else {
            if (data.trim() == "Error") {
              if (status == "1") {
                $.niftyNoty({
                  type: "danger",
                  icon: "pli-cross icon-2x",
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already active.",
                  container: "floating",
                  timer: 5000,
                });
              } else {
                $.niftyNoty({
                  type: "danger",
                  icon: "pli-cross icon-2x",
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already inactive.",
                  container: "floating",
                  timer: 5000,
                });
              }
            }
          }
        })
        .catch((error) => {});
    },
  },
  mounted() {
    $("#container").css("position", "relative");
    this.getResults();
    this.$root.currentPage = this.$route.meta.name;
    setTimeout(() => {
      $("#payment_type").selectpicker("refresh");
      // $('#distributor').selectpicker('refresh')
      var selectDropDown = $("#distributor").select2();
      selectDropDown.on("select2:select", function (e) {
        var event = new Event("change");
        e.target.dispatchEvent(event);
      });
    }, 100);
  },
};
</script>

<style lang="scss" scoped>
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
