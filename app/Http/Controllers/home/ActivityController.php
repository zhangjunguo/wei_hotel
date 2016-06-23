<?php

namespace App\Http\Controllers\home;

use DB,Request,Session;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{   
    /**
     * 展示活动页面
     */
    public function Index()
    {
        //查询全部活动
        $data = DB::table('activity')->where('act_start_time', '<', time())->where('act_end_time', '>', time())->paginate(8);

        return view('home/Activitys')->with('data', $data);
    }

    /**
     * 展示活动详情
     * @param int $act_id 活动ID
     */
    public function ActivityInfo()
    {
        //接值
        $act_id = Request::get('act_id');

        //查询
        $data = DB::table('activity')->where('act_id', $act_id)->first();

        return view('home/news')->with('data', $data);
    }

    /**
     * 参与活动
     */
    public function JoinAct()
    {
        //接值
        $data = Request::all();
        $u_id = Request::get('u_id');
        $act_id = Request::get('act_id');

        $arr = DB::table('vip_act')->where('u_id', $u_id)->where('act_id', $act_id)->first();

        if($arr){
            echo '1';
        }else{
            DB::table('vip_act')->insert($data);
            DB::table('users')->where('u_id', $u_id)->increment('user_score', 100);
            echo '2';
        }
    }
}
