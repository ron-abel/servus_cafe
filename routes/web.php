<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PrintNodeController;
use App\Http\Controllers\Admin\SandwichController;
use App\Http\Controllers\Admin\ToppingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Superadmin\TenantController;
use Illuminate\Support\Facades\Route;

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


// Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::domain(config('app.superadmin') . '.' . config('app.domain'))->group(function () {
    Route::get('/invalid_tenant', function () {
        return view('404');
    })->name('invalid');
    Route::get('/',function(){
        return view('superadmin.login');
    })->name('admin.login');
    Route::get('/login',function(){
        return view('superadmin.login');
    })->name('admin.login');
    Route::group(['prefix' => 'admin'], function () {
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login_post');
        Route::get('/login',function(){
            return view('superadmin.login');
        })->name('admin.login');
        // Route::get('/login',function(){
        //     return view('superadmin.login');
        // });
        Route::middleware('superadminauth')->group(function () {
            Route::get('/',[TenantController::class,'index']);
                // Route::get('tenants', [TenantController::class,'index']);
                Route::get('tenants-create', [TenantController::class,'create'])->name('tenants.create');
                Route::get('tenants-edit/{id}', [TenantController::class,'edit']);
                Route::get('order', [TenantController::class,'order']);
                Route::post('tenant/edit-status/{tenant_id}', [TenantController::class,'editTenantActiveStatus']);
                Route::get('location', [TenantController::class,'location']);
                Route::get('get-locations', [TenantController::class,'getLocations']);
                Route::get('sandwich', [TenantController::class,'sandwich']);
                Route::get('topping', [TenantController::class,'topping']);
                Route::post('create-tenant', [TenantController::class,'store']);
            });
        });
        Route::get('tenants-create', [TenantController::class,'create'])->name('tenants.create');
        Route::post('create-tenant', [TenantController::class,'store']);
        
});
Route::domain('{subdomain}.' . config('app.domain'))->group(function () {
    Route::get('/invalid_tenant', function () {
        return view('404');
    })->name('invalid');
    Route::get('register_user', [ClientAuthController::class,'register_user'])->name('users.register');
    Route::post('register_user', [ClientAuthController::class,'post_register_user'])->name('user.register');
    Route::get('/login',[ClientAuthController::class,'login'])->name('admin.login');
    Route::get('/',[ClientAuthController::class,'login']);
    

    Route::group(['prefix' => 'admin'], function () {
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login_post');
        Route::get('/login',[AuthController::class,'login'])->name('admin.login');
        Route::get('/',[AuthController::class,'login'])->name('admin.login');
        Route::middleware('checktenant')->group(function () {
            Route::get('/',[AdminController::class,'index'])->middleware('adminauth');
            Route::get('/order',[AdminController::class,'order'])->middleware('adminauth');
            Route::get('/profile',[AdminController::class,'profile'])->middleware('adminauth');
            Route::get('/pickup_time',[LocationController::class,'index'])->middleware('adminauth');
            Route::get('/create-pickup_time',[LocationController::class,'create'])->middleware('adminauth');
            Route::get('/location-delete/{id}',[LocationController::class,'destroy'])->middleware('adminauth');
            Route::get('/location-edit/{id}',[LocationController::class,'edit'])->middleware('adminauth');
            Route::post('/location-update',[LocationController::class,'update'])->middleware('adminauth');
            Route::get('/sandwiches',[SandwichController::class,'index'])->middleware('adminauth');
            Route::get('/sandwich-edit/{id}',[SandwichController::class,'edit'])->middleware('adminauth');
            Route::get('/create-sandwich',[SandwichController::class,'create'])->middleware('adminauth');
            Route::post('/sandwich-update',[SandwichController::class,'update'])->middleware('adminauth');
            Route::get('/sandwich-delete/{id}',[SandwichController::class,'destroy'])->middleware('adminauth');
            Route::get('/toppings',[ToppingController::class,'index'])->middleware('adminauth');
            Route::get('/create-topping',[ToppingController::class,'create'])->middleware('adminauth');
            Route::get('/topping-edit/{id}',[ToppingController::class,'edit'])->middleware('adminauth');
            Route::post('/topping-update',[ToppingController::class,'update'])->middleware('adminauth');
            Route::get('/print-node',[PrintNodeController::class,'index'])->middleware('adminauth');
            Route::get('/create-print-node',[PrintNodeController::class,'create'])->middleware('adminauth');
            Route::get('/print-node-edit/{id}',[PrintNodeController::class,'edit'])->middleware('adminauth');
            Route::post('/print-node-update',[PrintNodeController::class,'update'])->middleware('adminauth');
            Route::get('/print-node-delete/{id}',[PrintNodeController::class,'destroy'])->middleware('adminauth');

        });
        // Route::get('/login',[AdminController::class,'index']);
       
    });
});
Route::group(['prefix' => 'student'], function () {
    Route::get('/',[ClientAuthController::class,'login']);
    Route::get('/login',[ClientAuthController::class,'login']);
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('student_login');
    Route::middleware('studentauth')->group(function () {
        Route::get('/',[OrderController::class,'index']);
        Route::get('/order',[OrderController::class,'create'])->name('order_form');
        Route::post('/order',[OrderController::class,'store'])->name('order_store');
        Route::get('/thanks',function(){
            return view('client.pages.thanks');
        });
    });
});
// Route::get('/order',function(){
//         return view('client.pages.order');
//     })->name('order_form');

require __DIR__.'/auth.php';
