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

use app\admin\model\ProtypedModel;

class Protyped extends Base
{
    // 产品类型列表
    public function index()
    {
        if(request()->isAjax()){

            $param = input('param.');

            // $limit = $param['pageSize'];
            // $offset = ($param['pageNumber'] - 1) * $limit;

            // $where = [];
            // if (!empty($param['searchText'])) {
            //     $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            // }

            // $protyped = new ProtypedModel();
            // $selectResult = $protyped->getProtypedByWhere($where, $offset, $limit);
            $selectResult = db('product_typed')->field('id,name,fid pid')->select();

            foreach($selectResult as $key=>$vo){
                
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            // $return['total'] = $protyped->getAllProtyped($where);  // 总数据
            // $return['rows'] = $selectResult;

            return json($selectResult);
        }

        return $this->fetch();
    }

    // 添加产品类型
    public function protypedAdd()
    {
        if(request()->isPost()){
            $param = input('post.');

            $protyped = new ProtypedModel();
            
            $flag = $protyped->insertProtyped($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $this->assign([
            "fid" => input("fid",0)
        ]);
        
        return $this->fetch();
    }

    public function protypedEdit()
    {
        $protyped = new ProtypedModel();
        if(request()->isPost()){

            $param = input('post.');
            $flag = $protyped->editProtyped($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $this->assign([
            'protyped' => $protyped->getOneProtyped($id)
        ]);
        return $this->fetch();
    }

    public function protypedDel()
    {
        $id = input('param.id');

        $protyped = new ProtypedModel();
        $flag = $protyped->delProtyped($id);
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
                'auth' => 'protyped/protypededit',
                'href' => url('protyped/protypededit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'protyped/protypeddel',
                'href' => "javascript:protypedDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ],
            '添加子产品' => [
                'auth' => 'protyped/protypedadd',
                'href' => url('protyped/protypedadd', ['fid' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-plus'
            ]
        ];
    }
}
