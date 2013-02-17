<?php
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());//函数取得 PHP 环境配置的magic_quotes_gpc 变量值

if (!defined('ROOT_PATH'))//物理根目录
{
	define('ROOT_PATH', dirname(__DIR__).DIRECTORY_SEPARATOR);
}

if(!defined('LIB_PATH')) define('LIB_PATH', ROOT_PATH.'lib/');
if(!defined('MODEL_PATH')) define('MODEL_PATH', ROOT_PATH.'model/');
if(!defined('UPLOAD_PATH')) define('UPLOAD_PATH', ROOT_PATH.'upload/');

if(isset($_SERVER["HTTPS"]))  $http="https"; else  $http="http";
if (!defined('HTTP')) define('HTTP', $http);
if (!defined('ROOT_URL'))
{
	define('ROOT_URL',"http://".$_SERVER["HTTP_HOST"]."/");

}

if(!defined('PHPSF')) define('PHPSF','.php');

//数据缓存根目录
if (!defined('DATA_CACHE_ROOT_PATH')) define('DATA_CACHE_ROOT_PATH', ROOT_PATH . 'data'.DIRECTORY_SEPARATOR);

//数据连接类型
if(!defined('SQL_TYPE')) define('SQL_TYPE','mysql');
if(!defined('HOST')) define('HOST','127.0.0.1');
if(defined('PORT')) define('PORT','3306');
if(!defined('USERNAME')) define('USERNAME','root');
if(!defined('PASSWORD')) define('PASSWORD','');
if(!defined('TABLENAME')) define('TABLENAME','food');
if(!defined('DBPREFIX')) define('DBPREFIX','pmin_');
