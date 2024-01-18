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
<header>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="/">
                <img src="{{ $file_path }}" alt="" height="
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="pl-0 ml-auto navbar-nav">
                    <a class="nav-link {{ \Request::route()->getName()  == 'frontend.home.index' ? 'active':'' }}" href="{{ route('frontend.home.index') }}">Home</a>
                    <a class="nav-link {{ \Request::route()->getName()  == 'frontend.about_us.index' ? 'active':'' }}" href="{{ route('frontend.about_us.index') }}">About us</a>
                    <a class="nav-link {{ \Request::route()->getName()  == 'frontend.test_menu.index' ? 'active':'' }}" href="{{ route('frontend.test_menu.index') }}">Test Menu</a>
                    <a class="nav-link {{ \Request::route()->getName()  == 'frontend.doctors.index' ? 'active':'' }}" href="{{ route('frontend.doctors.index') }}">Doctor</a>
                    <a class="nav-link {{ \Request::route()->getName()  == 'frontend.hospitals.index' ? 'active':'' }}" href="{{ route('frontend.hospitals.index') }}">Hospital</a>
                </ul>
                <ul class="ml-auto navbar-nav">
                    <li class="nav-item cta-btn">
                        <img src="{{ asset('frontend/images/header-call.png') }}">
                        <div class="inquiry">
                            <p>For inquiry</p>
                            <h4>80880 80200</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
