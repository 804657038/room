<?php

namespace app\admin\model;

use think\Exception;
use think\Model;

class TagAttr extends Model
{
    //列表
    public function lst($tag_id){
        $row=10;
        $where=[];
        $where['display']=1;
        $data=$this->where($where)->paginate($row);
        return [
            'code'=>200,
            'data'=>$data
        ];
    }

    //获取添加/编辑页面需要的数据
    public function addpage(){
        $where=[];
        $where['display']=1;
        $data=db('tag')->where($where)->select();
        return [
            'code'=>200,
            'data'=>$data
        ];
    }

    //添加 编辑
    public function setSave($data){
        try{
            $data['time'] = time();
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
