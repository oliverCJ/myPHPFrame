<?php
namespace Admin\Module\Index;
defined ( 'ADMIN' ) or die ( 'Access Denied' );
/**
 * 
 * 后台首页
 * @author oliver <cgjp123@163.com>
 *
 */
use Lib\Admin_Application;
class Index extends Admin_Application{
	
	public function run(){
		$tpl = \Lib\Template::getAdminSmarty();
		
		$tpl->display('index.htm');
	}
}