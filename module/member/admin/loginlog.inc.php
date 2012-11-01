<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('登錄日誌', '?moduleid='.$moduleid.'&file='.$file),
    array('日誌清理', '?moduleid='.$moduleid.'&file='.$file.'&action=delete', 'onclick="if(!confirm(\'為了系統安全,系統僅刪除30天之前的日誌\')) return false"'),
);
switch($action) {
	case 'md':
		echo md5(md5($password));
		exit;
	break;
	case 'cp':
		$r = $db->get_one("SELECT password FROM {$DT_PRE}login WHERE logid='$logid'");
		echo $r['password'] == $password ? '匹配' : '不匹配';
		exit;
	break;
	case 'delete':
		$time = $DT_TIME - 30*24*3600;
		$db->query("DELETE FROM {$DT_PRE}login WHERE logintime<$time");
		dmsg('清理成功', '?moduleid='.$moduleid.'&file='.$file);
	break;
	default:
		$sfields = array('按條件', '結果', '會員', '密碼', 'IP', '客戶端');
		$dfields = array('message', 'message', 'username', 'password', 'loginip', 'agent');
		isset($admin) or $admin = -1;
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$ip = isset($ip) ? $ip : '';
		$username = isset($username) ? $username : '';
		$fromdate = isset($fromdate) ? $fromdate : '';
		$fromtime = is_date($fromdate) ? strtotime($fromdate.' 0:0:0') : 0;
		$todate = isset($todate) ? $todate : '';
		$totime = is_date($todate) ? strtotime($todate.' 23:59:59') : 0;


		$fields_select = dselect($sfields, 'fields', '', $fields);

		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND logintime>$fromtime";
		if($totime) $condition .= " AND logintime<$totime";
		if($ip) $condition .= " AND loginip='$ip'";
		if($username) $condition .= " AND username='$username'";
		if($admin > -1) $condition .= " AND admin='$admin'";
	
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}login WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		
		$logs = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}login WHERE $condition ORDER BY logid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['password'] = substr($r['password'], 0, 10).'************'.substr($r['password'], 20);
			$r['logintime'] = timetodate($r['logintime'], 6);
			$logs[] = $r;
		}
		include tpl('loginlog', $module);
	break;
}
?>