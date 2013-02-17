<?php
namespace Lib\Drive;
/**
 * 数据库管理
 * @author oliver <cgjp123@163.com>
 */
class Mysql extends \Lib\Db {
	
	public function __construct() {
		if(defined('HOST')) $this->dbHost = HOST;
		if(defined('USERNAME')) $this->dbUserName = USERNAME;
		if(defined('PASSWORD')) $this->dbPassword = PASSWORD;
		if(defined('TABLENAME')) $this->dbTableName = TABLENAME;
		if(defined('PORT')) $this->port = PORT;
	}
	
	/**
	 * 
	 * 链接数据库
	 */
	public function connect() {
		//端口号处理
		$this->dbHost = $this->dbHost . ($this->port ? ":{$this->port}" : '');
		if($this->pconnect){
			$this->_linkID = mysql_pconnect ( $this->dbHost, $this->dbUserName, $this->dbPassword );
		}else{
			$this->_linkID = mysql_connect ( $this->dbHost, $this->dbUserName, $this->dbPassword,true );
		}
		if ($this->_linkID) {
			$dbselect = mysql_select_db ( $this->dbTableName );
			mysql_query("SET NAMES 'utf8'");
			if (! $dbselect) {
				return $this->error();
			}
			// 标记连接成功
            $this->connected    =   true;
			return $this->_linkID;
		} else {
			return $this->error();
		}
	}
	
	/**
	 * 执行查询 返回数据集
	 * @see lib.Db::query()
	 * @return mixed
	 */
	public function query($query='') {
		$this->initConnect();
		if($this->queryID){
			$this->freeResult();
		}
		if ($query != "") {
			$this->queryID = mysql_query ( $query, $this->_linkID );
		}
		if ($this->queryID) {
			$this->numRows = mysql_num_rows($this->queryID);
			if($this->numRows>1){
				$this->queryResult = $this->getAll();
			}elseif($this->numRows>0){
				$this->queryResult = $this->getRow();
			}
			
			return $this->queryResult;
		} else {
			return $this->error();
		}
	}
	
	/**
	 * 
	 * 执行语句
	 * @param string $query
	 * @return integer
	 */
	public function execute($query=''){
		$this->initConnect();
		if(!$this->_linkID) return false;
		if($this->queryID){
			$this->freeResult();
		}
		if($query!=''){
			$result = mysql_query($query,$this->_linkID);
			if(false === $result){
				return $this->error();
			}else{
				$this->numRows = mysql_affected_rows($this->_linkID);
				$this->lastInsID = mysql_insert_id($this->_linkID);
				return $this->numRows;
			}
		}
	}
	
	/**
	 * 
	 * 启动事务
	 */
	public function startTrans() {
        $this->initConnect();
        if ( !$this->_linkID ) return false;
        //数据rollback 支持
        if ($this->transTimes == 0) {
            mysql_query('START TRANSACTION', $this->_linkID);
        }
        $this->transTimes++;
        return ;
    }
    
    /**
     * 
     * 提交事务
     */
	public function commit()
    {
        if ($this->transTimes > 0) {
            $result = mysql_query('COMMIT', $this->_linkID);
            $this->transTimes = 0;
            if(!$result){
               return $this->error();
            }
        }
        return true;
    }
    
    /**
     * 
     * 回滚事务
     */
	public function rollback()
    {
        if ($this->transTimes > 0) {
            $result = mysql_query('ROLLBACK', $this->_linkID);
            $this->transTimes = 0;
            if(!$result){
                return $this->error();
            }
        }
        return true;
    }
	
	/**
	 * 获取查询数据
	 * @see lib.Db::getAll()
	 * @return array
	 */
	private function getAll(){
		$result = array();
		if($this->numRows >0){
			while($row = mysql_fetch_assoc($this->queryID)){
                $result[]   =   $row;
            }
            //移动数据集指针到开头
           mysql_data_seek($this->queryID,0);
		}
		return $result;
	}
	
	/**
	 * 执行查询，返回单条数据
	 * @see lib.Db::getRow()
	 * @return multitype:|string
	 */
	public function getRow(){
		$result = array();
		if($this->numRows>0){
			$result   =   mysql_fetch_assoc($this->queryID);
			//移动数据集指针到开头
			mysql_data_seek($this->queryID,0);
		}
		return $result;
	}
	
	/**
	 * 
	 * 取得数据库表信息
	 * @param string $dbName
	 */
	public function getTables($dbName='') {
		$this->initConnect();
        if(!empty($dbName)) {
           $sql    = 'SHOW TABLES FROM '.$dbName;
        }else{
           $sql    = 'SHOW TABLES ';
        }
        $result =   $this->query($sql);
        $info   =   array();
        foreach ($result as $key => $val) {
            $info[$key] = current($val);
        }
        return $info;
    }
	
	/**
	 * 
	 * 释放内存
	 */
	public function freeResult() {
		if ($this->queryID) {
			//释放内存
			@mysql_free_result ( $this->queryID );
			$this->queryID = 0;
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * 关闭数据库
	 */
	public function close() {
		if ($this->_linkID) {
			if ($this->queryResult) {
				//mysql_free_result() 仅需要在考虑到返回很大的结果集时会占用多少内存时调用。
				//在脚本结束后所有关联的内存都会被自动释放。
				@mysql_free_result ( $this->queryID );
			}
			
			//关闭数据库
			$result = @mysql_close ( $this->_linkID );
			return $result;
		} else {
			return false;
		}
	}
	
	/**
	 * SQL语句执行错误的函数
	 */
	public function error() {
		$this->error = mysql_error ( $this->_linkID );
		return $this->error;
	}
	
	/**
	 * 
	 * SQL语句安全过滤
	 * @param string $query
	 */
	public function escape_string($query){
		return mysql_escape_string($query);
	}
	
	/**
	 * 
	 * 析构方法
	 */
	public function __destruct(){
		$this->close();
	}
}
