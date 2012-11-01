<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('商品管理', '?moduleid='.$moduleid),
    array('訂單管理', '?moduleid='.$moduleid.'&file='.$file),
);
$_status = array(
	'<span style="color:#0000FF;">買家發起訂單<br/>等待賣家確認</span>',
	'<span style="color:#FF6600;">賣家已確認訂單<br/>等待買家付款</span>',
	'<span style="color:#008080;">買家已付款<br/>等待賣家發貨</span>',
	'<span style="color:#FF0000;">賣家已發貨<br/>等待買家確認</span>',
	'<span style="color:#008000;">交易成功</span>',
	'<span style="color:#FF0000;text-decoration:underline;">買家申請退款</span>',
	'<span style="color:#0000FF;text-decoration:underline;">已退款給買家</span>',
	'<span style="color:#FF6600;text-decoration:underline;">已付款給賣家</span>',
	'<span style="color:#888888;text-decoration:line-through;">買家關閉交易</span>',
	'<span style="color:#888888;text-decoration:line-through;">賣家關閉交易</span>',
);
$dstatus = array(
	'買家發起訂單,等待賣家確認',
	'賣家已確認訂單,等待買家付款',
	'買家已付款,等待賣家發貨',
	'賣家已發貨,等待買家確認',
	'交易成功',
	'買家申請退款',
	'已退款給買家',
	'已付款給賣家',
	'買家關閉交易',
	'賣家關閉交易',
);
$STARS = $L['star_type'];
$table = $DT_PRE.'mall_order';
if($action == 'refund' || $action == 'show' || $action == 'comment') {
	$itemid or msg('未指定記錄');
	$td = $item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid ");
	$item or msg('記錄不存在');
	$item['money'] = $item['amount'] + $item['fee'];
	$item['addtime'] = timetodate($item['addtime'], 6);
	$item['updatetime'] = timetodate($item['updatetime'], 6);
}
switch($action) {
	case 'refund':
		if($item['status'] != 5) msg('此交易無需受理');
		if($submit) {
			isset($status) or msg('請指定受理結果');
			$content or msg('請填寫操作理由');
			if($status == 6) {//已退款，買家勝 退款
				$db->query("UPDATE {$DT_PRE}member SET money=money+$item[money],locking=locking-$item[money] WHERE username='$item[buyer]'");
				$msg = '受理成功，交易狀態已經改變為 已退款給買家';
			} else if($status == 7) {//已退款，賣家勝 付款
				$db->query("UPDATE {$DT_PRE}member SET locking=locking-$item[money] WHERE username='$item[buyer]'");
				money_record($item['buyer'], -$item['money'], '站內', 'system', '訂單貨到付款', '訂單號:'.$itemid);
				money_add($item['seller'], $item['money']);
				money_record($item['seller'], $item['money'], '站內', 'system', '訂單貨到付款', '訂單號:'.$itemid);
				$msg = '受理成功，交易狀態已經改變為 已付款給賣家';
			} else {
				msg();
			}
			$db->query("UPDATE {$table} SET status=$status,editor='$_username',updatetime=$DT_TIME,refund_reason='$content' WHERE itemid=$itemid");
			msg($msg, $forward, 5);
		} else {
			include tpl('order_refund', $module);
		}
	break;
	case 'show':
		$cm = $db->get_one("SELECT * FROM {$DT_PRE}mall_comment WHERE itemid=$itemid");
		include tpl('order_show', $module);
	break;
	case 'comment':
		$cm = $db->get_one("SELECT * FROM {$DT_PRE}mall_comment WHERE itemid=$itemid");
		$cm or msg('評論不存在');
		$mallid = $item['mallid'];
		$post['seller_ctime'] = $post['seller_ctime'] ? strtotime($post['seller_ctime']) : 0;
		$post['seller_rtime'] = $post['seller_rtime'] ? strtotime($post['seller_rtime']) : 0;
		$post['buyer_ctime'] = $post['buyer_ctime'] ? strtotime($post['buyer_ctime']) : 0;
		$post['buyer_rtime'] = $post['buyer_rtime'] ? strtotime($post['buyer_rtime']) : 0;
		if($cm['seller_star'] != $post['seller_star']) {
			$s = $post['seller_star'];
			$s1 = 's'.$cm['seller_star'];
			$s2 = 's'.$post['seller_star'];
			$db->query("UPDATE {$DT_PRE}mall_order SET seller_star=$s WHERE itemid=$itemid");
			$db->query("UPDATE {$DT_PRE}mall_stat SET `$s2`=`$s2`+1 WHERE mallid=$mallid");
			if($cm['seller_star']) $db->query("UPDATE {$DT_PRE}mall_stat SET `$s1`=`$s1`-1 WHERE mallid=$mallid");
		}
		if($cm['buyer_star'] != $post['buyer_star']) {
			$s = $post['buyer_star'];
			$s1 = 'b'.$cm['buyer_star'];
			$s2 = 'b'.$post['buyer_star'];
			$db->query("UPDATE {$DT_PRE}mall_order SET buyer_star=$s WHERE itemid=$itemid");
			$db->query("UPDATE {$DT_PRE}mall_stat SET `$s2`=`$s2`+1 WHERE mallid=$mallid");
			if($cm['buyer_star']) $db->query("UPDATE {$DT_PRE}mall_stat SET `$s1`=`$s1`-1 WHERE mallid=$mallid");
		}
		$sql = '';
		foreach($post as $k=>$v) {
			$sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $db->query("UPDATE {$DT_PRE}mall_comment SET $sql WHERE itemid=$itemid");
		msg('修改成功', '?moduleid='.$moduleid.'&file='.$file.'&action=show&itemid='.$itemid.'#comment1');
	break;
	case 'delete':
		$itemid or msg('未選擇記錄');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('刪除成功', $forward);
	break;
	default:
		$sfields = array('按條件', '商品名稱', '賣家', '買家', '訂單金額', '附加金額', '附加名稱', '買家名稱', '買家地址', '買家郵編', '買家電話', '買家手機', '買家物流', '發貨物流', '發貨單號', '備註');
		$dfields = array('title', 'title', 'seller', 'buyer', 'amount', 'fee', 'fee_name', 'buyer_name', 'buyer_address', 'buyer_postcode', 'buyer_phone', 'buyer_mobile', 'buyer_receive', 'send_type', 'send_no', 'note');
		$sorder  = array('排序方式', '下單時間降序', '下單時間升序', '更新時間降序', '更新時間升序', '商品單價降序', '商品單價升序', '購買數量降序', '購買數量升序', '訂單金額降序', '訂單金額升序', '附加金額降序', '附加金額升序');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'updatetime DESC', 'updatetime ASC', 'price DESC', 'price ASC', 'number DESC', 'number ASC', 'amount DESC', 'amount ASC', 'fee DESC', 'fee ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		$itemid or $itemid = '';
		$mallid = isset($mallid) && $mallid ? intval($mallid) : '';
		$seller_star = isset($seller_star) ? intval($seller_star) : 0;
		$buyer_star = isset($buyer_star) ? intval($buyer_star) : 0;
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
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($dstatus, 'status', '狀態', $status, 'style="width:200px;"', 1, '', 1);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($status !== '') $condition .= " AND status='$status'";
		if($seller) $condition .= " AND seller='$seller'";
		if($buyer) $condition .= " AND buyer='$buyer'";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($mallid) $condition .= " AND mallid=$mallid";
		if($seller_star) $condition .= " AND seller_star=$seller_star";
		if($buyer_star) $condition .= " AND buyer_star=$buyer_star";
		if($mtype == 'money') $mtype = "`amount`+`fee`";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$amount = $fee = $money = 0;
		while($r = $db->fetch_array($result)) {
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
			$r['dstatus'] = $_status[$r['status']];
			$r['money'] = $r['amount'] + $r['fee'];
			$amount += $r['amount'];
			$fee += $r['fee'];
			$lists[] = $r;
		}
		$money = $amount + $fee;
		include tpl('order', $module);
}
?>