<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/grade.class.php';
$do = new grade();
$menus = array (
    array('升級記錄', '?moduleid='.$moduleid.'&file='.$file),
    array('審核申請', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('拒絕記錄', '?moduleid='.$moduleid.'&file='.$file.'&action=reject'),
    array(VIP.'管理', '?moduleid=4&file=vip'),
);
if(in_array($action, array('', 'check', 'reject'))) {
	$sfields = array('按條件', '公司名', '會員名', '聯繫人', '電話', '手機', 'Email', 'MSN', 'QQ', 'IP', '附言', '備註', '優惠碼');
	$dfields = array('company', 'company', 'username', 'truename', 'telephone', 'mobile', 'email', 'msn', 'qq', 'ip', 'content', 'note', 'promo_code');
	$sorder  = array('結果排序方式', '申請時間降序', '申請時間升序', '受理時間降序', '受理時間升序', '付款金額降序', '付款金額升序');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC', 'amount DESC', 'amount ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
}
$menuon = array('4', '2', '1', '0');
switch($action) {
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->edit($post)) {
				dmsg('操作成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$user = $username ? userinfo($username) : array();
			$addtime = timetodate($addtime);
			$edittime = timetodate($edittime);
			$fromtime = timetodate($DT_TIME, 3);
			$days =  $promo_amount && $promo_type == 1 ? $promo_amount : 365;
			$totime = timetodate($DT_TIME + 86400*$days);
			$UG = cache_read('group-'.$groupid.'.php');
			$fee = $UG['fee'];
			$pay = $fee - $amount;
			if($promo_amount) {
				$pay = $promo_type == 1 ? 0 : $pay - $promo_amount;
			}
			include tpl('grade_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('請選擇記錄');
		$do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	case 'reject':
		$status = 1;
		$lists = $do->get_list('status='.$status.$condition, $dorder[$order]);
		include tpl('grade', $module);
	break;
	case 'check':
		$status = 2;
		$lists = $do->get_list('status='.$status.$condition, $dorder[$order]);
		include tpl('grade', $module);
	break;
	default:
		$status = 3;
		$lists = $do->get_list('status='.$status.$condition, $dorder[$order]);
		include tpl('grade', $module);
	break;
}
?>