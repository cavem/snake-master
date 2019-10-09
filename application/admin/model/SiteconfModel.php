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


class SiteconfModel extends Model
{
    // 确定链接表名
    protected $name = 'siteconf';
    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editSiteconf($param)
    {
        try{
            $isexsit = $this->where('id', $param['id'])->find();
            if($isexsit){
                $result =  $this->save($param, ['id' => $param['id']]);
            }
            else{
                $result =  $this->save($param);
            }

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('siteconf/index'), '编辑站点成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据管理员id获取站点信息
     * @param $id
     */
    public function getOneSiteconf($id)
    {
        return $this->where('id', $id)->find();
    }

}
