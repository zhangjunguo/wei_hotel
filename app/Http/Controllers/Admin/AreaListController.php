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
		// return view('admin/Area_List');
		// echo 1;
	}

	/**
	 * 后台添加地区列表
	 */
	public function AreaAdd()
	{
		return view('admin/Area_Add');
	}

	/**
	 * 后台添加地区列表
	 */
	public function DoAreaAdd()
	{
		echo 22;
	}
}