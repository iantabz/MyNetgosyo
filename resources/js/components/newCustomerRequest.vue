<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel no-print">
      <div class="panel-heading">
        <h3 class="panel-title" style="font-weight: bold; font-size: 13px">
          <i class="fa fa-vcard-o"></i> Customer Requests
        </h3>
      </div>
      <div class="tab-base">
        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
          <li class="active">
            <a data-toggle="tab" href="#demo-lft-tab-1">
              Pending
              <span class="badge badge-warning">{{ form.total_result }}</span>
            </a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-2">
              Approved
              <span class="badge badge-success">{{ form.total_app_result }}</span>
            </a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-3">
              Rejected
              <span class="badge badge-danger">{{ form.total_rej_result }}</span>
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
              <div class="row">
                <div class="col-lg-6 table-toolbar-left">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <!-- <label class="col-md-6 control-label">Search:</label> -->
                      <div class="col-md-6">
                        <datepicker v-model="pending_date"></datepicker>
                        <small class="text-muted">Search by Date Requested</small>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-lg-6 table-toolbar-right"></div>
              </div>
              <div class="row">
                <div class="col-md-6 table-toolbar-left">
                  <button
                    :disabled="checkboxes_id == ''"
                    class="btn btn-primary btn-rounded"
                    @click="test()"
                  >
                    <i class="fa fa-check-circle-o"></i>
                    Approve ({{ checkboxes_id.length }})
                  </button>

                  <button
                    :disabled="checkboxes_id == ''"
                    class="btn btn-danger btn-rounded"
                    @click="reject()"
                  >
                    <i class="fa fa-close"></i>
                    Reject ({{ checkboxes_id.length }})
                  </button>
                </div>
                <div class="col-md-6 table-toolbar-right">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-6 control-label">Search:</label>
                      <div class="col-md-6">
                        <input
                          type="text"
                          class="form-control"
                          @keyup="search"
                          v-model="searchCustomer"
                          placeholder="Search by Store/Owner name"
                        />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <table
                id="requestTbl"
                class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>
                      <div class="text-center">
                        <input
                          class="magic-checkbox"
                          id="selectAll"
                          type="checkbox"
                          @click="selectAll()"
                          v-model="allSelected"
                        />
                        <label for="selectAll"></label>
                      </div>
                    </th>
                    <th>Store Name</th>
                    <th>DTI No</th>
                    <th>Owner Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Date of Request</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!customers.data.length">
                    <td colspan="8" class="text-center">No data available.</td>
                  </tr>
                  <tr v-for="MgaCustomers in customers.data" :key="MgaCustomers.id">
                    <td>
                      <div class="text-center">
                        <input
                          class="magic-checkbox"
                          type="checkbox"
                          v-model="checkboxes_id"
                          :id="MgaCustomers.id"
                          :value="MgaCustomers"
                        />
                        <label :for="MgaCustomers.id"></label>
                      </div>
                    </td>
                    <td class="text-bold">{{ MgaCustomers.store_name }}</td>
                    <td>{{ MgaCustomers.dti_no }}</td>
                    <td>{{ MgaCustomers.owner_name }}</td>
                    <td>{{ '+63' + MgaCustomers.mobile_number }}</td>
                    <td>{{ MgaCustomers.bar_name + ', ' + MgaCustomers.mun_name }}</td>
                    <td>{{ MgaCustomers.date_req | formatDate }}</td>
                    <td>
                      <button
                        class="btn btn-icon btn-success btn-rounded btn-xs"
                        @click="viewCustomer(MgaCustomers)"
                      >
                        <i class="fa fa-eye"></i>
                      </button>

                      <button
                        class="btn btn-icon btn-info btn-rounded btn-xs"
                        @click="singleApprove(MgaCustomers.id, MgaCustomers)"
                      >
                        <i class="fa fa-check"></i>
                      </button>

                      <!-- <button
                          class="btn btn-icon btn-danger btn-rounded btn-xs"
                          @click="singleReject(MgaCustomers.id, MgaCustomers)"
                        >
                          <i class="fa fa-close"></i>
                      </button>-->
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    Showing {{ customers.from }} to {{ customers.to }} of
                    {{ customers.total }} entries
                    <span
                      v-if="searchCustomer && !pending_date"
                    >
                      (Filtered from {{ form.total_result }} total
                      entries)
                    </span>
                    <span v-else-if="searchCustomer && pending_date">
                      (Filtered from {{ form.total_pending_customers }} total
                      entries)
                    </span>
                  </div>
                  <div class="col-md-6">
                    <div class="text-right">
                      <pagination
                        style="margin: 0 0 20px 0;"
                        :limit="1"
                        :show-disabled="true"
                        :data="customers"
                        @pagination-change-page="getPendingResults"
                      ></pagination>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- 2ND TAB -->
          <div id="demo-lft-tab-2" class="tab-pane fade">
            <div class="panel-body">
              <div class="row" style="margin: 0px 0px 10px 0px">
                <div class="col-lg-12">
                  <!-- <div id="demo-dp-txtinput">
                    <input type="text" class="form-control" />
                  </div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 table-toolbar-left">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <!-- <label class="col-md-6 control-label">Search:</label> -->
                      <div class="col-md-6">
                        <datepicker2 v-model="approve_date"></datepicker2>
                        <small class="text-muted">Search by Date Requested</small>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-lg-6 table-toolbar-right"></div>
              </div>
              <div class="row">
                <div class="col-md-6 table-toolbar-left">
                  <button
                    :disabled="checkbox_approved == ''"
                    class="btn btn-primary btn-rounded"
                    @click="exportBtn()"
                  >
                    <i class="fa fa-download"></i>
                    Export ({{ checkbox_approved.length }})
                  </button>
                  <!-- <form style="display: none;" ref="exportApproved">

                  </form>-->
                </div>
                <div class="col-md-6 table-toolbar-right">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-6 control-label">Search:</label>
                      <div class="col-md-6">
                        <input
                          type="text"
                          class="form-control"
                          @keyup="searchApproved"
                          v-model="searchCustomerApp"
                          placeholder="Search by Store/Owner name"
                        />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <table
                id="approvedTbl"
                class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>
                      <div class="text-center">
                        <input
                          class="magic-checkbox"
                          id="selectAll_approved"
                          type="checkbox"
                          @click="selectAll_approved()"
                          v-model="allSelected_approved"
                        />
                        <label for="selectAll_approved"></label>
                      </div>
                    </th>
                    <th>Store Name</th>
                    <th>DTI No</th>
                    <th>Owner Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!approvedCustomers.data.length">
                    <td colspan="7" class="text-center">No data available.</td>
                  </tr>
                  <tr v-for="MgaCustomers in approvedCustomers.data" :key="MgaCustomers.id">
                    <td>
                      <div class="text-center">
                        <input
                          class="magic-checkbox"
                          type="checkbox"
                          v-model="checkbox_approved"
                          :id="MgaCustomers.id"
                          :value="MgaCustomers"
                        />
                        <label :for="MgaCustomers.id"></label>
                      </div>
                    </td>
                    <td class="text-bold">{{ MgaCustomers.store_name }}</td>
                    <td>{{ MgaCustomers.dti_no }}</td>
                    <td>{{ MgaCustomers.owner_name }}</td>
                    <td>{{ '+63' + MgaCustomers.mobile_number }}</td>
                    <td>{{ MgaCustomers.bar_name + ', ' + MgaCustomers.mun_name }}</td>
                    <td>
                      <button
                        class="btn btn-icon btn-success btn-rounded btn-xs"
                        @click="viewApproveBtn(MgaCustomers)"
                      >
                        <i class="fa fa-eye"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    Showing {{ approvedCustomers.from }} to
                    {{ approvedCustomers.to }} of
                    {{ approvedCustomers.total }} entries
                    <span
                      v-if="searchCustomerApp && !approve_date"
                    >(Filtered from {{ form.total_app_result }} total entries)</span>
                    <span v-else-if="searchCustomerApp && approve_date">
                      (Filtered from {{ form.total_approved_customers }} total
                      entries)
                    </span>
                  </div>
                  <div class="col-md-6">
                    <div class="text-right">
                      <pagination
                        style="margin: 0 0 20px 0;"
                        :limit="1"
                        :show-disabled="true"
                        :data="approvedCustomers"
                        @pagination-change-page="getApprovedResults"
                      ></pagination>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- 3RD TAB -->
          <div id="demo-lft-tab-3" class="tab-pane fade">
            <div class="panel-body">
              <div class="row" style="margin: 0px 0px 10px 0px">
                <div class="col-lg-12"></div>
              </div>
              <div class="row">
                <div class="col-lg-6 table-toolbar-left">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <!-- <label class="col-md-6 control-label">Search:</label> -->
                      <div class="col-md-6">
                        <div class="input-group date" id="rejected_dates" aria-disabled>
                          <input type="text" class="form-control" data-date-end-date="0d" />
                          <span class="input-group-addon">
                            <i class="demo-pli-calendar-4"></i>
                          </span>
                        </div>
                        <small class="text-muted">Search by Date Requested</small>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-lg-6 table-toolbar-right"></div>
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
                          @keyup="searchRejected"
                          v-model="searchCustomerRej"
                          placeholder="Search by Store/Owner name"
                        />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <table
                id="approvedTbl"
                class="table table-bordered table-hover dt-responsive nowrap table-vcenter"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>Store Name</th>
                    <th>DTI No</th>
                    <th>Owner Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!rejectedCustomers.data.length">
                    <td colspan="6" class="text-center">No data available.</td>
                  </tr>
                  <tr v-for="MgaCustomers in rejectedCustomers.data" :key="MgaCustomers.id">
                    <td class="text-bold">{{ MgaCustomers.store_name }}</td>
                    <td>{{ MgaCustomers.dti_no }}</td>
                    <td>{{ MgaCustomers.owner_name }}</td>
                    <td>{{ '+63' + MgaCustomers.mobile_number }}</td>
                    <td>{{ MgaCustomers.bar_name + ', ' + MgaCustomers.mun_name }}</td>
                    <td>
                      <button
                        class="btn btn-icon btn-success btn-rounded btn-xs"
                        @click="viewRejectedBtn(MgaCustomers)"
                      >
                        <i class="fa fa-eye"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    Showing {{ rejectedCustomers.from }} to
                    {{ rejectedCustomers.to }} of
                    {{ rejectedCustomers.total }} entries
                    <span
                      v-if="searchCustomerRej"
                    >(Filtered from {{ form.total_rej_result }} total entries)</span>
                  </div>
                  <div class="col-md-6">
                    <div class="text-right">
                      <pagination
                        style="margin: 0 0 20px 0;"
                        :limit="1"
                        :show-disabled="true"
                        :data="rejectedCustomers"
                        @pagination-change-page="getRejectedResults"
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
      id="viewCustomerMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Customer</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="clearViewData()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body" style="padding: 0 15px 15px 5px">
              <div class="panel-body" style="padding: 0 20px 10px;">
                <h5
                  class="bord-btm pad-ver text-main text-bold text-uppercase"
                >{{ viewCustomerdata.store_name }}</h5>
                <div class="panel-body" style="padding: 0 20px 5px">
                  <div class="panel-body form-horizontal">
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Customer Name</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.owner_name"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >DTI No</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.dti_no"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Mobile No</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="'+63' + viewCustomerdata.mobile_number"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Street Address</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.street_add"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Barangay</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.bar_name"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Municipal</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.mun_name"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Landmark</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.landmark"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label
                        for="customer"
                        class="col-md-4 control-label text-main text-bold"
                      >Date Requested</label>
                      <div class="col-md-7">
                        <input
                          class="form-control"
                          id="customer"
                          :value="viewCustomerdata.created_at | formatDate"
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="clearViewData()"
              >Close</button>
              <!-- <button type="button" class="btn btn-primary" @click="submitBtn()">Save changes</button> -->
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="approveCustomersMdl"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalScrollableTitle"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div
        class="modal-dialog modal-dialog-scrollable modal-lg"
        role="document"
        style="margin-top: 50px;"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Approve Customer/s</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div class="panel-body" id="printMe">
                <div class="tabz" v-for="(forApproval, index) in checkboxes_id" :key="index">
                  <p
                    class="bord-btm pad-ver text-main text-bold text-uppercase"
                  >{{ forApproval.store_name }}</p>
                  <div class="invoice-bill row">
                    <div class="col-lg-6">
                      <address>
                        <strong class="text-main">
                          {{
                          forApproval.owner_name
                          }}
                        </strong>
                        <br />
                        <a
                          :href="
                            form.url +
                              forApproval.street_add +
                              ',+' +
                              forApproval.bar_name +
                              ',+' +
                              forApproval.mun_name +
                              ',+' +
                              forApproval.province
                          "
                          class="btn-link"
                          target="_new"
                        >
                          <i class="fa fa-map-marker"></i>
                          {{
                          forApproval.street_add + ', ' + forApproval.bar_name
                          }}
                          <br />
                          {{
                          forApproval.landmark +
                          ', ' +
                          forApproval.mun_name +
                          ', ' +
                          forApproval.district +
                          ', ' +
                          forApproval.province
                          }}
                        </a>
                        <br />
                        {{ '+63' + forApproval.mobile_number }}
                        <br />
                      </address>
                    </div>
                    <div class="col-lg-6">
                      <table class="invoice-details">
                        <tbody>
                          <tr>
                            <td class="text-main text-bold">DTI No</td>
                            <td class="text-right text-info text-bold">{{ forApproval.dti_no }}</td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Status</td>
                            <td class="text-right">
                              <span class="badge badge-warning">
                                {{
                                forApproval.status
                                }}
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Date</td>
                            <td class="text-right">{{ forApproval.date_req | formatDate }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <form :id="`myForm${forApproval.id}`" @submit.prevent="submitFiles">
                      <span class="text-bold text-main">Barangay clearance: </span>
                      <input
                        type="file"
                        :id="`input-file-import-${forApproval.id}`"
                        :ref="`images-${forApproval.id}`"
                        accept=".png, .jpg"
                        class="btn btn-default fileinput-button dz-clickable"
                        style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer; width: 400px;"
                        @change="onFile(forApproval.id)"
                      />
                      <div class="btn-group">
                        <button
                          :id="`dz-remove-btn-${forApproval.id}`"
                          class="btn btn-danger btn-sm cancel"
                          type="reset"
                          style="display: none;"
                          @click="resetBtn(forApproval.id)"
                        >
                          <i class="demo-psi-trash"></i>
                        </button>
                      </div>
                    </form>
                  </div>
                  <hr />
                  <div class="spacer" v-if="index == 5">
                    <hr v-for="num in 5" class="new-section-sm bord-no" :key="num" />
                  </div>
                </div>
                <hr class="new-section-sm bord-no" />
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group has-feedback">
                        <label class="col-lg-2 strong text-bold" style="color: #4d627b">
                          Remarks:
                          <span style="color:red">*</span>
                        </label>
                        <div class="col-lg-9">
                          <textarea
                            class="form-control"
                            name="message"
                            rows="3"
                            placeholder="User Remarks"
                            v-model="form.remarks"
                          ></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <a href="javascript:window.print()" class="btn btn-default">
                <i class="demo-pli-printer icon-lg"></i>
              </a>-->
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button
                v-if="!form.status || form.status == 'Approved'"
                type="button"
                class="btn btn-primary"
                @click="submitBtn(checkboxes_id)"
                :disabled="!form.remarks"
              >Approve</button>
              <button
                v-else
                type="button"
                class="btn btn-danger"
                @click="submitBtn(checkboxes_id)"
                :disabled="!form.remarks"
              >Reject</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="approvedCustPrint"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalScrollableTitle"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-scrollable modal-lg"
        role="document"
        style="margin-top: 50px;"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Report Print Preview</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div class="panel-body">
                <div class="tabz" v-for="(appdata, index) in forPrintData" :key="index">
                  <p
                    class="bord-btm pad-ver text-main text-bold text-uppercase"
                  >{{ appdata.store_name }}</p>
                  <div class="invoice-bill row">
                    <div class="col-lg-6">
                      <address>
                        <strong class="text-main">
                          {{
                          appdata.owner_name
                          }}
                        </strong>
                        <br />
                        <a
                          :href="
                            form.url +
                              appdata.street_add +
                              '+' +
                              appdata.bar_name +
                              ',+' +
                              appdata.mun_name +
                              ',+' +
                              appdata.province
                          "
                          class="btn-link"
                          target="_new"
                        >
                          <i class="fa fa-map-marker"></i>
                          {{ appdata.street_add + ', ' + appdata.bar_name }}
                          <br />
                          {{
                          appdata.landmark +
                          ', ' +
                          appdata.mun_name +
                          ', ' +
                          appdata.district +
                          ', ' +
                          appdata.province
                          }}
                        </a>
                        <br />
                        {{ '+63' + appdata.mobile_number }}
                        <br />
                      </address>
                    </div>
                    <div class="col-lg-6">
                      <table class="invoice-details">
                        <tbody>
                          <tr>
                            <td class="text-main text-bold">DTI No</td>
                            <td class="text-right text-info text-bold">{{ appdata.dti_no }}</td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Status</td>
                            <td class="text-right">
                              <span class="badge badge-success">
                                {{
                                appdata.status
                                }}
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Date</td>
                            <td class="text-right">{{ appdata.date_req | formatDate }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="spacer" v-if="index == 5">
                    <hr v-for="num in 5" class="new-section-sm bord-no" :key="num" />
                  </div>
                </div>
                <hr class="new-section-sm bord-no" />
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group has-feedback">
                        <label class="col-lg-2 strong text-bold" style="color: #4d627b">
                          Remarks:
                          <span style="color:red">*</span>
                        </label>
                        <div class="col-lg-9">
                          <textarea
                            class="form-control"
                            name="message"
                            rows="3"
                            placeholder="User Remarks"
                            :value="
                              forPrintData.length
                                ? forPrintData[0].remarks
                                : null
                            "
                            disabled
                          ></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="new-section-sm bord-no" />
                <div class="invoice-bill2 row">
                  <div class="col-lg-4">
                    <address>
                      <p class="bord-btm pad-ver text-main text-bold">Prepared By</p>
                      <h5 class="text-main">
                        <em>
                          {{
                          approvedByResult.length
                          ? approvedByResult[0].app_by.name
                          : null
                          }}
                        </em>
                      </h5>
                      <hr class="new-section-sm bord-no" />
                      <br />Date Approved:
                      <br />
                      <strong class="text-main">
                        {{
                        !approvedByResult.length
                        ? null
                        : approvedByResult[0].date_app | formatDateNoTime
                        }}
                      </strong>
                    </address>
                  </div>
                  <div class="col-lg-4">
                    <address>
                      <p class="bord-btm pad-ver text-main text-bold">Noted By</p>
                      <h4 class="text-main">
                        <em></em>
                      </h4>
                      <hr class="new-section-sm bord-no" />
                      <hr class="new-section-sm bord-no" />
                      <br />Date Approved:
                      <strong class="text-main"></strong>
                    </address>
                  </div>
                  <div class="col-lg-4">
                    <address>
                      <p class="bord-btm pad-ver text-main text-bold">Approved By</p>
                      <h4 class="text-main"></h4>
                      <hr class="new-section-sm bord-no" />
                      <hr class="new-section-sm bord-no" />
                      <br />Date Approved:
                      <br />
                      <strong class="text-main"></strong>
                    </address>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="closePrintMdl()"
              >Close</button>
              <a href="javascript:window.print()" class="btn btn-primary">
                <i class="demo-pli-printer icon-lg"></i> Print Report
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="viewApprovedCustomerMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-scrollable modal-lg"
        role="document"
        style="margin-top: 50px"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approved Customer/s</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div class="panel-body">
                <div>
                  <p
                    class="bord-btm pad-ver text-main text-bold text-uppercase"
                  >{{ viewAppCustomerData.store_name }}</p>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="col-lg-12 text-xs-center">
                        <address>
                          <strong class="text-main">
                            {{
                            viewAppCustomerData.owner_name
                            }}
                          </strong>
                          <br />
                          <a
                            :href="
                              form.url +
                                viewAppCustomerData.street_add +
                                '+' +
                                viewAppCustomerData.bar_name +
                                ',+' +
                                viewAppCustomerData.mun_name +
                                ',+' +
                                viewAppCustomerData.province
                            "
                            class="btn-link"
                            target="_new"
                          >
                            <i class="fa fa-map-marker"></i>
                            {{
                            viewAppCustomerData.street_add +
                            ', ' +
                            viewAppCustomerData.bar_name
                            }}
                            <br />
                            {{
                            viewAppCustomerData.landmark +
                            ', ' +
                            viewAppCustomerData.mun_name +
                            ', ' +
                            viewAppCustomerData.district +
                            ', ' +
                            viewAppCustomerData.province
                            }}
                          </a>

                          <br />
                          {{ '+63' + viewAppCustomerData.mobile_number }}
                          <br />
                        </address>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <table class="invoice-details">
                        <tbody>
                          <tr>
                            <td class="text-main text-bold">DTI No</td>
                            <td
                              class="text-right text-info text-bold"
                            >{{ viewAppCustomerData.dti_no }}</td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Status</td>
                            <td class="text-right">
                              <span class="badge badge-success">
                                {{
                                viewAppCustomerData.status
                                }}
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Date</td>
                            <td class="text-right">{{ viewAppCustomerData.date_req | formatDate }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- <hr class="new-section-sm bord-no" /> -->
                <div class="pad-ver" v-if="viewAppCustomerData.path">
                  <p class="text-main text-bold box-inline">
                    <i class="demo-psi-paperclip icon-fw"></i> Attachments
                    <span>(1) -</span>
                  </p>
                  <a href="javascript:;" class="btn-link">Download all</a> |
                  <a href="javascript:;" class="btn-link">View all images</a>

                  <ul class="mail-attach-list list-ov">
                    <li>
                      <a
                        :href="`/storage/${viewAppCustomerData.path}`"
                        class="thumbnail"
                        target="_blank"
                      >
                        <div class="mail-file-img">
                          <img
                            class="image-responsive"
                            :src="`/storage/${viewAppCustomerData.path}`"
                            alt="image"
                          />
                        </div>
                        <div class="caption">
                          <p class="text-main mar-no">{{ viewAppCustomerData.path | fileName }}</p>
                          <small
                            class="text-muted"
                          >{{ viewAppCustomerData.created_at | formatDate }}</small>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="pad-ver" v-else>
                  <p class="text-main text-bold box-inline">
                    <i class="demo-psi-paperclip icon-fw"></i> No attachments available
                    <span>(0)</span>
                  </p>
                </div>
                <hr class="new-section-sm bord-no" v-if="!viewAppCustomerData.path" />
                <div class="row">
                  <div class="form-group has-feedback">
                    <label class="col-lg-2 strong text-bold" style="color: #4d627b">Remarks:</label>
                    <div class="col-lg-9">
                      <textarea
                        class="form-control"
                        name="message"
                        rows="3"
                        :value="viewAppCustomerData.remarks"
                        disabled
                      ></textarea>
                    </div>
                  </div>
                </div>
                <hr class="new-section-sm bord-no" />
                <div class="row">
                  <div class="col-lg-4">
                    <!-- <h4 class="pad-btm bord-btm">Prepared By</h4> -->
                  </div>
                  <div class="col-lg-4">
                    <p class="bord-btm pad-ver text-main text-bold">Noted By</p>
                    <address>
                      <h4 class="text-main">
                        <em></em>
                      </h4>
                      <br />
                      <br />Date Approved:
                      <br />
                      <strong class="text-main"></strong>
                    </address>
                  </div>
                  <div class="col-lg-4">
                    <p class="bord-btm pad-ver text-main text-bold">Approved By</p>
                    <address>
                      <h4 class="text-main">
                        <em>{{ viewAppCustomerData.name }}</em>
                      </h4>
                      <br />
                      <br />Date Approved:
                      <br />
                      <strong class="text-main">{{ viewAppCustomerData.date_app | formatDate }}</strong>
                    </address>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button
                type="button"
                class="btn btn-primary"
                @click="submitBtn()"
                :disabled="!form.remarks"
              >Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="viewRejectedCustomerMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-scrollable modal-lg"
        role="document"
        style="margin-top: 50px"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rejected Customer/s</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div class="panel-body">
                <div class="well well-sm">
                  <p class="text-bold text-main text-uppercase">PLEASE NOTE</p>
                  <p>
                    Rejected Customers can not be able/ nor use the app due to
                    the remarks given below.
                  </p>
                  <p>
                    If you have any questions or make any changes concerning
                    this request, please contact
                    <strong
                      class="text-main"
                    >AGC E-Commerce Distribution Team</strong>
                  </p>
                </div>
                <div>
                  <p
                    class="bord-btm pad-ver text-main text-bold text-uppercase"
                  >{{ viewRejCustomerData.store_name }}</p>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="col-lg-12 text-xs-center">
                        <address>
                          <strong class="text-main">
                            {{
                            viewRejCustomerData.owner_name
                            }}
                          </strong>
                          <br />
                          <a
                            :href="
                              form.url +
                                viewRejCustomerData.street_add +
                                '+' +
                                viewRejCustomerData.bar_name +
                                ',+' +
                                viewRejCustomerData.mun_name +
                                ',+' +
                                viewRejCustomerData.province
                            "
                            class="btn-link"
                            target="_new"
                          >
                            <i class="fa fa-map-marker"></i>
                            {{
                            viewRejCustomerData.street_add +
                            ', ' +
                            viewRejCustomerData.bar_name
                            }}
                            <br />
                            {{
                            viewRejCustomerData.landmark +
                            ', ' +
                            viewRejCustomerData.mun_name +
                            ', ' +
                            viewRejCustomerData.district +
                            ', ' +
                            viewRejCustomerData.province
                            }}
                          </a>
                          <br />
                          {{ '+63' + viewRejCustomerData.mobile_number }}
                          <br />
                        </address>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <table class="invoice-details">
                        <tbody>
                          <tr>
                            <td class="text-main text-bold">DTI No</td>
                            <td
                              class="text-right text-info text-bold"
                            >{{ viewRejCustomerData.dti_no }}</td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Status</td>
                            <td class="text-right">
                              <span class="badge badge-danger">
                                {{
                                viewRejCustomerData.status
                                }}
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Date</td>
                            <td class="text-right">{{ viewRejCustomerData.date_req | formatDate }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr class="new-section-sm bord-no" />
                <div class="row">
                  <div class="form-group has-feedback">
                    <label class="col-lg-2 strong text-bold" style="color: #4d627b">Remarks:</label>
                    <div class="col-lg-9">
                      <textarea
                        class="form-control"
                        name="message"
                        rows="3"
                        :value="viewRejCustomerData.remarks"
                        disabled
                      ></textarea>
                    </div>
                  </div>
                </div>
                <hr class="new-section-sm bord-no" />
                <div class="row">
                  <div class="col-lg-4">
                    <!-- <h4 class="pad-btm bord-btm">Prepared By</h4> -->
                  </div>
                  <div class="col-lg-4">
                    <!-- <p class="bord-btm pad-ver text-main text-bold">Noted By</p>
                    <address>
                      <h4 class="text-main">
                        <em></em>
                      </h4>
                      <br />
                      <br />Date Approved:
                      <br />
                      <strong class="text-main"></strong>
                    </address>-->
                  </div>
                  <div class="col-lg-4">
                    <p class="bord-btm pad-ver text-main text-bold">Rejected By</p>
                    <address>
                      <h4 class="text-main">
                        <em>{{ viewRejCustomerData.name }}</em>
                      </h4>
                      <br />
                      <br />Date Rejected:
                      <br />
                      <strong class="text-main">{{ viewRejCustomerData.date_app | formatDate }}</strong>
                    </address>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button
                type="button"
                class="btn btn-primary"
                @click="submitBtn()"
                :disabled="!form.remarks"
              >Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="exportMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>-->
          <div class="modal-body">
            <div class="cls-content text-center">
              <h1 class="error-code text-muted">
                <i class="demo-psi-gear icon-2x"></i>
              </h1>
              <p class="h4 text-uppercase text-bold">Website under maintenance...</p>
              <div class="pad-btm">
                Our website is currently undergoing scheduled maintenance.
                <br />We should be back shortly. Thank you for your patience.
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
import { serialize } from "object-to-formdata";

Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component(HasError.name, HasError);
var pdate = Vue.extend({
  template: `<div class="input-group date" id="pending_dates" aria-disabled>
    <input type="text" class="form-control" placeholder="yyyy-mm-dd" @keyup.delete="log($event)" />
    <span class="input-group-addon">
    <i class="demo-pli-calendar-4"></i>
    </span>
    </div>`,
  data: function () {
    return {};
  },
  ready: function () {},
  methods: {
    log(e) {
      e.target.value = "";
      this.$parent.pending_date = "";
      this.$parent.getPendingResults();
    },
  },
  mounted() {
    const self = this;
    const parent = this.$parent;

    $(this.$el)
      .datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        endDate: "+1d",
        clearBtn: true,
      })
      .on("changeDate", function (e) {
        self.$emit("input", e.format("yyyy-mm-dd"));
        axios
          .get(
            `/getCustomerRequests/date/?date=${e.format("yyyy-mm-dd")}&page=1`
          )
          .then((response) => {
            parent.customers = response.data;
            parent.form.total_pending_customers = response.data.total;
          });
      });
    // $(this.$el).datepicker('update', new Date())
  },
});

var pdate2 = Vue.extend({
  template: `<div class="input-group date" id="approve_date" aria-disabled>
    <input type="text" class="form-control" placeholder="yyyy-mm-dd" @keyup.delete="log($event)" />
    <span class="input-group-addon">
    <i class="demo-pli-calendar-4"></i>
    </span>
    </div>`,
  data: function () {
    return {};
  },
  ready: function () {},
  methods: {
    log(e) {
      e.target.value = "";
      this.$parent.approve_date = "";
      this.$parent.getApprovedResults();
    },
  },
  mounted() {
    const self = this;
    const parent = this.$parent;

    $(this.$el)
      .datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        endDate: "+1d",
        clearBtn: true,
      })
      .on("changeDate", function (e) {
        self.$emit("input", e.format("yyyy-mm-dd"));
        axios
          .get(
            `/getApprovedCustomers/date/?date=${e.format("yyyy-mm-dd")}&page=1`
          )
          .then((response) => {
            parent.approvedCustomers = response.data;
            parent.form.total_approved_customers = response.data.total;
          });
      });
    // $(this.$el).datepicker('update', new Date())
  },
});
Vue.component("datepicker", pdate);
Vue.component("datepicker2", pdate2);
export default {
  data() {
    return {
      show_su_div: false,
      customers: {
        data: [],
        current_page: null,
        from: 0,
        to: 0,
        total: 0,
        per_page: null,
      },
      approvedCustomers: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      rejectedCustomers: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null,
      },
      searchCustomer: null,
      searchCustomerApp: null,
      searchCustomerRej: null,
      checkboxes_id: [],
      form: new Form({
        total_result: null,
        total_app_result: null,
        total_rej_result: null,
        remarks: "",
        status: "",
        id: "",
        url: "https://www.google.com.ph/maps/place/",
        total_approved_customers: null,
        total_pending_customers: null,
      }),
      viewCustomerdata: [],
      viewAppCustomerData: [],
      viewRejCustomerData: [],
      allSelected: false,
      checkbox_approved: [],
      allSelected_approved: false,
      forPrintData: [],
      output: null,
      approvedByResult: [],
      pending_date: "",
      approve_date: "",
      disable: [],
      images: {},
    };
  },
  filters: {
    fileName(str) {
      const [path, name] = str.split("/");
      return name;
    },
  },
  methods: {
    selectAll_approved() {
      this.checkbox_approved = [];
      if (!this.allSelected_approved) {
        for (var test in this.approvedCustomers.data) {
          this.checkbox_approved.push(this.approvedCustomers.data[test]);
        }
      }
    },
    selectAll() {
      this.checkboxes_id = [];
      if (!this.allSelected) {
        for (var test in this.customers.data) {
          this.checkboxes_id.push(this.customers.data[test]);
        }
      }
    },
    search() {
      this.searchForPendingCustomers(this.searchCustomer, this);
    },
    searchForPendingCustomers: _.debounce((search, vm) => {
      if (!vm.pending_date) {
        axios
          .get(`/getCustomerRequests/customers/?store_name=${search}&page=1`)
          .then((response) => {
            vm.customers = response.data;
          });
      } else if (search && vm.pending_date) {
        axios
          .get(
            `/getCustomerRequests/customers/?date=${vm.pending_date}&store_name=${search}&page=1`
          )
          .then((response) => {
            vm.customers = response.data;
          });
      } else {
        axios
          .get(`/getCustomerRequests/customers/?date=${vm.pending_date}&page=1`)
          .then((response) => {
            vm.customers = response.data;
          });
      }
    }, 100),
    getPendingResults(page = 1) {
      let url = null;
      if (!this.searchCustomer) {
        url = "/getCustomerRequests/?page=";
        axios.get(url + page).then((response) => {
          this.form.total_result = response.data.total;
          this.$root.newRequest = response.data.total;
        });
      } else {
        url = `/getCustomerRequests/customers/?store_name=${this.searchCustomer}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.customers = response.data;
      });
    },

    searchApproved() {
      this.searchAppCustomers(this.searchCustomerApp, this);
    },
    searchAppCustomers: _.debounce((search2, vm) => {
      if (!vm.approve_date) {
        axios
          .get(`/getApprovedCustomers/customers/?store_name=${search2}&page=1`)
          .then((response) => {
            vm.approvedCustomers = response.data;
          });
      } else if (search2 && vm.approve_date) {
        axios
          .get(
            `/getApprovedCustomers/customers/?date=${vm.approve_date}&store_name=${search2}&page=1`
          )
          .then((response) => {
            vm.approvedCustomers = response.data;
          });
      } else {
        axios
          .get(
            `/getApprovedCustomers/customers/?date=${vm.approve_date}&page=1`
          )
          .then((response) => {
            vm.approvedCustomers = response.data;
          });
      }
    }, 100),
    getApprovedResults(page = 1) {
      let url = null;
      if (!this.searchCustomer) {
        url = "/getApprovedCustomers/?page=";
        axios.get(url + page).then((response) => {
          this.form.total_app_result = response.data.total;
        });
      } else {
        url = `/getApprovedCustomers/customers/?store_name=${this.searchCustomerApp}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.approvedCustomers = response.data;
      });
    },

    searchRejected() {
      this.searchRejCustomers(this.searchCustomerRej, this);
    },
    searchRejCustomers: _.debounce((search3, vm) => {
      axios
        .get(`/getRejectedCustomers/customers/?store_name=${search3}&page=1`)
        .then((response) => {
          vm.rejectedCustomers = response.data;
        });
    }, 100),
    getRejectedResults(page = 1) {
      let url = null;
      if (!this.searchCustomerRej) {
        url = "/getRejectedCustomers/?page=";
        axios.get(url + page).then((response) => {
          this.form.total_rej_result = response.data.total;
        });
      } else {
        url = `/getRejectedCustomers/customers/?store_name=${this.searchCustomerRej}&page=`;
      }
      axios.get(url + page).then((response) => {
        this.rejectedCustomers = response.data;
      });
    },
    viewCustomer(MgaCustomer) {
      $("#viewCustomerMdl").modal("show");
      this.viewCustomerdata = MgaCustomer;
    },
    getApprovedBy() {
      const selectedId = this.checkboxes_id.map((cb) => cb.id);
      return axios.post(`/approvedBy`, { selectedId });
    },
    submitBtn(test) {
      $("#container").css("position", "sticky");
      $("#viewCustomerMdl").modal("hide");
      $("#approveCustomersMdl").modal("hide");
      const ids = test.map((item) => item.id);
      this.form.ids = ids;
      let formData = new FormData();
      ids.forEach((id) => {
        this.form[`image-${id}`] = this.$refs[`images-${id}`][0].files[0];
      });
      // return console.log(this.form)
      if (this.form.status == "Approved") {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, confirm!",
          allowOutsideClick: false,
        }).then((result) => {
          if (result.value) {
            this.form
              .post("/approveCustomer", {
                transformRequest: [
                  function (data, headers) {
                    return serialize(data);
                  },
                ],
              })
              .then(({ data, status }) => {
                if (status === 200) {
                  Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    allowOutsideClick: false,
                    confirmButtonText: "Okay",
                  }).then((result) => {
                    if (result.value) {
                      $("#container").css("position", "relative");
                      this.forPrintData = this.checkboxes_id.map((check) => {
                        check.status = "Approved";
                        check.approved_by = window.authUser.id;
                        check.remarks = this.form.remarks;
                        return check;
                      });
                      this.getPendingResults();
                      this.getApprovedResults();
                      this.getApprovedBy().then(({ data }) => {
                        this.approvedByResult = data;
                        $("#approvedCustPrint").modal("show");
                        this.clear();
                      });
                    }
                  });
                }
              })
              .catch((error) => {
                console.log(error.response);
                $.niftyNoty({
                  type: "danger",
                  icon: "pli-cross icon-2x",
                  message:
                    '<i class="fa fa-exclamation-circle"></i> Opps... Something wrong',
                  container: "floating",
                  timer: 5000,
                });
                $("#container").css("position", "relative");
                $("#approveCustomersMdl").modal("show");
              });
          } else {
            $.niftyNoty({
              type: "danger",
              icon: "pli-cross icon-2x",
              message:
                '<i class="fa fa-exclamation-circle"></i> Action has been canceled.',
              container: "floating",
              timer: 5000,
            });
            $("#container").css("position", "relative");
            $("#approveCustomersMdl").modal("show");
          }
        });
      } else {
        //For reject
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, confirm!",
          allowOutsideClick: false,
        }).then((result) => {
          if (result.value) {
            this.form
              .post("/rejectCustomer")
              .then(({ data, status }) => {
                if (status === 200) {
                  Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    allowOutsideClick: false,
                  }).then((result) => {
                    if (result.value) {
                      $("#container").css("position", "relative");
                      this.clear();
                      this.getPendingResults();
                      this.getRejectedResults();
                      $.niftyNoty({
                        type: "danger",
                        icon: "pli-cross icon-2x",
                        message:
                          '<i class="fa fa-info-circle"></i> Rejected customer/s wont be able to use the app.',
                        container: "floating",
                        timer: 5000,
                      });
                    }
                  });
                }
              })
              .catch((error) => {
                console.log(error.response);
                $.niftyNoty({
                  type: "danger",
                  icon: "pli-cross icon-2x",
                  message:
                    '<i class="fa fa-exclamation-circle"></i> Opps... Something wrong',
                  container: "floating",
                  timer: 5000,
                });
                $("#container").css("position", "relative");
                $("#approveCustomersMdl").modal("show");
              });
          } else {
            $.niftyNoty({
              type: "danger",
              icon: "pli-cross icon-2x",
              message:
                '<i class="fa fa-exclamation-circle"></i> Action has been canceled.',
              container: "floating",
              timer: 5000,
            });
            $("#container").css("position", "relative");
            $("#approveCustomersMdl").modal("show");
          }
        });
      }
    },
    test() {
      $("#approveCustomersMdl").modal("show");
      $("#ModalLabel").html("Approve Customer/s");
      this.form.status = "Approved";
    },
    singleApprove(id, MgaCustomers) {
      this.checkboxes_id = [];
      this.allSelected = false;
      this.checkboxes_id.push(MgaCustomers);
      $("#approveCustomersMdl").modal("show");
      $("#ModalLabel").html("Approve Customer/s");
      this.form.status = "Approved";
    },
    singleReject(id, MgaCustomers) {
      this.checkboxes_id = [];
      this.allSelected = false;
      this.checkboxes_id.push(MgaCustomers);
      $("#approveCustomersMdl").modal("show");
      $("#ModalLabel").html("Reject Customer/s");
      this.form.status = "Rejected";
    },
    clear() {
      this.checkboxes_id = [];
      this.allSelected = false;
      this.form.remarks = "";
    },
    clearViewData() {
      this.viewCustomerdata = [];
    },
    reject() {
      $("#approveCustomersMdl").modal("show");
      $("#ModalLabel").html("Reject Customer/s");
      this.form.status = "Rejected";
    },
    viewApproveBtn(data) {
      console.log(data);
      $("#viewApprovedCustomerMdl").modal("show");
      this.viewAppCustomerData = data;
      // axios.get(`/`).then(({data}) => {

      // }).catch(error => console.log(error.response));
    },
    viewRejectedBtn(data) {
      this.viewRejCustomerData = data;
      $("#viewRejectedCustomerMdl").modal("show");
    },
    exportBtn() {
      // axios.get(`/exportCustomerRequest`)
      // let query = '?'
      // ;[1, 2, 3, 4, 5].forEach(id => {
      //   query += `id[]=${id}&`
      // })
      // console.log(this.checkbox_approved.store_name)
      const ids = this.checkbox_approved.map((check) => check.id);
      let query = "?";
      ids.forEach((id) => {
        query += `id[]=${id}&`;
      });
      document.location.href = `/exportCustomerRequest/${query}`;
    },
    print() {
      // Pass the element id here
      this.$htmlToPaper("printMe");
    },
    closePrintMdl() {
      $.niftyNoty({
        type: "info",
        icon: "pli-cross icon-2x",
        message:
          '<i class="fa fa-info-circle"></i> Approved customers can now be able to use the App.',
        container: "floating",
        timer: 5000,
      });
    },
    myChangeFunction() {
      alert("1");
    },
    onFile(formId) {
      this.disable[formId] = true;
      $("#dz-remove-btn-" + formId).css("display", "block");
    },
    resetBtn(formId) {
      this.disable[formId] = false;
      document.getElementById(`myForm${formId}`).reset();
      $("#dz-remove-btn-" + formId).css("display", "none");
    },
  },
  mounted() {
    this.getPendingResults();
    this.getApprovedResults();
    this.getRejectedResults();
    $("#container").css("position", "relative");
    // $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    //   $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust()
    // })

    // $('#demo-dp-txtinput input').datepicker({ autoclose: true })
    // $('#pending_dates').datepicker({
    //   format: 'yyyy-mm-dd',
    //   autoclose: true,
    //   todayBtn: 'linked',
    //   autoclose: true,
    //   todayHighlight: true,
    //   endDate: '+1d'
    // })
    // $('#pending_dates').datepicker('update', new Date())

    $("#rejected_dates").datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      todayBtn: "linked",
      autoclose: true,
      todayHighlight: true,
      endDate: "+0d",
    });
    // $('#rejected_dates').datepicker('update', new Date())

    window.onafterprint = function () {
      alert("Printing completed...");
    };
    this.$root.currentPage = this.$route.meta.name;
  },
};
</script>
<style scoped>
/** @format */
.modal-dialog.modal-dialog-scrollable.modal-lg {
  width: 900px;
}

#container .table th {
  font-size: 1.05em;
  font-weight: 600;
  border-bottom: 3px solid rgba(0, 0, 0, 0.07);
  color: #4d627b;
}

#container .table-hover > tbody > tr:hover {
  background-color: rgb(0 0 0 / 5%);
}
.spacer {
  display: none;
}
@media print {
  a[href]:after {
    content: none !important;
  }
  .spacer {
    display: block;
  }
  #container .invoice-bill2 {
    display: flex;
    margin-top: -70px;
  }
  #container .invoice-bill2 .col-lg-4 {
    float: left;
    max-width: 100%;
    width: 50%;
  }
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
