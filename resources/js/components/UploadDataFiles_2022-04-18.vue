<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
            <i class="fa fa-upload"></i> Consolidate File
          </h3>
        </div>

        <div class="tab-base">
          <!--Nav Tabs-->
          <ul class="nav nav-tabs">
            <li class="active">
              <!-- <a data-toggle="tab" href="#demo-lft-tab-1">
                Item Masterfile (Navision)
               
              </a>
            </li> -->
            </li>

            <li class="active">
              <a data-toggle="tab" href="#demo-lft-tab-2">
                Consolidated File (Navision)
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
              </a>
            </li>
          </ul>

          <!--Tabs Content-->
          <div class="tab-content">
            <div id="demo-lft-tab-2" class="tab-pane fade active in">
              <div class="panel-body">
                <div class="row" style="margin: 0px 0px 10px 0px">
                  <div class="col-lg-12">
                    <!--Dropzonejs using Bootstrap theme-->
                    <!--===================================================-->
                    <p>
                      Only Consolidated Files / Item Consolidated Files will
                      upload in this form.
                      <span style="color: red"
                        >Note: ".csv" file format only.</span
                      >
                    </p>

                    <div class="bord-top pad-ver">
                      <form id="myForm1" @submit.prevent="submitFiles1">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <input
                                type="file"
                                id="input-file-import"
                                ref="text"
                                accept=".txt"
                                class="
                                  btn btn-primary
                                  fileinput-button
                                  dz-clickable
                                "
                                style="
                                  border: 1px solid #ccc;
                                  display: inline-block;
                                  padding: 6px 12px;
                                  cursor: pointer;
                                "
                                @change="test()"
                              />

                              <div class="btn-group pull-right">
                                <button
                                  :disabled="isSubmitting || !disabled"
                                  type="submit"
                                  id="submitform"
                                  class="btn btn-primary"
                                >
                                  <i class="fa fa-cloud-upload"></i> Upload
                                </button>
                                <button
                                  id="dz-remove-btn"
                                  class="btn btn-danger cancel"
                                  type="reset"
                                  @click="clearData()"
                                >
                                  <i class="demo-psi-trash"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div id="dz-previews">
                      <div v-if="error.message" class="invalid-feedback"></div>
                    </div>

                    <!--===================================================-->
                    <!--End Dropzonejs using Bootstrap theme-->
                  </div>
                </div>

                <!------------------------------------------------------------->

                <div class="table-responsive">
                  <div class="row">
                    <div class="col-md-6 table-toolbar-left">
                      <!-- <form
                        action="consolidate"
                        @submit.prevent="submitformorder"
                        method="post"
                        enctype="multipart/form-data"
                      >
                        <div class="col-lg-3">
                          <h5>Select a date :</h5>
                        </div>
                        <div class="col-lg-4">
                          <datetime
                            v-model="date"
                            value-zone="Asia/Manila"
                            zone="Asia/Manila"
                            input-class="form-control"
                          ></datetime>
                        </div>
                      </form> -->
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3 table-toolbar-right">
                      <input type="search" v-model="searchKey"
                        class="form-control"
                        placeholder="Search"
                      >
                    </div>
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
                        <th>Qty</th>
                        <th>Total Amt</th>
                        <th>Posting Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(MgaConsolidated, index) in consolidated.data"
                        :key="index"
                        :style="MgaConsolidated.tran_no == null ? 'color:red;' : ''"
                      >
                        <td>{{ MgaConsolidated.transaction_type }}</td>
                        <td>{{ MgaConsolidated.sales_invoice }}</td>
                        <td>{{ MgaConsolidated.reference_no }}</td>
                        <td>{{ MgaConsolidated.qty }}</td>
                        <td style="text-align: right">
                          {{
                            parseFloat(MgaConsolidated.total_amt) | toCurrency
                          }}
                        </td>
                        <td>{{ MgaConsolidated.posting_date }}</td>
                        <td>
                          <button
                            @click="details1(MgaConsolidated)"
                            class="btn btn-info btn-xs"
                          >
                            <i class="fa fa-list-alt"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        Showing {{ consolidated.from }} to
                        {{ consolidated.to }} of {{ consolidated.total }} entries
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <pagination
                            style="margin: 0 0 20px 0"
                            :limit="1"
                            :show-disabled="true"
                            :data="consolidated"
                            @pagination-change-page="getResultsConsolidated"
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

    <!-------------------------Modal Form1--------------------------------->

    <div
      class="modal fade"
      id="setupMdl1"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
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
            action="reupload"
            @submit.prevent="submitformreupload1"
            method="post"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prdct_name">Product Name</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.prdct_name"
                      id="prdct_name"
                      name="prdct_name"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prdct_shrt_name">Product Short Name</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.prdct_shrt_name"
                      id="prdct_shrt_name"
                      name="prdct_shrt_name"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="company_code">Company Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.company_code"
                      id="company_code"
                      name="company_code"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="barcode">Barcode</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.barcode"
                      id="barcode"
                      name="barcode"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="brand">Brand</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.brand"
                      id="brand"
                      name="brand"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="itemcode">Item Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.itemcode"
                      id="itemcode"
                      name="itemcode"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="principal">Principal</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.principal"
                      id="principal"
                      name="principal"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdct_family">Product Family</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.prdct_family"
                      id="prdct_family"
                      name="prdct_family"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="uom">UOM</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.uom"
                      id="uom"
                      name="uom"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_wout_tax">Price without Tax</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.price_wout_tax"
                      id="price_wout_tax"
                      name="price_wout_tax"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_wt_tax">Price with Tax</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.price_wt_tax"
                      id="price_wt_tax"
                      name="price_wt_tax"
                      style="text-align: right"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="conversion_qty">Conversion Qty</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.conversion_qty"
                      id="conversion_qty"
                      name="conversion_qty"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="conversion_uom">Conversion UOM</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.conversion_uom"
                      id="conversion_uom"
                      name="conversion_uom"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="keywords">Keywords</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.keywords"
                      id="keywords"
                      name="keywords"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.status"
                      id="status"
                      name="status"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="change_price">Change Price</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form1.change_price"
                      id="stachange_priceus"
                      name="change_price"
                      style="color: #ff5722"
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
                      v-model="form1.description"
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
                      v-model="form1.item_masterfiles_id"
                    />
                  </div>
                  <section id="image">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-2">
                          <div
                            class="thumbnail"
                            v-if="form1.image !== 'storage/'"
                          >
                            <img
                              v-bind:src="`/${form1.image}`"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6 v-if="form1.image !== 'storage/'">
                                {{ form1.prdct_name }}
                              </h6>
                            </div>
                          </div>
                          <div class="thumbnail" v-else>
                            <img
                              v-bind:src="form1.noimage"
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
                class="btn btn-secondary"
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

    <!-------------------------Modal Form Loading--------------------------------->

    <div
      class="modal fade bd-example-modal-lg"
      id="loadMdl"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      style="background-color: transparent; border: none"
    >
      <div class="modal-dialog modal">
        <div class="modal-body">
          <div class="load6">
            <div class="loader" style="font-size: 60px"></div>
            <h3 style="text-align: center; padding-top: 35px; color: #427cc0">
              Please wait...
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="exampleModal"
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
              <i class="fa fa-exclamation-circle"></i> Error Message
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div
              class="alert alert-danger"
              v-for="(error, errorIndex) in excelErrors"
              :key="errorIndex"
              style="margin-bottom: 10px"
            >
              <strong>{{ error[0] }}</strong>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">
              <i class="fa fa-close"></i> Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-------------------------Modal Form--------------------------------->

    <div
      class="modal fade"
      id="setupMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle">Modal title</h5>
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prdct_name">Product Name</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.prdct_name"
                      id="prdct_name"
                      name="prdct_name"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prdct_shrt_name">Product Short Name</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.prdct_shrt_name"
                      id="prdct_shrt_name"
                      name="prdct_shrt_name"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="company_code">Company Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.company_code"
                      id="company_code"
                      name="company_code"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="barcode">Barcode</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.barcode"
                      id="barcode"
                      name="barcode"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="brand">Brand</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.brand"
                      id="brand"
                      name="brand"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="itemcode">Item Code</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.itemcode"
                      id="itemcode"
                      name="itemcode"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="principal">Principal</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.principal"
                      id="principal"
                      name="principal"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdct_family">Product Family</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.prdct_family"
                      id="prdct_family"
                      name="prdct_family"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="uom">UOM</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.uom"
                      id="uom"
                      name="uom"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_wout_tax">Price without Tax</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.price_wout_tax"
                      id="price_wout_tax"
                      name="price_wout_tax"
                      style="text-align: right"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="price_wt_tax">Price with Tax</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.price_wt_tax"
                      id="price_wt_tax"
                      name="price_wt_tax"
                      style="text-align: right"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="conversion_qty">Conversion Qty</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.conversion_qty"
                      id="conversion_qty"
                      name="conversion_qty"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="conversion_uom">Conversion UOM</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.conversion_uom"
                      id="conversion_uom"
                      name="conversion_uom"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="keywords">Keywords</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.keywords"
                      id="keywords"
                      name="keywords"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.status"
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
                      v-model="form.description"
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
                      v-model="form.item_masterfiles_id"
                    />
                  </div>
                  <section id="image">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-2">
                          <div
                            class="thumbnail"
                            v-if="form.image !== 'storage/'"
                          >
                            <img
                              v-bind:src="form.image"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6 v-if="form.image !== 'storage/'">
                                {{ form.prdct_name }}
                              </h6>
                            </div>
                          </div>
                          <div class="thumbnail" v-else>
                            <img
                              v-bind:src="form.noimage"
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
                class="btn btn-secondary"
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

    <!-------------------------Modal Form 2--------------------------------->

    <div
      class="modal fade"
      id="setupMdl2"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle2">Modal title</h5>
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
                      v-model="form2.transaction_type"
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
                      v-model="form2.sales_invoice"
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
                      v-model="form2.reference_no"
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
                      v-model="form2.posting_date"
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
                      v-model="form2.customer_name"
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
                      v-model="form2.customer_code"
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
                      v-model="form2.salesman_name"
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
                      v-model="form2.salesman_code"
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
                      v-model="form2.itemcode"
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
                      v-model="form2.qty"
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
                      v-model="form2.uom"
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
                      v-model="form2.price"
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
                      v-model="form2.price_w_vat"
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
                      v-model="form2.tot_amt"
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
                      v-model="form2.status"
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
                      v-model="form2.description"
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
                      v-model="form2.consolidated_id"
                    />
                  </div>
                  <section id="image">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-2">
                          <div
                            class="thumbnail"
                            v-if="form2.image !== 'storage/'"
                          >
                            <img
                              v-bind:src="form2.image"
                              style="width: 150px; height: 120px"
                              alt
                            />
                            <div class="caption">
                              <h6 v-if="form2.image !== 'storage/'">
                                {{ form2.prdct_name }}
                              </h6>
                            </div>
                          </div>
                          <div class="thumbnail" v-else>
                            <img
                              v-bind:src="form2.noimage"
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
                class="btn btn-secondary"
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
      consolidatedTable: {},
      consolidated: {},
      items_log: {
        image: "",
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      items_log_data: [],
      editCustomerDetails: null,
      form1: new Form({
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
      form: new Form({
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
      form2: new Form({
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
      isActive: 1,
      searchItem2: null,
      searchItemLog: null,
      date: DateTime.local().toString(),
      disabled: 0,
      isSubmitting: false,
      import_file: "",
      import_file1: "",
      error: {},
      excelErrors: [],
      searchItems: null,
      searchConsolidated: null,
      searchItemsFlowrack: null,
      searchItemsBCOM: null,
      category: null,
      searchKey: '',
    };
  },
  components: {
    datetime: Datetime,
  },
  watch: {
    date() {
      this.getResultsConsolidated();
    },

    searchKey: _.debounce(function() {
      this.getResultsConsolidated();
    },250),
  },
  methods: {
    searchC() {
      this.searchForConsolidated(this.searchConsolidated, this);
    },
    search2() {
      this.searchForItem2(this.searchItem2, this);
    },
    searchLog() {
      this.searchForItemLog(this.searchItemLog, this);
    },
    searchForConsolidated: _.debounce((searchC, vm) => {
      axios
        .get(
          `/consolidated/getConsolidated/consolidated/?date=${btoa(
            vm.date
          )}&name=${searchC}&page=1`
        )
        .then((response) => {
          vm.consolidated = response.data;
        });
    }, 500),
    searchForItem2: _.debounce((search2, vm) => {
      axios
        .get(`/item/getItem2/item2/?name=${search2}&page=1`)
        .then((response) => {
          vm.items = response.data;
        });
    }, 500),
    searchForItemLog: _.debounce((searchLog, vm) => {
      axios
        .get(`/item/getItemLog/item_log/?name=${searchLog}&page=1`)
        .then((response) => {
          vm.items_log = response.data;
        });
    }, 500),

    getResultsConsolidated(page = 1) {
      let url = `/consolidated/getConsolidated/?date=${btoa(this.date)}&searchKey=${this.searchKey}&page=`;
      axios.get(url + page)
        .then((response) => {
          this.consolidated = response.data;
        });
    },

    getResults(page = 1) {
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
    getLogResults(page = 1) {
      let url = null;
      if (!this.searchItemLog) {
        url = "/item/getItemLog/?page=";
      } else {
        url = `/item/getItemLog/item_log/?name=${this.searchItemLog}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.items_log = response.data;
      });
    },
    clearData() {
      document.getElementById("myForm").reset();
      document.getElementById("myForm1").reset();
      // document.getElementById('myForm1').reset()
      this.disabled = 0;
      // this.category = null
    },
    test() {
      this.disabled = 1;
      // this.category = num
    },
    submitFiles() {
      this.isSubmitting = true;
      let formData = new FormData();
      formData.append("import_file", this.$refs.excel.files[0]);
      $("#loadMdl").modal("show");
      axios
        .post("/import_masterfile", formData, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(({ status, data }) => {
          this.isSubmitting = false;
          if (status === 200) {
            // codes here after the file is upload successfully
            // alert(data.message)
            $("#loadMdl").modal("hide");
            $("#container").css("position", "sticky");
            Swal.fire("Success!", data.message, "success").then((result) => {
              if (result.value) {
                setTimeout(() => {
                  $("#container").css("position", "relative");
                  $("#show").hide();
                  this.getResults();
                  this.clearData();
                  this.disabled = 0;
                  this.category = 1;
                  this.$router.go(0);
                }, 50);
              }
            });
          }
        })
        .catch(({ response }) => {
          $("#loadMdl").modal("hide");
          $(".pace-done").css("padding-right", "0px");
          this.isSubmitting = false;
          // code here when an upload is not valid
          const { status, data } = response;
          if (status === 422) {
            const { errors } = data;
            // alert(errors.import_file[0])
            this.excelErrors = errors;
            if (!data.errors.import_file) {
              //   $('#show').show()
            }
            $("#exampleModal").modal("show");
          }
          this.uploading = false;
          this.error = error.response.data;
          console.log("check error: ", this.error);
        });
    },
    submitFiles1() {
      this.isSubmitting = true;
      let formData = new FormData();
      formData.append("import_file1", this.$refs.text.files[0]);
      $("#loadMdl1").modal("show");
      axios
        .post("/import_consolidated_masterfile", formData, {
          headers: { "content-type": "text/plain" },
        })
        .then(({ status, data }) => {
          this.isSubmitting = false;
          if (status === 200) {
            // codes here after the file is upload successfully
            // alert(data.message)
            $("#loadMdl").modal("hide");
            $("#container").css("position", "sticky");
            Swal.fire("Success!", data.message, "success").then((result) => {
              if (result.value) {
                setTimeout(() => {
                  $("#container").css("position", "relative");
                  $("#show").hide();
                  this.getResultsConsolidated();
                  this.clearData();
                  this.disabled = 0;
                  this.category = 1;
                  // this.$router.go(0)
                }, 50);
              }
            });
          }
        })
        .catch(({ response }) => {
          $("#loadMdl").modal("hide");
          $(".pace-done").css("padding-right", "0px");
          this.isSubmitting = false;
          // code here when an upload is not valid
          const { status, data } = response;
          if (status === 422) {
            const { errors } = data;
            // alert(errors.import_file[0])
            this.excelErrors = errors;
            if (!data.errors.import_file) {
              //   $('#show').show()
            }
            $("#exampleModal").modal("show");
          }
          this.uploading = false;
          this.error = error.response.data;
          console.log("check error: ", this.error);
        });
    },
    details1(MgaConsolidated) {
      $("#setupMdl2").modal("show");
      $("#MdlTitle2").html("Consolidated Item Details");
      $("#submitformreupload").html("Set");

      const formatter = new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
      });

      this.form2.consolidated_id = MgaConsolidated.consolidated_id;
      this.form2.prdct_name = MgaConsolidated.product_name;
      this.form2.transaction_type = MgaConsolidated.transaction_type;
      this.form2.description = MgaConsolidated.description;
      this.form2.sales_invoice = MgaConsolidated.sales_invoice;
      this.form2.reference_no = MgaConsolidated.reference_no;
      this.form2.posting_date = MgaConsolidated.posting_date;
      this.form2.customer_name = MgaConsolidated.account_name;
      this.form2.customer_code = MgaConsolidated.customer_code;
      let salesman_name =
        MgaConsolidated.first_name + " " + MgaConsolidated.last_name;
      this.form2.salesman_name = salesman_name;
      this.form2.salesman_code = MgaConsolidated.salesman_code;
      this.form2.itemcode = MgaConsolidated.itemcode;
      this.form2.qty = MgaConsolidated.qty;
      this.form2.prdct_family = MgaConsolidated.product_family;
      this.form2.keywords = MgaConsolidated.keywords;
      this.form2.uom = MgaConsolidated.uom;
      this.form2.price = formatter.format(MgaConsolidated.unit_price);
      this.form2.price_w_vat = MgaConsolidated.price_w_vat;
      this.form2.tot_amt = formatter.format(MgaConsolidated.total_amt);
      this.form2.image = "storage/" + MgaConsolidated.image;
      this.form2.noimage = "storage/items/no_image.jpg";

      if (MgaConsolidated.sstatus === 1) {
        this.form2.status = "Active";
      } else {
        this.form2.status = "Inactive";
      }
    },
    details(MgaItems) {
      $("#setupMdl").modal("show");
      $("#MdlTitle").html("Item Details");
      $("#submitformreupload").html("Set");

      const formatter = new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
      });

      this.form.item_masterfiles_id = MgaItems.item_masterfiles_id;
      this.form.prdct_name = MgaItems.product_name;
      this.form.prdct_shrt_name = MgaItems.product_shrt_name;
      this.form.description = MgaItems.description;
      this.form.company_code = MgaItems.company_code;
      this.form.itemcode = MgaItems.itemcode;
      this.form.barcode = MgaItems.barcode;
      this.form.brand = MgaItems.brand;
      this.form.principal = MgaItems.principal;
      this.form.prdct_family = MgaItems.product_family;
      this.form.keywords = MgaItems.keywords;
      this.form.uom = MgaItems.uom;
      this.form.price_wout_tax = formatter.format(MgaItems.list_price_wouttax);
      this.form.price_wt_tax = formatter.format(MgaItems.list_price_wtax);
      this.form.conversion_qty = MgaItems.conversion_qty;
      this.form.conversion_uom = MgaItems.conversion_uom;
      this.form.image = "storage/" + MgaItems.image;
      this.form.noimage = "storage/items/no_image.jpg";

      if (MgaItems.status === 1) {
        this.form.status = "Active";
      } else {
        this.form.status = "Inactive";
      }
    },
    detailsLog(id) {
      axios
        .get(`/item/getItemDetailsLog/itemlogdetail/?id=${id}`)
        .then((response) => {
          this.items_log_data = response.data;

          $("#setupMdl1").modal("show");
          $("#MdlTitle1").html("Item Details");
          $("#submitformreupload1").html("Set");

          const formatter = new Intl.NumberFormat("en-PH", {
            style: "currency",
            currency: "PHP",
            minimumFractionDigits: 2,
          });

          this.items_log_data.forEach((item) => {
            this.form1.item_masterfiles_id = item.item_masterfiles_id;
            this.form1.prdct_name = item.product_name;
            this.form1.prdct_shrt_name = item.product_shrt_name;
            this.form1.description = item.description;
            this.form1.company_code = item.company_code;
            this.form1.itemcode = item.itemcode;
            this.form1.barcode = item.barcode;
            this.form1.brand = item.brand;
            this.form1.principal = item.principal;
            this.form1.prdct_family = item.product_family;
            this.form1.keywords = item.keywords;
            this.form1.uom = item.uom;
            this.form1.price_wout_tax = formatter.format(
              item.list_price_wouttax
            );
            this.form1.price_wt_tax = formatter.format(item.price1);
            this.form1.conversion_qty = item.conversion_qty;
            this.form1.conversion_uom = item.conversion_uom;
            this.form1.image = "storage/" + item.image;
            this.form1.noimage = "storage/items/no_image.jpg";
            this.form1.change_price = formatter.format(item.price2);
            if (item.status === 1) {
              this.form1.status = "Active";
            } else {
              this.form1.status = "Inactive";
            }
          });
        });
    },
    closeModal() {
      document.getElementById("close").click();
    },
    submitformreupload() {
      this.form.image = this.$refs.image.files[0];

      this.form
        .submit("post", "/item/saved_item_image", {
          // Transform form data to FormData
          transformRequest: [
            function (data, headers) {
              return serialize(data);
            },
          ],

          onUploadProgress: (e) => {
            // Do whatever you want with the progress event
            // console.log(e)
          },
        })
        .then(({ data }) => {
          console.log(data);
          if (data.trim() == "Success") {
            $.niftyNoty({
              type: "info",
              icon: "pli-cross icon-2x",
              message: '<i class="fa fa-check"></i> Items has been updated.',
              container: "floating",
              timer: 5000,
            });
          } else {
            if (data.trim() == "Error") {
              $.niftyNoty({
                type: "danger",
                icon: "pli-cross icon-2x",
                message: "<i class='fa fa-exclamation-circle'></i> Error.",
                container: "floating",
                timer: 5000,
              });
            }
          }
        })
        .catch((error) => {});

      this.getResults();
      $("#setupMdl").modal("hide");
    },

    btn_activation(id, status) {
      axios
        .get(`/item/activate_item/?id=${id}&status=${status}`)
        .then(({ data }) => {
          if (data.trim() == "Success") {
            if (status == "1") {
              $.niftyNoty({
                type: "info",
                icon: "pli-cross icon-2x",
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: "floating",
                timer: 5000,
              });
            } else {
              $.niftyNoty({
                type: "info",
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

  created() {
    this.getResultsConsolidated();
  },

  mounted() {
    console.log("UploadDataFiles Component mounted.");
    this.getResults();
    this.getLogResults();
    $("#container").css("position", "relative");
    this.$root.currentPage = this.$route.meta.name;
  },
};
</script>
