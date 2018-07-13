<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\NewsList as model;
/**
 * @title 新闻列表/详情
 * @description ...
 */
class Newslist extends Paren
{   
    /**
     * @title 新闻列表/详情页
     * @description
     * @author 
     * @url /admin/newslist/lst
     * @method GET
     * @param name:ncat_id type:int require:1 default: other: desc:新闻分类
     * name:title type:string require: default: other: desc:新闻标题
     * name:content type:string require: default: other: desc:新闻内容
     * name:pic type:string require: default: other: desc:新闻图片
     * name:display type:int require: default:1 other: desc:显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function lst(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->lst();
        $this->result($result['data'],$result['code'],'','json');
    }

    /**
     * @title 添加/编辑新闻列表/详情
     * @description
     * @author 
     * @url /admin/newslist/add
     * @method POST
     * @param name:ncat_id type:int require:1 default: other: desc:新闻分类
     * name:title type:string require: default: other: desc:新闻标题
     * name:content type:string require: default: other: desc:新闻内容
     * name:pic type:string require: default: other: desc:新闻图片
     * name:display type:int require: default:1 other: desc:显示状态(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function add(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $unique['require']='require';
        $unique['unique']='news_list,title';
        if(isset($param['id'])){
            $unique['unique']='news_list,title,'.$param['id'];
        }
        $validate=$this->validate($param,[
            'title|新闻标题'=>$unique,
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
     * @title 删除新闻
     * @description
     * @author 
     * @url /admin/newslist/del
     * @method GET
     * @return data:返回信息
     */
    public function del(Request $request,model $model){

    //  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->del($_POST['id']);
        $this->result('',$result['code'],$result['msg'],'json');
    }
}
