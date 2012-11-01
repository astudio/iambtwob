<?php
defined('IN_DESTOON') or exit('Access Denied');
$TYPE = get_type('style', 1);
require MD_ROOT.'/style.class.php';
$do = new style();
$menus = array (
    array('安裝模板', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('模板列表', '?moduleid='.$moduleid.'&file='.$file),
    array('模板分類', '?file=type&item=style'),
);

switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action);
			} else {
				msg($do->errmsg);
			}
		} else {
			$addtime = timetodate($DT_TIME);
			include tpl('style_add', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$groupid = substr($groupid, 1, -1);
			$addtime = timetodate($addtime);
			include tpl('style_edit', $module);
		}
	break;
	case 'show':
		$itemid or msg();
		$u = $db->get_one("SELECT username FROM {$DT_PRE}company ORDER BY vip DESC");
		dheader(DT_PATH.'index.php?homepage='.$u['username'].'&preview='.$itemid);
	break;
	case 'order':
		$do->order($listorder);
		dmsg('更新成功', $forward);
	break;
	case 'delete':
		$itemid or msg('請選擇模板');
		$do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	default:
		$sfields = array('按條件', '模板名稱', '風格目錄', '模板目錄', '作者');
		$dfields = array('title', 'title', 'skin', 'template', 'author');
		$sorder  = array('結果排序方式', '模板價格降序', '模板價格升序', $DT['money_name'].'收益降序', $DT['money_name'].'收益升序', $DT['credit_name'].'收益降序', $DT['credit_name'].'收益升序', '使用人數降序', '使用人數升序', '添加時間降序', '添加時間升序');
		$dorder  = array('listorder DESC,addtime DESC', 'fee DESC', 'fee ASC', 'money DESC', 'money ASC', 'credit DESC', 'credit ASC', 'hits DESC', 'hits ASC', 'addtime DESC', 'addtime ASC');
	
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$groupid = isset($groupid) ? intval($groupid) : 0;
		$typeid = isset($typeid) ? intval($typeid) : 0;
		isset($currency) or $currency = '';
		isset($minfee) or $minfee = '';
		isset($maxfee) or $maxfee = '';
	
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$type_select = type_select('style', 1, 'typeid', '請選擇分類', $typeid);
	
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($groupid) $condition .= " AND groupid LIKE '%,$groupid,%'";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($currency) $condition .= $currency == 'free' ? " AND fee=0" : " AND currency='$currency'";
		if($minfee) $condition .= " AND fee>=$minfee";
		if($maxfee) $condition .= " AND fee<=$maxfee";
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('style', $module);
	break;
}
?>