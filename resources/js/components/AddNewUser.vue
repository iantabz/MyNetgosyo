<!-- @format -->

<template>
  <div id="page-content">
    <!--Activated Users Chart-->
    <!--===================================================-->

    <div class="panel">
      <!--Chart information-->
      <div class="panel-body">
        <div class="row mar-top"></div>
      </div>
    </div>
    <!--===================================================-->
    <!--End Activated Users chart-->

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
import Vue from "vue";
import Swal from "sweetalert2";
import { Form, HasError, AlertError } from "vform";
import { serialize } from "object-to-formdata";
import _ from "lodash";
import { Datetime } from "vue-datetime";
// You need a specific loader for CSS files
import "vue-datetime/dist/vue-datetime.css";
// import moment from 'moment'
import { DateTime } from "luxon";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import "vue-select/src/scss/vue-select.scss";

Vue.component("v-select", vSelect);

Vue.use(require("vue-moment"));
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
  async beforeCreate() {
    const { data } = await axios.get("/getAuthUser");
    if (data.type !== "Admin") {
      location.replace("/dashboard1");
    }
  },
  data() {
    return {
      items: {
        image: "",
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
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
        per_page: null,
      },
      code: "",
      fullname: "",
      type: "",
      status: "",
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
        image: "",
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      order: {
        image: "",
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      form: new Form({
        id: "",
        tran_no: "",
        date_req: "",
        date_app: "",
        date_del: "",
        account_code: "",
        store_name: "",
        p_meth: "",
        itm_count: "",
        tot_amt: "",
        tran_type: "",
        tran_stat: "",
        sm_name: "",
        sm_code: "",
      }),
      form1: new Form({
        doc_no: "",
        tran_no2: "",
        itm_code: "",
        item_desc: "",
        req_qty: "",
        del_qty: "",
        uom: "",
        amt: "",
        tot_amt2: "",
        itm_cat: "",
        itm_stat: "",
      }),
      form2: new Form({
        item_masterfiles_id: "",
        prdct_name: "",
        prdct_shrt_name: "",
        description: "",
        company_code: "",
        itemcode: "",
        barcode: "",
        brand: "",
        principal: "",
        prdct_family: "",
        keywords: "",
        uom: "",
        price_wout_tax: "",
        price_wt_tax: "",
        conversion_qty: "",
        conversion_uom: "",
        item_masterfiles_id: "",
        status: "",
        image: "",
      }),
      id: "",
      id1: "",
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
      orderTable: {},
    };
  },
  components: {
    datetime: Datetime,
  },
  watch: {
    date() {
      this.getResultsT();
    },
  },
  methods: {
    search2() {
      this.searchForItem2(this.searchItem2, this);
    },

    searchForItem2: _.debounce((search2, vm) => {
      axios
        .get(`/item/getItem2/item2/?name=${search2}&page=1`)
        .then((response) => {
          vm.items = response.data;
        });
    }, 500),
    search() {
      this.searchForUser(this.searchUser, this);
    },
    searchT() {
      this.searchForTrans(this.searchTrans, this);
    },
    searchA() {
      this.searchForUserA(this.searchUserA, this);
    },
    searchH() {
      this.searchForUserH(this.searchUserH, this);
    },
    searchS() {
      this.searchForUserS(this.searchUserS, this);
    },
    searchC() {
      this.searchForUserC(this.searchUserC, this);
    },
    searchForUser: _.debounce((search, vm) => {
      axios
        .get(`/user/getUser/users/?name=${search}&page=1`)
        .then((response) => {
          vm.user = response.data;
        });
    }, 500),
    searchForTrans: _.debounce((searchT, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction/?date=${btoa(
            vm.date
          )}&name=${searchT}&page=1`
        )
        .then((response) => {
          vm.transaction = response.data;
        });
    }, 500),
    searchForUserA: _.debounce((searchA, vm) => {
      axios
        .get(`/user/getAdmin/admin/?name=${searchA}&page=1`)
        .then((response) => {
          vm.userA = response.data;
        });
    }, 500),
    searchForUserH: _.debounce((searchH, vm) => {
      axios
        .get(`/user/getHepedeViaje/hepedeviaje/?name=${searchH}&page=1`)
        .then((response) => {
          vm.userH = response.data;
        });
    }, 500),
    searchForUserS: _.debounce((searchS, vm) => {
      axios
        .get(`/user/getSalesman/salesman/?name=${searchS}&page=1`)
        .then((response) => {
          vm.userS = response.data;
        });
    }, 500),
    searchForUserC: _.debounce((searchC, vm) => {
      axios
        .get(`/user/getCustomer/customer/?name=${searchC}&page=1`)
        .then((response) => {
          vm.userC = response.data;
        });
    }, 500),
    getMonth() {
      axios.get(`/user/get_month`).then((response) => {
        this.options = response.data;
      });
    },
    getYear() {
      axios.get(`/user/get_year`).then((response) => {
        this.options1 = response.data;
      });
    },
    setSelected(selected) {
      //  trigger a mutation, or dispatch an action
      if (selected === null || selected === "undefined" || selected === "") {
        this.getMonth();
      } else {
        const res = Object.keys(selected).map(function (key) {
          return [selected[key]];
        });

        this.id = res[0];
        this.name = res[1];
        this.image = res[2];

        this.getMonth();
      }
    },
    setSelected1(selected1) {
      //  trigger a mutation, or dispatch an action
      if (selected1 === null || selected1 === "undefined" || selected1 === "") {
        this.getYear();
      } else {
        const res = Object.keys(selected1).map(function (key) {
          return [selected1[key]];
        });

        this.id = res[0];
        this.name = res[1];
        this.image = res[2];

        this.getYear();
      }
    },
    getResults(page = 1) {
      let url = null;
      if (!this.searchUserA) {
        url = "/user/getUser/?page=";
      } else {
        url = `/user/getUser/users/?name=${this.searchUserA}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.user = response.data;

        setTimeout(() => {
          this.usersTable = $("#all_users").DataTable();
        }, 500);
      });
    },
    getResultsT(page = 1) {
      this.total_amt_tran = 0;
      let url = null;
      if (!this.searchTrans) {
        url = `/transaction/getTransaction/transaction/?date=${btoa(
          this.date
        )}&page=`;
      } else {
        url = `/transaction/getTransaction/transaction/?date=${btoa(
          this.date
        )}&name=${this.searchTrans}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.transaction = response.data;

        this.transaction.data.forEach((datas) => {
          // console.log(datas.downloaded)
          // this.downloaded = datas.downloaded

          this.total_amt_tran =
            this.total_amt_tran + parseFloat(datas["tot_amt"]);
        });
      });
    },
    getResultsA(page = 1) {
      let url = null;
      if (!this.searchUserA) {
        url = "/user/getAdmin/?page=";
      } else {
        url = `/user/getAdmin/admin/?name=${this.searchUserA}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.userA = response.data;

        setTimeout(() => {
          this.usersATable = $("#admin_users").DataTable();
        }, 500);
      });
    },
    getResultsH(page = 1) {
      let url = null;
      if (!this.searchUserH) {
        url = "/user/getHepedeViaje/?page=";
      } else {
        url = `/user/getHepedeViaje/hepedeviaje/?name=${this.searchUserH}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.userH = response.data;

        setTimeout(() => {
          this.usersHTable = $("#hepe_users").DataTable();
        }, 500);
      });
    },
    getResultsS(page = 1) {
      let url = null;
      if (!this.searchUserS) {
        url = "/user/getSalesman/?page=";
      } else {
        url = `/user/getSalesman/salesman/?name=${this.searchUserS}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.userS = response.data;

        setTimeout(() => {
          this.usersSTable = $("#salesman_users").DataTable();
        }, 500);
      });
    },
    getResultsC(page = 1) {
      let url = null;
      if (!this.searchUserC) {
        url = "/user/getCustomer/?page=";
      } else {
        url = `/user/getCustomer/customer/?name=${this.searchUserC}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.userC = response.data;

        // setTimeout(() => {
        //   this.usersCTable = $('#customer_users').DataTable()
        // }, 500)
      });
    },
    getResultsTS(page = 1) {
      let url = null;
      if (!this.searchUserS) {
        url = "/user/getSalesman/?page=";
      } else {
        url = `/user/getSalesman/salesman/?name=${this.searchUserS}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.userS = response.data;

        setTimeout(() => {
          this.usersSTable = $("#top_salesman_users").DataTable();
        }, 500);
      });
    },
    getResultsTC(page = 1) {
      let url = null;
      if (!this.searchUserS) {
        url = "/user/getSalesman/?page=";
      } else {
        url = `/user/getSalesman/salesman/?name=${this.searchUserS}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.userS = response.data;

        setTimeout(() => {
          this.usersSTable = $("#top_customer_users").DataTable();
        }, 500);
      });
    },
    getResultsTI(page = 1) {
      let url = null;
      if (!this.searchItem2) {
        url = "/item/getItem2/?page=";
      } else {
        url = `/item/getItem2/item2/?name=${this.searchItem2}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.items = response.data;
      });
    },
    details(MgaUsers) {
      $("#setupMdl").modal("show");
      $("#MdlTitle").html("Item Details");
      $("#submitformreupload").html("Set");

      const formatter = new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
      });

      this.form.item_masterfiles_id = MgaUsers.item_masterfiles_id;
      this.form.prdct_name = MgaUsers.product_name;
      this.form.prdct_shrt_name = MgaUsers.product_shrt_name;
      this.form.description = MgaUsers.description;
      this.form.company_code = MgaUsers.company_code;
      this.form.itemcode = MgaUsers.itemcode;
      this.form.barcode = MgaUsers.barcode;
      this.form.brand = MgaUsers.brand;
      this.form.principal = MgaUsers.principal;
      this.form.prdct_family = MgaUsers.product_family;
      this.form.keywords = MgaUsers.keywords;
      this.form.uom = MgaUsers.uom;
      this.form.price_wout_tax = formatter.format(MgaUsers.list_price_wouttax);
      this.form.price_wt_tax = formatter.format(MgaUsers.list_price_wtax);
      this.form.conversion_qty = MgaUsers.conversion_qty;
      this.form.conversion_uom = MgaUsers.conversion_uom;
      this.form.image = "storage/" + MgaUsers.image;
      this.form.noimage = "storage/items/no_image.jpg";

      if (MgaUsers.status === 1) {
        this.form.status = "Active";
      } else {
        this.form.status = "Inactive";
      }
    },
    closeModal() {
      document.getElementById("close").click();
      $("#setupMdl1").modal("hide");
      this.clearData();
    },
    clearData() {
      this.orderTable.clear().destroy();
      this.order = {
        image: "",
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      };

      this.form.tran_no = "";
      this.form.date_req = "";
      this.form.date_app = "";
      this.form.date_del = "";
      this.form.account_code = "";
      this.form.store_name = "";
      this.form.p_meth = "";
      this.form.itm_count = "";
      this.form.tot_amt = "";
      this.form.tran_stat = "";
      this.form.sm_name = "";
      this.form.sm_code = "";
      this.form1.tran_no2 = "";
      this.form1.itm_code = "";
      this.form1.item_desc = "";
      this.form1.req_qty = "";
      this.form1.uom = "";
      this.form1.amt = "";
      this.form1.tot_amt2 = "";
      this.form1.itm_cat = "";
      this.form1.itm_stat = "";
    },
    orderDetails(tran_no) {
      this.total_amt_line = 0;
      axios
        .get(`/transaction/getOrderTransaction/order_detail/?id=${tran_no}`)
        .then((response) => {
          this.order = response.data;

          this.order.data.forEach((datas) => {
            // console.log(datas.downloaded)
            // this.downloaded = datas.downloaded
            this.total_amt_line =
              this.total_amt_line + parseFloat(datas["tot_amt"]);
          });

          if (Object.keys(this.order).length) {
            setTimeout(() => {
              this.orderTable = $("#OrderTable").DataTable();
            }, 500);
          }

          $("#setupMdl1").modal("show");
          $("#MdlTitle1").html("Order");

          const formatter = new Intl.NumberFormat("en-PH", {
            style: "currency",
            currency: "PHP",
            minimumFractionDigits: 2,
          });
        });

      this.getResultsT();
    },

    detailsI(MgaItems) {
      $("#setupMdl").modal("show");
      $("#MdlTitle").html("Item Details");
      $("#submitformreupload").html("Set");

      const formatter = new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
      });

      this.form2.item_masterfiles_id = MgaItems.item_masterfiles_id;
      this.form2.prdct_name = MgaItems.product_name;
      this.form2.prdct_shrt_name = MgaItems.product_shrt_name;
      this.form2.description = MgaItems.description;
      this.form2.company_code = MgaItems.company_code;
      this.form2.itemcode = MgaItems.itemcode;
      this.form2.barcode = MgaItems.barcode;
      this.form2.brand = MgaItems.brand;
      this.form2.principal = MgaItems.principal;
      this.form2.prdct_family = MgaItems.product_family;
      this.form2.keywords = MgaItems.keywords;
      this.form2.uom = MgaItems.uom;
      this.form2.price_wout_tax = formatter.format(MgaItems.list_price_wouttax);
      this.form2.price_wt_tax = formatter.format(MgaItems.list_price_wtax);
      this.form2.conversion_qty = MgaItems.conversion_qty;
      this.form2.conversion_uom = MgaItems.conversion_uom;
      this.form2.image = "storage/" + MgaItems.image;
      this.form2.noimage = "storage/items/no_image.jpg";

      if (MgaItems.status === 1) {
        this.form2.status = "Active";
      } else {
        this.form2.status = "Inactive";
      }
    },

    detailsOrder(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then((response) => {
          this.order_details = response.data;

          $("#setupMdl2").modal("show");
          $("#MdlTitle2").html("Order Details");

          const formatter = new Intl.NumberFormat("en-PH", {
            style: "currency",
            currency: "PHP",
            minimumFractionDigits: 2,
          });

          this.order_details.forEach((order_d) => {
            this.form1.tran_no2 = order_d.tran_no;
            this.form1.itm_code = order_d.itm_code;
            this.form1.item_desc = order_d.item_desc;
            this.form1.req_qty = order_d.req_qty;
            this.form1.uom = order_d.uom;
            this.form1.amt = formatter.format(order_d.amt);
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt);
            this.form1.itm_cat = order_d.itm_cat;
            this.form1.itm_stat = order_d.itm_stat;
          });
        });

      this.getResultsT();
    },

    details(MgaTransaction) {
      $("#setupMdl").modal("show");
      $("#MdlTitle").html("Transaction Details");
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
      });

      this.form.tran_no = MgaTransaction.tran_no;
      this.form.date_req = MgaTransaction.date_req;
      this.form.date_app = MgaTransaction.date_app;
      this.form.date_del = MgaTransaction.date_del;
      this.form.account_code = MgaTransaction.account_code;
      this.form.store_name = MgaTransaction.store_name;
      this.form.p_meth = MgaTransaction.p_meth;
      this.form.itm_count = MgaTransaction.itm_count;
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt);
      this.form.tran_stat = MgaTransaction.tran_stat;
      this.form.sm_code = MgaTransaction.sm_code;
      this.form.sm_name =
        MgaTransaction.first_name + " " + MgaTransaction.last_name;

      this.getResultsT();
    },
  },
  mounted() {
    setTimeout(this.getResults(), 500);
    setTimeout(this.getResultsA(), 500);
    setTimeout(this.getResultsH(), 500);
    setTimeout(this.getResultsS(), 500);
    setTimeout(this.getResultsC(), 500);
    setTimeout(this.getResultsTS(), 500);
    setTimeout(this.getResultsTC(), 500);
    setTimeout(this.getResultsTI(), 500);
    this.$root.currentPage = this.$route.meta.name;
    console.log("Component Mounted");
  },
};
</script>
