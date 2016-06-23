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
Route::get('home/MyGiftNo',"home\AccountController@MyGiftNo");
Route::get('home/MyGiftYes',"home\AccountController@MyGiftYes");
Route::get('home/MyGiftX', "home\AccountController@MyGiftX");
// 前台我的订单  
Route::get('home/MyOrder',"home\AccountController@MyOrder");
// Route::get('MyOrderpage',"home\AccountController@MyOrderPage");
Route::get('home/my_order_no',"home\AccountController@my_order_no");
Route::get('home/my_order_yes',"home\AccountController@my_order_yes");
//订单详情
route::get('home/order_info',"home\AccountController@Order_Info");

// 前台我的信息
Route::any('home/MyInfo',"home\AccountController@MyInfo");
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
// 登录
Route::post('home/Logingo',"home\LoginController@Login");

// 前台注册
Route::get('home/Register',"home\LoginController@Register");
// 注册
Route::post('home/enroll',"home\LoginController@Enroll");
//退出
route::get('home/loginout','home\LoginController@Loginout');
//忘记密码
Route::get('home/password','home\LoginController@Pwd');
//手机找回页面
Route::get('home/pwd_phone','home\LoginController@Pwd_phone');
//手机找回
route::post('home/pwd_phone_method','home\LoginController@pwd_phone_method');
//邮箱找回页面
route::any('home/pwd_email','home\LoginController@pwd_email');
//邮箱找回
route::any('home/pwd_email_method','home\LoginController@pwd_email_method');
//发送手机验证码
Route::get('home/send_code','home\LoginController@send_code');
//发送邮箱验证码
route::get('home/send_code_email','home\LoginController@send_code_email');
// 前台预订酒店
Route::get('home/Hotel',"home\HotelController@Index");
// 前台酒店列表
Route::any('home/HotelList',"home\HotelController@HotelList");
// 前台酒店详情
Route::any('home/HotelInfo',"home\HotelController@HotelInfo");
// 前台酒店评论
Route::get('home/HotelReview',"home\HotelController@HotelReview");
// 前台酒店简介
Route::get('home/HotelDesc',"home\HotelController@HotelDesc");
// 前台修改注入时间
Route::post('home/HoteUpdateTime',"home\HotelController@HoteUpdateTime");

// 前台添加评论页面
Route::get('home/comment',"home\CommentController@comment");
//前台提交评论
Route::get('home/commentok',"home\CommentController@commentok");
//前台提交评论
Route::get('home/show',"home\CommentController@show");

//用户上传头像
Route::any('home/UserImg', "home\AccountController@MyImg");

// 前台酒店预定
Route::get('home/HotelYU',"home\HotelController@HotelYU");
// 前台酒店收藏
Route::get('home/HotelColl',"home\HotelController@HotelColl");
// 酒店实景
Route::get('home/HoteReality',"home\HotelController@HoteReality");
// 酒店地图
Route::get('home/HotelMap',"home\HotelController@HotelMap");
// 酒店导航
Route::get('home/HotelGps',"home\HotelController@HotelGps");
// 酒店收藏
Route::get('home/HotelCollect',"home\HotelController@HotelCollect");
Route::get('home/HotelCollectDel',"home\HotelController@HotelCollectDel");
// 支付
Route::get('home/PAY',"home\PAYController@pay");
Route::get('home/return_url',"home\PAYController@return_url");




//前台礼物兑换
route::post('exchangeGift','home\GiftController@exchangeGift');
//前台礼物下单
route::post('exchangeOrder','home\GiftController@exchangeOrder');




// 后台管理

// 登陆页面
Route::get('login',  'Admin\LoginController@login');
 // 实现登陆
Route::post('PostLogin', 'Admin\LoginController@PostLogin');
// 实现登出
Route::any('Logout', 'Admin\LoginController@Logout');
//后台忘记密码
route::post('forgotPass','Admin\LoginController@forgotPass');
//重置密码页面
route::get('resetPass','Admin\LoginController@resetPass');
//密码重置
route::post('passReset','Admin\LoginController@passReset');
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
	//管理员个人信息页
	Route::get('information',  'Admin\AdminController@information');
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

	//酒店图片管理
	Route::any('HotelImg', 'Admin\HotelController@imgadd');

	//后台户型管理
	Route::get('RoomShow', 'Admin\HotelController@roomlist');
	Route::any('RoomAdd', 'Admin\HotelController@roomadd');
	Route::any('RoomEdit', 'Admin\HotelController@roomedit');
	Route::get('RoomDel', 'Admin\HotelController@roomdel');

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
     // 用户管理
	Route::get('userlist',  'Admin\UserController@lists');//用户信息
	Route::get('userdel/{u_id}',  'Admin\UserController@del');//用户删除
    Route::get('show',  'Admin\UserController@show');//用户修改
	Route::post('update',  'Admin\UserController@update');//用户修改
    //系统管理
	Route::get('updatePass',  'Admin\SystemController@updatePass');//密码修改页面
	Route::post('passUpdate',  'Admin\SystemController@passUpdate');//密码修改
	Route::get('gallery',  'Admin\SystemController@gallery');//画廊
	Route::get('calendar',  'Admin\SystemController@calendar');//日历
    // 评价管理
    route::get('commentList','Admin\CommentController@commentList');
    // 礼物管理
	//礼物列表
	route::get('giftList','Admin\GiftController@giftList');
	//礼物添加页面
	route::get('giftAdd','Admin\GiftController@giftAdd');
	//礼物添加
	route::post('addGift','Admin\GiftController@addGift');
	//礼物删除
	route::get('giftDel','Admin\GiftController@giftDel');
	//礼物编辑页面
	route::get('giftEdit','Admin\GiftController@giftEdit');
	//礼物编辑
	route::post('editGift','Admin\GiftController@editGift');
	//礼物名字验证唯一
	route::get('uniqueGift','Admin\GiftController@uniqueGift');





});


