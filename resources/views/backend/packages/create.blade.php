<form id="package_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
	@csrf
	@include('backend.packages.form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\Package\PackageAddRequest', '#package_form') !!}

    