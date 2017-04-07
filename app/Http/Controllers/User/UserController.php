<?php
/**
 * Created by PhpStorm.
 * User: wangyuelin
 * Date: 16/11/28
 * Time: 下午2:59
 */

namespace App\Http\Controllers\User;

use App\Http\Requests\Request;

class UserController extends \Illuminate\Routing\Controller
{
    //验证密码和用户名
    function  login(Request $request){
        //查询数据库
         $name = $request->get("name");
        $password = $request -> get("password");
        echo "name:".$name."  password:".$password;
        $user = new \UserTest();
        if(!empty($name) && !empty($password)){
            //比较是否相等
           if($user->userName == $name && $user->passWord){
               return true;
           }
        }
        return false;
    }

}