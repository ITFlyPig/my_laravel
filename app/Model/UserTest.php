<?php

namespace App\Model;
/**
 * Created by PhpStorm.
 * User: wangyuelin
 * Date: 16/11/28
 * Time: 下午3:06
 */
class UserTest
{
    var $userName;
    var $passWord;

    function __construct($name, $pass){//构造函数同时还有对应的析构函数
        $this->userName = $name;
        $this->passWord = $pass;
    }

}