<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useToastr } from '../../toastr';

const router = useRouter();
const toastr = useToastr();
const form = reactive({
    name: '',
    description: '',
    photo: null, // Initialize photo as null
});

const handleSubmit = () => {
    // Create a FormData object to handle file upload
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('description', form.description);
    formData.append('photo', form.photo);

    axios.post('/api/brands/create', formData)
        .then((response) => {
            router.push('/admin/brandList');
            toastr.success('Brand Created Successfully');
        })
        .catch((error) => {
            // Handle the error, for example, by displaying an error toastr message.
            toastr.error('An error occurred while creating the brand');
        });
};

const onFileChange = (event) => {
    form.photo = event.target.files[0];
};
</script>


<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Brand</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="$event => handleSubmit()" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Brand Name</label>
                                    <input type="text" v-model="form.name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" v-model="form.description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label> Product Image</label>
                                    <div class="image-upload">
                                        <input type="file" @change="onFileChange">
                                        <div class="image-uploads">
                                            <img src="assets/img/icons/upload.svg" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
