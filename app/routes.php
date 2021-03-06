<?php

/*
|--------------------------------------------------------------------------
| Application Rou//
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');
Route::pattern('name', '[a-z0-9_]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::get('/',array('as' => 'site-index','uses' => 'Noweb\\Frontend\\IndexController@index'));
Event::listen('illuminate.query', function($query)
{
    // var_dump($query);
});