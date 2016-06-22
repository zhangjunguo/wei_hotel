<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

use Request,DB,Session,Mail,Validator;


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
        $data['user_email'] = Request::input('mobile_email');
        $user_pass_confirmation = Request::input('pass');

        $rules = [
            'user_email' => "required|email",
            'user_phone' => "required|digits:11",
            'user_pass' =>"required"
        ];

        $messages = [
            'user_email.required' => "邮箱不能为空",
            'user_email.email' => "邮箱格式错误",
            'user_phone.required' => "手机号不能为空",
            'user_phone.digits' => "手机号为11位", 
            'user_pass.required' => "密码不能为空"
            
        ];

        $validator = Validator::make($data, $rules, $messages);

         if ($validator->fails())
        {
            return redirect('home/Register')->withErrors($validator);
        }
        
        $res = DB::table('users')->insert($data);
        if($res){
            return redirect('/');
        }else{
            echo "<script>alert('注册失败');location.href='Register'</script>";
        }
    }

    /**
     * 忘记密码
     */
    public function Pwd()
    {
        return view('home/pwd');
    }

    /**
     * 手机找回页面
     */
    public function Pwd_phone()
    {
        return view('home/pwd_phone');
    }

    /**
     * 手机找回
     */
    public function pwd_phone_method()
    {
        $phone = trim(Request::input('phone')) ;
        $code = trim(Request::input('code'));
        $user_pass = md5(Request::input('user_pass'));

        $number = Session::get('code');
        

        if($code == $number){
             $res = DB::table('users')->where('user_phone',$phone)->update(['user_pass'=>$user_pass]);
             if($res){
                echo "<script>alert('修改成功,请重新登录');location.href='Login'</script>";
             }else{
                echo "<script>alert('修改失败');location.href='pwd_phone'</script>";
             }
        }else{
            echo "<script>alert('验证码错误');location.href='pwd_phone'</script>";
        }
    }

     /**
     * 发送短息验证码
     */
    public function send_code()
    {   
        //Session::put('code',"1234");
        $phone = Request::input('phone');
        $number = rand(1000,9999);
        $content = "尊敬的用户您好，您的验证码是".$number."，10分钟内有效。您正在修改密码，如非本人操作，请忽略。【格子微酒店】";
        $url = "http://api.jisuapi.com/sms/send?mobile=$phone&content=$content&appkey=786103ab10a3cbd0";
        $str = file_get_contents($url);
        $data = json_decode($str);
        
        Session::put('code',$number); 
        
    }
    /**
     * 邮箱找回密码页面
     */
    public function pwd_email()
    {
        return view('home/pwd_email');
    }

    /**
     * 发送邮箱验证码
     */
    public function send_code_email()
    {   
        $number = rand(1000,9999);
        $content = "尊敬的用户您好，您的验证码是".$number."，10分钟内有效。您正在修改密码，如非本人操作，请忽略。【格子微酒店】";
        $data = Mail::raw($content, function ($message) {
            $message ->to(trim(Request::input('phone')))->subject('格子微酒店');
        });
        if($data){
            Session::put('code_email',$number);
        }
        return $data;
    }
   /**
    * 邮箱找回密码
    */
   public function pwd_email_method()
   {    
        // echo 1;die;
        $arr['email'] = trim(Request::input('phone')) ;
        $code = trim(Request::input('code'));
        $user_pass = md5(Request::input('user_pass'));

        $rules = [
            'email' => "required|email",
        ];

        $messages = [
            'email.required' => "邮箱不能为空",
            'email.email' => "格式不正确!",
            ''
        ];

        $validator = Validator::make($arr, $rules, $messages);
        
        if ($validator->fails())
        {
            return redirect('home/pwd_email')->withErrors($validator);
        }

        $number = Session::get('code_email');
         // echo $number.$code;die;
        if($number == $code){
            $str = DB::table('users')->where('user_email',$arr['email'])->pluck('user_pass');
            // echo $user_pass."<br/>";
            // echo $str;die;
            if($str != $user_pass){

                 $res = DB::table('users')->where('user_email',$arr['email'])->update(['user_pass'=>$user_pass]);
                if($res){
                    echo "<script>alert('修改成功,请重新登录');location.href='Login'</script>";
                }else{
                    echo "<script>alert('修改失败');location.href='pwd_email'</script>";
                }

            }else{
                echo "<script>alert('密码与原密码相同');location.href='pwd_email'</script>"; 
            }

        }else{
            echo "<script>alert('验证码错误');location.href='pwd_email'</script>";
        }
   }


   /**
    * 退出
    */
   public function Loginout()
   {    
        
        Session::flush();
        return redirect('/');
   }
}
