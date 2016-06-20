<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Request,DB,Session;

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
     * 登录
     */
    public function Login()
    {
        $user_name = Request::input('user_name');
        $user_pwd = md5(Request::input('user_pwd'));
        $remember = Request::input('remember');

        // $sql = "select * from wei_users where user_phone = '$user_name'";
        $user = DB::table('users')->where('user_phone',$user_name)->first();
        if($user){
            if($user->user_pass == $user_pwd){
                Session::put('user_name',$user_name);
                Session::put('user_id',$user->u_id);
                return redirect('/');
            }else{
                echo "<script>alert('密码错误');location.href='Login'</script>"; 
            }
        }else{
            echo "<script>alert('用户名错误');location.href='Login'</script>";
        }
    }

    /**
     * 展示注册页面
     */
    public function Register()
    {
    	return view('home/register');
    }

    /**
     * 注册
     */
    public function Enroll()
    {
        $data['user_phone'] = Request::input('mobile_phone');
        $data['user_pass'] = md5(Request::input('id_card'));
        $res = DB::table('users')->insert($data);
        if($res){
            return redirect('/');
        }else{
            echo "<script>alert('注册失败');location.href='Register'</script>";
        }
    }
}
