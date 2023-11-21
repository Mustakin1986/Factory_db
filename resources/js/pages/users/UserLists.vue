<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { RouterLink } from 'vue-router';
import { formatDate } from '../../helper.js';
import { useToastr } from '../../toastr.js';
import Swal from 'sweetalert2';

const toastr = useToastr();

var users = ref([]);
var error = ref(null);

const getUsers = () => {
    axios.get('/api/users')
        .then((response) => {
            users.value = response.data;
        })
        .catch((err) => {
            error.value = err;
        });
}
const roles = ref([
    {
        name: 'Admin',
        value: 1
    },
    {
        name: 'User',
        value: 2,
    }
]);

const changeRole = (user, role) => {
    axios.patch(`/api/users/${user.id}/change-role`, {
        role: role,
    })
        .then(() => {
            toastr.success('Role changed successfully!');
        })
};
const deleteUser = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/users/${id}`)
                .then((response) => {
                    users.value.data = users.value.data.filter(user => user.id !== id);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                });

        }
    })
};


onMounted(() => {
    getUsers();
});
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User List</h4>
                    <h6>Manage your User</h6>
                </div>
                <div class="page-btn">
                    <router-link to="/admin/user" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                            class="me-2">Add User</router-link>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="assets/img/icons/filter.svg" alt="img">
                                    <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="assets/img/icons/search-white.svg" alt="img">
                                </a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                            src="assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                            src="assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                            src="assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter User Name">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Disable</option>
                                            <option>Enable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                            <span>Sl</span>
                                        </label>
                                    </th>
                                    <th>Profile</th>
                                    <th>name </th>
                                    <th>Phone</th>
                                    <th>email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Registered Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users" :key="user.id" :value="user.id">
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                            <span>{{ index + 1 }}</span>
                                        </label>

                                    </td>

                                    <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">
                                            <img src="assets/img/customer/customer4.jpg" alt="product">
                                        </a>
                                    </td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.tel }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <select class="form-control form-small select" style="text-align: center;"
                                            @change="changeRole(user, $event.target.value)">
                                            <option v-for="role in roles" :value="role.value"
                                                :selected="user.role === role.name">{{ role.name }}</option>
                                        </select>
                                    </td>

                                    <td>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="user18" class="check" checked="">
                                            <label for="user18" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    <td>{{ formatDate(user.created_at) }}</td>
                                    <td>
                                        <router-link class="me-3" :to="`/admin/user/${user.id}/edit`">
                                            <i class="far fa-edit"></i>
                                        </router-link>
                                        <a class="me-3 confirm-text" href="#"
                                            @click.prevent="$event => deleteUser(user.id)">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>
