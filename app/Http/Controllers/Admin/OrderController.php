<?php 
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request;
use App\Http\Controllers\Controller;
class OrderController extends Controller 
{
	/**
	 * 展示订单列表
	 */
	public function OrderList()
	{
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id order by a.o_id");
		$count = count($arr);
		$num = 5;
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$page_count = ceil($count/$num);
		$limit = ($page-1)*$num;
		// 上一页
		$last = ($page-1<1) ? 1 : $page-1;
		// 下一页
		$next = ($page+1>$page_count) ? $page_count : $page+1;
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id order by a.o_id limit $limit,$num");
		
		return view("admin/Order_list")->with(['arr'=>$arr,'next'=>$next,'last'=>$last,'page'=>$page,'page_count'=>$page_count]);
		// print_r($arr);die;
	}

	/**
	 * 删除订单信息
	 */
	public function OrderDel()
	{
		$o_id = Request::input('o_id');
		$o_state = DB::table('hotel_order')->where("o_id",$o_id)->pluck("o_state");
		// print_R($arr);
		if( $o_state != 3 && $o_state != 4 ){
			echo 1;
		}else{
			DB::table('hotel_order')->join('hotel_order_details',"hotel_order.o_id","=","hotel_order_details.o_id")->where("hotel_order.o_id",$o_id)->delete();
			// return redirect('OrderList');
		}
	}

	/**
	 * 修改订单价格
	 */
	public function OrderUpdate()
	{
		$o_id = Request::input('id');
		$o_price = Request::input('price');

		DB::table('hotel_order')->where('o_id',$o_id)->update(['o_price'=>$o_price]);
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id order by a.o_id");
		$count = count($arr);
		$num = 5;
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$page_count = ceil($count/$num);
		$limit = ($page-1)*$num;
		// 上一页
		$last = ($page-1<1) ? 1 : $page-1;
		// 下一页
		$next = ($page+1>$page_count) ? $page_count : $page+1;
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id order by a.o_id limit $limit,$num");
		// print_r($arr);die;
		return view('admin/Order_update')->with('arr',$arr);
	}

	/**
	 * 搜索
	 */
	public function OrderSearch()
	{
		$o_num = Request::input('o_num');
		$od_start_time = Request::input('od_start_time');
		$od_end_time = Request::input('od_end_time');
		$o_state = Request::input('o_state');

		$od_start_time = strtotime($od_start_time);
		$od_end_time = strtotime($od_end_time);

		$where = 1;
		if($o_num){
			$where.=" and o_num=$o_num";
		}
		if($od_start_time){
			$where.=" and od_start_time < '$od_start_time'";
		}
		if($od_end_time){
			$where.=" and od_end_time > '$od_end_time'";
		}
		if($o_state){
			$where.=" and o_state=$o_state";
		}
		// echo $where;
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id where $where order by a.o_id");
		$count = count($arr);
		$num = 5;
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$page_count = ceil($count/$num);
		$limit = ($page-1)*$num;
		// 上一页
		$last = ($page-1<1) ? 1 : $page-1;
		// 下一页
		$next = ($page+1>$page_count) ? $page_count : $page+1;
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id where $where order by a.o_id limit $limit,$num");
		
		return view("admin/Order_search")->with(['arr'=>$arr,'next'=>$next,'last'=>$last,'page'=>$page,'page_count'=>$page_count]);
	}

	/**
	 * 展示订单详情
	 */
	public function OrderXiang()
	{
		$o_id = Request::input('o_id');
		$arr = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id where a.o_id=$o_id order by a.o_id");
		// print_r($arr);die;
		return view('admin/Order_xiang',compact('arr'));
	}

	/**
	 * 鼠标划过详情
	 */
	public function OrderXiangqing()
	{
		$o_num = Request::input('o_num');
		$data = DB::select("select * from wei_hotel_order as a join wei_hotel_order_details as s on a.o_id=s.o_id join wei_users as c on a.u_id=c.u_id join wei_room as r on s.r_id=r.r_id join wei_hotel as h on h.h_id=a.h_id where a.o_num='$o_num' order by a.o_id");
		// print_r($arr);die;
		// return view('admin/Order_list',compact('data'));
		foreach($data as $k => $v){
			$data[$k]->od_start_time = date('Y-m-d H:i:s',$v->od_start_time);
			$data[$k]->od_end_time = date('Y-m-d H:i:s',$v->od_end_time);
		}
		echo json_encode($data);
	}
}