<!--begin::Header-->
<div id="kt_app_header" class="app-header">
    <!--begin::Header container-->
    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
            <a href="../../demo1/dist/index.html">
                <img alt="Logo" src="/metronic/media/logos/default-dark.svg"
                    class="h-20px h-lg-30px app-sidebar-logo-default" />
            </a>
        </div>
        <!--end::Logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <a href="{{ route('home') }}" class="menu-link {{ request()->is('/') ? 'active' : '' }}">
                            <span class="menu-title">Home</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <div class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <a href="{{ route('sambutan') }}"
                            class="menu-link {{ Route::currentRouteName() == 'sambutan' ? 'active' : '' }}">
                            <span class="menu-title">Sambutan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-3">
                    <!--begin::Menu wrapper-->
                    <a href="{{ route('auth.signin') }}" class="menu-link">
                        <span class="menu-title btn btn-sm btn-success">Login</span>
                    </a>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->
