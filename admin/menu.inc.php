<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array('數據維護', '?file=database'),
	array('模板風格', '?file=template'),
	array('標籤嚮導', '?file=tag'),
	array('後台搜索', '?file=search'),
	array('木馬掃瞄', '?file=scan'),
	array('後台日誌', '?file=log'),
	array('上傳記錄', '?file=upload'),
	array('404日誌', '?file=404'),
	array('搜索記錄', '?file=keyword'),
	array('問題驗證', '?file=question'),
	array('詞語過濾', '?file=banword'),
	array('重名檢測', '?file=repeat'),
	array('禁止IP', '?file=banip'),
	array('編輯助手', '?file=word'),
	array('單頁采編', '?file=fetch'),
	array('系統體檢', '?file=doctor'),
);
if(!$_founder) unset($menu[0],$menu[1],$menu[3]);
$menu_help = array(
	array('使用協議', '?file=destoon&action=license'),
	array('在線文檔', '?file=destoon&action=doc'),
	array('技術支持', '?file=destoon&action=support'),
	array('官方論壇', '?file=destoon&action=bbs'),
	array('信息反饋', '?file=destoon&action=feedback'),
	array('檢查更新', '?file=destoon&action=update'),
	array('關於軟件', '?file=destoon&action=about'),
);
$menu_system = array(
	array('網站設置', '?file=setting'),
	array('模塊管理', '?file=module'),
	array('地區管理', '?file=area'),
	array('城市分站', '?file=city'),
	array('管理員管理', '?file=admin'),
);
?>