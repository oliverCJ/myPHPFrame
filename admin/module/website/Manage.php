<?php
namespace Admin\Module\Website;
defined ( 'ADMIN' ) or die ( 'Access Denied' );

/**
 * 网站管理
 * @author chengjun
 *
 */
class Manage extends \Lib\Admin_Application {
	public function run(){
		$tpl = \Lib\Template::getAdminSmarty();
		$mWebsite = new \Admin\Model\WebsiteModel();
		
		$webData = $mWebsite->getData();
		if(!empty($webData)){
			$tpl->assign('webData',$webData);
		}
		$tpl->display('website.htm');
	}
}