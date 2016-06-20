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
        // print_R($ids);die;
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
        $id = Request::input('id');
        Session::put('h_id',$id);
        $address = Request::input('address');
        // echo $address;die;
        $arr = DB::table('room')->join('hotel',"room.h_id","=","hotel.h_id")->where("room.h_id",$id)->get();
        // print_r($arr);die;
    	$data = DB::table('hotel')->where("h_id",$id)->first();
        return view('home/Hotel')->with(['arr'=>$arr,'data'=>$data]);
    }

    /**
     * 展示酒店评论页面
     */
    public function HotelReview()
    {
        return view('home/HotelReview');
    }

     /**
     * 展示酒店简介页面  
     */
    public function HotelDesc()
    {
        return view('home/HotelInfo');
    }

    /**
     * 前台酒店列表
     */
    public function HotelList()
    {
        // print_r($_SERVER);die;
        $cityID = Request::input('cityID');
        $checkInDate = Request::input('checkInDate');
        $checkOutDate = Request::input('checkOutDate');
        Session::put('checkInDate',$checkInDate);
        Session::put('checkOutDate',$checkOutDate);
        $arr = DB::table('hotel')->where('city_id',$cityID)->get();
        $comment = DB::table('comment')->get();
        foreach($arr as $k => $v){
            $arr[$k]->num = DB::table("comment")->where('h_id',$v->h_id)->count();
        }
        // print_r($arr);die;
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
