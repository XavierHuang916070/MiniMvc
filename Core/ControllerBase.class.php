<?php
/*
控制器基礎類文件
可用來加載子控制器所需要的視圖文件
*/
namespace Core;
class ControllerBase{
    public function show($viewpage,$data=[]){
        $viewpagedir="App/View/$viewpage.php";
            if(file_exists($viewpagedir)){
                include($viewpagedir);
            }
            else{
                throw new MyException("視圖不存在");
            }
    }
    public function view($viewpage,$name,$value=[]){
        $viewpagedir="App/View/$viewpage.php";
            if(file_exists($viewpagedir)){
                $loader = new \Twig\Loader\FilesystemLoader('App/View');
                $twig = new \Twig\Environment($loader, [
                'cache' => 'Log/Cache',
                'debug' => true
                ]);
                $twig->display('TestTwig1.php',[$name=>$value]);
            }
            else{
                throw new MyException("視圖不存在");
            }
    }
}


