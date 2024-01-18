
@foreach ($packages as $package)
<div class="lab-store" data-cat-id="{{  $package->package_categories_id}}">
    <img src="{{ asset('uploads/packages').'/'. $package->image }}">
    <div class="times-box">
        <p>Get Report within 18 hours</p>
        <h6>30% OFF</h6>
    </div>
    <div class="lab-detail">
        <h5>{{ $package->name }}</h5>
        <p class="line">Include 3 test</p>
        <p>TSH (Thyroid Stimulating Hormone) Ultrasensitive Cholesterol - Total <br> HbA1c
            (Hemoglobin A1c) (16)</p>
        <a href="{{ route('frontend.home.package_show',['id' => base64_encode($package->id)])}}"
            target-url="{{ route('frontend.home.package_show',['id' => base64_encode($package->id)])}}">+ More
            Detais</a>
    </div>
</div>
@endforeach
