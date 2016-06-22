<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request,Session;
use App\Http\Controllers\Controller;
class UserController extends Controller {
	public function lists(){
		 $results = DB::select('select * from wei_users');
      	 return view('admin.userlist')->with('results',$results);
	}

	function del($u_id){
		  $user=DB::delete('delete from wei_users where u_id = ?',[$u_id]);
      		if($user){
            $username=Session::get('username');
            $date=date("Y-H-d m:i:s");
            $ip=Session::get('ip');
            $content="删除一条用户信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
      			echo "<script>
                alert('删除成功');
                location.href = '".URL('userlist')."';
                    </script>";
      		}else{
      			echo "<script>
                alert('删除失败');
                location.href = '".URL('userlist')."';
                    </script>";
      		}
    		  
	}
	
   public function show() {
   	$u_id = Request::input('id');
   	// echo $u_id;die;
//echo "1";
     $users = DB::select('select * from wei_users where u_id = ?',[$u_id]);
     return view('admin/userup',compact('users'));
   }
   public function update() {
   		$id=	Request::input('u_id');
   		// print_r($id);die;
      $name = Request::input('user_name');
      $pass = Request::input('user_pass');
      $email = Request::input('user_email');
      $phone = Request::input('user_phone');
      $score = Request::input('user_score');
      $money = Request::input('user_money');
      $sex = Request::input('user_sex');
      $img = Request::input('user_img');
      //DB::update('update wei_users set name = ? where u_id = ?',[$name,$u_id]);
     $update= DB::table('users')->where('u_id',$id)->update(['user_name'=>$name,'user_pass'=>$pass,'user_email'=>$email,'user_phone'=>$phone,'user_score'=>$score,'user_money'=>$money,'user_sex'=>$sex,'user_img'=>$img]);
     // print_r($update);die;	
      if($update){
           $username=Session::get('username');
          $date=date("Y-H-d m:i:s");
          $ip=Session::get('ip');
            $content="修改一条用户信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
      			echo "<script>
                alert('修改成功');
                location.href = '".URL('userlist')."';
                    </script>";
      }else{
      			echo "<script>
                alert('修改失败');
                location.href = '".URL('userlist')."';
                    </script>";
      }
   }
 }
     		