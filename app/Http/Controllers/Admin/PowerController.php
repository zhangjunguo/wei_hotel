<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request,Session;
use App\Http\Controllers\Controller;
class PowerController extends Controller {
	// 权限添加页面
	public function add()
	{
	   $results = DB::select('select * from wei_power  where pid =0');
	   return view('admin.poweradd')->with('results',$results);
	}
	// 权限添加
	public function insert()
	{
		$name=Request::input('p_name');
		$pid=Request::input('pid');
		$routes=Request::input('p_routes');
		$re = DB::table('power')->insert(['p_name'=>$name,'pid'=>$pid,'p_routes'=>$routes]);
		if($re){
        $username=Session::get('username');
          $date=date("Y-m-d H:i:s");
          $ip=Session::get('ip');
          $content="添加一条权限";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]); 
			  return redirect('powerlist');
		}
	}
	// 权限列表
	public function lists()
	{
	   $results = DB::table('power')->simplePaginate(5);
       return view('admin.powerlists')->with('results',$results);
	}
    public  function delete()
    {
        $id=Request::input('id');
        $re = DB::table('power')->where('p_id',$id)->delete();
        if($re){ 
          $username=Session::get('username');
          $date=date("Y-m-d H:i:s");
          $ip=Session::get('ip');
          $content="删除一条权限信息";
          $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
          return redirect('powerlist');
        }
    }
    public function sel()
    {
    $act = Request::input('act');
    // echo $act;
    if($act == 'powersel') {

      $id = Request::input('id');
      $results = DB::select('select * from wei_power  where pid =0');
      $arr = DB::table('power')->where('p_id',$id)->get();
      return view('admin.poweredit')->with('arr',$arr)->with('results',$results);
      } 
    elseif($act == 'powerupdate') {
      $name = Request::input('name');
      // print_r($username);die;
      $pid = Request::input('pid');
      $routes = Request::input('routes');
      $id = Request::input('id');
      $re = DB::table('power')->where('p_id',$id)->update(['p_name'=>$name,'pid'=>$pid,'p_routes'=>$routes]);
           if($re){
            $username=Session::get('username');
            $date=date("Y-m-d H:i:s");
            $ip=Session::get('ip');
            $content="编辑一条权限信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
              return redirect('powerlist');
           } 
      }
    } 
	// 权限分配页面
	public function allot()
	{
       $data=DB::select('select * from wei_power');
       $arr= $this->selall_level($data,$pid=0,$level=0);
       // print_r($arr);die;
       $results=DB::select('select * from wei_role');
       return view('admin.powerallot')->with('results',$results)->with('arr',$arr);
    }
    // 递归处理
	public function selall_level($data,$pid=0,$level=0){
        //定义一个静态数组
        static $arr = array();
        foreach($data as $key=>$v){
            if($v->pid==$pid){
                $v->level = $level;
                $arr[] = $v;
                $this->selall_level($data,$v->p_id,$level+1);
            }
        }
        return $arr;
    }
    // 权限分配
    public function allotok()
    {
    	$data['ro_id']   = Request::input('rid');
        $data['p_id']    = Request::input('p_id');
       
        $res = DB::table('role_power')->where('ro_id',$data['ro_id'])
                                    ->where('p_id',$data['p_id'])
                                    ->get();
        if($res){
            echo "该角色已经拥有该权限";die;
        }else{
         $arr = array();
		     for($i=0;$i<count($data['p_id']);$i++){
			     $arr['ro_id'] = $data['ro_id'];
			     $arr['p_id'] = $data['p_id'][$i]; 
		       $re = DB::table('role_power')->insert($arr);
		      }
         if ($re){
          $username=Session::get('username');
          $date=date("Y-m-d H:i:s");
          $ip=Session::get('ip');
          $content="分配权限";
          $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
         	 return redirect('powerlist');
         }
        }
    }
}