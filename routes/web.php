<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Master\BrandController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\WarehouseController;
use App\Http\Controllers\Inventory\StockController;
use App\Http\Controllers\Purchase\SupplierController;
use App\Http\Controllers\Sales\CustomerController;
use App\Http\Controllers\Sales\SalesmanController;

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

/**
 * Main Page Route
 */
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    /**
     * Master Route
     */
    // Route::get('/master/units/get', [UnitController::class, 'getDataUnits'])->name('units.get');
    Route::resource('/master/units', UnitController::class);
    Route::resource('/master/categories', CategoryController::class);
    Route::resource('/master/brands', BrandController::class);
    Route::resource('/master/products', ProductController::class);
    Route::resource('/master/warehouses', WarehouseController::class);

    /**
     * Inventories Route
     */
    Route::resource('/inventories', StockController::class);

    /**
     * Purchases Route
     */
    Route::resource('/purchases/suppliers', SupplierController::class);
    Route::resource('/purchases/purchase-invoice', PurchaseInvoiceController::class);

    /**
     * Sales Route
     */
    Route::resource('/sales/salesmen', SalesmanController::class);
    Route::resource('/sales/customers', CustomerController::class);
    Route::resource('/sales/sales-invoice', SalesInvoiceController::class);
});

Auth::routes();