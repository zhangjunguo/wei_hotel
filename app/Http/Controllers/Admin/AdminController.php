<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request;
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
	  $results = DB::select('select * from wei_admin');
      return view('admin.adminlist')->with('results',$results);
	}
	public function add()
	{
	    return view('admin.adminadd');
	}
    public function insert()
    {
    	  $username = Request::input('username');
		  $pwd = Request::input('pwd');
		  $email = Request::input('email');
		  $phone = Request::input('phone');
          $re = DB::table('admin')->insert(['adm_name'=>$username,'adm_pass'=>$pwd,'adm_email'=>$email]);
		 if($re){ 
			 return redirect('adminlist');
		 }
    }

}