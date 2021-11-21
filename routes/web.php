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

Route::get('/', ['as' => 'site.index', 'uses' => 'Site\HomeController@index']);
Route::get('/{lang?}/privacy-policy', ['as' => 'site.index', 'uses' => 'Site\HomeController@static']);



Route::get('/home', function ()
{
    return redirect('/admin/dashboard');
});
// LOGIN ROUTE
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web', 'guest']], function ()
{
    // LOGIN ROUTE
    Route::get('/login', ['as' => 'admin.login', 'uses' =>'LoginController@getIndex']);
    Route::post('adminlogin', ['as' => 'adminlogin', 'uses' => 'LoginController@postIndex']);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    // DASHBOARD ROUTE
    Route::get('dashboard', ['as' => 'admin.dashboard.view', 'uses' => 'DashboardController@index']);
    Route::get('dashboard/profile', ['as' => 'admin.dashboard.profile', 'uses' =>'DashboardController@getProfile']);
    Route::get('dashboard/getFund', ['as' => 'admin.dashboard.getFund', 'uses' =>'DashboardController@getFund']);
    Route::post('dashboard/password', ['as' => 'admin.dashboard.password', 'uses' =>'DashboardController@postPassword']);
    Route::post('dashboard/close_fund', ['as' => 'admin.dashboard.close_fund', 'uses' =>'DashboardController@close_fund']);
    Route::get('dashboard/details', ['as' => 'admin.dashboard.details', 'uses' => 'DashboardController@orderDetails']);
    Route::post('dashboard/UpdateStats', ['as' => 'admin.dashboard.UpdateStats', 'uses' => 'DashboardController@UpdateStats']);
    Route::post('dashboard/delete', ['as' => 'admin.dashboard.delete', 'uses' => 'DashboardController@delete']);
  
    //notification
    Route::get('notification', ['as' => 'admin.notifications.notifications', 'uses' => 'NotificationsController@notifications']);
    Route::post('notification/send', ['as' => 'admin.notifications.notifications.send', 'uses' => 'NotificationsController@send']);
    Route::post('notification/send_client', ['as' => 'admin.notifications.notifications.send_client', 'uses' => 'NotificationsController@send_client']);

    Route::get('home_order', ['as' => 'admin.home_order.home_order', 'uses' => 'RearrangeController@index']);
    Route::post('home_order/save_order', ['as' => 'admin.home_order.save_order', 'uses' => 'RearrangeController@save_order']);
    

    // USERS ROUTE
    Route::get('users', ['as' => 'admin.users.index', 'uses' => 'UserController@index']);
    Route::get('users/edit',['as' => 'admin.users.edit', 'uses' => 'UserController@edit',['middleware' => ['permission:update_users']]]);
    Route::get('users/getpermission', ['as' => 'admin.users.getpermission', 'uses' => 'UserController@getpermission',['middleware' => ['permission:permission_users']]]);
    Route::post('users/add', ['as' => 'admin.users.add', 'uses' => 'UserController@add',['middleware' => ['permission:add_users']]]);
    Route::post('users/update', ['as' => 'admin.users.update', 'uses' => 'UserController@update',['middleware' => ['permission:update_users']]]);
    Route::post('users/UpdateStats', ['as' => 'admin.users.UpdateStats', 'uses' => 'UserController@UpdateStats',['middleware' => ['permission:change_status_users']]]);
    Route::post('users/delete', ['as' => 'admin.users.delete', 'uses' => 'UserController@delete',['middleware' => ['permission:delete_users']]]);
    Route::post('users/changepassword', ['as' => 'admin.users.changepassword', 'uses' => 'UserController@changepassword',['middleware' => ['permission:change_password_user']]]);
    Route::post('users/permission', ['as' => 'admin.users.permission', 'uses' => 'UserController@permission',['middleware' => ['permission:permission_users']]]);
    Route::post('users/userpermission', ['as' => 'admin.users.userpermission', 'uses' => 'UserController@userpermission',['middleware' => ['permission:permission_users']]]);


    // CATEGORY ROUTE
    Route::get('category', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index'])->middleware('permission:categorys');
    Route::get('category/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit'])->middleware('permission:edit_categorys');
    Route::post('category/add', ['as' => 'admin.category.add', 'uses' => 'CategoryController@add'])->middleware('permission:add_categorys');
    Route::post('category/update', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update'])->middleware('permission:edit_categorys');
    Route::post('category/delete', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete'])->middleware('permission:delete_categorys');
    Route::post('category/UpdateStats', ['as' => 'admin.category.UpdateStats', 'uses' => 'CategoryController@UpdateStats'])->middleware('permission:status_categorys');


    // STONES ROUTE
    Route::get('stones', ['as' => 'admin.stones.index', 'uses' => 'StonesController@index'])->middleware('permission:stones');
    Route::get('stones/edit', ['as' => 'admin.stones.edit', 'uses' => 'StonesController@edit'])->middleware('permission:edit_stones');
    Route::post('stones/add', ['as' => 'admin.stones.add', 'uses' => 'StonesController@add'])->middleware('permission:add_stones');
    Route::post('stones/update', ['as' => 'admin.stones.update', 'uses' => 'StonesController@update'])->middleware('permission:edit_stones');
    Route::post('stones/delete', ['as' => 'admin.stones.delete', 'uses' => 'StonesController@delete'])->middleware('permission:delete_stones');
    Route::post('stones/UpdateStats', ['as' => 'admin.stones.UpdateStats', 'uses' => 'StonesController@UpdateStats'])->middleware('permission:status_stones');

       
    // STATIC ROUTE
    Route::get('static_page', ['as' => 'admin.static_page.index', 'uses' => 'StaticPageController@index',['middleware' => ['permission:static_page|view_page|edit_page|delete_page|add_page|status_page']]]);
    Route::get('static_page/edit', ['as' => 'admin.static_page.edit', 'uses' => 'StaticPageController@edit',['middleware' => ['permission:edit_page']]]);
    Route::post('static_page/add', ['as' => 'admin.static_page.add', 'uses' => 'StaticPageController@add'],['middleware' => ['permission:add_page']]);
    Route::post('static_page/update', ['as' => 'admin.static_page.update', 'uses' => 'StaticPageController@update',['middleware' => ['permission:edit_page']]]);
    Route::post('static_page/UpdateStats', ['as' => 'admin.static_page.UpdateStats', 'uses' => 'StaticPageController@UpdateStats',['middleware' => ['permission:status_page']]]);
    Route::post('static_page/delete', ['as' => 'admin.static_page.delete', 'uses' => 'StaticPageController@delete',['middleware' => ['permission:delete_page']]]);
  
    // CLIENTS ROUTE
    Route::get('clients', ['as' => 'admin.clients.index', 'uses' => 'ClientsController@index', ['middleware' => ['permission:view_clients']]]);
    Route::get('clients/edit', ['as' => 'admin.clients.edit', 'uses' => 'ClientsController@edit', ['middleware' => ['permission:update_clients']]]);
    Route::post('clients/add', ['as' => 'admin.clients.add', 'uses' => 'ClientsController@add', ['middleware' => ['permission:add_clients']]]);
    Route::post('clients/update', ['as' => 'admin.clients.update', 'uses' => 'ClientsController@update', ['middleware' => ['permission:update_clients']]]);
    Route::post('clients/UpdateStats', ['as' => 'admin.clients.UpdateStats', 'uses' => 'ClientsController@UpdateStats', ['middleware' => ['permission:change_status_clients']]]);
    Route::post('clients/delete', ['as' => 'admin.clients.delete', 'uses' => 'ClientsController@delete', ['middleware' => ['permission:delete_clients']]]);
    Route::get('clients/search', ['as' => 'admin.clients.search', 'uses' => 'ClientsController@search']);

    // TRIPS ROUTE
    Route::get('banks_transfer', ['as' => 'admin.banks_transfer.index', 'uses' => 'BanksTransferController@index'])->middleware('permission:banks_transfer');
    Route::get('banks_transfer/details', ['as' => 'admin.banks_transfer.details', 'uses' => 'BanksTransferController@details'])->middleware('permission:details_banks_transfer');
    Route::post('banks_transfer/status_transfer', ['as' => 'admin.banks_transfer.status_transfer', 'uses' => 'BanksTransferController@status_transfer'])->middleware('permission:change_status_banks_transfer');

  
    //CONTACT ROUTE
    Route::get('contact', ['as' => 'admin.contact.index', 'uses' => 'ContactUsController@index']);
    Route::get('contact/view', ['as' => 'admin.contact_view.index', 'uses' => 'ContactUsController@view']);
    Route::post('contact/reply_view', ['as' => 'admin.reply_view.index', 'uses' => 'ContactUsController@reply']);
    Route::post('contact/delete', ['as' => 'admin.reply_view.delete', 'uses' => 'ContactUsController@delete']);

    //SLIDER ROUTE
    Route::get('slider', ['as' => 'admin.slider.index', 'uses' => 'SliderController@index',['middleware' => ['permission:page|view_page|edit_page|delete_page|add_page|change_status_page']]]);
    Route::get('slider/GetImages', ['as' => 'admin.slider.GetImages', 'uses' => 'SliderController@GetImages',['middleware' => ['permission:page|view_page|edit_page|delete_page|add_page|change_status_page']]]);
    Route::get('slider/edit', ['as' => 'admin.slider.edit', 'uses' => 'SliderController@edit',['middleware' => ['permission:edit_page']]]);
    Route::post('slider/add', ['as' => 'admin.slider.add', 'uses' => 'SliderController@add'],['middleware' => ['permission:add_page']]);
    Route::post('slider/update', ['as' => 'admin.slider.update', 'uses' => 'SliderController@update',['middleware' => ['permission:edit_page']]]);
    Route::post('slider/UpdateStats', ['as' => 'admin.slider.UpdateStats', 'uses' => 'SliderController@UpdateStats',['middleware' => ['permission:change_status_page']]]);
    Route::post('slider/delete', ['as' => 'admin.slider.delete', 'uses' => 'SliderController@delete',['middleware' => ['permission:delete_page']]]);

    Route::post('slider/add_parent', ['as' => 'admin.slider.add_parent', 'uses' => 'SliderController@add_parent'],['middleware' => ['permission:add_page']]);
    Route::post('slider/update_parent', ['as' => 'admin.slider.update_parent', 'uses' => 'SliderController@update_parent'],['middleware' => ['permission:add_page']]);
    Route::post('slider/delete_parent', ['as' => 'admin.slider.delete_parent', 'uses' => 'SliderController@delete_parent',['middleware' => ['permission:delete_page']]]);
    Route::get('slider/edit_parent', ['as' => 'admin.slider.edit_parent', 'uses' => 'SliderController@edit_parent',['middleware' => ['permission:edit_page']]]);

    // SYSTEM CONSTANT  ROUTE
    Route::get('system_constants', ['as' => 'admin.system_constants.index', 'uses' => 'SystemConstantController@index']);
    Route::get('system_constants/edit', ['as' => 'admin.system_constants.edit', 'uses' => 'SystemConstantController@edit']);
    Route::post('system_constants/add', ['as' => 'admin.system_constants.add', 'uses' => 'SystemConstantController@add']);
    Route::post('system_constants/update', ['as' => 'admin.system_constants.update', 'uses' => 'SystemConstantController@update']);
    Route::post('system_constants/delete', ['as' => 'admin.system_constants.delete', 'uses' => 'SystemConstantController@delete']);
    Route::post('system_constants/UpdateStats', ['as' => 'admin.system_constants.UpdateStats', 'uses' => 'SystemConstantController@UpdateStats']);

    //SETTING ROUTE
    Route::get('setting', ['as' => 'admin.setting.index', 'uses' => 'SettingController@index']);
    Route::post('setting/update', ['as' => 'admin.setting.update', 'uses' => 'SettingController@update']);

    //SETTING ROUTE
    Route::get('site_setting', ['as' => 'admin.site_setting.index', 'uses' => 'SiteSettingController@index']);
    Route::post('site_setting/update', ['as' => 'admin.site_setting.update', 'uses' => 'SiteSettingController@update']);

      // ZONE ROUTE
    Route::get('zone', ['as' => 'admin.zone.index', 'uses' => 'ZoneController@index'])->middleware('permission:zones');
    Route::get('zone/edit', ['as' => 'admin.zone.edit', 'uses' => 'ZoneController@edit'])->middleware('permission:update_zones');
    Route::post('zone/update', ['as' => 'admin.zone.update', 'uses' => 'ZoneController@update'])->middleware('permission:update_zones');
    Route::post('zone/add', ['as' => 'admin.zone.add', 'uses' => 'ZoneController@add'])->middleware('permission:add_zones');
    Route::post('zone/UpdateStats', ['as' => 'admin.zone.UpdateStats', 'uses' => 'ZoneController@UpdateStats'])->middleware('permission:change_status_zones');
    Route::post('zone/delete', ['as' => 'admin.zone.delete', 'uses' => 'ZoneController@delete'])->middleware('permission:delete_zones');
    Route::get('zone/show', ['as' => 'admin.show.delete', 'uses' => 'ZoneController@show']);

    Route::get('country', ['as' => 'admin.country.index', 'uses' => 'CountryController@index']);
    Route::get('country/edit', ['as' => 'admin.country.edit', 'uses' => 'CountryController@edit']);
    Route::post('country/update', ['as' => 'admin.country.update', 'uses' => 'CountryController@update']);
    Route::post('country/add', ['as' => 'admin.country.add', 'uses' => 'CountryController@add']);
    Route::post('country/UpdateStats', ['as' => 'admin.country.UpdateStats', 'uses' => 'CountryController@UpdateStats']);
    Route::post('country/delete', ['as' => 'admin.country.delete', 'uses' => 'CountryController@delete']);

    Route::get('subscriptions', ['as' => 'admin.subscriptions.index', 'uses' => 'SubscriptionsController@index'])->middleware('permission:view_subscriptions');
    Route::get('subscriptions/edit', ['as' => 'admin.subscriptions.edit', 'uses' => 'SubscriptionsController@edit'])->middleware('permission:edit_subscriptions');
    Route::post('subscriptions/add', ['as' => 'admin.subscriptions.add', 'uses' => 'SubscriptionsController@add'])->middleware('permission:add_subscriptions');
    Route::post('subscriptions/update', ['as' => 'admin.subscriptions.update', 'uses' => 'SubscriptionsController@update'])->middleware('permission:edit_subscriptions');
    Route::post('subscriptions/UpdateStats', ['as' => 'admin.subscriptions.UpdateStats', 'uses' => 'SubscriptionsController@UpdateStats'])->middleware('permission:update_status_subscriptions');
    Route::post('subscriptions/delete', ['as' => 'admin.subscriptions.delete', 'uses' => 'SubscriptionsController@delete'])->middleware('permission:delete_subscriptions');

    
     //BANLS ROUTE
     Route::get('banks', ['as' => 'admin.banks.index', 'uses' => 'BanksController@index'])->middleware('permission:banks');
     Route::get('banks/edit', ['as' => 'admin.banks.edit', 'uses' => 'BanksController@edit'])->middleware('permission:edit_banks');
     Route::post('banks/add', ['as' => 'admin.banks.add', 'uses' => 'BanksController@add'])->middleware('permission:add_banks');
     Route::post('banks/update', ['as' => 'admin.banks.update', 'uses' => 'BanksController@update'])->middleware('permission:edit_banks');
     Route::post('banks/UpdateStats', ['as' => 'admin.banks.UpdateStats', 'uses' => 'BanksController@UpdateStats'])->middleware('permission:status_banks');
     Route::post('banks/delete', ['as' => 'admin.banks.delete', 'uses' => 'BanksController@delete'])->middleware('permission:delete_banks');
 
     Route::get('products', ['as' => 'admin.news.index', 'uses' => 'ProductsController@index']);
     Route::get('products/search', ['as' => 'admin.products.search', 'uses' => 'ProductsController@search']);
     Route::get('news/edit/{id}', ['as' => 'admin.news.edit', 'uses' => 'ProductsController@edit']);
     Route::get('news/{id}', ['as' => 'admin.news.show', 'uses' => 'ProductsController@show']);
     Route::post('news', ['as' => 'admin.news.store', 'uses' => 'ProductsController@store']);
     Route::post('products/UpdateCertificated', ['as' => 'admin.contacts.UpdateCertificated', 'uses' => 'ProductsController@UpdateCertificated']);
     Route::post('news/update/{id}', ['as' => 'admin.news.update', 'uses' => 'ProductsController@update']);
     Route::post('news/delete/{id}', ['as' => 'admin.news.delete', 'uses' => 'ProductsController@destroy']);
     Route::post('news/updateStatus', ['as' => 'admin.contacts.updateStatus', 'uses' => 'ProductsController@updateStatus']);
    

    // SOCAIL ROUTE
    Route::get('social', ['as' => 'social.index', 'uses' => 'SocialLinksController@index'])->middleware('permission:view_social');
    Route::get('social/edit', ['as' => 'social.edit', 'uses' => 'SocialLinksController@edit'])->middleware('permission:edit_social');
    Route::post('social/update', ['as' => 'social.update', 'uses' => 'SocialLinksController@update'])->middleware('permission:edit_social');
    Route::post('social/add', ['as' => 'social.add', 'uses' => 'SocialLinksController@add'])->middleware('permission:add_social');
    Route::post('social/UpdateStats', ['as' => 'social.UpdateStats', 'uses' => 'SocialLinksController@UpdateStats'])->middleware('permission:update_status_social');
    Route::post('social/delete', ['as' => 'social.delete', 'uses' => 'SocialLinksController@delete'])->middleware('permission:delete_social');


    // Route Logout
    Route::get('/logout', ['as' => 'admin.dashboard.logout', 'uses' => 'LoginController@getLogout']);

    Route::get('/clear', function ()
    {
        Cache::forget('spatie.permission.cache');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('config:cache');
        return 'cleared';
    });

});