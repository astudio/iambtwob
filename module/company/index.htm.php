<?php 
defined('IN_DESTOON') or exit('Access Denied');
$filename = DT_ROOT.'/'.$MOD['moduledir'].'/index.inc.html';
if(!$MOD['index_html']) {
	if(is_file($filename)) file_del($filename);
	return false;
}
if($DT['rewrite']) {
	defined('DT_REWRITE') or define('DT_REWRITE', true);
	$_SERVER["SCRIPT_NAME"] = 'index.php';
	$_SERVER['QUERY_STRING'] = '';
} else {
	$GLOBALS['DT_URL'] = $DT_URL = 'index.php';
}
$seo_file = 'index';
include DT_ROOT.'/include/seo.inc.php';
$destoon_task = "moduleid=$moduleid&html=index";
if($page == 1) $head_canonical = $MOD['linkurl'];
ob_start();
include template('index', $module);
$data = ob_get_contents();
ob_clean();
file_put($filename, $data);
return true;
?>