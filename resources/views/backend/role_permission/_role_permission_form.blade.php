<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
    data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll"
    data-kt-scroll-offset="300px">
    <div class="fv-row mb-10">
        <label class="fs-5 fw-bolder form-label mb-2">
            <span class="required">Role name</span>
        </label>
        <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name"
            @isset($role->role_name)  value="{{ old('role_name', $role->role_name) }}"  @endisset />
        {{-- <div class="form-text"><i class="fas fa-exclamation-circle ms-2 fs-7" title="It is not possible to use the exact keyword 'super admin'. If you've added the prefix or sufix with super admin, you're good to go."></i> Restricted keyword: Super Admin</div> --}}
    </div>
    <div class="fv-row">
        <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <tbody class="text-gray-600 fw-bold">
                    <tr>
                        <td class="text-gray-800">Administrator Access
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Allows full access to the system"></i>
                        </td>
                        <td>
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="kt_roles_select_all" />
                                <span class="form-check-label" for="kt_roles_select_all">Select All Permissions</span>
                            </label>
                        </td>
                    </tr>
                    @if (isset($modules))
                        @foreach ($modules as $module)
                                @php
                                    $permissions_name = json_decode($module->permissions, true);
                                @endphp
                                <tr class="modules-permission">
                                    <td class="text-gray-800">{{ $module->module_name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @foreach ($permissions_name as $permission_type => $permission_name)
                                                @php
                                                    $is_checked = false;
                                                    if (isset($role->permissions) && $role->permissions->count() && $role->permissions->firstWhere('module_id', $module->id)) {
                                                        $is_checked = $role->permissions->firstWhere('module_id', $module->id)->permissions[$permission_type] ? 'checked' : '';
                                                    }
                                                @endphp
                                                <label class="form-check form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $permission_type }}"
                                                        name="permissions[{{ $module->id }}][{{ $permission_type }}]"
                                                        {{ $is_checked }} />
                                                    <span class="form-check-label">{{ $permission_name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-center pt-15">
    <button type="reset" class="btn btn-danger me-3" data-kt-users-modal-action="cancel"
        onclick="action_drawer()">Discard</button>
    <button type="submit" class="btn btn-primary submit-btn" data-kt-users-modal-action="submit">
        <span class="indicator-label">Submit</span>
        <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kt_roles_select_all[type="checkbox"]').prop('checked', $(
            '.modules-permission input[type="checkbox"]:checked').length == $(
            '.modules-permission input[type="checkbox"]').length);
    });
</script>
