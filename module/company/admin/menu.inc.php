<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array('公司列表', '?moduleid=4'),
	array(VIP.'管理', '?moduleid=4&file=vip'),
	array('行業分類', '?file=category&mid=4'),
	array('榮譽資質', '?moduleid=2&file=honor'),
	array('公司新聞', '?moduleid=2&file=news'),
	array('公司單頁', '?moduleid=2&file=page'),
	array('友情鏈接', '?moduleid=2&file=link'),
	array('公司模板', '?moduleid=2&file=style'),
	array('更新數據', '?moduleid=4&file=html'),
	array('模塊設置', '?moduleid=4&file=setting'),
);
?>