<?php
namespace Lib;
use Lib\smarty\Smarty;
/**
 * FileName:Template.php
 * Enter description here ...
 * Author:@{user}
 * Date:@{2012-2-9 ����03:24:17
 */

class Template {
	protected static $smarty ;
	
	public static function getSmarty(){
		if(self::$smarty instanceof \Lib\smarty\Smarty){
			return self::$smarty;
		}
		$user_theme = 'default';
		if(!defined('THEME')) define('THEME',ROOT_PATH.'theme/');
		if (!defined('THEME_ROOT_PATH')) define('THEME_ROOT_PATH', THEME . 'default/');//模板目录
		if (!defined('THEME_COMPILE_ROOT_PATH')) define('THEME_COMPILE_ROOT_PATH', DATA_CACHE_ROOT_PATH.'/cache/'.$user_theme);//模板的缓存目录
		if (!defined('THEME_LEFT_DELIMITER')) define('THEME_LEFT_DELIMITER', '{-');
		if (!defined('THEME_RIGHT_DELIMITER')) define('THEME_RIGHT_DELIMITER', '-}');//模板语法标签

		if(!is_dir(THEME_COMPILE_ROOT_PATH)) mkdir(THEME_COMPILE_ROOT_PATH,0777,true); //判断模板缓存目录是否存在
		$tpl	= new \Lib\smarty\Smarty();
		$tpl->template_dir		= THEME_ROOT_PATH;
		$tpl->compile_dir		= THEME_COMPILE_ROOT_PATH;
		$tpl->left_delimiter	= THEME_LEFT_DELIMITER;
		$tpl->right_delimiter	= THEME_RIGHT_DELIMITER;
		
		$tpl->assign('root_url', ROOT_URL);
		$tpl->assign('themeRoot', THEME);
		
		return self::$smarty = $tpl; 
	}
	
	//后台smarty
	public static function getAdminSmarty(){
		if(self::$smarty instanceof \Lib\smarty\Smarty){
			return self::$smarty;
		}
		$user_theme = 'admindefault';
		if(!defined('ADMINTHEME')) define('ADMINTHEME',ADMIN_PATH.'theme/');
		if (!defined('THEME_ROOT_PATH')) define('THEME_ROOT_PATH', ADMINTHEME . 'default/');//模板目录
		if (!defined('THEME_COMPILE_ROOT_PATH')) define('THEME_COMPILE_ROOT_PATH', DATA_CACHE_ROOT_PATH.'/cache/'.$user_theme);//模板的缓存目录
		if (!defined('THEME_LEFT_DELIMITER')) define('THEME_LEFT_DELIMITER', '{-');
		if (!defined('THEME_RIGHT_DELIMITER')) define('THEME_RIGHT_DELIMITER', '-}');//模板语法标签
		
		if(!is_dir(THEME_COMPILE_ROOT_PATH)) mkdir(THEME_COMPILE_ROOT_PATH,0777,true); //判断模板缓存目录是否存在
		
		$tpl	= new \Lib\smarty\Smarty();
		$tpl->template_dir		= THEME_ROOT_PATH;
		$tpl->compile_dir		= THEME_COMPILE_ROOT_PATH;
		$tpl->left_delimiter	= THEME_LEFT_DELIMITER;
		$tpl->right_delimiter	= THEME_RIGHT_DELIMITER;
		
		$tpl->assign('root_url', ROOT_URL);
		$tpl->assign('admin_url', ADMIN_URL);
		$tpl->assign('themeRoot', ADMINTHEME);
		$tpl->assign('staticUrl', ADMIN_URL.'static/');
		
		return self::$smarty = $tpl; 
	}
}