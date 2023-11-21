<script setup>
import axios from 'axios';
import { formatDate } from '../../helper.js';
import { onMounted, ref } from 'vue';

var smv_list = ref([]);
var error = ref(null);

const getAll = () => {
    axios.get('/api/smv_libraries')
        .then((response) => {
            smv_list.value = response.data;
        })
        .catch((err) => {
            error.value = err;
        });
}

onMounted(() => {
    getAll();
});
</script>


<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>SMV List</h4>
                    <h6>Manage your SMV Library</h6>
                </div>
                <div class="page-btn">
                    <router-link to="/admin/Smv_library" class="btn btn-added"><img src="assets/img/icons/plus.svg"
                            alt="img" class="me-2">Add SMV</router-link>
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
                                        </label>
                                    </th>
                                    <th>Image</th>
                                    <th>Style No </th>
                                    <th>Po No </th>
                                    <th>Item</th>
                                    <th>Item Description</th>
                                    <th>Costing SMV</th>
                                    <th>Bulk SMV</th>
                                    <th>Remarks</th>
                                    <th>Create Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(smv, index) in smv_list " :key="smv.id" :value="smv.id">
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">
                                            <img :src="'/smv/' + smv.photo" :alt="smv.photo">
                                        </a>
                                    </td>
                                    <td>{{ smv.style_no }}</td>
                                    <td>{{ smv.po_no }}</td>
                                    <td>{{ smv.item }}</td>
                                    <td>{{ smv.item_description }}</td>
                                    <td>{{ smv.costing_smv }}</td>
                                    <td>{{ smv.bulk_smv }}</td>
                                    <td>{{ smv.remarks }}</td>
                                    <td>{{ formatDate(smv.created_at) }}</td>
                                    <td>
                                        <a class="me-3" href="edituser.html">
                                            <img src="assets/img/icons/edit.svg" alt="img">
                                        </a>
                                        <a class="me-3 confirm-text" href="javascript:void(0);">
                                            <img src="assets/img/icons/delete.svg" alt="img">
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
