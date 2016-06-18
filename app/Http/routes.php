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

// 登陆页面
Route::get('login',  'Admin\LoginController@login');
 // 实现登陆
Route::post('PostLogin', 'Admin\LoginController@PostLogin');
// 实现登出
Route::any('Logout', 'Admin\LoginController@Logout');
// 权限验证
Route::group(['middleware' => 'permission'], function(){
  	//后台主页
	Route::get('admin',  'Admin\AdminController@index');
	  // 管理员管理
	// 管理员列表
	Route::get('adminlist',  'Admin\AdminController@lists');
	// 管理员添加页
	Route::get('adminadd',  'Admin\AdminController@add');
	// 实现管理员添加
	Route::post('admininsert',  'Admin\AdminController@insert');
	// 实现管理员删除
	Route::get('admindel',  'Admin\AdminController@delete');
	// 管理员编辑页
	Route::any('adminsel',  'Admin\AdminController@sel');
	// 实现管理员信息修改
	Route::any('adminupdate',  'Admin\AdminController@update');
	// 实现管理员名称即点即改
	Route::get('adminupdate1',  'Admin\AdminController@update1');
	// 管理员角色分配页
	Route::get('roleallot',  'Admin\AdminController@allot');
	// 实现管理员角色分配
	Route::post('roleallotok',  'Admin\AdminController@allotok');
	// 管理员角色信息页
	Route::get('rolelist',  'Admin\AdminController@rolelist');
	// 管理员日志页
	Route::get('adminlog',  'Admin\AdminController@log');
	// 权限管理
	// 权限添加页
	Route::get('poweradd',  'Admin\PowerController@add');
	// 实现权限添加
	Route::post('powerinsert',  'Admin\PowerController@insert');
	// 权限列表页
	Route::get('powerlist',  'Admin\PowerController@lists');
	// 权限分配页面
	Route::get('powerallot',  'Admin\PowerController@allot');
	// 实现权限分配
	Route::post('powerallotok',  'Admin\PowerController@allotok');
	// 实现权限删除
	Route::get('powerdel',  'Admin\PowerController@delete');
	// 权限编辑页
	Route::any('powersel',  'Admin\PowerController@sel');
	// 实现权限修改
	Route::any('powerupdate',  'Admin\PowerController@update');

	// 后台地区管理
	Route::get('AreaList',  'Admin\AreaController@AreaList');
});


