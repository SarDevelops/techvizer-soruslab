<form id="user_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
	@csrf
	@include('backend.user._user_form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\User\AddUserRequest', '#user_form') !!}
