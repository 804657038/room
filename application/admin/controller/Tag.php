<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\Tag as model;
/**
 * @title 房源属性分类
 * @description ...
 */
class Tag extends Paren
{   
    /**
     * @title 添加房源属性分类
     * @description
     * @author 
     * @url /admin/tag/lst
     * @method POST
     * @param name:name type:string require:1 default: other: desc:分类名称
     * name:display type:int require: default:1 other: desc:分类显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function lst(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->lst();
        $this->result($result['data'],$result['code'],'','json');
    }

    /**
     * @title 添加/编辑房源属性分类
     * @description
     * @author 
     * @url /admin/tag/add
     * @method POST
     * @param name:name type:string require:1 default: other: desc:分类名称
     * name:display type:int require: default:1 other: desc:分类显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function add(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $unique['require']='require';
        $unique['unique']='tag,name';
        if(isset($param['id'])){
            $unique['unique']='tag,name,'.$param['id'];
        }
        $validate=$this->validate($param,[
            'name|分类名称'=>$unique,
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
     * @title 删除房源属性分类
     * @description
     * @author 
     * @url /admin/tag/del
     * @method GET
     * @return data:返回信息
     */
    public function del(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->del($_POST['id']);
        $this->result('',$result['code'],$result['msg'],'json');
    }
}
