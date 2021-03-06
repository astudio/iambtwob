<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
@set_time_limit(0);
define('DT_ADMIN', true);
define('DT_MEMBER', true);
require 'common.inc.php';
$_areaids = '';
$_areaid = array();
if($DT['city']) {
	$AREA or $AREA = cache_read('area.php');
	if($_aid) {
		$_areaids = $AREA[$_aid]['child'] ? $AREA[$_aid]['arrchildid'] : $_aid;
		$_areaid = explode(',', $_areaids);
	}
} else {
	$_aid < 1 or dalert('系統未開啟分站功能，您的分站管理帳號暫不可用', $MODULE[2]['linkurl'].'logout.php');
}
$session = new dsession();
require DT_ROOT.'/admin/global.func.php';
require DT_ROOT.'/include/post.func.php';
require_once DT_ROOT.'/include/cache.func.php';
isset($file) or $file = 'index';
$secretkey = 'admin_'.strtolower(substr($CFG['authkey'], -6));
if($DT['authadmin'] == 'session') {
	$_destoon_admin = isset($_SESSION[$secretkey]) ? intval($_SESSION[$secretkey]) : 0;
} else {
	$_destoon_admin = get_cookie($secretkey);
	$_destoon_admin = $_destoon_admin ? intval($_destoon_admin) : 0;
}
$_founder = $CFG['founderid'] == $_userid ? $_userid : 0;
$_catids = $_childs = '';
$_catid = $_child = array();
if($file != 'login') {
	if($_groupid != 1 || $_admin < 1 || !$_destoon_admin) msg('', '?file=login&forward='.urlencode($DT_URL));
	if(!admin_check()) {
		admin_log(1);
		$db->query("DELETE FROM {$db->pre}admin WHERE userid=$_userid AND url='?".$DT_QST."'");
		msg('警告！您無權進行此操作 Error(00)');
	}
}
if($DT['admin_log'] && $action != 'import') admin_log();
if($DT['admin_online']) admin_online();
$psize = isset($psize) ? intval($psize) : 0;
if($psize > 0 && $psize != $pagesize) {
	$pagesize = $psize;
	$offset = ($page-1)*$pagesize;
}

if($module == 'destoon') {
	(include DT_ROOT.'/admin/'.$file.'.inc.php') or msg();
} else {
	include DT_ROOT.'/module/'.$module.'/common.inc.php';
	(include MD_ROOT.'/admin/'.$file.'.inc.php') or msg();
}
?>