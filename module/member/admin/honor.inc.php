<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/honor.class.php';
$do = new honor();
$menus = array (
    array('添加證書', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('證書列表', '?moduleid='.$moduleid.'&file='.$file),
    array('審核證書', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('過期證書', '?moduleid='.$moduleid.'&file='.$file.'&action=expire'),
    array('未通過證書', '?moduleid='.$moduleid.'&file='.$file.'&action=reject'),
    array('回收站', '?moduleid='.$moduleid.'&file='.$file.'&action=recycle'),
);
if(in_array($action, array('', 'check', 'expire', 'reject', 'recycle'))) {
	$sfields = array('按條件', '證書名稱', '發證機構', '會員名');
	$dfields = array('title', 'title', 'authority', 'username');
	$sorder  = array('結果排序方式', '添加時間降序', '添加時間升序', '修改時間降序', '修改時間升序', '發證時間降序', '發證時間升序', '到期時間降序', '到期時間升序');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catid='.$post['catid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$content = '';
			$username = $_username;
			$status = 3;
			$addtime = timetodate($DT_TIME);
			$menuid = 0;
			include tpl('honor_edit', $module);
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
			$addtime = timetodate($addtime);
			$fromtime = timetodate($fromtime, 3);
			$totime = $totime ? timetodate($totime, 3) : '';
			$menuon = array('5', '4', '2', '1', '3');
			$menuid = $menuon[$status];
			include tpl('honor_edit', $module);
		}
	break;
	case 'recycle':
		$lists = $do->get_list('status=0'.$condition, $dorder[$order]);
		include tpl('honor_recycle', $module);
	break;
	case 'expire':
		if(isset($refresh)) {
			if(isset($delete)) {
				$days = isset($days) ? intval($days) : 0;
				$days or msg('請填寫天數');
				$do->clear("status=4 AND totime>0 AND totime<$DT_TIME-$days*24*3600");
				dmsg('刪除成功', $forward);
			} else {
				$do->expire();
				dmsg('刷新成功', $forward);
			}
		} else {
			$lists = $do->get_list('status=4'.$condition);
			include tpl('honor_expire', $module);
		}
	break;
	case 'check':
		if($itemid && !$psize) {
			$do->check($itemid);
			dmsg('審核成功', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			include tpl('honor_check', $module);
		}
	break;
	case 'reject':
		if($itemid && !$psize) {
			$do->reject($itemid);
			dmsg('拒絕成功', $forward);
		} else {
			$lists = $do->get_list('status=1'.$condition, $dorder[$order]);
			include tpl('honor_reject', $module);
		}
	break;
	case 'delete':
		$itemid or msg('請選擇證書');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	case 'restore':
		$itemid or msg('請選擇證書');
		$do->restore($itemid);
		dmsg('還原成功', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('清空成功', $forward);
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		include tpl('honor', $module);
	break;
}
?>