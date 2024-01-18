<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RolePermissionModule;
use App\Http\Requests\backend\RolePermission\RolePermissionRequest;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = Role::select('id', 'role_name', 'is_active', 'created_at')->where('role_name', '!=', 'Guest');
            if ($request->is_active != null) {
                $data = $data->where('is_active', $request->is_active);
            }
            $data = $data->latest()->get();

            activity_log('Role Permision Page', 'Datatable Details page');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return "<div class='form-check form-check-sm form-check-custom form-check-solid'>
								<input class='form-check-input' type='checkbox' value='" . $row->id . "' />
							</div>";
                })
                ->addColumn('role_name', function ($row) {
                    return $row->role_name;
                })
                ->addColumn('permissions', function ($row) {
                    $modules = '';
                    foreach ($row->permissions as $permissions) {
                        $module_name = $permissions->module_detail->module_name;
                        $permissions_list = '';
                        foreach ($permissions->permissions as $permission => $status) {
                            if ($status == '1') {
                                $permissions_list .= "$permission | ";
                            }
                        }

                        if ($permissions_list) {
                            $permissions_list = trim($permissions_list, ' | ');
                            $modules .= "<span class='mt-2 badge badge-secondary me-2' title='$permissions_list'>$module_name</span>";
                        }
                    }
                    return $modules;
                })
                ->addColumn('is_active', function ($row) {
                    $is_active = ($row->is_active == '1') ? 'checked="checked"' : '';
                    return '<div class="form-check form-check-solid form-switch fv-row">
								<input class="form-check-input w-45px h-30px is_active" target-url="' . route('admin.role_permission.is_active', ['role_permission' => $row->id]) . '" type="checkbox" ' . $is_active . ' />
								<label class="form-check-label" for="allowmarketing"></label>
							</div>';
                })
                ->addColumn('created_at', function ($row) {
                    return date($row->created_at);
                })
                ->addColumn('action', function ($row) {
                    $action = '<div class="flex-shrink-0 d-flex justify-content-end">';
                    $action .= is_all_action_permision(['role_permission:edit', 'role_permission:delete']);

                    // if (Gate::allows('role_permission:edit')) {
                    $action .= '<a target-url="' . route('admin.role_permissions.edit', ['role_permission' => $row->id]) . '" target-header="Edit Role Permission" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 open-user-form" title="Edit">
										<span class="svg-icon svg-icon-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
												<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
											</svg>
										</span>
									</a>';
                    // }

                    // if (Gate::allows('role_permission:delete')) {
                    $action .= '<a target-url="' . route('admin.role_permissions.destroy', ['role_permission' => $row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-user" data-kt-users-table-filter="delete_row" title="Delete">
										<span class="svg-icon svg-icon-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
												<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
												<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
											</svg>
										</span>
									</a>';
                    // }

                    return $action .= '</div>';
                })
                ->rawColumns(['checkbox', 'role_name', 'permissions', 'is_active', 'created_at', 'action'])
                ->make(true);
        }
        activity_log('Role Permisions', 'Role Permision Page');
        return view('backend.role_permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        $modules = RolePermissionModule::get();
        activity_log('Role Permission', 'create Page');
        $view = view('backend.role_permission.create', compact('modules'))->render();
        return response()->json(json_response(true, 'Add user form fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // If role add and some issue occure to add permission then it will rollback the added role name.
            $role = new Role;
            $role->role_name = $request->role_name;
            $role->role_type = \Str::lower($request->role_name);
            if ($role->save()) {
                if ($request->permissions) {
                    foreach ($request->permissions as $module_id => $permission) {
                        $role_permission = RolePermission::updateOrCreate(
                            [
                                'role_id' => $role->id,
                                'module_id' => $module_id,
                            ],
                            [
                                'permissions' => json_encode($permission)
                            ]
                        );

                        if ($role_permission->wasRecentlyCreated || !$role_permission->wasRecentlyCreated && $role_permission->wasChanged()) {
                            DB::commit();
                        }
                    }
                    activity_log('Role Permission', 'Role and permissions has been created successfully.');
                    return response()->json(json_response(true, 'Role and permissions has been created successfully.'), 200);
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
			return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        $role = Role::with(['permissions'])->findOrFail($id);
        $modules = RolePermissionModule::get();
        $view = view('backend.role_permission.edit', compact('modules', 'role'))->render();

        activity_log('Role Permission ', 'Edit page');
        return response()->json(json_response(true, 'Edit user form fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolePermissionRequest $request, $id): JsonResponse
    {
        DB::beginTransaction(); // If role add and some issue occure to add permission then it will rollback the added role name.
		$role = Role::findOrFail($id);
        $role->role_name = $request->role_name;
        if ($role->save()) {
            if ($request->permissions) {
                foreach ($request->permissions as $module_id => $permission) {
                    $role_permission = RolePermission::updateOrCreate(
                        [
                            'role_id' => $role->id,
                            'module_id' => $module_id,
                        ],
                        [
                            'permissions' => json_encode($permission)
                        ]
                    );

                    if ($role_permission->wasRecentlyCreated || !$role_permission->wasRecentlyCreated && $role_permission->wasChanged()) {
                        DB::commit();
                    }
                }
                activity_log('Role Permission Edit', 'Role and permissions has been updated successfully.');
                return response()->json(json_response(true, 'Role and permissions has been updated successfully.'), 200);
            }
        }
        activity_log('Role Permission Edit Error', ' 500 server note found');
        DB::rollback();
        return response()->json(json_response(), 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id): JsonResponse
    {
		try {
			DB::beginTransaction();
			$count_selected_ids = ($request->selected_ids) ? count($request->selected_ids) : 0; // Count the selected ids
			$id = [$id];
			if ($count_selected_ids) {
				$id = $request->selected_ids;
			}
			$role = Role::whereIn('id', $id);
			if ($role->delete()) {
				User::whereIn('role',$id)->delete();
				DB::commit();
				activity_log('Role Permission', 'Roles and permissions have been successfully deleted');
				$message = ($count_selected_ids > 1) ? 'Roles and permissions have been successfully deleted.' : 'Role and permissions has been deleted successfully.';
				return response()->json(json_response(true, $message), 200);
			}
			activity_log('Role Permission Delete Error', ' 500 server note found');
			return response()->json(json_response(), 500);
		} catch (\Exception $e) {
			DB::rollback();
			activity_log('Role Permission Delete Error', 'Something want to wrong.' . $e);
			return response()->json(json_response(false, $e->getMessage()), 500);
		}
    }

    public function is_active(Request $request, $id): JsonResponse
    {
		try {
			DB::beginTransaction();
			$role = Role::findOrFail($id)->update(['is_active' => $request->is_active]);
			if ($role) {
				DB::commit();
				activity_log('Role Permission Is Active', 'Roles and permissions status has been updated successfully.');
				return response()->json(json_response(true, 'Role and permissions status has been updated successfully.'), 200);
			}
			activity_log('Role Permission Is Active', '500 server not found');
			return response()->json(json_response(), 500);
		} catch (\Exception $e) {
			DB::rollback();
			activity_log('Role Permission Is Active', 'Something want to wrong.' . $e);
			return response()->json(json_response(false, $e->getMessage()), 500);
		}
    }
}
