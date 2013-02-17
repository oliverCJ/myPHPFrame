<?php 
/**
 * 
 * 后台入口
 * @author oliver <cgjp123@163.com>
 *
 */
define('ADMIN_SCRIPT_TIME_START',microtime(true));
define('ADMIN',true);

//调用项目配置文件
require '../config/config.static.php';
require_once '../config/adminconfig.inc.php';

//调入类库自动加载过程
require ROOT_PATH.'lib/Autoloader.php';

$app = new Lib\Admin_Application();
$app->run();