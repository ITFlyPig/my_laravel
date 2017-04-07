<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
use App\Model\UserTest;

class TestController extends Controller
{
    //
    function test(){
        $filePath = '/Users/wangyuelin/Downloads/test';
        $fileName = 'test.txt';
        $fileExits =  file_exists($filePath);
        if(!$filePath){
            $result  = mkdir($filePath,0777,true);
            if(!$result){
                echo '目录创建失败!';
            }
        }
        $file = fopen('/Users/wangyuelin/Downloads/test/test.txt','a+');
        if($file != false){
            fwrite($file, '这是测试数据\n');
            $user = new UserTest('wangyuein', '1234kij');
            $userStr = serialize($user);//serialize:返回字符串，此字符串包含了表示 value 的字节流，可以存储于任何地方。
            fwrite($file, $userStr);
            fclose($file);
        }

        $path = '/Users/wangyuelin/Downloads/test/test.txt';
        $this->readFile($path);
    }

    function login(Request $request){
        //$myname = $request -> get('name');//获取url中的参数
        $name = 'wangyuelin_hahah';
        //查找用户是否存在
        $search = DB::select("select * from users where name = ?", [$name]);//数据库的查询总是返回数组,然后可以foreach遍历数组的每个值
        if(count($search) < 1){
            //向数据库中插入数据
            DB::insert('insert into users( name, password) values (?, ?)',[$name, '1234']);
        }
        //$testStr = '';
        //foreach ($search as $temp){
        //    $testStr = $testStr.$temp;
        //}
       // echo '查找结果:' .serialize($search).'/r';

        //查找
        $result = DB::select('select * from users ');
        $name = $request -> get('name');
        $password = $request -> get('password');
        $json_obj = json_encode($result);
        $json_str = '{"users":"'.$json_obj.'"}';
        return response($json_str, 200) -> sendHeaders('Content-Type', 'application/json');

        //return response() -> headers('Content-Type', 'application/json')
         //   -> body($json_str);//返回Json格式

    }

    function readFile($path){
        if(is_null($path) || $path == ''){
            echo '要读取的路径为空';
            return;
        }
        $handle = fopen($path, 'a+');
        if($handle != false){
          $str =  fread($handle, filesize($path));
            fclose($handle);
            echo '读取到的字符串:'.$str;
        }
    }


}
