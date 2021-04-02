<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\TrucksController;
use App\Http\Controllers\Merchant\TrucksSettingController;


# 1. Authentications & Login
Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('user-login', [AuthController::class, 'getLogin'])->name('get_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

# 2. Dashboard
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');


# **************** GrilledChili  route & functions **************

# 1. Truck
Route::get('show-trucks', [TrucksController::class, 'showTrucks'])->name('show_trucks');
Route::post('store-trucks', [TrucksController::class, 'storeTrucks'])->name('store_trucks');
Route::get('get-trucks', [TrucksController::class, 'getTrucks'])->name('get_trucks');
Route::post('edit-trucks/{id}',  [TrucksController::class, 'updateTrucks'])->name('edit_trucks');
Route::post('delete-trucks/{id}',  [TrucksController::class, 'deleteTrucks'])->name('delete_trucks');

# 2. Truck Setting
Route::get('show-trucks-setting', [TrucksSettingController::class, 'showTrucksSetting'])->name('show_trucks_setting');
Route::post('store-trucks-setting', [TrucksSettingController::class, 'storeTrucksSetting'])->name('store_trucks_setting');
Route::get('get-trucks-setting', [TrucksSettingController::class, 'getTrucksSetting'])->name('get_trucks_setting');
Route::post('edit-trucks-setting/{id}',  [TrucksSettingController::class, 'updateTrucksSetting'])->name('edit_trucks_setting');
Route::post('delete-trucks-setting/{id}',  [TrucksSettingController::class, 'deleteTrucksSetting'])->name('delete_trucks_setting');

