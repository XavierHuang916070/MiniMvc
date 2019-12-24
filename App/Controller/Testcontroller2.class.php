<?php
namespace App\Controller;
class Testcontroller2 extends \Core\ControllerBase{
    public function index1(){
        $db=new \App\Model\Testmodel2();
        $data=$db->select("student","*");
       dump($data);
        $data=$db->select("student",["name"]);
       dump($data);
       $data=$db->select("student",["id","name","grade"]);
       dump($data);
       $data=$db->select("student",["id","name","grade"],["id"=>5]);
       dump($data);
    }
    public function index2(){
        $db=new \App\Model\Testmodel2();
        $exc=$db->insert("student",["name"=>"John","grade"=>85]);
        dump($exc);
    }
    public function index3(){
        $db=new \App\Model\Testmodel2();
        $data=$db->select("student","*");
        $this->show("Testview/Testview2",$data);
    }
    public function index4(){
        $this->view("TestTwig1","a1",[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,
        16,17,18,19,20]);
    }
}
