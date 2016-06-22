<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB,Request,Session;

class CommentController extends Controller
{		
	/**
	 * 评论列表
	 */
	public function commentList()
    {
        $comment_data = DB::table('comment')
            ->join('hotel', 'hotel.h_id', '=', 'comment.h_id')
            ->join('users', 'users.u_id', '=', 'comment.u_id')
            ->select('h_name','h_type','user_name','c_content','c_time','c_id','c_star')
            ->paginate(3);
        //print_r($comment_data);die;
        return view('admin/commentList',['comment_data'=>$comment_data]);
    }
}