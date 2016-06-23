<?php

namespace App\Http\Controllers\home;
header("content-type:text/html;charset=utf-8");
use App\Http\Controllers\Controller;
use DB,Request,Session;
class HotelController extends Controller
{	
	/**
	 * 展示酒店列表页面
	 */
    public function Index()
    {
        $arr = DB::table('hotel')->lists('h_city');
        // print_R($arr);die;
        foreach($arr as $k => $v){
            $re[] = explode(',',$v);
        }
        // print_R($re);die;
        foreach($re as $k => $v){
            $ids[] = $v[1];
            $data[] = DB::table('region')->where('region_id',$v[1])->pluck('region_name');
        }
        // 这样也行
        // $data1 = DB::table('region')->whereIn('region_id',$ids)->lists('region_name','region_id');

        // print_R($data1);die;
        $ar1 = array_unique($data);
        $ar2 = array_unique($ids);
        foreach($ar1 as $k => $v){
            $ar[$k]['name'] = $v;
            $ar[$k]['id'] = $ar2[$k];                                                                                                                                                                                                                                                                                                                        
        }
        // print_R($ar);die;
    	return view('home/CityList')->with(['data'=>$ar]);
    }

    /**
	 * 展示酒店详情页面
	 */
    public function HotelInfo()
    {
        // 酒店id
        $id = Request::input('id');
        Session::put('h_id',$id);
        // $address = Request::input('address');
        // echo $address;die;
        $arr = DB::table('room')->join('hotel',"room.h_id","=","hotel.h_id")->where("room.h_id",$id)->get();
        // print_r($arr);die;
    	$data = DB::table('hotel')->where("h_id",$id)->first();

        if(!empty(Session::get('user_id'))){
            // 判断是不是会员
            $res = DB::table('users')->where('u_id',Session::get('user_id'))->first();
            if($res->user_score >= 4000 || $res->user_grade == 1){
                $data->user_grade = 1;
            }else{
                $data->user_grade = 0;
            }
            // $data->user_grade = $res->user_grade;
        }else{
            $data->user_grade = 2;
        }
        
        // print_R($arr);die;
        return view('home/Hotel')->with(['arr'=>$arr,'data'=>$data,'h_id'=>$id]);
    }

    /**
     * 展示酒店评论页面
     */
    public function HotelReview()
    {
        $h_id = Request::input('id');
        $arr = DB::table('comment')->join('users','comment.u_id','=','users.u_id')->where('h_id',$h_id)->get();

       
        // print_R($arr);die;
        $count = count($arr);
        $num = 5;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $page_count = ceil($count/$num);
        $limit = ($page-1)*$num;
        // 上一页
        $last = ($page-1<1) ? 1 : $page-1;
        // 下一页
        $next = ($page+1>$page_count) ? $page_count : $page+1;
        $arr = DB::table('comment')->join('users','comment.u_id','=','users.u_id')->where('h_id',$h_id)->skip($limit)->take($num)->get();
        // print_r($arr);die;
         foreach($arr as $k => $v){
            $arr[$k]->user_name = substr_replace($v->user_name,'*',3,3);
        }
        return view('home/HotelReview')->with(['arr'=>$arr,'next'=>$next,'last'=>$last,'page'=>$page,'page_count'=>$page_count,'h_id'=>$h_id]);
    }

     /**
     * 展示酒店简介页面  
     */
    public function HotelDesc()
    {
        $h_id = Request::input('id');
        $arr = DB::table('hotel_img')->where("h_id",$h_id)->get();
        // print_R($arr);die;
        $res = DB::table('hotel')->where('h_id',$h_id)->first();
        return view('home/HotelInfo')->with(['arr'=>$arr,'res'=>$res]);
    }

    /**
     * 前台酒店列表
     */
    public function HotelList()
    {
        $where = 1;
        // print_r($_SERVER);die;
        $cityID = Request::input('cityID');
        $checkInDate = Request::input('checkInDate');
        $checkOutDate = Request::input('checkOutDate');
        // echo $checkOutDate.'---'.$checkInDate;
        Session::put('checkInDate',$checkInDate);
        Session::put('checkOutDate',$checkOutDate);
        if($cityID){
            $where.=" and city_id=$cityID";
        }
        $arr = DB::select("select * from wei_hotel where $where");
        // 展示评论
        foreach($arr as $k => $v){
            $arr[$k]->num = DB::table("comment")->where('h_id',$v->h_id)->count();
            $arr[$k]->score = DB::table('comment')->where('h_id',$v->h_id)->lists('c_star');
            if($arr[$k]->num != ''){
                $arr[$k]->ave = array_sum($v->score)/$v->num;
            }else{
                $arr[$k]->ave = 0;
            }
        }
        // print_r($arr);die;
        if(!empty(Session::get('user_id'))){
            // 收藏
            $res = DB::table('collect')->where('u_id',Session::get('user_id'))->lists('h_id');
            // print_R($res);die;
            if($res){
                foreach($arr as $k => $v){
                    foreach($res as $kk => $vv){
                        if($v->h_id == $vv){
                            $arr[$k]->collect = 1;
                        }
                    }
                }
            }
        }
        // print_r($arr);
        return view('home/HotelList')->with(['arr'=>$arr]);
    }

    /**
     * 修改入住时间
     */
    public function HoteUpdateTime()
    {
        // echo 123;die;
        // print_r(Request::all());die;
        $arr = Request::all();
        Session::put('checkInDate',$arr['CheckInDate']);
        Session::put('checkOutDate',$arr['CheckOutDate']);
        Session::put('h_id',$arr['h_id']);
        echo "<script>location.href='HotelInfo?id=".$arr['h_id']."'</script>";
    }

    /**
     * 预定酒店
     */
    public function HotelYU()
    {
        if(empty(Session::get('user_id'))){
            echo "<script>alert('请先登录');location.href='Login'</script>";die;
        }
        // echo 111;
        // 判断是不是会员
        $res = DB::table('users')->where('u_id',Session::get('user_id'))->first();

        $h_id = Request::input('h_id');
        $r_id = Request::input('r_id');
        $arr = DB::table('hotel')->where('h_id',$h_id)->first();
        $data = DB::table('room')->where('r_id',$r_id)->first();
        return view('home/HotelYu')->with(['arr'=>$arr,'data'=>$data,'res'=>$res]);
    }

    /**
     * 确定预定酒店
     */
    public function HotelOk()
    {
        // echo 123;
        $score = Request::input("score");
        if($score == ''){
            $score=0;
        }
        DB::table('users')->where("u_id",Session::get('user_id'))->decrement('user_score', $score);
        $arr['o_num'] = "H".time().rand(1000,9999);
        $arr['h_id'] = Request::input('h_id');
        $arr['u_id'] = Session::get('user_id');
        $arr['o_addtime'] = time();
        $price = Request::input('price');
        $nums = Request::input('nums');
        $arr['o_price'] = $price*$nums;
        $arr['o_price'] = $arr['o_price']-$score*0.1;
        $arr['o_state'] = 1;

        $o_id = DB::table('hotel_order')->insertGetId($arr);
        if($o_id){
            $data['o_id'] = $o_id;
            $data['r_id'] = Request::input('r_id');
            $data['od_count'] = $nums;
            $data['od_xiaoji'] = $nums*$price;
            $data['od_xiaoji'] = $data['od_xiaoji']-$score*0.1;
            $data['od_start_time'] = strtotime(Request::input('od_start_time'));
            $data['od_end_time'] = strtotime(Request::input('od_end_time'));

            $re = DB::table('hotel_order_details')->insert($data);

            DB::table('room')->where('h_id',$arr['h_id'])->where('r_id',$data['r_id'])->decrement('r_num');
            if($re){
                echo $arr['o_num'];
            }
        }
    }

    /**
     * 酒店实景
     */
    public function HoteReality()
    {
        $id = Request::input('id');
        $arr = DB::table('hotel')->where("h_id",$id)->first();
        // echo $id;die;
        return view('home/HotelRea')->with(['arr'=>$arr]);
    }

    /**
     * 酒店地图
     */
    public function HotelMap()
    {
        $id = Request::input('id');
        $arr = DB::table('hotel')->where("h_id",$id)->first();
        // echo $id;die;
        return view('home/HotelMap')->with(['arr'=>$arr]);
    }

    /**
     * 酒店导航
     */
    public function HotelGps()
    {
        $id = Request::input('id');
        $arr = DB::table('hotel')->where("h_id",$id)->first();
        $arr->h_desc = str_replace("\n", "", $arr->h_desc);
        $arr->h_desc = str_replace("\r", "", $arr->h_desc); 
        return view('home/HotelGps')->with(['arr'=>$arr]);
    }

// 酒店收藏
    public function Collection()
    {
        // $arr['user_id'] = 21;
        $arr['u_id'] = Session::get('user_id');
        if(!empty($arr['u_id'])){
            $arr['h_id'] = Request::input('h_id');
            $arr['col_time'] = date('Y-m-d H:i:s',time());
            $res = DB::table('collect')->insert($arr);
            if($res){
                return "<a href='javascript:cancel(".$arr['h_id'].")'><img src='../home/shou.jpg' alt='取消收藏' width='25' /></a>";
            }
        }else{
            return "<script>alert('请先登录');location.href='Login'</script>";  
        }
    }

    // 取消收藏
    public function Cancel()
    {
        $user_id = Session::get('user_id');
        $hotel_id = Request::input('h_id');
        $res = DB::table('collect')->where('u_id',$user_id)->where('h_id',$hotel_id)->delete();
        if($res){
            return "<a href='javascript:collection(".$hotel_id.")'><img src='../home/qu.jpg' alt='收藏本店' width='25' /></a>";
        }
    }

    /**
     * 会员积分
     */
    public function OrderScore()
    {
        $score = Request::input('score');
        $res = DB::table('users')->where("u_id",Session::get('user_id'))->first();
        if($score>$res->user_score){
            echo 1;
        }else{
            echo 2;
        }
    }
}





































/* public function Index()
    {
        $arr = DB::table('hotel')->lists('h_city');
        // print_R($arr);die;
        foreach($arr as $k => $v){
            $re[] = explode(',',$v);
        }
        // print_R($re);die;
        foreach($re as $k => $v){
           foreach($v as $kk => $vv){
             $ids[] = $vv;
            // print_r($vv);
             $data[] = DB::table('region')->where('region_id',$vv)->pluck('region_name');
           }
        }
        // print_R($data);die;
        // $ar1 = array_unique($data);
        // $ar2 = array_unique($ids);
        // print_r($ar2);die;
        foreach($data as $k => $v){
            $ar[$k]['name'] = $v;
            $ar[$k]['id'] = $ids[$k];
        }
        // print_R($ar);die;

        foreach($ar as $k => $v){
            // echo $v['id'];
            $ars[] = DB::table('region')->where('region_id',$v['id'])->where('region_type',2)->pluck('region_name');
            $idss[] = DB::table('region')->where('region_id',$v['id'])->where('region_type',2)->pluck('region_id');
        }
         $ar1 = array_unique($ars);
        $ar2 = array_unique($idss);
         foreach($ar1 as $k => $v){
            if(empty($ar1[$k])){
                unset($ar1[$k]);
                unset($ar2[$k]);
            }
        }
        foreach($ar1 as $k => $v){
            $arss[$k]['name'] = $v;
            $arss[$k]['id'] = $ar2[$k];
        }
      
        // print_r($arss);die;
        return view('home/CityList')->with(['data'=>$arss]);
    }*/



    /**
     * 预定酒店
     */
/*    public function HotelYU()
    {
        if(empty(Session::get('user_id'))){
            echo "<script>alert('请先登录');location.href='Login'</script>";die;
        }
        // echo 111;
        // 判断是不是会员
        $res = DB::table('users')->where('u_id',Session::get('user_id'))->first();


        $data['o_num'] = "H".time().rand(10000,99999);
        $data['h_id'] = Request::input('h_id');
        $data['u_id'] = Session::get('user_id');
        $data['o_addtime'] = time();
        if($res->user_score >= 4000 || $res->user_grade == 1){
            $data['o_price'] = Request::input('vip_price');
        }else{
            $data['o_price'] = Request::input('price'); 
        }
        $data['o_state'] = 1;

        // $arr['o_id'] = DB::table('hotel_order')->insertGetId($data);
        $arr['r_id'] = Request::input('r_id');
        $arr['od_count'] = 1;
        $arr['od_xiaoji'] = $data['o_price'];
        $arr['od_start_time'] = strtotime(Session::get('checkInDate'));
        $arr['od_end_time'] = strtotime(Session::get('checkOutDate'));

        // $re = DB::table('hotel_order_details')->insert($arr);
        // if($re){
            // echo "<script>if(confirm('马上去支付')){location.href='PAY?o_num=".$data['o_num']."'}else{location.href='HotelInfo?id=".$data['h_id']."'}</script>";
            return view('home/HotelYu')->with(['arr'=>$arr]);
        // }
    }*/