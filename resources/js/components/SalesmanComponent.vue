<!-- @format -->
<template> 
  <div id="page-body">
    <div class="panel">
      <div
        class="panel-heading"
        id="showTitle"
        v-if="!show_su_div && !show_edit"
      >
        <h3
          class="panel-title"
          style="font-weight: bold; font-size: 20px; padding: 15px 0px 0px 25px;"
        >
          <i class="fa fa-truck"></i> Salesman list
        </h3>
      </div>
      <div class="panel-body" v-if="!show_su_div && !show_edit" id="tblDtl">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-12">
            <button
              class="btn btn-primary btn-rounded pull-right btn-sm"
              @click="addBtn()"
            >
              <i class="fa fa-plus-circle"></i> Salesman
            </button>
            <button
              class="btn btn-primary btn-rounded pull-right btn-sm"
              @click="printBtn()"
              style="margin-left: 8px; margin-right: 8px;"
            >
              <i class="fa fa-print"></i> Print Salesman
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table
            id="salesmanTbl"
            class="table table-bordered table-hover nowrap table-vcenter"
            width="100%"
          >
            <thead>
              <tr>
                <th style="width: 50%">User Code</th>
                <th style="width: 100%">Name</th>
                <th>Mobile no.</th>
                <th>Department</th>
                <th>Division</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="MgaSalesman in salesman" :key="MgaSalesman.id">
                <td>{{ MgaSalesman.user_code }} &nbsp;</td>
                <td>
                  {{ MgaSalesman.first_name + ' ' + MgaSalesman.last_name }}
                </td>
                <td>
                  <i class="fa fa-phone"></i>
                  {{ MgaSalesman.mobile }} &nbsp;
                </td>
                <td>{{ MgaSalesman.department }}</td>
                <td>{{ MgaSalesman.division }}</td>
                <td>{{ MgaSalesman.address }}</td>
                <td>
                  <div
                    class="btn-group dropdown"
                    v-if="MgaSalesman.status == '1'"
                  >
                    <button
                      class="btn btn-xs btn-info btn-active-blue dropdown-toggle dropdown-toggle-icon"
                      data-toggle="dropdown"
                      type="button"
                    >
                      Active&nbsp;&nbsp;
                      <i class="dropdown-caret"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a
                          href="#"
                          style="color: blue"
                          @click="btn_activation(MgaSalesman.id, '1')"
                          >Active</a
                        >
                      </li>
                      <li>
                        <a
                          href="#"
                          style="color: red"
                          @click="btn_activation(MgaSalesman.id, '0')"
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
                          @click="btn_activation(MgaSalesman.id, '1')"
                          >Active</a
                        >
                      </li>
                      <li>
                        <a
                          href="#"
                          style="color: red"
                          @click="btn_activation(MgaSalesman.id, '0')"
                          >Inactive</a
                        >
                      </li>
                      <li>
                        <a href="#" @click="test()">Test</a>
                      </li>
                    </ul>
                  </div>
                  <button
                    class="btn btn-xs btn-info"
                    @click="editBtn(MgaSalesman, 1)"
                  >
                    <i class="fa fa-edit"></i>
                  </button>
                  <button
                    class="btn btn-xs btn-info"
                    @click="listCstmerBtn(MgaSalesman, MgaSalesman.user_code)"
                  >
                    <i class="fa fa-list-ul"></i> Customers
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="panel-body" v-if="show_su_div">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-6" style="padding: 15px">
            <h5 class="text-main" style="font-weight: bold">
              <i class="fa fa-address-card-o"></i> Salesman Setup
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
                      <!--<span style="color: red">*</span>-->
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
                      <!--<span style="color: red">*</span>-->
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
                      disabled
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
                    <!-- <input
                      @input="form.errors.clear('address')"
                      type="text"
                      class="form-control"
                      v-model="form.address"
                      placeholder="Address"
                    />-->
                    <select
                      class="form-control"
                      v-model="form.address"
                      data-placeholder="Select Address"
                      id="address"
                      style="width: 270px"
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
                    >
                      <option value>Select Division</option>
                      <option value="MNG">MNG</option>
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
                    <!--<span style="color: red">*</span>-->
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
                      style="width: 270px"
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
              <i class="fa fa-address-card-o"></i> Salesman Setup
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
                          <!--<span style="color: red">*</span>-->
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
                          <!--<span style="color: red">*</span>-->
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
                          style="width: 400px"
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

    <div
      class="modal"
      id="customersMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg"
        style="width: 1200px; padding-top: 40px"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Customer Setup</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closeBtn"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px 15px 0 15px">
            <div class="panel" style="margin-bottom: 0">
              <div class="fixed-fluid">
                <div class="fixed-md-200 pull-sm-left fixed-right-border">
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
                      {{
                        salesmaninfo.first_name + ' ' + salesmaninfo.last_name
                      }}
                    </h4>
                    <p class="text-sm text-muted" style="margin-bottom: 0px">
                      {{ salesmaninfo.title }}
                    </p>
                    <p class="text-sm text-muted">
                      <span
                        v-if="salesmaninfo.status == 1"
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

                  <!-- Profile Details -->
                  <p class="pad-ver text-main text-sm text-uppercase text-bold">
                    About
                  </p>
                  <p>
                    <i class="demo-pli-map-marker-2 icon-lg icon-fw"></i>
                    {{ salesmaninfo.address }}
                  </p>
                  <p>
                    <i class="demo-pli-internet icon-lg icon-fw"></i>
                    {{ salesmaninfo.division }}
                  </p>
                  <p>
                    <i class="demo-pli-old-telephone icon-lg icon-fw"></i>
                    {{ salesmaninfo.telephone }}
                  </p>
                  <p>
                    <i class="demo-pli-smartphone-3 icon-lg icon-fw"></i>
                    {{ salesmaninfo.mobile }}
                  </p>

                  <hr />
                  <!-- <p class="pad-ver text-main text-sm text-uppercase text-bold">Skills</p>
                  <ul class="list-inline">
                    <li class="tag tag-sm">PHP Programming</li>
                    <li class="tag tag-sm">Marketing</li>
                    <li class="tag tag-sm">Graphic Design</li>
                    <li class="tag tag-sm">Sketch</li>
                    <li class="tag tag-sm">Photography</li>
                  </ul>-->
                </div>
                <div class="fluid">
                  <!-- <hr class="new-section-md bord-no" /> -->
                  <div class="tab-base">
                    <ul class="nav nav-tabs">
                      <li
                        class="active text-main text-bold"
                        @click="activate(0)"
                      >
                        <a href="#demo-tabs-box-1" data-toggle="tab"
                          >Customer List</a
                        >
                      </li>
                      <li class="text-main text-bold" @click="activate(2)">
                        <a href="#demo-tabs-box-2" data-toggle="tab"
                          >Assign Customer</a
                        >
                      </li>
                    </ul>
                    <!--Panel body-->
                    <div class="tab-content">
                      <div class="tab-pane fade in active" id="demo-tabs-box-1">
                        <div class="row">
                          <div class="form-group">
                            <label
                              class="control-label text-main text-semibold"
                              style="text-align: left; padding-left: 15px;"
                              >Salesman Code:
                            </label>

                            <span
                              class="text-warning text-semibold"
                              style="text-align: left;"
                              >{{ usercode }}
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div
                            class="col-md-6 table-toolbar-left form-horizontal"
                          >
                            <button
                              class="btn btn-primary btn-rounded"
                              @click="addBtn()"
                              style="margin-right: 8-px; margin-left: 8px;"
                              :disabled="!salesmanCustomerList.data.length"
                            >
                              <i class="fa fa-print"></i>
                              Print customer list
                            </button>
                          </div>
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
                                    @keyup="search"
                                    v-model="searchSalesmanCustomer"
                                    placeholder="Search by name"
                                  />
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <table
                          id="customerTbl"
                          class="table table-striped table-hover table-vcenter nowrap"
                        >
                          <thead>
                            <tr>
                              <th style="col-sm-4">Customer Name</th>
                              <th style="col-sm-3">Account Code</th>
                              <!-- <th style="col-sm-3">Group Code</th> -->
                              <th style="col-sm-3">Description</th>
                              <th style="col-sm-3">Address</th>
                              <!-- <th style="col-sm-3">User Code</th> -->
                              <th style="col-sm-3">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-if="!salesmanCustomerList.data.length">
                              <td colspan="7" class="text-center">
                                No data available
                              </td>
                            </tr>
                            <tr
                              v-for="customer in salesmanCustomerList.data"
                              :key="customer.customer_id"
                            >
                              <td style="font-size: 12px">
                                {{ customer.account_name }}
                              </td>
                              <td>{{ customer.account_code }}</td>
                              <!-- <td>{{ customer.account_group_code }}</td> -->
                              <td>{{ customer.account_description }}</td>
                              <td>{{ customer.address3 }}</td>
                              <!-- <td>{{ customer.salesman_code }}</td> -->
                              <td>
                                <button
                                  type="button"
                                  class="btn btn-rounded btn-danger btn-xs"
                                  data-toggle="tooltip"
                                  data-placement="left"
                                  title="Untag Customer"
                                  @click="
                                    untagBtn(
                                      customer.account_code,
                                      usercode,
                                      '1'
                                    )
                                  "
                                >
                                  <i class="fa fa-times-circle"></i> Untag
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6">
                              Showing {{ salesmanCustomerList.from }} to
                              {{ salesmanCustomerList.to }} of
                              {{ salesmanCustomerList.total }} entries
                            </div>
                            <div class="col-md-6">
                              <div class="text-right">
                                <pagination
                                  style="margin: 0 0 20px 0"
                                  :limit="1"
                                  :show-disabled="true"
                                  :data="salesmanCustomerList"
                                  @pagination-change-page="getResults2"
                                ></pagination>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="demo-tabs-box-2">
                        <div class="row">
                          <div
                            class="col-md-6 table-toolbar-left form-horizontal"
                          >
                            <div
                              class="row"
                              style="padding: 10px 15px 15px 10px"
                            >
                              <label class="col-md-6 control-label text-bold"
                                >Filter By Address:</label
                              >
                              <v-select
                                v-model.trim="address"
                                :filterable="false"
                                @search="retrieveAddress"
                                @input="search2"
                                label="address3"
                                :options="addressList"
                                placeholder="Search for address"
                                ><template slot="no-options">
                                  <strong>Search for address</strong>
                                </template>
                                <template slot="option" slot-scope="option">{{
                                  `${option.address3}`
                                }}</template>
                                <template
                                  slot="selected-option"
                                  slot-scope="option"
                                  >{{ `${option.address3}` }}</template
                                >
                              </v-select>
                            </div>
                          </div>
                          <div
                            class="col-md-6 table-toolbar-right form-horizontal"
                            style="text-align: left"
                          >
                            <div
                              class="row"
                              style="padding: 10px 15px 15px 10px"
                            >
                              <label class="col-md-6 control-label text-bold"
                                >Search:</label
                              >
                              <div class="col-md-6">
                                <input
                                  type="text"
                                  class="form-control"
                                  @keyup="search2"
                                  v-model="assignSearchCustomer"
                                  placeholder="Search by name"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div
                            class="col-md-6 table-toolbar-left form-horizontal"
                          >
                            <button
                              :disabled="checkboxes_id == ''"
                              class="btn btn-primary btn-rounded"
                              @click="tagSelected(checkboxes_id)"
                            >
                              <i class="fa fa-check-circle-o"></i>
                              Tag Customer ({{ checkboxes_id.length }})
                            </button>
                          </div>
                        </div>
                        <table
                          id="customerAssignTbl"
                          class="table table-striped table-hover table-vcenter nowrap"
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
                              <th>Customer Name</th>
                              <th>Account Code</th>
                              <th>Description</th>
                              <th>Address</th>
                              <!-- <th>User Code</th> -->
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-if="!assignCustomer.data.length">
                              <td colspan="8" class="text-center">
                                No data available
                              </td>
                            </tr>
                            <tr
                              v-for="(customer, index) in assignCustomer.data"
                              :key="index"
                            >
                              <td>
                                <div class="text-center">
                                  <input
                                    class="magic-checkbox"
                                    type="checkbox"
                                    v-model="checkboxes_id"
                                    :id="index"
                                    :value="customer"
                                  />
                                  <label :for="index"></label>
                                </div>
                              </td>
                              <td style="font-size: 12px">
                                {{ customer.account_name }}
                              </td>
                              <td>{{ customer.account_code }}</td>
                              <td>{{ customer.account_description }}</td>
                              <td>{{ customer.address3 }}</td>
                              <!-- <td>{{ customer.salesman_code }}</td> -->
                              <td>
                                <button
                                  type="button"
                                  class="btn btn-rounded btn-info btn-xs"
                                  title="Tag Customer"
                                  @click="singleApprove(customer)"
                                >
                                  <i class="fa fa-tag"></i> Tag
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6">
                              Showing {{ assignCustomer.from }} to
                              {{ assignCustomer.to }} of
                              {{ assignCustomer.total }} entries
                            </div>
                            <div class="col-md-6">
                              <div class="text-right">
                                <pagination
                                  style="margin: 0 0 20px 0"
                                  :limit="1"
                                  :show-disabled="true"
                                  :data="assignCustomer"
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
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="closeBtn()">
              <i class="fa fa-close"></i> Close
            </button>
          </div> -->
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="passwordMdl"
      tabindex="-1"
      role="dialog"
      data-backdrop="static"
      data-keyboard="false"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="clearPasswordMdl()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submitform">
            <div class="modal-body">
              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('old_password') }"
              >
                <label class="control-label text-main text-bold">
                  Old password:
                  <span style="color: red">*</span>
                </label>
                <input
                  @input="form.errors.clear('old_password')"
                  type="password"
                  class="form-control"
                  id="old_password"
                  v-model="form.old_password"
                  placeholder="Old password"
                />
                <has-error :form="form" field="old_password"></has-error>
              </div>

              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('new_password') }"
              >
                <label class="control-label text-main text-bold">
                  New password:
                  <span style="color: red">*</span>
                </label>
                <input
                  @input="form.errors.clear('new_password')"
                  type="password"
                  class="form-control"
                  id="new_password"
                  v-model="form.new_password"
                  placeholder="New password"
                />
                <has-error :form="form" field="new_password"></has-error>
              </div>

              <div
                class="form-group"
                :class="{ 'has-error': form.errors.has('new_password2') }"
              >
                <label class="control-label text-main text-bold">
                  Confirm password:
                  <span style="color: red">*</span>
                </label>
                <input
                  @input="form.errors.clear('new_password2')"
                  type="password"
                  class="form-control"
                  id="new_password2"
                  v-model="form.new_password2"
                  placeholder="Confirm password"
                />
                <has-error :form="form" field="new_password2"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="clearPasswordMdl()"
              >
                Close
              </button>
              <button
                type="button"
                id="submitform"
                class="btn btn-primary"
                @click="submitPword()"
                :disabled="
                  !form.old_password &&
                    !form.new_password &&
                    !form.new_password2
                "
              >
                Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
/** @format */

import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import Vue from 'vue'
import _ from 'lodash'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import { debounce } from 'lodash'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'))

export default {
  data() {
    return {
      salesman: [],
      salesmaninfo: [],
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
        new_password2: ''
      }),
      show_su_div: false,
      show_edit: false,
      tab: 0,
      assignSearchCustomer: null,
      assignCustomer: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      usercode: '',
      searchSalesmanCustomer: null,
      salesmanCustomerList: {
        data: []
      },
      municipality: [],
      address: null,
      addressList: [],
      checkboxes_id: [],
      allSelected: false,
      checkbox_approved: [],
      allSelected_approved: false
    }
  },
  methods: {
    singleApprove(data) {
      this.checkboxes_id = []
      this.allSelected = false
      this.checkboxes_id.push(data)
      const account_code = this.checkboxes_id.map(
        customer => customer.account_code
      )
      this.tagCustomerBtn(account_code, this.usercode, 1)
    },
    tagSelected(data) {
      const account_code = data.map(customer => customer.account_code)
      this.tagCustomerBtn(account_code, this.usercode, 1)
    },
    selectAll_approved() {
      this.checkbox_approved = []
      if (!this.allSelected_approved) {
        for (var test in this.approvedCustomers.data) {
          this.checkbox_approved.push(this.approvedCustomers.data[test])
        }
      }
    },
    selectAll() {
      this.checkboxes_id = []
      if (!this.allSelected) {
        for (var test in this.assignCustomer.data) {
          this.checkboxes_id.push(this.assignCustomer.data[test])
        }
      }
    },
    retrieveAddress(search, loading) {
      loading(true)
      this.checkboxes_id = []
      this.searchAddress(search, loading, this)
    },
    searchAddress: debounce((search, loading, vm) => {
      if (search.trim().length > 0) {
        axios
          .get(`/salesman/getAddress?address=${search}`)
          .then(({ data }) => {
            vm.addressList = data
            loading(false)
          })
          .catch(error => {
            vm.addressList = []
            loading(false)
          })
      } else {
        vm.addressList = []
        loading(false)
      }
    }, 1000),
    printBtn() {
      document.location.href = `/salesman/forPrint`
    },
    search() {
      this.searchForSalesmanCustomer(this.searchSalesmanCustomer, this)
    },
    search2() {
      this.searchForCustomerAssign(
        this.assignSearchCustomer,
        this.address,
        this
      )
    },

    searchForSalesmanCustomer: _.debounce((search, vm) => {
      axios
        .get(
          `/salesman/getSalesmanCustomerList/customer?usercode=${vm.usercode}&name=${search}&page=1`
        )
        .then(({ data }) => {
          vm.salesmanCustomerList = data
        })
    }, 1000),

    searchForCustomerAssign: _.debounce((search, address, vm) => {
      let adress = null
      if (address) adress = address.address3
      axios
        .get(
          `/salesman/getAssignSalesmanCustomerList/customer?usercode=${vm.usercode}&name=${search}&address=${adress}&page=1`
        )
        .then(({ data }) => {
          vm.assignCustomer = data
        })
    }, 1000),

    getResults(page = 1) {
      let url,
        adress = null
      if (this.address) {
        adress = this.address.address3
      } else {
        adress = 'null'
      }

      console.log(adress)

      // if (!this.assignSearchCustomer && !this.address.address3) {
      //   url = `/salesman/getAssignSalesmanCustomerList?usercode=${this.usercode}&page=`
      // } else {
      url = `/salesman/getAssignSalesmanCustomerList/customer?usercode=${this.usercode}&name=${this.assignSearchCustomer}&address=${adress}&page=`
      // }
      axios.get(url + page).then(({ data }) => {
        this.assignCustomer = data
      })
    },

    getResults2(page = 1) {
      let url = null
      if (!this.searchSalesmanCustomer) {
        url = `/salesman/getSalesmanCustomerList?usercode=${this.usercode}&page=`
      } else {
        url = `/salesman/getSalesmanCustomerList/customer?usercode=${this.usercode}&name=${this.searchSalesmanCustomer}&page=`
      }
      axios.get(url + page).then(({ data }) => {
        this.salesmanCustomerList = data
      })
    },

    activate: function(yo) {
      this.tab = yo
    },

    getSalesmanList() {
      axios.get('/salesman/get_salesman_list').then(response => {
        this.salesman = response.data
        if (!this.salesman.length) {
          setTimeout(() => {
            $('#salesmanTbl').DataTable({
              destroy: true,
              processing: true,
              language: {
                emptyTable: 'No data available.',
                loadingRecords: 'Please wait...',
                zeroRecords: 'No matching records found.'
              }
            })
          }, 50)
        } else {
          setTimeout(() => {
            if ($.fn.DataTable.isDataTable('#salesmanTbl')) {
              $('#salesmanTbl')
                .DataTable()
                .destroy()
            }
            $('#salesmanTbl').DataTable({
              processing: true
            })
          }, 50)
        }
      })
    },
    addBtn() {
      this.show_su_div == false
        ? (this.show_su_div = true)
        : (this.show_su_div = false)

      this.form.clear()
      this.form.reset()
      $('#container').css('position', 'relative')
      this.getSalesmanList()
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
            .post('/salesman/create_salesman')
            .then(({ data, status }) => {
              if (data == 'Success') {
                Swal.fire({
                  title: 'Success!',
                  text: 'Information has been saved.',
                  icon: 'success',
                  allowOutsideClick: false
                }).then(result => {
                  if (result.value) {
                    this.addBtn()
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
    btn_activation(id, status) {
      this.form.id = id
      this.form.status = status
      console.log(this.form.status)
      this.form
        .post('/salesman/activate_salesman')
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == '1') {
              $.niftyNoty({
                type: 'success',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status changed to Active.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'success',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status changed to Inactive.',
                container: 'floating',
                timer: 5000
              })
            }
            this.getSalesmanList()
          } else {
            if (data.trim() == 'Error') {
              if (status == '1') {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Status is already active.",
                  container: 'floating',
                  timer: 5000
                })
              } else {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Status is already inactive.",
                  container: 'floating',
                  timer: 5000
                })
              }
            }
          }
        })
        .catch(error => {})
    },
    listCstmerBtn(MgaSalesman, code) {
      this.usercode = code
      this.salesmaninfo = MgaSalesman
      Promise.all([
        this.getAssignSalesmanCustomerList(code),
        this.getCustomerListTbl(code)
      ]).then(response => {
        this.assignCustomer = response[0].data
        this.salesmanCustomerList = response[1].data
        $('#customersMdl').modal('show')
      })
      // this.getAssignSalesmanCustomerList(code).then(({ data }) => {
      //   this.assignCustomer = data
      // })
    },
    async getAssignSalesmanCustomerList(usercode) {
      return await axios.get(
        `/salesman/getAssignSalesmanCustomerList?usercode=${usercode}`
      )
    },
    async getCustomerListTbl(usercode) {
      return await axios.get(`
      /salesman/getSalesmanCustomerList?usercode=${usercode}`)
    },
    tagCustomerBtn(account_code, code, status) {
      console.log(account_code, code, status)
      this.form.account_code = account_code
      this.form.user_code = code
      this.form.status = status
      $('#customersMdl').modal('hide')
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Assign this customer?',
        text: 'This customer will be tagged to this salesman.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Proceed',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          this.form
            .post('/salesman/tagCustomertoSalesman')
            .then(({ data, status }) => {
              const { message } = data
              if (message == 'Success') {
                Swal.fire({
                  title: 'Success!',
                  text: 'Customer tagged to Salesman',
                  icon: 'success',
                  allowOutsideClick: false
                }).then(result => {
                  if (result.value) {
                    $('#container').css('position', 'relative')
                    Promise.all([
                      this.getAssignSalesmanCustomerList(code),
                      this.getCustomerListTbl(code)
                    ]).then(response => {
                      this.assignCustomer = response[0].data
                      this.salesmanCustomerList = response[1].data
                      this.checkboxes_id = []
                      this.allSelected = false
                      $('#customersMdl').modal('show')

                      $.niftyNoty({
                        type: 'success',
                        icon: 'pli-cross icon-2x',
                        message: message,
                        container: 'floating',
                        timer: 5000
                      })
                      $('#customersMdl').modal('show')
                    })
                    this.searchSalesmanCustomer = null
                    this.assignSearchCustomer = null
                    this.address = null
                    // this.salesmaninfo = []
                    // this.getSalesmanList()
                  } else {
                    $.niftyNoty({
                      type: 'danger',
                      icon: 'pli-cross icon-2x',
                      message: status,
                      container: 'floating',
                      timer: 5000
                    })
                  }
                })
              } else {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message: message,
                  container: 'floating',
                  timer: 5000
                })
                $('#container').css('position', 'relative')

                $('#customersMdl').modal('show')
              }
            })
            .catch(error => {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: status,
                container: 'floating',
                timer: 5000
              })
            })
        } else {
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              '<i class="fa fa-exclamation-circle"></i> Action has been canceled.',
            container: 'floating',
            timer: 5000
          })
          $('#container').css('position', 'relative')
          $('#customersMdl').modal('show')
        }
      })
    },
    closeBtn() {
      this.searchSalesmanCustomer = null
      this.assignSearchCustomer = null
      this.address = null
      this.salesmaninfo = []
      this.checkboxes_id = []
      this.allSelected = false
      $('#customersMdl').modal('hide')
    },
    divisionSlct() {
      this.form.errors.clear('division')
      this.form.errors.clear('user_code')
      var formData = new FormData()
      formData.append('user_code', this.form.division)
      axios.post('/salesman/getMaxCode', formData).then(({ data, status }) => {
        this.form.user_code = data.user_code
      })
    },
    untagBtn(account_code, code, status) {
      $('#customersMdl').modal('hide')
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Untag Customer?',
        text: 'You can be able to change this later.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          axios
            .post(`/salesman/untagCustomertoSalesman`, {
              account_code,
              code
            })
            .then(({ data, status }) => {
              if (data == 'Success') {
                // Swal.fire({
                //   title: 'Success!',
                //   text: 'Information has been changed.',
                //   icon: 'success',
                //   allowOutsideClick: false
                // }).then(result => {
                //   if (result.value) {

                $.niftyNoty({
                  type: 'success',
                  icon: 'pli-cross icon-2x',
                  message:
                    '<i class="fa fa-check"></i> Information has been changed.',
                  container: 'floating',
                  timer: 5000
                })
                $('#container').css('position', 'relative')
                Promise.all([
                  this.getAssignSalesmanCustomerList(code),
                  this.getCustomerListTbl(code)
                ]).then(response => {
                  this.assignCustomer = response[0].data
                  this.salesmanCustomerList = response[1].data
                  $('#customersMdl').modal('show')
                })
                this.searchSalesmanCustomer = null
                this.assignSearchCustomer = null
                this.address = null
                //   } else {
                //     $.niftyNoty({
                //       type: 'danger',
                //       icon: 'pli-cross icon-2x',
                //       message: status,
                //       container: 'floating',
                //       timer: 5000
                //     })
                //   }
                // })
              } else {
                $('#container').css('position', 'relative')
              }
            })
            .catch(error => {
              $.niftyNoty({
                type: 'danger',
                icon: 'pli-cross icon-2x',
                message: status,
                container: 'floating',
                timer: 5000
              })
            })
        }
        // Swal.fire({
        //   title: 'Success!',
        //   text: 'Information has been changed.',
        //   icon: 'success',
        //   allowOutsideClick: false
        // }).then(result => {
        //   if (result.value) {
        //     $('#container').css('position', 'relative')
        //   }
        // })
        else {
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              '<i class="fa fa-exclamation-circle"></i> Action has been canceled.',
            container: 'floating',
            timer: 5000
          })
          $('#container').css('position', 'relative')
          $('#customersMdl').modal('show')
        }
      })
    },
    clear() {
      this.show_edit == false
        ? (this.show_edit = true)
        : (this.show_edit = false)
      this.form.clear()
      this.form.reset()
      $('#container').css('position', 'relative')
      this.getSalesmanList()
    },
    passwordBtn() {
      $('#passwordMdl').modal('show')
    },
    submitPword() {
      this.form.post('/salesman/changePword').then(response => {
        if (response.data == 'Password does not match!') {
          this.form.errors.set('old_password', 'Password does not match!')
          $.niftyNoty({
            type: 'danger',
            icon: 'pli-cross icon-2x',
            message:
              '<i class="fa fa-exclamation-circle"></i> Password does not match!.',
            container: 'floating',
            timer: 5000
          })
        } else {
          // alert('success')
          if (response.data.status == 'Update Successful!') {
            $('#passwordMdl').modal('hide')
            this.clearPasswordMdl()
            this.form.password = response.data.value
            $.niftyNoty({
              type: 'success',
              icon: 'pli-cross icon-2x',
              message: '<i class="fa fa-check"></i> Update successful!.',
              container: 'floating',
              timer: 5000
            })
          } else {
            this.form.errors.set('new_password', 'New Password does not match!')
            this.form.errors.set(
              'new_password2',
              'Confirm Password does not match!'
            )
            $.niftyNoty({
              type: 'danger',
              icon: 'pli-cross icon-2x',
              message:
                '<i class="fa fa-exclamation-circle"></i> New password does not match!.',
              container: 'floating',
              timer: 5000
            })
          }
        }
      })
    },
    clearPasswordMdl() {
      this.form.old_password = ''
      this.form.new_password = ''
      this.form.new_password2 = ''
      this.form.errors.clear('old_password')
      this.form.errors.clear('new_password')
      this.form.errors.clear('new_password2')
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
    }
  },
  mounted() {
    this.getSalesmanList()
    $('#submitForm').on('click', function(e) {
      e.preventDefault()
    })
    this.$root.currentPage = this.$route.meta.name
  }
}
</script>
<style scoped>
/** @format */
.tab-base .nav-tabs > .active > a,
.tab-base .nav-tabs > .active a:hover,
.tab-base .nav-tabs > .active > a:focus {
  /* box-shadow: inset 0 -2px 0 0 #1e3a57 !important; */
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
