<?php 
defined('IN_DESTOON') or exit('Access Denied');
define('MD_ROOT', DT_ROOT.'/module/'.$module);
require DT_ROOT.'/include/module.func.php';
require MD_ROOT.'/global.func.php';
$CREDITS = explode('|', trim($MOD['credits']));
$table = $DT_PRE.$module;
$table_data = $DT_PRE.$module.'_data';
$cht = isset($userlocale) && $userlocale == 'zh-tw' ? true : false;
$ltype = isset($lt) && in_array($lt, array(0,1)) ? $lt : $cht; //1:cht 0:eng
?>