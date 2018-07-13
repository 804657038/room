<?php
namespace app\admin\controller;
use think\Request;
use app\admin\model\Source as model;
/**
 * @title 房源列表
 * @description ...
 */

class Source extends Paren{
    /**
     * @title 房源列表
     * @description
     * @author 
     * @url /admin/source/lst
     * @method GET
     * @param name:cat_id type:int require:1 default: other: desc:分类id
     * name:attr_id type:int require:1 default: other: desc:分类属性id
     * name:user_id type:int require:1 default: othor: desc:用户id
     * name:name type:string require:1 default: othor: desc:房源名称
     * name:pic type:string require:1 default: othor: desc:房源封面图片
     * name:add type:string require:1 default: othor: desc:房源地址
     * name:add_info type:string require: default: othor: desc:房源详细地址
     * name:price type:int require:1 default: othor: desc:价钱
     * name:area type:string require: default: othor: desc:面积
     * name:c_num type:int require: default: othor: desc:收藏人数
     * name:collect type:int require: default: othor: desc:是否收藏(1收藏 0未收藏)
     * name:v_num type:int require: default: othor: desc:预约人数
     * name:tag type:string require: default: othor: desc:标签
     * name:key type:string require: default: othor: desc:简介
     * name:desc type:string require: default: othor: desc:描述
     * name:match type:string require: default: othor: desc:配套
     * name:recommend type:int require: default: othor: desc:是否推荐(1推荐 0不推荐)
     * name:display type:int require: default: othor: desc:是否显示(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function lst(Request $request,model $model){
        //        self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->lst();
        $this->result($result['data'],$result['code'],'','json');
    }

    /**
     * @title 获取添加/编辑页面需要的数据
     * @description
     * @author 
     * @url /admin/source/addpage
     * @method GET
     * @return data:返回信息
     */
    public function addpage(Request $request,model $model){
        $param=$request->param();
        $result=$model->addpage($param);
        $this->result(['cate'=>$result['cate'],'tag'=>$result['tag']],$result['code'],'','json');
    }

	/**
     * @title 添加/编辑房源
     * @description
     * @author 
     * @url /admin/source/add
     * @method POST
     * @param name:cat_id type:int require:1 default: other: desc:分类id
     * name:attr_id type:int require:1 default: other: desc:分类属性id
     * name:user_id type:int require:1 default: othor: desc:用户id
     * name:name type:string require:1 default: othor: desc:房源名称
     * name:pic type:string require:1 default: othor: desc:房源封面图片
     * name:add type:string require:1 default: othor: desc:房源地址
     * name:add_info type:string require: default: othor: desc:房源详细地址
     * name:price type:int require:1 default: othor: desc:价钱
     * name:area type:string require: default: othor: desc:面积
     * name:c_num type:int require: default: othor: desc:收藏人数
     * name:collect type:int require: default: othor: desc:是否收藏(1收藏 0未收藏)
     * name:v_num type:int require: default: othor: desc:预约人数
     * name:tag type:string require: default: othor: desc:标签
     * name:key type:string require: default: othor: desc:简介
     * name:desc type:string require: default: othor: desc:描述
     * name:match type:string require: default: othor: desc:配套
     * name:recommend type:int require: default: othor: desc:是否推荐(1推荐 0不推荐)
     * name:display type:int require: default: othor: desc:是否显示(1显示 0隐藏)
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
   	public function add(Request $request,model $model){
   	//  self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $unique['require']='require';
        $unique['unique']='source,name';
        if(isset($param['id'])){
            $unique['unique']='source,name,'.$param['id'];
        }
        $validate=$this->validate([
            'cat_id|分类'=>'require',
            'arrr_id|分类属性'=>'require',
            'name|名称'=>$unique,
            'pic|封面图片'=>'require',
            'add|地址'=>'require',
            'add_info|详细地址'=>'require',
            'price|价钱'=>'require',
            'area|面积'=>'require',
            'tag_attr|标签'=>'require',
            'key|简介'=>'require',
            'desc|描述'=>'require',
            'match|配置'=>'require',
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
     * @title 删除房源
     * @description
     * @author 
     * @url /admin/source/del
     * @method GET
     * @return data:返回信息
     */
   	public function del(Request $request,model $model){
   		//        self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->del($_POST['id']);
        $this->result('',$result['code'],$result['msg'],'json');
   	}

}