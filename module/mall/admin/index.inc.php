<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/mall.class.php';
$do = new mall($moduleid);
$menus = array (
    array('添加商品', '?moduleid='.$moduleid.'&action=add'),
    array('商品列表', '?moduleid='.$moduleid),
    array('審核商品', '?moduleid='.$moduleid.'&action=check'),
    array('下架商品', '?moduleid='.$moduleid.'&action=expire'),
    array('未通過商品', '?moduleid='.$moduleid.'&action=reject'),
    array('回收站', '?moduleid='.$moduleid.'&action=recycle'),
    array('移動分類', '?moduleid='.$moduleid.'&action=move'),
);

if(in_array($action, array('add', 'edit'))) {
	$FD = cache_read('fields-'.substr($table, strlen($DT_PRE)).'.php');
	if($FD) require DT_ROOT.'/include/fields.func.php';
	isset($post_fields) or $post_fields = array();
	$CP = $MOD['cat_property'];
	if($CP) require DT_ROOT.'/include/property.func.php';
	isset($post_ppt) or $post_ppt = array();
}

if($_catids || $_areaids) require DT_ROOT.'/admin/admin_check.inc.php';

if(in_array($action, array('', 'check', 'expire', 'reject', 'recycle'))) {
	$sfields = array('模糊',  '商品名稱', '商品品牌',  '簡介', '公司名', '聯繫人', '聯繫電話', '聯繫地址', '電子郵件', '聯繫MSN', '聯繫QQ', '會員名', 'IP');
	$dfields = array('keyword', 'title', 'brand', 'introduce', 'company', 'truename', 'telephone', 'address', 'email', 'msn', 'qq','username', 'ip');
	$sorder  = array('結果排序方式', '更新時間降序', '更新時間升序', '添加時間降序', '添加時間升序', VIP.'級別降序', VIP.'級別升序', '商品單價降序', '商品單價升序', '訂單數量降序', '訂單數量升序', '銷售數量降序', '銷售數量升序', '庫存總量降序', '庫存總量升序', '評論次數降序', '評論次數升序', '瀏覽人氣降序', '瀏覽人氣升序', '信息ID降序', '信息ID升序');
	$dorder  = array($MOD['order'], 'edittime DESC', 'edittime ASC', 'addtime DESC', 'addtime ASC', 'vip DESC', 'vip ASC', 'price DESC', 'price DESC', 'orders DESC', 'orders ASC', 'sales DESC', 'sales ASC', 'amount DESC', 'amount ASC', 'comments DESC', 'comments ASC', 'hits DESC', 'hits ASC', 'itemid DESC', 'itemid ASC');

	$level = isset($level) ? intval($level) : 0;
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$elite = isset($elite) ? intval($elite) : 0;
	$price = isset($price) ? intval($price) : 0;

	isset($datetype) && in_array($datetype, array('edittime', 'addtime')) or $datetype = 'edittime';
	$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
	$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
	$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
	$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
	
	$minprice = isset($minprice) ? dround($minprice) : '';
	$minprice or $minprice = '';
	$maxprice = isset($maxprice) ? dround($maxprice) : '';
	$maxprice or $maxprice = '';
	$minorders = isset($minorders) ? intval($minorders) : '';
	$minorders or $minorders = '';
	$maxorders = isset($maxorders) ? intval($maxorders) : '';
	$maxorders or $maxorders = '';
	$minsales = isset($minsales) ? intval($minsales) : '';
	$minsales or $minsales = '';
	$maxsales = isset($maxsales) ? intval($maxsales) : '';
	$maxsales or $maxsales = '';
	$minamount = isset($minamount) ? intval($minamount) : '';
	$minamount or $minamount = '';
	$maxamount = isset($maxamount) ? intval($maxamount) : '';
	$maxamount or $maxamount = '';
	$mincomments = isset($mincomments) ? intval($mincomments) : '';
	$mincomments or $mincomments = '';
	$maxcomments = isset($maxcomments) ? intval($maxcomments) : '';
	$maxcomments or $maxcomments = '';
	$minvip = isset($minvip) ? intval($minvip) : '';
	$minvip or $minvip = '';
	$maxvip = isset($maxvip) ? intval($maxvip) : '';
	$maxvip or $maxvip = '';
	$itemid or $itemid = '';

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$level_select = level_select('level', '級別', $level);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($_childs) $condition .= " AND catid IN (".$_childs.")";//CATE
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($catid) $condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";

	if($level) $condition .= " AND level=$level";
	if($elite) $condition .= " AND elite>0";
	if($price) $condition .= " AND price>0";
	if($minprice)  $condition .= " AND price>=$minprice";
	if($maxprice)  $condition .= " AND price<=$maxprice";
	if($minorders)  $condition .= " AND orders>=$minorders";
	if($maxorders)  $condition .= " AND orders<=$maxorders";
	if($minsales)  $condition .= " AND sales>=$minsales";
	if($maxsales)  $condition .= " AND sales<=$maxsales";
	if($minamount)  $condition .= " AND amount>=$minamount";
	if($maxamount)  $condition .= " AND amount<=$maxamount";
	if($mincomments)  $condition .= " AND comments>=$mincomments";
	if($maxcomments)  $condition .= " AND comments<=$maxcomments";
	if($minvip)  $condition .= " AND vip>=$minvip";
	if($maxvip)  $condition .= " AND vip<=$maxvip";
	if($fromtime) $condition .= " AND `$datetype`>=$fromtime";
	if($totime) $condition .= " AND `$datetype`<=$totime";
	if($itemid) $condition = " AND itemid=$itemid";

	$timetype = strpos($dorder[$order], 'add') !== false ? 'add' : '';
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				if($FD) fields_check($post_fields);
				if($CP) property_check($post_ppt);
				$do->add($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				if($CP) property_update($post_ppt, $moduleid, $post['catid'], $do->itemid);
				dmsg('添加成功', '?moduleid='.$moduleid.'&action='.$action);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$content = '';
			$status = 3;
			$addtime = timetodate($DT_TIME);
			$username = $_username;
			$item = array();
			$menuid = 0;
			$tname = $menus[$menuid][0];
			isset($url) or $url = '';
			if($url) {
				$tmp = fetch_url($url);
				if($tmp) extract($tmp);
			}
			include tpl('edit', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->pass($post)) {
				if($FD) fields_check($post_fields);
				if($CP) property_check($post_ppt);
				$do->edit($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				if($CP) property_update($post_ppt, $moduleid, $post['catid'], $do->itemid);
				dmsg('修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$item = $do->get_one();
			extract($item);
			$addtime = timetodate($addtime);
			$menuon = array('5', '4', '2', '1', '3');
			$menuid = $menuon[$status];
			$tname = '修改'.$MOD['name'];
			include tpl($action, $module);
		}
	break;
	case 'move':
		if($submit) {
			$fromids or msg('請填寫來源ID');
			if($tocatid) {
				$db->query("UPDATE {$table} SET catid=$tocatid WHERE `{$fromtype}` IN ($fromids)");
				dmsg('移動成功', $forward);
			} else {
				msg('請選擇目標分類');
			}
		} else {
			$itemid = $itemid ? implode(',', $itemid) : '';
			$menuid = 5;
			include tpl($action, $module);
		}
	break;
	case 'update':
		is_array($itemid) or msg('請選擇商品');
		foreach($itemid as $v) {
			$do->update($v);
		}
		dmsg('更新成功', $forward);
	break;
	case 'tohtml':
		is_array($itemid) or msg('請選擇商品');
		foreach($itemid as $itemid) {
			tohtml('show', $module);
		}
		dmsg('更新成功', $forward);
	break;
	case 'delete':
		$itemid or msg('請選擇商品');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	case 'restore':
		$itemid or msg('請選擇商品');
		$do->restore($itemid);
		dmsg('還原成功', $forward);
	break;
	case 'refresh':
		$itemid or msg('請選擇商品');
		$do->refresh($itemid);
		dmsg('刷新成功', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('清空成功', $forward);
	break;
	case 'level':
		$itemid or msg('請選擇商品');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('級別設置成功', $forward);
	break;
	case 'type':
		$itemid or msg('請選擇商品');
		$tid = intval($tid);
		array_key_exists($tid, $TYPE) or $tid = 0;
		$do->type($itemid, $tid);
		dmsg('類型設置成功', $forward);
	break;
	case 'recycle':
		$lists = $do->get_list('status=0'.$condition, $dorder[$order]);
		$menuid = 5;
		include tpl('index', $module);
	break;
	case 'reject':
		if($itemid && !$psize) {
			$do->reject($itemid);
			dmsg('拒絕成功', $forward);
		} else {
			$lists = $do->get_list('status=1'.$condition, $dorder[$order]);
			$menuid = 4;
			include tpl('index', $module);
		}
	break;
	case 'expire':
		if($itemid && !$psize) {
			$do->unsale($itemid);
			dmsg('下架成功', $forward);
		} else {
			$lists = $do->get_list('status=4'.$condition);
			$menuid = 3;
			include tpl('index', $module);
		}
	break;
	case 'onsale':
		$itemid or msg('請選擇商品');
		$do->onsale($itemid);
		dmsg('上架成功', $forward);
	break;
	case 'check':
		if($itemid && !$psize) {
			$do->check($itemid);
			dmsg('審核成功', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			$menuid = 2;
			include tpl('index', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 1;
		include tpl('index', $module);
	break;
}
?>