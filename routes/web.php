<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\CustomerController;
use App\Http\Controllers\Office\PrincipalController;
use App\Http\Controllers\Office\CourierController;
use App\Http\Controllers\Office\QuatationFormatController;
use App\Http\Controllers\Office\QuatationController;
use App\Http\Controllers\Office\BrandController;
use App\Http\Controllers\Office\ReasonController;
use App\Http\Controllers\Office\UspController;
use App\Http\Controllers\Office\ProductParameter;
use App\Http\Controllers\Office\CategoryController;
use App\Http\Controllers\Office\ProductController;
use App\Http\Controllers\Office\NotifyController;

# 1. User
Route::get('show-user', [AuthController::class, 'showUser'])->name('show_user');
Route::get('create-user', [AuthController::class, 'addUser'])->name('add_user');
Route::get('get-user', [AuthController::class, 'getUser'])->name('get_user');
Route::post('store-user', [AuthController::class, 'storeUser'])->name('store_user');
Route::get('edit-user/{id}',  [AuthController::class, 'updateUser'])->name('edit_user');
Route::post('store-updated-user', [AuthController::class, 'storeUserUpdate'])->name('store_updated_user');
Route::post('delete-user/{id}',  [AuthController::class, 'deleteUser'])->name('delete_user');

# 3. Authentications & Login
Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('user-login', [AuthController::class, 'getLogin'])->name('get_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

# 4. Dashboard
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');


# **************** Office route & functions **************

# 1. Customer
Route::get('show-customer', [CustomerController::class, 'showCustomer'])->name('show_customer');
Route::post('store-customer', [CustomerController::class, 'storeCustomer'])->name('store_customer');
Route::get('get-customer', [CustomerController::class, 'getCustomer'])->name('get_customer');
Route::post('edit-customer/{id}',  [CustomerController::class, 'updateCustomer'])->name('edit_customer');
Route::post('delete-customer/{id}',  [CustomerController::class, 'deleteCustomer'])->name('delete_customer');

# 2. Owner
Route::get('show-owner', [CustomerController::class, 'showOwner'])->name('show_owner');
Route::post('store-owner', [CustomerController::class, 'storeOwner'])->name('store_owner');
Route::get('get-owner', [CustomerController::class, 'getOwner'])->name('get_owner');
Route::post('edit-owner/{id}',  [CustomerController::class, 'updateOwner'])->name('edit_owner');
Route::post('delete-owner/{id}',  [CustomerController::class, 'deleteOwner'])->name('delete_owner');


# 3. Principals
Route::get('show-principals', [PrincipalController::class, 'showPrincipal'])->name('show_principals');
Route::post('store-principals', [PrincipalController::class, 'storePrincipal'])->name('store_principals');
Route::get('get-principals', [PrincipalController::class, 'getPrincipal'])->name('get_principals');
Route::post('edit-principals/{id}',  [PrincipalController::class, 'updatePrincipals'])->name('edit_principals');
Route::post('delete-principals/{id}',  [PrincipalController::class, 'deletePrincipals'])->name('delete_principals');

# 4. Manage Courier
Route::get('show-courier', [CourierController::class, 'showCourier'])->name('show_courier');
Route::post('store-courier', [CourierController::class, 'storeCourier'])->name('store_courier');
Route::get('get-courier', [CourierController::class, 'getCourier'])->name('get_courier');
Route::post('edit-courier/{id}',  [CourierController::class, 'updateCourier'])->name('edit_courier');
Route::post('delete-courier/{id}',  [CourierController::class, 'deleteCourier'])->name('delete_courier');


# 5. Quatation Format
Route::get('show-quatation-format', [QuatationFormatController::class, 'showQuatationFormat'])->name('show_quatation_format');
Route::post('store-quatation-format', [QuatationFormatController::class, 'storeQuatationFormat'])->name('store_quatation_format');
Route::get('get-quatation-format', [QuatationFormatController::class, 'getQuatationFormat'])->name('get_quatation_format');
Route::post('edit-quatation-format/{id}',  [QuatationFormatController::class, 'updateQuatationFormat'])->name('edit_quatation_format');
Route::post('delete-quatation-format/{id}',  [QuatationFormatController::class, 'deleteQuatationFormat'])->name('delete_quatation_format');

# 6. Brand
Route::get('show-brand', [BrandController::class, 'showBrand'])->name('show_brand');
Route::post('store-brand', [BrandController::class, 'storeBrand'])->name('store_brand');
Route::get('get-brand', [BrandController::class, 'getBrand'])->name('get_brand');
Route::post('edit-brand/{id}',  [BrandController::class, 'updateBrand'])->name('edit_brand');
Route::post('delete-brand/{id}',  [BrandController::class, 'deleteBrand'])->name('delete_brand');


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

# 10. Category 
Route::get('show-category', [CategoryController::class, 'showCategory'])->name('show_category');
Route::post('store-category', [CategoryController::class, 'storeCategory'])->name('store_category');
Route::get('get-category', [CategoryController::class, 'getCategory'])->name('get_category');
Route::post('edit-category/{id}',  [CategoryController::class, 'updateCategory'])->name('edit_category');
Route::post('delete-category/{id}',  [CategoryController::class, 'deleteCategory'])->name('delete_category');

# 11. Product 
Route::get('show-product', [ProductController::class, 'showProduct'])->name('show_product');
Route::get('add-product', [ProductController::class, 'addProduct'])->name('add_product');
Route::post('store-product', [ProductController::class, 'storeProduct'])->name('store_product');
Route::get('get-product', [ProductController::class, 'getProduct'])->name('get_product');
Route::get('edit-product/{id}',  [ProductController::class, 'updateProduct'])->name('edit_product');
Route::post('update-product/{id}',  [ProductController::class, 'storeUpdateProduct'])->name('store_update_product');
Route::post('delete-product/{id}',  [ProductController::class, 'deleteProduct'])->name('delete_product');

# 12. Quatation
Route::get('show-quatation', [QuatationController::class, 'showQuatation'])->name('show_quatation');
Route::get('add-quatation', [QuatationController::class, 'addQuatation'])->name('add_quatation');
Route::post('store-quatation', [QuatationController::class, 'storeQuatation'])->name('store_quatation');
Route::get('get-quatation', [QuatationController::class, 'getQuatation'])->name('get_quatation');
Route::get('all-product', [QuatationController::class, 'allProduct'])->name('all_product');
Route::post('filter-product', [QuatationController::class, 'filterProduct'])->name('get_filter_product');
Route::get('preview-quatation', [QuatationController::class, 'previewQuatation'])->name('preview_quatation');
Route::get('edit-quatation/{id}',  [QuatationController::class, 'updateQuatation'])->name('edit_quatation');
Route::post('store-update-quatation', [QuatationController::class, 'storeUpdateQuatation'])->name('store_update_quatation');
Route::post('delete-quatation/{id}',  [QuatationController::class, 'deleteQuatation'])->name('delete_quatation');

# 13. Notification
Route::get('show-notify', [NotifyController::class, 'showNotify'])->name('show_notify');
Route::post('store-notify', [NotifyController::class, 'storeNotify'])->name('store_notify');
Route::get('get-notify', [NotifyController::class, 'getNotify'])->name('get_notify');
Route::post('edit-notify/{id}',  [NotifyController::class, 'updateNotify'])->name('edit_notify');
Route::post('delete-notify/{id}',  [NotifyController::class, 'deleteNotify'])->name('delete_notify');

# 14. Order
Route::get('show-order', [QuatationController::class, 'showOrder'])->name('show_order');
// Route::get('add-quatation', [QuatationController::class, 'addQuatation'])->name('add_quatation');
// Route::post('store-quatation', [QuatationController::class, 'storeQuatation'])->name('store_quatation');
// Route::get('get-quatation', [QuatationController::class, 'getQuatation'])->name('get_quatation');
// Route::get('all-product', [QuatationController::class, 'allProduct'])->name('all_product');
// Route::post('filter-product', [QuatationController::class, 'filterProduct'])->name('get_filter_product');
// Route::get('preview-quatation', [QuatationController::class, 'previewQuatation'])->name('preview_quatation');
// Route::get('edit-quatation/{id}',  [QuatationController::class, 'updateQuatation'])->name('edit_quatation');
// Route::post('store-update-quatation', [QuatationController::class, 'storeUpdateQuatation'])->name('store_update_quatation');
// Route::post('delete-quatation/{id}',  [QuatationController::class, 'deleteQuatation'])->name('delete_quatation');
