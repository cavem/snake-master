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

use app\admin\model\ProtypeModel;

class Protype extends Base
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

            // $protype = new ProtypeModel();
            // $selectResult = $protype->getProtypeByWhere($where, $offset, $limit);
            $selectResult = db('product_typer')->field('id,name,fid pid')->select();

            foreach($selectResult as $key=>$vo){
                
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            // $return['total'] = $protype->getAllProtype($where);  // 总数据
            // $return['rows'] = $selectResult;

            return json($selectResult);
        }

        return $this->fetch();
    }

    // 添加产品类型
    public function protypeAdd()
    {
        if(request()->isPost()){
            $param = input('post.');

            $protype = new ProtypeModel();
            
            $flag = $protype->insertProtype($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $this->assign([
            "fid" => input("fid",0)
        ]);
        
        return $this->fetch();
    }

    public function protypeEdit()
    {
        $protype = new ProtypeModel();
        if(request()->isPost()){

            $param = input('post.');
            $flag = $protype->editProtype($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $this->assign([
            'protype' => $protype->getOneProtype($id)
        ]);
        return $this->fetch();
    }

    public function protypeDel()
    {
        $id = input('param.id');

        $protype = new ProtypeModel();
        $flag = $protype->delProtype($id);
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
                'auth' => 'protype/protypeedit',
                'href' => url('protype/protypeedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'protype/protypedel',
                'href' => "javascript:protypeDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ],
            '添加子产品' => [
                'auth' => 'protype/protypeadd',
                'href' => url('protype/protypeadd', ['fid' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-plus'
            ]
        ];
    }
}
