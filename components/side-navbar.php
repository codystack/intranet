<?php
$currentPage = basename($_SERVER['PHP_SELF'], ".php"); 
// e.g. "dashboard" if you’re on dashboard.php
?>

<!--begin::Sidebar-->
<div id="kt_app_sidebar"
    class="app-sidebar flex-column"
    data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="225px"
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">


    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="dashboard">
            <img alt="Logo" src="assets/media/logos/vinelogo_white.png" class="h-40px app-sidebar-logo-default" />
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate"
            data-kt-toggle="true"
            data-kt-toggle-state="active"
            data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">

            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>

    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll"
                class="hover-scroll-y my-5 mx-3"
                data-kt-scroll="true"
                data-kt-scroll-activate="true"
                data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu"
                data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold"
                    id="#kt_app_sidebar_menu"
                    data-kt-menu="true"
                    data-kt-menu-expand="false">
                    
                    <!--Dashboard-->
                    <div class="menu-item">
                        <a class="menu-link <?= ($currentPage === 'dashboard') ? 'active' : '' ?>"
                            href="dashboard">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-category fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>
                    

                    <!--Demo-->
                    <!-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-people fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Users</span>
                            <span class="menu-arrow"></span>
                        </span>
                        
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="layouts/light-sidebar.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add New User</span>
                                </a>
                            </div>
                            
                            <div class="menu-item">
                                <a class="menu-link" href="layouts/dark-sidebar.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All User</span>
                                </a>
                            </div>
                        </div>
                    </div> -->

                    <!--Users-->
                    <div class="menu-item">
                        <a class="menu-link <?= ($currentPage === 'users') ? 'active' : '' ?>" href="users">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-people fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>
                    
                    <!--Vault-->
                    <div class="menu-item">
                        <a class="menu-link <?= ($currentPage === 'dashboard') ? 'vault' : '' ?>" href="vault">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-key fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">The Vault</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::sidebar menu-->
    
    <!--Log Out-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="logout"
            class="btn btn-flex flex-center btn-danger overflow-hidden text-nowrap px-0 h-40px w-100"
            data-bs-toggle="tooltip"
            data-bs-trigger="hover"
            data-bs-dismiss-="click">

            <span class="btn-label">
                Log Out
            </span>
        </a>
    </div>

</div>
<!--end::Sidebar-->