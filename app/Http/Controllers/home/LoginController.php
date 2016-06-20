<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{	
	/**
	 * 展示登录页面
	 */
    public function Index()
    {
    	return view('home/login');
    }

    /**
     * 展示注册页面
     */
    public function Register()
    {
    	return view('home/register');
    }
}
