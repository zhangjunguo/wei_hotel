<?php 
namespace App\Http\Middleware;

header('content-type:text/html;charset=utf8');
use Session,Closure,Request,DB;
use Illuminate\Contracts\View\Factory;
class Permission {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,Closure $next)
    {

        //权限验证
        $uid=Session::get('uid');
        $data=DB::table('adm_role')
            ->join('role','adm_role.ro_id', '=', 'role.ro_id')
            ->join('role_power','role.ro_id', '=', 'role_power.ro_id')
            ->join('power', 'role_power.p_id', '=', 'power.p_id')
            ->select('power.p_id','p_name', 'p_routes', 'pid')
            ->where('adm_id',$uid)
            ->get();
        // $data= $this->dg($data,$parent_id=0);
        
        $left= $this->selall_level($data,$pid=0,$level=0);
        // print_r($left);die;
        if(!empty($left)){
           view()->share('left',$left);
           return $next($request);
         }else{
            echo "没有权限，请联系管理员";exit;
         }
    }

    public function selall_level($data,$pid=0,$level=0){
        $data = json_decode(json_encode($data), true);
        //定义一个静态数组
        $arr = [];
        foreach($data as $key=>$v){
            if ($v['pid'] == 0) {
                $arr[$v['p_id']] = $v;
            } else {
                $arr[$v['pid']]['data'][] = $v;
            }
        }
        return json_decode(json_encode($arr, true));
    }
    
}