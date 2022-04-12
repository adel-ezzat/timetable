<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
'register' => false,
'reset' => false, 
'verify' => false, 
]);

//home route
Route::get('/', function () {
    return view('auth.login');
});

// dashboard routes
Route::resource('dashboard', DashboardController::class);

// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
        Route::post('/update', [AdminController::class, 'update'])->name('update-ajax');
        Route::post('/destroy', [AdminController::class, 'destroy'])->name('destroy-ajax');
});
Route::resource('admin', AdminController::class);

// user routes
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::post('update', [UserController::class, 'update'])->name('update-ajax');
    Route::post('destroy', [UserController::class, 'destroy'])->name('destroy-ajax');
});
Route::resource('user', UserController::class);
    
// roles & permissions routes
Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
    Route::post('update', [RoleController::class, 'update'])->name('update-ajax');
    Route::post('destroy', [RoleController::class, 'destroy'])->name('destroy-ajax');
});
Route::resource('role', RoleController::class);

// pharmacies routes
Route::group(['prefix' => 'pharmacy', 'as' => 'pharmacy.'], function () {
    Route::post('update', [PharmacyController::class, 'update'])->name('update-ajax');
    Route::post('destroy', [PharmacyController::class, 'destroy'])->name('destroy-ajax');
});
Route::resource('pharmacy', PharmacyController::class);

// timetable routes
Route::group(['prefix' => 'timetable', 'as' => 'timetable.'], function () {
    Route::post('generate-dates-range', [TimetableController::class, 'getDatesRange'])->name('generate-dates-range');
    Route::post('generate-time-table', [TimetableController::class, 'generateTimeTable'])->name('generate-time-table');
});
Route::resource('timetable', TimetableController::class);

// user timetable home routes
Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
    Route::get('/', [TimetableController::class, 'userHome'])->name('index');
    Route::post('/generate-dates-range', [TimetableController::class, 'getDatesRange'])->name('generate-dates-range');
    Route::post('/generate-time-table', [TimetableController::class, 'generateTimeTable'])->name('generate-time-table');
});


