<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const efficiencies = ref([]);
const error = ref(null);
const OP = ref(0);
const HP = ref(0);
const percentage = ref(0);
const ref_efficiency = ref(0);
const smv_ref = ref(0);
const smv = ref(0);

const getCategory = () => {
    axios.get('/api/efficiencies')
        .then((response) => {
            efficiencies.value = response.data;
        })
        .catch((err) => {
            error.value = err;
        });
}

const deleteCategory = (categoryId) => {
    if (confirm('Are you sure, you want to delete ?')) {
        console.log(categoryId);
    }
}

const get_efficiency_ref = () => {
    if (efficiencies.value.length > 0) {
        const ref_efficiency = efficiencies.value[0].efficiency_ref;
    }
    return {
        ref_efficiency,
    }

}

const get_smv_ref = () => {
    axios.get('/api/smv_libraries')
        .then((response) => {
            smv_ref.value = response.data;
        })
        .catch((err) => {
            error.value = err;
        });
}

const get_smv = () => {
    if (ref_efficiency.value == smv_ref.value) {
        axios.get('/api/smv_libraries')
            .then((response) => {
                smv.value = response.data;
            })
            .catch((err) => {
                error.value = err;
            });
    }
}

const HP_Percentage = () => {
    if (efficiencies.value.length > 0) {
        const op = efficiencies.value[0].OP;
        const hp = efficiencies.value[0].HP;
        percentage.value = (hp / op) * 100;
    }
    return {
        HP_Percentage,
        OP,
        HP,
        percentage
    };
}

onMounted(() => {
    getCategory();
    get_efficiency_ref();
    HP_Percentage();
    get_smv_ref();
    get_smv();
});
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Efficiency Report</h4>
                    <h6></h6>
                </div>
                <div class="page-btn">
                    <router-link to="/admin/efficiency" class="btn btn-added">
                        <img src="assets/img/icons/plus.svg" alt="img">Efficiency
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
                                    <th>Unite</th>
                                    <th>Line</th>
                                    <th>OP</th>
                                    <th>HP</th>
                                    <th>HP(%)</th>
                                    <th>W/Hrs</th>
                                    <th>Target</th>
                                    <th>Achieve</th>
                                    <th>Achieve(%)</th>
                                    <th>SMV</th>
                                    <th>Target Effi</th>
                                    <th>Achieve Effi </th>
                                    <th>Rank Line on Effi </th>
                                    <th>Unite Effi </th>
                                    <th>Unite Rank </th>
                                    <th>Target $FOB</th>
                                    <th>Earn $FOB</th>
                                    <th>Target $CM</th>
                                    <th>Earn $CM</th>
                                    <th>Ttl Cost</th>
                                    <th>Loss/Profit</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, i) in efficiencies" :key="row.id" :value="row.id">
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>{{ row.unite_id }}</td>
                                    <td>{{ row.Line_No }}</td>
                                    <td>{{ row.Ttl_OP }}</td>
                                    <td>{{ row.Ttl_HP }}</td>
                                    <td>{{ parseFloat((row.Ttl_HP / row.Ttl_OP) * 100).toFixed(2) }}%</td>
                                    <td>{{ row.Working_Hrs }}</td>
                                    <td>{{ row.Today_Target }}</td>
                                    <td>{{ row.Today_Output }}</td>
                                    <td>{{ parseFloat((row.Today_Output / row.Today_Target) * 100).toFixed(2) }}%</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>

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
