<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Web\Admin\CategoriesController;
use App\Http\Controllers\Web\Admin\NotificationController;
use App\Http\Controllers\Web\Admin\PagesController;
use App\Http\Controllers\Web\Admin\ProfileController as ProfileAdminController;
use App\Http\Controllers\Web\Admin\WalletController;
use App\Http\Controllers\Web\Admin\AdminsController;

use App\Http\Controllers\Web\Admin\SettingsController as SettingsAdminController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Admin\InvestmentsController;
use App\Http\Controllers\Web\Admin\AccountsController;
use App\Http\Controllers\Web\Admin\CardsController;
use App\Http\Controllers\Web\Admin\PaymentsController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Admin

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
Route::get('/test-locale', function () {
    App::setLocale('ar');

    return App::getLocale().' - '.__('permissions.home');
});
// Route::get('/', [HomeController::class, 'index'])->name('website');
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest:admin,restaurant')->group(function () {
    Route::get('/admin-panel/login', [LoginController::class, 'showLoginAdmin'])->name('auth.admin.login');
    Route::post('/admin/login', [LoginController::class, 'loginAdmin'])->name('Admin.login');
    Route::get('/admin-panel/register', [RegisterController::class, 'show'])->name('auth.admin.register');
    Route::post('/admin/register', [RegisterController::class, 'store'])->name('Admin.register');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('valex', function () {
    return view('dashboard.index');
});

// ////// Dashboard Admin //////////
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin-panel', 'as' => 'admin.'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [\App\Http\Controllers\Web\Admin\HomeController::class, 'index'])->name('dashboard');
    // profile
    Route::get('/profile', [ProfileAdminController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileAdminController::class, 'update'])->name('profile.update');
    // حسابي البنكي
    Route::get('/bank-account', [ProfileAdminController::class, 'showBankAccount'])->name('bank-account.show');

    // المشرفين
    Route::resource('admins', AdminsController::class);
    Route::get('admins/updateStatus/{id}', [AdminsController::class, 'updateStatus'])->name('admins.updateStatus');

    // الحسابات
    Route::resource('accounts', AccountsController::class);
    // الاستثمارات
    Route::resource('investments', InvestmentsController::class);

    // المدفوعات
    Route::resource('payments', PaymentsController::class);

    // البطاقات
    Route::resource('cards', CardsController::class);

    // التحويلات
    Route::post('transfer', [WalletController::class, 'transfer'])->name('transfer');

});


