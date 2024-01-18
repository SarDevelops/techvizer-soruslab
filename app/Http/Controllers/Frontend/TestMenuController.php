<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Test;
use App\Models\Package;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\HealthConcern;
use App\Models\PackageCategory;
use App\Http\Controllers\Controller;

class TestMenuController extends Controller
{
    public function index(): View
    {
        $tests = Test::all();
        $healths  = HealthConcern::all();
        $packages  = Package::all();
        $package_categories  = PackageCategory::all();
        return view('frontend.test_menu', compact('tests','healths','packages','package_categories'));
    }
}
