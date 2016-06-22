<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use DB,Session,Request;

class AccountController extends Controller
{	
	/**
	 * 展示我的格子
	 */
    public function Index()
    {   
        $user_name = Session::get('user_name');
        
        if(!empty($user_name)){
            return view('home/user_account');
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

        return view('home/my_gift');
    }

    /**
     * 展示我的订单
     */
    public function MyOrder()
    {   
        $user_name = Session::get('user_name');
        if(!empty($user_name)){
            $user_id = Session::get('user_id');
            // echo $user_id;die;
            $arr = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->get();

            $sum = count($arr);    //总条数
            $number = 3;    //每页条数
            $pages = ceil($sum/$number); //总页数
            $page = Request::input('page')?Request::input('page'):1; //当前页
            $last = $page<=1 ? 1 : $page-1 ;   //上一页
            $next = $page>=$pages ? $pages : $page+1 ;  //下一页
            $start = ($page-1)*$number;
            $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id limit $start,$number";
            $data['data'] = DB::select($sql);
            
            $data['last'] = $last;
            $data['next'] = $next;
            $data['pages'] = $pages;


            return view('home/my_order',compact('data'));
        }else{
            return redirect('home/Login');
        }
    }
    /**
     * 未完成订单
     * @return [type] [description]
     */
    public function my_order_no()
    {   
        $user_id = Session::get('user_id');
        $arr = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->where('o_state',2)->get();
         $sum = count($arr);    //总条数
        $number = 3;    //每页条数
        $pages = ceil($sum/$number); //总页数
        $page = Request::input('page')?Request::input('page'):1; //当前页
        $last = $page<=1 ? 1 : $page-1 ;   //上一页
        $next = $page>=$pages ? $pages : $page+1 ;  //下一页
        $start = ($page-1)*$number;
        $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id && o_state=2 limit $start,$number";
        $data['data'] = DB::select($sql);
        // dd($data['data']);die;
        $data['last'] = $last;
        $data['next'] = $next;
        $data['pages'] = $pages;


        return view('home/my_order_no',compact('data'));
    }

    /**
     * 已完成订单
     * @return [type] [description]
     */
    public function my_order_yes()
    {   
        $user_id = Session::get('user_id');
        $arr = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->where('o_state',3)->get();
         $sum = count($arr);    //总条数
        $number = 3;    //每页条数
        $pages = ceil($sum/$number); //总页数
        $page = Request::input('page')?Request::input('page'):1; //当前页
        $last = $page<=1 ? 1 : $page-1 ;   //上一页
        $next = $page>=$pages ? $pages : $page+1 ;  //下一页
        $start = ($page-1)*$number;
        $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id && o_state=3 limit $start,$number";
        $data['data'] = DB::select($sql);
        // dd($data['data']);die;
        $data['last'] = $last;
        $data['next'] = $next;
        $data['pages'] = $pages;


        return view('home/my_order_yes',compact('data'));
    } 

    /**
     * 订单详情
     */
    public function Order_Info()
    {
        $o_id = Request::input('id');
       /* $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where o_id=$o_id";
        $data = DB::query($sql);*/
        $data = DB::table('hotel_order')->join('room', 'hotel_order.h_id', '=', 'room.h_id')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('o_id',$o_id)->first();
        // dd($data);die;
        return view('home/order_info',compact('data'));
    }

     /**
     * 展示我的信息
     */
    public function MyInfo()
    {
    	return view('home/my_list');
    }

    /**
     * 展示我的收藏
     */
    public function MyCollection()
    {
        return view('home/my_Collection');
    }
}
