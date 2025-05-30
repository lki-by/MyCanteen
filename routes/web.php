<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/mycanteen', [MenuController::class, 'index'])->middleware('auth')->name('auth.mycanteen');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::prefix('admin')->group(function () {
    Route::get('/menus', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/menus/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/menus', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/menus/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/menus/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/menus/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{transaction}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{transaction}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
})->name('Admin')->middleware('auth');;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/mycanteen/add', [ChartController::class, 'addToCart'])->name('cart.add');
    Route::post('/mycanteen/update', [ChartController::class, 'updateCartItem'])->name('cart.update');
    Route::post('/mycanteen/remove', [ChartController::class, 'removeCartItem'])->name('cart.remove');
    Route::get('/mycanteen/items', [ChartController::class, 'getCartItems'])->name('cart.items'); // Diperbaiki dari mycanten ke mycanteen
    Route::get('/mycanteen/count', [ChartController::class, 'getCartCount'])->name('cart.count');
    Route::post('/checkout', [ChartController::class, 'processCheckout'])->name('checkout.process');
});

Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/orders', [\App\Http\Controllers\User\OrderController::class, 'index'])
        ->name('user.orders.index');
    Route::get('/orders/{transaction}', [\App\Http\Controllers\User\OrderController::class, 'show'])
        ->name('user.orders.show');
        Route::delete('/orders/{transaction}', [\App\Http\Controllers\User\OrderController::class, 'destroy'])->name('user.orders.destroy');
});


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mycanteen');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('mycanteen');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



