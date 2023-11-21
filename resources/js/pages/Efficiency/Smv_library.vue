
<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useToastr } from '../../toastr';

const router = useRouter();
const toastr = useToastr();
const form = reactive({
    style_no: '',
    po_no: '',
    item: '',
    item_description: '',
    costing_smv: '',
    bulk_smv: '',
    remarks: '',
    photo: null, // Initialize photo as null
});

const handleSubmit = () => {
    // Create a FormData object to handle file upload
    const formData = new FormData();
    formData.append('style_no', form.style_no);
    formData.append('po_no', form.po_no);
    formData.append('item', form.item);
    formData.append('item_description', form.item_description);
    formData.append('costing_smv', form.costing_smv);
    formData.append('bulk_smv', form.bulk_smv);
    formData.append('remarks', form.remarks);
    formData.append('photo', form.photo);
    axios.post('/api/smv_libraries', formData)
        .then((response) => {
            router.push('/admin/smv_list');
            toastr.success('Add SMV Successfully');
        })
        .catch((error) => {
            // Handle the error, for example, by displaying an error toastr message.
            toastr.error('An error occurred while creating the smv');
        });
};

const onFileChange = (event) => {
    form.photo = event.target.files[0];
};
</script>

<template>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>SMV LIBRARY</h4>
                        <h6>Add/Update SMV</h6>
                    </div>
                    <div>
                        <router-link to="/admin/smv_list" class="btn btn-primary brn-sm">SMV List</router-link>
                    </div>
                </div>

                <div class="card">
                    <form @submit.prevent="$event => handleSubmit()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div>
                                        <label>Style</label>
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label=".form-control-sm example" v-model="form.style_no">
                                    </div>
                                    <div>
                                        <label>Po No</label>
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label=".form-control-sm example" v-model="form.po_no">
                                    </div>

                                    <div>
                                        <label>Item </label>
                                        <select select class=" form-select form-select-sm"
                                            aria-label=".form-select-sm example" v-model="form.item">
                                            <option>Select Item</option>
                                            <option>Top</option>
                                            <option>Btm</option>
                                            <option>Top_Btm</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label>Item Description</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            v-model="form.item_description">
                                            <option>Select Item</option>
                                            <option>Men's Long T-shirt</option>
                                            <option>Men's SS T-shirt</option>
                                            <option>Men's Long Pant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div>
                                        <label>Costing SMV</label>
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label=".form-control-sm example" v-model="form.costing_smv">
                                    </div>
                                    <div>
                                        <label>Bulk SMV</label>
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label=".form-control-sm example" v-model="form.bulk_smv">
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <div class="pass-group">
                                            <textarea type="text" v-model="form.remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label> Profile Picture</label>
                                        <input class="form-control form-control-sm" id="formFileSm" type="file"
                                            @change="onFileChange">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <button type="submit" class="btn btn-submit me-2">Submit</button>
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</template>
