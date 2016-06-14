<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class ActivityController extends Controller
{	
	/**
	 * 展示活动页面
	 */
    public function Index()
    {
    	return view('home/Activitys');
    }

    /**
     * 展示活动详情
     */
    public function ActivityInfo()
    {
    	return view('home/news');
    }
}
