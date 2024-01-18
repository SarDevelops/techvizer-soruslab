@extends('layouts.back_layout')
@section('page_title', 'Settings ')
@section('page_heading', 'Manage Site Settings')
@section('Breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Manage Site Settings</li>
    <!--end::Item-->
</ul>
@endsection

@section('css')
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row grid gy-5 g-xl-8">
                <div class="grid-item col-xl-6">
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0" data-bs-toggle="collapse"
                            data-bs-target="#kt_general_settings" aria-expanded="true"
                            aria-controls="kt_general_settings">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">General Settings</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Content-->
                        <div class="card-body py-3" id="general_setting_form_section">
                            @include('backend.settings.general_settings')
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
                <div class="grid-item col-xl-6">
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0" data-bs-toggle="collapse"
                            data-bs-target="#kt_account_profile_details" aria-expanded="true"
                            aria-controls="kt_account_profile_details">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Clear cache</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Content-->
                        <div class="card-body py-3" id="clear_cache_setting_form_section">
                            <form action="{{ route('admin.cache_clear') }}" class="cache_clear" method="POST">
                                @csrf
                                <!--begin::Card body-->
                                <div class="card-footer justify-content-end p-0 pt-6">
                                    <button type="button" class="btn btn-primary submit-btn" id="kt_account_cache_btn">
                                        <x-button-indicator :label="__('Clear Cache')"></x-button-indicator>
                                    </button>

                                </div><br />
                                <label class="col-form-label">(Note : It will clear all caches like view,route,config,
                                    etc. of the application.)</label>
                                <!--end::Actions-->
                            </form>

                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('backend/js/setting/setting.js') }}"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
    $('.grid').masonry({
			itemSelector: '.grid-item'
		});
</script>
{!! JsValidator::formRequest('App\Http\Requests\backend\BackendSettingsRequest') !!}
@endsection
