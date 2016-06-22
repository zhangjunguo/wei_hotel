<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB,Request,Session;

class GiftController extends Controller
{		
	/**
	 * 礼物列表
	 */
	public function giftList()
    {
        $gift_data = DB::table('gift') ->paginate(3);
       // print_r($gift_data);
        return view('admin/giftList',['gift_data'=>$gift_data]);
    }

    /**
     * 加载礼物添加页面
     */
    public function giftAdd()
    {
        return view('admin/giftAdd');
    }

    /**
     * 礼物添加
     */
    public function addGift()
    {
        $file = Request::file('g_img');
        $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
        $newName = time() . "." . $entension;
        $path = $file->move('storage/uploads/', $newName);
        if($path){
            $gift_data['g_name'] = Request::input('g_name');
            $gift_data['g_score'] = Request::input('g_score');
            $gift_data['g_text'] = Request::input('g_text');
            $gift_data['g_num'] = Request::input('g_num');
            $gift_data['g_img'] = $newName;
            $bool = DB::table('gift') -> insert($gift_data);
            if($bool){
              $username=Session::get('username');
              $date=date("Y-H-d m:i:s");
              $ip=Session::get('ip');
              $content="添加一条礼品信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
              return redirect('giftList');
            }
        }
    }

    /**
     * 礼物验证唯一性
     */
    public function uniqueGift()
    {

        $g_name = Request::input('g_name');
        $bool = DB::table('gift')
            ->where('g_name',$g_name)
            ->first();
        if($bool){
            echo 1;
        }else{
            echo 0;
        }
    }

    /**
     * 礼物删除
     */
    public function giftDel()
    {
        // $g_id = $_GET['g_id'];
        $g_id = Request::input('g_id');
        $bool = DB::table('gift')
            ->where('g_id',$g_id)
            ->delete();
        if($bool){
            $username=Session::get('username');
              $date=date("Y-H-d m:i:s");
              $ip=Session::get('ip');
              $content="删除一条礼品信息";
              $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
            return redirect('giftList');
        }
    }

    /**
     * 加载礼物编辑页面
     */
    public function giftEdit()
    {
       // $g_id = $_GET['g_id'];
        $g_id = Request::input('g_id');
        $gift_data = DB::table('gift')
            ->where('g_id',$g_id)
            ->first();
        return view('admin/giftEdit',['gift_data'=>$gift_data]);
    }

    /**
     * 礼物添加
     */
    public function editGift()
    {
        $g_id = Request::input('g_id');
        $file = Request::file('g_img');
        if($file==''){
            $gift_data['g_name'] = Request::input('g_name');
            $gift_data['g_score'] = Request::input('g_score');
            $gift_data['g_text'] = Request::input('g_text');
            $gift_data['g_num'] = Request::input('g_num');
            $bool = DB::table('gift')
                ->where('g_id',$g_id)
                -> update($gift_data);
            if($bool){
                return redirect('giftList');
            }

        }else{
            $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
            $newName = time() . "." . $entension;
            $path = $file->move('storage/uploads/', $newName);
            if($path){
                $gift_data['g_name'] = Request::input('g_name');
                $gift_data['g_score'] = Request::input('g_score');
                $gift_data['g_text'] = Request::input('g_text');
                $gift_data['g_num'] = Request::input('g_num');
                $gift_data['g_img'] = $newName;
                $bool = DB::table('gift')
                    ->where('g_id',$g_id)
                    -> update($gift_data);
                if($bool){
                    $username=Session::get('username');
                    $date=date("Y-H-d m:i:s");
                    $ip=Session::get('ip');
                    $content="修改一条礼品信息";
                    $re = DB::table('log')->insert(['adm_name'=>$username,'l_content'=>$content,'l_time'=>$date,'l_ip'=>$ip]);
                    return redirect('giftList');
                }
            }
        }
    }
}