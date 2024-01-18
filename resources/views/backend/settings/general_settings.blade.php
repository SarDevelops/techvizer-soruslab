@section('page_title', 'Manage Site Setting')
<form action="{{ route('admin.settings.update') }}" method="POST" novalidate="novalidate"
    class="general_settings_form form" id="general_settings_form" enctype="multipart/form-data"
    data-view="general_settings">
    @csrf
    <input type="hidden" name="view_name" id="general_settings" value="general_settings" />
    <div class="card-body border-top p-9">
        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label fw-bold fs-6">Site logo</label>
            <div class="col-lg-8">
                @php
                $file_path = File::exists(public_path('/uploads/site_logo/'. get_settings('site_logo'))) == true ?
                asset('uploads/site_logo').'/' . get_settings('site_logo') : asset('images/default.svg');
                @endphp
                <div class="image-input image-input-outline" data-kt-image-input="true"
                    style="{{config('customConfig.site.logo') == " " ? url(asset('uploads/site_logo/'.config('customConfig.site.logo'))) : " "}}">
                    <div class="image-input-wrapper w-125px h-125px" data-img="{{$file_path}}"
                        style="background-image:url({{$file_path}})">
                    </div>
                    <label class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change site logo">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <input type="file" name="site_logo" id="site_logo" />
                        <input type="hidden" name="site_logo_exist"
                            value="{{ config('customConfig.site.logo') == null ? 0 : 1}}" />
                    </label>
                    <span class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel site logo"> <i
                            class="bi bi-x fs-2"></i>
                    </span>
                </div>
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                <div id="site_logo-error" class="validation-error-label invalid-feedback"></div>
            </div>
        </div>
        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Site name</label>
            <div class="col-lg-8">
                <input type="text" name="site_name" class="mb-3 form-control form-control-lg form-control-solid mb-lg-0"
                    placeholder="Site name" value="{{ config('customConfig.site.name') }}" />
            </div>
        </div>

    <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Site email</label>
            <div class="col-lg-8">
                <input type="text" name="site_email" class="form-control form-control-lg form-control-solid"
                    placeholder="Site email" value="{{ config('customConfig.site.email') }}" />
            </div>
        </div>

        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Site contact</label>
            <div class="col-lg-8">
                <input type="text" name="site_contact" class="form-control form-control-lg form-control-solid"
                    placeholder="Site contact" value="{{ config('customConfig.site.contact') }}" />
            </div>
        </div>

        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Site address</label>
            <div class="col-lg-8">
                <textarea class="form-control form-control-solid" rows="3" name="site_address"
                    placeholder="Site address">{{ config('customConfig.site.address') }}</textarea>
            </div>
        </div>

        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Admin name</label>
            <div class="col-lg-8">
                <input type="text" name="admin_name" class="form-control form-control-lg form-control-solid"
                    placeholder="Admin name" value="{{ config('customConfig.admin.name') }}" />
            </div>
        </div>

        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Admin email</label>
            <div class="col-lg-8">
                <input type="text" name="admin_email" class="form-control form-control-lg form-control-solid"
                    placeholder="Admin email" value="{{ config('customConfig.admin.email') }}" />
            </div>
        </div>

        <div class="mb-6 row">
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Admin contact</label>
            <div class="col-lg-8">
                <input type="text" name="admin_contact" class="form-control form-control-lg form-control-solid"
                    placeholder="Admin contact" value="{{ config('customConfig.admin.contact') }}" />
            </div>
        </div>
        <div class="p-0 pt-6 card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary submit-btn" id="kt_account_general_settings_submit">
                <x-button-indicator :label="__('Save Changes')"></x-button-indicator>
            </button>
        </div>
    </div>
</form>
