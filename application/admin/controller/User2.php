<?php
namespace app\admin\controller;
use think\Controller;

class User2 extends Controller{
    public function index() {
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $user = session('user');
        $this->assign('user',$user);
        $role = session('role');
        $this->assign('role',$role);
        $gonggao = db('gonggao')->field('content')->column('content');
        // var_dump($gonggao);
        $this->assign('gonggao',$gonggao);
        return $this->fetch();
    }
    
    public function yonghu(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $lists = db('yonghu')->select();
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    
   
    
    public function sushe(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $lists = db('shoes')->select();
        // var_dump($lists);
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    
    
      public function change(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        return $this->fetch();
    }
    public function dochange(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $nps1 = $_POST['newpassword1'];
        $nps2 = $_POST['newpassword2'];
        
        $wrong1 = '您的用户名有错';
        $wrong2 = '您的密码有错';
        $wrong3 = '您两次输入的密码不同';
        $info = db('users')->field('name,passwd')->where('name',$user)->find();
     
        if (!$info) {
            echo $wrong1;
            
        } 
        else if($info['passwd']!= $pass){
            echo $wrong2;
            // code...
        }
        else if($nps1!=$nps2){
            echo $wrong3;
        }
        else{
            db('users')->where('name',$user)->update(['passwd' => $nps1]);
            $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => '修改密码', 'time' => time()];
            db('log')->insert($data);
            return $this->fetch("change");
        }
        
       
    }
     
    function chaxunsushe(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('lists',null);
        return $this->fetch();
    }
   function  dosearchsushe(){
       if(!session('user') || !session('role')){
            return $this->error();
        }
       $user = $_POST['username'];
        
       $info = db("shoes")->where("name",$user)->select();
       $this->assign('lists',$info);
       return $this->fetch("chaxunsushe");
   
   }
    function changesushe(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        // $this->assign('sta',null);
        // $this->assign('sushe',null);
        // $this->assign('mubiao',null);
        // $this->assign('war',null);
        // $this->assign('s',null);
        $this->assign('warning',null);
        return $this->fetch();
    }
    function  dochangesushe(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('warning',null);
       $delenumber= $_POST['number'];//球鞋ID
        
        $user = $_POST['username'];
        $passwd = $_POST['password'];
        $type = $_POST['type'];
        $target = $_POST['target'];
        if(!db('shoes')->where('shoeid',$delenumber)->find()){
            $this->assign('warning',"该商品不存在");
        }
        else{
            $info = db('users')->field('name,passwd')->where('name',$user)->find();
            
            // db('gonggao')->insert(['content'=>$reason]);
            if($info['passwd'] == $passwd){
                switch ($type) {
                    case '0':
                        // code...
                        if(db('shoes')->where('shoeid',$delenumber)->delete()){
                            $this->assign('warning','删除成功');
                            $arr = array('删除商品:', $delenumber);
                            $neirong = implode('', $arr);
                            $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => $neirong,'time' => time()];
                            db('log')->insert($data);
                        }
                        else{
                           $this->assign('warning','删除失败');
                        }
                        break;
                    case '1':
                        // code...
                        if(db('shoes')->where('shoeid',$delenumber)->update(['number' => $target])){
                            $this->assign('warning','修改成功');
                            $arr = array('修改商品:', $delenumber, (string)$target);
                            $neirong = implode('', $arr);
                           
                             $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => $neirong,'time' => time()];
                            db('log')->insert($data);
                        }
                        else{
                            $this->assign('warning','修改失败');
                        }
                        break;
                    default:
                        // code...
                        break;
                }
            }
            else{
                $this->assign('warning','您的用户名或密码输入错误');
            }
        }
        
        return $this->fetch("changesushe");
    
    }
    //   $user = $_POST['username'];
    //   $type = $_POST['type'];
    //   $target = $_POST['target'];
    //   $info1 = db("yonghu")->field("susheId")->where("yonghu",$user)->find();
    //   $this->assign('sushe',$info1);//当前宿舍号
    //   $info = db("sushe")->field("status")->where("susheid",$target)->find();
    //   $this->assign('sta',$info);//目标宿舍剩余床位数
    //   $this->assign('mubiao',$target);//目标宿舍宿舍号
    //   $war = "已满，请重新选择";
    //   $this->assign('s',null);
    //   if($type==0){
    //         if($info['status'] <= 0){
    //           if(!$target){
    //               $this->assign('war',null);
    //           }
    //           else{
    //               $this->assign('war',$war);//警告信息
    //           }
               
    //       }
    //       else{
    //           $this->assign('war',null);
    //           db('yonghu')->where('yonghu',$user)->update(['susheId' => $target]);
    //           db('sushe')->where('susheid',$info1['susheId'])->inc('status')->update();
    //           db('sushe')->where('susheid',$target)->dec('status',1)->update();
    //       }
    //   }
    //     if($type==1){
    //         if(db('yonghu')->where('yonghu',$user)->delete()){
    //              $this->assign('war','删除成功');
    //         }
    //         else{
    //             $this->assign('war','姓名错误或者无该生的入住信息');
    //         }
    //     }
    //      if($type==2){
    //         if(db('yonghu')->where('yonghu',$user)->find()){
    //             $this->assign('war',"此用户已分配宿舍");
    //         }
    //         else {
    //             $info3 = db("sushe")->field("susheid")->where("status",">",0)->select();
    //             $offset=mt_rand(1,count($info3));
                
    //             $id = $info3[$offset]["susheid"];
    //             $this->assign('war',null);
    //             $this->assign('s',$id);
                
    //             db('sushe')->where('susheid',$id)->dec('status',1)->update();
    //             $data = ['yonghu' => $user , 'susheId' => $id];
    //             db('yonghu')->insert($data);
                
    //         }    
    //     }
    //   return $this->fetch("changesushe");
   
   
   public function logout() {
        session(null);
        session(null);
        $this->success('退出成功', 'login/index');
    }
}