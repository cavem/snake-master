<?php
namespace app\index\controller;

use think\Controller;

class About extends Controller
{
    public function index()
    {
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        $this->assign('id',input('id'));
        return $this->fetch();
    }
}
