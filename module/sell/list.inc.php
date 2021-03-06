<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if(!$CAT || $CAT['moduleid'] != $moduleid) {
	$head_title = lang('message->cate_not_exists');
	@header("HTTP/1.1 404 Not Found");
	exit(include template('list-notfound', 'message'));
}
if($MOD['list_html']) {
	$html_file = listurl($CAT, $page);
	if(is_file(DT_ROOT.'/'.$MOD['moduledir'].'/'.$html_file)) {
		@header("HTTP/1.1 301 Moved Permanently");
		dheader($MOD['linkurl'].$html_file);
	}
}
if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
$CP = $MOD['cat_property'] && $CAT['property'];
if($MOD['cat_property'] && $CAT['property']) {
	require DT_ROOT.'/include/property.func.php';
	$PPT = property_condition($catid);
}
$list = isset($list) && in_array($list, array(0, 1, 2)) ? $list : (isset($_COOKIE[$CFG['cookie_pre'].'list']) ? $_COOKIE[$CFG['cookie_pre'].'list'] : 0); // 0:gallery 1:list 2:text
unset($CAT['moduleid']);
extract($CAT);
$maincat = get_maincat($child ? $catid : $parentid, $moduleid);

$condition = 'status=3';
$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
if($cityid) {
	$areaid = $cityid;
	$ARE = $AREA[$cityid];
	$condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	$items = $db->count($table, $condition, $CFG['db_expires']);
} else {
	if($page == 1) {
		$items = $db->count($table, $condition, $CFG['db_expires']);
		if($items != $CAT['item']) {
			$CAT['item'] = $items;
			$db->query("UPDATE {$DT_PRE}category SET item=$items WHERE catid=$catid");
		}
	} else {
		$items = $CAT['item'];
	}
}

if($MOD['group']){
	$group = $MOD['group'];
	$total = $db->count($table, $condition, $DT['cache_search'], $group);
    $dcount = "MAX(itemid) AS itemid,COUNT($group) AS dcount";	
	$_group = " GROUP BY $group";  
}
$fields = $MOD['fields'];
$pagesize = $MOD['pagesize'];
$offset = ($page-1)*$pagesize;
$pages = $group ? pages($total, $page, $pagesize) : listpages($CAT, $items, $page, $pagesize);
$tags = array();
if($items) {
	$query = $group ? "SELECT a.{$fields},b.dcount FROM {$table} a INNER JOIN (SELECT {$dcount} FROM {$table} WHERE {$condition}{$_group}) b ON a.itemid = b.itemid" : "SELECT {$fields} FROM {$table} WHERE {$condition}";
	$query .= "{$order} LIMIT $offset,$pagesize";
	
	$result = $db->query($query, ($CFG['db_expires'] && $page == 1) ? 'CACHE' : '', $CFG['db_expires']);
	while($r = $db->fetch_array($result)) {
		$r['adddate'] = timetodate($r['addtime'], 5);
		$r['editdate'] = timetodate($r['edittime'], 5);
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
		$tags[] = $r;
	}
	$db->free_result($result);
}
$length = 180;
$showpage = 1;
$datetype = 3;

$seo_file = 'list';
include DT_ROOT.'/include/seo.inc.php';

$template = $CAT['template'] ? $CAT['template'] : 'list';
include template($template, $module);
?>