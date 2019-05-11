<?php


Route::get('Api/V1/RESIZE/{id}', function($id) {
    $img = Image::make(env('FILE_URL') . $id)->resize(function($constraint) {
        $constraint->aspectRatio();
    });
    return $img->response();
});
Route::get('Api/V1/RESIZE/{id}/{width?}/{height?}', function($id, $width = null, $height = null) {
    $img = Image::make(env('FILE_URL') . $id)->resize($width, $height);
    return $img->response();
});

Route::get('Api/V1/RESIZE_ASPECT/{id}/{width?}/{height?}', function($id, $width = null, $height = null) {

    $img = Image::make(env('FILE_URL') . $id)->resize($width, $height, function($constraint) {
        $constraint->aspectRatio();
    });
    return $img->response();
});


Route::get('/',['as'=>'signin','uses'=>'LoginController@index']);

Auth::routes(['verify' => true]);
Route::get('/password-link-send',['as'=>'password-link','uses'=>'LoginController@passwordlink']);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


//admin password reset routes
Route::post('/admin/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/admin/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/admin/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/admin/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin_middleware'], function(){
    Route::get('/', 'AdminController@admin_dashboard')->name('admin.dashboard');
    Route::get('login', ['as' => 'admin_login_get', 'uses' => 'AdminController@admin_login_get']);
    Route::post('login', ['as' => 'admin_login_post', 'uses' => 'AdminController@admin_login_post']);
    Route::get('logout', ['as' => 'admin_logout', 'uses' => 'AdminController@admin_logout']);
    Route::get('dashboard', ['as' => 'admin_dashboard', 'uses' => 'AdminController@admin_dashboard']);
    Route::get('dashboard_data', ['as' => 'get_dashboard_data', 'uses' => 'AdminController@get_dashboard_data']);
    Route::get('profile/update', ['as' => 'aprofile_update_get', 'uses' => 'AdminController@aprofile_update_get']);
    Route::post('profile/update', ['as' => 'aprofile_update_post', 'uses' => 'AdminController@aprofile_update_post']);
    Route::get('password/update', ['as' => 'apassword_update_get', 'uses' => 'AdminController@apassword_update_get']);
    Route::post('password/update', ['as' => 'apassword_update_post', 'uses' => 'AdminController@apassword_update_post']);

});
