<?php
namespace app\admin\controller;
use think\Controller;

class User extends Controller{
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
    
     public function guanliyuan(){
         if(!session('user') || !session('role')){
            return $this->error();
        }
        $lists = db('user-role')->alias('ur')->join("users u",'u.userid=ur.userid','LEFT')->select();
        $this->assign('lists',$lists);
        // $this->assign('arr',$arr);
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
    
     public function log(){
         if(!session('user') || !session('role')){
            return $this->error();
        }
        $lists = db('log')->select();
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
      public function dele(){
          if(!session('user') || !session('role')){
            return $this->error();
        }
     
       $this->assign('warning',null);
        
        return $this->fetch();
    }
     public function dodele(){
         if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('warning',null);
        $deleuser = $_POST['user']; //yonghuname
        
        $user = $_POST['username'];
        $passwd = $_POST['password'];
        if(!db('yonghu')->where('yonghuid',$deleuser)->find()){
            $this->assign('warning', "该用户不存在");
        }
        else{
            $info = db('users')->field('name,passwd')->where('name',$user)->find();
            if($info['passwd'] == $passwd){
                db('yonghu')->where('yonghuid',$deleuser)->delete();
                $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => '删除用户','time' => time()];
                db('log')->insert($data);
                $this->assign('warning', "删除成功");
               
            }
            else{
                $this->assign('warning', "您的用户名或密码输入错误");
               
            }
        }
             return $this->fetch("dele");
    }
        // if($type == '0'){
        //     // $existuser = db('users')->where('name',$deleuser)->find()
        //     if(!db('users')->where('name',$deleuser)->find()){
        //         echo "该管理员不存在" ;
        //     }
        //     else{
        //         $info = db('users')->field('name,passwd')->where('name',$user)->find();
        //         if($info['passwd'] == $passwd){
        //             echo '删除成功';
        //         }
        //         else{
        //             echo '您的用户名或密码输入错误';
        //         }
        //     }
        // }
        
        
      
            // $existuser = db('users')->where('name',$deleuser)->find()
    function spchaxun(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('lists',null);
        return $this->fetch();
    }
   function  dosearchshangpin(){
       if(!session('user') || !session('role')){
            return $this->error();
        }
       $user = $_POST['username'];
        
       $info = db("shoes")->where("name",$user)->select();
       $this->assign('lists',$info);
       return $this->fetch("spchaxun");
   }
        
    function rychaxun(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('lists',null);
        return $this->fetch();
    }
   function  dorychaxun(){
       if(!session('user') || !session('role')){
            return $this->error();
        }
       $user = $_POST['username'];
        
       $info = db("shoes")->where("name",$user)->select();
       $info2 = db("shoes")->where("yonghuname",$user)->select();
       if(!$info){
           $this->assign('lists',$info2);
       }
       else{
            $this->assign('lists',$info);
       }
       $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => '查询人员','time' => time()];
                db('log')->insert($data);
       return $this->fetch("spchaxun");
   }
    
     public function delsushe(){
         if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('warning',null);
        return $this->fetch();
    }
     public function dodelesushe(){
         if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('warning',null);
        $delenumber= $_POST['number'];//球鞋ID
        
        $user = $_POST['username'];
        $passwd = $_POST['password'];
        $type = $_POST['type'];
        $target = $_POST['target'];
        // $existuser = db('users')->where('name',$deleuser)->find()
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
        
        return $this->fetch("delsushe");
    }
    function glyguanli(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
        $this->assign('role',null);
        $this->assign('war',null);
        return $this->fetch();
    }
    function  dogly(){
        if(!session('user') || !session('role')){
            return $this->error();
        }
       $user = $_POST['username'];
       $type = $_POST['type'];
       $target = $_POST['target'];
       $userid= db("users")->field("userid")->where("name",$user)->find();
       $role = db("user-role")->field("role")->where("userid",$userid['userid'])->find();
       $this->assign('role',$role['role']);//当前权限
       if($type==0){
           
            if(db('users')->where('name',$user)->delete()){
                
                db('user-role')->where('userid',$userid['userid'])->delete();
               
                $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => '删除管理员', 'time' => time()];
                db('log')->insert($data);
                $this->assign('war','删除成功');
                
            }
            else{   
                $this->assign('war','姓名错误或者无该管理员信息');
            }
        }
        
      if($type==1){
          if($userid){
               $this->assign('war','该管理员已存在');
          }
          else{
              $this->assign('war',null);
              $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
              $chars = str_shuffle($chars);
              $pw = substr($chars,0,10);
              $data1 = ['name' => $user , 'passwd' => $pw];
              db('users')->insert($data1);
              
              $userid= db("users")->field("userid")->where("name",$user)->find();
              $data2 = ['userid' => $userid['userid'] , 'role' => $target];
              db('user-role')->insert($data2);
            
              $this->assign('war','增加成功');
              
              $arr = array('增加管理员:', $user);
              $neirong = implode('', $arr);
              $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => $neirong, 'time' => time()];
              db('log')->insert($data);
          }    
           
      }
      
        if($type==2){
            if(!$userid){
                $this->assign('war','该管理员不存在');
            }
            else{
                if(db("user-role")->where('userid',$userid['userid'])->update( ['role' => $target])){
                      $arr1 = array( '修改管理员权限，id为:' , (string)$userid['userid']);
                      $neirong1 = implode('', $arr1);
                      $arr2 = array( '权限变为:', (string)$target);
                      $neirong2 = implode('', $arr2);
                      $arr3 = array( $neirong1, $neirong2);
                      $neirong = implode('', $arr3);
                    //   $neirong =  '修改管理员权限，id为:' + $userid;
                      $data = ['username' =>  session('user') , 'role' => session('role') ,'content' => $neirong, 'time' => time()];
                       db('log')->insert($data);
                      $this->assign('war','已经成功修改');
                }
                else{
                     $this->assign('war','修改失败');
                }
            }
                
               
        }
       return $this->fetch("glyguanli");
   
   }
   
     public function logout() {
        session(null);
        session(null);
        $this->success('退出成功', 'login/index');
    }
}