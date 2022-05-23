<?php
    Route::post('addToCart/{slug}', 'CartController@addToCart')->name('cart.addItem')->middleware(['ajax']);
    Route::post('coupon/validate', 'CartController@validateCoupon')->name('validate.coupon')->middleware(['auth:customer', 'ajax']);
    Route::post('cart/removeItem', 'CartController@remove')->name('cart.removeItem')->middleware(['ajax']);
    Route::post('checkout-all', 'CartController@checkoutAllCart')->name('cart.checkout_all');
    Route::get('cart/{expressId?}', 'CartController@index')->name('cart.index');
    Route::put('cart/{cart}', 'CartController@update')->name('cart.update');
    Route::get('cart/{cart}/checkout', 'CartController@checkout')->name('cart.checkout');
    Route::get('cartempty', 'CartController@empty')->name('emptycart');
    Route::get('checkout/{slug}', 'CartController@directCheckout')->name('direct.checkout');
