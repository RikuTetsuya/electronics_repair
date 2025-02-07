<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\FaqsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceInController;
use App\Http\Controllers\ServiceOutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerInputController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgotPasswordController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/sample', [SampleController::class, 'index']);
Route::get('/', [AuthController::class, 'landing']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);

Route::get('signup/panel/admin/ohdegwihdTYDFYWdggiUWguGgeugdgu', [AuthController::class, 'adminRegister']);
Route::post('signup/panel/admin/insert', [AuthController::class, 'adminRegisterStore']);

Route::get('signup', [AuthController::class, 'userRegister']);
Route::post('signup/insert', [AuthController::class, 'userRegisterStore']);


Route::get('logout', [AuthController::class, 'logout']);

// Route::get('forgot-password', [ForgotPasswordController::class, 'forgetPassword']);
// Route::post('forgot-password-act', [ForgotPasswordController::class, 'forgetPasswordPost']);
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);
// Route::post('reset-password', [ForgotPasswordController::class, 'resetPasswordPost']);

Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);

Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);



Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // admin list
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/deactivate/{id}', [AdminController::class, 'deactivate']);
    Route::get('admin/admin/activate/{id}', [AdminController::class, 'activate']);
    Route::post('/delete_admin/{id}', [AdminController::class, 'destroy']);

    // service list
    Route::get('admin/service/list', [ServiceController::class, 'index']);
    Route::get('admin/service/add', [ServiceController::class, 'create']);
    Route::post('admin/service/insert', [ServiceController::class, 'store']);
    Route::get('admin/service/edit/{id}', [ServiceController::class, 'edit']);
    Route::post('admin/service/update/{id}', [ServiceController::class, 'update']);
    Route::post('/delete_service/{id}', [ServiceController::class, 'destroy']);

    // mitra list
    Route::get('admin/mitra/list', [MitraController::class, 'index']);
    Route::get('admin/mitra/add', [MitraController::class, 'create']);
    Route::post('admin/mitra/insert', [MitraController::class, 'store']);
    Route::get('admin/mitra/edit/{id}', [MitraController::class, 'edit']);
    Route::post('admin/mitra/update/{id}', [MitraController::class, 'update']);
    Route::post('/delete_mitra/{id}', [MitraController::class, 'destroy']);

    // mitra list
    Route::get('admin/faq/list', [FaqsController::class, 'index']);
    Route::get('admin/faq/add', [FaqsController::class, 'create']);
    Route::post('admin/faq/insert', [FaqsController::class, 'store']);
    Route::get('admin/faq/edit/{id}', [FaqsController::class, 'edit']);
    Route::post('admin/faq/update/{id}', [FaqsController::class, 'update']);
    Route::post('/delete_faq/{id}', [FaqsController::class, 'destroy']);

    // report in list
    Route::get('admin/service_in/list', [ServiceInController::class, 'index']);
    Route::get('admin/service_in/edit/{id}', [ServiceInController::class, 'edit']);
    Route::post('admin/service_in/update/{id}', [ServiceInController::class, 'update']);
    Route::post('/delete_service_in/{id}', [ServiceInController::class, 'destroy']);

    // report out list
    Route::get('admin/service_out/list', [ServiceOutController::class, 'index']);

    // Route::get('/admin/service_out/{id}', [ServiceOutController::class, 'show']);
    Route::get('admin/service_out/add', [ServiceOutController::class, 'create']);
    Route::post('admin/service_out/store/', [ServiceOutController::class, 'store']);
    Route::get('admin/service_out/edit/{id}', [ServiceOutController::class, 'edit']);
    Route::post('admin/service_out/update/{id}', [ServiceOutController::class, 'update']);
    Route::post('/delete_service_out/{id}', [ServiceOutController::class, 'destroy']);

    // report index
    Route::get('admin/report', [ReportController::class, 'index']);

    // customer page (sample)
    Route::get('admin/customer/', [CustomerInputController::class, 'index']);
});

Route::group(['middleware' => 'customer'], function () {
    Route::get('customer/main/', [CustomerInputController::class, 'main']);
    Route::post('customer/main/rating/store', [CustomerInputController::class, 'storeRating']);
    // Route::get('customer/order', [CustomerController::class, 'index']);
    // Route::post('customer/order/store', [CustomerController::class, 'store']);

    Route::get('customer/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('customer/order', [CustomerInputController::class, 'index']);

    Route::get('customer/checkout/{id}', [CheckoutController::class, 'checkout']);
    Route::get('customer/detail/{id}', [CheckoutController::class, 'details']);
    Route::get('customer/invoice/{id}', [CheckoutController::class, 'invoice']);

    Route::get('customer/order/add', [CustomerInputController::class, 'create']);
    Route::post('customer/order/store', [CustomerInputController::class, 'store']);

    Route::get('customer/order/edit/{id}', [CustomerInputController::class, 'edit']);
    Route::put('customer/order/update/{id}', [CustomerInputController::class, 'update']);

    Route::post('/delete_order/{id}', [CustomerInputController::class, 'destroy']);
    // Route::get('customer/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    // Rute untuk menampilkan form edit profil
    Route::middleware('auth')->get('customer/profile/', [CustomerInputController::class, 'accInfo']);

    // Rute untuk memproses perubahan profil (termasuk gambar)
    Route::middleware('auth')->post('customer/profile/upload-picture', [CustomerInputController::class, 'updateProfilePic']);
    Route::middleware('auth')->post('customer/profile/update', [CustomerInputController::class, 'updateaccInfo']);
    Route::post('customer/profile/change-password', [CustomerInputController::class, 'changePassword']);
    Route::middleware('auth')->post('customer/profile/delete-picture', [CustomerInputController::class, 'deleteProfilePic']);
});

Route::group(['middleware' => 'administrator'], function () {

    Route::get('administrator/dashboard', [DashboardController::class, 'dashboard']);

    // service list
    Route::get('administrator/service/list', [ServiceController::class, 'index']);
    Route::get('administrator/service/add', [ServiceController::class, 'create']);
    Route::post('administrator/service/insert', [ServiceController::class, 'store']);
    Route::get('administrator/service/edit/{id}', [ServiceController::class, 'edit']);
    Route::post('administrator/service/update/{id}', [ServiceController::class, 'update']);
    Route::post('/delete_service/{id}', [ServiceController::class, 'destroy']);

    // report in list
    Route::get('administrator/service_in/list', [ServiceInController::class, 'index']);
    Route::get('administrator/service_in/edit/{id}', [ServiceInController::class, 'edit']);
    Route::post('administrator/service_in/update/{id}', [ServiceInController::class, 'update']);
    Route::post('/delete_service_in/{id}', [ServiceInController::class, 'destroy']);

    // report out list
    Route::get('administrator/service_out/list', [ServiceOutController::class, 'index']);
    // Route::get('/administrator/service_out/{id}', [ServiceOutController::class, 'show']);
    Route::get('administrator/service_out/add', [ServiceOutController::class, 'create']);
    Route::post('administrator/service_out/store/', [ServiceOutController::class, 'store']);
    Route::get('administrator/service_out/edit/{id}', [ServiceOutController::class, 'edit']);
    Route::post('administrator/service_out/update/{id}', [ServiceOutController::class, 'update']);
    Route::post('/delete_service_out/{id}', [ServiceOutController::class, 'destroy']);

    // report index
    Route::get('administrator/report', [ReportController::class, 'index']);

    // customer page (sample)
    Route::get('administrator/customer/', [CustomerInputController::class, 'index']);
});
