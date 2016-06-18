<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request;
use App\Http\Controllers\Controller;
class AreaListController extends Controller 
{
	/**
	 * 后台地区列表
	 */
	public function AreaList()
	{
		 //获取所有地区
        $data=DB::table('region1')->paginate('5');
        // print_r($data);die;
        //求出上级地区  三维数组
        foreach($data as $k=>$v){
           $data[$k]->parent=DB::table('region1')->where('region_id',$v->parent_id)->first();
        }
        // print_r($data);die;
        // 转换成二维数组
        foreach ($data as $k => $v) {
        	if ($v->parent == '') {
        		$data[$k]->parent="无";
        	}else{
        		$data[$k]->parent = $v->parent->region_name;
        	}
        }
        // print_r($data);die;
		return view('admin/Area_List')->with('data',$data);
		// echo 1;
	}

	/**
	 * 后台添加地区列表
	 */
	public function AreaAdd()
	{
		$data = DB::table('region1')->get();
		// 递归
		$data = $this->__tree($data,0,0);
		// print_r($data);die;
		return view('admin/Area_Add')->with('data',$data);
	}

	/**
	 * 后台添加地区列表(执行添加)
	 */
	public function DoAreaAdd()
	{
		$arr['region_name'] = Request::input('region_name');
		$arr['parent_id'] = Request::input('parent_id');

		// 判断地区名的类型  1 省份  2 城市  3 区县
		if($arr['parent_id'] == 0){

			$arr['region_type'] = 1;

		}else{

			$res = DB::table('region1')->where("region_id",$arr['parent_id'])->first();
			// print_r($res);die;
			if($res->region_type == 1){

				$arr['region_type'] = 2;

			}else if($res->region_type == 2){

				$arr['region_type'] = 3;
			}
		}
		
		// print_R($arr);die;
		$re = DB::table('region1')->insert($arr);
		if($re){

			$this->AreaJson();

			return redirect('AreaList');

		}
	}

	/*
	递归函数  取出所有分类
	*/
	public function __tree($arr,$pid=0,$level=0){
		static $tree = array();
		foreach ($arr as $key => $v) {
			if ($v->parent_id == $pid) {
				$v->level = $level;
				$tree[] = $v;
				$this->__tree($arr,$v->region_id,$level+1);
			}
		}
		return $tree;
	}

	/**
	 * 验证地区名称唯一性
	 */
	public function CheckName()
	{
		$region_name = Request::input('name');
		$re = DB::table('region1')->where('region_name',$region_name)->first();
		if($re){

			echo 0;

		}else{

			echo 1;

		}
	}

	/**
	 * 删除  判断是否有子类
	 */
	public function AreaDel()
	{
		$region_id = Request::input('id');
		// echo $region_id;
		// 判断是否有父分类
		$arr = DB::table('region1')->where('parent_id',$region_id)->first();
		// print_R($arr);
		if($arr){

			echo 1;

		}else{

			echo 2;
		}

	}

	/**
	 * 删除父类的同时也删除子分类
	 */
	public function AreaDelall()
	{
		$region_id = Request::input('id');
		// 查出该id下的下级分类
		$arr = DB::table('region1')->where("parent_id",$region_id)->get();

		foreach($arr as $k => $v){

			DB::table('region1')->where("parent_id",$v->region_id)->delete();

		}

		DB::table('region1')->where('parent_id',$region_id)->delete();

		$re = DB::table('region1')->where("region_id",$region_id)->delete();

		$res = DB::table('region1')->get();
		if($res){
			$this->AreaJson();
		}else{
			unlink('area.js');
		}
		

		if($re){
			
			return redirect('AreaList');
		} 
	}

	/**
	 * 删除子类
	 */
	public function Areadelete()
	{
		$region_id = Request::input('id');
		$re = DB::table('region1')->where("region_id",$region_id)->delete();
		$this->AreaJson();
		if($re){
			return redirect('AreaList');
		}
	}

	/**
	 * 地区生成json文件
	 */
	public function AreaJson()
	{
		$country = array();
			$data = DB::table('region1')->get();
		foreach($data as $k => $v){
			if($v->region_type == 1){

				// 省份
				$arr1 = DB::table('region1')->where('region_type',1)->get();
				foreach($arr1 as $k => $v){
					$province[$v->region_id] = $v->region_name;
				}
				// print_R($province);die;
				$country['province'] = $province;

			}elseif($v->region_type == 2){

				// 城市
				$arr2 = DB::table('region1')->where('region_type',2)->get();
				foreach($arr2 as $k => $v){
					$city[$v->parent_id][$v->region_id] = $v->region_name;
				}
				// print_R($city);die;
				$country['city'] = $city;

			}elseif($v->region_type == 3){

				// 区县
				$arr3 = DB::table('region1')->where('region_type',3)->get();
				foreach($arr3 as $k => $v){
					$area[$v->parent_id][$v->region_id] = $v->region_name;
				}
				// print_R($area);die;
				$country['area'] = $area;

			}
		}

		$filename = "area.js";
		file_put_contents($filename,"var json=".json_encode($country));
		// print_R($country);die;
	}
		
	// 递归取出所有的子节点
	public function dg($data,$parent_id=0)
	{
		$child=array();
		foreach($data as $v)
		{
			if($v['parent_id']==$parent_id)
			{
				$child[]=$v;
			}
		}
		foreach($child as $key=>$v)
		{
			$current_child=$this->dg($data,$v['cat_id']);
			$child[$key]['child']=$current_child;
		}
		return $child;
	}
		
		
			
		
		


		

}