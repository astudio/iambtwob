<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array($MOD['name'].'管理', '?moduleid='.$moduleid),
    array('訂單管理', '?moduleid='.$moduleid.'&file='.$file),
);
$_status = array(
	'<span style="color:#0000FF;">已付款</span>',
	'<span style="color:#FF0000;">已發貨</span>',
	'<span style="color:#FF6600;">已消費</span>',
	'<span style="color:#008000;">交易成功</span>',
	'<span style="color:#888888;text-decoration:line-through;">已退款</span>',
);
$dstatus = array(
	'已付款',
	'已發貨',
	'已消費',
	'交易成功',
	'已退款',
);
$table = $DT_PRE.'group_order';
switch($action) {
	case 'refund':
		$itemid or msg('未選擇記錄');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$i = 0;
		$result = $db->query("SELECT * FROM {$table} WHERE itemid IN ($itemids)");
		while($r = $db->fetch_array($result)) {
			if($r['status'] < 3) {
				$i++;
				$itemid = $r['itemid'];
				money_add($r['buyer'], $r['amount']);
				money_record($r['buyer'], $r['amount'], '站內', 'system', '團購退款', '訂單號:'.$itemid);			
				$db->query("UPDATE {$table} SET status=4,editor='$_username',updatetime=$DT_TIME WHERE itemid=$itemid");
			}
		}
		dmsg('退款成功'.$i.'個訂單', $forward);
	break;
	case 'show':
		$itemid or msg('未指定記錄');
		$td = $item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid ");
		$item or msg('記錄不存在');
		$item['money'] = $item['amount'];
		$item['addtime'] = timetodate($item['addtime'], 6);
		$item['updatetime'] = timetodate($item['updatetime'], 6);
		include tpl('order_show', $module);
	break;
	case 'delete':
		$itemid or msg('未選擇記錄');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('刪除成功', $forward);
	break;
	default:
		$sfields = array('按條件', '商品名稱', '賣家', '買家', '訂單金額', '密碼', '買家名稱', '買家地址', '買家郵編', '買家電話', '買家手機', '買家物流', '發貨物流', '發貨單號', '備註');
		$dfields = array('title', 'title', 'seller', 'buyer', 'amount', 'password', 'buyer_name', 'buyer_address', 'buyer_postcode', 'buyer_phone', 'buyer_mobile', 'buyer_receive', 'send_type', 'send_no', 'note');
		$sorder  = array('排序方式', '下單時間降序', '下單時間升序', '更新時間降序', '更新時間升序', '商品單價降序', '商品單價升序', '購買數量降序', '購買數量升序', '訂單金額降序', '訂單金額升序');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'updatetime DESC', 'updatetime ASC', 'price DESC', 'price ASC', 'number DESC', 'number ASC', 'amount DESC', 'amount ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		$itemid or $itemid = '';
		$gid = isset($gid) && $gid ? intval($gid) : '';
		isset($seller) or $seller = '';
		isset($buyer) or $buyer = '';
		isset($amounts) or $amounts = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($timetype) or $timetype = 'addtime';
		isset($mtype) or $mtype = 'money';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';
		$logistic = isset($logistic) ? intval($logistic) : '-1';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($dstatus, 'status', '狀態', $status, '', 1, '', 1);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($status !== '') $condition .= " AND status='$status'";
		if($seller) $condition .= " AND seller='$seller'";
		if($buyer) $condition .= " AND buyer='$buyer'";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($gid) $condition .= " AND gid=$gid";
		if($mtype == 'money') $mtype = "`amount`+`fee`";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
		if($logistic>-1) $condition .= " AND logistic=$logistic";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$amount = $fee = $money = 0;
		while($r = $db->fetch_array($result)) {
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
			$r['dstatus'] = $_status[$r['status']];
			$r['money'] = $r['amount'];
			$amount += $r['amount'];
			$lists[] = $r;
		}
		$money = $amount + $fee;
		include tpl('order', $module);
}
?>