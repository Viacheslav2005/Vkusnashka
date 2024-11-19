<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [MainController::class, 'index']) -> name('index');
Route::get('/menu', [MainController::class, 'menu']) -> name('menu');
Route::get('/find_us', [MainController::class, 'find_us']) -> name('find_us');
Route::get('/personal_account', [MainController::class, 'personal_account']) -> name('personal_account');
Route::get('/food', [MainController::class, 'food']) -> name('food');
Route::get('/food/{prod}', [MainController::class, 'food']) -> name('detail');

Route::get("/register", [AuthController::class, 'show_reg'])->name('show_reg');
Route::post("/register", [AuthController::class, 'signup'])->name('signup');
Route::get("/login", [AuthController::class, 'show_signin'])->name('show_signin');
Route::post("/login", [AuthController::class, 'signin'])->name('signin');
Route::get("/logout", [AuthController::class, 'logout'])->name('logout');



// Route::post('/food/{id_prod}', [UserController::class, 'add_basket'])->name('add_basket');

// Route::get('basket', [UserController::class, 'basket'])->name('basket');

// Route::get('/cart/add/{productId}', [UserController::class, 'addToCart'])->name('cart.add');

// Route::get('remove-from-cart/{id}', [UserController::class, 'removeFromCart'])->name('removeFromCart');
// Route::get('increase-quantity/{id}', [UserController::class, 'increaseQuantity'])->name('increaseQuantity');
// Route::get('decrease-quantity/{id}', [UserController::class, 'decreaseQuantity'])->name('decreaseQuantity');

// Route::post('/order/create', [UserController::class, 'create_order'])->name('order.create');

// Route::get('admin/admin', [AdminController::class, 'index']) -> name('admin');
// Route::get('admin/admin_edit/{prod}', [AdminController::class, 'edit']) -> name('admin_edit');
// Route::patch('admin/admin/{prod}', [AdminController::class, 'update']) -> name('admin_update');
// Route::get('admin/admin_delete/{prod}', [AdminController::class, 'delete']) -> name('admin_delete');
// Route::delete('admin/admin/{prod}', [AdminController::class, 'destroy']) -> name('admin_destroy');
// Route::get('admin/admin_add', [AdminController::class, 'create']) -> name('admin_add');
// Route::post('admin/admin', [AdminController::class, 'store']) -> name('admin_store');

// Route::get('admin/admin_order', [AdminController::class, 'admin_order']) -> name('admin_order');

// Route::get('admin_accept/{id_order}', [AdminController::class, 'admin_accept'])->name('admin_accept');
// Route::get('admin_reject/{id_order}', [AdminController::class, 'admin_reject'])->name('admin_reject');

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('admin/admin_edit/{prod}', [AdminController::class, 'edit'])->name('admin_edit');
    Route::patch('admin/admin/{prod}', [AdminController::class, 'update'])->name('admin_update');
    Route::get('admin/admin_delete/{prod}', [AdminController::class, 'delete'])->name('admin_delete');
    Route::delete('admin/admin/{prod}', [AdminController::class, 'destroy'])->name('admin_destroy');
    Route::get('admin/admin_add', [AdminController::class, 'create'])->name('admin_add');
    Route::post('admin/admin', [AdminController::class, 'store'])->name('admin_store');
    Route::get('admin/admin_order', [AdminController::class, 'admin_order'])->name('admin_order');
    Route::get('admin_accept/{id_order}', [AdminController::class, 'admin_accept'])->name('admin_accept');
    Route::get('admin_reject/{id_order}', [AdminController::class, 'admin_reject'])->name('admin_reject');
});

// Маршруты для покупок и оформления заказов - ограничены для администратора
Route::middleware(['role:user', 'role:user,restrictForRole:admin'])->group(function () {
    Route::post('/food/{id_prod}', [UserController::class, 'add_basket'])->name('add_basket');
    Route::get('basket', [UserController::class, 'basket'])->name('basket');
    Route::get('/cart/add/{productId}', [UserController::class, 'addToCart'])->name('cart.add');
    Route::get('remove-from-cart/{id}', [UserController::class, 'removeFromCart'])->name('removeFromCart');
    Route::get('increase-quantity/{id}', [UserController::class, 'increaseQuantity'])->name('increaseQuantity');
    Route::get('decrease-quantity/{id}', [UserController::class, 'decreaseQuantity'])->name('decreaseQuantity');
    Route::post('/order/create', [UserController::class, 'create_order'])->name('order.create');
});
