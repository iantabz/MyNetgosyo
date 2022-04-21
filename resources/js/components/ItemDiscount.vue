<template>
  <div id="page-body">
    <div class="row pad-btm">
      <form
        action="#"
        method="post"
        class="col-xs-12 col-sm-10 col-sm-offset-1 pad-hor"
      >
        <!-- <div class="input-group mar-btm">
          <input
            type="text"
            class="form-control input-lg"
            placeholder="Search Product name/ Item Code"
            v-model="searchItems"
            @keyup="search"
          />
          <span class="input-group-btn">
            <button class="btn btn-primary btn-lg" type="button">Search</button>
          </span>
        </div> -->
        <div class="form-group">
          <input
            type="text"
            placeholder="Search Product name/ Item Code"
            class="form-control input-lg"
            autofocus=""
            v-model="searchItems"
            @keyup="search"
          />
        </div>
      </form>
    </div>

    <div class="pad-all text-center">
      <div class="box-inline mar-btm pad-rgt">
        <span class="text-main text-bold">Filter by Category</span> :
        <div class="select">
          <select id="demo-ease" v-model="category" @change="cat($event)">
            <option value selected>All Items</option>
            <option value="with Discount">With Discounts</option>
          </select>
        </div>
      </div>
      <div class="box-inline mar-btm">
        Sort by :
        <div class="select">
          <select id="demo-ease">
            <option value="date-created" selected>Date created</option>
          </select>
        </div>
      </div>
      <!-- <button class="btn btn-default">Filter</button> -->
    </div>
    <hr class="new-section-xs bord-no" />
    <div class="panel">
      <!--Posts Table-->
      <!--===================================================-->
      <div class="panel-body">
        <table class="table table-hover table-striped nowrap table-vcenter">
          <thead>
            <tr>
              <th></th>
              <th>Product Name</th>
              <th>Item Code</th>
              <th>Brand</th>
              <th>UOM</th>
              <th>Price</th>
              <th style="text-align: center">
                <i class="fa fa-money" style="font-size: 19px"></i> Discount
                Amount
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!itemList.data.length">
              <td colspan="7" style="text-align: center">No data available.</td>
            </tr>
            <tr v-for="(items, index) in itemList.data" :key="index">
              <td>
                <i class="demo-pli-file" style="font-size: 35px"></i>
              </td>
              <td style="font-size: 12px">{{ items.product_name }}</td>
              <td>{{ items.itemcode }}</td>
              <td>{{ items.brand }}</td>
              <td>{{ items.uom }}</td>
              <td>{{ parseFloat(items.list_price_wtax) | toCurrency }}</td>
              <td>
                <input
                  class="form-control text-right discount"
                  style="height: 27px"
                  v-model.lazy="form.discount[items.item_masterfiles_id]"
                  v-money="money"
                  @keydown.enter="amount(items.item_masterfiles_id)"
                  @blur="amount(items.item_masterfiles_id)"
                />
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ itemList.from }} to {{ itemList.to }} of
              {{ itemList.total }} entries
              <span v-if="searchItems"
                >(Filtered from {{ form.total_result }} total entries)</span
              >
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <pagination
                  style="margin: 0 0 20px 0"
                  :limit="1"
                  :show-disabled="false"
                  :data="itemList"
                  @pagination-change-page="getResults"
                  v-if="!category"
                ></pagination>
                <pagination
                  style="margin: 0 0 20px 0"
                  :limit="1"
                  :show-disabled="false"
                  :data="itemList"
                  @pagination-change-page="withDiscount"
                  v-else
                ></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--===================================================-->
      <!--End Posts Table-->
    </div>
  </div>
</template>

<script>
/** @format */
import Vue from 'vue'
import Swal from "sweetalert2";
import { Form, HasError, AlertError } from "vform";
import { Money } from "v-money";
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.filter("toCurrency", function (value) {
  if (typeof value !== "number") {
    return value;
  }
  var formatter = new Intl.NumberFormat("en-PH", {
    style: "currency",
    currency: "PHP",
    minimumFractionDigits: 2,
  });
  return formatter.format(value);
});
export default {
  components: { Money },
  data() {
    return {
      form: new Form({
        total_result: null,
        discount: {},
      }),
      itemList: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      money: {
        decimal: ".",
        thousands: ",",
        prefix: "₱ ",
        suffix: "",
        precision: 2,
        masked: true,
      },
      searchItems: "",
      category: "",
    };
  },
  methods: {
    withDiscount(page = 1, e) {
      // if (e == "with Discount") {
      let url = null;
      url = `/discount/getItems/withCategory/?category=${btoa(e)}&page=`;
      // url = `/discount/getItems/withCategory/?page=`;
      axios.get(url + page).then((response) => {
        this.itemList = {};
        this.itemList = response.data;
        this.itemList.data.forEach((value) => {
          this.form.discount[value.item_masterfiles_id] = value.discount;
        });
        this.form.total_result = response.data.total;
      });
      // } else {
      //   this.getResults();
      // }
    },
    cat(e) {
      const selectedCategory = e.target.value;
      if (selectedCategory == "") {
        this.getResults();
      } else {
        this.withDiscount();
      }
    },
    amount(id) {
      const [currency, value] = this.form.discount[id].split(" ");
      this.changeAmount(id, value, this);
    },
    changeAmount: _.debounce((id, val, vm) => {
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
          axios.post("/discount/postDiscount", { id, val }).then((response) => {
            $("#container").css("position", "relative");
            $.niftyNoty({
              type: "success",
              icon: "pli-cross icon-2x",
              message:
                "<i class='fa fa-check-circle'></i> Success, account credit limit has been changed.",
              container: "floating",
              timer: 5000,
            });
          });
        } else {
          $("#container").css("position", "sticky");
          $.niftyNoty({
            type: "info",
            icon: "pli-cross icon-2x",
            message: "<i class='fa fa-close'></i> No changes have been made.",
            container: "floating",
            timer: 5000,
          });
        }
      });
    }, 100),
    search() {
      if (this.searchItems) {
        this.searchForItems(this.searchItems, this);
      } else if (this.category) {
        this.withDiscount();
      } else {
        this.getResults();
      }
    },
    searchForItems: _.debounce((search, vm) => {
      if (!vm.category) {
        axios
          .get(`/discount/getItems/name/?name=${search}&page=1`)
          .then((response) => {
            vm.itemList = {};
            vm.itemList = response.data;
            vm.itemList.data.forEach((value) => {
              vm.form.discount[value.item_masterfiles_id] = value.discount;
            });
          });
      } else {
        axios
          .get(
            `/discount/getItems/name/?name=${search}&cat=${vm.category}&page=1`
          )
          .then((response) => {
            vm.itemList = {};
            vm.itemList = response.data;
            vm.itemList.data.forEach((value) => {
              vm.form.discount[value.item_masterfiles_id] = value.discount;
            });
          });
      }
    }, 100),
    getResults(page = 1) {
      let url = null;
      if (!this.searchItems) {
        url = "/discount/getItems/?page=";
        axios.get(url + page).then((response) => {
          this.itemList = {};
          this.itemList = response.data;
          this.itemList.data.forEach((value) => {
            this.form.discount[value.item_masterfiles_id] = value.discount;
          });
          this.form.total_result = response.data.total;
        });
      } else {
        url = `/discount/getItems/name/?name=${this.searchItems}&page=`;
        axios.get(url + page).then((response) => {
          this.itemList = {};
          this.itemList = response.data;
          this.itemList.data.forEach((value) => {
            this.form.discount[value.item_masterfiles_id] = value.discount;
          });
        });
      }
    },
  },
  mounted() {
    this.getResults();
    this.$root.currentPage = this.$route.meta.name;
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
