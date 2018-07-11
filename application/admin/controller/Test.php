<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\TestModel;
/**
 * @title 测试功能
 * @description ...
 */
class Test extends Paren
{
    /**
     * @title 内容添加
     * @description
     * @author 李冰和
     * @url /admin/test/addtest
     * @method POST
     * @param name:title type:string require:1 default: other: desc:标题
     * @return data:返回信息
     */
    public function addtest(Request $request,TestModel $model){

//        self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $result=$model->setSave($param);
        $this->result('',$result['code'],$result['msg'],'json');
    }
}
