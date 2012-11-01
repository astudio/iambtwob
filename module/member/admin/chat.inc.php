<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('在線對話', '?moduleid='.$moduleid.'&file=chat'),
);
if($action == 'delete') {
	if(strlen($chatid) == 32) $db->query("DELETE FROM {$DT_PRE}chat WHERE chatid='$chatid'");
	dmsg('刪除成功', $forward);
} else {
	$sfields = array('按條件', '發起人', '接收人', '來源');
	$dfields = array('fromuser', 'fromuser', 'touser', 'forward');
	$sorder  = array('結果排序方式', '開始時間降序', '開始時間升序');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC');
	$S = array('<span style="color:#666666">對方已經掛斷</span>', '<span style="color:#FF0000">拒絕對話請求</span>', '<span style="color:#0000FF">等待接受對話</span>', '<span style="color:#008040">正在對話中...</span>', '<span style="color:#666666">超時自動斷開</span>');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	$status = isset($status) ? intval($status) : -1;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$condition = '1';
	if($keyword) $condition .= " AND $dfields[$fields]='$kw'";
	if($status > -1) $condition .= " AND status=$status";
	$order = $dorder[$order];
	$db->query("DELETE FROM {$DT_PRE}chat WHERE addtime<$DT_TIME-3600 AND status!=3");
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}chat WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);
	$lists = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}chat WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['addtime'] = timetodate($r['addtime'], 'm-d H:i:s');
		if($r['forward'] && strpos($r['forward'], '://') === false) $r['forward'] = 'http://'.$r['forward'];
		$lists[] = $r;
	}
	include tpl('chat', $module);
}
?>