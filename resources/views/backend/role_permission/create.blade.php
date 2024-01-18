<form id="role_permission_form" class="form" novalidate="novalidate" method="POST" action="{{ route('admin.role_permissions.store') }}" enctype="multipart/form-data">
	@csrf
	@include('backend.role_permission._role_permission_form')
</form>

{!! JsValidator::formRequest('App\Http\Requests\backend\RolePermission\RolePermissionRequest', '#role_permission_form') !!}
