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

//WebSite
Route::get('/', 'WebSiteController@index')->name('index');
Route::get('/shop', 'WebSiteController@index')->name('index');
Route::get('/shop-ajax', 'WebSiteController@index')->name('index');

Route::get('/page/{pagina}', 'WebSiteController@page')->name('page');

Route::get('/check-email/{email}', 'WebSiteController@checkEmail')->name('checkEmail');

Route::get('/confirmar-conta/{token}', 'WebSiteController@confirmarConta')->name('confirmarConta');

//Route::get('/teste', 'WebSiteController@teste');

//User
Route::post('/login', 'WebSiteController@login');
Route::get('/logout-ajax', 'WebSiteController@logout');
//Route::post('/profile', 'WebSiteController@profile');
Route::post('/profile/edit/save', 'WebSiteController@profileEditSave');
Route::post('/adress/save', 'WebSiteController@adressSave');
Route::get('/adress/update/{id}', 'WebSiteController@updateAdress');
Route::get('/adress/remove/{id}', 'WebSiteController@removeAdress');
Route::get('/full/profile', 'WebSiteController@fullProfile');
Route::get('/full/profile-ajax', 'WebSiteController@fullProfile');
Route::post('/save-register', 'WebSiteController@saveRegister');

//Artigos
Route::get('/get/artigos/all', 'WebSiteController@getAllArtigos');
Route::get('/get/artigos/{familia}', 'WebSiteController@getArtigosByFamilia');
Route::get('/check-reference/{reference}', 'ItemsXDController@checkReference');
Route::get('/atributes/details/{atributes}', 'ItemsXDController@viewAtributes');
Route::get('/general-image', 'ItemsXDController@generalImage');
Route::get('/add-other-attr/{id}', 'ItemsXDController@addOtherAttr');
Route::get('/add-other-attr-in-attr/{id}/{imagem}', 'ItemsXDController@addOtherAttrInAttr');
Route::post('/edit-attr', 'ItemsXDController@editAttr');

//Stocks
Route::post('/item/search/attr', 'StocksController@searchAttr');

//ABOUT US
Route::get('about-us', 'WebSiteController@aboutUs');
Route::get('about-us-ajax', 'WebSiteController@aboutUs');

//Encomendas
Route::get('orders', 'WebSiteController@orders');
Route::get('orders-ajax', 'WebSiteController@orders');

//LEGAL STUFF
Route::get('legal', 'WebSiteController@legal');
Route::get('legal-ajax', 'WebSiteController@legal');

//CHECKOUT
Route::get('cart', 'CheckoutController@index');
Route::get('cart-ajax', 'CheckoutController@index');
Route::get('cart-check-available-transport-options-ajax', 'CheckoutController@checkAvailableTransportOptions');

//Items
Route::get('item/{id}', 'ProductDetailsController@index');
Route::get('item-ajax/{id}', 'ProductDetailsController@index');

//Promotions
Route::post('/item/search/value', 'ItemsXDController@searchValue');
Route::post('/item/get/value', 'WebSiteController@searchValue');
Route::post('/item/post/value', 'ItemsXDController@postValue');
Route::post('/item/post/value/no-attr', 'ItemsXDController@postValueNoAttr');
Route::post('/item/calculate/percentage/with-value', 'ItemsXDController@calculatePercentageWithValue');
Route::post('/item/calculate/percentage/with-percentage', 'ItemsXDController@calculatePercentageWithPercentage');
Route::post('/item/calculate/percentage/with-value-end', 'ItemsXDController@calculatePercentageWithValueEnd');

//WebSite Formulário de Contactos
Route::get('contact-us', 'WebSiteController@contactUS');
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'WebSiteController@contactSaveData']);

//Cart
Route::post('/finalize-order', 'OrdersController@new');
Route::post('/sent/{id}', 'OrdersController@sent');
Route::post('/pay/{id}', 'OrdersController@pay');
Route::post('/transacao', 'OrdersController@transacao');

//Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Cronjob
Route::get('/process-email-cronjob', 'QueueController@processEmail');

//Automatic Login
Route::get('/confirm-login/{token}', 'WebSiteController@confirmLogin');

//Alterar Password
Route::get('/confirm-password/{token}/{password}', 'WebSiteController@confirmPassword');

//Backoffice
Route::post('/save-information', 'WebSiteController@saveInformation');
Route::post('/save-addicional-information', 'WebSiteController@saveAddicionalInformation');
Route::post('/save-information-pay-tb', 'WebSiteController@saveInformationPayTB');
Route::post('/save-information-pay-paypal', 'WebSiteController@saveInformationPayPayPal');
Route::post('/save-appearance', 'WebSiteController@saveAppearance');

//Rest API
Route::any('/api/service-check-plan', 'QueueController@modificarDataPlano');

//Paypal
Route::get('/paypal/checkout-completed/{id}', 'OrdersController@paypalCompleted');
Route::get('/paypal/checkout/cancelled', 'OrdersController@paypalCancelled');
Route::post('/webhook/paypal/{cartao?}/{env?}', 'OrdersController@paypalWebhook');

// MediaManager
ctf0\MediaManager\MediaRoutes::routes();