<form id="test_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.tests.store') }}" enctype="multipart/form-data">
	@csrf
	@include('backend.tests.form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\Test\TestAddRequest', '#test_form') !!}
