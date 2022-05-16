<template>
  <div class="panel-body">
    <!-- actions -->
    <div class="row" style="padding-bottom:10px;">
      <div class="col-md-9">
        <a
          title="Append the highlighted items in the list into its respective transaction"
          href="javascript:void(0)"
          class="btn btn-success"
          @click="addItems()"
        >
          Append to Respective Transactions
        </a>
      </div>
      <div
        class="col-md-3"
        style="text-align:right;"
      >
        <input
          type="search"
          v-model="searchKey"
          class="form-control"
          placeholder="Search"
        />
      </div>
    </div>

    <!-- table -->
    <div class="row">
      <div class="col-md-12">
        <div
          style="background-color:#f2f2f2;padding:2px 6px;"
        >
          <a 
            href="javascript:void(0)" 
            class="btn btn-sm btn-secondary"
            @click="getResultsConsolidated()"
          >
            Refresh List
          </a>
        </div>
        <table
          id="consolidated_table"
          class="
            table
            table-hover
            table-bordered
            table-striped
            table-vcenter
          "
          width="100%"
        >
          <thead>
            <tr>
              <th>Transaction Type</th>
              <th>Sales Invoice</th>
              <th>Reference No.</th>
              <th>Customer Code</th>
              <th>Item Code</th>
              <th>UOM</th>
              <th>Qty</th>
              <th>Total Amt</th>
              <th>Posting Date</th>
              <th>Uploaded</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(MgaConsolidated, index) in manually_added_items.data"
              :key="index"
              :style="
                MgaConsolidated.tran_no != null
                && MgaConsolidated.present_on_masterfile == true
                && MgaConsolidated.present_on_masterfile_with_uom == false
                ? 'background-color:#f0ffed;' : ''
              "
            >
              <td>{{ MgaConsolidated.transaction_type }}</td>
              <td>{{ MgaConsolidated.sales_invoice }}</td>
              <td
                :style="MgaConsolidated.tran_no == null ? 'color:red;' : ''"
                :title="
                  MgaConsolidated.tran_no == null ? 'Unknown Transaction #' : ''
                "
              >
                {{ MgaConsolidated.reference_no }}
              </td>
              <td>{{ MgaConsolidated.customer_code }}</td>
              <td
                :style="
                  MgaConsolidated.present_on_masterfile == false
                    ? 'color:red;'
                    : ''
                "
                :title="
                  MgaConsolidated.present_on_masterfile == false
                    ? 'Missing in Masterfile'
                    : ''
                "
              >
                {{ MgaConsolidated.itemcode }}
              </td>
              <td
                :style="
                  MgaConsolidated.present_on_masterfile_with_uom == false
                    ? 'color:red;'
                    : ''
                "
              >
                {{ MgaConsolidated.uom }}
              </td>
              <td>{{ MgaConsolidated.qty }}</td>
              <td style="text-align: right">
                {{ parseFloat(MgaConsolidated.total_amt) | toCurrency }}
              </td>
              <td>{{ MgaConsolidated.posting_date }}</td>
              <td>{{ MgaConsolidated.date_uploaded }}</td>
              <td>
                <button
                  @click="viewItemDetails(MgaConsolidated)"
                  class="btn btn-info btn-xs"
                >
                  <i class="fa fa-list-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- pagination -->
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
          Showing {{ manually_added_items.from }} to
          {{ manually_added_items.to }} of
          {{ manually_added_items.total }} entries
        </div>
        <div class="col-md-6">
          <div class="text-right">
            <pagination
              style="margin: 0 0 20px 0"
              :limit="1"
              :show-disabled="true"
              :data="manually_added_items"
              @pagination-change-page="getResultsConsolidated"
            ></pagination>
          </div>
        </div>
      </div>
    </div>

    <!-- Modals -->
    <div
      class="modal fade"
      id="mdlItemDetails"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="true"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mdlItemDetailsTitle">Modal title</h5>
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
            action="reupload1"
            @submit.prevent="submitformreupload"
            method="post"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="transaction_type">Transaction Type</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.transaction_type"
                      id="transaction_type"
                      name="transaction_type"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="sales_invoice">Sales Invoice</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.sales_invoice"
                      id="sales_invoice"
                      name="sales_invoice"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="reference_no">Reference No.</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.reference_no"
                      id="reference_no"
                      name="reference_no"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="posting_date">Posting Date</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.posting_date"
                      id="posting_date"
                      name="posting_date"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="customer_name">Customer Name</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.customer_name"
                      id="customer_name"
                      name="customer_name"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="customer_code">Customer Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.customer_code"
                      id="customer_code"
                      name="customer_code"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="salesman_name">Salesman Name</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.salesman_name"
                      id="salesman_name"
                      name="salesman_name"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="salesman_code">Salesman Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.salesman_code"
                      id="salesman_code"
                      name="salesman_code"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="itemcode">Item Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.itemcode"
                      id="itemcode"
                      name="itemcode"
                    />
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="qty">Quantity</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.qty"
                      id="qty"
                      name="qty"
                    />
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="uom">UOM</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.uom"
                      id="uom"
                      name="uom"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price">Price</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.price"
                      id="price"
                      name="price"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_w_vat">Price with VAT</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.price_w_vat"
                      id="price_w_vat"
                      name="price_w_vat"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="tot_amt">Total Amount</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.tot_amt"
                      id="tot_amt"
                      name="tot_amt"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="status">Status</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="frmViewItemDetails.status"
                      id="status"
                      name="status"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                      placeholder="Description"
                      id="description"
                      name="description"
                      rows="8"
                      class="form-control"
                      v-model="frmViewItemDetails.description"
                    ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="filename">Image</label>
                    <!-- <input type="file" id="image" name="image" ref="image" /> -->
                    <input
                      type="hidden"
                      id="id"
                      name="id"
                      v-model="frmViewItemDetails.consolidated_id"
                    />
                  </div>
                  <section id="image">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-2">
                          <div
                            class="thumbnail"
                            v-if="frmViewItemDetails.image !== 'storage/'"
                          >
                            <img
                              v-bind:src="frmViewItemDetails.image"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6
                                v-if="frmViewItemDetails.image !== 'storage/'"
                              >
                                {{ frmViewItemDetails.prdct_name }}
                              </h6>
                            </div>
                          </div>
                          <div class="thumbnail" v-else>
                            <img
                              v-bind:src="frmViewItemDetails.noimage"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6></h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
              >
                Close
              </button>
              <!-- <button type="submit" class="btn btn-primary" id="submitformreupload"></button> -->
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Modals -->
  </div>
</template>
<style></style>
<script>
import { Form } from "vform";
import Swal from "sweetalert2";

export default {
  props: ["status"],

  data() {
    return {
      manually_added_items: {},

      // dateTo: DateTime.local().toString(),
      // dateFrom: DateTime.local().toString(),

      // kaloy 2021-09-29
      isLoadingTextVisible: 0,
      searchKey: "",

      frmViewItemDetails: new Form({
        consolidated_id: "",
        transaction_type: "",
        sales_invoice: "",
        reference_no: "",
        posting_date: "",
        customer_name: "",
        customer_code: "",
        salesman_name: "",
        salesman_code: "",
        itemcode: "",
        qty: "",
        uom: "",
        price: "",
        tot_amt: "",
        status: "",
        prdct_name: "",
        image: "",
      }),

      mankey: "",
    };
  },

  components: {},

  watch: {
    searchKey: _.debounce(function() {
      this.getResultsConsolidated();
    }, 250),
  },

  methods: {
    getResultsConsolidated(page = 1) {
      let url = `/consolidated/getConsolidated/?date=${btoa(
        this.date
      )}&searchKey=${this.searchKey}&is_manual=true&page=`;
      axios.get(url + page).then((response) => {
        this.manually_added_items = response.data;
      });
    },

    closeModal() {
      document.getElementById("close").click();
    },

    viewItemDetails(MgaConsolidated) {
      $("#mdlItemDetails").modal("show");
      $("#mdlItemDetailsTitle").html("Consolidated Item Details");
      // $("#submitformreupload").html("Set");

      const formatter = new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
      });

      this.frmViewItemDetails.consolidated_id = MgaConsolidated.consolidated_id;
      this.frmViewItemDetails.prdct_name = MgaConsolidated.product_name;
      this.frmViewItemDetails.transaction_type =
        MgaConsolidated.transaction_type;
      this.frmViewItemDetails.description = MgaConsolidated.description;
      this.frmViewItemDetails.sales_invoice = MgaConsolidated.sales_invoice;
      this.frmViewItemDetails.reference_no = MgaConsolidated.reference_no;
      this.frmViewItemDetails.posting_date = MgaConsolidated.posting_date;
      this.frmViewItemDetails.customer_name = MgaConsolidated.account_name;
      this.frmViewItemDetails.customer_code = MgaConsolidated.customer_code;
      let salesman_name =
        MgaConsolidated.first_name + " " + MgaConsolidated.last_name;
      this.frmViewItemDetails.salesman_name = salesman_name;
      this.frmViewItemDetails.salesman_code = MgaConsolidated.salesman_code;
      this.frmViewItemDetails.itemcode = MgaConsolidated.itemcode;
      this.frmViewItemDetails.qty = MgaConsolidated.qty;
      this.frmViewItemDetails.prdct_family = MgaConsolidated.product_family;
      this.frmViewItemDetails.keywords = MgaConsolidated.keywords;
      this.frmViewItemDetails.uom = MgaConsolidated.uom;
      this.frmViewItemDetails.price = formatter.format(
        MgaConsolidated.unit_price
      );
      this.frmViewItemDetails.price_w_vat = MgaConsolidated.price_w_vat;
      this.frmViewItemDetails.tot_amt = formatter.format(
        MgaConsolidated.total_amt
      );
      // this.frmViewItemDetails.image = "storage/" + MgaConsolidated.image;
      // this.frmViewItemDetails.noimage = "storage/items/no_image.jpg";
      this.frmViewItemDetails.image = MgaConsolidated.image;
      this.frmViewItemDetails.noimage = MgaConsolidated.image;
      this.frmViewItemDetails.status = MgaConsolidated.sstatus;
      if (MgaConsolidated.sstatus == 1) {
        this.frmViewItemDetails.status = "Active";
      } else if (MgaConsolidated.sstatus == 0) {
        this.frmViewItemDetails.status = "Inactive";
      }
    },

    addItems() {
      Swal.fire({
        title: "Please enter Manager's Key",
        input: "password",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Proceed",
        showLoaderOnConfirm: true,
        preConfirm: (mankey) => {
          return axios.post(`/consolidated/add-is-manual-items`,{
            manager_key: mankey
          }).then(result => {
            return result;
          }).catch(err => {
            Swal.showValidationMessage(`Request failed: ${err}`);
          });
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then((result) => {
        if (result.isConfirmed) {
          if(result.value.data.success == false) {
            Swal.fire(result.value.data.message,'','error');
          } else if (result.value.data.success == true) {
            this.getResultsConsolidated();
            Swal.fire(result.value.data.message,'','success');
          }
        }
      });
    },
  },

  // kaloy 2021-10-26
  created() {
    this.getResultsConsolidated();
  },

  mounted() {
    console.log("ManuallyAddedItems mounted");
  },
};
</script>
