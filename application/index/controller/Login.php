<?php
namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    public function login()
    {
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }

    public function register()
    {
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }
}
