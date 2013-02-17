<?php
/**
 * Enter description here ...
 * FileName:adminconfig.php
 * @Author:oliver <cgjp123@163.com>
 * @Since:2012-3-19
 */
defined ( 'ADMIN' ) or die ( 'Access Denied' );
if (!defined('ROOT_PATH'))//物理根目录
{
	define('ROOT_PATH', dirname(dirname(__FILE__)).'/');
}
if(!defined('ADMIN_PATH')){
	define('ADMIN_PATH',ROOT_PATH.'admin/');
}

if(!defined('LIB_PATH')) define('LIB_PATH', ROOT_PATH.'lib/');
if(!defined('MODEL_PATH')) define('MODEL_PATH', ADMIN_PATH.'model/');
if(!defined('MODULE_PATH')) define('MODULE_PATH', ADMIN_PATH.'module/');
if(!defined('UPLOAD_PATH')) define('UPLOAD_PATH', ROOT_PATH.'upload/');
if(!defined('STATIC_PATH')) define('STATIC_PATH',ADMIN_PATH.'static/');//静态文件地址

if (!defined('ROOT_URL'))
{
	define('ROOT_URL',"http://".$_SERVER["HTTP_HOST"]."/");

}

if (!defined('ADMIN_URL'))
{
	define('ADMIN_URL',"http://".$_SERVER["HTTP_HOST"]."/admin/");

}

if(!defined('PHPSF')) define('PHPSF','.php');
if(!defined('DEFAULT_CHARSET')) define('DEFAULT_CHARSET','UTF-8');
if(!defined('MD5PASS')) define('MD5PASS', 'FOOD_');//一旦设定好请不要修改
if(!defined('SESSION_PREFIX')) define('SESSION_PREFIX',md5('FOOD_'));
if(!defined('MAX_LOGIN_WRONG_TIME')) define('MAX_LOGIN_WRONG_TIME',5);//最大登陆错误次数,-1为不限制，0为禁止登陆（超级管理员除外）
if(!defined('MAX_WAIT_TIME')) define('MAX_WAIT_TIME',120);//用户后台活跃最大等待时间，如果超过设定时间必须重新登陆,单位为分钟

//数据缓存根目录
if (!defined('DATA_CACHE_ROOT_PATH')) define('DATA_CACHE_ROOT_PATH', ROOT_PATH . 'data'.DIRECTORY_SEPARATOR);

//数据连接类型
if(!defined('SQL_TYPE')) define('SQL_TYPE','mysql');
if(!defined('HOST')) define('HOST','127.0.0.1');
if(defined('PORT')) define('PORT','3306');
if(!defined('USERNAME')) define('USERNAME','root');
if(!defined('PASSWORD')) define('PASSWORD','root');
if(!defined('TABLENAME')) define('TABLENAME','food');
if(!defined('DBPREFIX')) define('DBPREFIX','pmin_');

define('DEBUG',true);