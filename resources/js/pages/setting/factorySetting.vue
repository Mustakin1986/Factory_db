<script>
import { reactive } from 'vue';
import axios from 'axios';
import { useToastr } from '../../toastr';

const toastr = useToastr();

export default {
    setup() {
        const form = reactive([
            {
                uniteName: '',
                remarks: '',
            }
        ]);

        const addRow = () => {
            form.push({
                uniteName: '',
                remarks: '',
            });
        }

        const removeRow = (index) => {
            if (form.length > 1) {
                form.splice(index, 1);
            }
        }
        //.for Unite
        const submit = () => {
            if (form.length > 1) {
                axios.post('/api/unites', form)
                    .then(res => {
                        toastr.success('Unite Created Successfully');
                    })
                    .catch((error) => {
                        toastr.error('An error occurred while creating the Unite');
                    });
            }
        }
        return {
            form,
            submit,
            addRow,
            removeRow,


        }
    }
}
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="table-responsive" cellspacing="0">
                <div class="table_e">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Unite Name</th>
                            <th>Remarks</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="unites, index in form" :key="unites">
                            <td>
                                <input class="form-control form-control-sm" type="text"
                                    aria-label=".form-control-sm example" v-model="unites.uniteName" @click="addRow">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" type="text"
                                    aria-label=".form-control-sm example" v-model="unites.remarks">
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="removeRow(index)">-</button>
                            </td>
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-mb-12 m-3">
            <router-link to="/admin/line" class="btn btn-primary btn-sm">Add Line</router-link>
            <button class="btn btn-primary btn-sm float-end" @click="submit">Submit</button>
        </div>
    </div>
</template>

