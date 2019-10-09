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
namespace app\admin\controller;

use app\admin\model\SliderModel;

class Slider extends Base
{
    public function index(){
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $slider = new SliderModel();
            $selectResult = $slider->getSlidersByWhere($where, $offset, $limit);


            // 拼装参数
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['type'] = $vo['type']==0?"首页":"活动页";
                $img_url = $vo['img_url'];
                if($img_url){
                    $selectResult[$key]['img_url'] = '<a href="'.$img_url.'" target="blank">点击查看</a>';
                }
                
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            $return['total'] = 2;  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加轮播图
    public function sliderAdd()
    {
        if(request()->isPost()){
            $param = input('post.');

            $slider = new SliderModel();
            
            $flag = $slider->insertSlider($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        return $this->fetch();
    }

    // 编辑
    public function sliderEdit()
    {
        $slider = new SliderModel();

        if(request()->isPost()){

            $param = input('post.');

            $flag = $slider->editSlider($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');

        $this->assign([
            'slider' => $slider->getOneSlider($id),
        ]);
        return $this->fetch();
    }

    public function sliderDel()
    {
        $id = input('param.id');

        $slider = new SliderModel();
        $flag = $slider->delSlider($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadImg()
    {
        if(request()->isAjax()){

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            if($info){
                $src =  '/upload' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '编辑' => [
                'auth' => 'slider/slideredit',
                'href' => url('slider/sliderEdit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'slider/sliderdel',
                'href' => "javascript:sliderDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}