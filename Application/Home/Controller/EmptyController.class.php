<?php
namespace Home\Controller;
class EmptyController extends BaseController{

    protected $autoInstantiateModel = true;
    public function _empty($name){
        echo "空action";
    }
    public function index()
    {
        echo "空";
        //$this->surname($cityName);
    }



}
?>