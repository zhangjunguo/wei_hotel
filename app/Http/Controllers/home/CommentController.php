<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{	
	/**
	 * 展示添加评论页
	 */
    public function comment()
    {
    	return view('home/comment');
    }
}