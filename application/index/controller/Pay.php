<?php
namespace app\index\controller;

use think\Controller;

class Pay extends Controller
{
    public function index()
    {
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }
}
