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

//Login Route:::::
Route::get('/',function(){
  return redirect()->route('login.index');
});

Route::get('/login','loginController@index')->name('login.index');
Route::post('/login','loginController@verify')->name('login.verify');
//End Of Login Route:::::


//Verify Using Session:::::::::

Route::group(['middleware'=>['sessionVerify']],function(){

  Route::group(['middleware'=>['adminVerify']],function(){

    Route::get('/admin/home','adminController@index')->name('admin.home');
    Route::get('/admin/view/{id}','adminController@view')->name('admin.view');

  });

  Route::group(['middleware'=>['userVerify']],function(){

    //Home Route:::
    Route::get('/user/home/{id}','userController@index')->name('user.home');

    //Profile Route::
    Route::get('/user/profile/{id}','userController@profile')->name('user.profile');
    Route::get('/user/view/{id}','userController@view')->name('user.view');
    Route::get('/user/viewConnected/{id}','userController@viewConnected')->name('user.viewConnected');
    //Change Pic & Cover:::
    Route::post('/user/changePic/{id}','userController@changePic')->name('user.changePic');
    Route::post('/user/changeCover/{id}','userController@changeCover')->name('user.changeCover');
    
    //Schedule Route::::
    Route::get('/user/schedule/{id}','userController@schedule')->name('user.schedule');

    //Message Route::::
    Route::get('/user/message/{id}','userController@message')->name('user.message');

    //Connect Routes:::
    Route::get('/connect/request/{id}','connectController@request')->name('connect.request');

    //Handling Post Controller:::
    Route::post('/post/getUser','postController@getUser')->name('post.getUser');

    //Insert Post:

    Route::post('/post/insert/{id}','postController@insert')->name('post.insert');

    Route::get('/post/edit/{id}','postController@edit')->name('post.edit');
    Route::post('/post/edit/{id}','postController@update')->name('post.update');

    Route::get('/post/delete/{id}','postController@delete')->name('post.delete');

    //Search Routes:::::
    Route::get('/search/{id}','searchController@index')->name('search.index');
    Route::post('/search/recentSearch','searchController@recentSearch')->name('search.recentSearch');

    //CONNECT ROUTES::::::::::::::
    Route::post('/connect/getConnected','connectController@getConnected')->name('connect.getConnected');
    Route::post('/connect/getUsers','connectController@getUsers')->name('connect.getUsers');
    Route::post('/connect/getConnectRequest','connectController@getConnectRequest')->name('connect.getConnectRequest');
    Route::post('/connect/getRequestNumber','connectController@getRequestNumber')->name('connect.getRequestNumber');
    Route::post('/connect/getConnectedNumber','connectController@getConnectedNumber')->name('connect.getConnectedNumber');
    Route::post('/connect/getRequests','connectController@getRequests')->name('connect.getRequests');
    Route::post('/connect/clearNotification','connectController@clearNotification')->name('connect.clearNotification');



    Route::get('/connect/no-request/{id}','connectController@noRequest')->name('connect.noRequest');
    Route::get('/connect/yes-request/{id}','connectController@yesRequest')->name('connect.yesRequest');
    Route::get('/connect/connect-request/{id}','connectController@connectRequest')->name('connect.connectRequest');
    Route::get('/connect/cancel-request/{id}','connectController@cancelRequest')->name('connect.cancelRequest');
    Route::get('/connect/disconnect-people/{id}','connectController@disconnect')->name('connect.disconnect');
    Route::get('/connect/connected-with/{id}','connectController@connected')->name('connect.connected');
  });
});

//Logout Route::::
Route::get('/logout','logoutController@index')->name('user.logout');


