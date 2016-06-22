<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB,Request,Session;

class ArticleController extends Controller 
{	
	/**
	 * 文章添加
	 */
	public function ArticleAdd()
	{
		return view('admin/articleadd');
	}

	/**
	 * 文章入库
	 */
	public function ArticleInsert()
	{	
		if(Request::hasFile('ar_img')){
			$file = Request::file('ar_img');
			
			$data['ar_img'] = $this->File($file);

			if($data['ar_img']){

				$data['adm_id'] = Session::get('uid');
				$data['ar_title'] = Request::input('ar_title');
				$data['ar_text'] = Request::input('ar_text');
				$data['ar_time'] = time();

				$res = DB::table('article')->insert($data);	//入库
				if($res){
					$username=Session::get('username');
			        $date=date("Y-H-d m:i:s");
			        $ip=Session::get('ip');
			        $content="添加一条文章";
	                $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
					return redirect('articlelist');
				}else{
					return redirect('articleadd');
				}

			}
		}
	}

	/**
	 * 文章的列表展示
	 */
	public function ArticleList()
	{   
		$data = DB::table('article')->join('admin', 'article.adm_id', '=', 'admin.adm_id')->paginate(5);
		$admin = DB::table('admin')->get();
		// print_r($data);die;
		return view('admin/articlelist')->with('data',$data)->with('admin',$admin);
	}

	/**
	 * 验证文章标题唯一性
	 */
	 public function CheckTitle()
	 {
	 	$title = Request::input('title');
	 	$str = DB::table('article')->where('ar_title',$title)->pluck('ar_title');
	 	$sum = count($str);
	 	if($sum==0){
	 		echo 0;
	 	}elseif($sum==1){
	 		echo 2;
	 	}else{
	 		echo 1;
	 	}
	 }
	 /**
	  * 文章的删除
	  * [ArticleDel description]
	  */
	 public function ArticleDel()
	 {
	 	$ar_id = Request::input('id');
	 	$img = DB::table('article')->where('ar_id',$ar_id)->pluck('ar_img');
	 	$res = DB::table('article')->where('ar_id',$ar_id)->delete();
	 	if($res){
	 		unlink($img);
	 		$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="删除一条文章";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
	 		echo "<script>alert('删除成功');location.href='articlelist'</script>";
	 	}else{
	 		echo "<script>alert('删除失败');location.href='articlelist'</script>";
	 	}
	 }

	 /**
	  * 文章的修改
	  */
	 public function ArticleSave()
	 {
	 	$ar_id = Request::input('id');
	 	$data = DB::table('article')->where('ar_id',$ar_id)->first();
	 	return view('admin/articlesave',compact('data'));
	 }

	 /**
	  * 执行修改
	  */
	 public function ArticleUpdate()
	 {	
	 	$data['adm_id'] = Session::get('uid');

	 	$ar_id = Request::input('ar_id');
	 	$file = Request::file('ar_img');

	 	//如果修改图片 则删除原图片 并进行修改
	 	if($file){
	 		$path = $this->File($file);
	 		$data['ar_img'] = $path;
	 		$img = Request::input('img');
	 		unlink($img);
	 	}
	 	if(Request::input('ar_title')){
	 		$data['ar_title'] = Request::input('ar_title');
	 	}
	 	$data['ar_text'] = Request::input('ar_text');
	 	$result = DB::table('article')->where('ar_id',$ar_id)->update($data);
	 	if($result){
	 		$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="修改一条文章信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
	 		echo "<script>alert('修改成功');location.href='articlelist';</script>";
	 	}else{
	 		echo "<script>alert('修改成功');location.href='articlelist';</script>";
	 	}

	 }

	 /**
	  * 文章的即点即改
	  * [ArticleEdit description]
	  */
	 public function ArticleEdit()
	 {
	 	$ar_title = Request::input('ar_title');
	 	$ar_id = Request::input('id');
	 	$res = DB::table('article')->where('ar_id',$ar_id)->pluck('ar_title');
	 	if($res == $ar_title){
	 		echo 1;
	 	}else{
	 		$result = DB::table('article')->where('ar_id',$ar_id)->update(['ar_title'=>$ar_title]);
		 	if($result){
		 		$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="修改一条文章名称";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
		 		echo 1;
		 	}else{
		 		echo 0;
		 	}
	 	}
	 }

	 /**
	  * 多条件搜索
	  */
	 public function ArticleSearch()
	 {	

	 	$adm_id = Request::input('adm_id');
	 	$ar_title = Request::input('ar_title');
	 	/*$time_start = Request::input('time_start')?strtotime(Request::input('time_start')):'0';
	 	$time_end =Request::input('time_start')?strtotime(Request::input('time_start')):time() ;*/
	 	if(!empty($adm_id) && !empty($ar_title)){
	 		$data = DB::table('article')->join('admin', 'article.adm_id', '=', 'admin.adm_id')->where('admin.adm_id',$adm_id)->where('ar_title','like',"%$ar_title%")->paginate(5);
	 	}elseif(!empty($adm_id) && empty($ar_title)){
	 		$data = DB::table('article')->join('admin', 'article.adm_id', '=', 'admin.adm_id')->where('admin.adm_id',$adm_id)->paginate(5);
	 	}elseif(!empty($ar_title) && empty($adm_id)){
	 		$data = DB::table('article')->join('admin', 'article.adm_id', '=', 'admin.adm_id')->where('ar_title','like',"%$ar_title%")->paginate(5);
	 	}elseif(empty($adm_id) && empty($ar_title)){
	 		$data = DB::table('article')->join('admin', 'article.adm_id', '=', 'admin.adm_id')->paginate(5);

	 	}
	 	
	 	return view('admin/articlesearch')->with('data',$data)->with('adm_id',$adm_id)->with('ar_title',$ar_title);
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
	 
}
