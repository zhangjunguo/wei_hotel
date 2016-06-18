<?php 

namespace App\Http\Controllers\Admin;

use DB,Request,Session;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

     // 登录页面
     public function login()
     {
          return view('admin.login');
     }
 
     // 登录操作
     public function PostLogin()
     {    

          $username=Request::input('username');
          $pwd=Request::input('pwd');
          $user= DB::table('admin')->where('adm_name',$username)->where('adm_pass',md5($pwd))->first();;
          // print_r($user);die;
          if ($user){
            Session::put('username',$username);
            Session::put('uid',$user->adm_id);
            return redirect('admin')->with('message', '成功登录');
          } 
          else {
            return redirect('login')->with('message', '用户名密码不正确') ->withInput();
          }
     }
 
     // 登出
     public function Logout()
     {
          Session::forget('username');
           return redirect('/login');
     }
 
 }