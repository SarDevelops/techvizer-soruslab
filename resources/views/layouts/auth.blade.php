<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>@yield('page_title', config('app.name'))</title>
    <meta charset="utf-8" />
    {{--
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta name="description" content="{{ config('app.name') }}" />
    <meta name="keywords" content="{{ config('app.name') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <link rel="canonical" href="{{ config('app.url') }}" />
    <link rel="shortcut icon" href="{{ asset('theme/dist/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('theme/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @yield('css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('theme/dist/assets/media/illustrations/sketchy-1/14.png') }}">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="{{ route('admin.login') }}" class="mb-12">
                    @php
                    $file_path = asset('images/default-small.svg');
                    @endphp
                    @if (!empty(get_settings('site_logo')))
                    @php
                    $file_path = File::exists(public_path().'/uploads/site_logo/'. get_settings('site_logo')) == true ?
                    asset('uploads/site_logo').'/' . get_settings('site_logo') : asset('images/default-small.svg');
                    @endphp
                    @endif
                    {{-- <img alt="Logo" src="{{  config('customConfig.site.logo') }}" class="h-40px" /> --}}
                    <img alt="Logo" src="{{$file_path}}" class="h-40px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    @yield('content')
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    {{-- <a href="{{ route('about-us') }}" class="text-muted text-hover-primary px-2">About</a>
                    <a href="{{ route('contact-us') }}" class="text-muted text-hover-primary px-2">Contact Us</a>
                    <a href="{{ route('terms-and-condition') }}" class="text-muted text-hover-primary px-2">Terms &
                        Conditions</a>
                    <a href="{{ route('privacy-policy') }}" class="text-muted text-hover-primary px-2">Privacy
                        Policy</a> --}}
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->
    <script>
        var hostUrl = "{{ asset('theme/dist/assets/') }}";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('theme/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('theme/dist/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    {{-- <script src="{{ asset('theme/dist/assets/js/custom/authentication/sign-in/general.js') }}"></script> --}}
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script src="{{ asset('js/common.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    @yield('script')
</body>
<!--end::Body-->

</html>