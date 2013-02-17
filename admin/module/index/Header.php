<?php
namespace Admin\Module\Index;
defined ( 'ADMIN' ) or die ( 'Access Denied' );
/**
 *
 * 后台顶部
 * @author oliver <cgjp123@163.com>
 *
*/
use Lib\Admin_Application;
class Header extends Admin_Application{

	public function run(){
		$tpl = \Lib\Template::getAdminSmarty();
		if(!empty($_SESSION[SESSION_PREFIX.'adminNickName'])){
			$userName = $_SESSION[SESSION_PREFIX.'adminNickName'];
		}else{
			$userName = $_SESSION[SESSION_PREFIX.'adminUserName'];
		}
		
		
		$funnyWordsKey_1 = array_rand(\Config\AdminOtherConfig::$funnyWords,1);
		$funnyWordsKey_2 = array_rand(\Config\AdminOtherConfig::$funnyWords[$funnyWordsKey_1],1);
		$funnyWords = \Config\AdminOtherConfig::$funnyWords[$funnyWordsKey_1][$funnyWordsKey_2];
		
		
		$tpl->assign('funnyWords',$funnyWords);
		$tpl->assign('loginName',$userName);
		$tpl->display('header.htm');
	}
}