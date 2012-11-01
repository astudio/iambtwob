<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array("添加".$name, "?moduleid=$moduleid&action=add"),
	array($name."列表", "?moduleid=$moduleid"),
	array("審核".$name, "?moduleid=$moduleid&action=check"),
	array("行業分類", "?file=category&mid=$moduleid"),
	array("更新數據", "?moduleid=$moduleid&file=html"),
	array("模塊設置", "?moduleid=$moduleid&file=setting"),
);
?>