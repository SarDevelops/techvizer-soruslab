<?php

namespace App\Http\Controllers\backend;

use Gate;
use App\Models\Package;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PackageCategory;

use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Package\PackageAddRequest;
use App\Http\Requests\backend\Package\PackageEditRequest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View | JsonResponse {
        $module = "package";
        if ($request->ajax()) {
            $data = Package::select('id','package_categories_id' ,'image','name', 'overview', 'recommended_for','type','cbc_test', 'created_at')->with('category')->orderby('created_at','desc');

            // if ($request->is_active != null) {
            //     $data->where('is_active', $request->is_active);
            // }
            // $data = $data->lapackage()->get();

            $search = $request->search['value'];
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($search) {
                    if ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->orWhere('packages.name', 'like', '%' . $search . '%');
                            $query->orWhere('packages.type', 'like', '%' . $search . '%');
                            $query->orWhereHas('category', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });

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
                    $image_url = asset('uploads/packages').'/'.$row->image;
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
                ->addColumn('type', function ($row) {
                    return $row->type;
                })
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('recommended_for', function ($row) {
                    $badgeHtml = '';
                    foreach (json_decode($row->recommended_for) as $key => $data) {
                        $badgeHtml .=  ' <span class="px-4 py-3 badge fs-7 badge-light-primary">'.$data.'</span>';
                    }
                    return $badgeHtml;
                })
                ->addColumn('cbc_test', function ($row) {
                    $badgeHtml = '';
                    foreach (json_decode($row->cbc_test) as $key => $data) {
                        $badgeHtml .=  ' <span class="badge badge-light-danger fs-base">'.$data.'</span>';

                    }
                    return $badgeHtml;
                })
                ->addColumn('action', function ($row) {
                    $action = '<div class="flex-shrink-0 d-flex justify-content-end">';
                    $action .= is_all_action_permision([
                        'package:edit',
                        'package:delete',
                    ]);
                    if (Gate::allows('package:edit')) {
                        $action .= '<a target-url="' . route('admin.packages.edit', ['package' => $row->id]) . '" target-header="Edit Test" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 open-package-form" title="Edit">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="#134266"></path>
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="#134266"></path>
                                </svg>
                            </span>
                        </a>';
                    }
                    if (Gate::allows('package:delete')) {
                        $action .= '<a target-url="' . route('admin.packages.destroy', ['package' => $row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-record" data-kt-packages-table-filter="delete_row" title="Delete">
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
                ->rawColumns(['checkbox', 'image', 'name','type','category', 'recommended_for','cbc_test', 'created_at','action'])
                // ->with('is_delete_checkbox', Gate::allows($module . ':delete') ? true : false)
                ->make(true);
        }
        return view('backend.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :JsonResponse
    {
        $package_categories = PackageCategory::all();
        // dd($package_categories);
        $view = view('backend.packages.create', compact('package_categories'))->render();
        activity_log('Package', 'Add package form fetch successfully');
        return response()->json(json_response(true, 'Add package form fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageAddRequest $request):JsonResponse
    {
        try {
            DB::beginTransaction();
            $recommended_for = $request->input('recommended_for');
            $recommended_for = array_column(json_decode($recommended_for),'value');
            $cbc_test = $request->input('cbc_test');
            $cbc_test = array_column(json_decode($cbc_test),'value');

            $package = new Package();
            $package->name = $request->name;
            $package->package_categories_id  = $request->category;
            $package->type = $request->type;
            $package->recommended_for = json_encode($recommended_for);
            $package->overview = $request->overview;
            $package->cbc_test = json_encode($cbc_test);
            $package->includes_pack = json_encode($request->includes_pack);

            $image_name = '';
            // Upload the profile picture
            if ($request->hasFile('image')) {
                $image_name = file_uploading(
                    $request->file('image'), // File which is uploading
                    base64_encode(time()).'.'.$request->file('image')->getClientOriginalExtension(), // Rename the file and override to save the storage
                    'packages', // Folder name,
                );
            }
            if (!empty($image_name)) {
                $package->image = $image_name;
            }

            if ($package->save()) {
                DB::commit();
                activity_log('Test Create', 'Test has been created successfully');
                return response()->json(json_response(true, 'Test has been created successfully.'), 200);
            }
            activity_log('Test Create', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Test Create', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $package_categories = PackageCategory::all();
        $view = view('backend.packages.edit', compact('package','package_categories'))->render();
        activity_log('Package Edit', 'Package detail fetch successfully.');
        return response()->json(json_response(true, 'Package detail fetch successfully.', ['view' => $view]), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageEditRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $package = Package::findOrFail(base64_decode($id));
            $recommended_for = $request->input('recommended_for');
            $recommended_for = array_column(json_decode($recommended_for),'value');
            $cbc_test = $request->input('cbc_test');
            $cbc_test = array_column(json_decode($cbc_test),'value');
            $package->name = $request->name;
            $package->package_categories_id  = $request->category;
            $package->type = $request->type;
            $package->recommended_for = json_encode($recommended_for);
            $package->overview = $request->overview;
            $package->cbc_test = json_encode($cbc_test);
            $package->includes_pack = json_encode($request->includes_pack);

            $image_name = '';
            // Upload the profile picture
            if ($request->hasFile('image')) {
                $image_name = file_uploading(
                    $request->file('image'), // File which is uploading
                    base64_encode(time()).'.'.$request->file('image')->getClientOriginalExtension(), // Rename the file and override to save the storage
                    'packages', // Folder name,
                );
            }
            if (!empty($image_name)) {
                $package->image = $image_name;
            }

            if ($package->save()) {
                DB::commit();
                activity_log('Test Create', 'Test has been updated successfully');
                return response()->json(json_response(true, 'Test has been updated successfully.'), 200);
            }
            activity_log('Test Create', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Test Create', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $count_selected_ids = $request->selected_ids ? count($request->selected_ids) : 0; // Count the selected ids
            // If multiple delete the assign the selected ids
            $id = [$id];
            if ($count_selected_ids) {
                $id = $request->selected_ids;
            }

            $result = Package::whereIn('id', $id)->delete();
            if ($result) {
                DB::commit();
                activity_log('Package delete', 'Package has been successfully deleted');
                $message = $count_selected_ids > 1 ? 'Packages have been successfully deleted.' : 'Package has been successfully deleted';
                return response()->json(json_response(true, $message), 200);
            }
            activity_log('Package delete', '500 server not found');
            return response()->json(json_response(), 500);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Health concern delete', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }
}
