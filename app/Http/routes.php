<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 前台首页
Route::get('/',"home\IndexController@Index");

// 前台活动
Route::get('home/Activity',"home\ActivityController@Index");
// 前台活动详情
Route::get('home/ActivityInfo',"home\ActivityController@ActivityInfo");

// 前台我的订单
Route::get('home/Order',"home\OrderController@Index");

// 前台我的格子
Route::get('home/MyAccount',"home\AccountController@Index");
// 前台我的礼物
Route::get('home/MyGift',"home\AccountController@MyGift");
// 前台我的订单  
Route::get('home/MyOrder',"home\AccountController@MyOrder");
// 前台我的信息
Route::get('home/MyInfo',"home\AccountController@MyInfo");
// 前台我的收藏
Route::get('home/MyCollection',"home\AccountController@MyCollection");

// 前台礼品商城
Route::get('home/Gift',"home\GiftController@Index");
// 前台礼品详情
Route::get('home/GiftInfo',"home\GiftController@GiftInfo");

// 前台帮助
Route::get('home/Help',"home\HelpController@Index");

// 前台登录
Route::get('home/Login',"home\LoginController@Index");

// 前台注册
Route::get('home/Register',"home\LoginController@Register");
// 注册
Route::post('home/enroll',"home\LoginController@Enroll");

// 前台预订酒店
Route::get('home/Hotel',"home\HotelController@Index");
// 前台酒店列表
Route::get('home/HotelList',"home\HotelController@HotelList");
// 前台酒店详情
Route::get('home/HotelInfo',"home\HotelController@HotelInfo");
// 前台酒店评论
Route::get('home/HotelReview',"home\HotelController@HotelReview");
// 前台酒店简介
Route::get('home/HotelDesc',"home\HotelController@HotelDesc");






// 后台管理
Route::get('login',  'Admin\LoginController@login');
Route::post('PostLogin', 'Admin\LoginController@PostLogin');
Route::any('Logout', 'Admin\LoginController@Logout');
Route::get('admin',  'Admin\AdminController@index');
Route::get('adminlist',  'Admin\AdminController@lists');
Route::get('adminadd',  'Admin\AdminController@add');

//文章列表
route::get('articlelist','Admin\ArticleController@ArticleList');
//文章添加
route::get('articleadd','Admin\ArticleController@ArticleAdd');
//文章入库
route::post('articleinsert','Admin\ArticleController@ArticleInsert');
//验证文章标题唯一性
route::get('check_title','Admin\ArticleController@CheckTitle');
//文章删除
route::get('articledel','Admin\ArticleController@ArticleDel');
//文章的修改
route::get('articlesave','Admin\ArticleController@ArticleSave');
//执行修改
route::post('articleupdate','Admin\ArticleController@ArticleUpdate');
//即点即改
route::get('articleedit','Admin\ArticleController@ArticleEdit');
//多条件搜索
route::get('articlesearch','Admin\ArticleController@ArticleSearch');


//活动列表
route::get('activitylist','Admin\ActivityController@ActivityList');
//活动添加
route::get('activityadd','Admin\ActivityController@ActivityAdd');
//活动入库
route::post('activityinsert','Admin\ActivityController@ActivityInsert');
//活动删除
route::get('activitydel','Admin\ActivityController@ActivityDel');
//活动修改
route::get('activitysave','Admin\ActivityController@ActivitySave');
//执行修改
route::post('activityupdate','Admin\ActivityController@ActivityUpdate');
//活动名称的即点即改
route::get('activityedit','Admin\ActivityController@ActivityEdit');
//多条件搜索
route::get('activitysearch','Admin\ActivityController@ActivitySearch');