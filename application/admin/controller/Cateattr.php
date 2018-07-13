<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\CateAttr as model;
/**
 * @title 分类属性
 * @description ...
 */
class Cateattr extends Paren
{   
    /**
     * @title 分类属性列表
     * @description
     * @author 
     * @url /admin/cateattr/lst
     * @method GET
     * @param name:cat_id type:int require:1 default: other: desc:分类id
     * name:name type:string require:1 default: other: desc:分类属性名称
     * name:display type:int require: default:1 other: desc:分类属性显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function lst(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->lst();
        $this->result($result['data'],$result['code'],'','json');
    }

    /**
     * @title 获取添加/编辑页面需要的数据
     * @description
     * @author 
     * @url /admin/cateattr/addpage
     * @method GET
     * @param 
     * @return data:返回信息
     */
    public function addpage(Request $request,model $model){
        $result=$model->addpage();
        $this->result($result['data'],$result['code'],'','json');
    }

    /**
     * @title 添加/编辑分类属性
     * @description
     * @author 
     * @url /admin/cateattr/add
     * @method POST
     * @param name:cat_id type:int require:1 default: other: desc:分类id
     * name:name type:string require:1 default: other: desc:分类属性名称
     * name:display type:int require: default:1 other: desc:分类属性显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function add(Request $request,model $model){
    //  self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $unique['require']='require';
        $unique['unique']='cate_attr,name';
        if(isset($param['id'])){
            $unique['unique']='cate_attr,name,'.$param['id'];
        }
        $validate=$this->validate($param,[
            'cat_id|分类'=>'require',
            'name|分类属性名'=>$unique
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
     * @title 删除分类属性
     * @description
     * @author 
     * @url /admin/cateattr/del
     * @method GET
     * @return data:返回信息
     */
    public function del(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->del($_POST['id']);
        $this->result('',$result['code'],$result['msg'],'json');
    }
}
