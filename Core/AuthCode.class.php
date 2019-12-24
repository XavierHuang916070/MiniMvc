<?php
/*
驗證碼類文件
*/
namespace Core;
session_start();
class AuthCode{
    private static $instance;
    private $imgwidth;
    private $imgheight;
    private $authcodelen;
    private $authcodefontsize;
    private $img;
    private $authcode;
    private function __construct($imgwidth,$imgheight,$authcodelen,$authcodefontsize){
        $this->imgwidth=$imgwidth;
        $this->imgheight=$imgheight;
        $this->authcodelen=$authcodelen;
        $this->authcodefontsize=$authcodefontsize;
    }
    public static function getinstance($imgwidth,$imgheight,$authcodelen,$authcodefontsize){
        if(!isset(self::$instance)){
            self::$instance=new self($imgwidth,$imgheight,$authcodelen,$authcodefontsize);
        }
        return self::$instance;
    }
    private function createbck(){
        header("content-type:image/png");
 	    $this->img=imagecreatetruecolor($this->imgwidth,$this->imgheight);
        $bckcolor=imagecolorallocate($this->img,255,255,255);
        imagefill($this->img,0,0,$bckcolor);
    }
    private function createrandom(){
        $data="ABCDEFGHKMNPQRSTUVWXYZ2345678";
        for($i=0;$i<$this->authcodelen;$i++)
        {
 		    $x=($i*($this->imgwidth/$this->authcodelen))+($this->imgwidth/2/$this->authcodelen);
 		    $y=(($this->imgheight)/2)+($this->authcodefontsize/2);
 		    $fontcontent=substr($data,rand(0,strlen($data)-1),1);
 		    $fontcolor=imagecolorallocate($this->img,rand(70,140),rand(70,140),rand(70,140));
            imagettftext($this->img,$this->authcodefontsize,0,$x,$y,$fontcolor,"Font/NovaMono.ttf",$fontcontent);
            $this->authcode.=$fontcontent;
        }
        $_SESSION["authcode"]= $this->authcode;
    }
   private function createintererline(){
        for($i=0;$i<10;$i++)
        {
            $linecolor=imagecolorallocate($this->img,rand(110,220),rand(110,220),rand(110,220));
            imageline($this->img,rand(1,$this->imgwidth),rand(1,$this->imgheight),rand(1,$this->imgwidth), rand(1,$this->imgheight),$linecolor);	
        }
   }
    public function createall(){
        $this->createbck();
        $this->createrandom();
        $this->createintererline();
        imagepng($this->img);
 	    imagedestroy($this->img);
    }
}
