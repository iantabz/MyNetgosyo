<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
            <i class="fa fa-vcard-o"></i> Transactions - On-Process
          </h3>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <form
                    action="order2"
                    @submit.prevent="submitformorder2"
                    method="post"
                    enctype="multipart/form-data"
                  >
                    <div class="row">
                      <div class="col-md-3">
                        <h5 style="float: right;">Date From:</h5>
                      </div>
                      <div class="col-md-3">
                        <datetime
                          v-model="dateFrom2"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                        ></datetime>
                      </div>
                      <div class="col-md-3">
                        <h5 style="float: right;">To:</h5>
                      </div>
                      <div class="col-md-3">
                        <datetime
                          v-model="dateTo2"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                        ></datetime>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!------------------------------------------------------------->
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <div class="row">
                      <div class="col-md-6 table-toolbar-left"></div>
                      <div class="col-md-6 table-toolbar-right">
                        <form class="form-horizontal">
                          <div class="form-group">
                            <label class="col-md-6 control-label"
                              >Search:</label
                            >
                            <div class="col-md-6">
                              <input
                                type="text"
                                class="form-control"
                                @keyup="searchT2"
                                v-model="searchTrans2"
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
                          <th>Transaction No.</th>
                          <th>Store Name</th>
                          <th>Payment Method</th>
                          <th>Ordered By</th>
                          <th>Total Amount</th>
                          <th>Downloaded</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="!transaction2.data.length">
                          <td colspan="8" class="text-center">
                            No data available
                          </td>
                        </tr>
                        <tr
                          v-for="MgaTransaction2 in transaction2.data"
                          :key="MgaTransaction2.id"
                        >
                          <td>{{ MgaTransaction2.tran_no }}</td>
                          <td>{{ MgaTransaction2.store_name }}</td>
                          <td>{{ MgaTransaction2.p_meth }}</td>
                          <td>{{ MgaTransaction2.order_by }}</td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'On-Process'"
                            style="text-align: right; font-weight: bold; color: #008000;"
                          >
                            {{ MgaTransaction2.tot_amt | toCurrency }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Approved'"
                            style="text-align: right; font-weight: bold; color: #008000;"
                          >
                            {{ MgaTransaction2.tot_del_amt | toCurrency }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Delivered'"
                            style="text-align: right; font-weight: bold; color: #0000FF;"
                          >
                            {{ MgaTransaction2.tot_del_amt | toCurrency }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Pending'"
                            style="text-align: right; font-weight: bold; color: #ff4d00;"
                          >
                            {{ MgaTransaction2.tot_amt | toCurrency }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Returned'"
                            style="text-align: right; font-weight: bold; color: #FF0000;"
                          >
                            {{ MgaTransaction2.tot_del_amt | toCurrency }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Cancelled'"
                            style="text-align: right; font-weight: bold; color: #FF0000;"
                          >
                            {{ MgaTransaction2.tot_amt | toCurrency }}
                          </td>
                          <td v-if="MgaTransaction2.isExported === 1">
                            <span>Yes</span>
                          </td>
                          <td v-if="MgaTransaction2.isExported === 0">
                            <span>No</span>
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'On-Process'"
                            style="color: #008000;"
                          >
                            {{ MgaTransaction2.tran_stat }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Approved'"
                            style="color: #008000;"
                          >
                            {{ MgaTransaction2.tran_stat }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Delivered'"
                            style="color: #0066cc;"
                          >
                            {{ MgaTransaction2.tran_stat }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Pending'"
                            style="color: #ff7400;"
                          >
                            <span>Submitted</span>
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Returned'"
                            style="color: #ff3333;"
                          >
                            {{ MgaTransaction2.tran_stat }}
                          </td>
                          <td
                            v-if="MgaTransaction2.tran_stat === 'Cancelled'"
                            style="color: #ff3333;"
                          >
                            {{ MgaTransaction2.tran_stat }}
                          </td>
                          <td>
                            <button
                              @click="details2(MgaTransaction2)"
                              class="btn btn-info btn-xs"
                              style="margin: 1px;"
                            >
                              <i class="fa fa-list-alt"></i>
                            </button>
                            <button
                              @click="orderDetails2(MgaTransaction2.tran_no)"
                              class="btn btn-success btn-xs"
                               style="margin: 1px;"
                            >
                              <i class="fa fa-cart-arrow-down"></i>
                            </button>
                            <button
                              class="btn btn-danger btn-xs"
                              @click="setSelectedCustomer(MgaTransaction2)"
                              :disabled="
                                MgaTransaction2.hasOwnProperty('active_chat') &&
                                  MgaTransaction2.active_chat
                              "
                                style="margin: 1px;"
                            >
                              <i class="fa fa-wechat"></i>
                            </button>

                            <!-- <router-link
                              v-on:click.native="setSelectedCustomer(MgaTransaction2)"
                              class="btn btn-danger btn-xs"
                              :to="{
                                name: 'contactChat',
                                params: {
                                  contactData: serializedCustomerData(
                                    MgaTransaction2
                                  )
                                }
                              }"
                            >
                              
                            </router-link> -->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6">
                          Showing {{ transaction2.from }} to
                          {{ transaction2.to }} of
                          {{ transaction2.total }} entries
                        </div>
                        <div class="col-md-6">
                          <div class="text-right">
                            <pagination
                              style="margin: 0 0 20px 0;"
                              :limit="1"
                              :show-disabled="true"
                              :data="transaction2"
                              @pagination-change-page="getResults2"
                            ></pagination>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <!--<div class="row" style="text-align: right;">-->
              <!--  <div class="col-md-11">-->
              <!--    <div class="col-lg-9">-->
              <!--      <h4 style="color: green;">Total Amount:</h4>-->
              <!--    </div>-->
              <!--    <div class="col-lg-2">-->
              <!--      <h4 style="color: green;">-->
              <!--        {{ total_amt_tran | toCurrency }}-->
              <!--      </h4>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="panel-heading">
            <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
              <i class="fa fa-vcard-o"></i> Chat Support
            </h3>
          </div>
          <div class="col-md-12">
            <div class="col-md-4">
              <!-- <div class="nano-content">
                <div class="pad-all bord-btm">
                  <form
                    action="order"
                    @submit.prevent=""
                    method="post"
                    enctype="multipart/form-data"
                  >
                    <v-select
                      v-model="selected_customer"
                      :options="customer_options"
                      :value="customer_options.customer_id"
                      :filterable="false"
                      @search="retrieveCustomers"
                      @input="setSelectedCustomer"
                      label="customer_name"
                      placeholder="Search Customer"
                    >
                      <template slot="no-options">
                        <strong>Search for Existing Customer</strong>
                      </template>
                      <template slot="option" slot-scope="option">{{
                        `${option.account_name} - ${option.account_code}`
                      }}</template>
                      <template slot="selected-option" slot-scope="option">{{
                        `${option.account_name} - ${option.account_code}`
                      }}</template>
                    </v-select>
                  </form>
                </div>
              </div> -->
              <div class="pad-all bord-btm">
                <div class="row">
                  <div class="col-md-12">
                    <span style="text-align:left;"><h4>Legend:</h4></span>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <img
                      src="/assets/img/profile-photos/3.png"
                      class="img-sm img-circle"
                    />
                    <span><h6>Salesman</h6></span>
                  </div>
                  <div class="col-md-6" style="text-align:left;">
                    <img
                      src="/assets/img/profile-photos/1.png"
                      class="img-sm img-circle"
                    />
                    <span><h6>Customer</h6></span>
                  </div>
                </div>
              </div>
              <Contacts
                :contacts="contacts"
                :userInfo="userInfo"
                @selected="setSelectedTransaction"
              />
            </div>

            <div class="col-md-8">
              <router-view
                @setSelectedTransactionEmit="setSelectedTransaction"
              ></router-view>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
            <i class="fa fa-cart-arrow-down"></i> Additional Order Transaction
          </h3>
        </div>
        <div class="tab-base">
          <!--Tabs Content-->
          <div class="tab-content">
            <div class="table-responsive">
              <!-- <div class="row">
                <div class="col-md-12">
                  <form
                    action="addorder"
                    @submit.prevent=""
                    method="post"
                    enctype="multipart/form-data"
                  >
                    <v-select
                      v-model="selected_customer_addtrans"
                      :options="customer_options"
                      :value="customer_options.customer_id"
                      :filterable="false"
                      @search="retrieveCustomers"
                      @input="setSelectedTransaction"
                      label="customer_name"
                      placeholder="Search Customer"
                    >
                      <template slot="no-options">
                        <strong>Search for Existing Customer</strong>
                      </template>
                      <template slot="option" slot-scope="option">{{
                        `${option.account_name} - ${option.account_code}`
                      }}</template>
                      <template slot="selected-option" slot-scope="option">{{
                        `${option.account_name} - ${option.account_code}`
                      }}</template>
                    </v-select>
                  </form>
                </div>
              </div> -->
              <br />
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
                          @keyup="search3"
                          v-model="searchAdd"
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
                    <th>Transaction #</th>
                    <th>Account Code</th>
                    <th>Store Name</th>
                    <th>Payment Method</th>
                    <th>Qty Item</th>
                    <th>Total Amt</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!add_trans.data.length">
                    <td colspan="8" class="text-center">
                      No data available
                    </td>
                  </tr>
                  <tr
                    v-for="MgaAddtlTrans in add_trans.data"
                    :key="MgaAddtlTrans.id"
                  >
                    <td>{{ MgaAddtlTrans.tran_no }}</td>
                    <td>{{ MgaAddtlTrans.account_code }}</td>
                    <td>{{ MgaAddtlTrans.store_name }}</td>
                    <td>{{ MgaAddtlTrans.p_meth }}</td>
                    <td>{{ MgaAddtlTrans.itm_count }}</td>
                    <td>
                      {{ parseFloat(MgaAddtlTrans.tot_amt) | toCurrency }}
                    </td>
                    <td
                      v-if="MgaAddtlTrans.tran_stat === 'On-Process'"
                      style="color: #008000;"
                    >
                      {{ MgaAddtlTrans.tran_stat }}
                    </td>
                    <td
                      v-if="MgaAddtlTrans.tran_stat === 'Approved'"
                      style="color: #008000;"
                    >
                      {{ MgaAddtlTrans.tran_stat }}
                    </td>
                    <td
                      v-if="MgaAddtlTrans.tran_stat === 'Delivered'"
                      style="color: #0066cc;"
                    >
                      {{ MgaAddtlTrans.tran_stat }}
                    </td>
                    <td
                      v-if="MgaAddtlTrans.tran_stat === 'Pending'"
                      style="color: #ff7400;"
                    >
                      <span>Submitted</span>
                    </td>
                    <td
                      v-if="MgaAddtlTrans.tran_stat === 'Returned'"
                      style="color: #ff3333;"
                    >
                      {{ MgaAddtlTrans.tran_stat }}
                    </td>
                    <td
                      v-if="MgaAddtlTrans.tran_stat === 'Cancelled'"
                      style="color: #ff3333;"
                    >
                      {{ MgaAddtlTrans.tran_stat }}
                    </td>

                    <td>
                      <button
                        @click="order_lines(MgaAddtlTrans.tran_no)"
                        class="btn btn-info btn-xs"
                      >
                        <i class="fa fa-list-alt"></i>
                      </button>
                      &nbsp;
                      <span>
                        <button
                          v-if="MgaAddtlTrans.tran_stat === 'Cancelled'"
                          @click="order1(MgaAddtlTrans)"
                          class="btn btn-purple btn-xs"
                          disabled="disabled"
                        >
                          <i class="fa fa-cart-arrow-down"></i>
                        </button>

                        <button
                          v-else
                          @click="order1(MgaAddtlTrans)"
                          class="btn btn-purple btn-xs"
                        >
                          <i class="fa fa-cart-arrow-down"></i>
                        </button>
                      </span>

                      &nbsp;
                      <span>
                        <button
                          v-if="MgaAddtlTrans.tran_stat === 'Cancelled'"
                          @click="dropOrder(MgaAddtlTrans.tran_no)"
                          class="btn btn-danger btn-xs"
                          disabled="disabled"
                        >
                          <i class="fa fa-trash-o"></i>
                        </button>

                        <button
                          v-else
                          @click="dropOrder(MgaAddtlTrans.tran_no)"
                          class="btn btn-danger btn-xs"
                        >
                          <i class="fa fa-trash-o"></i>
                        </button>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    Showing {{ add_trans.from }} to {{ add_trans.to }} of
                    {{ add_trans.total }} entries
                  </div>
                  <div class="col-md-6">
                    <div class="text-right">
                      <pagination
                        style="margin: 0 0 20px 0;"
                        :limit="1"
                        :show-disabled="true"
                        :data="add_trans"
                        @pagination-change-page="getResultsTrans"
                      ></pagination>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!----------------------------------Form Modal Table Item ------------------------------------------->

      <div
        class="modal fade"
        id="setupMdlOrder"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle">Modal title</h5>
              <button
                @click="closeModalx('setupMdlOrder')"
                type="button"
                class="close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="acct_name">Customer Name:</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form1.acct_name"
                        id="acct_name"
                        name="acct_name"
                        style="border: none;border-color: transparent; font-size: 20px; font-weight: bold;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="acct_code">Account Code:</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form1.acct_code"
                        id="acct_code"
                        name="acct_code"
                        style="border: none;border-color: transparent; font-size: 20px; font-weight: bold;"
                      />
                    </div>
                  </div>
                </div>
                <div class="row" style="margin: 0px 0px 10px 0px">
                  <div class="col-lg-2">
                    <h5>Select a category :</h5>
                  </div>
                  <div class="col-lg-4">
                    <v-select
                      v-model="selected"
                      :options="options"
                      :value="options.id"
                      @input="setSelected"
                      label="category_name"
                      placeholder="Category Lists"
                    ></v-select>
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
                              @keyup="search2"
                              v-model="searchItem2"
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
                        <th>Categories</th>
                        <th>UOM</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!items.data.length">
                        <td colspan="7" class="text-center">
                          No data available
                        </td>
                      </tr>
                      <tr
                        v-for="MgaItems in items.data"
                        :key="MgaItems.item_masterfiles_id"
                      >
                        <td>{{ MgaItems.product_name }}</td>
                        <td>{{ MgaItems.brand }}</td>
                        <td>{{ MgaItems.itemcode }}</td>
                        <td>{{ MgaItems.product_family }}</td>
                        <td>{{ MgaItems.uom }}</td>
                        <td>
                          {{
                            parseFloat(MgaItems.list_price_wtax) | toCurrency
                          }}
                        </td>
                        <td>
                          <span
                            class="label label-info"
                            v-if="MgaItems.status === 1"
                            >Active</span
                          >

                          <span class="label label-danger" v-else
                            >Inactive</span
                          >

                          &nbsp;
                          <button
                            @click="details(MgaItems)"
                            class="btn btn-success btn-xs"
                          >
                            <i class="fa fa-list-alt"></i>
                          </button>
                          &nbsp;
                          <button
                            @click="orderQty(MgaItems)"
                            class="btn btn-purple btn-xs"
                            v-if="MgaItems.status === 1"
                          >
                            <i class="fa fa-cart-arrow-down"></i>
                          </button>

                          <button
                            @click="orderQty(MgaItems)"
                            class="btn btn-purple btn-xs"
                            v-else
                            disabled
                          >
                            <i class="fa fa-cart-arrow-down"></i>
                          </button>
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
          </div>
        </div>
      </div>

      <!----------------------------------Form Modal Transaction - On-Process 1 ------------------------------------------->

      <div
        class="modal fade"
        id="setupMdl96"
        tabindex="-1"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle96">Modal title</h5>
              <button type="button" class="close" @click="closeModal4">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="panel">
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="OrderTable2"
                    class="table table-hover table-bordered table-striped table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Transaction No.</th>
                        <th>Description</th>
                        <th>Itemcode</th>
                        <th>UOM</th>
                        <th>ReqQty</th>
                        <th>DelQty</th>
                        <th>Disct</th>
                        <th>Amount</th>
                        <th>Total Amt</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="MgaOrder in order" :key="MgaOrder.doc_no">
                        <td>{{ MgaOrder.tran_no }}</td>
                        <td>{{ MgaOrder.item_desc }}</td>
                        <td>{{ MgaOrder.itm_code }}</td>
                        <td>{{ MgaOrder.uom }}</td>
                        <td>{{ MgaOrder.req_qty }}</td>
                        <td>{{ MgaOrder.del_qty }}</td>
                        <td>
                          {{ parseFloat(MgaOrder.discount).toFixed(2) }}&#37;
                        </td>
                        <td style="text-align: right;">
                          {{ MgaOrder.amt | toCurrency }}
                        </td>
                        <td style="text-align: right;">
                          {{ MgaOrder.tot_amt | toCurrency }}
                        </td>
                        <td>{{ MgaOrder.itm_stat }}</td>
                        <td>
                          <button
                            @click="detailsOrder2(MgaOrder.doc_no)"
                            class="btn btn-info btn-xs"
                          >
                            <i class="fa fa-list-alt"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <br />
                <div class="row" style="text-align: right;">
                  <div class="col-md-11">
                    <div class="col-lg-9">
                      <h4 style="color: green;">Total Amount:</h4>
                    </div>
                    <div class="col-lg-2">
                      <h4 style="color: green;">
                        {{ total_amt_line | toCurrency }}
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!----------------------------------Form Modal Transaction - On-Process2 ------------------------------------------->

      <div
        class="modal fade"
        id="setupMdl696"
        tabindex="-1"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle696">Modal title</h5>
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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="tran_no2">Transaction No.</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.tran_no2"
                        id="tran_no2"
                        name="tran_no2"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="item_desc">Item Description</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.item_desc"
                        id="item_desc"
                        name="item_desc"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="itm_code">Item Code</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.itm_code"
                        id="itm_code"
                        name="itm_code"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="itm_cat">Item Category</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.itm_cat"
                        id="itm_cat"
                        name="itm_cat"
                      />
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="req_qty">Request Qty</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.req_qty"
                        id="req_qty"
                        name="req_qty"
                      />
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="del_qty">Delivered Qty</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.del_qty"
                        id="del_qty"
                        name="del_qty"
                      />
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="uom">UOM</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.uom"
                        id="uom"
                        name="uom"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="amt">Amount</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.amt"
                        id="amt"
                        name="amt"
                        style="text-align: right; color: red;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="tot_amt2">Total Amount</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.tot_amt2"
                        id="tot_amt2"
                        name="tot_amt2"
                        style="text-align: right; color: red;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="itm_stat">Status</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form5.itm_stat"
                        id="itm_stat"
                        name="itm_stat"
                      />
                    </div>
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

      <!----------------------------------Form Modal Transaction - On-Process ------------------------------------------->
      <div
        class="modal fade"
        id="setupMdl69"
        tabindex="-1"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle69">Modal title</h5>
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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="tran_no">Transaction No.</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.tran_no"
                        id="tran_no"
                        name="tran_no"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="store_name">Store Name</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.store_name"
                        id="store_name"
                        name="store_name"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="account_code">Account Code</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.account_code"
                        id="account_code"
                        name="account_code"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label
                        for="sm_name"
                        style="color: green; font-weight: bold;"
                        >Salesman Name</label
                      >

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.sm_name"
                        id="sm_name"
                        name="sm_name"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="sm_code">Salesman Code</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.sm_code"
                        id="sm_code"
                        name="sm_code"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="itm_count">Item Count</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.itm_count"
                        id="itm_count"
                        name="itm_count"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="p_meth">Payment Method</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.p_meth"
                        id="p_meth"
                        name="p_meth"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="tot_amt">Total Request Amount</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.tot_amt"
                        id="tot_amt"
                        name="tot_amt"
                        style="text-align: right; color: red;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="tot_del_amt">Total Delivered Amount</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.tot_del_amt"
                        id="tot_amt"
                        name="tot_amt"
                        style="text-align: right; color: red;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="tran_stat">Status</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.tran_stat"
                        id="tran_stat"
                        name="tran_stat"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="date_req">Date Request</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.date_req"
                        id="date_req"
                        name="date_req"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="date_app">Export / Import Date</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.date_app"
                        id="date_app"
                        name="date_app"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="date_del">Date Delivered</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form4.date_del"
                        id="date_del"
                        name="date_del"
                      />
                    </div>
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

      <!----------------------------------Form Modal Item Details------------------------------------------->
      <div
        class="modal fade"
        id="setupMdl"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle12">Modal title</h5>
              <button
                @click="closeModalx('setupMdl')"
                type="button"
                class="close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- <form action="" method="post" enctype="multipart/form-data"> -->
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
                              style="width: 150px; height: 120px;"
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
                              style="width: 150px; height: 120px;"
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
            <!-- </form> -->
          </div>
        </div>
      </div>

      <!---------------------------------------- Additional Order Line Table ------------------------------------->

      <div
        class="modal fade"
        id="69"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle22">Modal title</h5>
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
            <div class="panel">
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    id="OrderTable"
                    class="table table-hover table-bordered table-striped table-vcenter"
                    width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Transaction No.</th>
                        <th>Description</th>
                        <th>Itemcode</th>
                        <th>UOM</th>
                        <th>ReqQty</th>
                        <th>DelQty</th>
                        <th>Disct</th>
                        <th>Amount</th>
                        <th>Total Amt</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="MgaOrder in order" :key="MgaOrder.doc_no">
                        <td>{{ MgaOrder.tran_no }}</td>
                        <td>{{ MgaOrder.item_desc }}</td>
                        <td>{{ MgaOrder.itm_code }}</td>
                        <td>{{ MgaOrder.uom }}</td>
                        <td>{{ MgaOrder.req_qty }}</td>
                        <td>{{ MgaOrder.del_qty }}</td>
                        <td>
                          {{ parseFloat(MgaOrder.discount).toFixed(2) }}&#37;
                        </td>
                        <td style="text-align: right;">
                          {{ MgaOrder.amt | toCurrency }}
                        </td>
                        <td style="text-align: right;">
                          {{ MgaOrder.tot_amt | toCurrency }}
                        </td>
                        <td style="color: red;">{{ MgaOrder.itm_stat }}</td>
                        <td>
                          <button
                            @click="detailsOrder(MgaOrder.doc_no)"
                            class="btn btn-info btn-xs"
                          >
                            <i class="fa fa-list-alt"></i>
                          </button>
                          &nbsp;&nbsp;
                          <span>
                            <button
                              v-if="MgaOrder.itm_stat === 'Cancelled'"
                              @click="orderQty1(MgaOrder)"
                              class="btn btn-success btn-xs"
                              disabled="disabled"
                            >
                              <i class="fa fa-pencil"></i>
                            </button>
                            <button
                              v-else
                              @click="orderQty1(MgaOrder)"
                              class="btn btn-success btn-xs"
                            >
                              <i class="fa fa-pencil"></i>
                            </button>
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <br />
                <div class="row" style="text-align: right;">
                  <div class="col-md-11">
                    <div class="col-lg-9">
                      <h4 style="color: green;">Total Amount:</h4>
                    </div>
                    <div class="col-lg-2">
                      <h4 style="color: green;">
                        {{ total_amt_line | toCurrency }}
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!---------------------------------------- Additional Order Line Details ----------------------------------->

      <div
        class="modal fade"
        id="setupMdl2"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle21">Modal title</h5>
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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="tran_no2">Transaction No.</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.tran_no2"
                        id="tran_no2"
                        name="tran_no2"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="item_desc">Item Description</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.item_desc"
                        id="item_desc"
                        name="item_desc"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="itm_code">Item Code</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.itm_code"
                        id="itm_code"
                        name="itm_code"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="itm_cat">Item Category</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.itm_cat"
                        id="itm_cat"
                        name="itm_cat"
                      />
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="req_qty">Request Qty</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.req_qty"
                        id="req_qty"
                        name="req_qty"
                      />
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="del_qty">Delivered Qty</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.del_qty"
                        id="del_qty"
                        name="del_qty"
                      />
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="uom">UOM</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.uom"
                        id="uom"
                        name="uom"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="amt">Amount</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.amt"
                        id="amt"
                        name="amt"
                        style="text-align: right; color: red;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="tot_amt2">Total Amount</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.tot_amt2"
                        id="tot_amt2"
                        name="tot_amt2"
                        style="text-align: right; color: red;"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="itm_stat">Status</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="form3.itm_stat"
                        id="itm_stat"
                        name="itm_stat"
                      />
                    </div>
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

      <!----------------------------------Form Modal Item Qty 1 ------------------------------------------->

      <div
        class="modal fade"
        id="qtyMdlOrder1"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
      >
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="1">Modal title</h5>
              <button
                @click="closeModalx('qtyMdlOrder1')"
                type="button"
                class="close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body" style="background-color: #fefefe;">
              <div class="row">
                <div class="col-md-12" style="padding-bottom: 25px;">
                  <div class="form-group">
                    <label for="prdctname">Product Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctname"
                      id="prdctname"
                      name="prdctname"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold;"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6" style="padding-bottom: 25px;">
                  <div class="form-group">
                    <label for="prdctfamily">Categories:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctfamily"
                      id="prdctfamily"
                      name="prdctfamily"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold;"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdctuom">UOM:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctuom"
                      id="prdctuom"
                      name="prdctuom"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold;"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdctprice">Price:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctprice"
                      id="prdctprice"
                      name="prdctprice"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold; color: #ff5722;"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div
                  class="col-md-12"
                  style="padding-bottom: 25px; text-align:center;"
                >
                  <div class="form-group">
                    <label for="prdctprice">Quantity:</label>
                    <br />
                    <div class="quantity buttons_added">
                      <input
                        type="button"
                        value="-"
                        class="minus"
                        style="width: 80px; height: 60px;"
                        @click="
                          form2.prdctqty > 1 ? (form2.prdctqty -= 1) : null
                        "
                      /><input
                        type="number"
                        step="1"
                        min="1"
                        max=""
                        name="quantity"
                        title="Qty"
                        class="input-text qty text"
                        size="4"
                        pattern=""
                        v-model.number="form2.prdctqty"
                        style="width: 80px; height: 60px; font-weight: bold"
                      /><input
                        type="button"
                        value="+"
                        style="width: 80px; height: 60px;"
                        class="plus"
                        @click="form2.prdctqty += 1"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div
                  class="col-md-12"
                  style="padding-bottom: 25px; text-align:center;"
                >
                  <div class="form-group">
                    <button
                      type="button"
                      class="btn btn-lg btn-danger"
                      data-loading-text="Loading..."
                      id="addtocart"
                      @click="addToOrder1(selected_item)"
                    >
                      Add to Order
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!----------------------------------Form Modal Item Qty ------------------------------------------->

      <div
        class="modal fade"
        id="qtyMdlOrder"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
      >
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modT">Modal title</h5>
              <button
                @click="closeModalx('qtyMdlOrder')"
                type="button"
                class="close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body" style="background-color: #fefefe;">
              <div class="row">
                <div class="col-md-12" style="padding-bottom: 25px;">
                  <div class="form-group">
                    <label for="prdctname">Product Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctname"
                      id="prdctname"
                      name="prdctname"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold;"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6" style="padding-bottom: 25px;">
                  <div class="form-group">
                    <label for="prdctfamily">Categories:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctfamily"
                      id="prdctfamily"
                      name="prdctfamily"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold;"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdctuom">UOM:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctuom"
                      id="prdctuom"
                      name="prdctuom"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold;"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="prdctprice">Price:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form2.prdctprice"
                      id="prdctprice"
                      name="prdctprice"
                      style="border: none;border-color: transparent; font-size: 15px; font-weight: bold; color: #ff5722;"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div
                  class="col-md-12"
                  style="padding-bottom: 25px; text-align:center;"
                >
                  <div class="form-group">
                    <label for="prdctprice">Quantity:</label>
                    <br />
                    <div class="quantity buttons_added">
                      <input
                        type="button"
                        value="-"
                        class="minus"
                        style="width: 80px; height: 60px;"
                        @click="
                          form2.prdctqty > 1 ? (form2.prdctqty -= 1) : null
                        "
                      /><input
                        type="number"
                        step="1"
                        min="1"
                        max=""
                        name="quantity"
                        title="Qty"
                        class="input-text qty text"
                        size="4"
                        pattern=""
                        v-model.number="form2.prdctqty"
                        style="width: 80px; height: 60px; font-weight: bold"
                      /><input
                        type="button"
                        value="+"
                        style="width: 80px; height: 60px;"
                        class="plus"
                        @click="form2.prdctqty += 1"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div
                  class="col-md-12"
                  style="padding-bottom: 25px; text-align:center;"
                >
                  <div class="form-group">
                    <button
                      type="button"
                      class="btn btn-lg btn-danger"
                      data-loading-text="Loading..."
                      id="addtocart"
                      @click="addToOrder(selected_item)"
                    >
                      Add to Order
                    </button>
                  </div>
                </div>
              </div>
            </div>
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
.v-select
  .v-input__control
  .v-input__slot
  .v-select__slot
  .v-select__selections {
  padding: 0 !important;
  min-height: 0 !important;
}

.v-select-list .v-list-item {
  min-height: 0 !important;
}

.v-select-list .v-list-item .v-list-item__content {
  padding: 4px 0 !important;
}

/* -- quantity box -- */

.quantity {
  display: inline-block;
}

.quantity .input-text.qty {
  width: 35px;
  height: 39px;
  padding: 0 5px;
  text-align: center;
  background-color: transparent;
  border: 1px solid #efefef;
}

.quantity.buttons_added {
  text-align: left;
  position: relative;
  white-space: nowrap;
  vertical-align: top;
}

.quantity.buttons_added input {
  display: inline-block;
  margin: 0;
  vertical-align: top;
  box-shadow: none;
}

.quantity.buttons_added .minus,
.quantity.buttons_added .plus {
  padding: 7px 10px 8px;
  height: 41px;
  background-color: #ffffff;
  border: 1px solid #efefef;
  cursor: pointer;
}

.quantity.buttons_added .minus {
  border-right: 0;
}

.quantity.buttons_added .plus {
  border-left: 0;
}

.quantity.buttons_added .minus:hover,
.quantity.buttons_added .plus:hover {
  background: #eeeeee;
}

.quantity input::-webkit-outer-spin-button,
.quantity input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  -moz-appearance: none;
  margin: 0;
}

.quantity.buttons_added .minus:focus,
.quantity.buttons_added .plus:focus {
  outline: none;
}

#setupMdlOrder {
  overflow-y: scroll;
}

#69 {
  overflow-y: scroll;
}
</style>

<script>
/** @format */
// import NProgress from 'nprogress'
import Vue from 'vue'
// import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
// import { serialize } from 'object-to-formdata'
import _ from 'lodash'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import 'vue-select/src/scss/vue-select.scss'
import Contacts from './Contacts'
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
// import moment from 'moment'
import { DateTime } from 'luxon'

Vue.component('v-select', vSelect)
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
      transaction2: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      add_trans: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      items_log: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      items_log_data: [],
      order: [],
      orderTable: {},
      total_amt_line: 0,
      order_details: [],
      editCustomerDetails: null,
      form5: new Form({
        doc_no: '',
        tran_no2: '',
        itm_code: '',
        item_desc: '',
        req_qty: '',
        del_qty: '',
        uom: '',
        amt: '',
        tot_amt2: '',
        itm_cat: '',
        itm_stat: ''
      }),
      form4: new Form({
        id: '',
        tran_no: '',
        date_req: '',
        date_app: '',
        date_del: '',
        account_code: '',
        store_name: '',
        p_meth: '',
        itm_count: '',
        tot_amt: '',
        tot_del_amt: '',
        tran_type: '',
        tran_stat: '',
        sm_name: '',
        sm_code: ''
      }),
      form3: new Form({
        doc_no: '',
        tran_no2: '',
        itm_code: '',
        item_desc: '',
        req_qty: '',
        del_qty: '',
        uom: '',
        amt: '',
        tot_amt2: '',
        itm_cat: '',
        itm_stat: ''
      }),
      form2: new Form({
        prdctname: '',
        prdctfamily: '',
        prdctuom: '',
        prdctprice: '',
        prdctqty: 1
      }),
      form1: new Form({
        acct_id: '',
        trans_code: '',
        acct_code: '',
        acct_name: '',
        acct_crdt_limit: '',
        acct_paymnt_type: '',
        acct_salesman_code: ''
      }),
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
      dateFrom2: DateTime.local().toString(),
      dateTo2: DateTime.local().toString(),
      searchTrans2: null,
      selected_item: [],
      selected_transcode: '',
      contacts: [],
      userInfo: [],
      selected: null,
      selected_customer: null,
      selected_customer_addtrans: null,
      options: [],
      customer_options: [],
      customer_id: '',
      id: '',
      name: '',
      image: '',
      isActive: 1,
      searchItem2: null,
      searchAdd: null,
      searchItemLog: null,
      total_amt_tran: 0,
      total_amt_line: 0,
      dateActive: false
    }
  },
  components: {
    Contacts,
    datetime: Datetime
  },
  watch: {
    dateFrom2() {
      this.getResults2()
    },
    dateTo2() {
      this.getResults2()
    }
  },
  methods: {
    serializedCustomerData({
      id,
      store_name,
      account_code,
      tran_no,
      cus_mobile_number
    }) {
      return btoa(
        JSON.stringify({
          id,
          contact: `${store_name}`,
          account_code: `${account_code}`,
          ref_no: `${tran_no}`,
          mobile: `${cus_mobile_number}`,
          status: `active`,
          type: 'Customer'
        })
      )
    },
    searchT2() {
      this.searchForTrans2(this.searchTrans2, this)
    },
    searchForTrans2: _.debounce((searchT2, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction2?dateFrom=${btoa(
            vm.dateFrom2
          )}&dateTo=${btoa(vm.dateTo2)}&name=${searchT2}&dateActive=${
            vm.dateActive
          }&page=1`
        )
        .then(response => {
          vm.transaction2 = response.data

          if (searchT2 === '') {
            if (vm.dateActive === true) {
              vm.total_amt_tran = 0

              vm.transaction2.data.forEach(datas => {
                if (datas['tran_stat'] === 'Pending') {
                  vm.total_amt_tran =
                    vm.total_amt_tran + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'On-Process') {
                  vm.total_amt_tran =
                    vm.total_amt_tran + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'Approved') {
                  vm.total_amt_tran =
                    vm.total_amt_tran + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Delivered') {
                  vm.total_amt_tran =
                    vm.total_amt_tran + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Returned') {
                  vm.total_amt_tran =
                    vm.total_amt_tran + parseFloat(datas['tot_del_amt'])
                }
              })
            } else {
              vm.getOnProcessTotalAmount()
            }
          } else {
            vm.total_amt_tran = 0

            vm.transaction2.data.forEach(datas => {
              if (datas['tran_stat'] === 'Pending') {
                vm.total_amt_tran =
                  vm.total_amt_tran + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'On-Process') {
                vm.total_amt_tran =
                  vm.total_amt_tran + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'Approved') {
                vm.total_amt_tran =
                  vm.total_amt_tran + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Delivered') {
                vm.total_amt_tran =
                  vm.total_amt_tran + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Returned') {
                vm.total_amt_tran =
                  vm.total_amt_tran + parseFloat(datas['tot_del_amt'])
              }
            })
          }
        })
    }, 500),
    
    async getOnProcessTotalAmount() {
      const { data } = await axios.get('transaction/getTotalOnProcess')
      this.total_amt_tran = data
    },
    
    getResults2(page = 1) {
      this.total_amt_tran = 0
      let url = null
      if (!this.searchTrans2) {
        url = `/transaction/getTransaction/transaction2?dateFrom=${btoa(
          this.dateFrom2
        )}&dateTo=${btoa(this.dateTo2)}&dateActive=${this.dateActive}&page=`
      } else {
        url = `/transaction/getTransaction/transaction2?dateFrom=${btoa(
          this.dateFrom2
        )}&dateTo=${btoa(this.dateTo2)}&name=${this.searchTrans2}&dateActive=${
          this.dateActive
        }&page=`
      }
      axios.get(url + page).then(response => {
        this.transaction2 = response.data

        // console.log(this.dateActive)

        if (this.dateFrom2 != this.dateTo2) {
          this.dateActive = true
          this.total_amt_tran = 0

          this.transaction2.data.forEach(datas => {
            if (datas['tran_stat'] === 'Pending') {
              this.total_amt_tran =
                this.total_amt_tran + parseFloat(datas['tot_amt'])
            } else if (datas['tran_stat'] === 'On-Process') {
              this.total_amt_tran =
                this.total_amt_tran + parseFloat(datas['tot_amt'])
            } else if (datas['tran_stat'] === 'Approved') {
              this.total_amt_tran =
                this.total_amt_tran + parseFloat(datas['tot_del_amt'])
            } else if (datas['tran_stat'] === 'Delivered') {
              this.total_amt_tran =
                this.total_amt_tran + parseFloat(datas['tot_del_amt'])
            } else if (datas['tran_stat'] === 'Returned') {
              this.total_amt_tran =
                this.total_amt_tran + parseFloat(datas['tot_del_amt'])
            }
          })
        } else {
          if (this.dateActive === true) {
            if (this.dateFrom2 === this.dateTo2) {
              this.total_amt_tran = 0
              let timeZone = 'Asia/Manila'

              this.transaction2.data.forEach(datas1 => {
                const dateFrom = moment(String(this.dateFrom2)).format(
                  'MM/DD/YYYY'
                )
                const dateTo = moment(String(this.dateTo2)).format('MM/DD/YYYY')
                let date = datas1['date_req']

                //const date_req = moment(String(date)).format('MM/DD/YYYY hh:mm')
                const date_req = moment(String(date)).format('MM/DD/YYYY')

                if (dateFrom === date_req && dateTo === date_req) {
                  if (datas1['tran_stat'] === 'Pending') {
                    this.total_amt_tran =
                      this.total_amt_tran + parseFloat(datas1['tot_amt'])
                  } else if (datas1['tran_stat'] === 'On-Process') {
                    this.total_amt_tran =
                      this.total_amt_tran + parseFloat(datas1['tot_amt'])
                  } else if (datas1['tran_stat'] === 'Approved') {
                    this.total_amt_tran =
                      this.total_amt_tran + parseFloat(datas1['tot_del_amt'])
                  } else if (datas1['tran_stat'] === 'Delivered') {
                    this.total_amt_tran =
                      this.total_amt_tran + parseFloat(datas1['tot_del_amt'])
                  } else if (datas1['tran_stat'] === 'Returned') {
                    this.total_amt_tran =
                      this.total_amt_tran + parseFloat(datas1['tot_del_amt'])
                  }
                }
              })
            }
          } else {
            if (!this.searchTrans2) {
              this.total_amt_tran = 0

              this.getOnProcessTotalAmount()
            }
          }
        }
      })
    },
    closeModalx(modalId) {
      $('#' + modalId).modal('hide')
      // if (modalId === 'setupMdlOrder') {
      //   this.selected = null
      //   this.id = ''
      //   this.image = ''
      //   this.name = ''
      //   this.items = {
      //     image: '',
      //     data: [],
      //     current_page: null,
      //     from: null,
      //     to: null,
      //     total: null,
      //     per_page: null
      //   }
      // }
      if (modalId === 'qtyMdlOrder') {
        this.form2.prdctqty = 1
      }
      if (modalId === 'qtyMdlOrder1') {
        this.form2.prdctqty = 1
      }
    },
    async retrieveContacts() {
      const { data } = await axios.get(`/messenger`)
      this.contacts = data
    },
    search: _.debounce((search, loading, $this) => {
      if (search.length === 0) return

      axios
        .get(`/tele_ordering/get_customers?accountname=${search}`)
        .then(({ data }) => {
          $this.customer_options = data
          loading(false)
        })
        .catch(error => {
          $this.customer_options = []
          loading(false)
        })
    }, 500),

    retrieveCustomers(search, loading) {
      this.customer_options = []
      const trimmedSearch = search.trim()

      if (trimmedSearch.length === 0) return

      loading(true)
      this.search(trimmedSearch, loading, this)
    },
    search2() {
      this.searchForItem2(this.searchItem2, this)
    },

    searchForItem2: _.debounce((search2, vm) => {
      axios
        .get(`/item/getItem2/item2/?name=${search2}&page=1`)
        .then(response => {
          vm.items = response.data
        })
    }, 500),

    search3() {
      this.searchForAdd(this.searchAdd, this)
    },

    searchForAdd: _.debounce((search3, vm) => {
      axios
        .get(`/tele_ordering/getAddTransaction/?name=${search3}&page=1`)
        .then(response => {
          vm.add_trans = response.data
        })
    }),

    getCategories() {
      axios.get(`/tele_ordering/get_categories`).then(response => {
        this.options = response.data
      })
    },

    getCustomers() {
      axios.get(`/tele_ordering/get_customers`).then(response => {
        // this.customer_options = response.data
        // console.log(response.data)
      })
    },

    dropOrder(tran_no) {
      axios
        .get(`/tele_ordering/cancelOrder/?tran_no=${tran_no}`)
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message:
                '<i class="fa fa-check"></i> Transaction has been cancelled!.',
              container: 'floating',
              timer: 5000
            })
            this.getResultsTrans()
          }
        })
        .catch(error => {})
    },

    detailsOrder2(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl696').modal('show')
          $('#MdlTitle696').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form5.tran_no2 = order_d.tran_no
            this.form5.itm_code = order_d.itm_code
            this.form5.item_desc = order_d.item_desc
            this.form5.req_qty = order_d.req_qty
            this.form5.del_qty = order_d.del_qty
            this.form5.uom = order_d.uom
            this.form5.amt = formatter.format(order_d.amt)
            this.form5.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form5.itm_cat = order_d.itm_cat
            this.form5.itm_stat = order_d.itm_stat
          })
        })

      this.getResults2()
    },

    detailsOrder(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle21').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form3.tran_no2 = order_d.tran_no
            this.form3.itm_code = order_d.itm_code
            this.form3.item_desc = order_d.item_desc
            this.form3.req_qty = order_d.req_qty
            this.form3.del_qty = order_d.del_qty
            this.form3.uom = order_d.uom
            this.form3.amt = formatter.format(order_d.amt)
            this.form3.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form3.itm_cat = order_d.itm_cat
            this.form3.itm_stat = order_d.itm_stat
          })
        })
    },

    order_lines(tran_no) {
      this.total_amt_line = 0
      axios
        .get(`/transaction/getOrderTransaction/teleorder_detail/?id=${tran_no}`)
        .then(response => {
          this.order = response.data

          this.order.forEach(datas => {
            // console.log(datas.downloaded)
            // this.downloaded = datas.downloaded
            this.total_amt_line =
              this.total_amt_line + parseFloat(datas['tot_amt'])
          })

          if (Object.keys(this.order).length) {
            setTimeout(() => {
              this.orderTable = $('#OrderTable').DataTable()
            }, 500)
          }

          $('#69').modal('show')
          $('#MdlTitle22').html('Order')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })
    },

    async setSelectedTransaction(account_code) {
      const { data } = await axios.get(
        `/tele_ordering/getCustomerInfo?account_code=${account_code}`
      )
      this.userInfo = data

      this.userInfo.forEach(datas => {
        console.log(datas)

        $('#setupMdlOrder').modal('show')
        $('#MdlTitle').html('Additional Order Transaction')

        this.form1.acct_id = datas['customer_id']
        this.form1.trans_code = ''
        this.form1.acct_code = datas['account_code']
        this.form1.acct_name = datas['account_name']
        this.form1.acct_crdt_limit = datas['account_credit_limit']
        this.form1.acct_paymnt_type = datas['payment_type']
        this.form1.acct_salesman_code = datas['salesman_code']
      })
    },
    setSelected(selected) {
      //console.log(selected)
      //  trigger a mutation, or dispatch an action
      if (selected === null || selected === 'undefined' || selected === '') {
        this.getResults()
      } else {
        const res = Object.keys(selected).map(function(key) {
          return [selected[key]]
        })

        this.id = res[0]
        this.name = res[1]
        this.image = res[2]

        this.getResults()
      }
    },

    order1(MgaAddTrans) {
      //console.log(MgaAddTrans)
      $('#setupMdlOrder').modal('show')
      $('#MdlTitle').html('Additional Order Transaction')

      this.form1.trans_code = MgaAddTrans.tran_no
      this.form1.acct_code = MgaAddTrans.account_code
      this.form1.acct_name = MgaAddTrans.store_name
      this.form1.acct_paymnt_type = MgaAddTrans.p_meth
      this.form1.acct_salesman_code = MgaAddTrans.sm_code
    },

    setSelectedCustomer(selected_customer) {
      // console.log(selected_customer)
      //  trigger a mutation, or dispatch an action
      if (
        selected_customer === null ||
        selected_customer === 'undefined' ||
        selected_customer === ''
      ) {
        // this.getResultsCustomer()
      } else {
        const res = Object.keys(selected_customer).map(function(key) {
          return [selected_customer[key]]
        })

        // console.log(selected_customer)

        axios
          .post(`/messenger/create_new_chat`, selected_customer)
          .then(({ data }) => {
            if (data.trim() == 'Success') {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message: '<i class="fa fa-check"></i> New chat convo created!.',
                container: 'floating',
                timer: 5000
              })
              this.retrieveContacts()
              // window.location = '/tele_ordering'
              this.$router.push({
                name: 'contactChat',
                params: {
                  contactData: this.serializedCustomerData(selected_customer)
                }
              })
            }
            if (data.trim() == 'Exists') {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: '<i class="fa fa-check"></i> Chat already exists!.',
                container: 'floating',
                timer: 5000
              })
            }
          })
          .catch(error => {})
      }
    },

    getResultsTrans(page = 1) {
      let url = null
      if (!this.searchTrans) {
        url = `/tele_ordering/getTransaction?page=`
      } else {
        url = `/tele_ordering/getTransaction/addtrans?name=${this.searchForAdd}&page=${page}`
      }
      axios.get(url + page).then(response => {
        this.add_trans = response.data
      })
    },

    getResults(page = 1) {
      let url = null
      if (!this.searchItem2) {
        url = `/item/getOrderItem/?name=${this.name}&page=`
      } else {
        url = `/item/getOrderItem/item3/?name=${this.searchItem2}&page=`
      }
      axios.get(url + page).then(response => {
        this.items = response.data
      })
    },

    orderDetails2(tran_no) {
      this.total_amt_line = 0
      axios
        .get(`/transaction/getOrderTransaction/order_detail/?id=${tran_no}`)
        .then(response => {
          this.order = response.data

          this.order.forEach(datas => {
            // console.log(datas.downloaded)
            // this.downloaded = datas.downloaded
            this.total_amt_line =
              this.total_amt_line + parseFloat(datas['tot_amt'])
          })

          if (Object.keys(this.order).length) {
            setTimeout(() => {
              this.orderTable = $('#OrderTable2').DataTable()
            }, 500)
          }

          $('#setupMdl96').modal('show')
          $('#MdlTitle96').html('Order')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })

      this.getResults2()
    },

    details2(MgaTransaction) {
      $('#setupMdl69').modal('show')
      $('#MdlTitle69').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form4.tran_no = MgaTransaction.tran_no
      this.form4.date_req = MgaTransaction.date_req
      this.form4.date_app = MgaTransaction.date_app
      this.form4.date_del = MgaTransaction.date_del
      this.form4.account_code = MgaTransaction.account_code
      this.form4.store_name = MgaTransaction.store_name
      this.form4.p_meth = MgaTransaction.p_meth
      this.form4.itm_count = MgaTransaction.itm_count
      this.form4.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form4.tot_del_amt = formatter.format(MgaTransaction.tot_del_amt)
      if (MgaTransaction.tran_stat === 'Pending') {
        this.form4.tran_stat = 'Submitted'
      } else {
        this.form4.tran_stat = MgaTransaction.tran_stat
      }
      this.form4.sm_code = MgaTransaction.sm_code
      this.form4.sm_name =
        MgaTransaction.first_name + ' ' + MgaTransaction.last_name

      this.getResults2()
    },

    orderQty1(IyangOrder) {
      //console.log(IyangOrder)
      $('#qtyMdlOrder1').modal('show')
      $('#1').html('Select Quantity')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form2.prdctname = IyangOrder.item_desc
      this.form2.prdctfamily = IyangOrder.itm_cat
      this.form2.prdctuom = IyangOrder.uom
      this.form2.prdctprice = formatter.format(IyangOrder.amt)

      this.selected_item = IyangOrder
    },

    orderQty(MgaItems) {
      $('#qtyMdlOrder').modal('show')
      $('#modT').html('Select Quantity')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form2.prdctname = MgaItems.product_name
      this.form2.prdctfamily = MgaItems.product_family
      this.form2.prdctuom = MgaItems.uom
      this.form2.prdctprice = formatter.format(MgaItems.list_price_wtax)

      this.selected_item = MgaItems
    },

    async addToOrder1(selected_item) {
      selected_item.account_qty = this.form2.prdctqty
      selected_item.trans_code = selected_item.tran_no
      selected_item.itemcode = selected_item.itm_code
      selected_item.product_name = selected_item.item_desc
      selected_item.list_price_wtax = selected_item.amt
      selected_item.product_family = selected_item.itm_cat
      selected_item.check_transcode = this.selected_transcode

      axios
        .post(`/tele_ordering/additionalOrder`, selected_item)
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message:
                '<i class="fa fa-check"></i> Transaction has been updated!.',
              container: 'floating',
              timer: 5000
            })
            this.form2.prdctqty = 1
            $('#qtyMdlOrder1').modal('hide')
            $('#69').modal('hide')
            this.getResultsTrans()
          }
        })
        .catch(error => {})
    },

    async addToOrder(selected_item) {
      // console.log(selected_item, this.selected_transcode)
      selected_item.account_code = this.form1.acct_code
      selected_item.account_name = this.form1.acct_name
      selected_item.account_pmeth = this.form1.acct_paymnt_type
      selected_item.account_smcode = this.form1.acct_salesman_code
      selected_item.account_qty = this.form2.prdctqty
      selected_item.trans_code = this.form1.trans_code
      selected_item.check_transcode = this.selected_transcode

      axios
        .post(`/tele_ordering/additionalOrder`, selected_item)
        .then(({ data }) => {
          if (data.trim() != 'Success' && data.trim() != 'Error') {
            //console.log(data)
            this.selected_transcode = data
            //console.log(this.selected_transcode)
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message:
                '<i class="fa fa-check"></i> Transaction has been added!.',
              container: 'floating',
              timer: 5000
            })
            this.selected = null

            this.form2.prdctqty = 1
            $('#qtyMdlOrder').modal('hide')
            // $('#setupMdlOrder').modal('hide')
            this.getResultsTrans()
          }
          if (data.trim() == 'Success') {
            $.niftyNoty({
              type: 'info',
              icon: 'pli-cross icon-2x',
              message:
                '<i class="fa fa-check"></i> Transaction has been added!.',
              container: 'floating',
              timer: 5000
            })
            this.selected = null

            this.form2.prdctqty = 1
            $('#qtyMdlOrder').modal('hide')
            // $('#setupMdlOrder').modal('hide')
            this.getResultsTrans()
          }
          if (data.trim() == 'Error') {
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                "<i class='fa fa-exclamation-circle'></i>Error! No Salesman Code assigned.",
              container: 'floating',
              timer: 5000
            })

            $('#qtyMdlOrder').modal('hide')
            $('#setupMdlOrder').modal('hide')
            this.getResultsTrans()
            setTimeout(() => {
              window.location = '/tele_ordering'
            }, 3000)
          }
        })
        .catch(error => {})
    },

    details(MgaItems) {
      $('#setupMdl').modal('show')
      $('#MdlTitle12').html('Item Details')

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

    closeModal() {
      document.getElementById('close').click()
    },

    closeModal4() {
      document.getElementById('close').click()
      $('#setupMdl96').modal('hide')
      this.clearData()
    },

    clearData() {
      this.orderTable.clear().destroy()
      this.order = []

      this.form4.tran_no = ''
      this.form4.date_req = ''
      this.form4.date_app = ''
      this.form4.date_del = ''
      this.form4.account_code = ''
      this.form4.store_name = ''
      this.form4.p_meth = ''
      this.form4.itm_count = ''
      this.form4.tot_amt = ''
      this.form4.tot_del_amt = ''
      this.form4.tran_stat = ''
      this.form4.sm_name = ''
      this.form4.sm_code = ''
      this.form1.tran_no2 = ''
      this.form1.itm_code = ''
      this.form1.item_desc = ''
      this.form1.req_qty = ''
      this.form1.del_qty = ''
      this.form1.uom = ''
      this.form1.amt = ''
      this.form1.tot_amt2 = ''
      this.form1.itm_cat = ''
      this.form1.itm_stat = ''
    },

    btn_activation(id, status) {
      this.form.item_masterfiles_id = id
      this.form.status = status
      this.form
        .post('/activate_item')
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
    }
  },
  created() {
    this.retrieveContacts()
  },

  mounted() {
    setInterval(() => this.retrieveContacts(), 10000)
    // console.log('Component mounted.')
    this.getResults()
    this.getResultsTrans()
    this.getCategories()
    // this.getCustomers()
    this.$root.currentPage = this.$route.meta.name
    $('#container').css('position', 'relative')
  }
}
</script>
