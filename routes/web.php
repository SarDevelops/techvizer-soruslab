<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\CmsController;
use App\Http\Controllers\backend\TestController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\PackageController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\Frontend\DoctorController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\Frontend\HospitalController;
use App\Http\Controllers\Frontend\TestMenuController;
use App\Http\Controllers\backend\HealthConcernController;
use App\Http\Controllers\backend\RolePermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/////////////////////////////////////////
// Front-end Route with authentication //
/////////////////////////////////////////
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/test_show/{id}', [HomeController::class, 'test_show'])->name('home.test_show');
    Route::get('/package_show/{id}', [HomeController::class, 'package_show'])->name('home.package_show');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about_us.index');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospitals.index');
    Route::get('/test-menu', [TestMenuController::class, 'index'])->name('test_menu.index');
    Route::get('/select_package', [HomeController::class, 'select_package'])->name('select_package');
});

Route::get('/admin', function () {
    return redirect()->route('login');
});
// Route::get('/admin/dashboard', function () {
//     return view('backend.dashboard');
// });

////////////////////////////////////////
// Back-end Route with authentication //
////////////////////////////////////////
Route::name('admin.')->prefix('admin')->middleware(['auth:admin', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [BackendController::class, 'profile'])->name('profile');
    Route::post('profile', [BackendController::class, 'profile_update'])->name('profile.update');
    Route::post('change_password', [BackendController::class, 'change_password'])->name('change_password');


    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
        Route::post("/cache_clear", [SettingController::class, 'clear_cache'])->name('cache_clear');
    });

    Route::resource('users', UserController::class)->middleware(['can:user:view']);
    Route::post('user/is_active/{user}', [UserController::class, 'is_active'])->name('user.is_active');

    Route::resource('role_permissions', RolePermissionController::class)->middleware(['can:role_permission:view']);
    Route::post('role_permission/is_active/{role_permission}', [RolePermissionController::class, 'is_active'])->name('role_permission.is_active');

    // Tests Features
    Route::resource('/tests', TestController::class)->middleware(['can:test_report:view']);

    // Health Concern Features
    Route::resource('/health_concerns', HealthConcernController::class)->middleware(['can:health_concern:view']);

    // package Features
    Route::resource('/packages', PackageController::class)->middleware(['can:package:view']);


    // Route::get('activity_logs', [ActivityLogController::class, 'index'])->name('activity_logs');

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [CmsController::class, 'index'])->name('pages.index')->middleware(['can:cms_pages:view']);;
        Route::post('/update', [CmsController::class, 'update'])->name('pages.update')->middleware(['can:cms_pages:view']);;
        Route::get('/page', [CmsController::class, 'page'])->name('pages.home_page')->middleware(['can:cms_pages:view']);;
        Route::post('/page', [CmsController::class, 'store_cms'])->name('pages.store_cms')->middleware(['can:cms_pages:view']);;
    });
});

require __DIR__ . '/auth.php';
