<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('生成優惠碼', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('優惠碼管理', '?moduleid='.$moduleid.'&file='.$file),
);
$table = $DT_PRE.'finance_promo';
switch($action) {
	case 'add':
		if($submit) {
			$amount = dround($amount);
			if($amount <= 0) msg('優惠額度格式錯誤');
			$prefix_length = strlen($prefix);
			$number_length = intval($number_length);
			if($number_length < 8) msg('優惠碼不能少於8位');
			$rand_length = $number_length - $prefix_length;
			if($rand_length < 4)  msg('優惠碼長度和前綴長度差不能少於4位');
			$number_part = trim($number_part);
			if(!preg_match("/^[0-9a-zA-z]{6,}$/", $number_part)) msg('優惠碼只能由6位以上數字和字母組成');
			$totime = strtotime($totime);
			if($totime < $DT_TIME) msg('過期時間必須在當前時間之後');
			$total = intval($total);
			$total or $total = 100;
			$reuse = $reuse ? 1 : 0;
			$t = 0;
			for($i = 0; $i < $total; $i++) {
				$number = $prefix.random($rand_length, $number_part);
				if($db->get_one("SELECT itemid FROM {$table} WHERE number='$number'")) {
					$i--;
				} else {
					$t++;
					$db->query("INSERT INTO {$table} (number,type,amount,reuse,editor,addtime,totime) VALUES('$number','$type','$amount','$reuse','$_username','$DT_TIME','$totime')");
				}
			}
			msg('成功生成 '.$t.' 個', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			$prefix = strtoupper(random(4));
			$totime = (timetodate($DT_TIME, "Y") + 3).timetodate($DT_TIME, '-m-d');
			include tpl('promo_add', $module);
		}
	break;
	case 'delete':
		$itemid or msg('未選擇記錄');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('刪除成功', $forward);
	break;
	default:
		$print = isset($print) ? 1 : 0;
		$sfields = array('按條件', '優惠碼', '密碼', '面額', '會員', 'IP', '操作人');
		$dfields = array('number', 'number', 'password', 'amount', 'username', 'ip', 'editor');
		$sorder  = array('排序方式', '面額降序', '面額升序', '使用時間降序', '使用時間升序', '到期時間降序', '到期時間升序', '製作時間降序', '製作時間升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'updatetime DESC', 'updatetime ASC', 'totime DESC', 'totime ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($number) or $number = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';
		isset($status) or $status = 0;
		isset($timetype) or $timetype = 'updatetime';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields]='$keyword'";
		if($print) $condition .= " AND updatetime=0  AND totime>$DT_TIME";

		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($username) $condition .= " AND username='$username'";
		if($number) $condition .= " AND number='$number'";
		if($minamount != '') $condition .= " AND amount>=$minamount";
		if($maxamount != '') $condition .= " AND amount<=$maxamount";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$income = $expense = 0;
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['totime'] = timetodate($r['totime'], 3);
			$r['updatetime'] = $r['updatetime'] ? ($r['updatetime'] > 1260000000 ? timetodate($r['updatetime'], 5) : $r['updatetime']) : '';			
			$lists[] = $r;
		}
		include tpl('promo', $module);
	break;
}
?>