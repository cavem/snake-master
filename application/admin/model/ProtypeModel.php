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

class ProtypeModel extends Model
{
    // 确定链接表名
    protected $name = 'product_typer';

    /**
     * 查询产品类型
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getProtypeByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->field('id,name,fid pid')->select();
    }

    /**
     * 根据搜索条件获取所有的产品类型数量
     * @param $where
     */
    public function getAllProtype($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 插入产品类型信息
     * @param $param
     */
    public function insertProtype($param)
    {
        try{

            $result =  $this->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('protype/index'), '添加产品类型成功');
            }
        }catch(PDOException $e){

            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑产品类型信息
     * @param $param
     */
    public function editProtype($param)
    {
        try{

            $result = $this->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('protype/index'), '编辑产品类型成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据产品类型的id 获取产品类型的信息
     * @param $id
     */
    public function getOneProtype($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除产品类型
     * @param $id
     */
    public function delProtype($id)
    {
        try{

            $this->where('id', $id)->delete();
            
            return msg(1, '', '删除产品类型成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
