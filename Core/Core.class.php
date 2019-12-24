<?php
/*
核心類文件
*/
namespace Core;
class Core{
    private static $controller="Home";
    private static $method="index1";
    private static $param=[];
    public static function splmethod($classname){
            $classname=explode("\\",$classname);
            $classname=end($classname);
            $path=
            [
            "Core/".$classname.".class.php",
            "App/Controller/".$classname.".class.php",
            "App/Model/".$classname.".class.php"
            ];
        foreach($path as $value){
            if(file_exists($value)){
                require $value;
                $flag=true;
            }
            else{
                $flag==false;
            }
        }
        if($flag==false){
            throw new MyException("類文件不存在");
        }   
    }
    private static function parseurl(){
            //判斷是否有傳遞url
          if(isset($_GET["url"])){
            $url=$_GET["url"];
            //按照字元"/"來將url切割為陣列
            $url=explode("/",$url);
            //得到控制器名稱
            if(isset($url[0])){
                self::$controller=$url[0];
                unset($url[0]);
            }
            //得到控制器的方法名稱
            if(isset($url[1])){
                self::$method=$url[1];
                unset($url[1]);
            }
            //判斷url是否還有其他的參數若有則將鍵值歸零並存入param屬性中
            if(isset($url)){
                self::$param=array_values($url);
            }
          }
    }
    public function run(){
        self::parseurl();
        $ctrldir="App/Controller/".self::$controller.".class.php";
        //判斷控制器文件是否存在
        if(file_exists($ctrldir)){
            $cns="\App\\"."Controller\\".self::$controller;
            $c=new $cns;
        }
        else{
            throw new MyException("控制器不存在");
        }
        if(method_exists($c,self::$method)){
            $m=self::$method;
            $newparam=[];
            $num=sizeof(self::$param);
            if($num==0){
                $c->$m();
            }
            else if($num==1){
                throw new MyException("參數不合法");
            }
            else{
                if($num%2==0){
                    for($i=1;$i<sizeof(self::$param);$i+=2){
                        if(empty(self::$param[$i])){
                            throw new MyException("參數不合法");
                        }
                     }
                    for($i=0;$i<sizeof(self::$param);$i+=2){
                        if(
                            (ord(self::$param[$i])>=65&&ord(self::$param[$i])<=90)||
                            (ord(self::$param[$i])>=97&&ord(self::$param[$i])<=122)
                        ){
                            $newparam[self::$param[$i]]=self::$param[$i+1];
                        }
                        else{
                            throw new MyException("參數不合法");
                        }
                     }
                }
                else{
                    throw new MyException("參數不合法");
                }
                $c->$m($newparam);
            }
        }
        else{
            throw new MyException("控制器方法不存在");
        }
    }
}