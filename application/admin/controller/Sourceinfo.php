<?php
namespace app\admin\controller;
use think\Request;
use app\admin\model\SourceInfo as model;
/**
 * @title 房源详情
 * @description ...
 */

class Sourceinfo extends Paren{
    /**
     * @title 查询房源详情
     * @description
     * @author 
     * @url /admin/sourceinfo/add
     * @method POST
     * @param name:sou_id type:int require:1 default: other: desc:房源id
     * name:area type:string require: default: othor: desc:面积
     * name:width type:int require: default: othor: desc:面宽
     * name:depth type:int require: default: othor: desc:进深
     * name:height type:int require: default: othor: desc:层高
     * name:storey type:string require: default: othor: desc:楼层
     * name:tag type:string require: default: othor: desc:特色
     * name:operate type:string require: default: othor: desc:经营状态
     * name:history type:string require: default: othor: desc:历史经历
     * name:pay type:int require: default: othor: desc:付款方式
     * name:lease type:int require: default: othor: desc:租约方式
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
    public function info(Request $request,model $model){
    //  self::adminAutho('test_add'); //权限验证，先注释
        $sou_id=$request->param('sou_id');
        $result=$model->setSave($sou_id);
        $this->result($result['data'],$result['code'],'','json');
    }


	/**
     * @title 添加/编辑房源详情
     * @description
     * @author 
     * @url /admin/sourceinfo/add
     * @method POST
     * @param name:sou_id type:int require:1 default: other: desc:房源id
     * name:area type:string require: default: othor: desc:面积
     * name:width type:int require: default: othor: desc:面宽
     * name:depth type:int require: default: othor: desc:进深
     * name:height type:int require: default: othor: desc:层高
     * name:storey type:string require: default: othor: desc:楼层
     * name:tag type:string require: default: othor: desc:特色
     * name:operate type:string require: default: othor: desc:经营状态
     * name:history type:string require: default: othor: desc:历史经历
     * name:pay type:int require: default: othor: desc:付款方式
     * name:lease type:int require: default: othor: desc:租约方式
     * name:add_time type:datetime require: default: other: desc:添加时间
     * @return data:返回信息
     */
   	public function add(Request $request,model $model){
    //   self::adminAutho('test_add'); //权限验证，先注释
        $param=$request->param();
        $validate=$this->validate($param,[
            'sou_id|房源'=>'require',
            'area|面积'=>'require',
            'width|面宽'=>'require',
            'depth|进深'=>'require',
            'height|层高'=>'require',
            'storey|楼层'=>'require',
            'tag|特色'=>'require',
            'operate|经营状态'=>'require',
            'history|历史经营'=>'require',
            'pay|付款方式'=>'require',
            'lease|租约方式'=>'require',
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
     * @title 删除房源详情
     * @description
     * @author 
     * @url /admin/sourceinfo/del
     * @method GET
     
     * @return data:返回信息
     */
   	public function del(Request $request,model $model){
   	//  self::adminAutho('test_add'); //权限验证，先注释
        $result=$model->del($_POST['id']);
        $this->result('',$result['code'],$result['msg'],'json');
   	}

}