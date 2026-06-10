<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogResourceDetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentsResourcesDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Ruta para videos estáticos (debe ir antes de las otras rutas)
Route::get('/videos/{filename}', function ($filename) {
    $path = public_path('videos/' . $filename);
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'video/mp4',
        ]);
    }
    abort(404);
})->where('filename', '.*');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');
Route::post('/solicitar-asesoria', [ContactController::class, 'storeAdvisory'])->name('advisory.store')->middleware('throttle:5,1');
Route::post('/validar-email-renovar', [ContactController::class, 'validateEmailForRenewal'])->name('validate-email.renewal')->middleware('throttle:10,1');
Route::post('/solicitar-nuevo-cliente', [ContactController::class, 'storeNewClient'])->name('new-client.store')->middleware('throttle:5,1');
Route::get('/servicios', [ServiceController::class, 'index'])->name('services');
Route::post('/solicitar-informacion-servicio', [ServiceController::class, 'sendInfo'])->name('service.info');
Route::get('/nosotros', [AboutController::class, 'index'])->name('about');
Route::get('/recursos', [ResourceController::class, 'index'])->name('resources');
Route::get('/blogs', [BlogResourceDetailController::class, 'index'])->name('blog.index');
Route::get('/recursos/descargables', [DocumentsResourcesDetailController::class, 'index'])->name('documents.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth', 'check.paid.plans'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.dashboard');
    Route::post('/renovar/servicios', [ContactController::class, 'getUserServices'])->name('renovar.services');
    Route::get('/pagos', [PaymentController::class, 'index'])->name('payments');
    Route::get('/planes', [PlanController::class, 'index'])->name('plans');
    Route::get('/carrito', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
    Route::get('/api/plans', [PlanController::class, 'getPlansApi'])->name('api.plans');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/payment-pdf/{paymentTypeId}', [CheckoutController::class, 'downloadPaymentPdf'])->name('checkout.payment-pdf');
    Route::get('/historial', [OrderController::class, 'index'])->name('orders.index');
    // Route::get('/perfil', [ProfileController::class, 'index'])->name('profile');
    // Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
