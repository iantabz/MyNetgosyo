<!-- @format -->

<template>
  <div id="page-body">
    <div v-if="!show_su_div && !show_edit">
      <div class="row pad-btm" style="padding-bottom: 8px">
        <div class="col-sm-6 toolbar-left">
          <button
            id="demo-btn-addrow"
            class="btn btn-warning shadow"
            @click="addBtn()"
          >
            <i class="fa fa-plus"></i> Add New
          </button>
        </div>
        <div class="col-md-6 table-toolbar-right">
          <form class="form-horizontal">
            <div class="form-group" style="margin-bottom: 0px">
              <label
                class="col-md-6 control-label text-main text-bold"
                style="color: white"
                >Search:</label
              >
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control shadow"
                  @keyup="search"
                  v-model="searchHepe"
                  placeholder="Search Jefe name"
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
            <th>User code</th>
            <th>Name</th>
            <th>Mobile no.</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!hepe.data.length">
            <td colspan="4" class="text-center">No data available</td>
          </tr>
          <tr v-for="(hepeData, index) in hepe.data" :key="index">
            <td>{{ hepeData.first_name + ' ' + hepeData.last_name }}</td>
            <td></td>
            <td></td>
            <td>
              <div class="btn-group dropdown" v-if="hepeData.status == '1'">
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
                      @click="btn_activation(hepeData.id, '1')"
                      >Active</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      style="color: red"
                      @click="btn_activation(hepeData.id, '0')"
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
                      @click="btn_activation(hepeData.id, '1')"
                      >Active</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      style="color: red"
                      @click="btn_activation(hepeData.id, '0')"
                      >Inactive</a
                    >
                  </li>
                </ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-12" v-if="!hepe.data.length">
          <button
            type="submit"
            class="btn btn-default btn-block btn-lg text-main text-bold disabled"
            style="cursor: not-allowed; margin: 35px 0px"
          >
            No data available.
          </button>
        </div>
        <div
          class="col-sm-4 col-md-3"
          v-for="(hepeData, index) in hepe.data"
          :key="index"
          style="margin-top: -5px"
        >
          <div class="panel pos-rel">
            <div class="pad-all text-center shadow">
              <div class="widget-control">
                <a
                  href="javascript:;"
                  data-original-title="Favorite"
                  class="add-tooltip btn btn-trans"
                >
                  <span id="star" @click="favoriteBtn(1)">
                    <i class="demo-psi-star icon-lg"></i>
                  </span>
                </a>
                <div class="btn-group dropdown">
                  <a
                    href="javascript:;"
                    data-toggle="dropdown"
                    aria-expanded="false"
                    class="dropdown-toggle btn btn-trans"
                  >
                    <i class="demo-psi-dot-vertical icon-lg"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a href="javascript:;" @click="editBtn()">
                        <i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <i class="icon-lg icon-fw demo-pli-calendar-4"></i> View
                        Details
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="">
                <a href="#">
                  <img
                    v-if="index % 2"
                    alt="Profile Picture"
                    src="assets/img/profile-photos/1.png"
                    class="img-lg img-circle mar-ver"
                  />
                  <img
                    v-else
                    alt="Profile Picture"
                    src="assets/img/profile-photos/3.png"
                    class="img-lg img-circle mar-ver"
                  />
                  <p class="text-lg text-semibold mar-no text-main">
                    {{ hepeData.first_name + ' ' + hepeData.last_name }}
                  </p>
                  <p class="text-sm">{{ hepeData.title }}</p>
                  <p class="text-sm text-muted" v-if="hepeData.status == '1'">
                    <span
                      class="label label-success"
                      style="margin-bottom: 10px"
                      >ACTIVE</span
                    >
                  </p>
                  <p class="text-sm text-muted" v-else>
                    <span class="label label-danger" style="margin-bottom: 10px"
                      >INACTIVE</span
                    >
                  </p>
                </a>
                <!-- <div class="media pad-ver">
                  <div class="media-left">
                    <a href="javascript:;" class="box-inline">
                      <img
                        v-if="index % 2"
                        alt="Profile Picture"
                        src="assets/img/profile-photos/1.png"
                        class="img-md img-circle"
                      />
                      <img
                        v-else
                        alt="Profile Picture"
                        src="assets/img/profile-photos/3.png"
                        class="img-md img-circle"
                      />
                    </a>
                  </div>
                  <div class="media-body pad-top">
                    <a href="javascript:;" class="box-inline">
                      <span class="text-lg text-semibold text-main">{{
                        hepeData.first_name + ' ' + hepeData.last_name
                      }}</span>
                      <p class="text-sm" style="margin-bottom: 0">
                        {{ hepeData.title }}
                      </p>
                      <p
                        class="text-sm text-muted"
                        v-if="hepeData.status == '1'"
                      >
                        <span
                          class="label label-success"
                          style="margin-bottom: 10px"
                          >ACTIVE</span
                        >
                      </p>
                      <p class="text-sm text-muted" v-else>
                        <span
                          class="label label-danger"
                          style="margin-bottom: 10px"
                          >INACTIVE</span
                        >
                      </p>
                    </a>
                  </div>
                </div> -->
                <!-- <table class="table table-condensed">
                <tbody>
                  <tr>
                    <td class="text-main text-bold">User Code</td>
                    <td class="text-main">{{hepeData.user_code}}</td>
                  </tr>
                  <tr>
                    <td class="text-main text-bold">Username</td>
                    <td class="text-main">{{hepeData.username}}</td>
                  </tr>
                </tbody>
              </table>-->
                <div class="text-center pad-top">
                  <div class="btn-group">
                    <a
                      href="javascript:;"
                      class="btn btn-sm btn-default"
                      @click="list(hepeData, hepeData.user_code)"
                    >
                      <i class="demo-pli-consulting icon-lg icon-fw"></i>
                      Salesman
                    </a>
                    <a
                      href="javascript:;"
                      class="btn-group dropdown"
                      v-if="hepeData.status == '1'"
                    >
                      <button
                        class="btn btn-default btn-sm btn-active-pink dropdown-toggle dropdown-toggle-icon"
                        data-toggle="dropdown"
                        type="button"
                        aria-expanded="false"
                      >
                        <i class="demo-psi-gear"></i>
                        Status
                        <i class="dropdown-caret"></i>
                      </button>
                      <ul class="dropdown-menu" style>
                        <li>
                          <a
                            href="javascript:;"
                            style="color: red"
                            @click="btn_activation(hepeData.id, '0')"
                            >Inactive</a
                          >
                        </li>
                        <li></li>
                      </ul>
                    </a>
                    <a href="javascript:;" class="btn-group dropdown" v-else>
                      <button
                        class="btn btn-default btn-sm btn-active-pink dropdown-toggle dropdown-toggle-icon"
                        data-toggle="dropdown"
                        type="button"
                        aria-expanded="false"
                      >
                        <i class="demo-psi-gear"></i>
                        Status
                        <i class="dropdown-caret"></i>
                      </button>
                      <ul class="dropdown-menu" style>
                        <li>
                          <a
                            href="javascript:;"
                            style="color: blue"
                            @click="btn_activation(hepeData.id, '1')"
                            >Active</a
                          >
                        </li>
                        <li></li>
                      </ul>
                    </a>
                    <!-- <a
                      href="javascript:;"
                      class="btn btn-sm btn-default"
                      @click="editBtn()"
                    >
                      <i class="demo-pli-pen-5 icon-lg icon-fw"></i> Edit
                    </a> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-6">
          Showing {{ hepe.from }} to {{ hepe.to }} of {{ hepe.total }} entries
          <span v-if="searchHepe"
            >(Filtered from {{ form.total_result }} total entries)</span
          >
        </div>
        <div class="col-md-6">
          <div class="text-right">
            <pagination
              style="margin: 0 0 20px 0"
              :limit="1"
              :show-disabled="true"
              :data="hepe"
              @pagination-change-page="getResults"
            ></pagination>
          </div>
        </div>
      </div>
      <hr class="new-section-sm" />
    </div>

    <div class="panel">
      <div class="panel-body" v-if="show_su_div">
        <div class="row" style="margin: 0px 0px 10px 0px">
          <div class="col-lg-12">
            <div class="col-lg-6" style="padding: 15px">
              <h5 class="text-main" style="font-weight: bold">
                <i class="fa fa-address-card-o"></i> Jefe de Viaje Setup
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
                      style="width: 270px"
                      @change="changeAddress()"
                    >
                      <optgroup label="Address">
                        <option
                          v-for="mun in municipality"
                          :key="mun.id"
                          :value="mun.mun_code"
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
                    <select class="form-control" v-model="form.division">
                      <option value>Select Division</option>
                      <option value="WDG">WDG</option>
                      <option value="DSG">DSG</option>
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
              <i class="fa fa-address-card-o"></i> Jefe de Viaje Setup
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
                      <a
                        href="javascript:;"
                        class="btn btn-sm btn-block btn-default"
                        @click="passwordBtn()"
                      >
                        <i class="fa fa-lock"></i> Change password
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

      <div
        class="modal fade"
        id="Mdl"
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
              <h5 class="modal-title" id="exampleModalLabel">
                Jefe de Viaje Setup
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="closeBtn()"
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
                        {{ hepeinfo.first_name + ' ' + hepeinfo.last_name }}
                      </h4>
                      <p class="text-sm text-muted" style="margin-bottom: 0px">
                        {{ hepeinfo.title }}
                      </p>
                      <p class="text-sm text-muted">
                        <span
                          v-if="hepeinfo.status == 1"
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
                      <hr class="new-section-sm bord-no" />
                      <table class="invoice-details">
                        <tbody>
                          <tr>
                            <td class="text-main text-bold">User code:</td>
                            <td class="text-info text-bold">
                              {{ hepeinfo.user_code }}
                            </td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Address:</td>
                            <td class="text-main">{{ hepeinfo.mun_name }}</td>
                          </tr>
                          <tr>
                            <td class="text-main text-bold">Mobile no:</td>
                            <td class="text-main">{{ hepeinfo.mobile }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <hr class="new-section-sm bord-no" />
                      <hr class="new-section-sm bord-no" />
                    </div>
                    <hr class="new-section-sm bord-no" />
                    <hr class="new-section-sm bord-no" />
                    <hr class="new-section-sm bord-no" />
                    <hr class="new-section-sm bord-no" />
                  </div>
                  <div class="fluid">
                    <!-- <hr class="new-section-md bord-no" /> -->
                    <div class="tab-base">
                      <ul class="nav nav-tabs">
                        <li class="active text-main text-bold">
                          <a
                            href="#demo-tabs-box-1"
                            data-toggle="tab"
                            @click="tab = 1"
                            >List of Salesman</a
                          >
                        </li>
                        <li class="text-main text-bold">
                          <a
                            href="#demo-tabs-box-2"
                            data-toggle="tab"
                            @click="tab = 2"
                            >Assign Salesman</a
                          >
                        </li>
                      </ul>
                      <!--Panel body-->
                      <div class="tab-content">
                        <div
                          class="tab-pane fade in active"
                          id="demo-tabs-box-1"
                          v-if="tab == 1"
                        >
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
                                        @keyup="search2"
                                        v-model="searchHepeSalesman"
                                        placeholder="Search Name"
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
                                  <th style="col-sm-4">Name</th>
                                  <th style="col-sm-3">User Code</th>
                                  <th style="col-sm-3">Department</th>
                                  <th style="col-sm-3">Division</th>
                                  <th style="col-sm-3">Address</th>
                                  <!-- <th style="col-sm-3">Hepe Code</th> -->
                                  <th style="col-sm-3">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-if="!hepeSalesmanList.data.length">
                                  <td colspan="7" class="text-center text-bold">
                                    No data available
                                  </td>
                                </tr>
                                <tr
                                  v-for="salesman in hepeSalesmanList.data"
                                  :key="salesman.salesman_id"
                                >
                                  <td>
                                    {{
                                      salesman.first_name +
                                        ' ' +
                                        salesman.last_name
                                    }}
                                  </td>
                                  <td>{{ salesman.user_code }}</td>
                                  <td>{{ salesman.department }}</td>
                                  <td>{{ salesman.division }}</td>
                                  <td>{{ salesman.address }}</td>
                                  <!-- <td>{{ salesman.hepe_code }}</td> -->
                                  <td>
                                    <button
                                      type="button"
                                      class="btn btn-danger btn-rounded btn-xs"
                                      data-toggle="tooltip"
                                      data-placement="left"
                                      title="Untag Salesman to Jefe de Viaje"
                                      @click="untagBtn()"
                                      :disabled="hepeinfo.status == '0'"
                                    >
                                      <i class="fa fa-times-circle"></i> Untag
                                    </button>
                                    <button
                                      type="button"
                                      class="btn btn-info btn-rounded btn-xs"
                                      data-toggle="tooltip"
                                      data-placement="left"
                                      title="Logs"
                                      @click="logsBtn(salesman.user_code)"
                                    >
                                      <i class="fa fa-archive"></i> Logs
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  Showing {{ hepeSalesmanList.from }} to
                                  {{ hepeSalesmanList.to }} of
                                  {{ hepeSalesmanList.total }} entries
                                  <span v-if="searchHepeSalesman"
                                    >(Filtered from
                                    {{ form.total_salesmanlist }} total
                                    entries)</span
                                  >
                                </div>
                                <div class="col-md-6">
                                  <div class="text-right">
                                    <pagination
                                      style="margin: 0 0 20px 0"
                                      :limit="1"
                                      :show-disabled="true"
                                      :data="hepeSalesmanList"
                                      @pagination-change-page="
                                        getHepeSalesmanList
                                      "
                                    ></pagination>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div
                          class="tab-pane fade in active"
                          id="demo-tabs-box-2"
                          v-if="tab == 2"
                        >
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
                                        @keyup="search3"
                                        v-model="searchassignSalesman"
                                        placeholder="Search Name"
                                      />
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <table
                              id="customerAssignTbl"
                              class="table table-striped table-hover table-vcenter nowrap"
                              width="100%"
                            >
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>User Code</th>
                                  <th>Department</th>
                                  <th>Division</th>
                                  <th>Address</th>
                                  <th>Hepe Code</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-if="!assignSalesman.data.length">
                                  <td colspan="7" class="text-center text-bold">
                                    No data available
                                  </td>
                                </tr>
                                <tr
                                  v-for="(salesman,
                                  index) in assignSalesman.data"
                                  :key="index"
                                >
                                  <td>
                                    {{
                                      salesman.first_name +
                                        ' ' +
                                        salesman.last_name
                                    }}
                                  </td>
                                  <td>{{ salesman.user_code }}</td>
                                  <td>{{ salesman.department }}</td>
                                  <td>{{ salesman.division }}</td>
                                  <td>{{ salesman.address }}</td>
                                  <td>
                                    <em v-if="!salesman.hepe_code">NULL</em>
                                    <span v-else>{{ salesman.hepe_code }}</span>
                                  </td>

                                  <td>
                                    <button
                                      type="button"
                                      class="btn btn-info btn-xs btn-rounded"
                                      title="Tag Salesman to Hepe"
                                      :disabled="hepeinfo.status == '0'"
                                      @click="
                                        tagBtn(
                                          salesman.user_code,
                                          usercode,
                                          '1'
                                        )
                                      "
                                    >
                                      <i class="fa fa-tag"></i> Tag
                                    </button>
                                    <button
                                      type="button"
                                      class="btn btn-info btn-xs btn-rounded"
                                      title="Logs"
                                      @click="logsBtn(salesman.user_code)"
                                    >
                                      <i class="fa fa-archive"></i>
                                      Logs
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  Showing {{ assignSalesman.from }} to
                                  {{ assignSalesman.to }} of
                                  {{ assignSalesman.total }} entries
                                  <span v-if="searchassignSalesman"
                                    >(Filtered from
                                    {{ form.total_assignSalesman }} total
                                    entries)</span
                                  >
                                </div>
                                <div class="col-md-6">
                                  <div class="text-right">
                                    <pagination
                                      style="margin: 0 0 20px 0"
                                      :limit="1"
                                      :show-disabled="true"
                                      :data="assignSalesman"
                                      @pagination-change-page="
                                        getAssignHepeSalesman
                                      "
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
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="closeBtn()">
                <i class="fa fa-close"></i> Close
              </button>
            </div>-->
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="logsMdl"
        tabindex="-1"
        role="dialog"
        data-backdrop="static"
        data-keyboard="false"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="MdlTitle">History logs</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="logcloseBtn()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table
                class="table table-striped table-hover table-vcenter nowrap"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>Hepe Code</th>
                    <th>Date</th>
                    <!-- <th>Tagged By</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="!salesmanLogs.data.length">
                    <td colspan="2" class="text-center">
                      No data available.
                    </td>
                  </tr>
                  <tr v-for="(logs, index) in salesmanLogs.data" :key="index">
                    <td>{{ logs.hepe_code }}</td>
                    <td>{{ logs.created_at | formatDate }}</td>
                    <!-- <td>-</td> -->
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  @click="logcloseBtn()"
                >Close</button>
              </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/** @format */
import Vue from 'vue'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'

Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
export default {
  data() {
    return {
      show_su_div: false,
      show_edit: false,
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
        title: 'Jefe de Viaje',
        product_line: 'All',
        address: '',
        postal_code: '',
        email: '',
        telephone: '',
        mobile: '',
        user_code: '',
        status: '',
        usercode: '',
        editValue: 0,
        old_password: '',
        new_password: '',
        new_password2: '',
        total_result: null,
        total_assignSalesman: null,
        total_salesmanlist: null
      }),
      municipality: [],
      hepe: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      searchHepe: null,
      hepeinfo: [],
      usercode: '',
      assignSalesman: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      hepeSalesmanList: {
        data: []
      },
      searchassignSalesman: null,
      searchHepeSalesman: null,
      salesmanLogs: {
        data: [],
        current_page: null,
        from: null,
        to: null,
        total: null,
        per_page: null
      },
      tab: 1
    }
  },
  methods: {
    search2() {
      this.searchForHepeSalesman(this.searchHepeSalesman, this)
    },
    searchForHepeSalesman: _.debounce((search, vm) => {
      axios
        .get(
          `/hepedeviaje/getHepeSalesmanList/customer?usercode=${vm.usercode}&name=${search}&page=1`
        )
        .then(({ data }) => {
          vm.hepeSalesmanList = data
        })
    }, 100),

    search3() {
      this.searchForSalesmanAssign(this.searchassignSalesman, this)
    },
    searchForSalesmanAssign: _.debounce((search, vm) => {
      axios
        .get(
          `/hepedeviaje/getAssignHepeSalesmanList/customer?usercode=${vm.usercode}&name=${search}&page=1`
        )
        .then(({ data }) => {
          vm.assignSalesman = data
        })
    }, 100),

    search() {
      this.searchForHepe(this.searchHepe, this)
    },
    searchForHepe: _.debounce((search, vm) => {
      axios
        .get(`/hepedeviaje/get_hepe/name/?name=${search}&page=1`)
        .then(response => {
          vm.hepe = response.data
        })
    }, 100),
    getResults(page = 1) {
      let url = null
      if (!this.searchHepe) {
        url = '/hepedeviaje/get_hepe/?page='
        axios.get(url + page).then(response => {
          this.form.total_result = response.data.total
        })
      } else {
        url = `/hepedeviaje/get_hepe/name/?name=${this.searchHepe}&page=`
      }
      axios.get(url + page).then(response => {
        this.hepe = response.data
      })
    },
    addBtn() {
      this.show_su_div == false
        ? (this.show_su_div = true)
        : (this.show_su_div = false)

      if (this.show_su_div == false) {
        this.form.clear()
        this.form.reset()
      }
      this.populateMunicipality()
      $('#container').css('position', 'relative')
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
    changeAddress() {
      this.form.errors.clear('address')
    },
    editBtn() {
      this.show_edit == false
        ? (this.show_edit = true)
        : (this.show_edit = false)
    },
    clear() {
      this.show_edit == false
        ? (this.show_edit = true)
        : (this.show_edit = false)
    },
    list(data, code) {
      this.usercode = code
      this.hepeinfo = data
      Promise.all([
        this.getAssignHepeSalesman(code),
        this.getHepeSalesmanList(code)
      ]).then(response => {
        this.assignSalesman = response[0].data
        this.form.total_assignSalesman = response[0].data.total
        this.hepeSalesmanList = response[1].data
        this.form.total_salesmanlist = response[1].data.total
        $('#Mdl').modal('show')
      })
    },
    async getAssignHepeSalesman(usercode) {
      return await axios.get(
        `/hepedeviaje/getAssignHepeSalesmanList?usercode=${usercode}`
      )
    },
    async getHepeSalesmanList(usercode) {
      return await axios.get(`
      /hepedeviaje/getHepeSalesmanList?usercode=${usercode}`)
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
            .post('/create_hepe')
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
                    this.populateMunicipality()
                    this.getResults()
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
    closeBtn() {
      this.searchHepeSalesman = null
      this.searchassignSalesman = null
      // this.hepeinfo = []
      // this.assignSalesman = []
      // this.hepeSalesmanList = []
      $('.nav-tabs a[href="#demo-tabs-box-1"]').tab('show')
      $('#Mdl').modal('hide')
      this.tab = 1
    },
    tagBtn(sm_code, code, status) {
      this.form.user_code = sm_code
      this.form.usercode = code
      this.form.status = status
      $('#Mdl').modal('hide')
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Assign this Salesman?',
        text: 'By confirming, Salesman will be tagged to Jefe.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          this.form
            .post('/hepedeviaje/tagSalesmanToHepe')
            .then(({ data, status }) => {
              if (data == 'Success') {
                Swal.fire({
                  title: 'Success!',
                  text: 'Salesman has been tagged to Jefe',
                  icon: 'success',
                  allowOutsideClick: false
                }).then(result => {
                  if (result.value) {
                    $('#container').css('position', 'relative')
                    $('.nav-tabs a[href="#demo-tabs-box-1"]').tab('show')
                    this.searchHepeSalesman = null
                    this.searchassignSalesman = null

                    Promise.all([
                      this.getAssignHepeSalesman(code),
                      this.getHepeSalesmanList(code)
                    ]).then(response => {
                      this.assignSalesman = response[0].data
                      this.form.total_assignSalesman = response[0].data.total
                      this.hepeSalesmanList = response[1].data
                      this.form.total_salesmanlist = response[1].data.total
                      $('#Mdl').modal('show')
                    })
                    // this.hepeinfo = []
                    // this.getResults()
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
          $('#Mdl').modal('show')
        }
      })
    },
    untagBtn() {
      $('#Mdl').modal('hide')
      $('#container').css('position', 'sticky')
      Swal.fire({
        title: 'Untag Salesman to Jefe de Viaje?',
        text: 'You can be able to change this later.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        allowOutsideClick: false
      }).then(result => {
        if (result.value) {
          Swal.fire({
            title: 'Success!',
            text: 'Information has been changed.',
            icon: 'success',
            allowOutsideClick: false
          }).then(result => {
            if (result.value) {
              $('#container').css('position', 'relative')
            }
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
          $('#Mdl').modal('show')
        }
      })
    },
    btn_activation(id, status) {
      this.form.id = id
      this.form.status = status
      this.form.post('/hepedeviaje/activate_hepe').then(({ data }) => {
        if (data.trim() == 'Success') {
          if (status == '1') {
            $.niftyNoty({
              type: 'success',
              icon: 'pli-cross icon-2x',
              message: '<i class="fa fa-check"></i> Status changed to Active.',
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
          this.getResults()
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
    },
    favoriteBtn(e) {
      $('#star').toggleClass('favorite-color')
    },
    logsBtn(usercode) {
      $('#Mdl').modal('toggle')
      $('#logsMdl').modal('show')
      axios
        .get(`/hepedeviaje/getSalesmanLogs/?usercode=${usercode}`)
        .then(response => {
          this.salesmanLogs = response.data
          // console.log(this.salesmanLogs)
        })
    },
    logcloseBtn() {
      $('#logsMdl').modal('toggle')
      $('#Mdl').modal('show')
      // this.salesmanLogs = {}
    }
  },
  mounted() {
    $('#submitForm').on('click', function(e) {
      e.preventDefault()
    })
    this.$root.currentPage = this.$route.meta.name
    this.getResults()
  }
}
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

.invoice-details td.text-main.text-bold {
  text-align: left;
}

.invoice-details td.text-info.text-bold {
  text-align: left;
}

.invoice-details td.text-main {
  text-align: left;
}
#container .invoice-details td {
  padding: 5px 7px;
}

.tab-base .nav-tabs > .active > a,
.tab-base .nav-tabs > .active a:hover,
.tab-base .nav-tabs > .active > a:focus {
  box-shadow: inset 0 -2px 0 0 #1e3a57 !important;
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

.shadow {
  box-shadow: 0 4px 6px 0 rgb(0 0 0 / 10%), 0 2px 4px 0 rgb(0 0 0 / 6%);
}
</style>
