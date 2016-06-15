<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request;
use App\Http\Controllers\Controller;
class AreaListController extends Controller 
{
	// 管理中心页面
	public function index()
	{
	    return view('admin.main');
	}
	/**
	 * 后台地区列表
	 */
	public function AreaList()
	{
		return view('admin/Area_List');
	}
}