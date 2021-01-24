<?php
namespace app\admin\controller;
use think\Controller;

class Login extends Controller{
    public function index() {
        return $this->fetch();
        
    }
    public function dologin() {
        
      $user = $_POST['username'];
      $pass = $_POST['password']; 
      
      $info = db('users')->field('userid,name,passwd')->where('name',$user)->find();
      $info2 = db('yonghu')->field('yhpasswd')->where('yonghuname',$user)->find();
      if(!$info && !$info2){
           echo "该用户不存在";
      }
      else if(!$info2)
        {
          $userid = $info['userid'];
          if($pass == $info['passwd']){
            if(session('user')!=$user){
                $roleinfo = db('user-role')->field('userid,role')->where('userid',$userid)->find();
                session('user',$user);
                session('role',$roleinfo['role']);
            }
          
           if(session('role')=='1'){
            $this->success('登入成功', 'user/index');
           }
           if(session('role')=='2'){
            $this->success('登入成功', 'user2/index');
           }
          }
          else{
              echo "密码输入错误";
          }
      }
      else {
           if($pass == $info2['yhpasswd']){
                $this->success('登入成功', 'front/index');
           }
      }
      
    }
    /**
     * 登出
     */
    public function logout() {
        session(null);
        session(null);
        $this->success('退出成功', 'login/index.html');
    }

    public function test(){
        echo 'test';
    }

}
