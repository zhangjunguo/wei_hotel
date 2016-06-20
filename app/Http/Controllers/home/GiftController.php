<?php

namespace App\Http\Controllers\home;

use DB,Request,Session;
use App\Http\Controllers\Controller;

class GiftController extends Controller
{	
	/**
	 * 展示礼物列表页面
	 */
    public function Index()
    {
        $gift_data = DB::table('gift')
            ->get();
        //print_r($gift_data);
    	return view('home/GiftList',['gift_data'=>$gift_data]);
    }

    /**
	 * 展示礼物详情页面
	 */
    public function GiftInfo()
    {

        $g_id = $_GET['g_id'];
        $onegift_data = DB::table('gift')
            ->where('g_id',$g_id)
            ->first();
        //print_r($onegift_data);die;
        return view('home/gift',['onegift_data'=>$onegift_data]);
    }

    /*
     *
     * 立即兑换
     */
    public function exchangeGift()
    {
        $g_id = Request::input('g_id');
        $g_score = Request::input('g_score');
        $data['g_name'] = Request::input('g_name');
        //echo $g_score;
        $user_id = Session::get('user_id');
        if(empty($user_id)){
           echo "<script>alert('你还没登录,请登录');location.href='home/Login'</script>";
        }

        //查看用户积分
       $score =  DB::table('users') -> where('u_id',$user_id) -> first();
        //var_dump($score);
        if($score->user_score < $g_score){
            echo "<script>alert('你好,你的积分只有'+$score->user_score+',再看看别的');location.href='home/Gift'</script>";
        }

        $data['g_id'] = $g_id;
        $data['go_score'] = $g_score;

        return view('home/orderGift',['order_data'=>$data]);

    }
}

