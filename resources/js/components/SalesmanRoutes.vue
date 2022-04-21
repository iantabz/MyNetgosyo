<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-heading">
        <h3 style="font-weight: bold; font-size: 20px; padding: 15px 0 0 25px">
          <i class="fa fa-leanpub"></i> Routes
        </h3>
      </div>
      <div class="panel-body">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-12"></div>
        </div>
        <div class="row">
          <div class="col-lg-6 table-toolbar-left">
            <form class="form-horizontal">
              <div class="row" style="padding: 25px 15px 25px 10px">
                <label class="col-md-3 control-label text-bold"
                  >Select Salesman:</label
                >
                <div class="col-md-6">
                  <select
                    class="demo_select2 form-control"
                    id="distributor"
                    data-placeholder="Select Salesman to begin"
                    v-model="salesmanSchedule.id"
                    @change="selectSalesman($event)"
                    data-target="#demo-panel-ref"
                  >
                    <option value="">Select Salesman</option>
                    <option
                      v-for="option in salesmanList"
                      :key="option.id"
                      :value="option.id"
                    >
                      {{
                        "[" +
                        option.salesman_code +
                        "] " +
                        option.first_name +
                        " " +
                        option.last_name
                      }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="row" style="padding-bottom: 15px">
                <label class="col-md-3 control-label text-bold"
                  >Jepe de Viaje:</label
                >
                <div class="col-md-6">
                  <input
                    class="form-control"
                    v-model="hepe"
                    style="width: 310px"
                    disabled
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-6 table-toolbar-right"></div>
        </div>
        <hr class="new-section-sm bord-no" />
        <table
          class="table table-striped table-hover dt-responsive nowrap table-vcenter"
          id="demo-panel-ref"
        >
          <thead>
            <tr>
              <th style="width: 25%; text-align: center">Towns</th>
              <th style="width: 25%; text-align: center">
                Booking Day Schedule
              </th>
              <th style="width: 25%; text-align: center">Batch No</th>
              <th style="width: 25%; text-align: center">Delivery Day</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in salesmanSchedule.rows" :key="index">
              <td>
                <v-select
                  :disabled="!salesmanSchedule.id"
                  class="text-center"
                  v-model="row.towns"
                  multiple
                  label="mun_name"
                  :options="townList"
                  :reduce="(town) => town.id"
                  placeholder="Search Towns"
                ></v-select>
              </td>
              <td
                class="text-bold"
                style="text-align: center"
                v-text="row.booking"
              ></td>
              <td>
                <input
                  v-model="row.batch"
                  type="number"
                  class="form-control"
                  style="height: 30px; text-align: center"
                  :disabled="!salesmanSchedule.id"
                />
              </td>
              <td
                class="text-bold"
                style="text-align: center"
                v-text="row.delivery"
              ></td>
            </tr>
          </tbody>
        </table>
        <hr class="new-section-sm bord-no" />
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-6" style="padding: 15px"></div>
          <div class="col-lg-6" style="padding: 15px">
            <button
              class="btn btn-primary btn-rounded pull-right"
              id="submitform"
              type="submit"
              @click="submitBtn"
              :disabled="!salesmanSchedule.id"
            >
              <i class="fa fa-check"></i> Set Schedule
            </button>
            <!-- <button
              class="btn btn-primary btn-rounded pull-right"
              id="submitform"
              type="submit"
              :disabled="!salesmanSchedule.id"
              v-show="salesmanSchedule.id"
              style="margin-right: 12px"
              @click="printBtn"
            >
              <i class="fa fa-print"></i> Print Schedule
            </button> -->
          </div>
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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
Vue.component("v-select", vSelect);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("pagination", require("laravel-vue-pagination"));

export default {
  data() {
    return {
      salesmanList: {},
      salesmanSchedule: {
        id: "",
        code: "",
        rows: [
          {
            towns: [],
            booking: "Monday",
            batch: 0,
            delivery: "Wednesday",
          },
          {
            towns: [],
            booking: "Tuesday",
            batch: 0,
            delivery: "Thursday",
          },
          {
            towns: [],
            booking: "Wednesday",
            batch: 0,
            delivery: "Friday",
          },
          {
            towns: [],
            booking: "Thursday",
            batch: 0,
            delivery: "Saturday",
          },
          {
            towns: [],
            booking: "Friday",
            batch: 0,
            delivery: "Monday",
          },
          {
            towns: [],
            booking: "Saturday",
            batch: 0,
            delivery: "Tuesday",
          },
        ],
      },
      hepe: "",
      townList: [],
    };
  },
  methods: {
    printBtn() {
      console.log(this.salesmanSchedule.code);
      document.location.href = `/salesman_route/print/?code=${this.salesmanSchedule.code}`;
    },
    submitBtn() {
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
          axios
            .post("/salesman_route/postSchedule", this.salesmanSchedule)
            .then((response) => {
              $("#container").css("position", "relative");
              $.niftyNoty({
                type: "success",
                icon: "pli-cross icon-2x",
                message:
                  "<i class='fa fa-check-circle'></i> Success, salesman schedule has been added/changed.",
                container: "floating",
                timer: 5000,
              });
            });
        } else {
          $("#container").css("position", "sticky");
          $.niftyNoty({
            type: "info",
            icon: "pli-cross icon-2x",
            message: "<i class='fa fa-close'></i> Action canceled.",
            container: "floating",
            timer: 5000,
          });
        }
      });
    },
    getTown() {
      axios
        .get("/salesman_route/getTownList")
        .then((response) => {
          this.townList = response.data;
        })
        .catch((response) => {
          console.log("error");
        });
    },
    selectSalesman(e) {
      this.salesmanSchedule.rows.forEach((row) => {
        row.towns = [];
        row.batch = 0;
      });
      const selectedSalesman = e.target.value;

      const salesMan = this.salesmanList.filter(
        (sm) => sm.id == selectedSalesman
      )[0];

      axios
        .get(`/salesman_route/salesman/${salesMan.salesman_code}`)
        .then((response) => {
          const currentSalesmanSchedules = response.data;
          currentSalesmanSchedules.forEach((sched) => {
            const { mun_id, booking_day, batch_no, del_day } = sched;

            this.salesmanSchedule.rows.forEach((row, index) => {
              if (row.booking == booking_day && row.delivery == del_day) {
                this.salesmanSchedule.rows[index].towns.push(parseInt(mun_id));
                this.salesmanSchedule.rows[index].batch = batch_no;
              }
            });
          });
        });

      this.salesmanSchedule.code = salesMan.salesman_code;
      this.hepe = `${salesMan.hepe_firstname} ${salesMan.hepe_lastname}`;
    },
    getSalesman() {
      axios
        .get("/salesman_route/getSalesman")
        .then((response) => {
          this.salesmanList = response.data;
          setTimeout(() => {
            var selectDropDown = $("#salesman").select2();
            selectDropDown.on("select2:select", function (e) {
              var event = new Event("change");
              e.target.dispatchEvent(event);
            });
          }, 100);
        })
        .catch((response) => {
          console.log("error");
        });
    },
  },
  mounted() {
    this.getSalesman();
    this.getTown();
    $("#container").css("position", "relative");
    this.$root.currentPage = this.$route.meta.name;

    setTimeout(() => {
      var selectDropDown = $("#distributor").select2().niftyOverlay({
        iconClass: "demo-psi-repeat-2 spin-anim icon-4x",
        desc: "Please wait while the content is loading.",
      });
      selectDropDown.on("select2:select", function (e) {
        var event = new Event("change");
        e.target.dispatchEvent(event);

        var $el = $(this),
          relTime;
        $el.niftyOverlay("show");

        // Do something...

        relTime = setInterval(function () {
          // Hide the screen overlay
          $el.niftyOverlay("hide");

          clearInterval(relTime);
        }, 500);
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
