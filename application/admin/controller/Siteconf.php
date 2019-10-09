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

use app\admin\model\SiteconfModel;

class Siteconf extends Base
{
    public function index(){
        $siteconf = new SiteconfModel();

        if(request()->isPost()){

            $param = input('post.');

            $flag = $siteconf->editSiteconf($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = 1;

        $this->assign([
            'siteconf' => $siteconf->getOneSiteconf($id),
        ]);
        return $this->fetch();
    }

}