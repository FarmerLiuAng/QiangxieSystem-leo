<?php
namespace app\admin\controller;
use think\Controller;

class Front extends Controller{
    public function index() {
        $this->assign('warning1',null);
        $this->assign('warning2',null);
        $this->assign('warning3',null);
        $this->assign('warning4',null);
        $this->assign('warning5',null);
        $this->assign('warning6',null);
        return $this->fetch();
        
    }
    
    public function lining(){
         $this->assign('warning1',null);
        $this->assign('warning2',null);
        $this->assign('warning3',null);
        $this->assign('warning4',null);
        $this->assign('warning5',null);
        $this->assign('warning6',null);
         return $this->fetch();
    }
    
     public function aj(){
        $this->assign('warning1',null);
        $this->assign('warning2',null);
        $this->assign('warning3',null);
        $this->assign('warning4',null);
        $this->assign('warning5',null);
        $this->assign('warning6',null);
         return $this->fetch();
    }

    public function ajbuy(){
        $this->assign('warning1',null);
        $this->assign('warning2',null);
        $this->assign('warning3',null);
        $this->assign('warning4',null);
        $this->assign('warning5',null);
        $this->assign('warning6',null);
        $buyname= $_POST['shoename'];
        // $buyname = "anta1";
        $size= $_POST['size'];
        // $this->assign('warning',null);
        // $existuser = db('users')->where('name',$deleuser)->find()
        $info = db('shoes')->field('number')->where('name',$buyname)->where('size',$size)->find();
        $number = $info['number'] ;
        $war1 = "购买成功";
        $war2 = "已经被抢空";
        if($number>=1){
            switch ($buyname) {
                case 'aj1':
                    // code...
                    $this->assign('warning1',$war1);
                    break;
                case 'aj12':
                    // code...
                    $this->assign('warning2',$war1);
                    break;
                case 'aj2':
                    // code...
                    $this->assign('warning3',$war1);
                    break;
                case 'aj22':
                    // code...
                    $this->assign('warning4',$war1);
                    break;
                case 'aj3':
                    // code...
                    $this->assign('warning5',$war1);
                    break;
                case 'aj32':
                    // code...
                    $this->assign('warning6',$war1);
                    break;
                default:
                    // code...
                    
                    break;
            }
            
            db("shoes")->where('name',$buyname)->where('size',$size)->dec('number',1)->update();
            return $this->fetch("aj");
        } 
        else{
            switch ($buyname) {
                case 'aj1':
                    // code...
                    $this->assign('warning1',$war1);
                    break;
                case 'aj12':
                    // code...
                    $this->assign('warning2',$war1);
                    break;
                case 'aj2':
                    // code...
                    $this->assign('warning3',$war1);
                    break;
                case 'aj22':
                    // code...
                    $this->assign('warning4',$war1);
                    break;
                case 'aj3':
                    // code...
                    $this->assign('warning5',$war1);
                    break;
                case 'aj32':
                    // code...
                    $this->assign('warning6',$war1);
                    break;
                default:
                    // code...
                    
                    break;
            }
            return $this->fetch("aj");
        }
       
        
    }
    public function antabuy(){
        $this->assign('warning1',null);
        $this->assign('warning2',null);
        $this->assign('warning3',null);
        $this->assign('warning4',null);
        $this->assign('warning5',null);
        $this->assign('warning6',null);
        $buyname= $_POST['shoename'];
        // $buyname = "anta1";
        $size= $_POST['size'];
        // $this->assign('warning',null);
        // $existuser = db('users')->where('name',$deleuser)->find()
        $info = db('shoes')->field('number')->where('name',$buyname)->where('size',$size)->find();
        $number = $info['number'] ;
        $war1 = "购买成功";
        $war2 = "已经被抢空";
        if($number>=1){
            switch ($buyname) {
                case 'anta1':
                    // code...
                    $this->assign('warning1',$war1);
                    break;
                case 'anta12':
                    // code...
                    $this->assign('warning2',$war1);
                    break;
                case 'anta2':
                    // code...
                    $this->assign('warning3',$war1);
                    break;
                case 'anta22':
                    // code...
                    $this->assign('warning4',$war1);
                    break;
                case 'anta3':
                    // code...
                    $this->assign('warning5',$war1);
                    break;
                case 'anta32':
                    // code...
                    $this->assign('warning6',$war1);
                    break;
                default:
                    // code...
                    
                    break;
            }
            
            db("shoes")->where('name',$buyname)->where('size',$size)->dec('number',1)->update();
            return $this->fetch("index");
        } 
        else{
            switch ($buyname) {
                case 'anta1':
                    // code...
                    $this->assign('warning1',$war2);
                    break;
                case 'anta12':
                    // code...
                    $this->assign('warning2',$war2);
                    break;
                case 'anta2':
                    // code...
                    $this->assign('warning3',$war2);
                    break;
                case 'anta22':
                    // code...
                    $this->assign('warning4',$war2);
                    break;
                case 'anta3':
                    // code...
                    $this->assign('warning5',$war2);
                    break;
                case 'anta32':
                    // code...
                    $this->assign('warning6',$war2);
                    break;
                default:
                    // code...
                    
                    break;
            }
            return $this->fetch("index");
        }
       
        
    }
    public function liningbuy(){
        $this->assign('warning1',null);
        $this->assign('warning2',null);
        $this->assign('warning3',null);
        $this->assign('warning4',null);
        $this->assign('warning5',null);
        $this->assign('warning6',null);
        $buyname= $_POST['shoename'];
        // $buyname = "anta1";
        $size= $_POST['size'];
        // $this->assign('warning',null);
        // $existuser = db('users')->where('name',$deleuser)->find()
        $info = db('shoes')->field('number')->where('name',$buyname)->where('size',$size)->find();
        $number = $info['number'] ;
        $war1 = "购买成功";
        $war2 = "已经被抢空";
        if($number>=1){
            switch ($buyname) {
                case 'lining1':
                    // code...
                    $this->assign('warning1',$war1);
                    break;
                case 'lining12':
                    // code...
                    $this->assign('warning2',$war1);
                    break;
                case 'lining2':
                    // code...
                    $this->assign('warning3',$war1);
                    break;
                case 'lining22':
                    // code...
                    $this->assign('warning4',$war1);
                    break;
                case 'lining3':
                    // code...
                    $this->assign('warning5',$war1);
                    break;
                case 'lining32':
                    // code...
                    $this->assign('warning6',$war1);
                    break;
                default:
                    // code...
                    
                    break;
            }
            
            db("shoes")->where('name',$buyname)->where('size',$size)->dec('number',1)->update();
            return $this->fetch("lining");
        } 
        else{
            switch ($buyname) {
                 case 'lining1':
                    // code...
                    $this->assign('warning1',$war2);
                    break;
                case 'lining12':
                    // code...
                    $this->assign('warning2',$war2);
                    break;
                case 'lining2':
                    // code...
                    $this->assign('warning3',$war2);
                    break;
                case 'lining22':
                    // code...
                    $this->assign('warning4',$war2);
                    break;
                case 'lining3':
                    // code...
                    $this->assign('warning5',$war2);
                    break;
                case 'lining32':
                    // code...
                    $this->assign('warning6',$war2);
                    break;
                default:
                    // code...
                    
                    break;
            }
            return $this->fetch("lining");
        }
       
        
    }
    
    
}