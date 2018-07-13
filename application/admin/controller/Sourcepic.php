<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\SourcePic as model;
/**
 * @title 房源图片
 * @description ...
 */
class Sourcepic extends Paren
{
    /**
     * @title 房源图片列表
     * @description
     * @author 
     * @url /admin/sourcepic/lst
     * @method POST
     * @param name:sou_id type:int require:1 default: other: desc:房源id
     * name:pic type:string require: default: other: desc:房源图片
     * name:display type:int require: default:1 other: desc:分类显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function lst(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $sou_id=$request->param('sou_id');
        $result=$model->lst($sou_id);
        $this->result($result['data'],$result['code'],'','json');
    }


    /**
     * @title 添加/编辑房源图片
     * @description
     * @author 
     * @url /admin/sourcepic/add
     * @method POST
     * @param name:sou_id type:int require:1 default: other: desc:房源id
     * name:pic type:string require: default: other: desc:房源图片
     * name:display type:int require: default:1 other: desc:分类显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function add(Request $request,model $model){

//        self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $validate=$this->validate($param,[
            'sou_id|房源'=>'require',
            'pic|图片'=>'require',
        ]);
        if(true !== $validate){
            $result['code']=0;
            $result['msg']=$validate;
            return $this->result('',$result['code'],$result['msg'],'json');
        }
        $result=$model->setSave($param);
        $this->result('',$result['code'],$result['msg'],'json');
    }


    /**
     * @title 删除房源图片
     * @description
     * @author 
     * @url /admin/sourcepic/del
     * @method GET
     * @return data:返回信息
     */
    public function del(Request $request,model $model){

//        self::adminAutho('test_add'); //权限验证，先注释
        // $param=$request->param();
        $result=$model->del($_POST['id']);
        $this->result('',$result['code'],$result['msg'],'json');
    }
}
