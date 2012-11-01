<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array("添加招聘", "?moduleid=$moduleid&action=add"),
	array("招聘列表", "?moduleid=$moduleid"),
	array("審核招聘", "?moduleid=$moduleid&action=check"),
	array("添加簡歷", "?moduleid=$moduleid&file=resume&action=add"),
	array("簡歷列表", "?moduleid=$moduleid&file=resume"),
	array("審核簡歷", "?moduleid=$moduleid&file=resume&action=check"),
	array("分類管理", "?file=category&mid=$moduleid"),
	array("更新數據", "?moduleid=$moduleid&file=html"),
	array("模塊設置", "?moduleid=$moduleid&file=setting"),
);
?>