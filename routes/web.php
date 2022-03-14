<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Jetstream\User\AdminController;
use App\Http\Controllers\Jetstream\Village\VillageController;
use App\Http\Controllers\Jetstream\Dashboard\DashboardController;

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

Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);

    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'is-operator', 'verified'])->group(function () {

	Route::get('dashboard', DashboardController::class)->name('dashboard');
	
});

Route::middleware(['auth:sanctum', 'is-super-admin', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
	Route::resource('villages', VillageController::class);
});
