<?php
namespace Lib;
/**
 * 系统加载前各项处理
 * @author chengjun
 *
 */
class AdminBootStrap {	
	
	
	
	public static function run(){
		try{
			self::configCheck();
		}catch (\Exception $e){
			echo $e->getMessage();
			exit;
		}
		self::startSession();
		
	}
	
	/**
	 * 配置检查
	 */
	public static function configCheck(){
		if(MAX_LOGIN_WRONG_TIME<-1){
			throw new \Exception('ERROR:MAX_LOGIN_WRONG_TIME is a Illegal argument!');
		}
		return;
	}
	
	/**
	 * 启动SESSION
	 */
	public static function startSession(){
		if(!session_id()){
			session_name("food");
			session_start();
		}
	}
	
	/**
	 * 检查用户距离上次操作的时间间隔
	 * 如果超过设定值则重新登陆
	 * 如果没有超过则重置时间
	 */
	public static function checkActivity(){
		if(!empty($_SESSION[SESSION_PREFIX.'activityTime'])){
			if(time() - $_SESSION[SESSION_PREFIX.'activityTime'] > (MAX_WAIT_TIME*60)){
				return false;
			}else{
				$_SESSION[SESSION_PREFIX.'activityTime'] = time();
			}
		}
		return true;
	}
}