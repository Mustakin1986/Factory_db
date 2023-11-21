<template>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User Management</h4>
                    <h6>Add/Update User</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class=" pass-input">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option>Select</option>
                                    <option>Role</option>
                                    <option>Role1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" class=" pass-inputs">
                                    <span class="fas toggle-passworda fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label> Profile Picture</label>

                                <input class="form-control form-control-sm" id="formFileSm" type="file">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
