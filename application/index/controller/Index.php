<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $slider = db('slider')->where('type',0)->select();
        $hot = db('hot')->select();
        $this->assign([
            "slider"=>$slider,
            "hot" => $hot
        ]);
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }
}
