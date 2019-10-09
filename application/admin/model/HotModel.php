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


class HotModel extends Model
{
    // 确定链接表名
    protected $name = 'hot';

    /**
     * 根据搜索条件获取热销列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getHotsByWhere($where, $offset, $limit)
    {
        return $this->alias('hot')
            ->where($where)->limit($offset, $limit)->order('id asc')->select();
    }

    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editHot($param)
    {
        try{

            $result =  $this->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('hot/index'), '编辑热销成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }
    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneHot($id)
    {
        return $this->where('id', $id)->find();
    }
}
