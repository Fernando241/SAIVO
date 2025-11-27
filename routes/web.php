<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ProveedorController;
use App\Models\Proveedor;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Livewire\ResumenContable\Index;
use Illuminate\Support\Facades\Mail;

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
        /* return view('dashboard'); */
        return redirect()->route('misDatos');
    })->name('dashboard');
});

/* Rutas para páginas auxiliares */

Route::get('/nosotros', [inicioController::class, 'nosotros'])->name('nosotros');

/* Route::get('/productos', [ProductoController::class, 'productos']); */

Route::get('/recetas', [RecetaController::class, 'recetas'])->name('recetas');

/* Productos */
Route::resource('productos', ProductoController::class)->names('productos');

/* Administración de productos */
Route::get('/adminProducts', [ProductoController::class, 'adminProducts'])->name('adminProducts');

/* promedios */
Route::get('/adminDashboard', [ProductoController::class, 'adminDashboard'])->Middleware('can:adminDashboard')->name('adminDashboard');

/* mis datos -> dashboard */
Route::get('/misDatos', [inicioController::class, 'misDatos'])->name('misDatos');

/* proveedores */
Route::resource('proveedores', ProveedorController::class)->names('proveedores');

/* gastos */
Route::resource('gastos', GastoController::class)->names('gastos');


/* Carrito de compras */
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'removeProduct'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/AddDatasClient', [CartController::class, 'AddDatasClient'])->name('cart.AddDatasClient');
Route::post('/cart/SaveDatasClient', [CartController::class, 'SaveDatasClient'])->name('cart.SaveDatasClient');
Route::get('/cart/displayOrderData', [CartController::class, 'displayOrderData'])->name('cart.displayOrderData');
Route::post('/procesar-pedido', [CartController::class, 'procesarPedido'])->name('cart.procesarPedido');
/* temporal para crear pedido -> luego en boton de PayPal */
Route::post('/cart/crear/-pedido', [CartController::class, 'crearPedido'])->name('cart.crearPedido');

/* Ruta temporal para desviar pagos mientras PayPal empieza a funcionar */
Route::get('/pagos-temporales', [CartController::class, 'pagosTemporales'])->name('cart.pagosTemporales');


/* Usuarios*/
Route::get('users', [UserController::class, 'index'])->middleware('can:users.index')->name('users.index');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('can:users.edit')->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

/* Clientes */
Route::resource('/clientes', ClienteController::class)->only(['index', 'show', 'edit', 'update'])->names('clientes');

/* Pedidos */
Route::resource('/pedidos', PedidoController::class)->only(['index', 'store', 'show', 'update'])->names('pedidos');

/* recetas */
Route::resource('/recetas', RecetaController::class)->names('recetas');

/* Prueba para envio de correos con Zoho Mail */
Route::get('/test-zoho', function () {
    try {
        Mail::raw('Este es un correo de prueba enviado desde Zoho Mail por Naturaleza Sagrada.', function ($message) {
            $message->to('fhernatural@gmail.com')
                    ->subject('Prueba de envío Zoho Mail ✅');
        });
        return 'Correo enviado correctamente ✅';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});