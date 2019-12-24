<?php
/*
Cookie類文件
*/
namespace Core;
class Cookie{
    private static $instance;
    private $expire=0;
    private $path="";
    private $domain="";
    private $secure=false;
    private $httponly=false;
    private function __construct(){
    }
    public static function getinstance(){
        if(!isset(self::$instance)){
            self::$instance=new self();
        }
        return self::$instance;
    }
    private function setoptions($options=[]){
        if(isset($options["expire"])){
            $this->expire=(int)$options["expire"];
        }
        if(isset($options["path"])){
            $this->path=$options["path"];
        }
        if(isset($options["domain"])){
            $this->domain=$options["domain"];
        }
        if(isset($options["secure"])){
            $this->secure=(bool)$options["secure"];
        }
        if(isset($options["httponly"])){
            $this->httponly=(bool)$options["httponly"];
        }
    }
    //設置Cookie
    public function set($name,$value,$options=[]){
        if(is_array($options)&&sizeof($options)>0){
            $this->setoptions($options);
        }
        if(is_array($value)||is_object($value)){
            $value=json_encode($value,JSON_FORCE_OBJECT);
        }
        setcookie($name,$value,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
        $this->expire=0;
        $this->path="";
        $this->domain="";
        $this->secure=false;
        $this->httponly=false;
    }
    //取得Cookie的值
    public function get($name){
        if(isset($_COOKIE[$name])){
            return substr($_COOKIE[$name],0,1)=="{"
                ?json_decode($_COOKIE[$name])
                :$_COOKIE[$name];
        }
        else{
            return false;
        }
    }
    //刪除Cookue的值
    public function delete($name){
        if(isset($_COOKIE[$name])){
            setcookie($name,"",time()-1);
            unset($_COOKIE[$name]);
        }
    }
    //刪除Cookue的所有值
    public function deleteall(){
       if(!empty($_COOKIE)){
           foreach($_COOKIE as $key => $value){
            setcookie($key,"",time()-1);
            unset($_COOKIE[$key]);
           }
       }
    }
}



