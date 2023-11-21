<script>
import { reactive, ref } from 'vue';
import axios from 'axios';
import { useToastr } from '../../toastr';

const toastr = useToastr();
export default {
    setup() {
        const form = reactive([
            {
                size: '',
                color_name: '',
                remarks: '',
            }
        ]);
        const formData = reactive([
            {
                size: '',
            }
        ]);

        const addRow = () => {
            form.push({
                color_name: '',
                remarks: '',
            });
        }
        const addCol = () => {
            formData.push({
                size: '',
            });
        }

        const removeRow = (index) => {
            if (form.length > 1) {
                form.splice(index, 1);
            }
        }
        //.for Unite
        const submit = () => {
            axios.post('/api/unites', form)
                .then(res => {
                    toastr.success('Unite Created Successfully');
                })
                .catch((error) => {
                    toastr.error('An error occurred while creating the Unite');
                });
        }

        return {
            form,
            formData,
            submit,
            addRow,
            removeRow,
            addCol
        }
    }
}
</script>

<template>
    <div class="page-wrapper">
        <div class="table-responsive" cellspacing="0">
            <div class="table_e">
                <thead>
                    <tr style="text-align: center;">
                        <th>Sl</th>
                        <th>Color Name</th>
                        <th colspan="">
                            Size Range
                        <td v-for="size, index in formData" :key="size">
                            <input class="form-control form-size-control-sm" type="text" v-model="size.size"
                                aria-label=".form-control-sm example">
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm m-2" @click="addCol">+</button>
                        </td>
                        </th>
                        <th>Remarks</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="unites, index in form" :key="unites">
                        <td>
                            {{ index + 1 }}
                        </td>
                        <td>
                            <input class="form-control form-control-sm" type="text" aria-label=".form-control-sm example"
                                v-model="unites.color_name">
                        </td>
                        <td>
                            <input class="form-control form-control-sm" type="text" aria-label=".form-control-sm example"
                                v-model="unites.remarks">
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" @click="removeRow(index)">-</button>
                        </td>
                    </tr>
                </tbody>
            </div>
        </div>
        <hr>
        <div class="col-mb-12 m-3">
            <button class="btn btn-primary btn-sm" @click="addRow">Add Row</button>
            <button class="btn btn-primary btn-sm float-end" @click="submit">Submit</button>
        </div>
    </div>
</template>

