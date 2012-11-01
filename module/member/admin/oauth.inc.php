<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('一鍵登錄', '?moduleid='.$moduleid.'&file=online'),
    array('接口設置', '?moduleid='.$moduleid.'&file=setting&tab=5'),
);
switch($action) {
	case 'delete':
		$itemid or msg('請選擇記錄');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$DT_PRE}oauth WHERE itemid IN ($itemids)");
		dmsg('解除成功', $forward);
	break;
	default:
		$OAUTH = cache_read('oauth.php');
		$sfields = array('按條件', '會員名', '暱稱', '平台', '頭像', '網址');
		$dfields = array('username', 'username', 'nickname', 'site', 'avatar', 'url');
		$sorder  = array('結果排序方式', '綁定時間降序', '綁定時間升序', '登錄時間降序', '登錄時間升序', '登錄次數降序', '登錄次數升序');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'logintime DESC', 'logintime ASC', 'logintimes DESC', 'logintimes ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($site) or $site = '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$thumb = isset($thumb) ? intval($thumb) : 0;
		$link = isset($link) ? intval($link) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($site) $condition .= " AND site='$site'";		
		if($thumb) $condition .= " AND avatar<>''";
		if($link) $condition .= " AND url<>''";
		$order = $dorder[$order];
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}oauth WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$members = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}oauth WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['logindate'] = timetodate($r['logintime'], 5);
			$r['avatar'] or $r['avatar'] = DT_PATH.'api/oauth/avatar.png';
			$members[] = $r;
		}
		include tpl('oauth', $module);
	break;
}
?>