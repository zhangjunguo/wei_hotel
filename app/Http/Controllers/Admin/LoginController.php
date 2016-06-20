<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
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
              $ip=Request::getClientIp();
          $username=Request::input('username');
          $pwd=md5(Request::input('pwd'));
          $user= DB::table('admin')->where('adm_name',$username)->where('adm_pass',$pwd)->first();
          // print_r($user);die;
          if ($user){
            Session::put('username',$username);
            Session::put('ip',$ip);
            Session::put('uid',$user->adm_id);
            $uid=Session::get('uid');
            $arr=DB::table('admin')
            ->join('adm_role', 'adm_role.adm_id', '=', 'admin.adm_id')
            ->join('role', 'adm_role.ro_id', '=', 'role.ro_id')
            ->where('admin.adm_id',$uid)
            ->first();
            Session::put('rname',$arr->ro_name);
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