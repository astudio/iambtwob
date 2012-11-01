<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array("添加商品", "?moduleid=$moduleid&action=add"),
	array("商品列表", "?moduleid=$moduleid"),
	array("訂單列表", "?moduleid=$moduleid&file=order"),
	array("審核商品", "?moduleid=$moduleid&action=check"),
	array("商品分類", "?file=category&mid=$moduleid"),
	array("更新數據", "?moduleid=$moduleid&file=html"),
	array("模塊設置", "?moduleid=$moduleid&file=setting"),
);
?>