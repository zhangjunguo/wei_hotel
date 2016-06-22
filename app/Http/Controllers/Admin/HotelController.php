<?php
namespace App\Http\Controllers\Admin;
header('content-type:text/html;charset=utf8');
use DB,Request,Session,Validator;
use App\Http\Controllers\Controller;
class HotelController extends Controller 
{
	/**
	 * 酒店列表展示
	 * 
	 */
	public function show()
	{
		//接值
		$keyword = Request::get('keyword');
		//echo $keyword;die;
		$h_type = Request::get('h_type');

		if (!empty($keyword) || !empty($h_type)) {
			//查询酒店
			$data['data']=DB::table('hotel')->where('h_name','like',"%$keyword%")->where('h_type','like',"%$h_type%")->paginate(3);
		} else {
			//查询酒店
			$data['data']=DB::table('hotel')->paginate(3);
		}

		$area = array();
		//print_r($data);die;
		foreach ($data['data'] as $k => $v) {
			$reg_id = explode(',', $v->h_city);
			$area[] = DB::table('region')->whereIn('region_id', $reg_id)->get();
		}
		///print_r($data);

		$data['area'] = $area;

		//print_r($area);die;

		//返回视图层
		return view('admin.hotellist')->with('data', $data);
	}

	/**
	 * 添加酒店
	 * @param  array 表单值
	 */
	public function add()
	{
		//接值
		$data = Request::all();

		//判断当前进行操作
		if (!$data) {
			return view('admin.hoteladd');
		} else {
			// $area = '';
			// $areas = DB::table('region')->whereIn('region_id',[$data['sheng'],$data['shi'],$data['xian']])->get();
			// //print_r($areas);die;
			// foreach ($areas as $v) {
			// 	$area .= $v->region_name;
			// }

			//echo $area;die;
			$data['h_city'] = $data['sheng'].','.$data['shi'].','.$data['xian'];
			$data['city_id'] = $data['shi'];
			unset($data['sheng']);
			unset($data['shi']);
			unset($data['xian']);
			$validator = Validator::make(
			   $data,
			    [
			        'h_name' => 'required|unique:hotel,h_name',
			        'h_beizhu' => 'required',
			        'h_type' => 'required',
			        'h_desc' => 'required',
			        'h_tel' => 'required',
			        'h_x' => 'required',
			        'h_y' => 'required'
			    ]
			);
			if ($validator->fails()) 
			{
				return $validator->errors();
			}

			if (Request::file('h_img')) {
				//文件上传
				$type = Request::file('h_img')->getClientOriginalExtension();
				//echo $type;die;
				$newName = md5(time().rand(1000,9999)).'.'.$type;
				$path = Request::file('h_img')->move('uploads',$newName);
				//echo $path;die;

				$data['h_img'] = $newName;
			}
			unset($data['_token']);
			$data['h_desc'] = strip_tags($data['h_desc']);
			DB::table('hotel')->insert($data);
			$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="添加一条酒店信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
			return redirect('HotelShow');
		}
	}

	/**
	 * 编辑/显示编辑页
	 * @param int 酒店ID
	 */
	public function edit()
	{
		//接收表单的
		$token = Request::input('_token');

		if (!$token) {
			//接收酒店ID
			$h_id = Request::get('h_id');

			//查询单条数据
			$data['data'] = DB::table('hotel')->where('h_id', $h_id)->first();
			$data['area'] = explode(',', $data['data']->h_city);

			$data['pro'] = $data['area'][0];
			$data['ci'] = $data['area'][1];
			$data['cou'] = $data['area'][2];

			//print_r($data['area']);die;
			//查询地区
			$data['sheng'] = DB::table('region')->where('region_type', '1')->get();
			//print_r($data['sheng']);die;
			$data['shi'] = DB::table('region')->where('region_type', '2')->where('parent_id', $data['pro'])->get();
			$data['xian'] = DB::table('region')->where('region_type', '3')->where('parent_id', $data['ci'])->get();

			//返回视图层
			return view('admin.hoteledit')->with('data', $data);
		} else {
			$data = Request::all();
			$data['h_city'] = $data['sheng'].','.$data['shi'].','.$data['xian'];
			unset($data['sheng']);
			unset($data['shi']);
			unset($data['xian']);
			$validator = Validator::make(
			   $data,
			    [
			        'h_name' => 'required',
			        'h_beizhu' => 'required',
			        'h_type' => 'required',
			        'h_desc' => 'required',
			        'h_tel' => 'required',
			        'h_x' => 'required',
			        'h_y' => 'required'
			    ]
			);
			if ($validator->fails()) 
			{
				return $validator->errors();
			}

			if (Request::file('h_img')) {
				//文件上传
				$type = Request::file('h_img')->getClientOriginalExtension();
				//echo $type;die;
				$newName = md5(time().rand(1000,9999)).'.'.$type;
				$path = Request::file('h_img')->move('uploads',$newName);
				//echo $path;die;

				$data['h_img'] = $newName;
			}
			unset($data['_token']);
			$h_id = $data['h_id'];
			unset($data['h_id']);
			$data['h_desc'] = strip_tags($data['h_desc']);
			DB::table('hotel')->where('h_id', $h_id)->update($data);
			$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="修改一条酒店信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
			return redirect('HotelShow');
		}
		
	}


	/**
	 * 删除
	 * @param int 酒店ID
	 */
	public function del()
	{
		//接值
		$h_id = Request::get('h_id');
		$page = Request::get('page');

		//删除
		DB::table('hotel')->where('h_id', $h_id)->delete();
        $username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="删除一条酒店信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
		return redirect('HotelShow?page='.$page);
	}

	

	/**
	 * 酒店名即点即改
	 * @param string $h_name 酒店名
	 * @param int $h_id 酒店ID
	 */
	public function qup()
	{
		//接值
		$h_name = Request::get('h_name');
		$h_id = Request::get('h_id');

		//修改
		$bool = DB::table('hotel')->where('h_id',$h_id)->update(['h_name'=>$h_name]);
		
		if ($bool) {
			$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="修改酒店名称";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
			echo '1';
		}
	}
	
	/**
	 * 户型展示
	 * @param int $h_id 酒店ID
	 */
	public function roomlist()
	{
		//接值
		$h_id = Request::get('h_id');

		//查询
		$data['data'] = DB::table('room')->where('h_id', $h_id)->paginate(3);
		$data['h_id'] = $h_id;
		//返回视图层
		return view('admin.roomlist')->with('data', $data);
	}

	/**
	 * 户型添加
	 * @param int $h_id 酒店ID
	 */
	public function roomadd()
	{
		$r_name = Request::input('r_name');

		if (!$r_name) {
			$h_id = Request::get('h_id');

			return view('admin.roomadd')->with('h_id', $h_id);
		} else {
			$data = Request::all();

			$validator = Validator::make(
			   $data,
			    [
			        'r_name' => 'required',
			        'r_price' => 'required',
			        'r_num' => 'required'
			    ]
			);
			if ($validator->fails()) 
			{
				return $validator->errors();
			}

			if (Request::file('r_img')) {
				//文件上传
				$type = Request::file('r_img')->getClientOriginalExtension();
				//echo $type;die;
				$newName = md5(time().rand(1000,9999)).'.'.$type;
				$path = Request::file('r_img')->move('uploads/room',$newName);
				//echo $path;die;

				$data['r_img'] = $newName;
			}
			unset($data['_token']);
			$data['r_state'] = 0;
			DB::table('room')->insert($data);
			$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="添加一条户型";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
			return redirect('RoomShow?h_id='.$data['h_id']);
		}	
	}

	/**
	 * 户型编辑
	 * @param int $r_id 户型ID
	 * @param array $data 表单值
	 */
	public function roomedit()
	{
		
		//$h_id = Request::get('h_id');

		$r_name = Request::input('r_name');

		if (!$r_name) {
			$r_id = Request::get('r_id');
			$data = DB::table('room')->where('r_id', $r_id)->first();
			//print_R($data);die;
			return view('admin.roomedit')->with('data', $data);
		} else {
			$data = Request::all();

			$validator = Validator::make(
			   $data,
			    [
			        'r_name' => 'required',
			        'r_price' => 'required',
			        'r_num' => 'required'
			    ]
			);
			if ($validator->fails()) 
			{
				return $validator->errors();
			}

			if (Request::file('r_img')) {
				//文件上传
				$type = Request::file('r_img')->getClientOriginalExtension();
				//echo $type;die;
				$newName = md5(time().rand(1000,9999)).'.'.$type;
				$path = Request::file('r_img')->move('uploads/room',$newName);
				//echo $path;die;

				$data['r_img'] = $newName;
			}
			unset($data['_token']);
			$r_id = $data['r_id'];
			$h_id = $data['h_id'];
			unset($data['r_id']);
			unset($data['h_id']);
			//$data['r_state'] = 0;
			DB::table('room')->where('r_id', $r_id)->update($data);
			$username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="编辑一条户型信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
			return redirect('RoomShow?h_id='.$h_id);
		}		
	}

	/**
	 * 户型删除
	 * @param int 户型ID
	 */
	public function roomdel()
	{
		//接值
		$r_id = Request::get('r_id');
		$page = Request::get('page');
		$h_id = Request::get('h_id');

		//删除
		DB::table('room')->where('r_id', $r_id)->delete();
        $username=Session::get('username');
		      $date=date("Y-H-d m:i:s");
		      $ip=Session::get('ip');
		      $content="删除一条户型信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
		return redirect('RoomShow?h_id='.$h_id.'&&page='.$page);
	}

	/**
	 * 酒店图片添加
	 */
	public function imgadd()
	{
		$token = Request::input('_token');

		if (!$token) {
			//接值
			$h_id = Request::get('h_id');

			return view('admin.hotelimg')->with('h_id', $h_id);
		} else {
			$h_id = Request::input('h_id');
			$img = Request::file('img');
			//print_r($img);
		
			foreach ($img as $v) {
				//文件上传
				$type = $v->getClientOriginalExtension();
				//echo $type;die;
				$newName = md5(time().rand(1000,9999)).'.'.$type;
				$path = $v->move('uploads/hotel',$newName);
				//echo $path;die;

				DB::table('hotel_img')->insert(['h_id'=>$h_id, 'img'=>$newName]);
			}
			return redirect('HotelShow');
		}


		
	}
}