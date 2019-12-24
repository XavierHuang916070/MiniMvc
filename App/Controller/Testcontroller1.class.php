<?php
namespace App\Controller;

class Testcontroller1 extends \Core\ControllerBase{
    public function index1(){
        $this->show("Testview/Testview6");
    }
    public function index2(){
        $codeobj=\Core\AuthCode::getinstance(200,100,4,14);
        $codeobj->createall();
    }
}