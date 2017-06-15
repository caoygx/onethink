<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 * @author huajie <banhuajie@163.com>
 */
class VideoController extends ThinkController {

    function lists(){
        //检查该分类是否允许发布内容
        $category_id = I('category_id');
        $allow_publish  =   get_category($category_id, 'allow_publish');
        $this->assign('allow',  $allow_publish);

        //获取左边菜单
        $this->getMenu();
        parent::lists('video',0,'think/lists');
        //$this->lists('video');
    }

    function add($model = null){
        //获取左边菜单
        $this->getMenu();
        parent::add($model ,'think/add');
    }

    public function edit($model = null, $id = 0,$tpl=''){
        //获取左边菜单
        $this->getMenu();
        parent::edit($model,$id,'think/edit' );
    }

    /**
     * 显示左边菜单，进行权限控制
     * @author huajie <banhuajie@163.com>
     */
    protected function getMenu(){
        //获取动态分类
        $cate_auth  =   AuthGroupModel::getAuthCategories(UID); //获取当前用户所有的内容权限节点
        $cate_auth  =   $cate_auth == null ? array() : $cate_auth;
        $cate       =   M('Category')->where(array('status'=>1))->field('id,title,pid,allow_publish,model')->order('pid,sort')->select();

        //没有权限的分类则不显示
        if(!IS_ROOT){
            foreach ($cate as $key=>$value){
                if(!in_array($value['id'], $cate_auth)){
                    unset($cate[$key]);
                }
            }
        }

        $cate           =   list_to_tree($cate);    //生成分类树

        //获取分类id
        $cate_id        =   I('param.cate_id');
        $this->cate_id  =   $cate_id;

        //是否展开分类
        $hide_cate = false;
        if(ACTION_NAME != 'recycle' && ACTION_NAME != 'draftbox' && ACTION_NAME != 'mydocument'){
            $hide_cate  =   true;
        }

        //生成每个分类的url
        foreach ($cate as $key=>&$value){
            //获取model信息
            $isIndependent = false;
            if($value['model'] && is_numeric($value['model'])){
                $rModel = M('Model')->find($value['model']);
                if($rModel['extend'] == 0){
                    $isIndependent = true;
                }
            }
            if($isIndependent){
                $value['url'] = 'video/lists?model='.$rModel['name'].'&category_id='.$value['id'];
            }else{
                $value['url']   =   'video/lists?category_id='.$value['id'];
                if($cate_id == $value['id'] && $hide_cate){
                    $value['current'] = true;
                }else{
                    $value['current'] = false;
                }
                if(!empty($value['_child'])){
                    $is_child = false;
                    foreach ($value['_child'] as $ka=>&$va){
                        $va['url']      =   'video/lists?category_id='.$va['id'];
                        if(!empty($va['_child'])){
                            foreach ($va['_child'] as $k=>&$v){
                                $v['url']   =   'video/lists?category_id='.$v['id'];
                                $v['pid']   =   $va['id'];
                                $is_child = $v['id'] == $cate_id ? true : false;
                            }
                        }
                        //展开子分类的父分类
                        if($va['id'] == $cate_id || $is_child){
                            $is_child = false;
                            if($hide_cate){
                                $value['current']   =   true;
                                $va['current']      =   true;
                            }else{
                                $value['current']   =   false;
                                $va['current']      =   false;
                            }
                        }else{
                            $va['current']      =   false;
                        }
                    }
                }
            }
        }
        $this->assign('nodes',      $cate);
        $this->assign('category_id',    $this->cate_id);

        //获取面包屑信息
        $nav = get_parent_category($cate_id);
        $this->assign('rightNav',   $nav);

        //获取回收站权限
        $this->assign('show_recycle', IS_ROOT || $this->checkRule('Admin/article/recycle'));
        //获取草稿箱权限
        $this->assign('show_draftbox', C('OPEN_DRAFTBOX'));
        //获取审核列表权限
        $this->assign('show_examine', IS_ROOT || $this->checkRule('Admin/article/examine'));
    }



}