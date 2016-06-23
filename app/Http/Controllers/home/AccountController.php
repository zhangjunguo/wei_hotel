<?php

namespace App\Http\Controllers\home;

header('content-type:text/html;charset=utf8');

use DB,Session,Request,Validator;
use App\Http\Controllers\Controller;




class AccountController extends Controller
{	
	/**
	 * 展示我的格子
	 */
    public function Index()

    {

        $user_name = Session::get('user_id');
        
        if(!empty($user_name)){

            //查询用户资料
            $data = DB::table('users')->where('u_id', $user_name)->first();
            return view('home/user_account')->with('data', $data);
        }else{
            return redirect('home/Login');
        }

    }

    /**
     * 展示我的礼物
     */
    public function MyGift()
    {
    	$user_name = Session::get('user_name');
    	$u_id = Session::get('user_id');

    	//$data = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->paginate(3);

        $count = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->count();


        //echo $count;
        
        //设置每页显示数
        $length = 3;

        //计算总页数
        $page_sum = ceil($count/$length);

        //获取当前页
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        //设置上一页 下一页
        $prev = $page-1 <= 1 ? 1 : $page-1;
        $next = $page+1 > $page_sum ? $page_sum : $page+1;
    
        $data['str'] = "<a href='javascript:page(1)'>首页</a>
                        <a href='javascript:page($prev)'>上一页</a>
                        <a href='javascript:page($next)'>下一页</a>
                        <a href='javascript:page($page_sum)'>尾页</a>";

        //计算偏移量
        $offset = ($page-1)*$length;
        
        $data['data'] = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->skip($offset)->take($length)->get();
            
        return view('home/my_gift')->with('data', $data);
   
    }

    public function MyGiftNo()
    {
        $user_name = Session::get('user_name');
        $u_id = Session::get('user_id');

        //$data = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->paginate(3);

        $count = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '=', '0')->count();


        //echo $count;
        
        //设置每页显示数
        $length = 3;

        //计算总页数
        $page_sum = ceil($count/$length);

        //获取当前页
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        //设置上一页 下一页
        $prev = $page-1 <= 1 ? 1 : $page-1;
        $next = $page+1 > $page_sum ? $page_sum : $page+1;
    
        $data['str'] = "<a href='javascript:page(1)'>首页</a>
                        <a href='javascript:page($prev)'>上一页</a>
                        <a href='javascript:page($next)'>下一页</a>
                        <a href='javascript:page($page_sum)'>尾页</a>";

        //计算偏移量
        $offset = ($page-1)*$length;
        
        $data['data'] = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '=', '0')->skip($offset)->take($length)->get();
            
        return view('home/my_giftno')->with('data', $data);
    }

    public function MyGiftYes()
    {
        $user_name = Session::get('user_name');
        $u_id = Session::get('user_id');

        //$data = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->paginate(3);

        $count = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '!=', '0')->count();


        //echo $count;
        
        //设置每页显示数
        $length = 3;

        //计算总页数
        $page_sum = ceil($count/$length);

        //获取当前页
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        //设置上一页 下一页
        $prev = $page-1 <= 1 ? 1 : $page-1;
        $next = $page+1 > $page_sum ? $page_sum : $page+1;
    
        $data['str'] = "<a href='javascript:page(1)'>首页</a>
                        <a href='javascript:page($prev)'>上一页</a>
                        <a href='javascript:page($next)'>下一页</a>
                        <a href='javascript:page($page_sum)'>尾页</a>";

        //计算偏移量
        $offset = ($page-1)*$length;
        
        $data['data'] = DB::table('gift_order')->join('gift', 'gift.g_id', '=', 'gift_order.g_id')->where('u_id', $u_id)->where('go_state', '!=', '0')->skip($offset)->take($length)->get();
            
        return view('home/my_giftyes')->with('data', $data);
    }

    /**
     * 礼品详情
     */
    public function MyGiftX()
    {
        //接值
        $go_id = Request::get('go_id');

        $data = DB::table('gift_order')->join('gift', 'gift.g_id', '=' ,'gift_order.g_id')->where('go_id', $go_id)->first();

        return view('home/my_giftx')->with('data', $data);
    }

    /**
     * 展示我的订单
     */
    public function MyOrder()
    {   
        $user_name = Session::get('user_name');
        if(!empty($user_name)){
            $user_id = Session::get('user_id');
            // echo $user_id;die;
            $str = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->get();            
           
            // dd($data);die; 
            $sum = count($str);    //总条数
            $number = 3;    //每页条数
            $pages = ceil($sum/$number); //总页数
            $page = Request::input('page')?Request::input('page'):1; //当前页
            $last = $page<=1 ? 1 : $page-1 ;   //上一页
            $next = $page>=$pages ? $pages : $page+1 ;  //下一页
            $start = ($page-1)*$number;
            $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id limit $start,$number";
            $arr = DB::select($sql);

             foreach($arr as $k=>$v){
                $arr[$k]->num = DB::table('comment')->where('h_id',$v->h_id)->count();
            } 

            $data['data'] = $arr;
            $data['last'] = $last;
            $data['next'] = $next;
            $data['pages'] = $pages;
            // dd($data);die;

            return view('home/my_order')->with('data',$data);
        }else{
            return redirect('home/Login');
        }
    }
    /**
     * 未完成订单
     * @return [type] [description]
     */
    public function my_order_no()
    {   
        $user_id = Session::get('user_id');
        $arr = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->where('o_state',2)->get();
         
        $sum = count($arr);    //总条数
        $number = 3;    //每页条数
        $pages = ceil($sum/$number); //总页数
        $page = Request::input('page')?Request::input('page'):1; //当前页
        $last = $page<=1 ? 1 : $page-1 ;   //上一页
        $next = $page>=$pages ? $pages : $page+1 ;  //下一页
        $start = ($page-1)*$number;
        $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id && o_state=2 limit $start,$number";
        $arr = DB::select($sql);

         foreach($arr as $k=>$v){
            $arr[$k]->num = DB::table('comment')->where('h_id',$v->h_id)->count();
        } 
        $data['data'] = $arr;
        $data['last'] = $last;
        $data['next'] = $next;
        $data['pages'] = $pages;


        return view('home/my_order_no',compact('data'));
    }

    /**
     * 已完成订单
     * @return [type] [description]
     */
    public function my_order_yes()
    {   
        $user_id = Session::get('user_id');
        $arr = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->where('o_state',3)->get(); 
        $sum = count($arr);    //总条数
        $number = 3;    //每页条数
        $pages = ceil($sum/$number); //总页数
        $page = Request::input('page')?Request::input('page'):1; //当前页
        $last = $page<=1 ? 1 : $page-1 ;   //上一页
        $next = $page>=$pages ? $pages : $page+1 ;  //下一页
        $start = ($page-1)*$number;
        $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id && o_state=3 limit $start,$number";
        $arr = DB::select($sql);
        foreach($arr as $k=>$v){
            $arr[$k]->num = DB::table('comment')->where('h_id',$v->h_id)->count();
        } 
        $data['data'] = $arr;
        // dd($data['data']);die;
        $data['last'] = $last;
        $data['next'] = $next;
        $data['pages'] = $pages;


        return view('home/my_order_yes',compact('data'));
    } 
    /**
     * 
     */
    public function my_order_pay()
    {
      $user_id = Session::get('user_id');
        $arr = DB::table('hotel_order')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('u_id',$user_id)->where('o_state',1)->get();
        $sum = count($arr);    //总条数
        $number = 3;    //每页条数
        $pages = ceil($sum/$number); //总页数
        $page = Request::input('page')?Request::input('page'):1; //当前页
        $last = $page<=1 ? 1 : $page-1 ;   //上一页
        $next = $page>=$pages ? $pages : $page+1 ;  //下一页
        $start = ($page-1)*$number;
        $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where u_id=$user_id && o_state=1 limit $start,$number";
        $arr = DB::select($sql);
        foreach($arr as $k=>$v){
            $arr[$k]->num = DB::table('comment')->where('h_id',$v->h_id)->count();
        }
        $data['data'] = $arr;
        $data['last'] = $last;
        $data['next'] = $next;
        $data['pages'] = $pages;


        return view('home/my_order_pay',compact('data'));  
    }
    /**
     * 订单详情
     */
    public function Order_Info()
    {
        $o_id = Request::input('id');
       /* $sql = "select * from wei_hotel_order inner join wei_hotel on wei_hotel_order.h_id= wei_hotel.h_id where o_id=$o_id";
        $data = DB::query($sql);*/
        $data = DB::table('hotel_order')->join('room', 'hotel_order.h_id', '=', 'room.h_id')->join('hotel', 'hotel_order.h_id', '=', 'hotel.h_id')->where('o_id',$o_id)->first();
        // dd($data);die;
        return view('home/order_info',compact('data'));
    }

     /**
     * 展示我的信息
     */
    public function MyInfo()
    {
        $u_id = Session::get('user_id');
        $user_name = Request::input('user_name');

        if ($user_name) {
            
            $data = Request::all();

            //unset($data['_token']);

            if(empty($data['user_card'])){
                DB::table('users')->where('u_id', $u_id)->update(['user_name'=>$data['user_name']]);
            }else{
                DB::table('users')->where('u_id', $u_id)->update(['user_name'=>$data['user_name'], 'user_card'=>$data['user_card']]);
            }

            return redirect('home/MyAccount');
        } else {

            $data = DB::table('users')->where('u_id', $u_id)->first();

            return view('home/my_list')->with('data', $data);
        }

        

       
    }

    /**
     * 展示我的收藏
     */
    public function MyCollection()
    {
        $user_id = Session::get('user_id');
        $results = DB::table('collect')
        ->join('hotel','collect.h_id', '=', 'hotel.h_id')
        ->where('u_id',$user_id)
        ->get();
        return view('home/my_Collection')->with('results',$results);
    }

    /**
     * 上传头像
     */
    public function MyImg()
    {
        $file = Request::file('file');

        //文件上传
        $type = $file->getClientOriginalExtension();
        //echo $type;die;
        $newName = md5(time().rand(1000,9999)).'.'.$type;
        $path = $file->move('uploads/User',$newName);

        //接用户
        $u_id = Session::get('user_id');

        //上传头像
        DB::table('users')->where('u_id', $u_id)->update(['user_img'=>$newName]);

        return redirect('home/MyAccount');
    }
}
