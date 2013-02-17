<?php 
namespace Lib\Helper;
/**
 * 通用方法集合
 * FileName:function.fun.php
 * @Author:oliver <cgjp123@163.com>
 * @Since:2012-3-20
 */
class CommonFunction {
	//来访工具判断
	public static function getrobot()	{
		if(!defined('IS_ROBOT')) {
			$kw_spiders = 'Bot|bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla|google|Search|Yahoo|Technology|msn|spider|search';
			$kw_browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';
			if(preg_match("/($kw_browsers)/", $_SERVER['HTTP_USER_AGENT'])) {
				define('IS_ROBOT', FALSE);
			} elseif(preg_match("/($kw_spiders)/", $_SERVER['HTTP_USER_AGENT'])) {
				define('IS_ROBOT', TRUE);
			} else {
				define('IS_ROBOT', FALSE);
			}
		}
		return IS_ROBOT;
	}
	
	//获取客户端IP
	public static function get_client_ip() {
		return $_SERVER['REMOTE_ADDR'];
	}
	
	//获取随机字符
	public static function genRandomString($len){
		$chars = array(
		"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
		"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
		"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
		"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
		"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
		"3", "4", "5", "6", "7", "8", "9"
		);
		$charsLen=count($chars) - 1;
		shuffle($chars);
		$output = "";
	    for ($i=0; $i<$len; $i++){
			$output .= $chars[mt_rand(0, $charsLen)];
		}
		return $output;
	}
	
	//获取随机数
	public static function random($length, $numeric = 0) {
		mt_srand((double)microtime() * 1000000);
		if($numeric) {
			$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
		} else {
			$hash = '';
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
			$max = strlen($chars) - 1;
			for($i = 0; $i < $length; $i++) {
				$hash .= $chars[mt_rand(0, $max)];
			}
		}
		return $hash;
	}
	
	
	public static function daddslashes($string, $force = 0) {
		!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
		if(!MAGIC_QUOTES_GPC || $force) {
			if(is_array($string)) {
				foreach($string as $key => $val) {
					$string[$key] = daddslashes($val, $force);
				}
			} else {
				$string = trim(addslashes($string));
			}
		}
		else
		{
			if(is_array($string)) {
				foreach($string as $key => $val) {
					$string[$key] = daddslashes($val, $force);
				}
			} else {
				$string = trim($string);
			}
		}
		return $string;
	}
	
	//自定义BASE64编码
	public static function Base64Encode($string=''){
		$Base64CodeTable = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9','+','/','=');
		if(!empty($string)){
			$length = strlen($string);
			$byte = '';
			for($i=0;$i<$length;$i++){
				$ascII = ord($string[$i]);
				$bin = (string)decbin($ascII);
				
				if(strlen($bin)<8){
					$temp = '';
					for($j=0;$j<(8-strlen($bin));$j++){
						$temp .= '0';
					}
					$bin = $temp.$bin;
				}
				$byte .= $bin;
			}
			$newByte = str_split($byte,6);
			$newstr = array();
			if(!empty($newByte)){
				foreach($newByte as $k=>$v){
					if(strlen($v)<6){
						$temp = 6-strlen($v);
						$v = bindec($v);
						$v = $v << $temp;
						$v = decbin($v);
					}
					$temp = bindec($v);
					$newstr[$k] = $Base64CodeTable[$temp];
				}
			}
			if(!empty($newstr)){
				$base64Code = implode('', $newstr);
				if(strlen($base64Code)%4!=0){
					for($i=0;strlen($base64Code)%4!=0;$i++){
						$base64Code{strlen($base64Code)} = '=';
					}
				}
			}
			echo $base64Code;exit;
		}
	}
}