<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * 定义关联到模型的数据表
     * @var string
     */
    protected $table = 'power';
    //获取所有的子节点
    public function getNode(){
        $data = $this->get();
        return $this->selall_level($data,$pid=0,$level=0);
    }
    //无限极获取所有节点信息
    public function selall_level($data,$pid=0,$level=0){
        //定义一个静态数组
        static $arr = array();
        foreach($data as $key=>$v){
            if($v->pid==$pid){
                $v->level = $level;
                $arr[] = $v;
                $this->selall_level($data,$v->p_id,$level+1);
            }
        }
        return $arr;
    }
}
