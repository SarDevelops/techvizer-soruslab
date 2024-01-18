@extends('layouts.back_layout')
@section('page_title', 'Home Page')

@section('css')
<link href="{{ asset('theme/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="flex-wrap mb-5 page-title d-flex align-items-center me-3 mb-lg-0">
                <!--begin::Title-->
                <ul class="my-1 breadcrumb breadcrumb-separatorless fw-bold fs-7">
                    <li class="breadcrumb-item text-dark">
                        <a href="{{ route('admin.dashboard') }}" class="text-dark text-hover-primary">
                            {{ __('Dashboard') }} </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bg-gray-200 bullet w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> {{ __('Home Page') }} </li>
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
            <div class="mb-5 card mb-xl-10">
                <!--begin::Card header-->
                <div class="border-0 cursor-pointer card-header" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="m-0 card-title">
                        <h1 class="m-0 fw-bolder">{{ __('Home Page Sections') }}:</h>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card body-->
                {{-- Section 1 --}}
                <div class="tab-content">
                    <div class="tab-pane active" id="colored-rounded-tab1">
                        <form enctype="multipart/form-data" id="sectionOne" method="post" autocomplete="off"
                            action="{{ route('admin.pages.store_cms') }}">
                            @csrf
                            <input type="text" hidden value="home" name="page_name">
                            <input type="text" hidden value="slider" name="slug">
                            <input type="text" hidden value="sliders" name="sliders">
                            <div id="section_1">
                                <div class="px-5 mb-3 row">
                                    <div class="px-5 col-sm-12">
                                        <h3 class="container px-0 text-gray-400">Slider</h3>
                                        <hr>
                                    </div>
                                </div>
                                <div class="repeater_slider">
                                    <div data-repeater-list="sliders" class="group-a">
                                        @if (@$cms_data->section != null)
                                            @php
                                            $sliders = json_decode($cms_data->section);
                                            $count = 0;
                                            @endphp

                                            @foreach (@$sliders as $key => $slider)
                                            @if ($slider)
                                            @php
                                                $count = $count + 1;
                                                $section_key = 's1_' . $count;
                                            @endphp
                                            <div data-repeater-item="">
                                                <div class="px-5 col-sm-12">
                                                    <div class="px-3 row">
                                                        <div class="mb-4 col-md-6">
                                                            <div class="form-outline section">
                                                                <label class="h4 form-label" for="slider_image">Slider
                                                                    one
                                                                    choose
                                                                    image<small class="req text-danger">*</small></label>
                                                                <input type="file" id="image_preview"
                                                                    value="{{ asset('uploads/sliders').'/'.$slider }}"
                                                                    name="slider_image"
                                                                    class="form-control form-control-lg">
                                                                    @error('slider_image')
                                                                            <div class="error alert alert-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                    @enderror
                                                                    <input type="text" hidden
                                                                            value="{{ $slider }}"
                                                                            name="hidden_image">

                                                                <label
                                                                    class="col-form-label label_text text-lg-right ">Slider
                                                                    Image<small class="req text-danger">*</small></label>
                                                                <div id="feature_img_show" class="mr-t-5">
                                                                    <div
                                                                        class="px-0 image_uploader position-relative col-md-9">
                                                                        <img class="img-fluid preview-image"
                                                                            src="{{ asset('uploads/sliders').'/'.$slider }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-5 pb-4 col-sm-12">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                            <span class="glyphicon glyphicon-remove"></span> Delete
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        @endforeach
                                        @else
                                        <div data-repeater-item="">
                                            <div class="px-5 col-sm-12">
                                                <div class="px-3 row">
                                                    <div class="mb-4 col-md-6">
                                                        <div class="form-outline section">
                                                            <label class="h4 form-label" for="slider_image">Slider one
                                                                choose
                                                                image<small class="req text-danger">*</small></label>
                                                            <input type="file" id="image_preview" value=""
                                                                name="slider_image"
                                                                class="form-control form-control-lg">
                                                            <input type="text" hidden value="slider" name="slug">
                                                            <label
                                                                class="col-form-label label_text text-lg-right ">Slider
                                                                Image<small class="req text-danger">*</small></label>
                                                            <div id="feature_img_show" class="mr-t-5">
                                                                <div
                                                                    class="px-0 image_uploader position-relative col-md-9">
                                                                    <img class="img-fluid preview-image"
                                                                        src="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="px-5 pb-4 col-sm-12">
                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                        <span class="glyphicon glyphicon-remove"></span> Delete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="px-5 mb-3 row">
                                        <div class="px-5 col-sm-12">
                                            <span data-repeater-create="" class="btn btn-info btn-md">
                                                <span class="glyphicon glyphicon-plus"></span> Add sliders
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5 col-sm-12">
                                    <div class="gap-2 d-grid d-md-flex justify-content-md-end">
                                        <button type="submit" class="float-right btn btn-primary">save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End Section 1 --}}
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const firstErrorField = document.querySelector('.error');
            if (firstErrorField) {
                firstErrorField.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
</script>
<script type="text/javascript">
    var home_page_route = "{{ route('admin.pages.home_page') }}";
        var submit_action = "{{ route('admin.pages.store_cms') }}"
</script>

<script src="{{ asset('theme/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
    integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/repeter_section.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/slider.js') }}"></script>
@endsection
