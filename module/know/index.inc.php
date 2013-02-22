<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if($MOD['index_html']) {	
	$html_file = DT_ROOT.'/'.$MOD['moduledir'].'/'.$DT['index'].'.'.$DT['file_ext'];
	if(!is_file($html_file)) tohtml('index', $module);
	include($html_file);
	exit;
}
if(!check_group($_groupid, $MOD['group_index'])) {
	$head_title = lang('message->without_permission');
	include template('noright', 'message');
	exit;
}

require DT_ROOT.'/include/post.func.php';
include load('search.lang');
$CP = $MOD['cat_property'] && $catid && $CAT['property'];
if(!$areaid && $cityid && strpos($DT_URL, 'areaid') === false) {
	$areaid = $cityid;
	$ARE = $AREA[$cityid];
}
$typeid = isset($typeid) ? intval($typeid) : 99;
$sfields = array($L['by_auto'], $L['by_title'], $L['by_content'], $L['by_introduce']);
$dfields = array('keyword', 'title', 'content', 'introduce');
$sorder  = array($L['order'], $L['order_auto'], $L['order_reward'], $L['order_answer'], $L['order_hits']);
$dorder  = array($MOD['order'], '', 'credit DESC', 'answer DESC', 'hits DESC');
if(!$MOD['fulltext']) unset($sfields[2], $dfields[2]);
isset($fields) && isset($dfields[$fields]) or $fields = 0;
isset($order) && isset($dorder[$order]) or $order = 0;
$order_select  = dselect($sorder, 'order', '', $order);
$category_select = category_select('catid', $L['all_category'], $catid, $moduleid);
$area_select = $DT['city'] ? ajax_area_select('areaid', $L['all_area'], $areaid) : '';

$seo_file = 'index';
include DT_ROOT.'/include/seo.inc.php';
$destoon_task = "moduleid=$moduleid&html=index";
include template('index', $module);
?>