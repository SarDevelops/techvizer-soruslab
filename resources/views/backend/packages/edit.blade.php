<form id="package_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.packages.update', ['package' =>base64_encode($package->id)]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	@include('backend.packages.form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\Package\PackageEditRequest', '#package_form') !!}
