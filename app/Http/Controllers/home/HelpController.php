<?php

namespace App\Http\Controllers\home;
use DB,Session,Request;
use App\Http\Controllers\Controller;
header('content-type:text/html;charset=utf8');
class HelpController extends Controller
{	
	/**
	 * 展示帮助页面
	 */
    public function Index() 
    {
    	$results =DB::table('article')
                    ->whereIn('ar_id', [12, 13,14])->get();;
    	return view('home/help')->with('results',$results);
      }
}
