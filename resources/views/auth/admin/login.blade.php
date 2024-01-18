@extends('layouts.auth')

@section('css')
@endsection

@section('content')
<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('admin.login') }}">
    @csrf

    <input type="hidden" id="is_administrator" name="is_administrator" value="1">

    <!--begin::Heading-->
    <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">Sign In to {{ config('app.name') }}</h1>
        <!--end::Title-->
        <!--begin::Link-->
        {{-- <div class="text-gray-400 fw-bold fs-4">New Here?
            @if(request()->route()->getPrefix())
            <a href="{{ route( trim( request()->route()->getPrefix(), '/') .'.register') }}"
                class="link-primary fw-bolder">Create an Account</a>
            @else
            <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a>
            @endif
        </div> --}}
        <!--end::Link-->
    </div>

    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input class="form-control form-control-lg form-control-solid" type="email" name="email"
            value="{{ old('email') }}" autofocus autocomplete="new-email" />
        <!--end::Input-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-2">
            <!--begin::Label-->
            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
            <!--end::Label-->
            <!--begin::Link-->
            @if(str_contains(request()->route()->getPrefix(), 'admin'))
            <a href="{{ route( 'admin.password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
            @else
            <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
            @endif
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Input-->
        <input class="form-control form-control-lg form-control-solid" type="password" name="password"
            autocomplete="new-password" />
        <!--end::Input-->
    </div>
    <div class="fv-row mb-10 fv-plugins-icon-container">
        <label class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="remember" value="1">
            <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Remember Me</span>
        </label>
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center">
        <!--begin::Submit button-->
        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5 submit-btn">
            <span class="indicator-label">Continue</span>
            <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <!--end::Submit button-->
        <!--begin::Separator-->
        {{-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
        <!--end::Separator-->
        <!--begin::Google link-->
        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="{{ asset('theme/dist/assets/media/svg/brand-logos/google-icon.svg') }}"
                class="h-20px me-3" />Continue with Google</a>
        <!--end::Google link-->
        <!--begin::Google link-->
        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="{{ asset('theme/dist/assets/media/svg/brand-logos/facebook-4.svg') }}"
                class="h-20px me-3" />Continue with Facebook</a>
        <!--end::Google link-->
        <!--begin::Google link-->
        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
            <img alt="Logo" src="{{ asset('theme/dist/assets/media/svg/brand-logos/apple-black.svg') }}"
                class="h-20px me-3" />Continue with Apple</a> --}}
        <!--end::Google link-->
    </div>
    <!--end::Actions-->
</form>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/auth/login.js') }}"></script>
@endsection