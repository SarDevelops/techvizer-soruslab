@extends('layouts.front_layout')
@section('page_title', 'hospitals')
@section('content')
<div class="test">
    <div class="find-test">
        <div class="container">
            <div class="serch-bar">
                <input class="form-control" type="text" placeholder="Search Test & Packages">
                <div class="icon">
                    <img src="{{ asset('frontend/images/serch.png') }}">
                </div>
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
        </div>
    </div>
    <div class="top-book">
        <div class="container">
            <div class="title">
                <h4>Top Booked Diagnostic Tests</h4>
            </div>
            <div class="row">
                @foreach ($tests as $test )
                <div class="col-md-3 col-6">
                <div class="top-box">
                    <h4>{{ $test->name }}</h4>
                    <p>Also known as Thyroid Profile Total Blood</p>
                    <h6>E reports on next day</h6>
                    <a href="{{ route('frontend.home.test_show',['id' => base64_encode($test->id)])}}"
                        target-url="{{ route('frontend.home.test_show',['id' => base64_encode($test->id)])}}"
                        data-id="{{ base64_encode($test->id) }}">+ More Details</a>
                </div>
                </div>
                @endforeach

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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Kamrej</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>B-16, Basement Floor, Dharam Empire, Opp. ST Bus Stop, Below HDFC Bank, Surat-Kamrej Road, Kamrej Char Rasta, Surat.</p>
                                    <p>Call Us:- 76001-25436</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Vyara</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>Ground Floor, M.M. Complex, Sabridham Society,Kakrapar By-Pass Road, Kanpura, Vyara, Gujarat.</p>
                                    <p>Call Us:- 95866-93000</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png" class="w-100">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Dhola (Bhavnagar)</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>Shop No. 8, Gurukrupa Shopping,Amreli Highway, Dhola, Ta. Umrala, Dist. Bhavnagar.</p>
                                    <p>Call Us:- 97374-07159</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-data" tab-data="surat">
                        <div class="lab-carousel owl-carousel owl-theme">
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
                                <div class="time-box">24 x 7</div>
                                <div class="lab-detail">
                                    <h5>HCL Kamrej</h5>
                                    <p>07 :00 am - 08 : 00 pm</p>
                                    <p>B-16, Basement Floor, Dharam Empire, Opp. ST Bus Stop, Below HDFC Bank, Surat-Kamrej Road, Kamrej Char Rasta, Surat.</p>
                                    <p>Call Us:- 76001-25436</p>
                                    <a>Go to Direction</a>
                                </div>
                            </div>
                            <div class="lab-store">
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                <img src="/images/lab-store.png">
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
                                    <img src="/images/lab-store.png">
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
                                    <img src="/images/lab-store.png" class="w-100">
                                    <div class="time-box">24 x 7</div>
                                    <div class="lab-detail">
                                        <h5>HCL Vyara</h5>
                                        <p>07 :00 am - 08 : 00 pm</p>
                                        <p>Ground Floor, M.M. Complex, Sabridham Society,Kakrapar By-Pass Road, Kanpura, Vyara, Gujarat.</p>
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
                                    <img src="/images/lab-store.png" class="w-100">
                                    <div class="time-box">24 x 7</div>
                                    <div class="lab-detail">
                                        <h5>HCL Dhola (Bhavnagar)</h5>
                                        <p>07 :00 am - 08 : 00 pm</p>
                                        <p>Shop No. 8, Gurukrupa Shopping,Amreli Highway, Dhola, Ta. Umrala, Dist. Bhavnagar.</p>
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
