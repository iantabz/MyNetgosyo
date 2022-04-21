<template>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-weight:bold;">User Types</h3>
        </div>

        <div class="panel-body">
            <div class="row" style="margin: 0px 0px 10px 0px;">
                <div class="col-lg-12">
                    <button
                        class="btn btn-success btn-rounded pull-right"
                        @click="addUserType()"
                    >
                        <i class="fa fa-plus-circle"></i> User Type
                    </button>
                </div>
            </div>
            <table
                id="tbl_usertype"
                class="table table-striped table-bordered"
                cellspacing="0"
                width="100%"
            >
                <thead>
                    <tr>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, i) in user_types" :key="i">
                        <td>{{ data.usertype }}</td>
                        <td>
                            {{ data.status == true ? "Active" : "Inactive" }}
                        </td>
                        <td>
                            <div class="btn-group btn-group-xs dropdown">
                                <button class="btn btn-info">Action</button>
                                <button
                                    class="btn btn-info dropdown-toggle dropdown-toggle-icon"
                                    data-toggle="dropdown"
                                    type="button"
                                    aria-expanded="false"
                                >
                                    <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu" style>
                                    <li>
                                        <a href="#">Action</a>
                                    </li>
                                    <li>
                                        <a href="#">Another action</a>
                                    </li>
                                    <li>
                                        <a href="#">Something else here</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">Separated link</a>
                                    </li>
                                </ul>
                            </div>
                            <button
                                @click="editUserType(data)"
                                class="btn btn-primary btn-xs"
                            >
                                <i class="fa fa-pencil-square-o"></i> Edit
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                class="modal fade"
                id="add_usertype_modal"
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
                                Modal title
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                                @click="closeModal()"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="submitform">
                            <div class="modal-body">
                                <div
                                    class="form-group"
                                    :class="{
                                        'has-error': dataForm.errors.has(
                                            'usertype'
                                        )
                                    }"
                                >
                                    <input
                                        type="hidden"
                                        class="form-control"
                                        v-model="dataForm.id"
                                        id="id"
                                    />
                                    <label for="usertype">User Type:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="usertype"
                                        v-model="dataForm.usertype"
                                        placeholder="User Type"
                                    />
                                    <has-error
                                        :form="dataForm"
                                        field="usertype"
                                    ></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-default"
                                    data-dismiss="modal"
                                    @click="closeModal()"
                                >
                                    Close
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    @click="submit()"
                                >
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import Swal from "sweetalert2";
import { Form, HasError, AlertError } from "vform";
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

export default {
    data() {
        return {
            msg: "User Type Information",
            dataForm: new Form({
                id: "",
                usertype: ""
            }),
            user_types: [],
            error_msg: ""
        };
    },
    methods: {
        addUserType() {
            $("#add_usertype_modal").modal("show");
            $(".modal-title").html(
                '<i class="fa fa-plus-circle"></i> Usertype Setup'
            );
        },
        submit() {
            this.dataForm
                .post("/create_usertype")
                .then(({ data, status }) => {
                    if (data == "Success") {
                        Swal.fire(
                            "Good job!",
                            "action has been made",
                            "success"
                        );
                        $("#add_usertype_modal").modal("hide");
                        this.clearData();
                        this.getUserTypes();
                    } else {
                        console.log(data);
                    }
                })
                .catch(data => {
                    console.log(status);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: toast => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        }
                    });

                    Toast.fire({
                        icon: "error",
                        title: "Data given is invalid"
                    });
                });
        },
        clearData() {
            this.dataForm.usertype = "";
            this.dataForm.id = "";
        },
        getUserTypes() {
            axios
                .get("/getUserTypes")
                .then(response => {
                    this.user_types = response.data;
                    if (Object.keys(this.user_types).length) {
                        setTimeout(() => {
                            $("#tbl_usertype").DataTable();
                        }, 500);
                    }
                })
                .catch();
        },
        editUserType(data) {
            console.log(data);
            $("#add_usertype_modal").modal("show");
            $(".modal-title").html("Edit User Type");
            this.dataForm.usertype = data.usertype;
            this.dataForm.id = data.id;
        },
        closeModal() {
            this.clearData();
        },
        test() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: "success",
                title: "Signed in successfully"
            });
        }
    },
    mounted() {
        console.log("Component mounted.");
        this.getUserTypes();
    }
};
</script>
