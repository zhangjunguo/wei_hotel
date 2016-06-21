<?php
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');

use DB,Request,Session;
use Mail;
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
        $adm_time = time();
        $username = Request::input('username');
        $pwd = md5(Request::input('pwd'));
        $user= DB::table('admin')->where('adm_name',$username)->where('adm_pass',$pwd)->first();
        // print_r($user);die;
        if ($user){
            if($adm_time - $user->adm_time>10){
                DB::table('admin') -> where('adm_name',$username) -> update(['adm_update_num'=>0]);
                Session::put('username',$username);
                Session::put('uid',$user->adm_id);
                return redirect('admin')->with('message', '成功登录');
            }else{
                echo '<script>alert("客官再等会,10秒不够呢");location.href="login"</script>';
            }
        }
        else {
            $bool = DB::table('admin')->where('adm_name',$username)->first();
            if($bool){
                //echo "<script>alert('ddd');location.href='login'</script>";
                $adm_update_num = DB::table('admin') -> where('adm_name',$username) -> pluck('adm_update_num');
                $adm_update_num = $adm_update_num+1;
                if($adm_update_num >= 3){
                    $adm_time = time();
                    DB::table('admin') -> where('adm_name',$username) -> update(['adm_time'=>$adm_time]);
                    echo '<script>alert("输入次数已够,请您10秒后再登");location.href="login"</script>';
                }else{
                    DB::table('admin') -> where('adm_name',$username) -> update(['adm_update_num'=>$adm_update_num]);
                    echo '<script>alert("密码错误,输入次数还剩"+'.(3-$adm_update_num).');location.href="login"</script>';
                }

            }else{
                echo "<script>alert('用户名错误');location.href='login'</script>";
            }
        }
    }

    /*
     *
     * 忘记密码
     */
    public function forgotPass()
    {
        $email = Request::input('email');
        //echo $email;die;
        $now_time = time();
        $url = 'http://www.hotel.com/resetPass?'.md5('email')."=".urlencode($email)."&".md5('now_time')."=".urlencode($now_time);
        $bool =  Mail::send('admin.email', ['data' => $url], function($message)
        {
            $email = Request::input('email');
            $message -> to($email, 'John Smith') -> subject('Welcome!');
        });

        if($bool){
            echo "<script>alert('发送成功');location.href='https://mail.qq.com/'</script>";
        }else{
            echo "<script>alert('发送失败');location.href='login'</script>";
        }
        /* Mail::raw('这是一封测试邮件', function ($message) {
             $to = '1244426046@qq.com';
             $message ->to($to)->subject('测试邮件');
         });*/
    }

    /*
     *
     * 重置密码页面
     */
    public function resetPass()
    {
        $now_time = $_GET[md5('now_time')];
        if(time() - $now_time > 60*5){
            echo "<script>alert('邮件已过期');location.href='login'</script>";
        }
        $email = $_GET[md5('email')];
        return view('admin.resetPass',['email'=>$email]);
    }

    /*
     *
     * 重置密码
     */
    public function passReset()
    {
        $adm_pass = Request::input('adm_pass');
        $check_adm_pass = Request::input('check_adm_pass');
       // echo $adm_pass;
        //echo $check_adm_pass;
        if($adm_pass==$check_adm_pass){
            $email = Request::input('email');
            $bool = DB::table('admin')->where('adm_email',$email)->update(['adm_pass'=>md5($adm_pass)]);
            if($bool){
                echo "<script>alert('修改成功');location.href='login'</script>";
            }
        }
    }

    // 登出
    public function Logout()
    {
        Session::forget('username');
        return redirect('/login');
    }
}

