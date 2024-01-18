<form id="health_concern_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.health_concerns.update', ['health_concern' =>base64_encode($health->id)]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	@include('backend.health_concerns.form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\HealthConcern\HealthConcernEditRequest', '#health_concern_form') !!}
