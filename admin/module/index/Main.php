<?php
namespace Admin\Module\Index;
defined ( 'ADMIN' ) or die ( 'Access Denied' );
/**
 * 
 * 后台主体
 * @author oliver <cgjp123@163.com>
 *
 */
use Lib\Admin_Application;
class Main extends Admin_Application{
	
	public function run(){
		$tpl = \Lib\Template::getAdminSmarty();
		
		$tpl->display('main.htm');
	}
}