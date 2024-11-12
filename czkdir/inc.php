<?php
error_reporting(0);
define("DIR_INIT", true);
define("SYSTEM_ROOT", dirname(__FILE__).'/');
define("ROOT", dirname(SYSTEM_ROOT).'/');
define("PAGE_ROOT", SYSTEM_ROOT.'page/');
define("VERSION", '1.2');

date_default_timezone_set("PRC");

require SYSTEM_ROOT.'functions.php';
require SYSTEM_ROOT.'Cache.class.php';
require SYSTEM_ROOT.'DirList.class.php';
require SYSTEM_ROOT.'FileMgr.class.php';

$CACHE = new Cache();
$conf = $CACHE->get('config');
if(!$conf){
	if(!$CACHE->set('config', ['admin_username'=>'admin','admin_password'=>md5('123456'),'title'=>'czkphpwebdir', 'keywords'=>'czk目录列表,文件列表,目录','description'=>'一个php目录列表站点','announce'=>'','footer'=>'', 'name_encode'=>'utf8', 'file_hash'=>'1', 'cache_indexes'=>'0', 'footer_bar'=>'1', 'readme_md'=>'1', 'auth'=>'0', 'nav'=>'czk主站*https://www.szczk.top/|星辰云盘*https://pan.szczk.top/|测试测试*https://example.com/'])){
		sysmsg('初始化失败，可能无写入文件权限');
	}
	$conf = $CACHE->get('config');
}

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = (is_https() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

$cdnpublic = 'https://s4.zstatic.net/ajax/libs/';

if(isset($_COOKIE["admin_session"]))
{
	if($conf['admin_session']===$_COOKIE["admin_session"]) {
		$islogin=1;
	}
}
