<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/* 
*  User Website Route 
*/

Route::prefix('website')->group(function () {
    Route::get('plans', [SubscriptionController::class, 'plans'])->name('subscription.plan');
    Route::post('checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::post('subscribe', [SubscriptionController::class, 'createSubscription'])->name('subscription.subscribe');
    Route::get('subscribe-success', [SubscriptionController::class, 'subscribeSuccess'])->name('subscription.success');

});


Route::resource('users', UserController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('features', FeatureController::class);

Route::prefix('stripe')->group(function () {
    Route::get('/', [StripeController::class, 'index']);
    Route::get('create-customer', [StripeController::class, 'createCustomer']);
    Route::get('retrieve-customer', [StripeController::class, 'retrieveCustomer']);
    Route::get('balance-customer', [StripeController::class, 'balanceCustomer']);
    Route::get('billing-portal', [StripeController::class, 'redirectToBillingPortal']);

});

require __DIR__.'/auth.php';
