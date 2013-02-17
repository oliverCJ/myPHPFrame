<?php
namespace Admin\Model;
defined ( 'ADMIN' ) or die ( 'Access Denied' );
/**
 * 后台首页模块数据层
 * FileName:IndexModel.php
 * @Author:oliver <cgjp123@163.com>
 * @Since:2012-2-21
 */
 class IndexModel extends \Admin\Model\Base {
 	
 	public $userInfo;
 	
 	public function __construct(){
 		
 	}
 	
 	
 	public function insertData($data=array()){
 		
 	}
 	
 	/**
 	 * 返回登陆者信息
 	 * @return mixed
 	 */
 	public function getLoginInfo(){
 		if(!empty($this->userInfo)){
 			return $this->userInfo;
 		}
 		return false;
 	}
 	
 	/**
 	 * 
 	 * 验证登录
 	 * @param string $username
 	 * @param string $password
 	 * @return boolean
 	 */
 	public function verifyLogin($username,$password){
 		if(!empty($username) && !empty($password)){
 			if(!empty($this->userInfo) && $this->userInfo['status']==1 && $this->userInfo['userName'] == $username){
 				return true;
 			}else{
 				$this->getUserInfo($username, $password);
 				if(!empty($this->userInfo) && $this->userInfo['status']==1 && $this->userInfo['userName'] == $username){
 					return true;
 				}
 			}
 		}
 		return false;
 	}
 	
 	/**
 	 * 
 	 */
 	public function lockUser($userName){
 		$db = $this->getDB();
 		if(!empty($userName)){
 			$sqlGet = "SELECT `id`,`status` FROM `". DBPREFIX ."admin_user` WHERE `userName`='{$userName}'";
 			$result = $db->query($sqlGet);
 			if(!empty($result)){
 				$sql = "UPDATE `". DBPREFIX ."admin_user` SET `status`=0 WHERE `userName`='{$userName}'";
 				$db->execute($sql);
 			}
 		}
 		return;
 	}
 	
 	/**
 	 * 锁定IP
 	 * @param unknown $ip
 	 */
 	public function lockIp($Ip){
 		$db = $this->getDB();
 		if(!empty($Ip)){
 			$sqlGet = "SELECT * FROM `". DBPREFIX ."lock_ip` WHERE `ip`='{$Ip}'";
 			$result = $db->query($sqlGet);
 			if(!empty($result)){
 				$sql = "UPDATE `". DBPREFIX ."lock_ip` SET `status`=1,`lastLockTime`='".time()."', `times`=`times`+1, `black`=1 WHERE `ip`='{$Ip}' ";
 				$db->execute($sql);
 			}else{
 				$sql = "INSERT INTO `". DBPREFIX ."lock_ip` (`ip`,`status`,`lastLockTime`,`times`,`black`) VALUES ('{$Ip}',1,'".time()."',1,1)";
 				$db->execute($sql);
 			}
 		}
 		return;
 	}
 	
 	/**
 	 * 解锁IP
 	 * @param unknown $Ip
 	 */
 	public function unlockIp($Ip){
 		$db = $this->getDB();
 		if(!empty($Ip)){
 			$sqlGet = "SELECT * FROM `". DBPREFIX ."lock_ip` WHERE `ip`='{$Ip}'";
 			$result = $db->query($sqlGet);
 			if(!empty($result)){
 				$sql = "UPDATE `". DBPREFIX ."lock_ip` SET `status`=0 WHERE `ip`='{$Ip}' ";
 				$db->execute($sql);
 			}
 		}
 		return;
 	}
 	
 	/**
 	 * IP检查
 	 * @param unknown $Ip
 	 * @return mixed
 	 */
 	public function checkIp($Ip){
 		$db = $this->getDB();
 		if(!empty($Ip)){
 			$sqlGet = "SELECT * FROM `". DBPREFIX ."lock_ip` WHERE `ip`='{$Ip}'";
 			$result = $db->query($sqlGet);
 			if(!empty($result)){
 				if($result['status']==1){
	 				if($result['black']==1){
	 					return false;
	 				}
	 				if($result['white']==1){
	 					return true;
	 				}
	 				return false;
 				}else{
 					return true;
 				}
 			}
 			return true;
 		}
 		return false;
 	}
 	
 	/**
 	 * 获取登陆者信息
 	 * @param unknown $username
 	 * @param unknown $password
 	 * @return boolean
 	 */
 	protected function getUserInfo($username,$password){
 		$db = $this->getDB();
 		if(!empty($username) && !empty($password)){
 			$username = trim($username);
 			$sql = "SELECT `id`,`userName`,`nickName`,`userEmail`,`status` FROM `". DBPREFIX ."admin_user` WHERE `userName`='{$username}' AND `userPass`='{$password}'";
 			$result = $db->query($sql);
 			if(!empty($result)){
 				$this->userInfo = $result;
 				return true;
 			}
 		}
 		return false;
 	}
 }