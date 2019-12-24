<?php
namespace App\Controller;
class Testcontroller3 extends \Core\ControllerBase{
    public function index1(){
        $cookie=\Core\Cookie::getinstance();
        $cookie->set("a",1);
        //$cookie->set("b",2,["httponly"=>true]);
        //$cookie->set("c",3,["expire"=>time()+60]);
        //$cookie->set("d",[1,2,3,4,5,6,7,8,9,10]);
        //$cookie->set("e",["a1"=>"Hello","a2"=>"Hello World"],["httponly"=>true]);
         //dump($cookie->get("a"));
         //$cookie->set("b",100,["expire"=>time()+120]);
        //$cookie->delete("b");
        //$cookie->deleteall();
    }
}




