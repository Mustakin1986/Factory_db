<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useToastr } from '../../toastr';

const router = useRouter();
const toastr = useToastr();
const form = reactive({
    name: '',
    code: '',
    description: '',
});

const handleSubmit = () => {
    axios.post('/api/categories/create', form)
        .then((response) => {
            router.push('/admin/categoryList');
            toastr.success('Category Created Successfully');
        })
        .catch((error) => {
            // Handle the error, for example, by displaying an error toastr message.
            toastr.error('An error occurred while creating the Category');
        })

};
</script>


<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Category</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="$event => handleSubmit()">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" v-model="form.name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category Code</label>
                                    <input type="text" v-model="form.code">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" v-model="form.description"></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12">
                            <div class="form-group">
                                <label> Product Image</label>
                                <div class="image-upload">
                                    <input type="file">
                                    <div class="image-uploads">
                                        <img src="assets/img/icons/upload.svg" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2">Submit</button>
                                <!-- <a href="" class="btn btn-submit me-2">Submit</a> -->
                                <a href="categorylist.html" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</template>
