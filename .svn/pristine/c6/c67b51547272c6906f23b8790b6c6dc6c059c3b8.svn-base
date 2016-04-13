<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 06/12/2014
 * Time: 9:08 SA
 */
Route::get('/', ['as' => 'site-index', 'uses' => 'Noweb\\Frontend\\IndexController@index']);
/** Product */
Route::get('/product/cate/{slug}_{page}.html', ['as' => 'product-cate', 'uses' => 'Noweb\\Frontend\\ProductController@cate']);
Route::get('/product/cate/{slug}.html', ['as' => 'product-cate', 'uses' => 'Noweb\\Frontend\\ProductController@cate']);
Route::get('/product/{slug}_{id}.html', ['as' => 'product-details', 'uses' => 'Noweb\\Frontend\\ProductController@details']);
/** News */
Route::get('/news/cate/{slug}.html', ['as' => 'news-cate', 'uses' => 'Noweb\\Frontend\\NewsController@cate']);
Route::get('/news/cate/{slug}_{page}.html', ['as' => 'news-cate', 'uses' => 'Noweb\\Frontend\\NewsController@cate']);
Route::get('/{slug}.html', ['as' => 'category-index', 'uses' => 'Noweb\\Frontend\\CategoryController@index']);
Route::get('/{slug}_{page}.html', ['as' => 'category-index', 'uses' => 'Noweb\\Frontend\\CategoryController@index']);
Route::get('/news/{slug}_{id}.html', ['as' => 'news-details', 'uses' => 'Noweb\\Frontend\\NewsController@details']);