<form id="health_concern_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.health_concerns.store') }}" enctype="multipart/form-data">
	@csrf
	@include('backend.health_concerns.form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\HealthConcern\HealthConcernAddRequest', '#health_concern_form') !!}
