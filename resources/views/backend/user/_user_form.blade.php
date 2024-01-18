<div class="fv-row mb-7">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<label class="mb-5 required d-block fw-bold fs-6">Profile</label>
				<div class="image-input @if( !isset($user->profile_url)) image-input-empty @else image-input-outline @endif" data-kt-image-input="true" style="background-image: url({{ asset('theme/dist/assets/media/avatars/default_user.png') }})">
					<div class="image-input-wrapper w-125px h-125px" @if(isset($user->profile_url)) style="background-image: url({{ $user->profile_url }}); " @endif></div>
					<label class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
						<i class="bi bi-pencil-fill fs-7"></i>
						<input type="file" name="profile" accept="image/*" />
						<input type="hidden" name="profile_remove" />
					</label>
				</div>
				<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-lg-6 mb-7">
						<label class="mb-2 required fw-bold fs-6">First Name</label>
						<input type="text" name="first_name" class="mb-3 form-control mb-lg-0" placeholder="First name" @isset($user->first_name) value="{{ old('first_name', $user->first_name) }}" @endisset  />
					</div>
					<div class="col-lg-6 mb-7">
						<label class="mb-2  fw-bold fs-6">Last Name</label>
						<input type="text" name="last_name" class="mb-3 form-control mb-lg-0" placeholder="Last name" @isset($user->last_name) value="{{ old('last_name', $user->last_name) }}"@endisset  />
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 mb-7">
						<label class="mb-2 required fw-bold fs-6">Email</label>
						<input type="email" name="email" class="mb-3 form-control mb-lg-0" placeholder="Email" @isset($user->email) value="{{ old('email', $user->email) }}" @endisset />
					</div>
					<div class="col-lg-6 mb-7">
						<label class="mb-2 required fw-bold fs-6">Role</label>
						<select class="mb-3 form-select mb-lg-0" aria-label="Default select example" data-control="select2"  data-placeholder="Select role" name="role" id="role">
							@foreach($roles as $key => $role)
					  			<option name="role"  value="{{ $role->id }}" id="{{ "user_role_$role->id" }}" >{{ $role->role_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
		@if( !isset($user->id))
		<div class="mt-3 row">
			<div class="col-lg-6 mb-7">
				<label class="mb-2 required fw-bold fs-6">Password</label>
				<input type="password" class="form-control form-control-lg " name="password" id="password" placeholder="Password" autocomplete="new-password" />
				<div class="form-text">Password contains one uppercase, lowercase, number and special character from @#$%&</div>
			</div>
			<div class="col-lg-6 mb-7">
				<label class="mb-2 required fw-bold fs-6">Confirm Password</label>
				<input type="password" class="form-control form-control-lg " name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
			</div>
		</div>
		@endif
	</div>

</div>






	{{-- <div class="mb-7">
		<label class="mb-5 required fw-bold fs-6">Role</label>
		<select class="form-select" aria-label="Default select example" name="role" id="role">
			@foreach($roles as $key => $role)
	  			<option name="role"  value="{{ $role->id }}" id="{{ "user_role_$role->id" }}" @isset($user) @if($role->id == $user->role) selected @endif @endisset >
					{{ $role->role_name }}
				</option>
			@endforeach
		</select>
	</div> --}}
</div>
<!--end::Scroll-->
<!--begin::Actions-->
<div class="text-center pt-15">
	<button type="reset" class="btn btn-danger me-3" data-kt-users-modal-action="cancel" onclick="action_drawer()">Discard</button>
	<button type="submit" class="btn btn-primary submit-btn" data-kt-users-modal-action="submit">
	<span class="indicator-label">Submit</span>
	<span class="indicator-progress">Please wait...
		<span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
		</button>
</div>

<script type="text/javascript">
	var user_role;
	user_role = '{{ isset($user->role)  ? $user->role : " "}}';
	document.getElementById('role').value = user_role;
		// document.querySelector('div.selector option[value=user_role]');
// @$user->role) == $role->id)) ? 'checked' : (!@$user->role ? 'checked' : ''
	KTImageInput.createInstances();
</script>
