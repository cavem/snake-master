<?php
namespace app\index\controller;

use think\Controller;
use think\Cache;

class Product extends Controller
{
    public function serverrent()
    {
        $typeid = input('typeid');
        $childid = input('childid',0);

        $type_list = db('product_typer')->where('fid',0)->select();
        if($typeid){
            $item_title = db('product_typer')->where('id',$typeid)->value('name');
        }
        if($childid){
            $item_title = db('product_typer')->where('id',$childid)->value('name');
        }
        if(!$typeid){
            if($type_list){
                $typeid = $type_list[0]['id'];
                $item_title = db('product_typer')->where('id',$typeid)->value('name');
                $this->assign("type_list",$type_list);
            }
        }

        $child_list = db('product_typer')->where('fid',$typeid)->select();

        if(!$childid){
            if($child_list){
                $childid = $child_list[0]['id'];
                $item_title = db('product_typer')->where('id',$childid)->value('name');
            }
        }

        $list = db('product_rent')->where(["type"=>$typeid,"child_type"=>$childid])->select();
        
        $this->assign([
            "item_title" => $item_title,
            "typeid" => $typeid,
            "childid" => $childid,
            "type_list" => $type_list,
            "child_list" => $child_list,
            "list" => $list
        ]);
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }
    public function serverdeposit()
    {
        $typeid = input('typeid');
        $childid = input('childid',0);

        $type_list = db('product_typed')->where('fid',0)->select();
        if($typeid){
            $item_title = db('product_typed')->where('id',$typeid)->value('name');
        }
        if($childid){
            $item_title = db('product_typed')->where('id',$childid)->value('name');
        }
        if(!$typeid){
            if($type_list){
                $typeid = $type_list[0]['id'];
                $item_title = db('product_typed')->where('id',$typeid)->value('name');
                $this->assign("type_list",$type_list);
            }
        }

        $child_list = db('product_typed')->where('fid',$typeid)->select();

        if(!$childid){
            if($child_list){
                $childid = $child_list[0]['id'];
                $item_title = db('product_typed')->where('id',$childid)->value('name');
            }
        }

        $list = db('product_deposit')->where(["type"=>$typeid,"child_type"=>$childid])->select();
        
        $this->assign([
            "item_title" => $item_title,
            "typeid" => $typeid,
            "childid" => $childid,
            "type_list" => $type_list,
            "child_list" => $child_list,
            "list" => $list
        ]);
        $site = db('siteconf')->where('id',1)->find();
        $this->assign('site',$site);
        return $this->fetch();
    }
}
