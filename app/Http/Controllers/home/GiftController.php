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

    /*
     * 入单
     */
    public function exchangeOrder()
    {
        $data = Request::all();

        $region_data = DB::table('region')->get();
        // print_r($region_data);die;
        $str = "";
        foreach ($region_data as $k => $v) {
            if ($data['province'] == $v->region_id) {
                $str .= $v->region_name;
            }
            if ($data['city'] == $v->region_id) {
                $str .= $v->region_name;
            }
            if ($data['county'] == $v->region_id) {
                $str .= $v->region_name;
            }
        }
        $str .= $data['addre'];
        $arr['addre'] = $str;
        $arr['u_id'] = Session::get('user_id');
        $arr['go_score'] = $data['go_score'];
        $arr['phone'] = $data['phone'];
        $arr['g_id'] = $data['g_id'];
        $arr['go_time'] = time();
        $arr['go_number'] = uniqid('E');
        // print_r($arr);
        $bool = DB::table('gift_order')->insert($arr);
        if ($bool) {
            $content = "尊敬的用户" . Session::get('user_name') . "你已经下单成功(" . $data['g_name'] . ")，我们会以火箭的速度发货,记得给好评啊【一路狂奔】";
            $result = file_get_contents("http://api.jisuapi.com/sms/send?mobile=" . $arr['phone'] . "&content=" . $content . "&appkey=49f049d351201fa6 ");
            $jsonarr = json_decode($result, true);
            if ($jsonarr['status'] == 0) {
                $user_score = ceil(DB::table('users') -> where('u_id',$arr['u_id']) -> pluck('user_score')) -  ceil($arr['go_score']);
                DB::table('users') -> where('u_id',$arr['u_id']) -> update(['user_score'=>$user_score]);
                echo "<script>alert('下单成功');location.href='home/Gift'</script>";
            }
        }else{
            echo "<script>alert('手机号有问题');location.href='home/Gift'</script>";
        }
    }
}

