<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsController extends Controller
{
    public function index(): View | JsonResponse
    {
        $cms_data = Cms::all();
        activity_log('Pages', 'Show Page Setting');
        return view('backend.cms.sliders.home_page_slider', ['cms_data' => $cms_data]);
    }

    public function store(): JsonResponse
    {

    }

    public function page(): View | JsonResponse
    {
        $cms_data = Cms::where('slug', 'slider')->first();
        return view('backend.cms.sliders.home_page_slider', ['cms_data' => $cms_data]);
    }

    public function update(Request $request): JsonResponse
    {
        if ($request->ajax()) {

            if (isset($validation_array)) {
                $request->validate($validation_array, []);
            }

            $all_data = $request->except(['_token', 'proengsoft_jsvalidation', 'site_logo_remove', 'view_name']);

            foreach ($all_data as $key_data => $data) {
                $is_exists = Setting::where('name', $key_data)->count();

                if ($is_exists) {
                    $result = Setting::where('name', $key_data)->update(['value' => $data]);
                } else {
                    $result = Setting::create(['name' => $key_data, 'value' => $data]);
                }
            }
            // $view = view('admin_panel.pages.index')->render();
            activity_log('Pages Update', 'Updated successfully');
            // return response()->json(json_response(true, 'Updated successfully.', ['view' => $view]), 200);

            return get_success_response(route('admin.pages.index'), 'Page has been updated successfully.', ['redirect_url' => route('admin.pages.index')], 0);
        }
        activity_log('Pages Update', '500 server not found');
        return get_fail_response(route('admin.pages.index'), '500 server not found', ['redirect_url' => route('admin.pages.index')], 0);
    }

    public function store_cms(Request $request)
    {
        $imgs[] = '';
        foreach ($request->sliders as $key => $slider) {

            if ($slider['hidden_image']) {
                $imgs['s1_' . $key] = $slider['hidden_image'];
            } else {
                $image = $slider['slider_image'];
                //  $validator = Validator::make($slider['slider_image'],
                //         [
                //             'slider_image'=> 'required|image|mimes:png,jpg,jpeg|dimensions:min_width=1150,min_height=430',
                //         ],
                //         [
                //             'slider_image.required' => 'Please select Image.',
                //             'slider_image.mimes' => 'Please enter a valid image file jpg, png or jpeg.',
                //             'slider_image.dimensions' => 'Image min width 1150 and min height 430px is required.',
                //         ]
                //     );

                //     if ($validator->fails()) {
                //         $errors = $validator->errors();                //
                //         return redirect()->back()->withErrors($validator)->withInput();
                //     }
                $input['file'] = 's1_image_' . $key . '.' . $image->getClientOriginalExtension();
                $image_name = file_uploading(
                    $image, // File which is uploading
                    $input['file'], // Rename the file and override to save the storage
                    'sliders', // Folder name
                    '',
                );
                // $destinationPath = public_path('home/images');
                // $imgFile = Image::make($image->getRealPath())->orientate();
                // $image = $imgFile->save($destinationPath . '/' . $input['file'], 60);
                // chmod($destinationPath . '/' . $input['file'], 0755);
                $imgs['s1_' . $key] = $image_name;

            }
        }
        $newUser = Cms::updateOrCreate([
            'slug' => 'slider',
        ], [
            'page_name' => $request->page_name,
            'slug' => 'slider',
            // 'section' => json_encode(array_merge($request->all(), $imgs)),
            'section' => json_encode($imgs),
        ]);
        //    return Session::flash('message', "save image successfully");
        // return response()->json(['message' => 'Form submitted successfully']);
        return response()->json(json_response(true, 'Form submitted successfully.'), 200);
    }
}
