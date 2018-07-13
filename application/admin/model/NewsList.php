<?php

namespace app\admin\model;

use think\Exception;
use think\Model;

class NewsList extends Model
{
    //列表
    public function lst(){
        $row=10;
        $where=[];
        $where['display']=1;
        $data=$this->where($where)->paginate($row);
        return [
            'code'=>200,
            'data'=>$data
        ];
    }

    //添加 编辑
    public function setSave($data){
        try{
            $data['add_time']=date('Y-m-d H:i:s',time());
            if(isset($data['id']) && !empty($data['id'])){
                $this->allowField(true)
                    ->save([$data],['id'=>$data['id']]);
            }else{
                $this->allowField(true)
                    ->save([$data]);
            }
            return [
                'code'=>200,
                'msg'=>'发布成功'
            ];
        }catch (Exception $e){
            return [
                'code'=>0,
                'msg'=>$e->getMessage()
            ];
        }
    }
    //删除
    public function del($id){
        try{
            $this->destroy($id);
            return [
                'code'=>200,
                'msg'=>'删除成功'
            ];
        }catch(Exception $e){
            return [
                'code'=>0,
                'msg'=>$e->getMessage()
            ];
        }
    }
}
