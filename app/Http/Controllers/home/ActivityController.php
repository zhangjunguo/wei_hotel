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
}
