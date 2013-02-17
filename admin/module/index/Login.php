<?php
namespace Admin\Module\Index;
defined ( 'ADMIN' ) or die ( 'Access Denied' );
/**
 * 登录验证
 * FileName:Login.php
 * @Author:oliver <cgjp123@163.com>
 * @Since:2012-3-20
 */
use Lib\Admin_Application;
use \Lib\Helper\RequestUnit as RequestUnit;
class Login extends Admin_Application {
 	
 	public function run(){
 		$tpl = \Lib\Template::getAdminSmarty();
 		$menuType = RequestUnit::getParams('menuType');
 		$ip = \Lib\Helper\CommonFunction::get_client_ip();
 		switch ($menuType){
 			case 'login':
 				$username = RequestUnit::getParams('username');
 				$password = RequestUnit::getParams('password');
 				$loginM = new \Admin\Model\IndexModel();
 				
 				if(MAX_LOGIN_WRONG_TIME==0){
 					$msg = '系统维护中，请稍后尝试登陆！';
 					$tpl->assign('msg',$msg);
 					$tpl->display('login.htm');
 					die();
 				}
 				
 				if(!($loginM->checkIp($ip))){
 					$_SESSION[SESSION_PREFIX.'isVerify'] = true;
 					$msg = 'IP已被锁定，请稍后再试或联系管理员解除锁定！';
 					$tpl->assign('msg',$msg);
 					$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
 					$tpl->display('login.htm');
 					die();
 				}
 				
 				if(empty($username) || empty($password)){
 					$_SESSION[SESSION_PREFIX.'isVerify'] = true;
 					$msg = '用户名或密码不能为空.';
 					$tpl->assign('msg',$msg);
 					$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
 					$tpl->display('login.htm');
 					die();
 				}
 				if(!empty($username)){
 					if(preg_match('#[\s\~\!\@\#\$\%\^\&\*\(\)\<\>\+\,\.\?\\\/]+#', $username,$mat)){
 						$balanceWrongTime = $this->subLoginWrongTime($username,$ip);
 						$_SESSION[SESSION_PREFIX.'isVerify'] = true;
 						$msg = '非法用户名.';
 						if(!$balanceWrongTime){
 							$msg = 'IP已被锁定，请稍后再试或联系管理员解除锁定！';
 						}elseif($balanceWrongTime!=-1){
 							$tpl->assign('balanceWrongTime',$balanceWrongTime);
 						}
 						$tpl->assign('msg',$msg);
 						$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
 						$tpl->display('login.htm');
 						die();
 					}
 				}
 				if(!empty($_SESSION[SESSION_PREFIX.'isVerify']) && $_SESSION[SESSION_PREFIX.'isVerify']){
 					$verifyCode = RequestUnit::getParams('verifyCode');
 					if(!empty($verifyCode)){
 						$verifyCode = strtoupper(\Lib\Helper\CommonFunction::daddslashes($verifyCode));
	 					if($verifyCode!==strtoupper($_SESSION[SESSION_PREFIX.'verifyCode'])){
	 						$balanceWrongTime = $this->subLoginWrongTime($username,$ip);
	 						$_SESSION[SESSION_PREFIX.'isVerify'] = true;
	 						$msg = '验证码错误.';
	 						if(!$balanceWrongTime){
	 							$msg = 'IP已被锁定，请稍后再试或联系管理员解除锁定！';
	 						}elseif($balanceWrongTime!=-1){
	 							$tpl->assign('balanceWrongTime',$balanceWrongTime);
	 						}
	 						$tpl->assign('msg',$msg);
		 					$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
		 					$tpl->display('login.htm');
		 					die();
	 					}
 					}else{
 						$balanceWrongTime = $this->subLoginWrongTime($username,$ip);
 						$_SESSION[SESSION_PREFIX.'isVerify'] = true;
 						$msg = '验证码错误.';
 						if(!$balanceWrongTime){
 							$msg = 'IP已被锁定，请稍后再试或联系管理员解除锁定！';
 						}elseif($balanceWrongTime!=-1){
 							$tpl->assign('balanceWrongTime',$balanceWrongTime);
 						}
 						$tpl->assign('msg',$msg);
	 					$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
	 					$tpl->display('login.htm');
	 					die();
 					}
 				}
 				$md5Password = md5(MD5PASS.$password);
 				$verifyLogin = $loginM->verifyLogin($username,$md5Password);
 				$loginInfo = $loginM->getLoginInfo();
 				if(!$verifyLogin){//登录验证失败
 					if(!empty($loginInfo)){
 						$msg = '账户未激活或已经锁定,请联系管理员.';
 					}else{
 						$balanceWrongTime = $this->subLoginWrongTime($username);
 						$msg = '用户名或密码错误.';
 						if(!$balanceWrongTime){
 							$msg = '输入错误已超过'.MAX_LOGIN_WRONG_TIME.'次，帐号已被锁定，请稍后再试或联系管理员解除锁定！';
 						}elseif($balanceWrongTime!=-1){
 							$tpl->assign('balanceWrongTime',$balanceWrongTime);
 						}
 					}
 					$_SESSION[SESSION_PREFIX.'isVerify'] = true;
 					$tpl->assign('msg',$msg);
	 				$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
	 				$tpl->display('login.htm');
	 				die();
 				}else{//登录成功
 					if(!empty($loginInfo)){
 						$_SESSION[SESSION_PREFIX.'isVerify'] = false;
 						$_SESSION[SESSION_PREFIX.'adminUserName'] = $loginInfo['userName'];
 						$_SESSION[SESSION_PREFIX.'adminNickName'] = $loginInfo['nickName'];
 						$_SESSION[SESSION_PREFIX.'adminMemberId'] = $loginInfo['id'];
 						if(!empty($loginInfo['userEmail'])){
 							$_SESSION[SESSION_PREFIX.'adminUserEmail'] = $loginInfo['userEmail'];
 						}
 						$_SESSION[SESSION_PREFIX.'activityTime'] = time();
 						$_SESSION[SESSION_PREFIX.'startTime'] = time();
 						unset($_SESSION[SESSION_PREFIX.'wrongTime'.$userName]);
 						header("location:".ADMIN_URL);
 						exit;
 					}
 				}
 				break;
 			case 'loginout':
 				if(!empty($_SESSION[SESSION_PREFIX.'adminUserName'])){
	 				parent::unsetSession();
 				}
 				header("location:".ADMIN_URL);
 				exit;
 				break;
 			default:
 				$loginM = new \Admin\Model\IndexModel();
 				if(!($loginM->checkIp($ip))){
 					$_SESSION[SESSION_PREFIX.'isVerify'] = true;
 					$msg = 'IP已被锁定，请稍后再试或联系管理员解除锁定！';
 					$tpl->assign('msg',$msg);
 					$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
 					$tpl->display('login.htm');
 					die();
 				}
 				if($_SESSION[SESSION_PREFIX.'isVerify']){
 					$tpl->assign('isVerify',$_SESSION[SESSION_PREFIX.'isVerify']);
 				}
 				$tpl->display('login.htm');
 				break;
 		} 
 	}
 	
 	/**
 	 * 输入错误次数统计，则返回剩余次数,当剩余次数为0,则说明达到上限
 	 * -1表示不限
 	 * @return boolean|number
 	 */
 	public function subLoginWrongTime($userName,$ip=''){
 		if(MAX_LOGIN_WRONG_TIME==-1){
 			return -1;
 		}
 		$balanceTime = 1;
 		if(!empty($userName) && !empty($ip)){
 			//todo session记录不安全，实际应采用数据库记录，当用session记录错误次数，如果用户输错一次则关闭浏览器重开，这样一直都记录不下来错误
	 		if(empty($_SESSION[SESSION_PREFIX.'wrongTime'.$userName])){
	 			$_SESSION[SESSION_PREFIX.'wrongTime'.$userName] = 1;
	 		}else{
	 			$_SESSION[SESSION_PREFIX.'wrongTime'.$userName] += 1;
	 		}
	 		
	 		$balanceTime = (MAX_LOGIN_WRONG_TIME - $_SESSION[SESSION_PREFIX.'wrongTime'.$userName]);
	 		$balanceTime = $balanceTime < 0 ? 0 : $balanceTime;
	 		
	 		if( !$balanceTime ){
	 			$loginM = new \Admin\Model\IndexModel();
	 			if(!empty($ip)){
	 				//锁定IP
	 				$loginM->lockIp($ip);
	 			}else{
	 				//锁定用户和IP
	 				$loginM->lockUser($userName);
	 			}
	 			unset($_SESSION[SESSION_PREFIX.'wrongTime'.$userName]);
	 		}
 		}
 		return $balanceTime;
 	}
 }