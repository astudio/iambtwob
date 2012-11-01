<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/friend.class.php';
$do = new friend();
$menus = array (
    array('商友列表', '?moduleid='.$moduleid.'&file='.$file),
);

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
			include tpl('friend_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('請選擇商友');
		$do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	default:
		$sfields = array('按條件', '姓名', '公司', '職位', '電話', '手機', '主頁', 'Email', 'MSN', 'QQ', '會員', '備註');
		$dfields = array('company', 'truename', 'company', 'career', 'telephone', 'mobile', 'homepage', 'email', 'msn', 'qq', 'username', 'note');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$userid = isset($userid) ? intval($userid) : '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($userid) $condition .= " AND userid=$userid";
		$lists = $do->get_list($condition);
		include tpl('friend', $module);
	break;
}
?>