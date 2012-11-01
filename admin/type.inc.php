<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
isset($item) or msg();
require DT_ROOT.'/include/type.class.php';
$forward = '?file='.$file.'&item='.$item;
$do = new dtype;
$do->item = $item;
$do->cache = 1;
$menuon = 1;
if(strpos($item, 'special-') === false) {
	switch($item) {
		case 'ask':
			$menus = array (
				array('客服中心', '?moduleid=2&file='.$item),
				array('分類管理', $forward),
			);
		break;
		case 'mail':
			$menus = array (
				array('郵件訂閱', '?moduleid=2&file='.$item),
				array('訂閱分類', $forward),
			);
		break;
		case 'announce':
			$menus = array (
				array('公告管理', '?moduleid=3&file='.$item),
				array('公告分類', $forward),
			);
		break;
		case 'link':
			$menus = array (
				array('友情鏈接', '?moduleid=3&file='.$item),
				array('鏈接分類', $forward),
			);
		break;
		case 'vote':
			$menus = array (
				array('投票管理', '?moduleid=3&file='.$item),
				array('投票分類', $forward),
			);
		break;
		case 'poll':
			$menus = array (
				array('票選管理', '?moduleid=3&file='.$item),
				array('票選分類', $forward),
			);
		break;
		case 'gift':
			$menus = array (
				array('積分換禮', '?moduleid=3&file='.$item),
				array('禮品分類', $forward),
			);
		break;
		case 'survey':
			$menus = array (
				array('問卷管理', '?moduleid=3&file='.$item),
				array('問卷分類', $forward),
			);
		break;
		default:
			$menus = array (
				array('分類管理', $forward),
			);
			$menuon = 0;
		break;
	}
} else {
	$menus = array (
		array('專題管理', '?moduleid=11&file=item&specialid='.str_replace('special-', '', $item)),
		array('信息分類', $forward),
	);
	$do->cache = 0;
}
if($submit) {
	$do->update($post);
	dmsg('更新成功', $forward);
} else {
	$lists = $do->get_list();
	include tpl('type');
}
?>