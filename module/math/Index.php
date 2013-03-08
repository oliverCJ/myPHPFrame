<?php
namespace Module\Math;
/**
* 数学模块首页
* @author chengjun<chengjun@milanoo.com>
*/
class Index extends \lib\Application {
	public function run(){
		$tpl = \Lib\Template:: getSmarty();
		
		$tpl->display('math_index.htm');
	}
}