@extends('layouts.front_layout')
@section('page_title', 'Package Deatis')
@section('content')
<div class="test-detail">
    <div class="heading">
        <div class="container">
            <p>Home  ›  {{ $package->name }}</p>
        </div>
    </div>
    <div class="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box">
                        <img src="/images/person.png">
                        <h6>Need help with booking your test?</h6>
                        <p>Our experts are here to help you</p>
                        <div class="call">
                            <img src="/images/header-call.png">
                            <p>80880 80200</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-5 my-md-0">
                    <div class="detail-box ml-md-4">
                        <h2>{{ $package->name }}</h2>
                        <p>Also known as Complete Blood Count Automated Blood</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Sample Type</td>
                                    <td class="space"> : </td>
                                    <td class="dark">{{ $package->type }}</td>
                                </tr>
                                <tr>
                                    <td>Recommended for</td>
                                    <td class="space"> : </td>
                                    @php
                                        $jsonString = $package->recommended_for;
                                        $dataArray = json_decode($jsonString, true);
                                        $recommended_for = implode(', ', $dataArray);
                                    @endphp
                                    <td class="dark">{{$recommended_for}}</td>
                                </tr>
                                <tr>
                                    <td>Report</td>
                                    <td class="space"> : </td>
                                    <td class="dark">Within 24 hours</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="overview-box ml-md-4">
                        <h4>Overview</h4>
                        <p>{{ $package->overview }}</p>
                    </div>
                    <div class="overview-box ml-md-4">
                        <h4>People with the following symptoms should do the CBC test:</h4>
                        <p>The doctor may suggest a CBC test if a person experiencing symptoms like: <br>
                            @php
                            $dataArray = $package->cbc_test;
                            $dataArray = json_decode($jsonString, true);
                            @endphp
                            @foreach ($dataArray as $cbc_test)
                                {{ $cbc_test }} .<br>
                            @endforeach
                    </div>

                    <div class="overview-box ml-md-4">
                        <h4>Package Tests Included in Good Health Silver Package(58 tests)</h4>
                        <div id="accordion" class="accordion1">
                            @php
                                $jsonString = $package->includes_pack;
                                $dataArray = json_decode($jsonString, true);
                            @endphp
                            @foreach ($dataArray as $key => $includes_pack)
                                <div class="point wow fadeInUp">
                                    <div class="header collapsed" data-toggle="collapse" href="#pack{{$key}}">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-10 col-10">
                                                <a class="title">
                                                    {{ $includes_pack['test_heading'] }}<span>(includes 21 tests)</span>
                                                </a>
                                            </div>
                                            <div class="col-md-2 col-2">
                                                <div class="icon"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pack{{ $key }}" class="body collapse show" data-parent="#accordion">
                                        @php
                                        $jsonString = $includes_pack['test_names'] ;
                                        $dataArray = json_decode($jsonString, true);
                                        @endphp
                                        @foreach ($dataArray as $pack)
                                        <p>{{ $pack['value'] }}</p>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="question-sec">
        <div class="container">
            <div class="title">
                <h4>Frequently Asked Questions</h4>
            </div>
            <div id="accordion" class="accordion">
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseOne">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    What makes Sterling Accuris a better pathology lab than others?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
                    </div>
                </div>
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseTwo">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    What other packages does Sterling Accuris offer?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
                    </div>
                </div>
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseThree">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    Do you provide home visit/collection service?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
                    </div>
                </div>
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseFour">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    Is there any preparation or precautions for patient before tests or body checkup?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseFour" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
                    </div>
                </div>
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseFive">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    How long does it take to receive test results?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseFive" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
                    </div>
                </div>
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseSix">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    What effect of thyroid ailment can one face?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseSix" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
                    </div>
                </div>
                <div class="point wow fadeInUp">
                    <div class="header collapsed" data-toggle="collapse" href="#collapseSeven">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-10 col-10">
                                <a class="title">
                                    Why should you book the Thyroid Function Test (TFT) test?
                                </a>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="icon"></div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseSeven" class="body collapse" data-parent="#accordion">
                        <p>For us, precision care, safe sample collection, timely delivery of reports, and precise reporting of patient results while adhering to health and safety precautions are the cornerstone of our success.</p>
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
                                <img src="/images/lab-store.png">
                                <div class="times-box"><p>Get Report within 18 hours</p><h6>30% OFF</h6></div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="fever">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="women">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="fit">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="hebit">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
                                <div class="time-box">Get Report within 18 hours</div>
                                <div class="lab-detail">
                                    <h5>Good Health Packages</h5>
                                    <p class="line">Include 3 test</p>
                                    <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c (Hemoglobin A1c) (16)</p>
                                    <a>+ More Detais</a>
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
