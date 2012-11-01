<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('資料認證', '?moduleid='.$moduleid.'&file='.$file),
);
$table = $DT_PRE.'validate';
switch($action) {
	case 'delete':
		$itemid or msg('請選擇記錄');
		foreach($itemid as $id) {
			$r = $db->get_one("SELECT * FROM {$table} WHERE itemid=$id");
			$userid = get_user($r['username']);
			if($r['thumb']) delete_upload($r['thumb'], $userid);
			if($r['thumb1']) delete_upload($r['thumb1'], $userid);
			if($r['thumb2']) delete_upload($r['thumb2'], $userid);
			$db->query("DELETE FROM {$table} WHERE itemid=$id");
		}
		dmsg('刪除成功', $forward);
	break;
	case 'check':
		$itemid or msg('請選擇記錄');
		foreach($itemid as $id) {
			$r = $db->get_one("SELECT * FROM {$table} WHERE itemid='$id' AND status=2");
			if($r) {
				$value = $r['title'];
				$username = $r['username'];
				$fd = $r['type'];
				$vfd = 'v'.$r['type'];
				$db->query("UPDATE {$DT_PRE}member SET `{$fd}`='$value',`{$vfd}`=1 WHERE username='$username'");
				if($fd == 'company') $db->query("UPDATE {$DT_PRE}company SET `company`='$value' WHERE username='$username'");
				$db->query("UPDATE {$table} SET status=3,editor='$_username',edittime='$DT_TIME' WHERE itemid='$id'");
			}
		}
		dmsg('認證成功', $forward);		
	break;
	default:
		$V = array('company'=>'公司認證', 'truename'=>'實名認證', 'mobile'=>'手機認證', 'email'=>'郵件認證');
		$sfields = array('按條件', '認證項', '會員名', '操作人');
		$dfields = array('title', 'title', 'username', 'editor');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($type) or $type = '';
		$status = isset($status) ? intval($status) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($type) $condition .= " AND type='$type'";
		if($status) $condition .= " AND status=$status";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$lists[] = $r;
		}
		include tpl('validate', $module);
	break;
}
?>