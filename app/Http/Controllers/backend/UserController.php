<?php

namespace App\Http\Controllers\backend;

use Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\backend\User\AddUserRequest;
use App\Http\Requests\backend\User\EditUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = User::select('id', 'first_name', 'last_name', 'email', 'profile', 'role', 'is_active', 'created_at')
                // ->where('id', '!=', Auth::user()->id)
                ->whereHas('role_detail', function ($query) {
                    $query->where('is_active', '=', 1);
                    $query->where('role_name', '!=', 'vendor');
                })
                ->where('is_test', is_test_data());

            if (!empty($request->role_id)) {
                $data->where('role', $request->role_id);
            }

            if ($request->is_active != null) {
                $data->where('is_active', $request->is_active);
            }

            $search = $request->search['value'];

            activity_log('User Dashboard', 'user Details Page');
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($search) {
                    if ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->orWhere('users.first_name', 'like', '%' . $search . '%');
                            $query->orWhere('users.last_name', 'like', '%' . $search . '%');
                            $query->orWhere('users.email', 'like', '%' . $search . '%');
                            $query->orWhereHas('role_detail', function ($query) use ($search) {
                                $query->where('role_name', 'like', '%' . $search . '%');
                            });
                            if (\DateTime::createFromFormat('Y-m-d', $search) !== false) {
                                $query->orWhereDate('users.created_at', '=', date('Y-m-d', strtotime($search)));
                            }
                        });
                    }
                })
                ->order(function ($query) use ($request) {
                    $order_column 	= $request->columns[$request->order[0]['column']]['name'];
                    $order_dir 		= $request->order[0]['dir'];
                    $query 			= $order_column == 'role' ? $query->orderBy('created_at', $order_dir) : $query->orderBy($order_column, $order_dir);
                })
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('checkbox', function ($row) {
                    return "<div class='form-check form-check-sm form-check-custom form-check-solid'>
								<div class='check_count'>
                                	<input class='form-check-input' type='checkbox' value='" . $row->id . "' />
								</div>
                            </div>";
                })
                ->addColumn('profile', function ($row) {
                    return '<div class="overflow-hidden symbol symbol-circle symbol-50px me-3">
                                <a href="javascript:void(0);">
                                    <div class="symbol-label">
                                        <img src="' . $row->profile_url . '" alt="' . $row->first_name . '" class="w-100"/>
                                    </div>
                                </a>
                            </div>';
                })
                ->addColumn('first_name', function ($row) {
                    return $row->first_name;
                })
                ->addColumn('last_name', function ($row) {
                    return $row->last_name ? $row->last_name : '-';
                })
                ->addColumn('email', function ($row) {
                    return "<a href='mailto:$row->email'>$row->email</a>";
                })
                ->addColumn('role', function ($row) {
                    return "<div class='badge badge-secondary fw-bolder'>" .$row->role_detail->role_name .'</div>';
                })
                ->addColumn('is_active', function ($row) {
                    $is_active = $row->is_active == '1' ? 'checked="checked"' : '';
                    return '<div class="form-check form-check-solid form-switch fv-row">
                                <input class="form-check-input w-45px h-30px is_active" target-url="' . route('admin.user.is_active', ['user' => $row->id]) . '" type="checkbox" ' . $is_active . ' />
                                <label class="form-check-label" for="allowmarketing"></label>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    $action = '<div class="flex-shrink-0 d-flex justify-content-end">';
                    $action .= is_all_action_permision(['user:edit', 'user:delete']);

                    // if (Gate::allows('user:edit')) {
                        $action .= '<a target-url="' . route('admin.users.edit', ['user' => $row->id]) . '" target-header="Edit User" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 open-user-form" title="Edit">
										<span class="svg-icon svg-icon-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="#134266"></path>
												<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="#134266"></path>
											</svg>
										</span>
									</a>';
                    // }

                    // if (Gate::allows('user:delete')) {
                        $action .= '<a target-url="' . route('admin.users.destroy', ['user' => $row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-user" data-kt-users-table-filter="delete_row" title="Delete">
										<span class="svg-icon svg-icon-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="#134266"></path>
												<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="#134266"></path>
												<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="#134266"></path>
											</svg>
										</span>
									</a>';
                    // }
                    return $action .= '</div>';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                })
                ->rawColumns(['checkbox', 'profile', 'first_name', 'last_name', 'email', 'role', 'is_active', 'action', 'created_at'])
                ->make(true);
        }
        $roles = Role::select('id', 'role_name')->where('role_name', '!=', 'vendor')->where('is_active', 1)->get();
        activity_log('User', 'Index Page');
        return view('backend.user.index', compact('roles'));
    }

    /**
     * Display create user form
     *
     * @return void
     */
    public function create(): JsonResponse
    {
        $roles = Role::select('id', 'role_name')->where('role_name', '!=', 'vendor')->where('is_active', 1)->get();
        $view = view('backend.user.create', compact('roles'))->render();
        activity_log('User', 'Add user form fetch successfully');
        return response()->json(json_response(true, 'Add user form fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Store the user detail
     *
     * @param AddUserRequest $request
     * @return void
     */
    public function store(AddUserRequest $request)
    {
        try {
            DB::beginTransaction();
			if ($request->hasFile('profile')) {
                $profile_name = '';
				$user = new User();
				$user->first_name = $request->first_name;
				$user->last_name = $request->last_name;
				$user->email = $request->email;
				$user->role = $request->role;
				$user->password = bcrypt($request->password);

				$profile_name = file_uploading(
					$request->file('profile'),
					base64_encode(time()) . '.' . $request->file('profile')->getClientOriginalExtension(),
					'user_profile' // Folder name
				);
				if (!empty($profile_name)) {
					$user->profile = $profile_name;
				}
				if ($user->save()) {
					// $user->notify(new WelcomeUser($user, $request->password, 'new-user-added'));
					DB::commit();
					activity_log('User Create', 'User profile has been created successfully');
					return response()->json(json_response(true, 'User profile has been created successfully.'),200);
				}
				activity_log('User Create', '500 server not found');
				return response()->json(json_response(false, 'Something want to wrong.'), 500);
			}
        } catch (\Exception $e) {
            DB::rollback();
			activity_log('User Create', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Display the update user detail form
     *
     * @param [number] $id user_id
     * @return void
     */
    public function edit($id): JsonResponse
    {
        $roles = Role::select('id', 'role_name')->where('is_active', 1)->get();
        $user = User::findOrFail($id);
        $view = view('backend.user.edit', compact('roles', 'user'))->render();
        activity_log('User Edit', 'User detail fetch successfully.');
        return response()->json(json_response(true, 'User detail fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Update the user detail
     *
     * @param EditUserRequest $request
     * @param [number] $id
     * @return void
     */
    public function update(EditUserRequest $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $profile_name = '';
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->role = $request->role;
			if ($request->hasFile('profile')) {
                $profile_name = file_uploading(
                    $request->file('profile'),
                    base64_encode($id) . '.' . $request->file('profile')->getClientOriginalExtension(),
                    'user_profile', // Folder name
                    $user->profile,
                );
            }
            if (!empty($profile_name)) {
                $user->profile = $profile_name;
            }
            if ($user->save()) {
                DB::commit();
                activity_log('User Edit', 'User profile has been updated successfully');
                return response()->json(json_response(true, 'User profile has been updated successfully.'), 200);
            }
            activity_log('User Edit', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('User Edit', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Delete single or multiple users and update
     * the email address with timestamp
     *
     * @param Request $request
     * @param [number] $id
     * @return void
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $count_selected_ids = $request->selected_ids ? count($request->selected_ids) : 0; // Count the selected ids
            // If multiple delete the assign the selected ids
            $id = [$id];
            if ($count_selected_ids) {
                $id = $request->selected_ids;
            }

            $user = User::whereIn('id', $id)->get();
            $user->toQuery()->update([
                'email' => DB::raw('CONCAT(UNIX_TIMESTAMP(), "_", email)'), // add timestamp to email
            ]);

            $result = User::whereIn('id', $id)->delete();
            if ($result) {
                DB::commit();
                activity_log('User delete', 'User has been successfully deleted');
                $message = $count_selected_ids > 1 ? 'Users have been successfully deleted.' : 'User has been successfully deleted';
                return response()->json(json_response(true, $message), 200);
            }
            activity_log('User delete', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('User delete', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Update the status of user as active or deactive
     *
     * @param Request $request
     * @param [number] $id
     * @return boolean
     */
    public function is_active(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id)->update(['is_active' => $request->is_active]);
            if ($user) {
				DB::commit();
                activity_log('User is Active', 'User profile status has been updated successfully');
                return response()->json(json_response(true, 'User profile status has been updated successfully.'), 200);
            }
            activity_log('User is Active', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('User is Active', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }
}
