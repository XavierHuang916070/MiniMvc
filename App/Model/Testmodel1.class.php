<?php
namespace App\Model;
class  Testmodel1{
   public static function dbmethod3(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->query("SELECT * FROM student");
        return $data;
   }
   public static function dbmethod4(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->where("WHERE id=:id")->select("student",[":id"=>2]);
        return $data;
    }
    public static function dbmethod5(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->select("student",[""]);
        return $data;
    }
    public static function dbmethod6(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->where("WHERE id>=:id")->select("student",[":id"=>3]);
        return $data;
    }
    public static function dbmethod7(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->where("WHERE id>=:id AND grade>=:grade")
        ->select("student",[":id"=>4,":grade"=>79]);
        return $data;
    }
    public static function dbmethod8(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->findrow("student",5);
        return $data;
    }
    public static function dbmethod9(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->insert("student",
        [
        ":name"=>"Xavier",
        ":grade"=>97
        ]);
        return $data;
    }
    public static function dbmethod10(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->where("WHERE id=:id")
        ->update("student",[":grade"=>59],[":id"=>4]);
        return $data;
    }       
    public static function dbmethod11(){
        $db=\Core\PdoDb::getinstance();
        $data=$db->where("WHERE id=:id")->delete("student",[":id"=>3]);
        return $data;
    }
}