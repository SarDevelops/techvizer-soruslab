<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ asset('uploads/site_logo/favicon.png') }}">
    <title>{{ config('customConfig.site.name').' | ' }} @yield('page_title')</title>
    {{-- <title>@yield('page_title', config('app.name'))</title> --}}
    <meta charset="utf-8" />
    <meta name="description" content="{{ config('customConfig.site.name') }}" />
    <meta name="keywords" content="{{ config('customConfig.site.name') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:site_name" content="{{ config('customConfig.site.name') }}" />
    <link rel="canonical" href="{{ config('app.url') }}" />
    <link rel="shortcut icon" href="{{ asset('uploads/site_logo/favicon.png') }}" />
    {{--
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> --}}
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('theme/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!--Datatable CSS -->
    <link href="{{ asset('theme/dist/assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />
    {{-- <script src="{{ asset('theme/src/js/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('theme/src/js/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('theme/src/js/jquery-validation/jquery_form.js') }}"></script> --}}

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}" defer></script>
    <!--Datatable CSS -->
    <style>
        table.dataTable a.btn-icon {
            background-color: #e5e5e5;
        }

        .form-check.form-check-solid .form-check-input {
            background-color: #e5e5e5;
        }

        .form-check.form-check-solid .form-check-input:checked {
            background-color: #134266;
        }

        .btn.btn-primary,
        .page-item.active .page-link {
            border-color: #134266;
            background-color: #134266;
        }

        .scrolltop {
            background-color: #134266;
        }

        div#action-drawer-body {
            min-width: 450px;
        }
    </style>
    @yield('css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
                    id="kt_app_header_container">
                    <!--begin::sidebar mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px"
                            id="kt_app_sidebar_mobile_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::sidebar mobile toggle-->
                    <!--begin::Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="{{ (request()->route() && request()->route()->getPrefix() == '/admin') ? route( 'admin.login') : route('login') }}"
                            class="d-lg-none">
                            <img alt="Logo" src="{{ asset('theme/src/media/logos/logo-2.svg') }}" class="h-30px" />
                        </a>
                    </div>
                    <!--end::Mobile logo-->
                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">
                        @include('layouts.backend_components.top_toolbar')
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @php
                $file_path = asset('images/default.svg');
                $file_path_minimize = asset('images/default-small.svg');
                @endphp
                @if (!empty(get_settings('site_logo')))
                @php
                $file_path = File::exists(public_path().'/uploads/site_logo/'. get_settings('site_logo')) == true ?
                asset('uploads/site_logo').'/' . get_settings('site_logo') : asset('images/default.svg');
                $file_path_minimize = File::exists(public_path().'/uploads/site_logo/'. get_settings('site_logo')) ==
                true ? asset('uploads/site_logo').'/' . get_settings('site_logo') : asset('images/default-small.svg');
                @endphp
                @endif
                <!--begin::Sidebar-->
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
                    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    <!--begin::Logo-->
                    <div class="px-6 app-sidebar-logo" id="kt_app_sidebar_logo">
                        <!--begin::Logo image-->
                        @if(request()->route() && request()->route()->getPrefix() == '/admin')
                        <a href="{{ route( 'admin.login') }}">
                            <img alt="Logo" src="{{$file_path}}" class="h-25px app-sidebar-logo-default" />
                            <img alt="Logo" src="{{$file_path_minimize}}" class="h-20px app-sidebar-logo-minimize" />
                        </a>
                        @else
                        <a href="{{ route( 'admin.login') }}">
                            <img alt="Logo" src="{{$file_path}}" class="h-25px app-sidebar-logo-default" />
                            <img alt="Logo" src="{{$file_path_minimize}}" class="h-20px app-sidebar-logo-minimize" />
                        </a>
                        @endif
                        <!--end::Logo image-->
                        <!--begin::Sidebar toggle-->
                        <div id="kt_app_sidebar_toggle"
                            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
                            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                            data-kt-toggle-name="app-sidebar-minimize">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                            <span class="rotate-180 svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5"
                                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                        fill="currentColor" />
                                    <path
                                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Sidebar toggle-->
                    </div>
                    <!--end::Logo-->
                    <!--begin::sidebar menu-->
                    <div class="overflow-hidden app-sidebar-menu flex-column-fluid">
                        <!--begin::Menu wrapper-->
                        <div id="kt_app_sidebar_menu_wrapper" class="my-5 app-sidebar-wrapper hover-scroll-overlay-y"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                            data-kt-scroll-save-state="true">
                            <!--begin::Menu-->
                            @include('layouts.backend_components.side_menu')
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::sidebar menu-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="flex-wrap page-title d-flex flex-column justify-content-center me-3 w-100">
                                    <!--begin::Title-->
                                    <h1
                                        class="my-0 page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center">
                                        @yield('page_heading')</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    @yield('Breadcrumb')
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                @yield('content')
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        <div
                            class="py-3 app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack">
                            <!--begin::Copyright-->
                            <div class="order-2 text-dark order-md-1">
                                <span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
                                <a href="javascript:void(0)" target="_blank" class="text-gray-800 text-hover-primary">{{
                                    config('customConfig.site.name') }}</a>
                            </div>
                            <!--end::Copyright-->
                        </div>
                        <!--end::Footer container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Drawers-->
    <!--begin::Activities drawer-->
    <div id="action_drawer" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities"
        data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close"
        data-kt-drawer-width="{ default:'100%', 'sm': '100%', 'md': '100%', 'lg': '90%', 'xl': '83%' }">
        <div class="border-0 shadow-none card rounded-0 w-100">
            <!--begin::Header-->
            <div class="card-header" id="kt_activities_header">
                <h3 class="card-title fw-bold text-dark action-drawer-header">Action Drawer</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5"
                        id="kt_activities_close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body position-relative" id="action-drawer-body">

            </div>
            <!--end::Body-->

        </div>
    </div>
    <!--end::Activities drawer-->
    <!--end::Drawers-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="currentColor" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('theme/dist/assets/') }}";
			var adminUrl = "{{ url('admin') }}";

			function toast_message(type = '',message = '',title = '', is_refresh_datatable = 0, datatable_object = '', is_redirect = 0, redirect_url = ''){
			  	toastr.options =
	          	{
		            "closeButton" : true,
		            "progressBar" : true
	          	}

	          	if (is_redirect == 0) {
		          	if(type == 'success'){
		          		title = title != '' ? title : 'Success!';
		          		toastr.success(message,title);
		          	}else if(type == 'error'){
		          		title = title != '' ? title : 'Oh snap!';
		          		toastr.error(message,title);
		          	}else if(type == 'info'){
		          		title = title != '' ? title : 'Info!';
		          		toastr.info(message,title);
		          	}else{
		          		title = title != '' ? title : 'Warning!';
		          		toastr.warning(message,title);
		          	}
	          	}

	          	if (is_refresh_datatable == 1) {
	                datatable_object.DataTable().ajax.reload(null, false);
	            } else {
	                if (is_redirect == 1) {
	                    window.location.href = redirect_url;
	                }
	            }
			}
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <link href="{{ asset('theme/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('theme/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('theme/dist/assets/js/scripts.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script src="{{ asset('js/common.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <script src="{{ asset('theme/dist/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    <!--Datatable JS -->
    <script src="{{ asset('theme/dist/assets/plugins/custom/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/dist/assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/dist/assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <!--Datatable JS -->

    <!--Laravel JS validation -->
    <script src="{{ asset('theme/src/js/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('theme/src/js/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('theme/src/js/jquery-validation/jquery_form.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}" defer></script>
    @yield('script')
    <script>
        // $(document).ready(function(){
			// 	$('#status-filter, #role-filter').on('select2:unselecting', function (e) {
			// 		// Prevent the dropdown from opening when an option is deselected
			// 		e.preventDefault();
			// 		$(this).val(null).trigger('change');
			// 	});
			// });


			$(document).ready(function(){
				$('#status-filter,.open-category-form, #role-filter').on('select2:unselecting', function (e) {
					// Prevent the dropdown from opening when an option is deselected
					e.preventDefault();
					$(this).val(null).trigger('change');
					setTimeout(() => {
						$(this).find('option:selected').prop('selected', false);
					}, 500);
				});
			});


    </script>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
