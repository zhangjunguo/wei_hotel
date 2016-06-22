<?php

namespace App\Http\Controllers\home;

header('content-type:text/html;charset=utf8');

use DB,Session,Request;
use App\Http\Controllers\Controller;


class AccountController extends Controller
{	
	/**
	 * 展示我的格子
	 */
    public function Index()

    {

        $user_name = Session::get('user_id');
        
        if(!empty($user_name)){

            //查询用户资料
            $data = DB::table('users')->where('u_id', $user_name)->first();
            return view('home/user_account')->with('data', $data);
        }else{
            return redirect('home/Login');
        }

    }

    /**
     * 展示我的礼物
     */
    public function MyGift()
    {
    	$user_name = Session::get('user_name');
    	$u_id = Session::get('user_id');

    	//$data = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->paginate(3);

        $count = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->count();


        //echo $count;
        
        //设置每页显示数
        $length = 3;

        //计算总页数
        $page_sum = ceil($count/$length);

        //获取当前页
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        //设置上一页 下一页
        $prev = $page-1 <= 1 ? 1 : $page-1;
        $next = $page+1 > $page_sum ? $page_sum : $page+1;
    
        $data['str'] = "<a href='javascript:page(1)'>首页</a>
                        <a href='javascript:page($prev)'>上一页</a>
                        <a href='javascript:page($next)'>下一页</a>
                        <a href='javascript:page($page_sum)'>尾页</a>";

        //计算偏移量
        $offset = ($page-1)*$length;
        
        $data['data'] = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->skip($offset)->take($length)->get();
            
        return view('home/my_gift')->with('data', $data);
   
    }

    public function MyGiftNo()
    {
        $user_name = Session::get('user_name');
        $u_id = Session::get('user_id');

        //$data = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->paginate(3);

        $count = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '=', '0')->count();


        //echo $count;
        
        //设置每页显示数
        $length = 3;

        //计算总页数
        $page_sum = ceil($count/$length);

        //获取当前页
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        //设置上一页 下一页
        $prev = $page-1 <= 1 ? 1 : $page-1;
        $next = $page+1 > $page_sum ? $page_sum : $page+1;
    
        $data['str'] = "<a href='javascript:page(1)'>首页</a>
                        <a href='javascript:page($prev)'>上一页</a>
                        <a href='javascript:page($next)'>下一页</a>
                        <a href='javascript:page($page_sum)'>尾页</a>";

        //计算偏移量
        $offset = ($page-1)*$length;
        
        $data['data'] = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '=', '0')->skip($offset)->take($length)->get();
            
        return view('home/my_giftno')->with('data', $data);
    }

    public function MyGiftYes()
    {
        $user_name = Session::get('user_name');
        $u_id = Session::get('user_id');

        //$data = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->paginate(3);

        $count = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '!=', '0')->count();


        //echo $count;
        
        //设置每页显示数
        $length = 3;

        //计算总页数
        $page_sum = ceil($count/$length);

        //获取当前页
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        //设置上一页 下一页
        $prev = $page-1 <= 1 ? 1 : $page-1;
        $next = $page+1 > $page_sum ? $page_sum : $page+1;
    
        $data['str'] = "<a href='javascript:page(1)'>首页</a>
                        <a href='javascript:page($prev)'>上一页</a>
                        <a href='javascript:page($next)'>下一页</a>
                        <a href='javascript:page($page_sum)'>尾页</a>";

        //计算偏移量
        $offset = ($page-1)*$length;
        
        $data['data'] = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '!=', '0')->skip($offset)->take($length)->get();
            
        return view('home/my_giftyes')->with('data', $data);
    }

    /**
     * 礼品详情
     */
    public function MyGiftX()
    {
        //接值
        $go_id = Request::get('go_id');

        $data = DB::table('gift_order')->join('gift', 'gift.g_id', '=' ,'gift_order.g_id')->where('go_id', $go_id)->first();

        return view('home/my_giftx')->with('data', $data);
    }

    /**
     * 展示我的订单
     */
    public function MyOrder()
    {   
        $user_name = Session::get('user_name');
        if(!empty($user_name)){
            return view('home/my_order');
        }else{
            return redirect('home/Login');
        }
    	
    }

     /**
     * 展示我的信息
     */
    public function MyInfo()
    {
        $u_id = Session::get('user_id');

        $data = DB::table('users')->where('u_id', $u_id)->first();

    	return view('home/my_list')->with('data', $data);
    }

    /**
     * 展示我的收藏
     */
    public function MyCollection()
    {
        $user_id = Session::get('user_id');
        $results = DB::table('collect')
        ->join('hotel','collect.h_id', '=', 'hotel.h_id')
        ->where('u_id',$user_id)
        ->get();
        return view('home/my_Collection')->with('results',$results);
    }

    /**
     * 上传头像
     */
    public function MyImg()
    {
        $file = Request::file('file');

        //文件上传
        $type = $file->getClientOriginalExtension();
        //echo $type;die;
        $newName = md5(time().rand(1000,9999)).'.'.$type;
        $path = $file->move('uploads/User',$newName);

        //接用户
        $u_id = Session::get('user_id');

        //上传头像
        DB::table('users')->where('u_id', $u_id)->update(['user_img'=>$newName]);

        return redirect('home/MyAccount');
    }
}
