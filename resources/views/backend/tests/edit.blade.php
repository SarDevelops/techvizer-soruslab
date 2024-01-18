<form id="test_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.tests.update', ['test' =>base64_encode($test->id)]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	@include('backend.tests.form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\Test\TestEditRequest', '#test_form') !!}
