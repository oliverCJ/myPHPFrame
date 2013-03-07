<?php
namespace Lib;
use Lib\helper\RequestUnit;
/**
 * 基类，所有应用均继承此类
 */
class Application {
	
	/**
	 * 保存url参数
	 */
	protected static $requestParams;
	
	public function __construct(){
		if(DEBUG){
			ini_set('display_errors' ,1);
			error_reporting( E_ALL | E_STRICT);
		}else{
			ini_set('display_errors' ,0);
			error_reporting(0);
		}
	}
	
	/**
	 * 
	 * 启动应用
	 */
	public function run(){
		self::$requestParams = RequestUnit::getParams();
		$moduleAction = 'Module\\'.self::$requestParams->module.'\\'.ucfirst(self::$requestParams->action);
		if(!class_exists($moduleAction, true)){
			$msg = 'module/action not found !'.$moduleAction."\n".'Parsed request parameters:'."\n".var_export(self::$requestParams,true);
			error_log($msg);
            header ('HTTP/1.1 404 Not found');
            require ROOT_PATH.'errors/404.php';
			die();
		}
		 $module = new $moduleAction();
		 $module->run();
	}
	
	public static function getMicroTime($decimal=6)
    {
        return number_format(microtime(true),(int)$decimal,'.','');
    } 
}