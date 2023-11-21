<script>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { useToastr } from '../../toastr';
import { useRouter } from 'vue-router';


const unites = ref([]);
const lines = ref([]);
const items = ref([]);
const smv = ref([]);


export default {
    setup() {
        const router = useRouter();
        const toastr = useToastr();

        const form = reactive([
            {
                unite_id: '',
                Line_No: '',
                Ttl_OP: '',
                Ttl_HP: '',
                Working_Hrs: '',
                style_no: '',
                Po_No: '',
                Item: '',
                smv: '',
                Today_Target: '',
                Today_Output: '',
                remarks: '',


            }
        ]);

        const addRow = () => {
            const newUniteId = form.length > 0 ? form[0].unite_id : '';
            form.push({
                unite_id: newUniteId,
                Line_No: '',
                Ttl_OP: '',
                Ttl_HP: '',
                Working_Hrs: '',
                style_no: '',
                Po_No: '',
                Item: '',
                smv: '',
                Today_Target: '',
                Today_Output: '',
                remarks: '',


            });
        }
        const getLine = () => {
            axios.get('/api/lines')
                .then(response => {
                    lines.value = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
        const getItem = () => {
            axios.get('/api/smv_libraries')
                .then(response => {
                    items.value = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }

        const removeRow = (index) => {
            if (form.length > 1) {
                form.splice(index, 1);
            }
        }

        const getUnites = () => {
            axios.get('/api/unites')
                .then(response => {
                    unites.value = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
        const submit = () => {
            if (form.length - 1) {
                axios.post('/api/efficiencies', form)
                    .then(res => {
                        toastr.success('Data Inserted Successfully');
                    })
                    .catch((error) => {
                        // Handle the error, for example, by displaying an error toastr message.
                        toastr.error('An error occurred while creating the Data Inserted');
                    })

            }

        }
        const efficiency_report = (event) => {
            const selectedValue = event.target.value;
            switch (selectedValue) {
                case '1':
                    router.push('/admin/single_unite');
                    break;
                case '2':
                    router.push('/admin/all_unite');
                    break;
                case '3':
                    router.push('/admin/monthly');
                    break;
                case '4':
                    router.push('/admin/yearly');
                    break;
                default:
                    router.push('/admin/efficiency');
                    break;
            }
        }

        onMounted(() => {
            getUnites();
            getLine();
            getItem();
        });

        return {
            form,
            submit,
            addRow,
            removeRow,
            unites,
            lines,
            getLine,
            getUnites,
            getItem,
            items,
            efficiency_report
        }
    }
}
</script>


<template>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <router-link to="/admin/smv_library" class="btn btn-primary btn-sm mb-2">SMV Library</router-link>
                    <div class="e-page-title">
                        <h4> Efficiency Report Entry Form</h4>
                        <h5>Create Efficiency Report</h5>
                    </div>
                    <div class="col-mb-3 e-report">
                        <div class="input-group input-group-sm mb-1">
                            <span class="input-group-text btn btn-primary" id="inputGroup-sizing-sm">Reports</span>
                            <select class="form-select form-select-sm " aria-label="Small select example"
                                @change="efficiency_report">
                                <option selected>Select Report</option>
                                <option value="1"><router-link to="/admin/single_unite">Single
                                        Unite</router-link></option>
                                <option value="1">All Unite</option>
                                <option value="2">Monthly</option>
                                <option value="3">Yearly</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-mb-12 e-header">
                    <div class="col-mb-3 date_unite">
                        <div class="input-group input-group-sm mb-1">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Report Date</span>
                            <input type="date" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-1">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Select Unite</span>
                            <select class="form-select form-select-sm" aria-label="Select Unite" v-model="form[0].unite_id"
                                @change="getLine">
                                <option disabled value="">Select Unite</option>
                                <option v-for="unite in unites" :key="unite.id" :value="unite.id">{{ unite.uniteName }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-mb-3 observer">
                        <div class="input-group input-group-sm mb-1">
                            <span class=" input-group-text" id="inputGroup-sizing-sm">Observer Name</span>
                            <select class="form-select form-select-sm " aria-label="Small select example">
                                <option selected>Select Observer</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class=" card">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                                aria-selected="false">Profile</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive" cellspacing="0">
                                                <table class="table table-sm table_e">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th style="display:none;">Unite id</th>
                                                            <th>Line No</th>
                                                            <th>Ttl OP</th>
                                                            <th>Ttl HP</th>
                                                            <th>W/Hrs/Day</th>
                                                            <th>Style No</th>
                                                            <th>Po No</th>
                                                            <th>Item</th>
                                                            <th>SMV</th>
                                                            <th>Today Target</th>
                                                            <th>Today Output</th>
                                                            <th>Remarks</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="efficiency_report, index in form"
                                                            :key="efficiency_report" class="table_e">
                                                            <td style="display:none;"><input
                                                                    v-model="efficiency_report.unite_id"
                                                                    class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example">
                                                            </td>
                                                            <td>
                                                                <select class="form-select form-select-sm"
                                                                    aria-label=".form-select-sm example"
                                                                    v-model="efficiency_report.Line_No" @change="addRow">
                                                                    <option v-for="line in lines" :key="line.id"
                                                                        :value="line.id">{{
                                                                            line.Line }}
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.Ttl_OP">
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.Ttl_HP">
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.Working_Hrs">
                                                            </td>
                                                            <td style="width:8%;">
                                                                <select class="form-select form-select-sm"
                                                                    aria-label=".form-select-sm example"
                                                                    v-model="efficiency_report.style_no">
                                                                    <option v-for="item in items" :key="item.id"
                                                                        :value="item.style_no">{{
                                                                            item.style_no }}</option>

                                                                </select>
                                                            </td>

                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.Po_No">
                                                            </td>
                                                            <td style="width:8%;">
                                                                <select class="form-select form-select-sm"
                                                                    aria-label=".form-select-sm example"
                                                                    v-model="efficiency_report.Item">
                                                                    <option v-for="item in items" :key="item.id"
                                                                        :value="item.item">{{
                                                                            item.item }}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.smv">
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.Today_Target">
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.Today_Output">
                                                            </td>
                                                            <td>
                                                                <input class="form-control form-control-sm" type="text"
                                                                    aria-label=".form-control-sm example"
                                                                    v-model="efficiency_report.remarks">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm" @click="removeRow">
                                                                    <span style="align-items: center;"><i
                                                                            class="fa fa-minus"></i></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary btn-sm float-end m-1" @click="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
