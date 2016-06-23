<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request,Session;
use App\Http\Controllers\Controller;
class AdminController extends Controller {
	// 管理中心页面
	public function index()
	{   
	   return view('admin.main');
	}
	// 用户管理列表
	public function  lists()
	{
	  $results = DB::select('select * from wei_admin  where adm_id !=1');

	  // print_r($results);die;
    return view('admin.adminlist')->with('results',$results);
	}
  //管理员添加页面
	public function add()
	{
	    return view('admin.adminadd');
	}
  //管理员添加
  public function insert()
    {
    	$username = Request::input('username');
		  $pwd = md5(Request::input('pwd'));
		  $email = Request::input('email');
		  $phone = Request::input('phone');
      $re = DB::table('admin')->insert(['adm_name'=>$username,'adm_pass'=>$pwd,'adm_email'=>$email,'adm_phone'=>$phone]);
		  if($re){ 
       $username=Session::get('username');
       $date=date("Y-m-d H:i:s");
       $ip=Session::get('ip');
       $content="添加一条管理员信息";
       $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
			  return redirect('adminlist');
		  }
    }
    // 管理员删除
    public function delete()
    {
        $id = Request::input('id');
        $re = DB::table('admin')->where('adm_id',$id)->delete();
        if($re){
           $username=Session::get('username');
       $date=date("Y-m-d H:i:s");
       $ip=Session::get('ip');
       $content="删除一条管理员信息";
       $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]); 
        	return redirect('adminlist');
        }
	}
  // 管理员编辑
	public function sel()
    {
    $act = Request::input('act');
    // echo $act;
    if($act == 'adminsel') {

      $id = Request::input('id');
      $arr = DB::table('admin')->where('adm_id',$id)->get();
      return view('admin.adminedit')->with('arr',$arr);
      } 
    elseif($act == 'adminupdate') {
      $username = Request::input('username');
      // print_r($username);die;
      $email = Request::input('email');
      $phone = Request::input('phone');
      $id = Request::input('id');
      $re = DB::table('admin')->where('adm_id',$id)->update(['adm_name'=>$username,'adm_email'=>$email,'adm_phone'=>$phone]);
      if($re){
       $username=Session::get('username');
       $date=date("Y-m-d H:i:s");
       $ip=Session::get('ip');
       $content="修改管理员信息";
       $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
        return redirect('adminlist');
       } 
      }
    } 
    // 管理员名即点即改
     public function update1()
     {
     $name = Request::input('name'); 
     $id    = Request::input('id'); 
     $re=DB::table('admin')->where('adm_id',$id)->update(['adm_name'=>$name]);
     // print_r($data);die;
     if ($re) {
      echo 1;
       $username=Session::get('username');
       $date=date("Y-m-d H:i:s");
       $ip=Session::get('ip');
       $content="修改管理员姓名";
       $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
     }else{
      echo -1;    
     }
    }
    // 管理员分配页面
    public function  allot()
    {
    	$results = DB::select('select * from wei_admin where adm_id !=1');
    	$arr = DB::select('select * from wei_role');
      return view('admin.roleallot')->with('arr',$arr)->with('results',$results);
    }
    // 管理员分配
    public function allotok()
    {
        $data['adm_id']    = Request::input('uid');
        $data['ro_id']    = Request::input('rid');
        $res = DB::table('adm_role')->where('adm_id',$data['adm_id'])
                                    ->where('ro_id',$data['ro_id'])
                                    ->get();
        if($res){
            echo "该管理员已经存在该角色";die;
        }else{
          // 添加到管理员日志
          $re = DB::table('adm_role')->insert($data);
          $username=Session::get('username');
          $date=date("Y-m-d H:i:s");
          $ip=Session::get('ip');
          $content="分配角色";
          $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
          return redirect('rolelist');
        }
    }
    // 管理员角色列表
    public function rolelist()
    {
      $arr=DB::table('adm_role')
      ->join('admin', 'adm_role.adm_id', '=', 'admin.adm_id')
      ->join('role', 'adm_role.ro_id', '=', 'role.ro_id')
      ->get();
       return view('admin.rolelist')->with('arr',$arr);
    }
    // 管理员日志列表
    public function log()
    {
       $results = DB::table('log')->simplePaginate(5);
       return view('admin.log')->with('results',$results);
    }
    //管理员个人信息
    public function information()
    {
      $uid=Session::get('uid');
      $results=DB::table('admin')
            ->where('adm_id',$uid)
            ->get();
      return view('admin.information')->with('results',$results);
    }
}