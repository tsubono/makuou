<?php

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


Auth::routes();

/*
|--------------------------------------------------------------------------
| 1) User 認証不要
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return redirect('/home'); });

//Route::get('/canvas',     'CanvasController@index')->name('canvas');
//Route::post('/canvas/getProducts',     'CanvasController@getProducts')->name('getProducts');
//Route::post('/canvas/getProduct',     'CanvasController@getProduct')->name('getProduct');
//Route::post('/canvas/getSavedDesigns',     'CanvasController@getSavedDesigns')->name('getSavedDesigns');
//Route::post('/canvas/getStampCategories',     'CanvasController@getStampCategories')->name('getStampCategories');
//Route::post('/canvas/getStamps',     'CanvasController@getStamps')->name('getStamps');
//Route::post('/canvas/uploadImage',     'CanvasController@uploadImage')->name('uploadImage');
//Route::post('/canvas/saveObjectAsSvg',     'CanvasController@saveObjectAsSvg')->name('saveObjectAsSvg');
//Route::post('/canvas/saveDesignDB',     'CanvasController@saveDesignDB')->name('saveDesignDB');
//Route::post('/canvas/saveDesign',     'CanvasController@saveDesign')->name('saveDesign');
//Route::post('/canvas/getSavedDesign',     'CanvasController@getSavedDesign')->name('getSavedDesign');
//Route::post('/canvas/deleteSavedDesign',     'CanvasController@deleteSavedDesign')->name('deleteSavedDesign');


/*
|--------------------------------------------------------------------------
| 2) User before login
|--------------------------------------------------------------------------
*/
//Route::group(['middleware' => 'auth:user'], function() {
//    Route::get('/home', 'HomeController@index')->name('home');
//});
Route::namespace('Front')->group(function() {
    Route::get('/',      'HomeController@index')->name('home');
    Route::get('/search',      'SearchController@index')->name('search');
    Route::get('/result',      'SearchController@search')->name('result');
    Route::get('/concept',      'ConceptController@index')->name('concept');
    Route::get('/price',      'PriceController@index')->name('price');
    Route::get('/faq',      'FaqController@index')->name('faq');
    Route::get('/company',      'CompanyController@index')->name('company');
});
/*
|--------------------------------------------------------------------------
| 3) Admin before login
|--------------------------------------------------------------------------
*/
Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@login');
});
/*
|--------------------------------------------------------------------------
| 4) Admin after login
|--------------------------------------------------------------------------
*/
Route::namespace('Admin')->prefix('admin')->as('admin.')->middleware('auth:admin')->group(function () {
    Route::get('logout',   'LoginController@logout');
    Route::post('logout',   'LoginController@logout')->name('logout');
    Route::get('home',      'HomeController@index')->name('home');

    /* products */
    Route::resource('products', ProductController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::post('products/ajaxSearchList',   'ProductController@ajaxSearchList');
    Route::post('products/ajaxSearch',   'ProductController@ajaxSearch');

    /* stamps */
    Route::resource('stamps', StampController::class);
    Route::resource('stamp-categories', StampCategoryController::class);

    /* orders */
    Route::resource('orders', OrderController::class);
    Route::post('orders/ajaxValidation', 'OrderController@ajaxValidation');
    Route::post('orders/saveDesign', 'OrderController@saveDesign');
    Route::post('orders/saveDesignDB', 'OrderController@saveDesignDB');

    /* users */
    Route::resource('users', UserController::class);
    Route::post('users/ajaxSearchList',   'UserController@ajaxSearchList');
    Route::post('users/ajaxSearch',   'UserController@ajaxSearch');


    /* news */
    Route::resource('news', NewsController::class);

    /* admins */
    Route::resource('admins', AdminController::class);

    /* --- setting --- */
    /* price */
    Route::resource('product-setting/prices', PriceController::class);
    Route::post('product-setting/prices/ajaxGetRatios', 'PriceController@ajaxGetRatios');
    Route::post('product-setting/prices/ajaxGetClothes', 'PriceController@ajaxGetClothes');
    Route::post('product-setting/prices/ajaxGetPrice', 'PriceController@ajaxGetPrice');
    /* size */
    Route::resource('product-setting/sizes', SizeController::class);
    /* ratio */
    Route::resource('product-setting/ratios', RatioController::class);
    /* clothe */
    Route::resource('product-setting/clothes', ClotheController::class);
    /* clothe */
    Route::resource('product-setting/options', OptionController::class);
    /* shop */
    Route::resource('setting/shop', ShopController::class);
    /* tradelaw */
    Route::resource('setting/tradelaw', TradelawController::class);
    /* customer_agreement */
    Route::resource('setting/customer-agreement', CustomerAgreementController::class);
    /* payments */
    Route::resource('setting/payments', PaymentController::class);
    /* mail-template */
    Route::resource('setting/mail-templates', MailTemplateController::class);
    Route::post('setting/mail-templates/ajaxLoadData',   'MailTemplateController@ajaxLoadData');

    Route::get('canvas',     'CanvasController@index')->name('canvas');


});
