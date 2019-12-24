<?php
namespace App\Controller;
class Home extends \Core\ControllerBase{
    public function index1(){
        dump([1,2,3,4,5]);
        $this->show("Testview/Testview1");
        dump(1);
    }
    public function index2($data=[]){
        $this->show("Testview/Testview2",$data);
  }
    public function index3(){
        $data=\App\Model\Testmodel1::dbmethod3();
        $this->show("Testview/Testview2",$data);
    }
    public function index4(){
        $data=\App\Model\Testmodel1::dbmethod4();
        $this->show("Testview/Testview2",$data);
    }
    public function index5(){
        $data=\App\Model\Testmodel1::dbmethod5();
        $this->show("Testview/Testview2",$data);
    }
    public function index6(){
        $data=\App\Model\Testmodel1::dbmethod6();
        $this->show("Testview/Testview2",$data);
    }
    public function index7(){
        $data=\App\Model\Testmodel1::dbmethod7();
        $this->show("Testview/Testview2",$data);
    }
    public function index8(){
        $data=\App\Model\Testmodel1::dbmethod8();
        $this->show("Testview/Testview2",$data);
    }
    public function index9(){
        $data=\App\Model\Testmodel1::dbmethod9();
        $this->show("Testview/Testview3",$data);
    }
    public function index10(){
        $data=\App\Model\Testmodel1::dbmethod10();
        $this->show("Testview/Testview4",$data);
    }
    public function index11(){
        $data=\App\Model\Testmodel1::dbmethod11();
        $this->show("Testview/Testview5",$data);
    }
}