<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB,Request,Session;

class ActivityController extends Controller 
{		
	/**
	 * 活动列表
	 */
	public function ActivityList()
	{	
		$data = DB::table('activity')->get();
		$sum = count($data); 									//总条数
		$number = 5 ;											//每页显示条数
		$pages = ceil($sum/$number);							//总页数
		$page = Request::input('page')?Request::input('page'):1;//当前页
		$last = $page<=1 ? 1 : $page-1 ;  	 					//上一页
		$next = $page>=$pages ? $pages : $page+1 ;  			//下一页
		$start = ($page-1)*$number;
		$data['data'] = array_slice($data,$start,$number);
		$data['last'] = $last;
		$data['next'] = $next;
		$data['pages'] = $pages;
		return view('admin/activitylist',compact('data'));
	}

	/**
	 * 活动添加
	 */
	public function ActivityAdd()
	{
		return view('admin/activityadd');
	}

	/**
	 * 活动入库
	 */
	public function ActivityInsert()
	{	
		if(Request::hasFile('act_img')){
			$file = Request::file('act_img');
			if($file){
				$data['act_img'] = $this->File($file);
				if($data['act_img']){
					$data['act_name'] = Request::input('act_name');
					$data['act_start_time'] = strtotime(Request::input('act_start_time'));
					$data['act_end_time'] = strtotime(Request::input('act_end_time'));
					$data['act_desc'] = Request::input('act_desc');
					//dd($data);die;
					$res = DB::table('activity')->insert($data);
					if($res){
						return redirect('activitylist');
					}else{
						return redirect('activitylist');
					}
				}
			}
		}

	}

	/**
	 * 活动删除
	 */
	public function ActivityDel()
	{
		$act_id = Request::input('id');
		$img = DB::table('activity')->where('act_id',$act_id)->pluck('act_img');
		$res = DB::table('activity')->where('act_id',$act_id)->delete();
		if($res){
			unlink($img);
			echo "<script>alert('删除成功');location.href='activitylist'</script>";
		}else{
			echo "<script>alert('删除失败');location.href='activitylist'</script>";
		}
	}

	/**
	 * 活动修改
	 */
	public function ActivitySave()
	{
		$act_id = Request::input('id');
		$data = DB::table('activity')->where('act_id',$act_id)->first();
		return view('Admin/activitysave',compact('data'));
	}

	/**
	 * 执行修改
	 */
	public function ActivityUpdate()
	{	
		$act_id = Request::input('act_id');
		$file = Request::file('act_img');
		//如果修改图片 则删除原图片 并进行修改
	 	if($file){
	 		$path = $this->File($file);
	 		$data['act_img'] = $path;
	 		$img = Request::input('img');
	 		unlink($img);
	 	}

		$data['act_name'] = Request::input('act_name');
		$data['act_start_time'] = strtotime(Request::input('act_start_time'));
		$data['act_end_time'] = strtotime(Request::input('act_end_time'));
		$data['act_desc'] = Request::input('act_desc');
		// print_r($data);die;
		$res = DB::table('activity')->where('act_id',$act_id)->update($data);
		if($res){
			echo "<script>alert('修改成功');location.href='activitylist'</script>";
		}else{
			echo "<script>alert('修改失败');location.href='activitylist'</script>";
		}
	}

	/**
	 * 活动名称的即点即改
	 */
	public function ActivityEdit()
	{
		$act_name = Request::input('act_name');
	 	$act_id = Request::input('id');
	 	$res = DB::table('activity')->where('act_id',$act_id)->pluck('act_name');
	 	if($res == $act_name){
	 		echo 1;
	 	}else{
	 		$result = DB::table('activity')->where('act_id',$act_id)->update(['act_name'=>$act_name]);
		 	if($result){
		 		echo 1;
		 	}else{
		 		echo 0;
		 	}
	 	}
	}

	 /**
	  * 上传文件
	  */
	 public function File($file)
	 {
	 	$file_name = $file->getClientOriginalName();
		$file_ex = $file->getClientOriginalExtension();    //上传文件的后缀	
		//判断文件格式
		if(!in_array($file_ex, array('jpg', 'gif', 'png'))){
			echo "<script>alert('文件格式错误,仅支持 jpg ,gif,png');location.href='articleadd'</script>";
		}
		$newname = md5(date('ymdhis').$file_name).".".$file_ex;
		$savepath = base_path().'/public/uploads';
		$path = $file->move($savepath,$newname);
		$filepath = "uploads/".$newname;
		return $filepath;	
	 }
	
	/**
	 * 搜索
	 */
	public function ActivitySearch()
	{
		$act_name = Request::input('name');
		$act_start_time = strtotime(Request::input('s_time'));
		$act_end_time = strtotime(Request::input('e_time')); 
		// echo $act_end_time;die;
		$where = 1;
		if(!empty($act_name)){
			$where .= " && act_name like '%$act_name%' ";
		}
		if(!empty($act_start_time)){
			$where .= " && act_start_time <= '$act_start_time'";
		}
		if(!empty($act_end_time)){
			$where .= " && act_end_time >= '$act_end_time'";
		}

		$sql = "select * from wei_activity where $where";
		$data = DB::select($sql);
		$sum = count($data);    //总条数
		$number = 5;	//每页条数
		$pages = ceil($sum/$number); //总页数
		$page = Request::input('page')?Request::input('page'):1; //当前页
		$last = $page<=1 ? 1 : $page-1 ;   //上一页
		$next = $page>=$pages ? $pages : $page+1 ;  //下一页
		$start = ($page-1)*$number;
		$sql = "select * from wei_activity where $where limit $start,$number";
		$data['data'] = DB::select($sql);
		$data['last'] = $last;
		$data['next'] = $next;
		$data['pages'] = $pages;
		
		return view('admin/activitysearch',compact('data'));
	}
}