@extends('layouts.front_layout')
@section('page_title', 'Home')
@section('content')
<div class="home">
    <div class="hero-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="slider-carousel owl-carousel owl-theme">
                        @if($cms[0]->slug == "slider")
                            @foreach ( json_decode($cms[0]->section) as $data)
                                @if ($data)
                                <div class="slider">
                                    <div class="pic">
                                        <img src="{{ asset('uploads/sliders').'/'.$data }}" class="w-100">
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                        {{-- <div class="slider">
                            <div class="pic">
                                <img src="{{ asset('frontend/images/slider-dummy.png') }}" class="w-100">
                            </div>
                        </div>
                        <div class="slider">
                            <div class="pic">
                                <img src="{{ asset('frontend/images/slider-dummy.png') }}" class="w-100">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="book-test">
        <div class="container">
            <div class="test-back">
                <div class="row justify-content-between">
                    <div class="txt-box">
                        <img src="{{ asset('frontend/images/person.png') }}">
                        <div class="txt-detail">
                            <h6>Need help with booking your test?</h6>
                            <p>Our experts are here to help you</p>
                        </div>
                    </div>
                    <div class="mt-4 txt-box my-md-0">
                        <img src="{{ asset('frontend/images/header-call.png') }}">
                        <h6>95866 93000</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-contact-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box">
                        <img src="{{ asset('frontend/images/contact-call.png') }}">
                        <div class="detail">
                            <p>Call</p>
                            <h5>Request Call Back</h5>
                        </div>
                    </div>
                </div>
                <div class="mt-4 col-md-4 my-md-0">
                    <div class="contact-box">
                        <img src="{{ asset('frontend/images/contact-person.png') }}">
                        <div class="detail">
                            <p>Partner</p>
                            <h5>Become Partner</h5>
                        </div>
                    </div>
                </div>
                <div class="mt-4 col-md-4 my-md-0">
                    <div class="contact-box">
                        <img src="{{ asset('frontend/images/download.png') }}">
                        <div class="detail">
                            <p>Report</p>
                            <h5>Download Report</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="txt-box">
                        <h2>Why you should<br>choose us</h2>
                        <p>When you choose us, you're choosing precision, reliability, and a commitment. Our advanced
                            technology and experienced team guarantee accurate and timely results. We focus on your
                            unique needs, providing tailored solutions and ensuring the security of your data.</p>
                        <div class="pt-4 pb-4 row justify-content-between mr-md-5">
                            <div class="count-box">
                                <h3>80</h3>
                                <h6>No of Labs</h6>
                            </div>
                            <div class="count-box">
                                <h3>28</h3>
                                <h6>No of Machines</h6>
                            </div>
                            <div class="count-box">
                                <h3>36</h3>
                                <h6>No of Certificate</h6>
                            </div>
                        </div>
                        <div class="dr-name">
                            <img src="{{ asset('frontend/images/doctor.png') }}">
                            <div class="sign">
                                <h4>Dr. Sandhya Sorathiya</h4>
                                <img src="{{ asset('frontend/images/sign.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 col-md-6 my-md-0">
                    <div class="pic">
                        <img src="{{ asset('frontend/images/about.png') }}" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="health-package">
        <div class="container">
            <div class="title">
                <h4>Popular Health Packages</h4>
            </div>
            <div class="tab-sec">
                <div class="tab-container" id="packageTab">
                    <div class="tab active" target-url="{{ route('frontend.select_package', ['id'=>0]) }}"
                        data-tab="0">All</div>
                    @foreach ($package_categories as $category)
                    <div class="tab" target-url="{{ route('frontend.select_package', ['id'=>$category->id]) }}"
                        data-tab="{{ $category->id }}">{{ $category->name }}</div>
                    @endforeach
                </div>
                <div class="tab-data-container" id="packageDataTab">
                    <div class="tab-data active" tab-data="popular">
                        <div class="lab-carousel owl-carousel owl-theme">
                            @include('frontend.packages')
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="tab-sec">
                <div class="tab-container" id="packageTab">
                    <div class="tab active" data-tab="popular">Popular Packages</div>
                    <div class="tab" data-tab="fever">Fever</div>
                    <div class="tab" data-tab="women">Women Health</div>
                    <div class="tab" data-tab="fit">Fitness</div>
                    <div class="tab" data-tab="hebit">Lifestyle habits</div>
                </div>
                <div class="tab-data-container" id="packageDataTab">
                    <div class="tab-data active" tab-data="popular">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="times-box">
                                    <p>Get Report within 18 hours</p>
                                    <h6>30% OFF</h6>
                                </div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="fever">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="women">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="fit">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="hebit">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
                                        (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
    <div class="find-test">
        <div class="container">
            <div class="title">
                <h4>Find Tests by Health Concern</h4>
            </div>
            <div class="test-carousel owl-carousel owl-theme">
                @foreach ($healths as $health)
                <div class="test-box">
                    <img src="{{ asset('uploads/health_concern').'/'.$health->image }}" class="w-100">
                    <p>{{ $health->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="top-book">
        <div class="container">
            <div class="title">
                <h4>Top Booked Diagnostic Tests</h4>
            </div>
            <div class="top-test-carousel owl-carousel owl-theme">
                @foreach ($tests as $test )

                <div class="top-box">
                    <h4>{{ $test->name }}</h4>
                    <p>Also known as Thyroid Profile Total Blood</p>
                    <h6>E reports on next day</h6>
                    <a href="{{ route('frontend.home.test_show',['id' => base64_encode($test->id)])}}"
                        target-url="{{ route('frontend.home.test_show',['id' => base64_encode($test->id)])}}"
                        data-id="{{ base64_encode($test->id) }}">+ More Details</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="testimonial">
        <div class="container">
            <div class="title">
                <h4>What people say About us?</h4>
            </div>
            <div class="review-carousel owl-carousel owl-theme">
                <div class="review">
                    <img src="{{ asset('frontend/images/review.png') }}">
                    <h5>Harsha Prajapati</h5>
                    <h6>Designer</h6>
                    <p>The staff were understanding, the process was smooth, and the results were provided promptly.</p>
                </div>
                <div class="review">
                    <img src="{{ asset('frontend/images/review.png') }}">
                    <h5>Harsha Prajapati</h5>
                    <h6>Designer</h6>
                    <p>As a patient, I value a healthcare provider that puts patients first. HCL is a reliable choice
                        for hassle-free testing.</p>
                </div>
                <div class="review">
                    <img src="{{ asset('frontend/images/review.png') }}">
                    <h5>Harsha Prajapati</h5>
                    <h6>Designer</h6>
                    <p>The care and efficiency they showed throughout my visit were commendable. Quick, professional,
                        and patient-focused.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="certificate">
        <div class="container">
            <div class="title">
                <h4>Certificate</h4>
                <p>We ensure that every certificate we hand out is top-notch and trustworthy</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="certi-box">
                        <img src="{{ asset('frontend/images/dummy-certi.png') }}" class="w-100">
                        <p>Branch Network</p>
                    </div>
                </div>
                <div class="mt-4 col-lg-4 col-md-4 my-md-0">
                    <div class="certi-box">
                        <img src="{{ asset('frontend/images/dummy-certi.png') }}" class="w-100">
                        <p>Branch Network</p>
                    </div>
                </div>
                <div class="mt-4 col-lg-4 col-md-4 my-md-0">
                    <div class="certi-box">
                        <img src="{{ asset('frontend/images/dummy-certi.png') }}" class="w-100">
                        <p>Branch Network</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="branch-sec">
        <div class="container">
            <div class="title">
                <h4>Branch Network</h4>
            </div>
            <div class="tab-sec">
                <div class="tab-container" id="labTab">
                    <div class="tab active" data-tab="all">All</div>
                    <div class="tab" data-tab="surat">Surat</div>
                    <div class="tab" data-tab="anand">Anand</div>
                    <div class="tab" data-tab="vyara">Vyara</div>
                    <div class="tab" data-tab="dhola">Dhola</div>
                </div>
                <div class="tab-data-container" id="labDataTab">
                    <div class="tab-data active" tab-data="all">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Athwalines</h5>
                                    <p>07 :00 am - 09 : 00 pm</p>
                                    <p>Mezzanine Floor, Maher Park-B, Athwa Gate, Ring Road, Surat.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Adajan</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>Ground Floor, Green Elina Complex, Anand Mahal Road, Adajan.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Sarthana jakatnaka</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>2nd Floor, Shubham Arcade, Sarthana Jakatnaka, Surat.</p>
                                    <p>Call Us:- 97273-97879</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Mota-Varachha</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>A-1/2/3, Pragati IT Park, Opp. Shell Petrol Pump, Mota Varachha, Surat.</p>
                                    <p>Call Us:- 95866-94000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images') }}/lab-store.png" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Kargil Chowk</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>158, First Floor, Shivshakti Society, Punagam, Surat.</p>
                                    <p>Call Us:- 95866-63000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Kamrej</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>B-16, Basement Floor, Dharam Empire, Opp. ST Bus Stop, Below HDFC Bank,
                                        Surat-Kamrej Road, Kamrej Char Rasta, Surat.</p>
                                    <p>Call Us:- 76001-25436</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Katargam</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>131/132, Laxmi Enclave 2, Opp. Gajera School, Katargam.</p>
                                    <p>Call Us:- 95866-95000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Station</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>G-3/4, Ground Floor, Param Doctor House, Lal Darwaja, Station Road, Surat.</p>
                                    <p>Call Us:- 95866-92000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Anand</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>G-10/11, Himalaya Heights, Besides Bachpan School, 100 Feet Road, Anand.</p>
                                    <p>Call Us:- 77789-86350</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Vesu</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>VIP Road, Bharthana Road, Vesu, Surat.</p>
                                    <p>Call Us:- 99742-28436</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Althan</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>UG-5, VIP Gallaria, Althan Bhimrad,Bhimrad-Althan Road, Surat.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Vyara</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>Ground Floor, M.M. Complex, Sabridham Society,Kakrapar By-Pass Road, Kanpura,
                                        Vyara, Gujarat.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Dhola (Bhavnagar)</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>Shop No. 8, Gurukrupa Shopping,Amreli Highway, Dhola, Ta. Umrala, Dist.
                                        Bhavnagar.</p>
                                    <p>Call Us:- 97374-07159</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="surat">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Athwalines</h5>
                                    <p>07 :00 am - 09 : 00 pm</p>
                                    <p>Mezzanine Floor, Maher Park-B, Athwa Gate, Ring Road, Surat.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Adajan</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>Ground Floor, Green Elina Complex, Anand Mahal Road, Adajan.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Sarthana jakatnaka</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>2nd Floor, Shubham Arcade, Sarthana Jakatnaka, Surat.</p>
                                    <p>Call Us:- 97273-97879</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Mota-Varachha</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>A-1/2/3, Pragati IT Park, Opp. Shell Petrol Pump, Mota Varachha, Surat.</p>
                                    <p>Call Us:- 95866-94000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Kargil Chowk</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>158, First Floor, Shivshakti Society, Punagam, Surat.</p>
                                    <p>Call Us:- 95866-63000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Kamrej</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>B-16, Basement Floor, Dharam Empire, Opp. ST Bus Stop, Below HDFC Bank,
                                        Surat-Kamrej Road, Kamrej Char Rasta, Surat.</p>
                                    <p>Call Us:- 76001-25436</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Katargam</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>131/132, Laxmi Enclave 2, Opp. Gajera School, Katargam.</p>
                                    <p>Call Us:- 95866-95000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Station</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>G-3/4, Ground Floor, Param Doctor House, Lal Darwaja, Station Road, Surat.</p>
                                    <p>Call Us:- 95866-92000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Vesu</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>VIP Road, Bharthana Road, Vesu, Surat.</p>
                                    <p>Call Us:- 99742-28436</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Althan</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>UG-5, VIP Gallaria, Althan Bhimrad,Bhimrad-Althan Road, Surat.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="anand">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="lab-store">
                                    <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                    <div class="time-box">24 x 7</div>
                                    <div class="lab-detail">
                                        <h5>HCL Anand</h5>
                                        <p>07 :00 am - 08 : 00 pm</p>
                                        <p>G-10/11, Himalaya Heights, Besides Bachpan School, 100 Feet Road, Anand.</p>
                                        <p>Call Us:- 77789-86350</p>
                                        <a>Go to Direction</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="vyara">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="lab-store">
                                    <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                    <div class="time-box">24 x 7</div>
                                    <div class="lab-detail">
                                        <h5>HCL Vyara</h5>
                                        <p>07 :00 am - 08 : 00 pm</p>
                                        <p>Ground Floor, M.M. Complex, Sabridham Society,Kakrapar By-Pass Road, Kanpura,
                                            Vyara, Gujarat.</p>
                                        <p>Call Us:- 95866-93000</p>
                                        <a>Go to Direction</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="dhola">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="lab-store">
                                    <img src="{{ asset('frontend/images/lab-store.png') }}" class="w-100">
                                    <div class="time-box">24 x 7</div>
                                    <div class="lab-detail">
                                        <h5>HCL Dhola (Bhavnagar)</h5>
                                        <p>07 :00 am - 08 : 00 pm</p>
                                        <p>Shop No. 8, Gurukrupa Shopping,Amreli Highway, Dhola, Ta. Umrala, Dist.
                                            Bhavnagar.</p>
                                        <p>Call Us:- 97374-07159</p>
                                        <a>Go to Direction</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

