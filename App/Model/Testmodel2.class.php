<?php
namespace App\Model;
class  Testmodel2 extends \Medoo\Medoo{
    public function __construct(){
        parent::__construct
        ([
            "database_type"=>DBMS,
            "database_name"=>DBNAME,
            "server" =>HOST,
            "username"=> USER,
            "password"=>PASSWORD
        ]);
    }
}