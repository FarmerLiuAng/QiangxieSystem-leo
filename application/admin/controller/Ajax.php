<?php
namespace app\admin\controller;
use think\Controller;

class Ajax extends Controller{
    public function index() {
        return $this->fetch();
        
    }
    
}