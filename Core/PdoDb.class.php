<?php
/*
Pdo封裝類文件
使用單例模式(Singleton)來進行封裝
在使用一個類的時候只能有一個實例(物件)
類的實例(物件)只能在類的內部進行實例化
*/
namespace Core;
class PdoDb{
    private static $instance;
    private static $link;
    private $wherestr;
    //不允許在類外進行實例化
    private function __construct(){
    }
    //在類內進行實例化並回傳實例
    public static function getinstance(){
        //判斷實例是否存在 若存在則直接返回空實例 若不存在則進行實例化並返回實例
        if(!isset(self::$instance)){
            self::$instance=new self();
        }
        self::connect(DBMS,HOST,DBNAME,USER,PASSWORD);
        return self::$instance;
    }
    //連接資料庫方法
    private function connect($dbms,$host,$dbname,$user,$password){
        try{
            self::$link=new \PDO
            (
                "$dbms:host=$host;dbname=$dbname",
                    $user,
                    $password
            );
            self::$link->query('SET NAMES "utf8"');  
        }
        catch(\PDOException $e){
            \Core\MyException::showerror($e->getMessage());
        }
    }
    //直接查詢資料庫方法 
    //範例: SELECT * FROM student WHERE id=:id
    //後面用冒號佔位符來避免sql injection 
    public function query($sql,$data=[]){
        try{
            $statement=self::$link->prepare($sql);
            if(!empty($data)){
                $statement->execute($data);  
            }
            else{
               $statement->execute();
            }
            //判斷執行是否成功
            if($statement->rowCount()>0){
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
            else{
                //得到錯誤訊息
                $err=$statement->errorInfo();
                throw new \PDOException($err[2]); 
            }
        }
        catch(\PDOException $e){
            \Core\MyException::showerror($e->getMessage());
        }     
    }
    //where條件方法
    public function where($wherestr=""){
        $this->wherestr=$wherestr;
        return $this;
    }
     //內部已經處理好的方法-條件查詢方法
     public function select($table,$data=[]){
        $sql="SELECT * FROM $table ";
        //判斷是有where條件
            if(isset($this->wherestr)){
                $sql.=$this->wherestr;
            }
            //執行sql語句
            try{
                $statement=self::$link->prepare($sql);
                if(empty($data))
                $statement>execute();
                else{
                    $statement->execute($data);
                }
                if($statement->rowCount()>0){
                        return $statement->fetchAll(\PDO::FETCH_ASSOC);
                }
                else{
                    $err=$statement->errorInfo();
                    throw new \PDOException($err[2]);
                }
            }
            catch(\PDOException $e){
                \Core\MyException::showerror($e->getMessage());
            }
        }
    //內部已經處理好的方法-查詢單條紀錄方法(按照id條件來查詢單條紀錄)
    public function findrow($table,$id){
        $sql="SELECT * FROM $table WHERE id=:id";
        try{
            $statement=self::$link->prepare($sql);
            $statement->execute([":id"=>$id]);
            if($statement->rowCount()>0){
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
            else{
                $err=$statement->errorInfo();
                throw new \PDOException($err[2]);
            }
        }
        catch(\PDOException $e){
            \Core\MyException::showerror($e->getMessage());
        }
    }
    //內部已經處理好的方法-添加紀錄方法
    public function insert($table,$data=[]){
        foreach($data as $k => $v){
            $fields.=ltrim($k,":").",";
            $values.=$k.",";
        }
        $fields=rtrim($fields,",");
        $values=rtrim($values,",");
        $sql="INSERT INTO $table($fields) VALUE($values)";
        try{
             //開啟事務 使得發生錯誤後可回滾
            self::$link->beginTransaction();
            $statement=self::$link->prepare($sql);
            $statement->execute($data);
            if($statement->rowCount()>0){
                self::$link->commit();
                return $statement->rowCount();
            }
            else{
                self::$link->rollback();//回滾事務
                $err=$statement->errorInfo();
                throw new \PDOException($err[2]);
            }
        }
        catch(\PDOException $e){
            \Core\MyException::showerror($e->getMessage());
        }
    }
    //內部已經處理好的方法-更新紀錄方法
    public function update($table,$data=[],$where=[]){
        foreach($data as $k => $v){
            $setstr.=ltrim($k,":")."=$k,";
        }
        $setstr=rtrim($setstr,",");
        $sql="UPDATE $table SET $setstr $this->wherestr";
        try{
            self::$link->beginTransaction();
            $statement=self::$link->prepare($sql);
            $statement->execute(array_merge($data,$where));
            if($statement->rowCount()>0){
                self::$link->commit();
                return $statement->rowCount();
            }
            else{
                self::$link->rollback();
                $err=$statement->errorInfo();
                throw new \PDOException($err[2]);
            }
        }
        catch(\PDOException $e){
            \Core\MyException::showerror($e->getMessage());
        }
    }
    //內部已經處理好的方法-刪除紀錄方法
     public function delete($table,$data=[]){
        $sql="DELETE FROM $table $this->wherestr";
        try{
            self::$link->beginTransaction();
            $statement=self::$link->prepare($sql);
            $statement->execute($data);
            if($statement->rowCount()>0){
                self::$link->commit();
                return $statement->rowCount();
            }
            else{
                self::$link->rollback();
                $err=$statement->errorInfo();
                throw new \PDOException($err[2]);
            }
        }
        catch(\PDOException $e){
            \Core\MyException::showerror($e->getMessage());
        }
    }
    //解構方法
    public function __destruct(){  
        self::$link=null;
    }
}
