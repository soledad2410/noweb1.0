<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 06/12/2014
 * Time: 9:08 SA
 */

/** Package router index site */

Route::group(array('before' => 'domain'), function () {
	/** Package routing cp */
	Route::post('/cp/login', array('as' => 'cp-login', 'uses' => 'Noweb\\Cp\\IndexController@ajaxLogin'));
	Route::get('/cp', array('as' => 'login-page', 'uses' => 'Noweb\\Cp\\IndexController@index'));
	Route::group(array('before' => 'admin'), function () {
		/** Cache */
		Route::post('/cp/caching/{name}', array('as' => 'cp-caching-push', 'uses' => 'Noweb\\Cp\\CachingController@push'));
		/** Error route handle */
		Route::post('/cp/logout', array('as' => 'cp-logout', 'uses' => 'Noweb\\Cp\\IndexController@ajaxLogout'));
		Route::get('/cp/403', array('as' => 'cp-403', 'uses' => 'Noweb\\Cp\\ErrorController@ForbiddenAccess'));
		Route::get('/cp/404', array('as' => 'cp-404', 'uses' => 'Noweb\\Cp\\ErrorController@NotFound'));
		Route::get('/cp/dashboard', array('as' => 'cp-dashboard', 'uses' => 'Noweb\\Cp\\IndexController@dashboard'));
		/** News */
		Route::get('/cp/news', array('as' => 'cp-news', 'uses' => 'Noweb\\Cp\\NewsController@index'));
		Route::post('/cp/news/create', array('as' => 'cp-news-create', 'uses' => 'Noweb\\Cp\\NewsController@create'));
		Route::post('/cp/news/get/{id}', array('as' => 'cp-news-get', 'uses' => 'Noweb\\Cp\\NewsController@get'));
		Route::get('/cp/news/get', array('as' => 'cp-news-get', 'uses' => 'Noweb\\Cp\\NewsController@get'));
		Route::any('/cp/news/edit', array('as' => 'cp-news-edit', 'uses' => 'Noweb\\Cp\\NewsController@edit'));
		Route::any('/cp/news/edit/{id}', array('as' => 'cp-news-edit', 'uses' => 'Noweb\\Cp\\NewsController@edit'));
		Route::post('/cp/news/delete', array('as' => 'cp-news-delete', 'uses' => 'Noweb\\Cp\\NewsController@delete'));
		Route::get('/cp/news/category', ['as' => 'cp-news-category', 'uses' => 'Noweb\\Cp\\NewsController@category']);
		Route::get('/cp/news/comments', ['as' => 'cp-news-comments', 'uses' => 'Noweb\\Cp\\NewsController@comments']);
		Route::post('/cp/news/edit-comment', ['as' => 'cp-news-edit-comment', 'uses' => 'Noweb\\Cp\\NewsController@editComment']);
		Route::post('/cp/news/edit-comment/{id}', ['as' => 'cp-news-edit-comment', 'uses' => 'Noweb\\Cp\\NewsController@editComment']);
		Route::post('/cp/news/get-comment', ['as' => 'cp-news-get-comment', 'uses' => 'Noweb\\Cp\\NewsController@getComment']);
		Route::post('/cp/news/delete-comment', ['as' => 'cp-news-delete-comment', 'uses' => 'Noweb\\Cp\\NewsController@deleteComment']);
		Route::post('/cp/news/save-comment', ['as' => 'cp-news-save-comment', 'uses' => 'Noweb\\Cp\\NewsController@saveComment']);
		/** Product */
		Route::get('/cp/product', array('as' => 'cp-product', 'uses' => 'Noweb\\Cp\\ProductController@index'));
		Route::get('/cp/product/create', array('as' => 'cp-product-create', 'uses' => 'Noweb\\Cp\\ProductController@create'));
		Route::post('/cp/product/get', array('as' => 'cp-product-get', 'uses' => 'Noweb\\Cp\\ProductController@get'));
		Route::post('/cp/product/create', array('as' => 'cp-product-create', 'uses' => 'Noweb\\Cp\\ProductController@create'));
		Route::post('/cp/product/edit/{id}', array('as' => 'cp-product-edit', 'uses' => 'Noweb\\Cp\\ProductController@edit'));
		Route::get('/cp/product/edit/{id}', array('as' => 'cp-product-edit', 'uses' => 'Noweb\\Cp\\ProductController@edit'));
		Route::post('/cp/product/delete', array('as' => 'cp-product-delete', 'uses' => 'Noweb\\Cp\\ProductController@delete'));
		Route::get('/cp/product/review', array('as' => 'cp-product-review', 'uses' => 'Noweb\\Cp\\ProductController@review'));
		Route::post('/cp/product/get-review/{pid}', array('as' => 'cp-product-get-review', 'uses' => 'Noweb\\Cp\\ProductController@getReview'));
		Route::post('/cp/product/save-review/{id}', array('as' => 'cp-product-get-review', 'uses' => 'Noweb\\Cp\\ProductController@saveReview'));
		Route::post('/cp/product/delete-review', array('as' => 'cp-product-delete-review', 'uses' => 'Noweb\\Cp\\ProductController@deleteReview'));
		/** Gallery **/
		Route::get('/cp/gallery', array('as' => 'cp-gallery', 'uses' => 'Noweb\\Cp\\GalleryController@index'));
		Route::post('/cp/gallery/create', array('as' => 'cp-gallery-create', 'uses' => 'Noweb\\Cp\\GalleryController@create'));
		Route::post('/cp/gallery/edit/{id}', array('as' => 'cp-gallery-edit', 'uses' => 'Noweb\\Cp\\GalleryController@edit'));
		Route::post('/cp/gallery/delete', array('as' => 'cp-gallery-delete', 'uses' => 'Noweb\\Cp\\GalleryController@delete'));
		Route::post('/cp/gallery/get', ['as' => 'cp-gallery-get', 'uses' => 'Noweb\\Cp\\GalleryController@get']);
		Route::post('/cp/gallery/save-order', ['as' => 'cp-gallery-save-order', 'uses' => 'Noweb\\Cp\\GalleryController@saveOrder']);
		Route::get('/cp/gallery/album/{id}', ['as' => 'cp-gallery-album', 'uses' => 'Noweb\\Cp\\GalleryController@album']);
		Route::post('/cp/gallery/add-media', ['as' => 'cp-gallery-add-media', 'uses' => 'Noweb\\Cp\\GalleryController@addMedia']);
		Route::post('/cp/gallery/get-media', ['as' => 'cp-gallery-get-media', 'uses' => 'Noweb\\Cp\\GalleryController@getMedia']);
		Route::post('/cp/gallery/save-media', ['as' => 'cp-gallery-save-media', 'uses' => 'Noweb\\Cp\\GalleryController@saveMedia']);
		Route::post('/cp/gallery/delete-media', ['as' => 'cp-gallery-delete-media', 'uses' => 'Noweb\\Cp\\GalleryController@deletemedia']);
		/** Category */
		Route::get('/cp/category', ['as' => 'cp-category', 'uses' => 'Noweb\\Cp\\CategoryController@index']);
		Route::get('/cp/category/edit', ['as' => 'cp-category-edit', 'uses' => 'Noweb\\Cp\\CategoryController@edit']);
		Route::get('/cp/category/edit/{id}', ['as' => 'cp-category-edit', 'uses' => 'Noweb\\Cp\\CategoryController@edit']);
		Route::post('/cp/category/edit/{id}', ['as' => 'cp-category-edit', 'uses' => 'Noweb\\Cp\\CategoryController@edit']);
		Route::post('/cp/category/create', ['as' => 'cp-category-create', 'uses' => 'Noweb\\Cp\\CategoryController@create']);
		Route::post('/cp/category/get', ['as' => 'cp-category-get', 'uses' => 'Noweb\\Cp\\CategoryController@get']);
		Route::post('/cp/category/get/{id}', ['as' => 'cp-category-get', 'uses' => 'Noweb\\Cp\\CategoryController@get']);
		Route::post('/cp/category/delete', ['as' => 'cp-delete-category', 'uses' => 'Noweb\\Cp\\CategoryController@delete']);
		Route::post('/cp/category/save-order', ['as' => 'cp-category-save-order', 'uses' => 'Noweb\\Cp\\CategoryController@saveOrder']);
		/** Setting */
		Route::post('/cp/setting/switchlang', ['as' => 'cp-setting-switchlang', 'uses' => 'Noweb\\Cp\\SettingController@switchLang']);
		/** Tags */
		Route::get('/cp/tags', array('as' => 'cp-tags', 'uses' => 'Noweb\\Cp\\TagsController@index'));
		Route::post('/cp/tags/create', array('as' => 'cp-tags-create', 'uses' => 'Noweb\\Cp\\TagsController@create'));
		Route::post('/cp/tags/delete', array('as' => 'cp-tags-delete', 'uses' => 'Noweb\\Cp\\TagsController@delete'));
		Route::post('/cp/tags/get', array('as' => 'cp-tags-get', 'uses' => 'Noweb\\Cp\\TagsController@get'));
		Route::post('/cp/tags/edit', array('as' => 'cp-tags-get', 'uses' => 'Noweb\\Cp\\TagsController@edit'));
		/** Profile */
		Route::get('/cp/profile', array('as' => 'cp-profile', 'uses' => 'Noweb\\Cp\\ProfileController@index'));
		Route::get('/cp/profile/edit', array('as' => 'cp-profile-edit', 'uses' => 'Noweb\\Cp\\ProfileController@edit'));
		Route::get('/cp/profile/activities', array('as' => 'cp-profile-activities', 'uses' => 'Noweb\\Cp\\ProfileController@activities'));
		Route::post('/cp/profile/post-edit', array('as' => 'cp-profile-postedit', 'uses' => 'Noweb\\Cp\\ProfileController@postEdit'));
		/** admin */
		Route::get('/cp/admin', array('as' => 'cp-admin', 'uses' => 'Noweb\\Cp\AdminController@index'));
		Route::post('/cp/admin/create-user', array('as' => 'cp-admin-create-user', 'uses' => 'Noweb\\Cp\AdminController@createUser'));
		Route::post('/cp/admin/delete-user', array('as' => 'cp-admin-delete-user', 'uses' => 'Noweb\\Cp\AdminController@deleteUser'));
		Route::get('/cp/admin/edit-user/{id}', array('cp-admin-edit-user', 'uses' => 'Noweb\\Cp\AdminController@editUser'));
		Route::post('/cp/admin/edit-user', array('cp-admin-edit-user', 'uses' => 'Noweb\\Cp\AdminController@editUser'));
		Route::any('/cp/admin/group', array('as' => 'cp-admin-group', 'uses' => 'Noweb\\Cp\AdminController@group'));
		Route::post('/cp/admin/delete-group', array('cp-admin-delete-group', 'uses' => 'Noweb\\Cp\AdminController@deleteGroup'));
		Route::get('/cp/admin/edit-group/{id}', array('cp-admin-edit-user', 'uses' => 'Noweb\\Cp\AdminController@editgroup'));
		Route::post('/cp/admin/edit-group', array('cp-admin-edit-user', 'uses' => 'Noweb\\Cp\AdminController@editGroup'));
		/** Inventory */
		Route::get('/cp/inventory', ['as' => 'cp-inventory', 'uses' => 'Noweb\\Cp\InventoryController@index']);
		Route::get('/cp/inventory/get-product', ['as' => 'cp-inventory-get-product', 'uses' => 'Noweb\\Cp\InventoryController@getProduct']);
		Route::post('/cp/inventory/product', ['as' => 'cp-inventory-product', 'uses' => 'Noweb\\Cp\InventoryController@product']);
		Route::get('/cp/inventory/import', ['as' => 'cp-inventory-import', 'uses' => 'Noweb\\Cp\InventoryController@import']);
		Route::post('/cp/inventory/import', ['as' => 'cp-inventory-import-create', 'uses' => 'Noweb\\Cp\InventoryController@import']);
		Route::post('/cp/inventory/catalogue', ['as' => 'cp-inventory-catalogue', 'uses' => 'Noweb\\Cp\InventoryController@catalogue']);
		Route::post('/cp/inventory/edit-catalogue', ['as' => 'cp-inventory-edit-catalogue', 'uses' => 'Noweb\\Cp\InventoryController@editCatalogue']);
		Route::post('/cp/inventory/delete-catalogue', ['as' => 'cp-inventory-delete-catalogue', 'uses' => 'Noweb\\Cp\InventoryController@deleteCatalogue']);
		/** Brand */
		Route::post('/cp/brand/create', ['as' => 'cp-create-brand', 'uses' => 'Noweb\\Cp\BrandController@create']);
		Route::post('/cp/brand/delete', ['as' => 'cp-delete-brand', 'uses' => 'Noweb\\Cp\BrandController@delete']);
		Route::post('/cp/brand/get', ['as' => 'cp-get-brand', 'uses' => 'Noweb\\Cp\BrandController@get']);
		/** Widget Type */
		Route::get('/cp/widget-type', ['as' => 'cp-widget-type', 'uses' => 'Noweb\\Cp\WidgetTypeController@index']);
		Route::get('/cp/widget-type/create', ['as' => 'cp-widget-type-create', 'uses' => 'Noweb\\Cp\WidgetTypeController@create']);
		Route::post('/cp/widget-type/create', ['as' => 'cp-widget-type-create', 'uses' => 'Noweb\\Cp\WidgetTypeController@create']);
		Route::get('/cp/widget-type/edit/{id}', ['as' => 'cp-widget-type-edit', 'uses' => 'Noweb\\Cp\WidgetTypeController@edit']);
		Route::post('/cp/widget-type/edit/{id}', ['as' => 'cp-widget-type-edit', 'uses' => 'Noweb\\Cp\WidgetTypeController@edit']);
		Route::post('/cp/widget-type/get', ['as' => 'cp-widget-type-get', 'uses' => 'Noweb\\Cp\WidgetTypeController@get']);
		Route::post('/cp/widget-type/delete', ['as' => 'cp-widget-type-delete', 'uses' => 'Noweb\\Cp\WidgetTypeController@delete']);
		/** Contact */
		Route::get('/cp/contacts', ['as' => 'cp-contacts', 'uses' => 'Noweb\\Cp\ContactController@index']);
		Route::post('/cp/contacts/delete', ['as' => 'cp-contacts-delete', 'uses' => 'Noweb\\Cp\ContactController@delete']);
		Route::get('/cp/contacts/get/{id}', ['as' => 'cp-contacts-get', 'uses' => 'Noweb\\Cp\ContactController@get']);
		Route::post('/cp/contacts/edit/{id}', ['as' => 'cp-contacts-edit', 'uses' => 'Noweb\\Cp\ContactController@edit']);
		Route::get('/cp/contacts/get_new_contacts', ['as' => 'cp-contacts-get-new-contacts', 'uses' => 'Noweb\\Cp\ContactController@getNew']);

		/** Themes **/
		Route::any('/cp/template', ['as' => 'cp-template', 'uses' => 'Noweb\\Cp\TemplateController@index']);
	});

});
