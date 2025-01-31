<?php
// Replace 'DomainController' with your actual controller name

use Illuminate\Support\Facades\Route;
use Modules\Domain\Http\Controllers\DomainController;

// Routes for Views
Route::group(['middleware' => ['auth']], function () {
    Route::get('/domain', [DomainController::class, 'index']);
    Route::post('/domain/user_domain_renew', [DomainController::class, 'userDomainRenew']);
    Route::get('/domain/user_domain_payment', [DomainController::class, 'userDomainPayment']);

});
