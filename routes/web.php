<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\CustomerController;
use App\Http\Controllers\Office\PrincipalController;
use App\Http\Controllers\Office\CourierController;
use App\Http\Controllers\Office\QuatationController;
use App\Http\Controllers\Office\BrandController;
use App\Http\Controllers\Office\ReasonController;
use App\Http\Controllers\Office\UspController;
use App\Http\Controllers\Office\ProductParameter;


# Register
Route::get('register', [RegisterController::class, 'viewRegister'])->name('register');
Route::Post('register', [RegisterController::class, 'storeRegister'])->name('store.register');

# Auth Controller
Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('user-login', [AuthController::class, 'getLogin'])->name('get_login');

# Log Out
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

# Dashboard
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

# office 
# 1. Customer
Route::get('show-customer', [CustomerController::class, 'showCustomer'])->name('show_customer');
Route::post('store-customer', [CustomerController::class, 'storeCustomer'])->name('store_customer');
Route::get('get-customer', [CustomerController::class, 'getCustomer'])->name('get_customer');

# 2. Owner
Route::get('show-owner', [CustomerController::class, 'showOwner'])->name('show_owner');
Route::post('store-owner', [CustomerController::class, 'storeOwner'])->name('store_owner');
Route::get('get-owner', [CustomerController::class, 'getOwner'])->name('get_owner');

# 3. Principals
Route::get('show-principals', [PrincipalController::class, 'showPrincipal'])->name('show_principals');
Route::post('store-principals', [PrincipalController::class, 'storePrincipal'])->name('store_principals');
Route::get('get-principals', [PrincipalController::class, 'getPrincipal'])->name('get_principals');

# 4. Manage Courier
Route::get('show-courier', [CourierController::class, 'showCourier'])->name('show_courier');
Route::post('store-courier', [CourierController::class, 'storeCourier'])->name('store_courier');
Route::get('get-courier', [CourierController::class, 'getCourier'])->name('get_courier');

# 5. Quatation Format
Route::get('show-quatation', [QuatationController::class, 'showQuatation'])->name('show_quatation');
Route::post('store-quatation', [QuatationController::class, 'storeQuatation'])->name('store_quatation');
Route::get('get-quatation', [QuatationController::class, 'getQuatation'])->name('get_quatation');

# 6. Brand
Route::get('show-brand', [BrandController::class, 'showBrand'])->name('show_brand');
Route::post('store-brand', [BrandController::class, 'storeQuatation'])->name('store_brand');
Route::get('get-brand', [BrandController::class, 'getQuatation'])->name('get_brand');

# 7. Reason Format
Route::get('show-reason', [ReasonController::class, 'showReason'])->name('show_reason');
Route::post('store-reason', [ReasonController::class, 'storeReason'])->name('store_reason');
Route::get('get-reason', [ReasonController::class, 'getReason'])->name('get_reason');
Route::post('edit-reason/{id}',  [ReasonController::class, 'updateReason'])->name('edit_reason');
Route::post('delete-reason/{id}',  [ReasonController::class, 'deleteReason'])->name('delete_reason');

# 8. Usp
Route::get('show-usp', [UspController::class, 'showUsp'])->name('show_usp');
Route::post('store-usp', [UspController::class, 'storeUsp'])->name('store_usp');
Route::get('get-usp', [UspController::class, 'getUsp'])->name('get_usp');
Route::post('edit-usp/{id}',  [UspController::class, 'updateUsp'])->name('edit_usp');
Route::post('delete-usp/{id}',  [UspController::class, 'deleteUsp'])->name('delete_usp');

# 9. Product Parameter
Route::get('show-parameter', [ProductParameter::class, 'showParameter'])->name('show_parameter');
Route::post('store-parameter', [ProductParameter::class, 'storeParameter'])->name('store_parameter');
Route::get('get-parameter', [ProductParameter::class, 'getParameter'])->name('get_parameter');
Route::post('edit-parameter/{id}',  [ProductParameter::class, 'updateParameter'])->name('edit_parameter');
Route::post('delete-parameter/{id}',  [ProductParameter::class, 'deleteParameter'])->name('delete_parameter');



