@extends('layouts.back_layout')
@section('page_title', 'My Profile')
@section('page_heading', 'My Profile')
@section('Breadcrumb')

<ul class="pt-1 my-0 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bg-gray-400 bullet w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">My Profile</li>
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
            <div class="mb-5 card mb-xl-10" id="profile_detail_section">
                @include('backend.profiles.profile_details')
            </div>
            <div class="mb-5 card mb-xl-10">
                <div class="border-0 cursor-pointer card-header" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <div class="m-0 card-title">
                        <h3 class="m-0 fw-bolder">Update Profile</h3>
                    </div>
                </div>
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <form id="kt_account_profile_details_form" class="form" method="POST"
                        action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body border-top p-9">
                            <div class="mb-6 row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Profile picture</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url( {{ ($admin->profile == NULL) ? asset('theme/dist/assets/media/avatars/default_user.png') : asset('uploads/user_profile').'/'.$admin->profile }})">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ ($admin->profile == NULL) ? asset('theme/dist/assets/media/avatars/default_user.png') : asset('uploads/user_profile').'/'.$admin->profile}})">
                                        </div>
                                        <label
                                            class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change profile">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="profile" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_remove" />
                                        </label>
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">{{'Allowed file types: png, jpg, jpeg.'}}</div>
                                    <!--end::Hint-->
                                </div>
                            </div>
                            <div class="mb-6 row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="first_name"
                                                class="mb-3 form-control form-control-lg form-control-solid mb-lg-0"
                                                placeholder="First name" value="{{ $admin->first_name }}" required="" />
                                        </div>
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="last_name"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Last name" value="{{ $admin->last_name }}" required="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-6 card-footer d-flex justify-content-end px-9">
                            <button type="submit" class="btn btn-primary submit-btn"
                                id="kt_account_profile_details_submit">
                                <x-button-indicator :label="__('Save Changes')"></x-button-indicator>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mb-5 card mb-xl-10">
                <div class="border-0 cursor-pointer card-header" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
                    <div class="m-0 card-title">
                        <h3 class="m-0 fw-bolder">Change Password</h3>
                    </div>
                </div>
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="flex-wrap mb-10 d-flex align-items-center">
                            <div id="kt_signin_password">
                                <div class="mb-1 fs-6 fw-bolder">Password</div>
                                <div class="text-gray-600 fw-bold">************</div>
                            </div>
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <form id="kt_signin_change_password" class="form" method="POST"
                                    action="{{ route('admin.change_password') }}">
                                    @csrf
                                    <div class="mb-1 row">
                                        <div class="col-lg-4">
                                            <div class="mb-0 fv-row">
                                                <label for="current_password"
                                                    class="mb-3 form-label fs-6 fw-bolder required">Current
                                                    Password</label>
                                                <div class="password_control position-relative w-100">
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="current_password" id="current_password" />
                                                    <a href="javascript:void(0)" class="check_eye_open" hidden>
                                                        <i class="fa-solid fa-eye fa-sm"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="check_eye_close">
                                                        <i class="fa-solid fa-eye-slash fa-sm"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-0 fv-row">
                                                <label for="password"
                                                    class="mb-3 form-label fs-6 fw-bolder required">New Password</label>
                                                <div class="password_control position-relative w-100">
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="new_password" id="new_password" />
                                                    <a href="javascript:void(0)" class="check_eye_open" hidden>
                                                        <i class="fa-solid fa-eye fa-sm"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="check_eye_close">
                                                        <i class="fa-solid fa-eye-slash fa-sm"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-0 fv-row">
                                                <label for="password_confirmation"
                                                    class="mb-3 form-label fs-6 fw-bolder required">Confirm New
                                                    Password</label>
                                                <div class="password_control position-relative w-100">
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="password_confirmation" id="password_confirmation" />
                                                    <a href="javascript:void(0)" class="check_eye_open" hidden>
                                                        <i class="fa-solid fa-eye fa-sm"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="check_eye_close">
                                                        <i class="fa-solid fa-eye-slash fa-sm"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-5 form-text">Password must contain one uppercase, lowercase, number
                                        and special character from @#$%&</div>
                                    <div class="d-flex">
                                        <button id="kt_password_submit" type="button"
                                            class="px-6 btn btn-primary me-2">Update Password</button>
                                        <button id="kt_password_cancel" type="button"
                                            class="px-6 btn btn-color-gray-400 btn-active-light-primary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Sign-in Method-->
        </div>
    </div>
    <!--end::Post-->
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('backend/js/profile/profile.js') }}"></script>
// {!! JsValidator::formRequest('App\Http\Requests\backend\AdminProfileRequest', '#kt_account_profile_details_form') !!}
// {!! JsValidator::formRequest('App\Http\Requests\backend\ChangePasswordRequest', '#kt_signin_change_password') !!}
@endsection
