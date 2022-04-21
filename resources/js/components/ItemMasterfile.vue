<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
          <i class="fa fa-list-alt"></i> Product Items
        </h3>
      </div>
      <div class="tab-base">
        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
          <li class="active">
            <a data-toggle="tab" href="#demo-lft-tab-1">
              Have Images
              <span class="badge badge-warning">{{ items.total }}</span>
            </a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-2">
              No Images
              <span class="badge badge-success">{{ items1.total }}</span>
            </a>
          </li>
        </ul>

        <!--Tabs Content-->
        <div class="tab-content">
          <div id="demo-lft-tab-1" class="tab-pane fade active in">
            <div class="panel-body">
              <div class="row" style="margin: 0px 0px 10px 0px">
                <div class="col-lg-12">
                  <!-- <button class="btn btn-success btn-rounded pull-right">
            <i class="fa fa-plus-circle"></i> Salesman
                  </button>-->
                </div>
              </div>

              <!------------------------------------------------------------->

              <div class="table-responsive">
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
                            @keyup="search"
                            v-model="searchItem"
                            placeholder="Search"
                          />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <table
                  class="table table-hover table-bordered table-striped table-vcenter"
                  width="100%"
                >
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Item Code</th>
                      <th>UOM</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="!items.data.length">
                      <td colspan="6" class="text-center">No data available</td>
                    </tr>
                    <tr
                      v-for="MgaItems in items.data"
                      :key="MgaItems.item_masterfiles_id"
                    >
                      <td>{{ MgaItems.product_name }}</td>
                      <td>{{ MgaItems.brand }}</td>
                      <td>{{ MgaItems.itemcode }}</td>
                      <td>{{ MgaItems.uom }}</td>
                      <td style="text-align: right;">
                        {{ parseFloat(MgaItems.list_price_wtax) | toCurrency }}
                      </td>
                      <td>
                        <div
                          class="btn-group dropdown"
                          v-if="MgaItems.status === 1"
                        >
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
                                style="color: blue;"
                                @click="
                                  btn_activation(
                                    MgaItems.item_masterfiles_id,
                                    '1'
                                  )
                                "
                                >Active</a
                              >
                            </li>
                            <li>
                              <a
                                href="#"
                                style="color: red;"
                                @click="
                                  btn_activation(
                                    MgaItems.item_masterfiles_id,
                                    '0'
                                  )
                                "
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
                                style="color: blue;"
                                @click="
                                  btn_activation(
                                    MgaItems.item_masterfiles_id,
                                    '1'
                                  )
                                "
                                >Active</a
                              >
                            </li>
                            <li>
                              <a
                                href="#"
                                style="color: red;"
                                @click="
                                  btn_activation(
                                    MgaItems.item_masterfiles_id,
                                    '0'
                                  )
                                "
                                >Inactive</a
                              >
                            </li>
                          </ul>
                        </div>
                        <button
                          @click="details(MgaItems)"
                          class="btn btn-info btn-xs"
                        >
                          <i class="fa fa-list-alt"></i>
                        </button>
                        &nbsp;
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      Showing {{ items.from }} to {{ items.to }} of
                      {{ items.total }} entries
                    </div>
                    <div class="col-md-6">
                      <div class="text-right">
                        <pagination
                          style="margin: 0 0 20px 0;"
                          :limit="1"
                          :show-disabled="true"
                          :data="items"
                          @pagination-change-page="getResults"
                        ></pagination>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="demo-lft-tab-2" class="tab-pane fade">
            <div class="panel-body">
              <div class="row" style="margin: 0px 0px 10px 0px">
                <div class="col-lg-12"></div>
              </div>

              <!------------------------------------------------------------->

              <div class="table-responsive">
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
                            @keyup="search1"
                            v-model="searchItem1"
                            placeholder="Search"
                          />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <table
                  class="table table-hover table-bordered table-striped table-vcenter"
                  width="100%"
                >
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Item Code</th>
                      <th>UOM</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="!items1.data.length">
                      <td colspan="6" class="text-center">No data available</td>
                    </tr>
                    <tr
                      v-for="MgaItems1 in items1.data"
                      :key="MgaItems1.item_masterfiles_id"
                    >
                      <td>{{ MgaItems1.product_name }}</td>
                      <td>{{ MgaItems1.brand }}</td>
                      <td>{{ MgaItems1.itemcode }}</td>
                      <td>{{ MgaItems1.uom }}</td>
                      <td>
                        {{ parseFloat(MgaItems1.list_price_wtax) | toCurrency }}
                      </td>
                      <td>
                        <div
                          class="btn-group dropdown"
                          v-if="MgaItems1.status === 1"
                        >
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
                                style="color: blue;"
                                @click="
                                  btn_activation1(
                                    MgaItems1.item_masterfiles_id,
                                    '1'
                                  )
                                "
                                >Active</a
                              >
                            </li>
                            <li>
                              <a
                                href="#"
                                style="color: red;"
                                @click="
                                  btn_activation1(
                                    MgaItems1.item_masterfiles_id,
                                    '0'
                                  )
                                "
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
                                style="color: blue;"
                                @click="
                                  btn_activation1(
                                    MgaItems1.item_masterfiles_id,
                                    '1'
                                  )
                                "
                                >Active</a
                              >
                            </li>
                            <li>
                              <a
                                href="#"
                                style="color: red;"
                                @click="
                                  btn_activation1(
                                    MgaItems1.item_masterfiles_id,
                                    '0'
                                  )
                                "
                                >Inactive</a
                              >
                            </li>
                          </ul>
                        </div>
                        <button
                          @click="details1(MgaItems1)"
                          class="btn btn-info btn-xs"
                        >
                          <i class="fa fa-list-alt"></i>
                        </button>
                        &nbsp;
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      Showing {{ items1.from }} to {{ items1.to }} of
                      {{ items1.total }} entries
                    </div>
                    <div class="col-md-6">
                      <div class="text-right">
                        <pagination
                          style="margin: 0 0 20px 0;"
                          :limit="1"
                          :show-disabled="true"
                          :data="items1"
                          @pagination-change-page="getResults1"
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
              action="reupload"
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
                    <!-- <div class="form-group">
                      <label for="filename">Image</label>
                      <input
                        type="file"
                        id="image"
                        name="image[]"
                        ref="image"
                        multiple
                      />
                      <input
                        type="hidden"
                        id="id"
                        name="id"
                        v-model="form.item_masterfiles_id"
                      />
                    </div> -->
                    <section id="image">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-4">
                            <div
                              class="thumbnail"
                              v-if="form.image !== 'storage/'"
                            >
                              <img
                                v-bind:src="form.image"
                                class="img-rounded image-details"
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
                                class="img-rounded image-details"
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
                <!-- <button
                  type="submit"
                  class="btn btn-primary"
                  id="submitformreupload"
                ></button> -->
              </div>
            </form>
          </div>
        </div>
      </div>

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
                    <!-- <div class="form-group">
                      <label for="filename">Image</label>
                      <input
                        type="file"
                        id="images"
                        name="images[]"
                        ref="images"
                        multiple
                      />
                      <input
                        type="hidden"
                        id="id"
                        name="id"
                        v-model="form1.item_masterfiles_id"
                      />
                    </div> -->
                    <section id="image">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-4">
                            <div
                              class="thumbnail"
                              v-if="form1.image !== 'storage/'"
                            >
                              <img
                                v-bind:src="form1.noimage"
                                class="img-rounded image-details"
                                alt
                              />
                              <div class="caption">
                                <h6>No Image Item</h6>
                              </div>
                            </div>
                            <div class="thumbnail" v-else>
                              <img
                                v-bind:src="form1.image"
                                class="img-rounded image-details"
                                alt
                              />
                              <div class="caption">
                                <h6 v-if="form1.image !== 'storage/'">
                                  {{ form1.prdct_name }}
                                </h6>
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
                <!-- <button
                  type="submit"
                  class="btn btn-primary"
                  id="submitformreupload1"
                ></button> -->
              </div>
            </form>
          </div>
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
import Swal from 'sweetalert2'
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
import { serialize } from 'object-to-formdata'

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
  data() {
    return {
      items: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      items1: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      editCustomerDetails: null,
      form: new Form({
        item_masterfiles_id: '',
        prdct_name: '',
        prdct_shrt_name: '',
        description: '',
        company_code: '',
        itemcode: '',
        barcode: '',
        brand: '',
        principal: '',
        prdct_family: '',
        keywords: '',
        uom: '',
        price_wout_tax: '',
        price_wt_tax: '',
        conversion_qty: '',
        conversion_uom: '',
        item_masterfiles_id: '',
        status: '',
        image: ''
      }),
      form1: new Form({
        item_masterfiles_id: '',
        prdct_name: '',
        prdct_shrt_name: '',
        description: '',
        company_code: '',
        itemcode: '',
        barcode: '',
        brand: '',
        principal: '',
        prdct_family: '',
        keywords: '',
        uom: '',
        price_wout_tax: '',
        price_wt_tax: '',
        conversion_qty: '',
        conversion_uom: '',
        item_masterfiles_id: '',
        status: '',
        image: ''
      }),
      with_image: 0,
      without_image: 0,
      isActive: 1,
      searchItem: null,
      searchItem1: null
    }
  },
  methods: {
    search() {
      this.searchForItem(this.searchItem, this)
    },
    search1() {
      this.searchForItem1(this.searchItem1, this)
    },
    searchForItem: _.debounce((search, vm) => {
      axios.get(`/item/getItem/item/?name=${search}&page=1`).then(response => {
        vm.items = response.data
      })
    }, 500),
    searchForItem1: _.debounce((search1, vm) => {
      axios
        .get(`/item/getItem1/item1/?name=${search1}&page=1`)
        .then(response => {
          vm.items1 = response.data
        })
    }, 500),
    getResults(page = 1) {
      let url = null
      if (!this.searchItem) {
        url = '/item/getItem/?page='
      } else {
        url = `/item/getItem/item/?name=${this.searchItem}&page=`
      }
      axios.get(url + page).then(response => {
        this.items = response.data
      })
    },
    getResults1(page = 1) {
      let url = null
      if (!this.searchItem1) {
        url = '/item/getItem1/?page='
      } else {
        url = `/item/getItem1/item1/?name=${this.searchItem1}&page=`
      }
      axios.get(url + page).then(response => {
        this.items1 = response.data
      })
    },
    details(MgaItems) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Item Details')
      $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.item_masterfiles_id = MgaItems.item_masterfiles_id
      this.form.prdct_name = MgaItems.product_name
      this.form.prdct_shrt_name = MgaItems.product_shrt_name
      this.form.description = MgaItems.description
      this.form.company_code = MgaItems.company_code
      this.form.itemcode = MgaItems.itemcode
      this.form.barcode = MgaItems.barcode
      this.form.brand = MgaItems.brand
      this.form.principal = MgaItems.principal
      this.form.prdct_family = MgaItems.product_family
      this.form.keywords = MgaItems.keywords
      this.form.uom = MgaItems.uom
      this.form.price_wout_tax = formatter.format(MgaItems.list_price_wouttax)
      this.form.price_wt_tax = formatter.format(MgaItems.list_price_wtax)
      this.form.conversion_qty = MgaItems.conversion_qty
      this.form.conversion_uom = MgaItems.conversion_uom
      this.form.image = 'storage/' + MgaItems.image
      this.form.noimage = 'storage/items/no_image.jpg'

      if (MgaItems.status === 1) {
        this.form.status = 'Active'
      } else {
        this.form.status = 'Inactive'
      }
    },
    details1(MgaItems1) {
      $('#setupMdl1').modal('show')
      $('#MdlTitle1').html('Item Details')
      $('#submitformreupload1').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form1.item_masterfiles_id = MgaItems1.item_masterfiles_id
      this.form1.prdct_name = MgaItems1.product_name
      this.form1.prdct_shrt_name = MgaItems1.product_shrt_name
      this.form1.description = MgaItems1.description
      this.form1.company_code = MgaItems1.company_code
      this.form1.itemcode = MgaItems1.itemcode
      this.form1.barcode = MgaItems1.barcode
      this.form1.brand = MgaItems1.brand
      this.form1.principal = MgaItems1.principal
      this.form1.prdct_family = MgaItems1.product_family
      this.form1.keywords = MgaItems1.keywords
      this.form1.uom = MgaItems1.uom
      this.form1.price_wout_tax = formatter.format(MgaItems1.list_price_wouttax)
      this.form1.price_wt_tax = formatter.format(MgaItems1.list_price_wtax)
      this.form1.conversion_qty = MgaItems1.conversion_qty
      this.form1.conversion_uom = MgaItems1.conversion_uom

      if ((this.form1.image = 'items/no_image_item.jpg')) {
        this.form1.noimage = 'storage/items/no_image_item.jpg'
      } else {
        this.form1.image = 'storage/' + MgaItems1.image
      }

      if (MgaItems1.status === 1) {
        this.form1.status = 'Active'
      } else {
        this.form1.status = 'Inactive'
      }
    },
    closeModal() {
      document.getElementById('close').click()
    },
    submitformreupload() {
      // Count total files
      $countfiles = count($_FILES['image']['name'])

      // Looping all files
      for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['image']['name'][$i]

        // Upload file
        //move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/'.$filename);

        this.form.image = this.$refs.image.files[$i]
      }
      this.form
        .submit('post', '/item/saved_item_image', {
          // Transform form data to FormData
          transformRequest: [
            function(data, headers) {
              return serialize(data)
            }
          ],

          onUploadProgress: e => {
            // Do whatever you want with the progress event
            // console.log(e)
          }
        })
        .then(({ data }) => {
          console.log(data)
          if (data.trim() == 'Success') {
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message: '<i class="fa fa-check"></i> Items has been updated.',
              container: 'floating',
              timer: 5000
            })
          } else {
            if (data.trim() == 'Error') {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: "<i class='fa fa-exclamation-circle'></i> Error.",
                container: 'floating',
                timer: 5000
              })
            }
          }
        })
        .catch(error => {})

      this.getResults()
      $('#setupMdl').modal('hide')
      this.$router.go(0)
    },
    submitformreupload1() {
      // Count total files
      //$countfiles = $_FILES['file']['name']

      // Looping all files
      // for (let i = 0; i < count(this.form1.image); i++) {
      //   this.form1.image = this.$refs.image.files[i]
      //   console.log(this.form1.image)
      // }

      const images = document.getElementById('images').files

      // return

      this.form1.images = images

      this.form1
        .submit('post', '/item/saved_item_image1', {
          // Transform form data to FormData
          transformRequest: [
            function(data, headers) {
              return serialize(data)
            }
          ],

          onUploadProgress: e => {
            // Do whatever you want with the progress event
            // console.log(e)
          }
        })
        .then(({ data }) => {
          console.log(data)
          if (data.trim() == 'Success') {
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message: '<i class="fa fa-check"></i> Items has been updated.',
              container: 'floating',
              timer: 5000
            })
          } else {
            if (data.trim() == 'Error') {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: "<i class='fa fa-exclamation-circle'></i> Error.",
                container: 'floating',
                timer: 5000
              })
            }
          }
        })
        .catch(error => {})

      this.getResults1()
      $('#setupMdl1').modal('hide')
      // this.$router.go(0)
    },
    btn_activation(id, status) {
      axios
        .get(`/item/activate_item/?id=${id}&status=${status}`)
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == '1') {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  "<i class='fa fa-check'></i> Status now changed to Inactive.",
                container: 'floating',
                timer: 5000
              })
            }
            this.getResults()
          } else {
            if (data.trim() == 'Error') {
              if (status == '1') {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already active.",
                  container: 'floating',
                  timer: 5000
                })
              } else {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already inactive.",
                  container: 'floating',
                  timer: 5000
                })
              }
            }
          }
        })
        .catch(error => {})
    },
    btn_activation1(id, status) {
      axios
        .get(`/item/activate_item/?id=${id}&status=${status}`)
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == '1') {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  "<i class='fa fa-check'></i> Status now changed to Inactive.",
                container: 'floating',
                timer: 5000
              })
            }
            this.getResults1()
          } else {
            if (data.trim() == 'Error') {
              if (status == '1') {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already active.",
                  container: 'floating',
                  timer: 5000
                })
              } else {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already inactive.",
                  container: 'floating',
                  timer: 5000
                })
              }
            }
          }
        })
        .catch(error => {})
    }
  },

  mounted() {
    console.log('Component mounted.')
    setTimeout(this.getResults(), 500)
    setTimeout(this.getResults1(), 500)
    this.$root.currentPage = this.$route.meta.name
    $('#container').css('position', 'relative')
  }
}
</script>
<style scoped>
.image-details {
  object-fit: cover;
  object-position: center center;
  height: 225px;
  min-height: 220px;
}
</style>
