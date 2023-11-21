<script setup>
import axios from 'axios';
import { formatDate } from '../../helper.js';
import { onMounted, ref } from 'vue';

var categories = ref([]);
var error = ref(null);

const getCategory = () => {
    axios.get('/api/categories')
        .then((response) => {
            categories.value = response.data;
        })
        .catch((err) => {
            error.value = err;
        });
}

const deleteCategory = (categoryId) => {
    if (confirm('Are you sure, you want to delete ?'))
        console.log(categoryId);
}

onMounted(() => {
    getCategory();
});
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>CATEGORY</h4>
                    <h6>Manage your Category</h6>
                </div>
                <div class="page-btn">
                    <router-link to="/admin/add_category" class="btn btn-added">
                        <img src="assets/img/icons/plus.svg" alt="img">Add New Category
                    </router-link>
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
                                <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
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
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Reference">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Supplier</option>
                                            <option>Supplier</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Inprogress</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Payment Status</option>
                                            <option>Payment Status</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Category Code</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category, index) in categories" :key="category.id" :value="category.id">
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="text-bolds">{{ index + 1 }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.description }}</td>
                                    <td>{{ formatDate(category.created_at) }}</td>
                                    <td>
                                        <a class="me-3" href="editpurchase.html">
                                            <img src="assets/img/icons/edit.svg" alt="img">
                                        </a>

                                        <button type="button" @click="deleteCategory(category.id)" class="me-3 confirm-text"
                                            style="border: none; background-color: none;"><i
                                                class="fa fa-trash text-danger"></i></button>
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
