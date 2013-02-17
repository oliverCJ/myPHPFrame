<?php
namespace Model;
/**
 * Enter description here ...
 * FileName:Base.php
 * @Author:oliver <cgjp123@163.com>
 * @since:2012-2-13
 */
 class Base {
 	
 	public function getDB(){
 		$dbModle = new \Lib\Db();
 		$db = $dbModle->loadDB();
 		return $db;
 	}
 }