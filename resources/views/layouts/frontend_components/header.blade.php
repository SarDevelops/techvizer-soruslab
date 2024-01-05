<header>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="/">
                logo
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav ml-auto pl-0">
                    {{--
                    <?php echo $page == 'home' ? 'active' : ''; ?>" --}}
                    <a class="nav-link " href="{{ route('frontend.home.index') }}">Home</a>
                    <a class="nav-link " href="{{ route('frontend.about_us.index') }}">About us</a>
                    <a class="nav-link " href="/our-testmenu">Test Menu</a>
                    <a class="nav-link " href="{{ route('frontend.doctors.index') }}">Doctor</a>
                    <a class="nav-link " href="{{ route('frontend.hospitals.index') }}">Hospital</a>
                </ul>
                <ul class="navbar-nav ml-auto">
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