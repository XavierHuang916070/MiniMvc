<?php
/*
自訂錯誤處理類文件
*/
namespace Core;
class MyException extends \Exception{
    public function showerror($msg=""){
        $errdir="App/View/Error/Error.php";
        if(file_exists($errdir)){
            include $errdir; 
        }
    }
}
