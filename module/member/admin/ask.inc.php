<?php
defined('IN_DESTOON') or exit('Access Denied');
$TYPE = get_type('ask', 1);
$TYPE or msg('啟用客服中心，請先添加問題分類', '?file=type&item=ask');
$menus = array (
    array('客服中心', '?moduleid='.$moduleid.'&file='.$file),
    array('分類管理', '?file=type&item=ask'),
);
$stars = array('', '<span style="color:red;">不滿意</span>', '基本滿意', '<span style="color:green;">非常滿意</span>');
switch($action) {
	case 'edit':
		$itemid or msg();
		if($submit) {
			if($status == 2 && !$reply) msg('回復內容不能為空');
			$db->query("UPDATE {$DT_PRE}ask SET status=$status,admin='$_username',admintime='$DT_TIME',reply='$reply' WHERE itemid=$itemid");
			dmsg('受理成功', $forward);
		} else {
			$r = $db->get_one("SELECT * FROM {$DT_PRE}ask WHERE itemid=$itemid");
			$r or msg();
			extract($r);
			$addtime = timetodate($addtime, 5);
			$admintime = timetodate($admintime, 5);
			include tpl('ask_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg();
		$db->query("DELETE FROM {$DT_PRE}ask WHERE itemid=$itemid ");
		dmsg('刪除成功', '?moduleid='.$moduleid.'&file='.$file);
	break;
	default:
		$_status = array('待受理', '<span style="color:blue;">受理中</span>', '<span style="color:green;">已解決</span>', '<span style="color:red;">未解決</span>');
		$sfields = array('按條件', '標題', '內容', '會員名', '回復', '受理人');
		$dfields = array('title', 'title', 'content', 'username', 'reply', 'admin');
		$dstatus = array('待受理', '受理中', '已解決', '未解決');
		$sorder  = array('結果排序方式', '提交時間降序', '提交時間升序', '受理時間降序', '受理時間升序', '會員評分降序', '會員評分升序');
		$dorder  = array('itemid DESC', 'itemid DESC', 'itemid ASC', 'admintime DESC', 'admintime ASC', 'star DESC', 'star ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($typeid) or $typeid = 0;
		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$type_select   = type_select('ask', 1, 'typeid', '請選擇分類', $typeid);
		$status_select = dselect($dstatus, 'status', '受理狀態', $status, '', 1, '', 1);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($typeid > 0) $condition .= " AND typeid=$typeid";
		if($status !== '') $condition .= " AND status=$status";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}ask WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$asks = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}ask WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['dstatus'] = $_status[$r['status']];
			$r['type'] = $r['typeid'] && isset($TYPE[$r['typeid']]) ? set_style($TYPE[$r['typeid']]['typename'], $TYPE[$r['typeid']]['style']) : '默認';
			$asks[] = $r;
		}
		include tpl('ask', $module);
	break;
}
?>