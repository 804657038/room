<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
use app\admin\validate\Test;

class TestModel extends Model
{
    //
    public function setSave($data){
        $validate=new Test;
        if (!$validate->check($data)) {
            return [
                'code'=>0,
                'msg'=>$validate->getError()
            ];
        }
        try{
            if(isset($data['id']) && !empty($data['id'])){
                $this->allowField(true)->save([
                    'title'=>$data['title']
                ],['id'=>$data['id']]);
            }else{
                $this->allowField(true)->save([
                    'title'=>$data['title']
                ]);
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
}
