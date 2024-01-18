<?php

namespace App\Http\Controllers\backend;

use Illuminate\View\View;
use Gate;
use Illuminate\Http\Request;
use App\Models\HealthConcern;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\backend\HealthConcern\HealthConcernAddRequest;
use App\Http\Requests\backend\HealthConcern\HealthConcernEditRequest;

class HealthConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        $module = "healthConcern";
        if ($request->ajax()) {
            $data = HealthConcern::select('id', 'name', 'image','created_at')->orderby('created_at','desc');

            // if ($request->is_active != null) {
            //     $data->where('is_active', $request->is_active);
            // }
            // $data = $data->latest()->get();
            $search = $request->search['value'];
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($search) {
                    if ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->orWhere('health_concerns.name', 'like', '%' . $search . '%');
                            if (\DateTime::createFromFormat('Y-m-d', $search) !== false) {
                                $query->orWhereDate('users.created_at', '=', date('Y-m-d', strtotime($search)));
                            }
                        });
                    }
                })
                ->addColumn('checkbox', function ($row) {
                    return "<div class='form-check form-check-sm form-check-custom form-check-solid'>
                                <input class='form-check-input' type='checkbox' value='".$row->id."' />
							</div>";
                })
                ->addColumn('image', function ($row) {
                    $image_url = asset('uploads/health_concern').'/'.$row->image;
                    return '<div class="overflow-hidden symbol symbol-circle symbol-50px me-3">
								<a href="javascript:void(0);">
									<div class="symbol-label">
										<img src="' . $image_url . '" alt="' . $row->name . '" class="w-100" />
									</div>
								</a>
							</div>';
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $action = '<div class="flex-shrink-0 d-flex justify-content-end">';
                    $action .= is_all_action_permision([
                        'health_concern:edit',
                        'health_concern:delete',
                    ]);
                    if (Gate::allows('health_concern:edit')) {
                        $action .= '<a target-url="' . route('admin.health_concerns.edit', ['health_concern' => $row->id]) . '" target-header="Edit Health Concern" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 open-health_concern-form" title="Edit">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="#134266"></path>
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="#134266"></path>
                                </svg>
                            </span>
                        </a>';
                    }
                    if (Gate::allows('health_concern:delete')) {
                        $action .= '<a target-url="' . route('admin.health_concerns.destroy', ['health_concern' => $row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-record" data-kt-tests-table-filter="delete_row" title="Delete">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="#134266"></path>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="#134266"></path>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="#134266"></path>
                                </svg>
                            </span>
                        </a>';
                    }
                    return $action .= '</div>';
                })
                ->addColumn('created_at', function ($row) {
                    return date($row->created_at);
                })
                ->rawColumns(['checkbox', 'image', 'name', 'action', 'created_at'])
                // ->with('is_delete_checkbox', Gate::allows($module . ':delete') ? true : false)
                ->make(true);
        }
        return view('backend.health_concerns.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('backend.health_concerns.create')->render();
        activity_log('Health Concern', 'Add health_concern form fetch successfully');
        return response()->json(json_response(true, 'Add health concern form fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HealthConcernAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $health = new HealthConcern();
            $health->name = $request->name;
            $image_name = '';
            // Upload the profile picture
            if ($request->hasFile('image')) {
                $image_name = file_uploading(
                    $request->file('image'), // File which is uploading
                    base64_encode(time()).'.'.$request->file('image')->getClientOriginalExtension(), // Rename the file and override to save the storage
                    'health_concern', // Folder name,
                );
            }
            if (!empty($image_name)) {
                $health->image 			= $image_name;
            }
            if ($health->save()) {
                DB::commit();
                activity_log('Health Concern Create', 'Health Concern has been created successfully');
                return response()->json(json_response(true, 'Health Concern has been created successfully.'), 200);
            }
            activity_log('Health Concern Create', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Health Concern Create', 'Something want to wrong.' . $e);
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
    public function edit($id) : JsonResponse
    {
        $health = HealthConcern::findOrFail($id);
        $view = view('backend.health_concerns.edit', compact('health'))->render();
        activity_log('Health Edit', 'Health detail fetch successfully.');
        return response()->json(json_response(true, 'Health detail fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HealthConcernEditRequest $request,$id)
    {
        try {
            DB::beginTransaction();
            $health = HealthConcern::find(base64_decode($id));
            $health->name = $request->name;

            $image_name = '';
            // Upload the profile picture
            if ($request->hasFile('image')) {
                $image_name = file_uploading(
                    $request->file('image'), // File which is uploading
                    base64_encode(time()).'.'.$request->file('image')->getClientOriginalExtension(), // Rename the file and override to save the storage
                    'health_concern', // Folder name,
                );
            }
            if (!empty($image_name)) {
                $health->image = $image_name;
            }
            if ($health->save()) {
                DB::commit();
                activity_log('Health Concern Create', 'Health Concern has been created successfully');
                return response()->json(json_response(true, 'Health Concern has been created successfully.'), 200);
            }
            activity_log('Health Concern Create', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Health Concern Create', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $count_selected_ids = $request->selected_ids ? count($request->selected_ids) : 0; // Count the selected ids
            // If multiple delete the assign the selected ids
            $id = [$id];
            if ($count_selected_ids) {
                $id = $request->selected_ids;
            }

            $result = HealthConcern::whereIn('id', $id)->delete();
            if ($result) {
                DB::commit();
                activity_log('Health concern delete', 'Health concern has been successfully deleted');
                $message = $count_selected_ids > 1 ? 'Health concerns have been successfully deleted.' : 'Health concern has been successfully deleted';
                return response()->json(json_response(true, $message), 200);
            }
            activity_log('Health concern delete', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Health concern delete', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }
}
