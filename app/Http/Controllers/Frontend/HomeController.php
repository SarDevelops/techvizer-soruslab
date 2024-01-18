<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cms;
use App\Models\Test;
use App\Models\Package;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\HealthConcern;
use App\Models\PackageCategory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): View
    {
        $tests = Test::all();
        $healths  = HealthConcern::all();
        $packages  = Package::all();
        $package_categories  = PackageCategory::all();
        $cms = Cms::all();
        return view('frontend.home', compact('tests','healths','packages','package_categories','cms'));
    }

    public function test_show(Request $request): View
    {
        // dd($request->all() , base64_decode($request->id));
        $test = Test::find(base64_decode($request->id));
        return view('frontend.home.test_details', compact('test'));
    }

    public function package_show(Request $request): View
    {
        // dd($request->all() , base64_decode($request->id));
        $package = Package::find(base64_decode($request->id));
        return view('frontend.home.package_details', compact('package'));
    }

    public function select_package(Request $request) : View | JsonResponse{

        if ($request->id == 0) {
            $package_categories  = PackageCategory::all();
            $packages  = Package::all();
        } else {
            $package_categories  = PackageCategory::find($request->id);
            $packages  = Package::where('package_categories_id',$request->id)->get();
        }
        $html = view('frontend.packages', compact('packages'))->render();
        return response()->json(json_response(true, 'package fetch successfully.',['html' => $html]), 200);
        // return response()->json(['html' => $html]);
    }
}
