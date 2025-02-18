<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [inicioController::class, 'inicio'])->name('inicio');

// Ruta para mostrar la notificación de verificación de correo
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Ruta para manejar la verificación de correo
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Ruta para reenviar el enlace de verificación
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/* Rutas para páginas auxiliares */

Route::get('/nosotros', [inicioController::class, 'nosotros']);

/* Route::get('/productos', [ProductoController::class, 'productos']); */

Route::get('/recetas', [RecetaController::class, 'recetas']);

/* Productos */
Route::resource('productos', ProductoController::class)->names('productos');
/* Route::get('productos/{slug}', [ProductoController::class, 'show'])->name('productos.show'); */

/* Administración de productos */
Route::get('/AdminProducts', [inicioController::class, 'AdminProducts'])->name('adminProducts');

/* Carrito de compras */
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'removeProduct'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/revisar', [CartController::class, 'revisar'])->name('cart.revisar');
Route::get('/checkout/summary', [CartController::class, 'checkoutSummary'])->name('checkout.summary');
Route::post('/checkout/confirm', [CartController::class, 'confirmOrder'])->name('checkout.confirm');

/* Usuarios CRUD */
Route::resource('users', UserController::class)->names('users'); 
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::patch('users/{id}/edit', [UserController::class, 'update'])->name('users.update');
Route::get('users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/{id}/show', [UserController::class, 'show'])->name('users.show');


/* recetas */
Route::resource('/recetas', RecetaController::class)->names('recetas');

