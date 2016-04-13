<?php
/**
 * Created by syhung
 * User: syhung
 * Date: 11/21/14
 * Time: 10:23 AM
 * uses: Router for public package
 */
Route::get('/' ,array('as' => 'site-index', 'uses' => 'IndexController@index'));
