<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array($DT['credit_name'].'獎懲', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array($DT['credit_name'].'記錄', '?moduleid='.$moduleid.'&file='.$file),
);
$BANKS = explode('|', trim($MOD['pay_banks']));
$table = $DT_PRE.'finance_credit';
switch($action) {
	case 'add':
		if($submit) {
			$username or msg('請填寫會員名');
			$amount or msg('請填寫分值');
			$reason or msg('請填寫事由');
			$amount = intval($amount);
			if($amount <= 0) msg('分值格式錯誤');
			if(!$type) $amount = -$amount;
			$error = '';
			$success = 0;
			$usernames = explode("\n", trim($username));
			foreach($usernames as $username) {
				$username = trim($username);
				if(!$username) continue;
				$r = $db->get_one("SELECT username,credit FROM {$DT_PRE}member WHERE username='$username'");
				if(!$r) {
					$error .= '<br/>會員['.$username.']不存在';
					continue;
				}
				if(!$type && $r['credit'] < abs($amount)) {
					$error .= '<br/>會員['.$username.']'.$DT['credit_name'].'不足，當前'.$DT['credit_name'].'為:'.$r['credit'];
					continue;
				}
				$reason or $reason = '獎勵';
				$note or $note = '手工';
				credit_add($username, $amount);
				credit_record($username, $amount, $_username, $reason, $note);
			}
			if($error) message('操作成功 '.$success.' 位會員，發生以下錯誤：'.$error);
			dmsg('操作成功', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			isset($username) or $username = '';
			if(isset($userid)) {
				if($userid) {
					$userids = is_array($userid) ? implode(',', $userid) : $userid;					
					$result = $db->query("SELECT username FROM {$DT_PRE}member WHERE userid IN ($userids)");
					while($r = $db->fetch_array($result)) {
						$username .= $r['username']."\n";
					}
				}
			}
			include tpl('credit_add', $module);
		}
	break;
	case 'delete':
		$itemid or msg('未選擇記錄');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('刪除成功', $forward);
	break;
	default:
		$sfields = array('按條件', '會員名', '金額', '事由', '備註', '操作人');
		$dfields = array('username', 'username', 'amount', 'reason', 'note', 'editor');
		$sorder  = array('排序方式', '金額降序', '金額升序', '時間降序', '時間升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		isset($mtype) or $mtype = 'amount';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';

		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($type) $condition .= $type == 1 ? " AND amount>0" : " AND amount<0";
		if($username) $condition .= " AND username='$username'";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$records = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$income = $expense = 0;
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['amount'] > 0 ? $income += $r['amount'] : $expense += $r['amount'];
			$records[] = $r;
		}
		include tpl('credit', $module);
	break;
}
?>