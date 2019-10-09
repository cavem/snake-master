<?php
namespace app\index\controller;

use think\Controller;

class Events extends Controller
{
    public function index()
    {
        $slider = db('slider')->where('type',1)->select();

        $content = db('articles')->value('content');

        $this->assign([
            "slider"=>$slider,
            "content" => $content
        ]);
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }
    public function index2()
    {
        return $this->fetch();
    }
}
