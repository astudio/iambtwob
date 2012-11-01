<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/guestbook.class.php';
$do = new guestbook();
$menus = array (
    array('留言列表', '?moduleid='.$moduleid.'&file='.$file),
);
if($_catids || $_areaids) require DT_ROOT.'/admin/admin_check.inc.php';
if(in_array($action, array('', 'check'))) {
	$sfields = array('按條件', '留言標題', '會員名', '聯繫人', '聯繫電話', '電子郵件', 'QQ', '阿里旺旺', 'MSN','Skype','留言IP', '留言內容', '回復內容');
	$dfields = array('title','title','username','truename','telephone','email','qq','ali','msn','skype','ip','content','reply');
	$sorder  = array('結果排序方式', '留言時間降序', '留言時間升序', '回復時間降序', '回復時間升序');
	$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '1';
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
}
switch($action) {
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
			include tpl('guestbook_edit', $module);
		}
	break;
	case 'check':
		$itemid or msg('請選擇留言');
		$do->check($itemid, $status);
		dmsg('設置成功', $forward);
	break;
	case 'delete':
		$itemid or msg('請選擇留言');
		$do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	default:
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('guestbook', $module);
	break;
}
?>