<?php

/**
 * Debbug
 */
Route::get('debbug', "Portal\DebbugController@index");

/**
* Home
*/
Route::get('/{vue_capture?}', "Portal\Home\HomeController@index");

/**
 * Divida Route
 */
Route::post('divida', "Portal\Admin\AdminController@getDivida");

/**
 * Store Negotiation Routes
 */
Route::post('negociacao', "Portal\Admin\AdminController@storeNegociacao");

/**
 * Update Contact Routes
 */
Route::post('contato', "Portal\Admin\AdminController@updateContato");