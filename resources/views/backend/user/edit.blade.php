<form id="user_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	@include('backend.user._user_form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\User\EditUserRequest', '#user_form') !!}
