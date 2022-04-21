<!-- @format -->
<template>
  <div id="page-body">
    <div class="panel">
      <div
        class="panel-heading"
        id="showTitle"
        v-if="!show_su_div && !show_edit"
      >
        <h3 class="panel-title" style="font-weight: bold">
          <i class="fa fa-vcard-o"></i> Viewing User
        </h3>
      </div>

      <div class="panel-body" v-if="!show_su_div && !show_edit" id="tblDtl">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-12">
            <button
              class="btn btn-success btn-rounded pull-right btn-sm"
              @click="addBtn()"
            >
              <i class="fa fa-plus-circle"></i> New User
            </button>
          </div>
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
                    @keyup="search"
                    v-model="searchUser"
                    placeholder="Search Name"
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
              <th>First Name</th>
              <th>Last Name</th>
              <th>Department</th>
              <th>Division</th>
              <th>Username</th>
              <th>Address</th>
              <th>User Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!users.data.length">
              <td colspan="9" class="text-center">No data available</td>
            </tr>

            <tr v-for="MgaUsers in users.data" :key="MgaUsers.id">
              <td class="text-bold" style="font-size: 12px">
                {{ MgaUsers.first_name }}
              </td>
              <td style="font-size: 12px">{{ MgaUsers.last_name }}</td>
              <td style="font-size: 12px">
                {{ MgaUsers.department }}
              </td>
              <td style="font-size: 12px">
                {{ MgaUsers.division }}
              </td>
              <td style="font-size: 12px">
                {{ MgaUsers.username }}
              </td>
              <td style="font-size: 12px">
                {{ MgaUsers.address }}
              </td>
              <td style="font-size: 12px">
                {{ MgaUsers.user_code }}
              </td>

              <td>
                <div class="btn-group dropdown" v-if="MgaUsers.status == '1'">
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
                        @click="btn_activation(MgaUsers.id, '1')"
                        >Active</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        style="color: red"
                        @click="btn_activation(MgaUsers.id, '0')"
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
                        @click="btn_activation(MgaUsers.id, '1')"
                        >Active</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        style="color: red"
                        @click="btn_activation(MgaUsers.id, '0')"
                        >Inactive</a
                      >
                    </li>
                  </ul>
                </div>
                <button
                  class="btn btn-xs btn-info"
                  @click="editBtn(MgaUsers, 1)"
                >
                  <i class="fa fa-edit"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ users.from }} to {{ users.to }} of
              {{ users.total }} entries
              <span v-if="searchUser"
                >(Filtered from {{ total_result }} total entries)</span
              >
            </div>
            <div class="col-md-6">
              <!-- <div class="text-right">
                <pagination
                  style="margin: 0 0 20px 0"
                  :limit="1"
                  :show-disabled="true"
                  :data="users"
                  @pagination-change-page="getResults"
                ></pagination>
              </div> -->
            </div>
          </div>
        </div>
      </div>

      <div class="panel-body" v-if="show_su_div">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-6" style="padding: 15px">
            <h5 class="text-main" style="font-weight: bold">
              <i class="fa fa-address-card-o"></i> Viewing User Setup
            </h5>
          </div>
          <div class="col-lg-6" style="padding: 15px">
            <button
              class="btn btn-primary btn-rounded pull-right btn-sm"
              @click="addBtn()"
            >
              <i class="fa fa-arrow-left"></i> Back
            </button>
          </div>
        </div>
        <div class="panel-body">
          <form id="submitForm" @submit.prevent="submitFormBtn">
            <input type="hidden" v-model="form.id" disabled />
            <div class="row">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-3">
                    <h4 style="font-weight: bold; text-decoration: underline">
                      Information
                    </h4>
                  </div>
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3">
                    <h4 style="font-weight: bold; text-decoration: underline">
                      Location
                    </h4>
                  </div>
                  <div class="col-sm-3"></div>
                </div>

                <!-- 1ST COLUMN -->
                <div class="col-sm-3">
                  <div
                    class="form-group"
                    :class="{
                      'has-error': form.errors.has('first_name')
                    }"
                  >
                    <label class="control-label text-main text-bold">
                      First name:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('first_name')"
                      type="text"
                      class="form-control"
                      v-model="form.first_name"
                      placeholder="First Name"
                    />
                    <has-error :form="form" field="first_name"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{
                      'has-error': form.errors.has('last_name')
                    }"
                  >
                    <label class="control-label text-main text-bold">
                      Last name:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('last_name')"
                      type="text"
                      class="form-control"
                      v-model="form.last_name"
                      placeholder="Last Name"
                    />
                    <has-error :form="form" field="last_name"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{
                      'has-error': form.errors.has('username')
                    }"
                  >
                    <label class="control-label text-main text-bold">
                      Username:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('username')"
                      type="text"
                      class="form-control"
                      id="username"
                      v-model="form.username"
                      placeholder="Username"
                    />
                    <has-error :form="form" field="username"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('password') }"
                  >
                    <label class="control-label text-main text-bold">
                      Password:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('password')"
                      type="password"
                      class="form-control"
                      v-model="form.password"
                      placeholder="Password"
                    />
                    <has-error :form="form" field="password"></has-error>
                  </div>
                </div>

                <!-- 2ND COLUMN -->
                <div class="col-sm-3">
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('email') }"
                  >
                    <label class="control-label text-main text-bold">
                      Email:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('email')"
                      type="email"
                      class="form-control"
                      name="email"
                      v-model="form.email"
                      placeholder="email@sample.com"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('telephone') }"
                  >
                    <label class="control-label text-main text-bold">
                      Telephone:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('telephone')"
                      type="text"
                      class="form-control"
                      id="telephone"
                      name="telephone"
                      placeholder="Telephone"
                      v-model="form.telephone"
                    />
                    <has-error :form="form" field="telephone"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('mobile') }"
                  >
                    <label class="control-label text-main text-bold">
                      Mobile:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @keyup="checkmobile"
                      type="text"
                      id="mobile"
                      class="form-control"
                      placeholder="+639999999999"
                    />
                    <has-error :form="form" field="mobile"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('user_code') }"
                  >
                    <label class="control-label text-main text-bold">
                      User Code:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('user_code')"
                      type="text"
                      class="form-control"
                      id="user_code"
                      v-model="form.user_code"
                      placeholder="User Code"
                    />
                    <has-error :form="form" field="user_code"></has-error>
                  </div>
                </div>

                <!-- 3RD COLUMN -->
                <div class="col-sm-3">
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('address') }"
                  >
                    <label class="control-label text-main text-bold">
                      Address:
                      <span style="color: red">*</span>
                    </label>

                    <select
                      class="form-control"
                      v-model="form.address"
                      data-placeholder="Select Address"
                      id="address"
                      style="width: 240px"
                      @change="changeAddress()"
                    >
                      <optgroup label="Address">
                        <option
                          v-for="mun in municipality"
                          :key="mun.id"
                          :value="mun.mun_name"
                        >
                          {{ mun.mun_name }}
                        </option>
                      </optgroup>
                    </select>
                    <has-error :form="form" field="address"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('department') }"
                  >
                    <label class="control-label text-main text-bold">
                      Department:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('department')"
                      type="text"
                      class="form-control"
                      v-model="form.department"
                      placeholder="Department"
                    />
                    <has-error :form="form" field="department"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('division') }"
                  >
                    <label class="control-label text-main text-bold"
                      >Division:</label
                    >
                    <span style="color: red">*</span>
                    <select
                      class="form-control"
                      v-model="form.division"
                      @change="divisionSlct()"
                      placeholder="Select"
                    >
                      <option value="">Select Division</option>
                      <option value="ADM">ADM</option>
                    </select>
                    <has-error :form="form" field="division"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('area') }"
                  >
                    <label class="control-label text-main text-bold"
                      >Area:</label
                    >
                    <span style="color: red">*</span>
                    <input
                      @input="form.errors.clear('area')"
                      type="text"
                      class="form-control"
                      v-model="form.area"
                      id="area"
                      placeholder="Area"
                    />
                    <has-error :form="form" field="area"></has-error>
                  </div>

                  <div
                    class="form-group"
                    :class="{
                      'has-error': form.errors.has('assigned_warehouse')
                    }"
                  >
                    <label class="control-label text-main text-bold">
                      Assigned Warehouse:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('assigned_warehouse')"
                      type="text"
                      class="form-control"
                      v-model="form.assigned_warehouse"
                      placeholder="Product Line"
                    />
                    <has-error
                      :form="form"
                      field="assigned_warehouse"
                    ></has-error>
                  </div>
                </div>

                <!-- 4th COLUMN -->
                <div class="col-sm-3">
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('district') }"
                  >
                    <label class="control-label text-main text-bold">
                      District:
                      <span style="color: red">*</span>
                    </label>
                    <!-- <input
                      @input="form.errors.clear('district')"
                      type="text"
                      class="form-control"
                      v-model="form.district"
                      id="district"
                      placeholder="District"
                    />-->

                    <select
                      v-model="form.district"
                      id="district-select"
                      class="form-control"
                      tabindex="4"
                      style="width: 240px"
                      @change="onChangeDistrict()"
                    >
                      <option value>Select District</option>
                      <option value="District I">District I</option>
                      <option value="District II">District II</option>
                      <option value="District III">District III</option>
                    </select>
                    <has-error :form="form" field="district"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('title') }"
                  >
                    <label class="control-label text-main text-bold"
                      >Title:</label
                    >
                    <span style="color: red">*</span>
                    <input
                      @input="form.errors.clear('title')"
                      type="text"
                      class="form-control"
                      v-model="form.title"
                      placeholder="Title"
                    />
                    <has-error :form="form" field="title"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('postal_code') }"
                  >
                    <label class="control-label text-main text-bold">
                      Postal Code:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('postal_code')"
                      type="text"
                      class="form-control"
                      name="postal_code"
                      id="postal_code"
                      v-model="form.postal_code"
                      placeholder="Postal Code"
                    />
                    <has-error :form="form" field="postal_code"></has-error>
                  </div>
                  <div
                    class="form-group"
                    :class="{ 'has-error': form.errors.has('product_line') }"
                  >
                    <label class="control-label text-main text-bold">
                      Product Line:
                      <span style="color: red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('product_line')"
                      type="text"
                      class="form-control"
                      v-model="form.product_line"
                      placeholder="Product Line"
                    />
                    <has-error :form="form" field="product_line"></has-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="height: 35px"></div>
            <div class="row" style="margin: 0px 0px 10px 0px">
              <div class="col-lg-6" style="padding: 15px"></div>
              <div class="col-lg-6" style="padding: 15px">
                <router-link to>
                  <a href="javascript:;">
                    <button
                      class="btn btn-success btn-rounded pull-right"
                      id="submitFormBtn"
                      type="submit"
                      @click="submitBtn()"
                      :disabled="!form.user_code"
                    >
                      <i class="fa fa-check"></i> Submit
                    </button>
                  </a>
                </router-link>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="panel-body" v-if="show_edit">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-6" style="padding: 15px">
            <h5 class="text-main" style="font-weight: bold">
              <i class="fa fa-address-card-o"></i> Viewing User Setup
            </h5>
          </div>
          <div class="col-lg-6" style="padding: 15px">
            <button
              class="btn btn-primary btn-rounded pull-right btn-sm"
              @click="clear()"
            >
              <i class="fa fa-arrow-left"></i> Back
            </button>
          </div>
        </div>
        <div class="panel-body">
          <form id="submitForm" @submit.prevent="submitFormBtn">
            <div class="row">
              <div
                class="col-sm-3"
                style="border-right: 1px solid rgba(0, 0, 0, 0.07)"
              >
                <div class="fixed-md-200">
                  <!-- Simple profile -->
                  <div class="text-center">
                    <div class="pad-ver">
                      <img
                        src="assets/img/profile-photos/1.png"
                        class="img-lg img-circle"
                        alt="Profile Picture"
                      />
                    </div>
                    <h4 class="text-lg text-overflow mar-no">
                      {{ form.first_name + ' ' + form.last_name }}
                    </h4>
                    <p class="text-sm text-muted" style="margin: 0 0 4px">
                      {{ form.user_code }}
                    </p>
                    <p class="text-sm text-muted">
                      <span
                        v-if="form.status == 1"
                        style="margin-bottom: 10px"
                        class="label label-success"
                        >ACTIVE</span
                      >

                      <span
                        v-else
                        style="margin-bottom: 10px"
                        class="label label-danger"
                        >INACTIVE</span
                      >
                    </p>
                  </div>
                  <div class="text-center pad-to">
                    <div class="btn-group">
                      <a href="#" class="btn btn-sm btn-default">
                        <i class="demo-pli-consulting icon-lg icon-fw"></i> Edit
                      </a>
                      <!-- <a href="#" class="btn btn-sm btn-default">
                        <i class="demo-pli-mail icon-lg icon-fw"></i> Email
                      </a>-->
                      <a
                        href="javascript:;"
                        class="btn btn-sm btn-default"
                        @click="passwordBtn()"
                      >
                        <i class="fa fa-lock"></i> Password
                      </a>
                    </div>
                  </div>

                  <!-- Profile Details -->
                  <p class="pad-ver text-main text-sm text-uppercase text-bold">
                    About
                  </p>
                  <p>
                    <i class="demo-pli-add-user icon-lg icon-fw"></i>
                    {{ form.username }}
                  </p>
                  <p>
                    <i class="demo-pli-internet icon-lg icon-fw"></i>
                    {{ form.division }}
                  </p>
                  <!-- <p>
                    <a
                      href="https://www.google.com/maps/place/Island+City+Mall/@9.6553174,123.8675411,17z/data=!3m1!4b1!4m5!3m4!1s0x33aa4c30923688e3:0xbf744e652643049b!8m2!3d9.6553121!4d123.8697298"
                      class="btn-link"
                      target="_new"
                    >
                      <i class="demo-pli-map-marker-2 icon-lg icon-fw"></i> Island City Mall, Rajah Sikatuna Avenue, Tagbilaran City, Bohol
                    </a>
                  </p>-->
                  <p>
                    <i class="demo-pli-smartphone-3 icon-lg icon-fw"></i>
                    {{ form.mobile }}
                  </p>
                  <!-- <hr /> -->
                </div>
              </div>
              <div class="col-sm-9">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="pad-btm bord-btm" style="font-weight: bold">
                        Information
                      </h4>
                    </div>
                  </div>
                  <div class="row">
                    <!-- 1ST COLUMN -->
                    <div class="col-sm-6">
                      <div
                        class="form-group"
                        :class="{
                          'has-error': form.errors.has('first_name')
                        }"
                      >
                        <label class="control-label text-main text-bold">
                          First name:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('first_name')"
                          type="text"
                          class="form-control"
                          v-model="form.first_name"
                          placeholder="First Name"
                        />
                        <has-error :form="form" field="first_name"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{
                          'has-error': form.errors.has('last_name')
                        }"
                      >
                        <label class="control-label text-main text-bold">
                          Last name:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('last_name')"
                          type="text"
                          class="form-control"
                          v-model="form.last_name"
                          placeholder="Last Name"
                        />
                        <has-error :form="form" field="last_name"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{
                          'has-error': form.errors.has('username')
                        }"
                      >
                        <label class="control-label text-main text-bold">
                          Username:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('username')"
                          type="text"
                          class="form-control"
                          id="username"
                          v-model="form.username"
                          placeholder="Username"
                        />
                        <has-error :form="form" field="username"></has-error>
                      </div>

                      <!-- <div
                    class="form-group"
                    :class="{'has-error': form.errors.has('password')
                    }"
                  >
                    <label class="control-label text-main text-bold">
                      password:
                      <span style="color:red">*</span>
                    </label>
                    <input
                      @input="form.errors.clear('password')"
                      type="text"
                      class="form-control"
                      id="password"
                      v-model="form.password"
                      placeholder="password"
                    />
                    <has-error :form="form" field="password"></has-error>
                      </div>-->
                    </div>

                    <!-- 2ND COLUMN -->
                    <div class="col-sm-6">
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('email') }"
                      >
                        <label class="control-label text-main text-bold">
                          Email:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('email')"
                          type="email"
                          class="form-control"
                          name="email"
                          v-model="form.email"
                          placeholder="email@sample.com"
                        />
                        <has-error :form="form" field="email"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('telephone') }"
                      >
                        <label class="control-label text-main text-bold">
                          Telephone:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('telephone')"
                          type="text"
                          class="form-control"
                          id="telephone"
                          name="telephone"
                          placeholder="Telephone"
                          v-model="form.telephone"
                        />
                        <has-error :form="form" field="telephone"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('mobile') }"
                      >
                        <label class="control-label text-main text-bold">
                          Mobile:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          v-on:input="form.errors.clear('mobile')"
                          type="text"
                          id="mobile"
                          class="form-control"
                          placeholder="+639999999999"
                        />
                        <has-error :form="form" field="mobile"></has-error>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="pad-btm bord-btm" style="font-weight: bold">
                        Location
                      </h4>
                    </div>
                  </div>
                  <div class="row">
                    <!-- 3RD COLUMN -->
                    <div class="col-sm-6">
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('address') }"
                      >
                        <label class="control-label text-main text-bold">
                          Address:
                          <span style="color: red">*</span>
                        </label>
                        <select
                          class="form-control"
                          v-model="form.address"
                          data-placeholder="Select Address"
                          id="address"
                          style="width: 350px"
                        >
                          <optgroup label="Address">
                            <option
                              v-for="mun in municipality"
                              :key="mun.id"
                              :value="mun.mun_name"
                            >
                              {{ mun.mun_name }}
                            </option>
                          </optgroup>
                        </select>
                        <has-error :form="form" field="address"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('department') }"
                      >
                        <label class="control-label text-main text-bold">
                          Department:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('department')"
                          type="text"
                          class="form-control"
                          v-model="form.department"
                          placeholder="Department"
                        />
                        <has-error :form="form" field="department"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('area') }"
                      >
                        <label class="control-label text-main text-bold"
                          >Area:</label
                        >
                        <span style="color: red">*</span>
                        <input
                          @input="form.errors.clear('area')"
                          type="text"
                          class="form-control"
                          v-model="form.area"
                          id="area"
                          placeholder="Area"
                        />
                        <has-error :form="form" field="area"></has-error>
                      </div>
                    </div>

                    <!-- 4th COLUMN -->
                    <div class="col-sm-6">
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('district') }"
                      >
                        <label class="control-label text-main text-bold">
                          District:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('district')"
                          type="text"
                          class="form-control"
                          v-model="form.district"
                          id="district"
                          placeholder="District"
                        />
                        <has-error :form="form" field="district"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{ 'has-error': form.errors.has('postal_code') }"
                      >
                        <label class="control-label text-main text-bold">
                          Postal Code:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('postal_code')"
                          type="text"
                          class="form-control"
                          id="postal_code"
                          name="postal_code"
                          v-model="form.postal_code"
                          placeholder="Postal Code"
                        />
                        <has-error :form="form" field="postal_code"></has-error>
                      </div>
                      <div
                        class="form-group"
                        :class="{
                          'has-error': form.errors.has('product_line')
                        }"
                      >
                        <label class="control-label text-main text-bold">
                          Product Line:
                          <span style="color: red">*</span>
                        </label>
                        <input
                          @input="form.errors.clear('product_line')"
                          type="text"
                          class="form-control"
                          v-model="form.product_line"
                          placeholder="Product Line"
                        />
                        <has-error
                          :form="form"
                          field="product_line"
                        ></has-error>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="height: 35px"></div>
            <div class="row" style="margin: 0px 0px 10px 0px">
              <div class="col-lg-6" style="padding: 15px"></div>
              <div class="col-lg-6" style="padding: 15px">
                <router-link to>
                  <a href="javascript:;">
                    <button
                      class="btn btn-success btn-rounded pull-right"
                      id="submitFormBtn"
                      type="submit"
                      @click="submitBtn()"
                    >
                      <i class="fa fa-check"></i> Submit
                    </button>
                  </a>
                </router-link>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import Vue from 'vue'
import _ from 'lodash'

Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

export default {
  data() {
    return {
      searchUser: null,
      users: {
        data: [],
        current_page: null,
        to: null,
        from: null,
        total: null,
        per_page: null
      },
      total_result: null,
      form: new Form({
        id: '',
        username: '',
        password: '',
        first_name: '',
        last_name: '',
        department: '',
        division: '',
        area: '',
        district: '',
        title: 'Salesman',
        product_line: 'All',
        address: '',
        postal_code: '',
        email: '',
        telephone: '',
        mobile: '',
        user_code: '',
        status: '',
        account_code: '',
        editValue: 0,
        old_password: '',
        new_password: '',
        new_password2: '',
        assigned_warehouse: null
      }),
      show_su_div: false,
      show_edit: false,
      municipality: []
    }
  },
  methods: {
    editBtn(MgaSalesman, e) {
      this.show_edit == false
        ? (this.show_edit = true)
        : (this.show_edit = false)

      this.form.clear()
      this.form.fill(MgaSalesman)
      this.form.editValue = e
      this.populateMunicipality()
      setTimeout(() => {
        $('#address').select2()
        $('#mobile').val(MgaSalesman.mobile)
        $('#mobile').mask('+' + 639 + '999999999')
        $('#submitForm').bootstrapValidator({
          message: 'This value is not valid.',
          fields: {
            email: {
              validators: {
                notEmpty: {
                  message: "The email is required and can't be empty"
                },
                emailAddress: {
                  message: 'The input is not a valid email address.'
                }
              }
            },
            telephone: {
              validators: {
                notEmpty: {
                  message: 'The phone number is required and cannot be empty'
                },
                digits: {
                  message: 'The value can contain only digits'
                }
              }
            },
            postal_code: {
              validators: {
                digits: {
                  message: 'This is not a valid postal code.'
                }
              }
            }
          }
        })
      }, 50)
    },
    editDtlsBtn() {
      $('#editDtls').hide()
      $('#tblDtl').show()
    },
    populateMunicipality() {
      axios.get('/salesman/getMunicipality').then(response => {
        this.municipality = response.data
        setTimeout(() => {
          var selectDropDown = $('#address').select2()
          selectDropDown.on('select2:select', function(e) {
            var event = new Event('change')
            e.target.dispatchEvent(event)
          })
        }, 100)
      })
    },
    onChangeDistrict() {
      this.form.errors.clear('district')
    },
    changeAddress() {
      this.form.errors.clear('address')
    },
    checkmobile() {
      this.form.errors.clear('mobile')
    },
    clear() {
      this.show_edit == false
        ? (this.show_edit = true)
        : (this.show_edit = false)
      this.form.clear()
      this.form.reset()
      $('#container').css('position', 'relative')
      this.getResults()
    },
    done() {
      this.show_su_div == false
        ? (this.show_su_div = true)
        : (this.show_su_div = false)
      this.form.clear()
      this.form.reset()
      $('#container').css('position', 'relative')
      this.getResults()
    },
    divisionSlct() {
      this.form.errors.clear('division')
      this.form.errors.clear('user_code')
      var formData = new FormData()
      formData.append('user_code', this.form.division)
      axios
        .post('/viewingUsers/getMaxCode', formData)
        .then(({ data, status }) => {
          this.form.user_code = data.user_code
        })
    },
    addBtn() {
      this.show_su_div == false
        ? (this.show_su_div = true)
        : (this.show_su_div = false)

      this.form.clear()
      this.form.reset()
      $('#container').css('position', 'relative')
      this.getResults()
      this.populateMunicipality()
      setTimeout(() => {
        $('#address').select2()
        $('#mobile').mask('+' + 639 + '999999999')
        $('#submitForm').bootstrapValidator({
          message: 'This value is not valid.',
          fields: {
            email: {
              validators: {
                notEmpty: {
                  message: "The email is required and can't be empty"
                },
                emailAddress: {
                  message: 'The input is not a valid email address'
                }
              }
            },
            telephone: {
              validators: {
                digits: {
                  message: 'The input is not a valid digit.'
                }
              }
            },
            postal_code: {
              validators: {
                digits: {
                  message: 'This is not a valid postal code.'
                }
              }
            }
          }
        })
      }, 50)
    },

    submitBtn() {
      this.form.mobile = $('#mobile').val()
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Are you sure?',
        text: 'Please check the information before submitting',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I am sure!',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          this.form
            .post('/viewingUsers/newViewingUser')
            .then(({ data, status }) => {
              console.log(data)
              if (data == 'New User Added') {
                Swal.fire({
                  title: 'Success!',
                  text: 'Information has been saved.',
                  icon: 'success',
                  allowOutsideClick: false
                }).then(result => {
                  if (result.value) {
                    this.done()
                  }
                })
              } else {
                Swal.fire({
                  title: 'Success!',
                  text: 'Information has been updated.',
                  icon: 'success',
                  allowOutsideClick: false
                }).then(result => {
                  if (result.value) {
                    this.clear()
                  }
                })
              }
            })
            .catch(error => {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: 'Input fields are required.',
                container: 'floating',
                timer: 5000
              })
            })
        } else {
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              "<i class='fa fa-exclamation-triangle'></i> Action has been canceled.",
            container: 'floating',
            timer: 5000
          })
        }
      })
    },

    search() {
      // console.log(1)
    },
    getResults(page = 1) {
      let url = null
      if (!this.searchUser) {
        url = '/viewingUsers/getviewingUsers/?page='
        axios.get(url + page).then(response => {
          this.total_result = response.data.total
          // console.log(response.data)
        })
      } else {
        url = `/viewingUsers/get_supplier/name/?name=${this.searchUser}&page=`
        // this.supplierList.data.forEach(value => {
        //   this.discount[value.id] = value.discount
        // })
      }
      axios.get(url + page).then(response => {
        this.users = response.data

        // this.users.data.forEach(value => {
        //   this.discount[value.id] = value.discount
        // })
        // setTimeout(() => {
        //   $('.discount').mask('9?9%')
        // }, 100)
      })
    },
    btn_activation(id, status) {
      axios
        .post(`/viewingUsers/toggleStatus`, { id, status })
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == '1') {
              $.niftyNoty({
                type: 'success',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status now changed to Active.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'success',
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
  mounted() {
    this.getResults()
    this.$root.currentPage = this.$route.meta.name
    $('#submitForm').on('click', function(e) {
      e.preventDefault()
    })
  }
}
</script>
<style scoped>
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
