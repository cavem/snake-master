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

use app\admin\model\ProductModel;

class Product extends Base
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

            $product = new ProductModel();
            $selectResult = $product->getProductByWhere($where, $offset, $limit);

            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['type'] = getPronameByid($selectResult[$key]['type'],"product_typer");
                $selectResult[$key]['child_type'] = getPronameByid($selectResult[$key]['child_type'],"product_typer");
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            $return['total'] = $product->getAllProduct($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加产品
    public function productAdd()
    {
        if(request()->isPost()){
            $param = input('post.');

            $product = new ProductModel();
            
            $flag = $product->insertProduct($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $type = db('product_typer')->where("fid",0)->select();

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
        $res = db('product_typer')->where("fid",$id)->select();
        return json_encode($res);
    }

    public function productEdit()
    {
        $product = new ProductModel();
        if(request()->isPost()){

            $param = input('post.');
            $flag = $product->editProduct($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $type = db('product_typer')->where("fid",0)->select();
        $product = $product->getOneProduct($id);
        $child = db('product_typer')->where("fid",$product['type'])->select();
        $this->assign([
            'product' => $product,
            "type" => $type,
            "child" => $child
        ]);
        return $this->fetch();
    }

    public function productDel()
    {
        $id = input('param.id');

        $product = new ProductModel();
        $flag = $product->delProduct($id);
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
                'auth' => 'product/productedit',
                'href' => url('product/productedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'product/productdel',
                'href' => "javascript:productDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
