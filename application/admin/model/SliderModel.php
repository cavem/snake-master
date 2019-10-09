<?php
// +----------------------------------------------------------------------
// | snake
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2022 http://baiyf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;


class SliderModel extends Model
{
    // 确定链接表名
    protected $name = 'slider';

    /**
     * 根据搜索条件获取轮播图列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getSlidersByWhere($where, $offset, $limit)
    {
        return $this->alias('slider')->field( 'id,name,img_url,type')
            ->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 插入轮播图信息
     * @param $param
     */
    public function insertSlider($param)
    {
        try{

            $result =  $this->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('slider/index'), '添加轮播图成功');
            }
        }catch(PDOException $e){

            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editSlider($param)
    {
        try{

            $result =  $this->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('slider/index'), '编辑轮播图成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }
    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneSlider($id)
    {
        return $this->where('id', $id)->find();
    }
    /**
     * 删除轮播图
     * @param $id
     */
    public function delSlider($id)
    {
        try{

            $this->where('id', $id)->delete();
            
            return msg(1, '', '删除轮播图成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
