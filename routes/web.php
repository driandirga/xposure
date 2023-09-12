<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Master\BrandController;
use App\Http\Controllers\Master\CategoryController;

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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Route::get('/master/units/get', [UnitController::class, 'getDataUnits'])->name('units.get');
    Route::resource('/master/units', UnitController::class);
    Route::resource('/master/categories', CategoryController::class);
    Route::resource('/master/brands', BrandController::class);

    // Route::get('/master/units', [UnitController::class, 'index'])->name('units.index');
    // Route::post('/master/units', [UnitController::class, 'store'])->name('units.store');
    // Route::get('/master/unit/create', [UnitController::class, 'create'])->name('units.create');
    // Route::get('/master/unit/{id}/edit', [UnitController::class, 'edit'])->name('units.edit');
    // Route::put('/master/unit/{id}', [UnitController::class, 'update'])->name('units.update');
    // Route::post('/master/unit/delete', [UnitController::class, 'delete'])->name('units.delete');
});

Auth::routes();