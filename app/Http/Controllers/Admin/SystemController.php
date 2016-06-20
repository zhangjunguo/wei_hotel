<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request,Session;
use App\Http\Controllers\Controller;
class SystemController extends Controller {

   /*
      修改密码页面
    */
   
   public function updatePass()
   {
   	  $u_id = Session::get('uid');
   	  return view('admin/updatePass',['u_id'=>$u_id]);
   }

   /*
      修改密码
    */
   
   public function passUpdate()
   {
   	  $data = Request::all();
 		$user_data = DB::table('admin') -> where('adm_id',$data['adm_id']) ->first();
 		//print_r($user_data);die;
 		if($user_data->adm_pass!=md5($data['old_pass'])){
 			echo "<script>alert('原密码输入错误');location.href='updatePass'</script>";	
 		}

 		if($data['adm_pass']!=$data['check_pass']){
 			echo "<script>alert('新密码输入不一致');location.href='updatePass'</script>";	
 		}else{
 			$bool = DB::table('admin') ->where('adm_id',$data['adm_id']) ->update(['adm_pass'=>md5($data['adm_pass'])]);
 			if($bool){
 				echo "<script>alert('修改成功');location.href='login'</script>";
 			}
 		}
   	}
}