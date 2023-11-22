<script>
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import { useToastr } from '../../toastr';

const toastr = useToastr();

const unites = ref([]);

export default {
    setup() {
        const form = reactive([
            {
                unite_id: '',
                Line: '',
                remarks: '',
            }
        ]);

        const addRow = () => {
            const newUniteId = form.length > 0 ? form[0].unite_id : '';
            form.push({
                unite_id: newUniteId,
                Line: '',
                remarks: '',
            });
        };

        const removeRow = (index) => {
            if (form.length > 1) {
                form.splice(index, 1);
            }
        };

        const submit = () => {
            if (form.length - 1) {
                axios.post('/api/lines', form)
                    .then(res => {
                        toastr.success('Line Created Successfully');
                    })
                    .catch((error) => {
                        toastr.error('An error occurred while creating the Line');
                    });
            }

        };

        const getUnites = () => {
            axios.get('/api/unites')
                .then(response => {
                    unites.value = response.data;
                });
        };

        onMounted(() => {
            getUnites();
        });

        return {
            removeRow,
            addRow,
            submit,
            form,
            unites,
            getUnites
        };
    }
}
</script>
<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Default Datatable</h4>
                            <p class="card-text">
                                This is the most basic example of the datatables with zero configuration. Use the
                                <code>.datatable</code> class to initialize datatables.
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Select Unite</span>
                                <select class="form-select" aria-label="Default select example" v-model="form[0].unite_id">
                                    <option disabled>Select Unite</option>
                                    <option v-for="unite in unites" :key="unite.id" :value="unite.id">{{ unite.uniteName }}
                                    </option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">Unite id</th>
                                            <th>Line</th>
                                            <th>Remarks</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in form" :key="row.id" :value="row.id">
                                            <td style="display:none;"><input v-model="row.unite_id"
                                                    class="form-control form-control-sm" type="text"
                                                    aria-label=".form-control-sm example">
                                            </td>

                                            <td> <input class=" form-control form-control-sm" type="text"
                                                    aria-label=".form-control-sm example" v-model="row.Line"
                                                    @click="addRow"></td>
                                            <td><input class="form-control form-control-sm" type="text"
                                                    aria-label=".form-control-sm example" v-model="row.remarks">
                                            </td>
                                            <td><button class="btn btn-primary btn-sm" @click="removeRow(index)">-</button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-mb-12 m-3">
                                <button class="btn btn-primary btn-sm float-end" @click="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
