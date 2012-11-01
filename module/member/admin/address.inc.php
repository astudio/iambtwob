<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/address.class.php';
$do = new address();
$menus = array (
    array('地址列表', '?moduleid='.$moduleid.'&file='.$file),
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
			include tpl('address_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('請選擇地址');
		$do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	default:
		$sfields = array('按條件', '姓名', '地址', '郵編', '手機', '電話', '會員', '備註');
		$dfields = array('address', 'truename', 'address', 'postcode', 'mobile', 'telephone', 'username', 'note');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($username) $condition .= " AND username='$username'";
		$lists = $do->get_list($condition, 'itemid DESC');
		include tpl('address', $module);
	break;
}
?>