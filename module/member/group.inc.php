<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
isset($MODULE[17]) or dheader($MODULE[2]['linkurl']);
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$_status = $L['group_status'];
$dstatus = $L['group_dstatus'];
$step = isset($step) ? trim($step) : '';
$timenow = timetodate($DT_TIME, 3);
$memberurl = linkurl($MOD['linkurl'], 1);
$myurl = userurl($_username);
$table = $DT_PRE.'group_order';
if($action == 'update') {
	$itemid or message();
	$td = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
	$td or message($L['group_msg_null']);
	if($td['buyer'] != $_username && $td['seller'] != $_username) message($L['group_msg_deny']);
	$td['adddate'] = timetodate($td['addtime'], 5);
	$td['updatedate'] = timetodate($td['updatetime'], 5);
	$gid = $td['gid'];
	$nav = $_username == $td['buyer'] ? 'action_order' : 'action';
	switch($step) {
		case 'detail'://訂單詳情
			$td['total'] = $td['amount'];
			$head_title = $L['group_detail_title'];
		break;
		case 'used'://已消費
			if($td['seller'] == $_username) {
				if($td['status'] != 0 || $td['logistic']) message();
				$db->query("UPDATE {$table} SET status=2,updatetime=$DT_TIME WHERE itemid=$itemid");
				dmsg('操作成功', '?page='.$page);
			} else {
				if($td['status'] != 2 || $td['logistic']) message();
				$db->query("UPDATE {$table} SET status=3,updatetime=$DT_TIME WHERE itemid=$itemid");
				dmsg('交易成功', '?action=order&page='.$page);
			}
		break;
		case 'receive'://確認收貨
			if($td['status'] != 1 || $td['buyer'] != $_username || !$td['logistic']) message();
			$db->query("UPDATE {$table} SET status=3,updatetime=$DT_TIME WHERE itemid=$itemid");
			dmsg('交易成功', '?action=order&page='.$page);
		break;
		case 'send'://賣家發貨
			if($td['status'] != 0 || $td['seller'] != $_username || !$td['logistic']) message();
			if($submit) {
				$send_type = htmlspecialchars($send_type);
				$send_no = htmlspecialchars($send_no);
				$send_time = htmlspecialchars($send_time);
				$db->query("UPDATE {$table} SET status=1,updatetime=$DT_TIME,send_type='$send_type',send_no='$send_no',send_time='$send_time' WHERE itemid=$itemid");
				dmsg('操作成功', '?page='.$page);
			} else {
				$head_title = $L['group_send_title'];
				$send_types = explode('|', trim($MOD['send_types']));
				$send_time = timetodate($DT_TIME, 3);
			}
		break;
	}
} else if($action == 'order') {//會員的訂單
	$sfields = $L['group_order_sfields'];
	$dfields = array('title', 'title ', 'amount', 'password', 'seller', 'send_type', 'send_no', 'note');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	$gid = isset($gid) ? intval($gid) : 0;
	(isset($seller) && check_name($seller)) or $seller = '';
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$status_select = dselect($dstatus, 'status', $L['status'], $status, '', 1, '', 1);
	$condition = "buyer='$_username'";
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
	if($status !== '') $condition .= " AND status='$status'";
	if($itemid) $condition .= " AND itemid='$itemid'";
	if($gid) $condition .= " AND gid='$gid'";
	if($seller) $condition .= " AND seller='$seller'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}group_order WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);		
	$lists = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}group_order WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	$amount = $fee = $money = 0;
	while($r = $db->fetch_array($result)) {
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
		$r['dstatus'] = $_status[$r['status']];
		$r['money'] = $r['amount'];
		$r['money'] = number_format($r['money'], 2, '.', '');
		$amount += $r['amount'];
		$lists[] = $r;
	}
	$money = $amount + $fee;
	$money = number_format($money, 2, '.', '');
	$forward = urlencode($DT_URL);
	$head_title = $L['group_order_title'];
} else {//商家的訂單
	//$MG['group_sell'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
	
	$sfields = $L['group_sfields'];
	$dfields = array('title', 'title ', 'amount', 'password', 'buyer', 'buyer_name', 'buyer_address', 'buyer_postcode', 'buyer_mobile', 'buyer_phone', 'send_type', 'send_no', 'note');
	$gid = isset($gid) ? intval($gid) : 0;
	(isset($buyer) && check_name($buyer)) or $buyer = '';
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$status_select = dselect($dstatus, 'status', $L['status'], $status, '', 1, '', 1);
	$condition = "seller='$_username'";
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
	if($status !== '') $condition .= " AND status='$status'";
	if($itemid) $condition .= " AND itemid=$itemid";
	if($gid) $condition .= " AND gid=$gid";
	if($buyer) $condition .= " AND buyer='$buyer'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);		
	$groups = array();
	$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	$amount = $fee = $money = 0;
	while($r = $db->fetch_array($result)) {
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
		$r['dstatus'] = $_status[$r['status']];
		$r['money'] = $r['amount'];
		$r['money'] = number_format($r['money'], 2, '.', '');
		$amount += $r['amount'];
		$groups[] = $r;
	}
	$money = $amount + $fee;
	$money = number_format($money, 2, '.', '');
	$forward = urlencode($DT_URL);
	$head_title = $L['group_title'];
}
include template('group', $module);
?>