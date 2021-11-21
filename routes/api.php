<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

/*

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| is assigned the "api" middleware group. Enjoy building your API!

|

*/



// Route::middleware('auth:api')->get('/user', function (Request $request) {

//     return $request->user();

// });



Route::group(['namespace' => 'API', 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('forgetPassword', 'AuthController@forgetPassword');
    Route::post('resetPassword', 'AuthController@resetPassword');
    Route::post('changeMobile', 'AuthController@changeMobile')->middleware('CheckApi');
    Route::post('fcm_token', 'AuthController@update_fcm_token')->middleware('CheckApi');
    Route::post('send_code', 'AuthController@send_code')->middleware('CheckApi');
    Route::post('activate', 'AuthController@activate')->middleware('CheckApi');

    Route::group(['middleware'  => ['api']], function () {

        Route::get('logout', 'AuthController@logout');



        Route::get('profile', 'ProfileController@index');

        Route::get('user', 'AuthController@user');



        // Route::get('user', 'AuthController@user');

    });
});



Route::group(['namespace' => 'API', 'middleware'  => ['api']], function () {

    Route::get('home', 'HomeController@index');

    // Profile
    Route::get('profile', 'ProfileController@index');
    Route::get('profile/my-prouduct', 'ProfileController@prouduct')->middleware('CheckApi');
    Route::get('profile/editProfile', 'ProfileController@editProfile')->middleware('CheckApi');
    Route::post('profile/update', 'ProfileController@update')->middleware('CheckApi');
    Route::post('profile/update_password', 'ProfileController@update_password')->middleware('CheckApi');
    Route::post('profile/checkMobile', 'ProfileController@checkMobile')->middleware('CheckApi');
    Route::post('profile/update_mobile', 'ProfileController@update_mobile')->middleware('CheckApi');
    Route::post('profile/addRated', 'ProfileController@addRated')->middleware('CheckApi');
    Route::post('profile/complete_registration', 'ProfileController@complete_registration')->middleware('CheckApi');
    Route::post('profile/update_subscription', 'ProfileController@update_subscription')->middleware('CheckApi');


    //products
    Route::get('products', 'ProductsController@index');
    Route::get('products/getProduct', 'ProductsController@getProduct');
    Route::post('products/addProduct', 'ProductsController@addProduct')->middleware('CheckApi');
    Route::post('products/update', 'ProductsController@update')->middleware('CheckApi');
    Route::post('products/delete', 'ProductsController@delete')->middleware('CheckApi');
    Route::post('products/update_status', 'ProductsController@update_status')->middleware('CheckApi');

    //Address
    Route::get('address', 'AddressController@index')->middleware('CheckApi');
    Route::get('address/getAddress', 'AddressController@getAddress')->middleware('CheckApi');
    Route::post('address/add', 'AddressController@add')->middleware('CheckApi');
    Route::post('address/update', 'AddressController@update')->middleware('CheckApi');
    Route::post('address/delete', 'AddressController@delete')->middleware('CheckApi');

    //Constant
    Route::get('constant', 'ConstantController@index');
    Route::get('constant/addTrip', 'ConstantController@addTrip')->middleware('CheckApi');
    Route::get('getNotification', 'ConstantController@getNotification')->middleware('CheckApi');
    Route::get('static_page', 'ConstantController@static_page');
    Route::get('zones', 'ConstantController@zones');
    Route::get('city', 'ConstantController@city');
    Route::get('category', 'ConstantController@category');
    Route::get('getRandomCategory', 'ConstantController@getRandomCategory');
    Route::get('getSetting', 'ConstantController@getSetting');
    Route::post('contact_us', 'ConstantController@contact_us');
    Route::post('site_commission', 'ConstantController@site_commission');
    Route::post('upload_file', 'ConstantController@upload_file')->middleware('CheckApi');
    Route::post('constant/updateAdv', 'ConstantController@updateAdv')->middleware('CheckApi');
    Route::post('verify_payment', 'ConstantController@verify_payment')->middleware('CheckApi');
    Route::post('payment', 'ConstantController@payment')->middleware('CheckApi');
    // Route::post('uploads', 'ConstantController@uploads');

    //Client
    Route::get('clients/getClient/{id}', 'ClientController@getClient');
    Route::post('clients/add_rate', 'ClientController@add_rate')->middleware('CheckApi');

    //Favorites
    Route::get('favorites', 'FavoritesController@index')->middleware('CheckApi');
    Route::post('favorites/AddFavoriteOrDelete', 'FavoritesController@AddFavorite')->middleware('CheckApi');

    //Orders
    Route::get('orders', 'OrdersController@index')->middleware('CheckApi');
    Route::get('orders/getOrder', 'OrdersController@getOrder')->middleware('CheckApi');
    Route::post('orders/add', 'OrdersController@add')->middleware('CheckApi');
    Route::post('orders/update', 'OrdersController@update')->middleware('CheckApi');
    Route::post('orders/delete', 'OrdersController@delete')->middleware('CheckApi');
    Route::post('orders/delivery_price', 'OrdersController@delivery_price')->middleware('CheckApi');
});
