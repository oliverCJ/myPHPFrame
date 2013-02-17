<?php
namespace Admin\Model;
defined ( 'ADMIN' ) or die ( 'Access Denied' );

/**
 * 站点管理数据层
 * @author chengjun
 *
 */
class WebsiteModel extends \Admin\Model\Base {	
	
	protected $dbTable = 'website';
	
	public function getData(){
		$db = $this->getDB();
		
		$sql = "SELECT `webName`,`webTitle`,`webDesc`,`webKeyword` FROM `".DBPREFIX.$this->dbTable."` WHERE `id`=1";
		$result = $db->query($sql);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
	
	public function editData($data=array()){
		if(!empty($data)){
			$db = $this->getDB();
			
			$sql = "UPDATE `".DBPREFIX.$this->dbTable."` SET ";
			
			foreach($data as $k=>$v){
				$sql .= !empty($v) ? " `{$k}`='{$v}'" : "" ;
			}
			
			$sql .= " `modifyTime`='".time()."'";
			$sql .= " WHERE id=1";
			
			$db->execute($sql);
			return true;
		}
	}
}