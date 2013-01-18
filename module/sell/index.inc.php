<?php
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if(!check_group($_groupid, $MOD['group_index'])) {
	$head_title = lang('message->without_permission');
	include template('noright', 'message');
	exit;
} //var_dump($CFG['cookie_pre']);die;
$typeid = isset($typeid) ? intval($typeid) : 99;
isset($TYPE[$typeid]) or $typeid = 99;
$list = isset($list) && in_array($list, array(0, 1, 2)) ? $list : (isset($_COOKIE[$CFG['cookie_pre'].'im_slt']) ? $_COOKIE[$CFG['cookie_pre'].'im_slt'] : 0); // 0:gallery 1:list 2:text
$dtype = $typeid != 99 ? " AND typeid=$typeid" : '';

$condition = "status=3".$dtype;
$pagesize = $MOD['pagesize'];
$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : "";
$items = $db->count($table, $condition, $DT['cache_search']);
if($MOD['group']){
  $group = $MOD['group'];
  $total = $db->count($table, $condition, $DT['cache_search'], $group);
}

$maincat = get_maincat($catid ? $CAT['parentid'] : 0, $moduleid);
$seo_file = 'index';
include DT_ROOT.'/include/seo.inc.php';
if($catid) $seo_title = $seo_catname.$seo_title;
if($typeid != 99) $seo_title = $TYPE[$typeid].$seo_delimiter.$seo_title;
if($page == 1) $head_canonical = $MOD['linkurl'];
$destoon_task = "moduleid=$moduleid&html=index";
include template('index', $module);
?>