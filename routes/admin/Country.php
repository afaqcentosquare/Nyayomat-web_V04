<?php

	Route::resource('city', 'CityController', ['except' => ['show']]);

	Route::delete('city/{city}/trash', 'CityController@trash')->name('city.trash'); // Blog post move to trash

	Route::get('city/{city}/restore', 'CityController@restore')->name('city.restore');
	
	
	Route::resource('region', 'RegionController', ['except' => ['show']]);

	Route::delete('region/{region}/trash', 'RegionController@trash')->name('region.trash'); // Blog post move to trash

	Route::get('region/{region}/restore', 'RegionController@restore')->name('region.restore');
	
		Route::resource('location', 'LocationController', ['except' => ['show']]);

	Route::delete('location/{location}/trash', 'LocationController@trash')->name('location.trash'); // Blog post move to trash

	Route::get('location/{location}/restore', 'LocationController@restore')->name('location.restore');
	
