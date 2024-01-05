@extends('layouts.front_layout')
@section('page_title', 'About Us')
@section('content')
<div class="about">
    <div class="heading">
        <div class="container">
            <p>Home › About us</p>
        </div>
    </div>
    <div class="about-gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="pic">
                        <img src="/images/dummy-01.png" class="w-100">
                    </div>
                </div>
                <div class="col-md-4 mt-4 my-md-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pic">
                                <img src="/images/dummy-02.png" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4 my-md-0">
                            <div class="pic">
                                <img src="/images/dummy-02.png" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="pic">
                                <img src="/images/dummy-02.png" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="pic">
                                <img src="/images/dummy-02.png" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-hcl">
        <div class="container">
            <div class="txt-box">
                <h4>About HCL Lab</h4>
                <p>Welcome to HCL lab—your trusted partner in health. More than a lab ,we're a team dedicated to your
                    well-being. </p>
                <p>As a leading healthcare laboratory, we are on a mission to redefine diagnostics, making it an
                    experience that is precise, accessible, and compassionate.</p>
                <p>Equipped with top-notch technology and a caring staff, we deliver accurate results with a focus on
                    your comfort. Your health is our priority, and we're here to make your diagnostic experience
                    seamless.</p>
                <p>Our team of experts, coupled with advanced technology, ensures reliable results. Whether it's a
                    routine check-up or a specialized test, we're here for you.</p>
            </div>
        </div>
    </div>
    <div class="about-laboratery">
        <div class="container">
            <div class="title">
                <h2>Learn Why we are the best</h2>
            </div>
            <div class="row">
                <div class="col-md-3 col-6 mt-4 my-md-0">
                    <div class="box">
                        <h4>Qualified Team</h4>
                        <p>Quality is at the core in everything we do. Our laboratory adheres to quality assurance
                            protocols, ensuring that every test meets the highest industry standard.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mt-4 my-md-0">
                    <div class="box">
                        <h4>Fully Automated Lab</h4>
                        <p>From sample processing to analysis, our automated systems streamline the entire workflow,
                            minimizing human errors.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mt-4 my-md-0">
                    <div class="box">
                        <h4>Awards and Honors</h4>
                        <p>We take pride in our achievements, having been honored with several awards for our commitment
                            to innovation, accuracy, and quality in laboratory services.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mt-4 my-md-0">
                    <div class="box">
                        <h4>Trusted by 4 millions</h4>
                        <p>Our commitment to precision, efficiency, and a customer-centric approach has earned the trust
                            of millions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="txt-box mr-md-4">
                        <p><span>Our commitment to accuracy begins with cutting-edge technology. From automated testing
                                processes to advanced analytical tools, we employ the latest innovations to ensure the
                                highest level of precision in every test we conduct.</span></p>
                        <p>Behind the scenes, our team of skilled technicians and healthcare professionals works with
                            unwavering attention to detail. Each sample is handled with care, and every test is
                            conducted with precision, leaving no room for error.</p>
                        <div class="name-box">
                            <div class="name">
                                <h5>Victoria Adams</h5>
                                <h6>Founder</h6>
                            </div>
                            <div class="pic">
                                <img src="/images/sign-01.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-5 my-md-0">
                    <div class="pic">
                        <img src="/images/about-detail.png" class="w-100">
                    </div>
                </div>
                <div class="col-md-4 mt-5 my-md-0">
                    <div class="lab-box ml-md-4">
                        <img src="/images/cerified.png">
                        <div class="txt ml-4">
                            <h4>Certified Lab</h4>
                            <p>Risus commodo viverra maecenas accumsan facilisis.</p>
                        </div>
                    </div>
                    <div class="lab-box ml-md-4 pt-4">
                        <img src="/images/award.png">
                        <div class="txt ml-4">
                            <h4>AwardWinning ‘16</h4>
                            <p>Risus commodo viverra maecenas accumsan facilisis.</p>
                        </div>
                    </div>
                    <div class="lab-box ml-md-4 pt-4">
                        <img src="/images/experience.png">
                        <div class="txt ml-4">
                            <h4>12 Years Experience</h4>
                            <p>Risus commodo viverra maecenas accumsan facilisis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lab-testing">
        <div class="container">
            <div class="title">
                <h2>Follow 4 Simple Test <br>for lab testing</h2>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-2 col-6">
                    <div class="box">
                        <img src="/images/labtest-01.png" class="w-100">
                        <p>Doctor Prescription</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="box">
                        <img src="/images/labtest-02.png" class="w-100">
                        <p>Blood Collect</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="box">
                        <img src="/images/labtest-03.png" class="w-100">
                        <p>Testing Begains</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="box">
                        <img src="/images/labtest-04.png" class="w-100">
                        <p>Reports Delivered</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection