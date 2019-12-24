<?php
/*
單一入口文件
*/
//引入核心類文件
require("Core/Core.class.php");
//引入配置文件
require("Config/Config.php");
require("vendor/autoload.php");
//自動載入方法
spl_autoload_register(["\Core\Core","splmethod"]);
try{
  $whoops = new \Whoops\Run;
  $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
  $whoops->register();
  \Core\Core::run();
}
catch(\Core\MyException $e){
    $e->showerror($e->getMessage());
}
