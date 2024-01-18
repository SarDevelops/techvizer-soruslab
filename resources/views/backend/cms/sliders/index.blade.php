@extends('layouts.back_layout')
@section('page_title', 'Pages')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-dark">
                            <a href="{{ route('admin.dashboard') }}" class="text-dark text-hover-primary"> {{__('Dashboard')}} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> {{__('Pages')}} </li>
                    </ul>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">{{__('Pages')}}:</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form method="POST" action="{{route('admin.pages.update')}}" novalidate="novalidate" class="tearms"
                                id="pages_terms_form" enctype="multipart/form-data" data-view="tearms">
                        @csrf
                            <!--start::Menu-->
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">{{__('About Us')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">{{__('Blog')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">{{__('Privacy Policy')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4">{{__('Term & Conditions')}}</a>
                                </li>
                            </ul>
                            <!--end::Menu-->
                            <!--start::Menu Content-->
                            <div class="tab-content" id="myTabContent">
    							{{-- About Us section --}}
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <h3> {{__('About Us')}} </h3>
                                        {{-- <input type="hidden" name="about_us" value="about-us"> --}}
                                        <textarea name="about_us" class="kt_ckeditor_classic form-control form-control-solid" id="about_us"  >{{ config('customConfig.pages.about_us') }}</textarea>
                                </div>
    							{{-- /About Us section --}}

    							{{-- Blog section --}}
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    <h3> {{__('Blog')}} </h3>
                                    <textarea name="blog" class="kt_ckeditor_classic form-control form-control-solid" id="blog"  >{{ config('customConfig.pages.blog') }}</textarea>
                                </div>
    							{{-- /Blog section --}}

    							{{-- Pricacy policy section --}}
                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                    <h3> {{__('Privacy Policy')}} </h3>
                                    <div class="tab-pane" id="privacy-policy">
    										<textarea name="privacy_policy" class="kt_ckeditor_classic form-control form-control-solid" id="privacy_policy"  >{{ config('customConfig.pages.privacy_policy') }}</textarea>
                                    </div>
                                </div>
    							{{-- /Pricacy policy section --}}

    							{{-- T&C section --}}
                                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                    <h3> {{__('Term & Conditions')}} </h3>
                                        <textarea name="terms" class="kt_ckeditor_classic form-control form-control-solid" id="terms"  >{{ config('customConfig.pages.terms') }}</textarea>
                                </div>
    							{{-- /T&C section --}}
                            </div>
                            <!--end::Menu Content-->

                            {{-- <div class="mt-2 col-md-12 text-end"> --}}
                            <div class="card-footer d-flex justify-content-end p-0 pt-6">
                                <button type="reset" class="btn btn-light me-2" title="{{__('Back')}}" data-bs-toggle="tooltip" data-bs-dismiss="click">
                                        <a href="{{URL::previous()}}"> {{__('Back')}} </a>
                                </button>
                                <button type="submit" class="btn btn-primary submit-btn" id="kt_pages_submit" title="{{__('Save Changes')}}" data-bs-toggle="tooltip" data-bs-dismiss="click">
                                        <x-button-indicator :label="__('Save Changes')"></x-button-indicator>
                                    </button>
                            </div>

                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')

    <!--Laravel JS validation -->
    <script src="{{ asset('theme/src/js/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('theme/src/js/jquery-validation/jquery_form.js') }}"></script>
    <script src="{{ asset('theme/src/js/jquery-validation/additional-methods.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('theme/src/js/jsvalidation/jsvalidation.js') }}"> </script> --}}
    <!--Laravel JS validation -->
    {{-- <script src="{{ asset('theme/dist/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/admin_panel/pages/pages.js') }}"></script>
    <script>

        // var allEditors = document.querySelectorAll('.kt_ckeditor_classic');
        // for (var i = 1; i < allEditors.length; ++i) {
        //     ClassicEditor.create(allEditors[i]);
        // }
    </script>
	{{-- {!! JsValidator::formRequest('App\Http\Requests\Admin\AdminSettingRequest') !!} --}}
@endsection
