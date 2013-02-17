<?php
namespace Module\Index;

/**
 * 
 * 首页
 * @author oliver <cgjp123@163.com>
 *
 */
class Index extends \lib\Application{
	
	public function run(){
		$tpl = \Lib\Template::getSmarty();
		//$indexM = new \Model\IndexModel();
		//$result = $indexM->getData();
		//print_r($result);exit();
		$tpl->display('index.htm');
	}
}