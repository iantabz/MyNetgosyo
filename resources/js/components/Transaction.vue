<!-- @format -->

<template>
  <div id="page-content">
    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel panel-transaction">
      <div class="panel-body" style="padding:10px;">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size:20px;">
            <i class="fa fa-shopping-cart"></i> Transactions
          </h3>
        </div>

        <div class="tab-base">
          <!--Nav Tabs-->
          <!-- kaloy 2021-09-29 -->
          <!-- <ul class="nav nav-tabs nav-justified"> -->
          <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#demo-lft-tab-1" class="pb-4">
                Ongoing Transaction
                <ongoing-transactions-pending-count
                  class="pull-right"
                ></ongoing-transactions-pending-count>
                <!-- <span class="badge badge-warning">{{ items.total }}</span> -->
              </a>
            </li>

            <!-- Delivered Tab -->
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-5">
                Delivered
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
              </a>
            </li>

            <li>
              <a data-toggle="tab" href="#demo-lft-tab-6">
                Returned
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
              </a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-7">
                Cancelled
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
              </a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-8">
                Advanced Order
                <!-- <span class="badge badge-success">{{ items1.total }}</span> -->
                <advanced-orders-count
                  :key="subComponentsKey.advancedOrders"
                  class="pull-right"
                ></advanced-orders-count>
              </a>
            </li>
          </ul>
          <div class="tab-content" style="background-color:#ffffff; padding:0;">
            <!-- Ongoing Transactions Tab -->
            <div id="demo-lft-tab-1" class="tab-pane fade active in">
              <!-- style="background-color:#ffffff; padding:2px;" -->
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <!-- ongoingtrans_table_filter -->
                    <div class="row" style="padding:10px;">
                      <div class="col-sm-6">
                        <form
                          action="order"
                          @submit.prevent="submitformorder"
                          method="post"
                          enctype="multipart/form-data"
                          class="form-horizontal"
                        >
                          <div class="col-sm-6">
                            <label>Date From</label>
                            <datetime
                              input-class="form-control"
                              class="theme-orange"
                              v-model="dateFrom"
                              value-zone="Asia/Manila"
                              zone="Asia/Manila"
                              id="dt-picker-from-1"
                            ></datetime>
                          </div>
                          <div class="col-sm-6">
                            <label>Date To</label>
                            <datetime
                              input-class="form-control"
                              class="theme-orange"
                              v-model="dateTo"
                              value-zone="Asia/Manila"
                              zone="Asia/Manila"
                              id="dt-picker-to-1"
                            ></datetime>
                          </div>
                        </form>
                      </div>
                      <div class="col-sm-6">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                          <label class="pull-left">Search</label>
                          <input
                            type="text"
                            class="form-control"
                            @keyup="searchT"
                            v-model="searchTrans"
                            placeholder="Search here"
                          />
                        </div>
                      </div>
                    </div>

                    <!-- /ongoingtrans_table_filter -->
                    <div class="table-responsive" style="padding:5px;">
                      <!-- kaloy 2021-10-11 -->
                      <!-- refresh_ongoing -->
                      <div
                        style="padding-top:2px; padding-bottom:2px;background-color:#eeeeee;"
                        class="text-right"
                      >
                        <a
                          href="javascript:void(0)"
                          @click="
                            searchTrans = null;
                            getResults();
                          "
                          class="text-info"
                          title="Click to refresh list"
                          style="margin-right:7px;"
                          ><span class="fa fa-refresh"></span
                        ></a>
                      </div>

                      <table
                        class="table table-hover table-bordered table-striped table-vcenter tbl-transactions"
                        width="100%"
                        id="tbl-ongoing-trans"
                      >
                        <thead>
                          <tr>
                            <th>Transaction No.</th>
                            <th>Store Name</th>
                            <th>Ordered By</th>
                            <th>Date Ordered</th>
                            <!--kaloy 2022-04-07-->
                            <th>Total Amount <br />(Ordered)</th>
                            <th>Total Amount <br />(Served)</th>
                            <th>%</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!transaction.data.length">
                            <td colspan="8" class="text-center">
                              No data available
                            </td>
                          </tr>

                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="9" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>

                          <tr
                            v-for="MgaTransaction in transaction.data"
                            :key="MgaTransaction.id"
                            :style="
                              MgaTransaction.tot_amt !=
                                parseFloat(
                                  MgaTransaction.lineTotal.toFixed(2)
                                ) && MgaTransaction.tran_stat != 'Approved'
                                ? 'color:red;'
                                : ''
                            "
                          >
                            <!-- kaloy 09-22-21 -->
                            <td
                              @click="copyTextToClipboard($event)"
                              style="cursor: copy;"
                              title="Click to copy Transaction Number"
                            >
                              {{ MgaTransaction.tran_no }}
                            </td>
                            <td>{{ MgaTransaction.store_name }}</td>
                            <!-- kaloy 2021-09-28 -->
                            <td
                              :class="
                                MgaTransaction.order_by === 'Backend' ? '' : ''
                              "
                            >
                              <!-- <td><span class="badge badge-sm" :class="MgaTransaction.order_by==='Backend' ? 'badge-warning' : 'badge-primary'"> -->
                              {{ MgaTransaction.order_by }}
                            </td>
                            <td
                              :title="
                                humanizeDateDuration(MgaTransaction.date_req)
                              "
                            >
                              {{ MgaTransaction.date_req }}
                            </td>

                            <!--kaloy 2022-04-07-->
                            <td style="text-align:right;">
                              {{ MgaTransaction.tot_amt | toCurrency }}
                            </td>
                            <td style="text-align:right;">
                              {{ MgaTransaction.tot_del_amt | toCurrency }}
                            </td>

                            <!-- kaloy 2022-04-19 -->
                            <td>
                              {{
                                (
                                  (MgaTransaction.tot_del_amt /
                                    MgaTransaction.tot_amt) *
                                  100
                                ).toFixed(1)
                              }}%
                            </td>

                            <!--***************** tran_stat *************-->
                            <td
                              v-if="MgaTransaction.tran_stat === 'On-Process'"
                              style="color: #36bf73;"
                            >
                              <span class="badge badge-sm warning"> </span>
                              {{ MgaTransaction.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction.tran_stat === 'Approved'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction.tran_stat === 'Delivered'"
                              style="color: #0066cc;"
                            >
                              {{ MgaTransaction.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction.tran_stat === 'Pending'"
                              style="color: #ff7400;"
                            >
                              <span>Submitted</span>
                            </td>
                            <td
                              v-if="MgaTransaction.tran_stat === 'Returned'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction.tran_stat === 'Cancelled'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction.tran_stat }}
                            </td>
                            <!--***************** /tran_stat *************-->

                            <td style="width: 90px;">
                              &nbsp;
                              <button
                                @click="details(MgaTransaction)"
                                class="btn btn-info btn-xs"
                                title="View Order Details"
                              >
                                <i class="fa fa-list-alt"></i>
                              </button>
                              &nbsp;
                              <button
                                @click="
                                  orderDetails(
                                    MgaTransaction.tran_no,
                                    MgaTransaction.tot_amt
                                  )
                                "
                                class="btn btn-info btn-xs"
                                title="View Order Items"
                              >
                                <i class="fa fa-cart-arrow-down"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                        <!-- <tfoot>
                         <tr>
                           <th colspan="8">
                            <h4>Partial Total: {{ ongoingTransCurrentDatasetTotal | toCurrency }}</h4>
                           </th>
                         </tr>
                       </tfoot> -->
                      </table>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            Showing {{ transaction.from }} to
                            {{ transaction.to }} of
                            {{ transaction.total }} entries
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <pagination
                                style="margin: 0 0 20px 0;"
                                :limit="1"
                                :show-disabled="true"
                                :data="transaction"
                                @pagination-change-page="getResults"
                              ></pagination>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />
                <!-- <div class="row" style="text-align: right;"> -->

                <!-- //TODO: TOTAL_AMT_SECTION - Ongoing Transactions -->
                <!-- total_amount -->
                <div class="row">
                  <div
                    class="col-md-12"
                    style="text-align:right;display:flex;justify-content:right;"
                  >
                    <div
                      class="panel"
                      style="padding-bottom:0;margin-bottom:0;"
                    >
                      <div class="panel-body">
                        Total Amount (Ordered)
                        <br />
                        <h3 style="padding:0;margin:0;">
                          <span class="label label-warning">{{
                            total_amt_tran | toCurrency
                          }}</span>
                        </h3>
                      </div>
                    </div>
                    <div
                      class="panel"
                      style="padding-bottom:0;margin-bottom:0;"
                    >
                      <div class="panel-body">
                        Total Amount (Served)
                        <br />
                        <h3 style="padding:0;margin:0;">
                          <span class="label label-success">{{
                            total_amt_approved | toCurrency
                          }}</span>
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Delivered Tab Content -->
            <div id="demo-lft-tab-5" class="tab-pane fade">
              <div class="panel-body">
                <!-- Date Filters -->
                <div class="row" style="padding:10px;">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-9">
                        <form
                          action="order4"
                          @submit.prevent="submitformorder4"
                          method="post"
                          enctype="multipart/form-data"
                        >
                          <div class="col-md-6">
                            <label>Date From</label>
                            <datetime
                              v-model="dateFrom4"
                              value-zone="Asia/Manila"
                              zone="Asia/Manila"
                              input-class="form-control"
                              class="theme-orange"
                            ></datetime>
                          </div>
                          <div class="col-md-6">
                            <label>Date To</label>
                            <datetime
                              v-model="dateTo4"
                              value-zone="Asia/Manila"
                              zone="Asia/Manila"
                              input-class="form-control"
                              class="theme-orange"
                            ></datetime>
                          </div>
                        </form>
                      </div>
                      <div class="col-md-3">
                        <button @click="exportToExcelDelivered()">
                          Export to Excel
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <label>Search</label>
                      <input
                        type="text"
                        class="form-control"
                        @keyup="searchT4"
                        v-model="searchTrans4"
                        placeholder="Search here"
                      />
                    </div>
                  </div>
                </div>
                <!------------------------------------------------------------->
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive" style="padding">
                      <table
                        class="table table-hover table-bordered table-striped table-vcenter tbl-transactions"
                        width="100%"
                        id="tbl-delivered"
                      >
                        <thead>
                          <tr>
                            <th>Transaction No.</th>
                            <th>Store Name</th>
                            <th>Ordered By</th>
                            <th>Date Ordered</th>
                            <th>Date Delivered</th>
                            <th>Amount</th>
                            <!-- <th>Downloaded</th> -->
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!transaction4.data.length">
                            <td colspan="8" class="text-center">
                              No data available
                            </td>
                          </tr>

                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="8" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>

                          <tr
                            v-for="MgaTransaction4 in transaction4.data"
                            :key="MgaTransaction4.id"
                          >
                            <!-- kaloy 09-22-21 -->
                            <td
                              @click="copyTextToClipboard($event)"
                              style="cursor: copy;"
                              title="Click to copy Transaction Number"
                            >
                              {{ MgaTransaction4.tran_no }}
                            </td>
                            <td>{{ MgaTransaction4.store_name }}</td>
                            <td>{{ MgaTransaction4.order_by }}</td>
                            <td>{{ MgaTransaction4.date_req }}</td>
                            <td>{{ MgaTransaction4.date_del }}</td>

                            <td
                              style="text-align: right; font-weight: bold; color: #0000FF;"
                            >
                              {{ MgaTransaction4.tot_del_amt | toCurrency }}
                            </td>

                            <td>
                              &nbsp;
                              <button
                                @click="details4(MgaTransaction4)"
                                class="btn btn-info btn-xs"
                              >
                                <i class="fa fa-list-alt"></i>
                              </button>
                              &nbsp;
                              <button
                                @click="orderDetails4(MgaTransaction4.tran_no)"
                                class="btn btn-info btn-xs"
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
                            Showing {{ transaction4.from }} to
                            {{ transaction4.to }} of
                            {{ transaction4.total }} entries
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <pagination
                                style="margin: 0 0 20px 0;"
                                :limit="1"
                                :show-disabled="true"
                                :data="transaction4"
                                @pagination-change-page="getResults4"
                              ></pagination>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />

                <!-- total_amount -->
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <div class="btn-group btn-group-justified pull-right">
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-secondary">
                          Total Amount
                        </button>
                      </div>
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-info">
                          {{ total_amt_tran4 | toCurrency }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- old total amount layout -->
                <!-- <div class="row" style="text-align: right;">
                  <div class="col-md-11">
                    <div class="col-lg-9">
                      <h4 style="color: green;">Total Amount:</h4>
                    </div>
                    <div class="col-lg-2">
                      <h4 style="color: green;">
                        {{ total_amt_tran4 | toCurrency }}
                      </h4>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>

            <!-- Returned Tab -->
            <div id="demo-lft-tab-6" class="tab-pane fade">
              <div class="panel-body">
                <div class="row" style="padding:10px;">
                  <div class="col-md-6">
                    <form
                      action="order5"
                      @submit.prevent="submitformorder5"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="col-md-6">
                        <label>Date From</label>
                        <datetime
                          v-model="dateFrom5"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                          input-class="form-control"
                          class="theme-orange"
                        ></datetime>
                      </div>
                      <div class="col-md-6">
                        <label>Date To</label>
                        <datetime
                          v-model="dateTo5"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                          input-class="form-control"
                          class="theme-orange"
                        ></datetime>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <label>Search</label>
                      <input
                        type="text"
                        class="form-control"
                        @keyup="searchT5"
                        v-model="searchTrans5"
                        placeholder="Search here"
                      />
                    </div>
                  </div>
                </div>
                <!------------------------------------------------------------->
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table
                        class="table table-hover table-bordered table-striped table-vcenter tbl-transactions"
                        width="100%"
                      >
                        <thead>
                          <tr>
                            <th>Transaction No.</th>
                            <th>Store Name</th>
                            <th>Ordered By</th>
                            <th>Date Ordered</th>
                            <th>Total Amount</th>
                            <th>Downloaded</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!transaction5.data.length">
                            <td colspan="8" class="text-center">
                              No data available
                            </td>
                          </tr>

                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="8" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>

                          <tr
                            v-for="MgaTransaction5 in transaction5.data"
                            :key="MgaTransaction5.id"
                          >
                            <!-- kaloy 09-22-21 -->
                            <td
                              @click="copyTextToClipboard($event)"
                              style="cursor: copy;"
                              title="Click to copy Transaction Number"
                            >
                              {{ MgaTransaction5.tran_no }}
                            </td>
                            <td>{{ MgaTransaction5.store_name }}</td>
                            <td>{{ MgaTransaction5.order_by }}</td>
                            <td>{{ MgaTransaction5.date_req }}</td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'On-Process'"
                              style="text-align: right; font-weight: bold; color: #008000;"
                            >
                              {{ MgaTransaction5.tot_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Approved'"
                              style="text-align: right; font-weight: bold; color: #008000;"
                            >
                              {{ MgaTransaction5.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Delivered'"
                              style="text-align: right; font-weight: bold; color: #0000FF;"
                            >
                              {{ MgaTransaction5.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Pending'"
                              style="text-align: right; font-weight: bold; color: #ff4d00;"
                            >
                              {{ MgaTransaction5.tot_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Returned'"
                              style="text-align: right; font-weight: bold; color: #FF0000;"
                            >
                              {{ MgaTransaction5.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Cancelled'"
                              style="text-align: right; font-weight: bold; color: #FF0000;"
                            >
                              {{ MgaTransaction5.tot_amt | toCurrency }}
                            </td>
                            <td v-if="MgaTransaction5.isExported === 1">
                              <span>Yes</span>
                            </td>
                            <td v-if="MgaTransaction5.isExported === 0">
                              <span>No</span>
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'On-Process'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction5.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Approved'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction5.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Delivered'"
                              style="color: #0066cc;"
                            >
                              {{ MgaTransaction5.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Pending'"
                              style="color: #ff7400;"
                            >
                              <span>Submitted</span>
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Returned'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction5.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction5.tran_stat === 'Cancelled'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction5.tran_stat }}
                            </td>
                            <td>
                              &nbsp;
                              <button
                                @click="details5(MgaTransaction5)"
                                class="btn btn-info btn-xs"
                              >
                                <i class="fa fa-list-alt"></i>
                              </button>
                              &nbsp;
                              <button
                                @click="orderDetails5(MgaTransaction5.tran_no)"
                                class="btn btn-info btn-xs"
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
                            Showing {{ transaction5.from }} to
                            {{ transaction5.to }} of
                            {{ transaction5.total }} entries
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <pagination
                                style="margin: 0 0 20px 0;"
                                :limit="1"
                                :show-disabled="true"
                                :data="transaction5"
                                @pagination-change-page="getResults5"
                              ></pagination>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />

                <!-- total_amount -->
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <div class="btn-group btn-group-justified pull-right">
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-secondary">
                          Total Amount
                        </button>
                      </div>
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-info">
                          {{ total_amt_tran5 | toCurrency }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="row" style="text-align: right;">
                  <div class="col-md-11">
                    <div class="col-lg-9">
                      <h4 style="color: green;">Total Amount:</h4>
                    </div>
                    <div class="col-lg-2">
                      <h4 style="color: green;">
                        {{ total_amt_tran5 | toCurrency }}
                      </h4>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>

            <!-- Cancelled Tab -->
            <div id="demo-lft-tab-7" class="tab-pane fade">
              <div class="panel-body">
                <div class="row" style="padding:10px;">
                  <div class="col-md-6">
                    <form
                      action="order6"
                      @submit.prevent="submitformorder6"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="col-md-6">
                        <label>Date From</label>
                        <datetime
                          v-model="dateFrom6"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                          input-class="form-control"
                          class="theme-orange"
                        ></datetime>
                      </div>
                      <div class="col-md-6">
                        <label>Date To</label>
                        <datetime
                          v-model="dateTo6"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                          input-class="form-control"
                          class="theme-orange"
                        ></datetime>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <label>Search</label>
                      <input
                        type="text"
                        class="form-control"
                        @keyup="searchT6"
                        v-model="searchTrans6"
                        placeholder="Search here"
                      />
                    </div>
                  </div>
                </div>
                <!------------------------------------------------------------->
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table
                        class="table table-hover table-bordered table-striped table-vcenter tbl-transactions"
                        width="100%"
                      >
                        <thead>
                          <tr>
                            <th>Transaction No.</th>
                            <th>Store Name</th>
                            <th>Ordered By</th>
                            <th>Date Ordered</th>
                            <th>Total Amount</th>
                            <th>Downloaded</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!transaction6.data.length">
                            <td colspan="8" class="text-center">
                              No data available
                            </td>
                          </tr>

                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="8" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>

                          <tr
                            v-for="MgaTransaction6 in transaction6.data"
                            :key="MgaTransaction6.id"
                          >
                            <!-- kaloy 09-22-21 -->
                            <td
                              @click="copyTextToClipboard($event)"
                              style="cursor: copy;"
                              title="Click to copy Transaction Number"
                            >
                              {{ MgaTransaction6.tran_no }}
                            </td>
                            <td>{{ MgaTransaction6.store_name }}</td>
                            <td>{{ MgaTransaction6.order_by }}</td>
                            <td>{{ MgaTransaction6.date_req }}</td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'On-Process'"
                              style="text-align: right; font-weight: bold; color: #008000;"
                            >
                              {{ MgaTransaction6.tot_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Approved'"
                              style="text-align: right; font-weight: bold; color: #008000;"
                            >
                              {{ MgaTransaction6.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Delivered'"
                              style="text-align: right; font-weight: bold; color: #0000FF;"
                            >
                              {{ MgaTransaction6.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Pending'"
                              style="text-align: right; font-weight: bold; color: #ff4d00;"
                            >
                              {{ MgaTransaction6.tot_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Returned'"
                              style="text-align: right; font-weight: bold; color: #FF0000;"
                            >
                              {{ MgaTransaction6.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Cancelled'"
                              style="text-align: right; font-weight: bold; color: #FF0000;"
                            >
                              {{ MgaTransaction6.tot_amt | toCurrency }}
                            </td>
                            <td v-if="MgaTransaction6.isExported === 1">
                              <span>Yes</span>
                            </td>
                            <td v-if="MgaTransaction6.isExported === 0">
                              <span>No</span>
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'On-Process'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction6.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Approved'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction6.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Delivered'"
                              style="color: #0066cc;"
                            >
                              {{ MgaTransaction6.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Pending'"
                              style="color: #ff7400;"
                            >
                              <span>Submitted</span>
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Returned'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction6.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction6.tran_stat === 'Cancelled'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction6.tran_stat }}
                            </td>
                            <td>
                              &nbsp;
                              <button
                                @click="details6(MgaTransaction6)"
                                class="btn btn-info btn-xs"
                              >
                                <i class="fa fa-list-alt"></i>
                              </button>
                              &nbsp;
                              <button
                                @click="orderDetails6(MgaTransaction6.tran_no)"
                                class="btn btn-info btn-xs"
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
                            Showing {{ transaction6.from }} to
                            {{ transaction6.to }} of
                            {{ transaction6.total }} entries
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <pagination
                                style="margin: 0 0 20px 0;"
                                :limit="1"
                                :show-disabled="true"
                                :data="transaction6"
                                @pagination-change-page="getResults6"
                              ></pagination>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />
                <!-- total_amount -->
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <div class="btn-group btn-group-justified pull-right">
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-secondary">
                          Total Amount
                        </button>
                      </div>
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-info">
                          {{ total_amt_tran6 | toCurrency }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="row" style="text-align: right;">
                  <div class="col-md-11">
                    <div class="col-lg-9">
                      <h4 style="color: green;">Total Amount:</h4>
                    </div>
                    <div class="col-lg-2">
                      <h4 style="color: green;">
                        {{ total_amt_tran6 | toCurrency }}
                      </h4>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>

            <!-- Advanced Order Tab -->
            <div id="demo-lft-tab-8" class="tab-pane fade">
              <div class="panel-body">
                <div class="row" style="padding:10px;">
                  <div class="col-md-6">
                    <form
                      action="order7"
                      @submit.prevent="submitformorder7"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="col-md-6">
                        <label>Date From</label>
                        <datetime
                          v-model="dateFrom7"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                          input-class="form-control"
                          class="theme-orange"
                        ></datetime>
                      </div>
                      <div class="col-md-6">
                        <label>Date To</label>
                        <datetime
                          v-model="dateTo7"
                          value-zone="Asia/Manila"
                          zone="Asia/Manila"
                          input-class="form-control"
                          class="theme-orange"
                        ></datetime>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <label>Search</label>
                      <input
                        type="text"
                        class="form-control"
                        @keyup="searchT7"
                        v-model="searchTrans7"
                        placeholder="Search here"
                      />
                    </div>
                  </div>
                </div>
                <!------------------------------------------------------------->
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table
                        class="table table-hover table-bordered table-striped table-vcenter tbl-transactions"
                        width="100%"
                        id="tbl-advanced"
                      >
                        <thead>
                          <tr>
                            <th>Transaction No.</th>
                            <th>Store Name</th>
                            <th>Ordered By</th>
                            <th>Date Ordered</th>
                            <th>Total Amount</th>
                            <th>Downloaded</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!transaction7.data.length">
                            <td colspan="8" class="text-center">
                              No data available
                            </td>
                          </tr>

                          <!-- kaloy 2021-09-29 -->
                          <tr v-if="isLoadingTextVisible === 1">
                            <td colspan="8" class="text-center text-success">
                              Fetching data from the server, please wait...
                              <spinner></spinner>
                            </td>
                          </tr>

                          <tr
                            v-for="MgaTransaction7 in transaction7.data"
                            :key="MgaTransaction7.id"
                          >
                            <!-- kaloy 09-22-21 -->
                            <td
                              @click="copyTextToClipboard($event)"
                              style="cursor: copy;"
                              title="Click to copy Transaction Number"
                            >
                              {{ MgaTransaction7.tran_no }}
                            </td>
                            <td>{{ MgaTransaction7.store_name }}</td>
                            <td>{{ MgaTransaction7.order_by }}</td>
                            <td>{{ MgaTransaction7.date_req }}</td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'On-Process'"
                              style="text-align: right; font-weight: bold; color: #008000;"
                            >
                              {{ MgaTransaction7.tot_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Approved'"
                              style="text-align: right; font-weight: bold; color: #008000;"
                            >
                              {{ MgaTransaction7.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Delivered'"
                              style="text-align: right; font-weight: bold; color: #0000FF;"
                            >
                              {{ MgaTransaction7.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Pending'"
                              style="text-align: right; font-weight: bold; color: #ff4d00;"
                            >
                              {{ MgaTransaction7.tot_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Returned'"
                              style="text-align: right; font-weight: bold; color: #FF0000;"
                            >
                              {{ MgaTransaction7.tot_del_amt | toCurrency }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Cancelled'"
                              style="text-align: right; font-weight: bold; color: #FF0000;"
                            >
                              {{ MgaTransaction7.tot_amt | toCurrency }}
                            </td>
                            <td v-if="MgaTransaction7.isExported === 1">
                              <span>Yes</span>
                            </td>
                            <td v-if="MgaTransaction7.isExported === 0">
                              <span>No</span>
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'On-Process'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction7.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Approved'"
                              style="color: #008000;"
                            >
                              {{ MgaTransaction7.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Delivered'"
                              style="color: #0066cc;"
                            >
                              {{ MgaTransaction7.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Pending'"
                              style="color: #ff7400;"
                            >
                              <span>Submitted</span>
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Returned'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction7.tran_stat }}
                            </td>
                            <td
                              v-if="MgaTransaction7.tran_stat === 'Cancelled'"
                              style="color: #ff3333;"
                            >
                              {{ MgaTransaction7.tran_stat }}
                            </td>
                            <td>
                              &nbsp;
                              <button
                                @click="details7(MgaTransaction7)"
                                class="btn btn-info btn-xs"
                              >
                                <i class="fa fa-list-alt"></i>
                              </button>
                              &nbsp;
                              <button
                                @click="orderDetails7(MgaTransaction7.tran_no)"
                                class="btn btn-info btn-xs"
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
                            Showing {{ transaction7.from }} to
                            {{ transaction7.to }} of
                            {{ transaction7.total }} entries
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <pagination
                                style="margin: 0 0 20px 0;"
                                :limit="1"
                                :show-disabled="true"
                                :data="transaction7"
                                @pagination-change-page="getResults7"
                              ></pagination>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />

                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <div class="btn-group btn-group-justified pull-right">
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-secondary">
                          Total Amount
                        </button>
                      </div>
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-info">
                          {{ total_amt_tran7 | toCurrency }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="row" style="text-align: right;">
                  <div class="col-md-11">
                    <div class="col-lg-9">
                      <h4 style="color: green;">Total Amount:</h4>
                    </div>
                    <div class="col-lg-2">
                      <h4 style="color: green;">
                        {{ total_amt_tran7 | toCurrency }}
                      </h4>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ************************************************************************************* -->
    <!-- ************************************************************************************* -->
    <!-- ************************************************************************************* -->
    <!-- ************************************************************************************* -->
    <!-- *****************************************   MODALS   ******************************** -->
    <!-- ************************************************************************************* -->
    <!-- ************************************************************************************* -->
    <!-- ************************************************************************************* -->
    <!----------------------------------Form Modal------------------------------------------->

    <!-- #setupMdl () -->
    <div
      class="modal fade"
      id="setupMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="true"
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
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="tran_no">Transaction No.</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.tran_no"
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
                      v-model="form.store_name"
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
                      v-model="form.account_code"
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
                      v-model="form.sm_name"
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
                      v-model="form.sm_code"
                      id="sm_code"
                      name="sm_code"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="itm_count">Ordered Item Count</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.itm_count"
                      id="itm_count"
                      name="itm_count"
                    />
                  </div>
                </div>
                <!-- kaloy 2021-09-28 -->
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="itm_count">Delivered Item Count</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.itm_del_count"
                      id="itm_del_count"
                      name="itm_del_count"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="p_meth">Payment Method</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.p_meth"
                      id="p_meth"
                      name="p_meth"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="tot_amt">Total Ordered Amount</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.tot_amt"
                      id="tot_amt"
                      name="tot_amt"
                      style="text-align: right; color: red;"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label
                      for="tot_del_amt"
                      v-if="form.tran_stat === 'Delivered'"
                      >Total Amount ({{ form.tran_stat }})</label
                    >
                    <label
                      for="tot_del_amt"
                      v-if="form.tran_stat !== 'Delivered'"
                      >Total Amount (Approved)</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.tot_del_amt"
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
                      v-model="form.tran_stat"
                      id="tran_stat"
                      name="tran_stat"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="date_req">Date Request</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.date_req"
                      id="date_req"
                      name="date_req"
                    />
                  </div>
                </div>
                <!-- kaloy 2021-09-28 -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="export_date">Export Date</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.export_date"
                      id="export_date"
                      name="export_date"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <!-- kaloy 2021-09-28 -->
                    <!-- <label for="date_app">Export / Import Date</label> -->
                    <label for="date_app">Import Date</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.date_app"
                      id="date_app"
                      name="date_app"
                    />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="date_del">Date Delivered</label>

                    <input
                      type="text"
                      class="form-control"
                      v-model="form.date_del"
                      id="date_del"
                      name="date_del"
                    />
                  </div>
                </div>
              </div>
              <!-- kaloy 2021-10-05 -->
              <!-- order_timeline -->
              <br />
              <!-- ot_new -->
              <div class="row">
                <div class="col-md-12 text-center">
                  <h5 class="text-dark">Order Timeframe (Test Only)</h5>
                  <hr />
                </div>
                <div class="col-md-12">
                  <div class="col-md-2" style="margin-bottom:8px;">
                    <div class="bg-warningx">
                      <h4 style="margin:0;padding:0;">
                        <span class="badge badge-info rounded">1</span> Ordered
                      </h4>
                    </div>
                    <div style="padding:4px 4px 4px 26px;" class="bg-warningx">
                      <em>{{ form.date_req }}</em>
                    </div>
                  </div>
                  <div class="col-md-2" style="margin-bottom:8px;">
                    <div class="bg-warningx">
                      <h4 style="margin:0;padding:0;">
                        <span class="badge badge-info rounded">2</span>
                        Processed
                      </h4>
                    </div>
                    <div style="padding:4px 4px 4px 26px;" class="bg-warningx">
                      <em>{{
                        form.export_date != null
                          ? form.export_date
                          : "Pending..."
                      }}</em>
                      <h6 class="text-info" style="padding:0;margin:0;">
                        {{ timeframeUntilProcessing }}
                      </h6>
                    </div>
                  </div>
                  <div class="col-md-2" style="margin-bottom:8px;">
                    <div class="bg-warningx">
                      <h4 style="margin:0;padding:0;">
                        <span class="badge badge-info rounded">3</span> Approved
                      </h4>
                    </div>
                    <div style="padding:4px 4px 4px 26px;" class="bg-warningx">
                      <em>{{
                        form.date_app != null ? form.date_app : "Pending..."
                      }}</em>
                      <h6 class="text-info" style="padding:0;margin:0;">
                        {{ timeframeUntilApproval }}
                      </h6>
                    </div>
                  </div>
                  <div class="col-md-2" style="margin-bottom:8px;">
                    <div class="bg-warningx">
                      <h4 style="margin:0;padding:0;">
                        <span class="badge badge-info rounded">4</span>
                        Delivered
                      </h4>
                    </div>
                    <div style="padding:4px 4px 4px 26px;" class="bg-warningx">
                      <em>{{
                        form.date_del != null ? form.date_del : "Pending..."
                      }}</em>
                      <h6 class="text-info" style="padding:0;margin:0;">
                        {{ timeframeUntilDelivery }}
                      </h6>
                    </div>
                  </div>
                  <div class="col-md-4" style="margin-bottom:8px;">
                    <div class="bg-warningx">
                      <h4 style="margin:0;padding:0;">
                        <span class="badge badge-success rounded"
                          >&nbsp;&nbsp;</span
                        >
                        Total Rendered Time
                      </h4>
                    </div>
                    <div style="padding:4px 4px 4px 26px;" class="bg-warningx">
                      <h6 class="text-info" style="padding:0;margin:0;">
                        {{ timeframeOrderFulfillment }}
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ot_old -->
              <!-- <div class="row">
                <div class="col-md-6">
                  <h5>Timeframe (Test)</h5>
                  <ul class="list-group">
                    <li class="list-group-item">Order &nbsp;
                      <strong class="text-success">{{ form.date_req }}</strong>
                    </li>
                    <li class="list-group-item">Processing &nbsp;
                      <strong class="text-success">{{ form.export_date!=null?form.export_date:'Pending...' }}</strong>
                      <span class="badge badge-info">{{ timeframeUntilProcessing }}</span>
                    </li>
                    <li class="list-group-item">Approval &nbsp;
                      <strong class="text-success">{{ form.date_app!=null?form.date_app:'Pending...' }}</strong>
                      <span class="badge badge-info">{{ timeframeUntilApproval }}</span>
                    </li>
                    <li class="list-group-item">Delivery &nbsp;
                      <strong class="text-success">{{ form.date_del!=null?form.date_del:'Pending...' }}</strong>
                      <span class="badge badge-info">{{ timeframeUntilDelivery }}</span>
                    </li>
                    <li class="list-group-item">Order Fulfillment Rendered Time 
                      <span class="badge badge-primary">{{ timeframeOrderFulfillment }}</span>
                    </li>
                  </ul>
                </div>
              </div> -->
              <!-- /order_timeline -->
            </div>
            <!-- /modal body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Close
              </button>
              <!-- <button type="submit" class="btn btn-primary" id="submitformreupload"></button> -->
            </div>
          </form>
        </div>
      </div>
    </div>

    <!----------------------------------Form Modal 1------------------------------------------->

    <!-- //? Ongoing Transactions -->
    <!-- //? View Order Items Modal -->
    <div
      class="modal fade"
      id="setupMdl1"
      tabindex="-1"
      role="dialog"
      data-backdrop="false"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog"
        role="dialog"
        style="overflow-y:initial !important; width:90vw;"
      >
        <div class="modal-content" style="border:2px solid #f07335;">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle1">Modal title</h5>
            <button
              type="button"
              class="btn btn-danger close"
              @click="closeModal"
            >
              <!-- <span aria-hidden="true">&times;</span> -->
              Close
            </button>
          </div>
          <div class="panel">
            <div class="panel-body">
              <!-- Table -->
              <div
                class="table-responsive"
                style="height:65vh; overflow-y:auto;"
              >
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
                    <tr
                      v-for="MgaOrder in order"
                      :key="MgaOrder.doc_no"
                      :style="
                        MgaOrder.manually_included == 1 ? 'color:#998f09;' : ''
                      "
                      :title="
                        MgaOrder.manually_included == 1
                          ? 'Manually included item'
                          : ''
                      "
                    >
                      <!-- kaloy 09-22-21 -->
                      <td
                        @click="copyTextToClipboard($event)"
                        style="cursor: copy;"
                        title="Click to copy Transaction Number"
                      >
                        {{ MgaOrder.tran_no }}
                      </td>
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
                      <!-- actions -->
                      <td>
                        <button
                          @click="detailsOrder(MgaOrder.doc_no)"
                          class="btn btn-info btn-xs"
                        >
                          <i class="fa fa-list-alt"></i>
                        </button>

                        <a
                          href="javascript:void(0)"
                          data-toggle="modal"
                          data-target="#mdl_qty_adjustment"
                          v-if="
                            MgaOrder.tran_stat == 'Pending' &&
                              MgaOrder.order_by == 'Backend'
                          "
                          class="btn btn-info btn-xs"
                          @click="
                            qty_adjustment.tran_no = MgaOrder.tran_no;
                            qty_adjustment.item_code = MgaOrder.itm_code;
                            qty_adjustment.uom = MgaOrder.uom;
                            qty_adjustment.amount = MgaOrder.amt;
                            qty_adjustment.prev_qty = MgaOrder.req_qty;
                            qty_adjustment.new_qty = null;
                            qty_adjustment.mankey = '';
                          "
                        >
                          <i class="fa fa-edit"></i>
                        </a>
                      </td>
                      <!-- /actions -->
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- Amount -->
              <br />
              <div class="row" style="background-color:#f5f5f5;">
                <div class="col-md-6" style="text-align:right;"></div>
                <div class="col-md-3" style="text-align:right;">
                  <h4>
                    <span>Total Amount:</span>
                    <span>{{ total_amt_line | toCurrency }}</span>
                  </h4>
                </div>
                <div class="col-md-3" style="text-align:right;">
                  <h4>
                    <span>Total Amount Served:</span>
                    <span>{{ total_amt_served | toCurrency }}</span>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- delivered_order_items -->
    <div
      class="modal fade"
      id="setupMdl6"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle6">Modal title</h5>
            <button type="button" class="close" @click="closeModal6">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="panel">
            <div class="panel-body">
              <div class="table-responsive">
                <table
                  id="OrderTable4"
                  class="table table-hover table-bordered table-striped table-vcenter"
                  width="100%"
                  style="font-size:small;"
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
                      <!-- kaloy 09-22-21 -->
                      <td
                        @click="copyTextToClipboard($event)"
                        style="cursor: copy;"
                        title="Click to copy Transaction Number"
                      >
                        {{ MgaOrder.tran_no }}
                      </td>
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
                          @click="detailsOrder4(MgaOrder.doc_no)"
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
              <!-- <div class="row" style="text-align: right;">
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
              </div> -->

              <div class="row">
                <div class="col-md-4" style="text-align:right;"></div>
                <div class="col-md-4" style="text-align:right;">
                  <h4>
                    <span>Total Amount:</span>
                    <span>{{ total_amt_line | toCurrency }}</span>
                  </h4>
                </div>
                <div class="col-md-4" style="text-align:right;">
                  <h4>
                    <span>Total Amount Delivered:</span>
                    <span>{{ total_amt_served | toCurrency }}</span>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- #setupMdl7 () -->
    <div
      class="modal fade"
      id="setupMdl7"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle7">Modal title</h5>
            <button type="button" class="close" @click="closeModal7">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="panel">
            <div class="panel-body">
              <div class="table-responsive">
                <table
                  id="OrderTable5"
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
                      <!-- kaloy 09-22-21 -->
                      <td
                        @click="copyTextToClipboard($event)"
                        style="cursor: copy;"
                        title="Click to copy Transaction Number"
                      >
                        {{ MgaOrder.tran_no }}
                      </td>
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
                          @click="detailsOrder5(MgaOrder.doc_no)"
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

    <!-- #setupMdl8 () -->
    <div
      class="modal fade"
      id="setupMdl8"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle8">Modal title</h5>
            <button type="button" class="close" @click="closeModal8">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="panel">
            <div class="panel-body">
              <div class="table-responsive">
                <table
                  id="OrderTable6"
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
                      <!-- kaloy 09-22-21 -->
                      <td
                        @click="copyTextToClipboard($event)"
                        style="cursor: copy;"
                        title="Click to copy Transaction Number"
                      >
                        {{ MgaOrder.tran_no }}
                      </td>
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
                          @click="detailsOrder6(MgaOrder.doc_no)"
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

    <!-- #setupMdl9 () -->
    <div
      class="modal fade"
      id="setupMdl9"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MdlTitle9">Modal title</h5>
            <button type="button" class="close" @click="closeModal9">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="panel">
            <div class="panel-body">
              <div class="table-responsive">
                <table
                  id="OrderTable7"
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
                      <!-- kaloy 09-22-21 -->
                      <td
                        @click="copyTextToClipboard($event)"
                        style="cursor: copy;"
                        title="Click to copy Transaction Number"
                      >
                        {{ MgaOrder.tran_no }}
                      </td>
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
                          @click="detailsOrder7(MgaOrder.doc_no)"
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

    <!----------------------------------Form Modal 2------------------------------------------->

    <!-- #setupMdl2 () -->
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
          <div></div>
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
                      v-model="form1.tran_no2"
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
                      v-model="form1.item_desc"
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
                      v-model="form1.itm_code"
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
                      v-model="form1.itm_cat"
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
                      v-model="form1.req_qty"
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
                      v-model="form1.del_qty"
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
                      v-model="form1.uom"
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
                      v-model="form1.amt"
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
                      v-model="form1.tot_amt2"
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
                      v-model="form1.itm_stat"
                      id="itm_stat"
                      name="itm_stat"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Close
              </button>
              <!-- <button type="submit" class="btn btn-primary" id="submitformreupload"></button> -->
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- #mdl_qty_adjustment -->
    <div
      class="modal fade"
      id="mdl_qty_adjustment"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-sm" role="dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Quantity Adjustment</h5>
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
          <div class="modal-body">
            <div>
              <div class="row">
                <div class="col-md-6">
                  Transaction #:
                </div>
                <div class="col-md-6">
                  <strong>{{ qty_adjustment.tran_no }}</strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  Item Code:
                </div>
                <div class="col-md-6">
                  <strong>{{ qty_adjustment.item_code }}</strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  UOM:
                </div>
                <div class="col-md-6">
                  <strong>{{ qty_adjustment.uom }}</strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  Prev Quantity:
                </div>
                <div class="col-md-6">
                  <strong>{{ qty_adjustment.prev_qty }}</strong>
                </div>
              </div>
            </div>
            <br />
            <div>
              <span>New Quantity</span><br />
              <input
                type="number"
                class="form-control"
                min="1"
                v-model="qty_adjustment.new_qty"
              />
            </div>
            <hr />
            <div>
              <span>Manager's Key</span><br />
              <input
                type="password"
                class="form-control"
                v-model="qty_adjustment.mankey"
              />
            </div>
            <br />
            <button
              class="btn btn-success btn-block"
              @click="submitQtyAdjustment()"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
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
@media screen and (max-width: 768px) {
  ul.nav-tabs > li {
    float: none;
  }

  /* #div-total-amt h4 {
  } */
  div.tab-content div.panel-body {
    padding: 2px;
  }
  div.tab-content div.panel-body form.row {
    padding-top: 8px;
  }

  /* kaloy 2021-09-30 */
  div#div-total-amt {
    display: block;
    clear: both;
    width: 100%;
  }
  div#div-total-amt h4 {
    display: block;
  }

  /* kaloy 2021-10-08 */
  /* datepicker */
  .theme-orange {
    padding-bottom: 10px;
  }
}
@media screen and (min-width: 992px) {
  .modal-lg {
    width: 1250px; /* New width for large modal */
    height: 600px;
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

/* order timeline */

/* kaloy 2021-10-14 */
.nav-tabs li.active {
  border-bottom: 3px solid #ff5722;
}
</style>

<script>
/** @format */
import Vue from 'vue'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import { serialize } from 'object-to-formdata'
import _ from 'lodash'
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.min.css'
import moment from 'moment'
import { DateTime } from 'luxon'
import AdvancedOrdersCount from './transactions/AdvancedOrdersCount.vue'

import { mapGetters, mapActions } from 'vuex'


Vue.use(require('vue-moment'))
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
      transaction: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },

      // mao ni sa delivered transactions (inatay hahaha)
      transaction4: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },

      transaction5: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      transaction6: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      transaction7: {
        image: '',
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      order: [],
      form: new Form({
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
        sm_code: '',
        // kaloy 2021-09-28
        export_date:'',
        itm_del_count:''
      }),
      form1: new Form({
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
      dateFrom: DateTime.local().toString(),
      dateFrom4: DateTime.local().toString(),
      dateFrom5: DateTime.local().toString(),
      dateFrom6: DateTime.local().toString(),
      dateFrom7: DateTime.local().toString(),
      dateTo: DateTime.local().toString(),
      dateTo4: DateTime.local().toString(),
      dateTo5: DateTime.local().toString(),
      dateTo6: DateTime.local().toString(),
      dateTo7: DateTime.local().toString(),
      order_details: [],
      searchTrans: null,
      searchTrans4: null,
      searchTrans5: null,
      searchTrans6: null,
      searchTrans7: null,
      searchItemLog: null,

      // ? Ongoing Trans' Total Amount(Ordered)
      total_amt_tran: 0,
      // ? Ongoing Trans' Total Amount(Approved)
      total_amt_approved: 0,

      total_amt_tran4: 0,
      total_amt_tran5: 0,
      total_amt_tran6: 0,
      total_amt_tran7: 0,
      total_amt_line: 0,

      //? total amount served (Ongoing Trans' View Order Items Modal)
      //? per transaction
      total_amt_served: 0,

      orderTable: {},
      dateActive: false,
      dateActive4: false,
      dateActive5: false,
      dateActive6: false,
      dateActive7: false,
      // kaloy 2021-09-29
      // 1=true, 0=false
      isLoadingTextVisible: 1,
      // ongoingTransCurrentDatasetTotal: 0,
      // kaloy 2021-10-06
      subComponentsKey: {
        advancedOrders: '0'
      },
      // methodCallCount: {
      //   getResults: 0
      // },
      isFirstTimePageEntry: true,

      // kaloy 2022-05-27
      qty_adjustment: {
        tran_no: '',
        item_code: '',
        uom: '',
        amount: 0.00,
        prev_qty: 0,
        new_qty: null,
        mankey: '',
      },
    }
  },
  components: {
    datetime: Datetime,
    'advanced-orders-count': AdvancedOrdersCount
  },
  watch: {
    // ongoing transactions
    dateFrom() {
      // console.log('Calling getResults() from dateFrom() watch method')
      // if(this.isFirstTimePageEntry === false) {
        this.getResults()
      // }
      // this.isFirstTimePageEntry = false
    },
    dateFrom4() {
      this.getResults4()
    },
    dateFrom5() {
      this.getResults5()
    },
    dateFrom6() {
      this.getResults6()
    },
    dateFrom7() {
      this.getResults7()
    },
     // ongoing transactions
    dateTo() {
      // console.log('Calling getResults() from dateTo() watch method')
      if(this.isFirstTimePageEntry === false) {
        this.getResults()
      }
      this.isFirstTimePageEntry = false
    },
    dateTo4() {
      this.getResults4()
    },
    dateTo5() {
      this.getResults5()
    },
    dateTo6() {
      this.getResults6()
    },
    dateTo7() {
      this.getResults7()
    },
    // transaction() {
    //   this.subComponentsKey.advancedOrders = Math.random(1000000) * Math.random(9000000)
    // }

    // kaloy 2021-10-25
    getOngoingPendingCount() {
      // console.log('Calling getResults() from getOngoingPendingCount() watch method!')
    //   if(this.isFirstTimePageEntry === false) {
        this.getResults()
    //   }
    //   this.isFirstTimePageEntry = false
      // this.getResults()
    },
    getAdvancedOrdersCount() {
      // console.log('Calling getResults7() from getAdvancedOrdersCount() watch method!')
      this.getResults7()
    }

  },

  methods: {
    searchT() {
      this.searchForTrans(this.searchTrans, this)
    },
    searchT4() {
      this.searchForTrans4(this.searchTrans4, this)
    },

    searchT5() {
      this.searchForTrans5(this.searchTrans5, this)
    },

    searchT6() {
      this.searchForTrans6(this.searchTrans6, this)
    },

    searchT7() {
      this.searchForTrans7(this.searchTrans7, this)
    },

    searchForTrans: _.debounce((searchT, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction?dateFrom=${btoa(
            vm.dateFrom
          )}&dateTo=${btoa(vm.dateTo)}&name=${searchT}&dateActive=${
            vm.dateActive
          }&page=1`
        )
        .then(response => {
          vm.transaction = response.data

          if (searchT === '') {
            if (vm.dateActive === true) {
              vm.total_amt_tran = 0

              vm.getTotalAmount(vm.dateFrom, vm.dateTo, searchT, vm.dateActive)
            } else {
              vm.getAllTotalAmount()
            }
          } else {
            vm.total_amt_tran = 0

            vm.getTotalAmount(vm.dateFrom, vm.dateTo, searchT, vm.dateActive)
          }

        })
    }, 500),

    searchForTrans4: _.debounce((searchT4, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction4?dateFrom=${btoa(
            vm.dateFrom4
          )}&dateTo=${btoa(vm.dateTo4)}&name=${searchT4}&dateActive=${
            vm.dateActive4
          }&page=1`
        )
        .then(response => {
          vm.transaction4 = response.data

          if (searchT4 === '') {
            if (vm.dateActive4 === true) {
              vm.total_amt_tran4 = 0

              vm.getTotalAmountDel(vm.dateFrom4, vm.dateTo4, searchT4, vm.dateActive4)
            } else {
              vm.getDeliveredTotalAmount()
            }
          } else {
            vm.total_amt_tran4 = 0

            vm.getTotalAmountDel(vm.dateFrom4, vm.dateTo4, searchT4, vm.dateActive4)
          }
        })
    }, 500),

    searchForTrans5: _.debounce((searchT5, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction5?dateFrom=${btoa(
            vm.dateFrom5
          )}&dateTo=${btoa(vm.dateTo5)}&name=${searchT5}&dateActive=${
            vm.dateActive5
          }&page=1`
        )
        .then(response => {
          vm.transaction5 = response.data

          if (searchT5 === '') {
            if (vm.dateActive5 === true) {
              vm.total_amt_tran5 = 0

              vm.transaction5.data.forEach(datas => {
                if (datas['tran_stat'] === 'Pending') {
                  vm.total_amt_tran5 =
                    vm.total_amt_tran5 + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'On-Process') {
                  vm.total_amt_tran5 =
                    vm.total_amt_tran5 + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'Approved') {
                  vm.total_amt_tran5 =
                    vm.total_amt_tran5 + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Delivered') {
                  vm.total_amt_tran5 =
                    vm.total_amt_tran5 + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Returned') {
                  vm.total_amt_tran5 =
                    vm.total_amt_tran5 + parseFloat(datas['tot_del_amt'])
                }
              })
            } else {
              vm.getReturnedTotalAmount()
            }
          } else {
            vm.total_amt_tran5 = 0

            vm.transaction5.data.forEach(datas => {
              if (datas['tran_stat'] === 'Pending') {
                vm.total_amt_tran5 =
                  vm.total_amt_tran5 + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'On-Process') {
                vm.total_amt_tran5 =
                  vm.total_amt_tran5 + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'Approved') {
                vm.total_amt_tran5 =
                  vm.total_amt_tran5 + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Delivered') {
                vm.total_amt_tran5 =
                  vm.total_amt_tran5 + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Returned') {
                vm.total_amt_tran5 =
                  vm.total_amt_tran5 + parseFloat(datas['tot_del_amt'])
              }
            })
          }
        })
    }, 500),

    searchForTrans6: _.debounce((searchT6, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction6?dateFrom=${btoa(
            vm.dateFrom6
          )}&dateTo=${btoa(vm.dateTo6)}&name=${searchT6}&dateActive=${
            vm.dateActive6
          }&page=1`
        )
        .then(response => {
          vm.transaction6 = response.data

          if (searchT6 === '') {
            if (vm.dateActive6 === true) {
              vm.total_amt_tran6 = 0

              vm.transaction6.data.forEach(datas => {
                if (datas['tran_stat'] === 'Pending') {
                  vm.total_amt_tran6 =
                    vm.total_amt_tran6 + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'On-Process') {
                  vm.total_amt_tran6 =
                    vm.total_amt_tran6 + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'Approved') {
                  vm.total_amt_tran6 =
                    vm.total_amt_tran6 + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Delivered') {
                  vm.total_amt_tran6 =
                    vm.total_amt_tran6 + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Returned') {
                  vm.total_amt_tran6 =
                    vm.total_amt_tran6 + parseFloat(datas['tot_del_amt'])
                }
              })
            } else {
              vm.getCancelledTotalAmount()
            }
          } else {
            vm.total_amt_tran6 = 0

            vm.transaction6.data.forEach(datas => {
              if (datas['tran_stat'] === 'Pending') {
                vm.total_amt_tran6 =
                  vm.total_amt_tran6 + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'On-Process') {
                vm.total_amt_tran6 =
                  vm.total_amt_tran6 + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'Approved') {
                vm.total_amt_tran6 =
                  vm.total_amt_tran6 + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Delivered') {
                vm.total_amt_tran6 =
                  vm.total_amt_tran6 + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Returned') {
                vm.total_amt_tran6 =
                  vm.total_amt_tran6 + parseFloat(datas['tot_del_amt'])
              }
            })
          }
        })
    }, 500),

    searchForTrans7: _.debounce((searchT7, vm) => {
      axios
        .get(
          `/transaction/getTransaction/transaction7?dateFrom=${btoa(
            vm.dateFrom7
          )}&dateTo=${btoa(vm.dateTo7)}&name=${searchT7}&dateActive=${
            vm.dateActive7
          }&page=1`
        )
        .then(response => {
          vm.transaction7 = response.data

          if (searchT7 === '') {
            if (vm.dateActive7 === true) {
              vm.total_amt_tran7 = 0

              vm.transaction7.data.forEach(datas => {
                if (datas['tran_stat'] === 'Pending') {
                  vm.total_amt_tran7 =
                    vm.total_amt_tran7 + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'On-Process') {
                  vm.total_amt_tran7 =
                    vm.total_amt_tran7 + parseFloat(datas['tot_amt'])
                } else if (datas['tran_stat'] === 'Approved') {
                  vm.total_amt_tran7 =
                    vm.total_amt_tran7 + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Delivered') {
                  vm.total_amt_tran7 =
                    vm.total_amt_tran7 + parseFloat(datas['tot_del_amt'])
                } else if (datas['tran_stat'] === 'Returned') {
                  vm.total_amt_tran7 =
                    vm.total_amt_tran7 + parseFloat(datas['tot_del_amt'])
                }
              })
            } else {
              vm.getAdvancedTotalAmount()
            }
          } else {
            vm.total_amt_tran7 = 0

            vm.transaction7.data.forEach(datas => {
              if (datas['tran_stat'] === 'Pending') {
                vm.total_amt_tran7 =
                  vm.total_amt_tran7 + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'On-Process') {
                vm.total_amt_tran7 =
                  vm.total_amt_tran7 + parseFloat(datas['tot_amt'])
              } else if (datas['tran_stat'] === 'Approved') {
                vm.total_amt_tran7 =
                  vm.total_amt_tran7 + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Delivered') {
                vm.total_amt_tran7 =
                  vm.total_amt_tran7 + parseFloat(datas['tot_del_amt'])
              } else if (datas['tran_stat'] === 'Returned') {
                vm.total_amt_tran7 =
                  vm.total_amt_tran7 + parseFloat(datas['tot_del_amt'])
              }
            })
          }
        })
    }, 500),

    async getTotalAmount(dateFrom, dateTo, search, dateActive) {
      // console.log(dateFrom, dateTo)
      const { data } = await axios.get(
        `transaction/getTotalAmount?dateFrom=${btoa(dateFrom)}&dateTo=${btoa(
          dateTo
        )}&name=${search}&dateActive=${dateActive}`
      )

      // kaloy 2022-04-11
      // console.log('TESSSSSST:', data);
      this.total_amt_tran = data.total_amount_ongoing;
      this.total_amt_approved = data.total_amount_approved;
    },

    async getTotalAmountDel(dateFrom, dateTo, search, dateActive) {
      // console.log(dateFrom, dateTo)
      const { data } = await axios.get(
        `transaction/getTotalAmountDel?dateFrom=${btoa(dateFrom)}&dateTo=${btoa(
          dateTo
        )}&name=${search}&dateActive=${dateActive}`
      )
      this.total_amt_tran4 = data
    },

    async getTotalAmountRet(dateFrom, dateTo, search, dateActive) {
      // console.log(dateFrom, dateTo)
      const { data } = await axios.get(
        `transaction/getTotalAmountRet?dateFrom=${btoa(dateFrom)}&dateTo=${btoa(
          dateTo
        )}&name=${search}&dateActive=${dateActive}`
      )
      this.total_amt_tran5 = data
    },

    async getTotalAmountCanc(dateFrom, dateTo, search, dateActive) {
      // console.log(dateFrom, dateTo)
      const { data } = await axios.get(
        `transaction/getTotalAmountCanc?dateFrom=${btoa(dateFrom)}&dateTo=${btoa(
          dateTo
        )}&name=${search}&dateActive=${dateActive}`
      )
      this.total_amt_tran6 = data
    },

    async getTotalAmountAdv(dateFrom, dateTo, search, dateActive) {
      // console.log(dateFrom, dateTo)

      // kaloy 2021-10-07
      // const { data } = await axios.get(
      //   `transaction/getTotalAmountAdv?dateFrom=${btoa(dateFrom)}&dateTo=${btoa(
      //     dateTo
      //   )}&name=${search}&dateActive=${dateActive}`
      // )
      const { data } = await axios.get(
        `transaction/getTotalAdvanced?dateFrom=${btoa(dateFrom)}&dateTo=${btoa(
          dateTo
        )}&name=${search}&dateActive=${dateActive}`
      )


      this.total_amt_tran7 = data
    },

    async getAllTotalAmount() {
      const { data } = await axios.get('transaction/getTotalAll')
      // kaloy 2022-04-11
      this.total_amt_tran = data.total_amount_all_ongoing;
      this.total_amt_approved = data.total_amount_all_approved;
    },

    async getDeliveredTotalAmount() {
      const { data } = await axios.get('transaction/getTotalDelivered')
      this.total_amt_tran4 = data
    },

    async getReturnedTotalAmount() {
      const { data } = await axios.get('transaction/getTotalReturned')
      this.total_amt_tran5 = data
    },

    async getCancelledTotalAmount() {
      const { data } = await axios.get('transaction/getTotalCancelled')
      this.total_amt_tran6 = data
    },

    async getAdvancedTotalAmount() {
      const { data } = await axios.get('transaction/getTotalAdvanced')
      this.total_amt_tran7 = data
    },

    getResults(page = 1) {
      if (this.dateFrom != this.dateTo) {
        this.dateActive = true;
      }
      this.total_amt_tran = 0;
      this.total_amt_approved = 0;
      // this.ongoingTransCurrentDatasetTotal = 0
      let url = null;
      // if (!this.searchTrans) {
      //   url = `/transaction/getTransaction/transaction?dateFrom=${btoa(
      //     this.dateFrom
      //   )}&dateTo=${btoa(this.dateTo)}&dateActive=${this.dateActive}&page=`
      // } else {
      //   url = `/transaction/getTransaction/transaction?dateFrom=${btoa(
      //     this.dateFrom
      //   )}&dateTo=${btoa(this.dateTo)}&name=${this.searchTrans}&dateActive=${
      //     this.dateActive
      //   }&page=`
      // }
      if(this.searchTrans==null) this.searchTrans = '';
      url = `/transaction/getTransaction/transaction?dateFrom=${btoa(
        this.dateFrom
      )}&dateTo=${btoa(this.dateTo)}&name=${this.searchTrans}&dateActive=${
        this.dateActive
      }&page=`;

      // kaloy 2021-09-29
      this.isLoadingTextVisible = 1
      axios.get(url + page).then(response => {
        const resData = response.data
        this.transaction = resData

        console.log('RESDATA from getResults():', resData);

        // kaloy 2021-10-05 =========================================
        // let tot_amt_sum = 0
        // resData.data.forEach(function(tran){
        //   console.log('Transaction:', tran);
        //   tot_amt_sum += parseFloat(tran.tot_amt);
        // });
        // this.ongoingTransCurrentDatasetTotal = tot_amt_sum;

        // kaloy 2022-04-11
        // if (this.dateFrom != this.dateTo) {
        //   this.getTotalAmount(
        //     this.dateFrom,
        //     this.dateTo,
        //     this.searchTrans,
        //     this.dateActive
        //   )
        // } else {
        //   if (this.dateActive === true) {
        //     if (this.dateFrom === this.dateTo) {
        //       this.getTotalAmount(
        //         this.dateFrom,
        //         this.dateTo,
        //         this.searchTrans,
        //         this.dateActive
        //       )
        //     } else {
        //       this.getTotalAmount(
        //         this.dateFrom,
        //         this.dateTo,
        //         this.searchTrans,
        //         this.dateActive
        //       )
        //     }
        //   } else {
        //     if (!this.searchTrans) {
        //       this.getAllTotalAmount()
        //     }
        //   }
        // }
        if (!this.dateActive && !this.searchTrans) {
          this.getAllTotalAmount();
        } else {
          this.getTotalAmount(
            this.dateFrom,
            this.dateTo,
            this.searchTrans,
            this.dateActive
          );
        }


        // kaloy 2021-09-29
        this.isLoadingTextVisible = 0
        // setTimeout(() => {
        //     $('#tbl-ongoing-trans').DataTable({
        //       responsive: true
        //     })
        // }, 500)

      })
      // kaloy 2021-10-05
      // this.ongoingTransactionsPendingCount()
      this.ongoingPendingCount()
      // this.methodCallCount.getResults += 1

    },

    // delivered_transactions
    getResults4(page = 1) {
      if (this.dateFrom4 != this.dateTo4) {
        this.dateActive4 = true
      }
      this.total_amt_tran4 = 0
      let url = null
      if (!this.searchTrans4) {
        url = `/transaction/getTransaction/transaction4?dateFrom=${btoa(
          this.dateFrom4
        )}&dateTo=${btoa(this.dateTo4)}&dateActive=${this.dateActive4}&page=`
      } else {
        url = `/transaction/getTransaction/transaction4?dateFrom=${btoa(
          this.dateFrom4
        )}&dateTo=${btoa(this.dateTo4)}&name=${this.searchTrans4}&dateActive=${
          this.dateActive4
        }&page=`
      }
      axios.get(url + page).then(response => {
        this.transaction4 = response.data

        if (this.dateFrom4 != this.dateTo4) {
          this.total_amt_tran4 = 0

          this.getTotalAmountDel(
            this.dateFrom4,
            this.dateTo4,
            this.searchTrans4,
            this.dateActive4
          )
        } else {
          if (this.dateActive4 === true) {
            if (this.dateFrom4 === this.dateTo4) {
              this.total_amt_tran4 = 0

              this.getTotalAmountDel(
                this.dateFrom4,
                this.dateTo4,
                this.searchTrans4,
                this.dateActive4
              )
            } else {
              this.total_amt_tran4 = 0

              this.getTotalAmountDel(
                this.dateFrom4,
                this.dateTo4,
                this.searchTrans4,
                this.dateActive4
              )
            }
          } else {
            if (!this.searchTrans4) {
              this.total_amt_tran4 = 0

              this.getDeliveredTotalAmount()
            }
          }
        }
      })
    },

    // export to excel (delivered)
    exportToExcelDelivered() {
      const url = `/transaction/export-to-excel-delivered?dateFrom=${btoa(
          this.dateFrom4
        )}&dateTo=${btoa(this.dateTo4)}&name=&dateActive=${this.dateActive4}`;

      // axios.get(url).then(response=>{
      //   console.log(response.data);
      // })
      location.href = url;
    },

    getResults5(page = 1) {
      if (this.dateFrom5 != this.dateTo5) {
        this.dateActive5 = true
      }
      this.total_amt_tran5 = 0
      let url = null
      if (!this.searchTrans5) {
        url = `/transaction/getTransaction/transaction5?dateFrom=${btoa(
          this.dateFrom5
        )}&dateTo=${btoa(this.dateTo5)}&dateActive=${this.dateActive5}&page=`
      } else {
        url = `/transaction/getTransaction/transaction5?dateFrom=${btoa(
          this.dateFrom5
        )}&dateTo=${btoa(this.dateTo5)}&name=${this.searchTrans5}&dateActive=${
          this.dateActive5
        }&page=`
      }
      axios.get(url + page).then(response => {
        this.transaction5 = response.data

        if (this.dateFrom5 != this.dateTo5) {
          this.total_amt_tran5 = 0

          this.getTotalAmountRet(
            this.dateFrom5,
            this.dateTo5,
            this.searchTrans5,
            this.dateActive5
          )
        } else {
          if (this.dateActive5 === true) {
            if (this.dateFrom5 === this.dateTo5) {
              this.total_amt_tran5 = 0

              this.getTotalAmountRet(
                this.dateFrom5,
                this.dateTo5,
                this.searchTrans5,
                this.dateActive5
              )
            } else {
              this.total_amt_tran5 = 0

              this.getTotalAmountRet(
                this.dateFrom5,
                this.dateTo5,
                this.searchTrans5,
                this.dateActive5
              )
            }
          } else {
            if (!this.searchTrans5) {
              this.total_amt_tran5 = 0

              this.getReturnedTotalAmount()
            }
          }
        }
      })
    },

    getResults6(page = 1) {
      if (this.dateFrom6 != this.dateTo6) {
        this.dateActive6 = true
      }
      this.total_amt_tran6 = 0
      let url = null
      if (!this.searchTrans6) {
        url = `/transaction/getTransaction/transaction6?dateFrom=${btoa(
          this.dateFrom6
        )}&dateTo=${btoa(this.dateTo6)}&dateActive=${this.dateActive6}&page=`
      } else {
        url = `/transaction/getTransaction/transaction6?dateFrom=${btoa(
          this.dateFrom6
        )}&dateTo=${btoa(this.dateTo6)}&name=${this.searchTrans6}&dateActive=${
          this.dateActive6
        }&page=`
      }
      axios.get(url + page).then(response => {
        this.transaction6 = response.data

        if (this.dateFrom6 != this.dateTo6) {
          this.total_amt_tran6 = 0

          this.getTotalAmountCanc(
            this.dateFrom6,
            this.dateTo6,
            this.searchTrans6,
            this.dateActive6
          )
        } else {
          if (this.dateActive6 === true) {
            if (this.dateFrom6 === this.dateTo6) {
              this.total_amt_tran6 = 0

              this.getTotalAmountCanc(
                this.dateFrom6,
                this.dateTo6,
                this.searchTrans6,
                this.dateActive6
              )
            } else {
              this.total_amt_tran6 = 0

              this.getTotalAmountCanc(
                this.dateFrom6,
                this.dateTo6,
                this.searchTrans6,
                this.dateActive6
              )
            }
          } else {
            if (!this.searchTrans6) {
              this.total_amt_tran6 = 0

              this.getCancelledTotalAmount()
            }
          }
        }
      })
    },

    // advanced_order
    getResults7(page = 1) {
      if (this.dateFrom7 != this.dateTo7) {
        this.dateActive7 = true
      }
      this.total_amt_tran7 = 0
      let url = null
      if (!this.searchTrans7) {
        url = `/transaction/getTransaction/transaction7?dateFrom=${btoa(
          this.dateFrom7
        )}&dateTo=${btoa(this.dateTo7)}&dateActive=${this.dateActive7}&page=`
      } else {
        url = `/transaction/getTransaction/transaction7?dateFrom=${btoa(
          this.dateFrom7
        )}&dateTo=${btoa(this.dateTo7)}&name=${this.searchTrans7}&dateActive=${
          this.dateActive7
        }&page=`
      }
      axios.get(url + page).then(response => {
        this.transaction7 = response.data

        if (this.dateFrom7 != this.dateTo7) {
          this.total_amt_tran7 = 0

          this.getTotalAmountAdv(
            this.dateFrom7,
            this.dateTo7,
            this.searchTrans7,
            this.dateActive7
          )
        } else {
          if (this.dateActive7 === true) {
            if (this.dateFrom7 === this.dateTo7) {
              this.total_amt_tran7 = 0

              this.getTotalAmountAdv(
                this.dateFrom7,
                this.dateTo7,
                this.searchTrans7,
                this.dateActive7
              )
            } else {
              this.total_amt_tran7 = 0

              this.getTotalAmountAdv(
                this.dateFrom7,
                this.dateTo7,
                this.searchTrans7,
                this.dateActive7
              )
            }
          } else {
            if (!this.searchTrans7) {
              this.total_amt_tran7 = 0

              this.getAdvancedTotalAmount()
            }
          }
        }
      })

      // kaloy 2021-10-07
      // this.advancedOrdersCount
    },

    closeModal() {
      document.getElementById('close').click()
      $('#setupMdl1').modal('hide')
      this.clearData()
    },
    closeModal6() {
      document.getElementById('close').click()
      $('#setupMdl6').modal('hide')
      this.clearData()
    },
    closeModal7() {
      document.getElementById('close').click()
      $('#setupMdl7').modal('hide')
      this.clearData()
    },
    closeModal8() {
      document.getElementById('close').click()
      $('#setupMdl8').modal('hide')
      this.clearData()
    },
    closeModal9() {
      document.getElementById('close').click()
      $('#setupMdl9').modal('hide')
      this.clearData()
    },

    clearData() {
      this.orderTable.clear().destroy()
      this.order = []

      this.form.tran_no = ''
      this.form.date_req = ''
      this.form.date_app = ''
      this.form.date_del = ''
      this.form.account_code = ''
      this.form.store_name = ''
      this.form.p_meth = ''
      this.form.itm_count = ''
      this.form.tot_amt = ''
      this.form.tot_del_amt = ''
      this.form.tran_stat = ''
      this.form.sm_name = ''
      this.form.sm_code = ''
      // kaloy 2021-09-28
      this.form.export_date = ''
      this.form.itm_del_count = ''

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

    orderDetails(tran_no, amount_ordered) {
      this.total_amt_line = 0;
      this.total_amt_served = 0;
      axios
        .get(`/transaction/getOrderTransaction/order_detail/?id=${tran_no}`)
        .then(response => {
          this.order = response.data

          this.total_amt_line = amount_ordered;

          this.order.forEach(datas => {
            // console.log(datas.downloaded)
            // this.downloaded = datas.downloaded

            // this.total_amt_line =
            //   this.total_amt_line + parseFloat(datas['tot_amt']);

            if(datas['itm_stat'] == 'Served' || datas['itm_stat'] == 'Lacking' || datas['itm_stat'] == 'Excess') {
              this.total_amt_served = this.total_amt_served + parseFloat(datas['tot_amt']);
            }
          })

          if (Object.keys(this.order).length) {
            setTimeout(() => {
              this.orderTable = $('#OrderTable').DataTable();
            }, 500);
          }

          $('#setupMdl1').modal('show')
          $('#MdlTitle1').html('Order Items');

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })
      // kaloy 2021-09-29
      // this.getResults()
    },

    // delivered_item_details
    orderDetails4(tran_no) {
      this.total_amt_line = 0;
      this.total_amt_served = 0;
      axios
        .get(`/transaction/getOrderTransaction/order_detail/?id=${tran_no}`)
        .then(response => {
          this.order = response.data

          this.order.forEach(datas => {
            // console.log(datas.downloaded)
            // this.downloaded = datas.downloaded
            this.total_amt_line += parseFloat(datas['tot_amt'])

            if(datas['itm_stat'] != '') {
              this.total_amt_served += datas['tot_amt'];
            }
          })

          if (Object.keys(this.order).length) {
            setTimeout(() => {
              this.orderTable = $('#OrderTable4').DataTable()
            }, 500)
          }

          $('#setupMdl6').modal('show')
          $('#MdlTitle6').html('Order Items')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })

      // this.getResults4()
    },

    orderDetails5(tran_no) {
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
              this.orderTable = $('#OrderTable5').DataTable()
            }, 500)
          }

          $('#setupMdl7').modal('show')
          $('#MdlTitle7').html('Order Items')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })

      this.getResults5()

},

    orderDetails6(tran_no) {
      this.total_amt_line = 0;
      // this.total_amt_served = 0;
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
              this.orderTable = $('#OrderTable6').DataTable()
            }, 500)
          }

          $('#setupMdl8').modal('show')
          $('#MdlTitle8').html('Order Items')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })

      this.getResults6()
    },

    orderDetails7(tran_no) {
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
              this.orderTable = $('#OrderTable7').DataTable()
            }, 500)
          }

          $('#setupMdl9').modal('show')
          $('#MdlTitle9').html('Order Items')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })
        })

      this.getResults7()
    },

    detailsOrder(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle2').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form1.tran_no2 = order_d.tran_no
            this.form1.itm_code = order_d.itm_code
            this.form1.item_desc = order_d.item_desc
            this.form1.req_qty = order_d.req_qty
            this.form1.del_qty = order_d.del_qty
            this.form1.uom = order_d.uom
            this.form1.amt = formatter.format(order_d.amt)
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form1.itm_cat = order_d.itm_cat
            this.form1.itm_stat = order_d.itm_stat
            // kaloy 2022-05-25
            this.form1.order_by = order_d.order_by
            this.form1.tran_stat = order_d.tran_stat
          })
        })

      // kaloy 2022-04-11
      // this.getResults()
    },

    detailsOrder4(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle2').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form1.tran_no2 = order_d.tran_no
            this.form1.itm_code = order_d.itm_code
            this.form1.item_desc = order_d.item_desc
            this.form1.req_qty = order_d.req_qty
            this.form1.del_qty = order_d.del_qty
            this.form1.uom = order_d.uom
            this.form1.amt = formatter.format(order_d.amt)
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form1.itm_cat = order_d.itm_cat
            this.form1.itm_stat = order_d.itm_stat
          })
        })

      this.getResults4()
    },

    detailsOrder5(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle2').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form1.tran_no2 = order_d.tran_no
            this.form1.itm_code = order_d.itm_code
            this.form1.item_desc = order_d.item_desc
            this.form1.req_qty = order_d.req_qty
            this.form1.del_qty = order_d.del_qty
            this.form1.uom = order_d.uom
            this.form1.amt = formatter.format(order_d.amt)
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form1.itm_cat = order_d.itm_cat
            this.form1.itm_stat = order_d.itm_stat
          })
        })

      this.getResults5()
    },

    detailsOrder6(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle2').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form1.tran_no2 = order_d.tran_no
            this.form1.itm_code = order_d.itm_code
            this.form1.item_desc = order_d.item_desc
            this.form1.req_qty = order_d.req_qty
            this.form1.del_qty = order_d.del_qty
            this.form1.uom = order_d.uom
            this.form1.amt = formatter.format(order_d.amt)
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form1.itm_cat = order_d.itm_cat
            this.form1.itm_stat = order_d.itm_stat
          })
        })

      this.getResults6()
    },

    detailsOrder7(doc_no) {
      axios
        .get(`/transaction/getOrderTransaction1/order_detail1/?id=${doc_no}`)
        .then(response => {
          this.order_details = response.data

          $('#setupMdl2').modal('show')
          $('#MdlTitle2').html('Order Details')

          const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
          })

          this.order_details.forEach(order_d => {
            this.form1.tran_no2 = order_d.tran_no
            this.form1.itm_code = order_d.itm_code
            this.form1.item_desc = order_d.item_desc
            this.form1.req_qty = order_d.req_qty
            this.form1.del_qty = order_d.del_qty
            this.form1.uom = order_d.uom
            this.form1.amt = formatter.format(order_d.amt)
            this.form1.tot_amt2 = formatter.format(order_d.tot_amt)
            this.form1.itm_cat = order_d.itm_cat
            this.form1.itm_stat = order_d.itm_stat
          })
        })

      this.getResults7()
    },

    details(MgaTransaction) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.tran_no = MgaTransaction.tran_no
      this.form.date_req = MgaTransaction.date_req
      this.form.date_app = MgaTransaction.date_app
      this.form.date_del = MgaTransaction.date_del
      this.form.account_code = MgaTransaction.account_code
      this.form.store_name = MgaTransaction.store_name
      this.form.p_meth = MgaTransaction.p_meth
      this.form.itm_count = MgaTransaction.itm_count
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form.tot_del_amt = formatter.format(MgaTransaction.tot_del_amt)
      if (MgaTransaction.tran_stat === 'Pending') {
        this.form.tran_stat = 'Submitted'
      } else {
        this.form.tran_stat = MgaTransaction.tran_stat
    }
      this.form.sm_code = MgaTransaction.sm_code
      this.form.sm_name = MgaTransaction.first_name + ' ' + MgaTransaction.last_name
      // kaloy 2021-09-28
      this.form.export_date = MgaTransaction.export_date
      this.form.itm_del_count = MgaTransaction.itm_del_count
      // kaloy 2021-09-29
      // this.getResults()
    },

    // tran head view (delivered)
    details4(MgaTransaction) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.tran_no = MgaTransaction.tran_no
      this.form.date_req = MgaTransaction.date_req
      this.form.date_app = MgaTransaction.date_app
      this.form.date_del = MgaTransaction.date_del
      this.form.account_code = MgaTransaction.account_code
      this.form.store_name = MgaTransaction.store_name
      this.form.p_meth = MgaTransaction.p_meth
      this.form.itm_count = MgaTransaction.itm_count
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form.tot_del_amt = formatter.format(MgaTransaction.tot_del_amt)
      if (MgaTransaction.tran_stat === 'Pending') {
        this.form.tran_stat = 'Submitted'
      } else {
        this.form.tran_stat = MgaTransaction.tran_stat
      }
      this.form.sm_code = MgaTransaction.sm_code
      this.form.sm_name = MgaTransaction.first_name + ' ' + MgaTransaction.last_name
      // kaloy 2021-10-05
      this.form.export_date = MgaTransaction.export_date
      this.form.itm_del_count = MgaTransaction.itm_del_count
      // this.getResults4()
    },

    details5(MgaTransaction) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.tran_no = MgaTransaction.tran_no
      this.form.date_req = MgaTransaction.date_req
      this.form.date_app = MgaTransaction.date_app
      this.form.date_del = MgaTransaction.date_del
      this.form.account_code = MgaTransaction.account_code
      this.form.store_name = MgaTransaction.store_name
      this.form.p_meth = MgaTransaction.p_meth
      this.form.itm_count = MgaTransaction.itm_count
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form.tot_del_amt = formatter.format(MgaTransaction.tot_del_amt)
      if (MgaTransaction.tran_stat === 'Pending') {
        this.form.tran_stat = 'Submitted'
      } else {
        this.form.tran_stat = MgaTransaction.tran_stat
      }
      this.form.sm_code = MgaTransaction.sm_code
      this.form.sm_name =
        MgaTransaction.first_name + ' ' + MgaTransaction.last_name

      this.getResults5()
    },

    details6(MgaTransaction) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.tran_no = MgaTransaction.tran_no
      this.form.date_req = MgaTransaction.date_req
      this.form.date_app = MgaTransaction.date_app
      this.form.date_del = MgaTransaction.date_del
      this.form.account_code = MgaTransaction.account_code
      this.form.store_name = MgaTransaction.store_name
      this.form.p_meth = MgaTransaction.p_meth
      this.form.itm_count = MgaTransaction.itm_count
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form.tot_del_amt = formatter.format(MgaTransaction.tot_del_amt)
      if (MgaTransaction.tran_stat === 'Pending') {
        this.form.tran_stat = 'Submitted'
      } else {
        this.form.tran_stat = MgaTransaction.tran_stat
      }
      this.form.sm_code = MgaTransaction.sm_code
      this.form.sm_name =
        MgaTransaction.first_name + ' ' + MgaTransaction.last_name

      this.getResults6()
    },

    // tran head view (advanced order)
    details7(MgaTransaction) {
      $('#setupMdl').modal('show')
      $('#MdlTitle').html('Transaction Details')
      //   $('#submitformreupload').html('Set')

      const formatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
      })

      this.form.tran_no = MgaTransaction.tran_no
      this.form.date_req = MgaTransaction.date_req
      this.form.date_app = MgaTransaction.date_app
      this.form.date_del = MgaTransaction.date_del
      this.form.account_code = MgaTransaction.account_code
      this.form.store_name = MgaTransaction.store_name
      this.form.p_meth = MgaTransaction.p_meth
      this.form.itm_count = MgaTransaction.itm_count
      this.form.tot_amt = formatter.format(MgaTransaction.tot_amt)
      this.form.tot_del_amt = formatter.format(MgaTransaction.tot_del_amt)
      if (MgaTransaction.tran_stat === 'Pending') {
        this.form.tran_stat = 'Submitted'
      } else {
        this.form.tran_stat = MgaTransaction.tran_stat
      }
      this.form.sm_code = MgaTransaction.sm_code
      this.form.sm_name =
        MgaTransaction.first_name + ' ' + MgaTransaction.last_name
      // kaloy 2021-10-05
      this.form.export_date = MgaTransaction.export_date
      this.form.itm_del_count = MgaTransaction.itm_del_count

      this.getResults7()
    },

    // kaloy 09-22-21
    // Copy trans_no to clipboard
    copyTextToClipboard(e) {
      let transNo = e.target.innerText.trim();
      // console.log(transNo);
      navigator.clipboard.writeText(transNo);
      console.log(`${transNo} copied to clipboard!`)
      // $.niftyNoty({
      //     type: 'info',
      //     icon: 'pli-cross icon-2x',
      //     message: `<i class="fa fa-check"></i> ${transNo} copied to clipboard!`,
      //     container: 'floating',
      //     timer: 1500
      // });
    },

    // kaloy 2021-10-05
    humanizeDateDuration(strDate) {
        return moment(new Date(strDate)).fromNow();
    },

    ...mapActions('transactions', [
      'ongoingPendingCount','advancedOrdersCount'
    ]),

    // kaloy 2022-05-27
    submitQtyAdjustment() {
        const new_qty = parseInt(this.qty_adjustment.new_qty);
        if(!isNaN(new_qty) && new_qty > 0 && this.qty_adjustment.mankey != null) {
            const url = `/transaction/qty-adjustment`;
            axios.post(url, this.qty_adjustment)
            .then(response => {
                if(response.data.success==true) {
                    Swal.fire('Success!', response.data.message, 'success');
                    window.location.reload();
                } else {
                    console.log(response.data);
                    Swal.fire('Oops!', response.data.message, 'error');
                }
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
},

  computed: {
    // kaloy 2021-10-25
    ...mapGetters('transactions',[
      'getOngoingPendingCount','getAdvancedOrdersCount'
    ]),

    // kaloy 2021-10-05
    timeframeUntilProcessing() {
      if (this.form.export_date === null) return 'Pending...';
      let diff = moment(this.form.export_date).diff(moment(this.form.date_req));
      return humanizeDuration(diff);
    },
    timeframeUntilApproval() {
      if (this.form.date_app === null) return 'Pending...';
      let diff = moment(this.form.date_app).diff(moment(this.form.export_date));
      return humanizeDuration(diff);
    },
    timeframeUntilDelivery() {
      if (this.form.date_del === null) return 'Pending...';
      let diff = moment(this.form.date_del).diff(moment(this.form.date_app));
      return humanizeDuration(diff);
    },
    timeframeOrderFulfillment() {
      if (this.form.date_del === null) return 'Pending...';
      let diff = moment(`${this.form.date_del}`).diff(moment(`${this.form.date_req}`));
      return humanizeDuration(diff);
    },

  },

  mounted() {
    console.log('Transaction component mounted.');
    this.$root.currentPage = this.$route.meta.name
    $('#container').css('position', 'relative')

    // kaloy 2022-05-11 ******************************************
    $('.tbl-transactions tbody').on( 'click', 'tr', function () {
      $('.tbl-transactions tr.selected').removeClass('selected');
      $(this).addClass('selected');
    } );
    // /kaloy 2022-05-11 ******************************************

    // // kaloy 2022-05-11 ******************************************
    // $('#setupMdl1').on('hidden.bs.modal', function () {
    //     $('#setupMdl1').modal('hide');
    //     this.clearData();
    // });
    // // /kaloy 2022-05-11 ******************************************
  },

  created() {

  },

}
</script>
