<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form" action="/intranet/auth/add_new_user.php" method="POST" id="kt_modal_add_user_form">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bold">Add a New User</h2>
                    
                    <div id="kt_modal_add_user_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7"
                        id="kt_modal_add_user_scroll"
                        data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                        data-kt-scroll-offset="300px">

                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">First Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="first_name" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Last Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="last_name" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">
                                    <span class="required">Email</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Email address must be active">
                                        <i class="ki-duotone ki-information fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </label>
                                <input type="email" class="form-control form-control-solid" placeholder="" name="email" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Phone</label>
                                <input class="form-control form-control-solid" placeholder="" name="phone" />
                            </div>

                            <div class="d-flex flex-column col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">
                                    <span class="required">Gender</span>
                                </label>
                                
                                <select name="gender" required aria-label="Select Gender" data-control="select2" data-placeholder="Select Gender..." data-dropdown-parent="#kt_modal_add_user" class="form-select form-select-solid fw-bold">
                                    <option value="">Select Gender...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="d-flex flex-column col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">
                                    <span class="required">Designation</span>
                                </label>
                                
                                <select name="designation" required aria-label="Select Designation" data-control="select2" data-placeholder="Select Designation..." data-dropdown-parent="#kt_modal_add_user" class="form-select form-select-solid fw-bold">
                                    <option value="">Select Designation...</option>
                                    <option>Staff</option>
                                    <option>CFO</option>
                                    <option>HOD</option>
                                    <option>Manager</option>
                                    <option>Admin</option>
                                    <option>Super-Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer flex-center">
                    <button type="reset" id="kt_modal_add_user_cancel" class="btn btn-light me-3">
                        Discard
                    </button>
                    <button type="submit" id="kt_modal_add_user_submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>