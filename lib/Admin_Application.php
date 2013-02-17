<?php
namespace Lib;
use Lib\helper\RequestUnit;
defined ( 'ADMIN' ) or die ( 'Access Denied' );
/**
 * 后台基类，所有后台应用均继承此类
 */
class Admin_Application {
	
	/**
	 * 保存url参数
	 */
	protected static $requestParams;
	
	public function __construct(){
		if(!defined('ISROBOT')){
			define('ISROBOT', \Lib\Helper\CommonFunction::getrobot());//判断来访工具
		}
		if(defined('NOROBOT') && ISROBOT) {
			exit(header("HTTP/1.1 403 Forbidden"));
		}
		if(defined(DEBUG) && DEBUG){
			ini_set('display_errors',1);
			error_reporting( E_ALL | E_STRICT);
		}else{
			ini_set('display_errors',0);
		}
		
		header("Cache-control: private");
		header("content-type:text/html; charset=" . DEFAULT_CHARSET . "");
		
		if(PHP_VERSION < '4.1.0')//通用性
		{
			$_GET = &$HTTP_GET_VARS;
			$_POST = &$HTTP_POST_VARS;
			$_COOKIE = &$HTTP_COOKIE_VARS;
			$_SERVER = &$HTTP_SERVER_VARS;
			$_ENV = &$HTTP_ENV_VARS;
			$_FILES = &$HTTP_POST_FILES;
		}
		isset($_REQUEST['GLOBALS']) && exit('Access Error');
	}
	
	/**
	 * 
	 * 启动应用
	 */
	public function run(){
		self::$requestParams = RequestUnit::getParams();
		$moduleAction = 'admin\Module\\'.self::$requestParams->module.'\\'.ucfirst(self::$requestParams->action);
		if(!class_exists($moduleAction, true)){
			$msg = 'admin/module/action not found !'.$moduleAction."\n".'Parsed request parameters:'."\n".var_export(self::$requestParams,true);
			error_log($msg);
            header ('HTTP/1.1 404 Not found');
            require ROOT_PATH.'errors/404.php';
			die();
		}
		
		\Lib\AdminBootStrap::run();
		
		//登陆检查.未登录则强制切换到登录页面
		$noVerifyActionArray = array('Verifycode');
		if(empty($_SESSION[SESSION_PREFIX.'adminUserName']) && !in_array(ucfirst(self::$requestParams->action),$noVerifyActionArray)){
			$moduleAction = 'admin\Module\Index\Login';
		}
		
		//活跃时间检查
		if(!empty($_SESSION[SESSION_PREFIX.'adminUserName'])){
			$activity = \Lib\AdminBootStrap::checkActivity();
			if(!$activity){
				$this->unsetSession();
				$this->alert_forward('你离开的太久了，请重新登陆', ADMIN_URL,1);
			}
		}
		
		 $module = new $moduleAction();
		 $module->run();
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $msg
	 * @param unknown_type $url
	 * @param unknown_type $exit
	 * @param unknown_type $is_lang
	 * @param unknown_type $is_extra
	 * @param unknown_type $script
	 */
	public function alert_forward($msg, $url, $exit = 0, $is_lang = 0, $is_extra = '', $script = '') {
		$tpl = \Lib\Template::getAdminSmarty();
		$tpl->assign ( 'msg', $msg );
		$tpl->assign ( 'url', $url );
		$tpl->assign ( 'is_lang', $is_lang );
		$tpl->assign ( 'is_extra', $is_extra );
		$tpl->assign ( 'script', $script );
		$tpl->display ( 'alert_forward.htm' );
		if ($exit == 1)
			exit ();
		return;
	}
	
	/**
	 * 注销SESSION
	 */
	protected function unsetSession(){
		unset($_SESSION[SESSION_PREFIX.'adminUserName']);
		unset($_SESSION[SESSION_PREFIX.'adminNickName']);
		unset($_SESSION[SESSION_PREFIX.'adminMemberId']);
		unset($_SESSION[SESSION_PREFIX.'adminUserEmail']);
		unset($_SESSION[SESSION_PREFIX.'activityTime']);
		unset($_SESSION[SESSION_PREFIX.'startTime']);
		session_destroy();
		return;
	}
	
	public static function getMicroTime($decimal=6)
    {
        return number_format(microtime(true),(int)$decimal,'.','');
    } 
}