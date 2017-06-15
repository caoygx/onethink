<?php
if(file_exists("pro.txt")){
    define("CONF_ENV","pro");
}elseif(file_exists("test.txt")){
    define("CONF_ENV","test");
}else{
    define("CONF_ENV","dev");
}
define('APP_DEBUG',true);
define('BIND_MODULE','Old');
define('ROOT',__DIR__);
//var_dump(APP_DEBUG);
define('APP_PATH',ROOT.'/Application/');
define('RUNTIME_PATH',ROOT.'/Runtime/');


if(!is_file(APP_PATH . 'User/Conf/config.php')){
	header('Location: ./install.php');
	exit;
}


require '../ThinkPHP/ThinkPHP.php';