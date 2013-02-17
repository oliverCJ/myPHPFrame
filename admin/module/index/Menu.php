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
class Menu extends Admin_Application{
	
	public $menu = array();

	public function run(){
		$tpl = \Lib\Template::getAdminSmarty();
		
		$this->menu = $this->getMenu(\Config\AdminMenuConfig::$menu);
		
		$tpl->assign('menu',$this->menu);
		$tpl->display('menu.htm');
	}
	
	public function getMenu($menu){
		if(!empty($menu)){
			foreach ($menu as $k=>$v){
				if(!empty($k)){
					if($k['switch']=='off'){
						unset($menu[$k]);
					}
					if(!empty($v['childCate'])){
						$this->getMenu($v['childCate']);
					}
				}
			}
		}
		return $menu;
	}
}