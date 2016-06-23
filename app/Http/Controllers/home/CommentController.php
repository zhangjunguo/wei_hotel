<?php

namespace App\Http\Controllers\home;
use App\Http\Controllers\Controller;
use DB,Session,Request;
class CommentController extends Controller
{	
	/**
	 * 展示添加评论页
	 */
    public function comment()
    {
        $h_id=Request::input('h_id');
        Session::put('h_id',$h_id);
        // $arr = DB::table('comment')
        // ->join('users','comment.u_id', '=', 'users.u_id')
        // ->where('h_id',$h_id)
        // // ->take(5)
        // ->get();
        // // print_r($arr);die;
        // foreach($arr as $k => $v){
        // 	$arr[$k]->user_name = substr_replace($v->user_name,'*',3,3);
        // }
        $results=DB::table('hotel')->where('h_id',$h_id)->first();
    	return view('home/comment')->with('results',$results);
    }
    public function commentok()
    {
        $content=Request::input('content');
        $star=Request::input('star'); 
        $h_id=Session::get('h_id');
        $user_id=Session::get('user_id'); 
        $date=date("Y-m-d");
        $re = DB::table('comment')->insert(['u_id'=>$user_id,'c_content'=>$content,'c_time'=>$date,'h_id'=>$h_id,'c_star'=>$star]);
        if ($re) {
           echo 1;
        }
    }
   
}