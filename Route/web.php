<?php
// Replace 'DomainController' with your actual controller name

// Routes for Views
Route::group(['middleware' => ['auth']], function () {
    Route::get('/domain', 'DomainController@index');
    Route::post('/domain/user_domain_renew', 'DomainController@userDomainRenew');
    Route::get('/domain/user_domain_payment', 'DomainController@userDomainPayment');

});
