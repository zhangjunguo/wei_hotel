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

// 后台地区管理列表
Route::get('AreaList',  'Admin\AreaListController@AreaList');
// 后台地区管理展示添加页面
Route::get('AreaAdd',  'Admin\AreaListController@AreaAdd');
// 后台地区管理执行添加
Route::post('DoAreaAdd',  'Admin\AreaListController@DoAreaAdd');
// 后台地区管理验证唯一性
Route::get('CheckName',  'Admin\AreaListController@CheckName');
// 后台地区管理删除
Route::get('AreaDel',  'Admin\AreaListController@AreaDel');
Route::get('AreaDelall',  'Admin\AreaListController@AreaDelall');
Route::get('Areadelete',  'Admin\AreaListController@Areadelete');

// 后台订单管理
Route::get('OrderList',  'Admin\OrderController@OrderList');
// 后台订单管理 删除
Route::get('OrderDel',  'Admin\OrderController@OrderDel');
// 后台订单修改价格
Route::get('OrderUpdate',  'Admin\OrderController@OrderUpdate');
// 后台订单搜索
Route::get('OrderSearch',  'Admin\OrderController@OrderSearch');
// 订单详情
Route::get('OrderXiang',  'Admin\OrderController@OrderXiang');
// 鼠标划过详情
Route::get('OrderXiangqing',  'Admin\OrderController@OrderXiangqing');

//后台酒店管理
Route::get('HotelShow', 'Admin\HotelController@show');
Route::any('HotelAdd', 'Admin\HotelController@add');
Route::any('HotelEdit', 'Admin\HotelController@edit');
Route::get('HotelDel', 'Admin\HotelController@del');
Route::get('HotelSearch', 'Admin\HotelController@search');
Route::get('HotelQup', 'Admin\HotelController@qup');

//后台户型管理
Route::get('RoomShow', 'Admin\HotelController@roomlist');
Route::any('RoomAdd', 'Admin\HotelController@roomadd');
Route::any('RoomEdit', 'Admin\HotelController@roomedit');
Route::get('RoomDel', 'Admin\HotelController@roomdel');
