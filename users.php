<?php
include "./components/header.php";
?>

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">

        <?php include "./components/top-navbar.php"; ?>

        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">

            <?php include "./components/side-navbar.php"; ?>

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-1 flex-column justify-content-center my-0">
                                    Users
                                </h1>
                            </div>
                        </div>
                    </div>
                    
                    <div id="kt_app_content" class="app-content  flex-column-fluid ">
                        <div id="kt_app_content_container" class="app-container  container-xxl ">
                            <div class="card">
                                <div class="card-header border-0 pt-6">
                                    <!--Search-->
                                    <div class="card-title">
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <input type="text"
                                                data-kt-customer-table-filter="search"
                                                class="form-control form-control-solid w-250px ps-12"
                                                placeholder="Search Users"
                                            />
                                        </div>
                                    </div>

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                            <button type="button" class="btn btn-light-danger me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="ki-duotone ki-filter fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>        Filter
                                            </button>
                                            
                                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                                <div class="px-7 py-5">
                                                    <div class="fs-4 text-gray-900 fw-bold">Filter Options</div>
                                                </div>

                                                <div class="separator border-gray-200"></div>

                                                <div class="px-7 py-5">
                                                    <div class="mb-10">
                                                        <label class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                                            <option></option>
                                                            <option value="jan">January</option>
                                                            <option value="feb">February</option>
                                                            <option value="mar">March</option>
                                                            <option value="apr">April</option>
                                                            <option value="may">May</option>
                                                            <option value="jun">June</option>
                                                            <option value="jul">July</option>
                                                            <option value="aug">August</option>
                                                            <option value="sep">September</option>
                                                            <option value="oct">October</option>
                                                            <option value="nov">November</option>
                                                            <option value="dec">December</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="mb-10">
                                                        <label class="form-label fs-5 fw-semibold mb-3">Designation:</label>
                                                        <div class="d-flex flex-column flex-wrap fw-semibold" data-kt-customer-table-filter="payment_type">
                                                            <!--begin::Option-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                                <input class="form-check-input" type="radio" name="payment_type" value="all" checked="checked" />
                                                                <span class="form-check-label text-gray-600">
                                                                    All
                                                                </span>
                                                            </label>
                                                            
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                                <input class="form-check-input" type="radio" name="payment_type" value="visa" />
                                                                <span class="form-check-label text-gray-600">
                                                                    Visa
                                                                </span>
                                                            </label>
                                                            
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                                <input class="form-check-input" type="radio" name="payment_type" value="mastercard" />
                                                                <span class="form-check-label text-gray-600">
                                                                    Mastercard
                                                                </span>
                                                            </label>
                                                            
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="radio" name="payment_type" value="american_express" />
                                                                <span class="form-check-label text-gray-600">
                                                                    American Express
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>

                                                        <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                                Add New User
                                            </button>
                                        </div>

                                        <!--begin::Group actions-->
                                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                                            <div class="fw-bold me-5">
                                                <span class="me-2" data-kt-customer-table-select="selected_count"></span> Selected
                                            </div>

                                            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">
                                                Delete Selected
                                            </button>
                                        </div>
                                        <!--end::Group actions-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">

                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                                    </div>
                                                </th>
                                                <th class="min-w-125px">Customer Name</th>
                                                <th class="min-w-125px">Email</th>
                                                <th class="min-w-125px">Company</th>
                                                <th class="min-w-125px">Payment Method</th>
                                                <th class="min-w-125px">Created Date</th>
                                                <th class="text-end min-w-70px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="view.html" class="text-gray-800 text-hover-danger mb-1">Emma Smith</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-danger mb-1">smith@kpmg.com</a>
                                                </td>
                                                <td>
                                                    - </td>
                                                <td data-filter="mastercard">
                                                    <img src="" class="w-35px me-3" alt="" /> **** 4266 </td>
                                                <td>
                                                    14 Dec 2020, 8:43 pm </td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-danger" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>         
                                                    </a>

                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <div class="menu-item px-3">
                                                            <a href="view.html" class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<?php 
include "./modals/new_user.php";
include "./components/footer.php";
?>