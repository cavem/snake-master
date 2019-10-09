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

use app\admin\model\ProductdModel;

class Productd extends Base
{
    // 产品列表
    public function index()
    {
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }

            $productd = new ProductdModel();
            $selectResult = $productd->getProductdByWhere($where, $offset, $limit);

            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['type'] = getPronameByid($selectResult[$key]['type'],"product_typed");
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            $return['total'] = $productd->getAllProductd($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加产品
    public function productdAdd()
    {
        if(request()->isPost()){
            $param = input('post.');

            $productd = new ProductdModel();
            
            $flag = $productd->insertProductd($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $type = db('product_typed')->where("fid",0)->select();

        $this->assign([
            "type" => $type
        ]);

        return $this->fetch();
    }
    /**
     * 根据产品ID获取子产品
     */
    public function getChild(){
        $id = input('id');
        $res = db('product_typed')->where("fid",$id)->select();
        return json_encode($res);
    }

    public function productdEdit()
    {
        $productd = new ProductdModel();
        if(request()->isPost()){

            $param = input('post.');
            $flag = $productd->editProductd($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $type = db('product_typed')->where("fid",0)->select();

        $this->assign([
            'productd' => $productd->getOneProductd($id),
            "type" => $type
        ]);
        return $this->fetch();
    }

    public function productdDel()
    {
        $id = input('param.id');

        $productd = new ProductdModel();
        $flag = $productd->delProductd($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
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
                'auth' => 'productd/productdedit',
                'href' => url('productd/productdedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'productd/productddel',
                'href' => "javascript:productdDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
