<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('在線會員', '?moduleid='.$moduleid.'&file=online'),
    array('在線管理員', '?moduleid='.$moduleid.'&file=online&action=admin'),
);
if($action == 'admin') {
	$DT['admin_online'] or msg('系統未開啟此功能', '?file=setting&kw='.urlencode('後台在線').'#high');
	$lastime = $DT_TIME - $DT['online'];
	$db->query("DELETE FROM {$DT_PRE}admin_online WHERE lasttime<$lastime");
	$sid = session_id();
	$lists = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}admin_online ORDER BY lasttime DESC");
	while($r = $db->fetch_array($result)) {
		$r['lasttime'] = timetodate($r['lasttime'], 'H:i:s');
		$lists[] = $r;
	}
	include tpl('online_admin', $module);
} else {
	$sfields = array('按條件', '會員名', '會員ID');
	$dfields = array('username', 'username', 'userid');
	$sorder  = array('結果排序方式', '訪問時間降序', '訪問時間升序', '會員ID降序', '會員ID升序');
	$dorder  = array('lasttime DESC', 'lasttime DESC', 'lasttime ASC', 'userid DESC', 'userid ASC');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	$mid = isset($mid) ? intval($mid) : 0;
	$online = isset($online) ? intval($online) : 2;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$condition = '1';
	if($keyword) $condition .= " AND $dfields[$fields]='$kw'";
	if($mid) $condition .= " AND moduleid=$mid";
	if($online < 2) $condition .= " AND online=$online";
	$order = $dorder[$order];
	$lastime = $DT_TIME - $DT['online'];
	$db->query("DELETE FROM {$DT_PRE}online WHERE lasttime<$lastime");
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}online WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);
	$lists = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}online WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['lasttime'] = timetodate($r['lasttime'], 'H:i:s');
		$lists[] = $r;
	}
	include tpl('online', $module);
}
?>