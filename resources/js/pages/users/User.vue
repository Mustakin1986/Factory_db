<script setup>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router';
import { useToastr } from '../../toastr';
import { Form } from 'vee-validate';

const router = useRouter();
const toastr = useToastr();
const route = useRoute();
const form = reactive({
    name: '',
    tel: '',
    email: '',
    password: '',

});

const handleSubmit = (values, actions) => {
    if (editMode.value) {
        EditUser(values, actions)
    } else {
        createUser(values, actions);
    }
};

const createUser = (values, actions) => {
    axios.post('/api/users/create', form)
        .then((response) => {
            router.push('/admin/user_lists');
            toastr.success('User Created Successfully');
        })
        .catch((error) => {
            actions.setErrors(error.response.data.errors);
        })
};

const EditUser = (values, actions) => {
    axios.put(`/api/users/${route.params.id}/edit`, form)
        .then((response) => {
            router.push('/admin/user_lists');
            toastr.success('User Updated Successfully');
        })
        .catch((error) => {
            actions.setErrors(error.response.data.errors);
        });
};

const getUser = () => {
    axios.get(`/api/users/${route.params.id}/edit`)
        .then((response) => {
            form.name = response.data.name;
            form.tel = response.data.tel;
            form.email = response.data.email;
            form.password = response.data.password;
        })
}

const editMode = ref(false);

onMounted(() => {
    if (route.name === 'EditUser') {
        editMode.value = true;
        getUser();
    }
});
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User Management</h4>
                    <h6><span v-if="editMode">Edit</span>
                        <span v-else>Add</span>
                        User
                    </h6>
                </div>
            </div>

            <div class="card d-flex">
                <div class="card-body">
                    <div class="row">
                        <Form @submit="handleSubmit" v-slot:default="{ errors }">
                            <div class="col-lg-3 col-sm-6 col-12 ">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input v-model="form.name" type="text" :class="{ 'is-invalid': errors.name }">
                                    <span class="invalid-feedback">{{ errors.name }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input v-model="form.tel" type="text" :class="{ 'is-invalid': errors.tel }">
                                    <span class="invalid-feedback">{{ errors.tel }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input v-model="form.email" type="text" :class="{ 'is-invalid': errors.email }">
                                    <span class="invalid-feedback">{{ errors.email }}</span>
                                </div>

                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 ">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input v-model="form.password" type="password" class=" pass-input"
                                            :class="{ 'is-invalid': errors.password }">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                        <span class="invalid-feedback">{{ errors.password }}</span>

                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-inputs">
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-select">
                                        <option>Select</option>
                                        <option>Role</option>
                                        <option>Role1</option>
                                    </select>
                                </div> -->

                            </div>
                            <!-- <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label> Profile Picture</label>
                                    <div class="image-upload image-upload-new">
                                        <input type="file">
                                        <div class="image-uploads">
                                            <img src="assets/img/icons/upload.svg" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
