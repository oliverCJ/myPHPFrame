<?php
namespace Model;
/**
 * 首页模块
 * FileName:IndexModel.php
 * @Author:oliver <cgjp123@163.com>
 * @Since:2012-2-21
 */
 class IndexModel extends \Model\Base {
 	
 	protected $db;
 	
 	public function __construct(){
 		$this->db = $this->getDB();
 	}
 	
 	/**
 	 * 
 	 * 获取数据
 	 */
 	public function getData(){
 		$sql = 'select * from ' . DBPREFIX . 'value';
 		$result = $this->db->query($sql);
 		return $result;
 	}
 	
 	public function insertData($data=array()){
 		
 	}
 }