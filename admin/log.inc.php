<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('操作日誌', '?file='.$file),
    array('日誌清理', '?file='.$file.'&action=delete', 'onclick="if(!confirm(\'為了系統安全,系統僅刪除30天之前的日誌\')) return false"'),
);
switch($action) {
	case 'delete':
		$time = $DT_TIME - 30*24*3600;
		$db->query("DELETE FROM {$DT_PRE}admin_log WHERE logtime<$time");
		dmsg('清理成功', '?file='.$file);
	break;
	default:
		$sfields = array('按條件', '網址', '管理員', 'IP');
		$dfields = array('qstring', 'qstring', 'username', 'ip');
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
		if($fromtime) $condition .= " AND logtime>$fromtime";
		if($totime) $condition .= " AND logtime<$totime";
		if($ip) $condition .= " AND ip='$ip'";
		if($username) $condition .= " AND username='$username'";
	
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}admin_log WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}admin_log WHERE $condition ORDER BY logid DESC LIMIT $offset,$pagesize");
		$F = array(
			'index' => '列表',
			'setting' => '設置',
			'category' => '欄目管理',
			'type' => '分類管理',
			'keylink' => '關聯鏈接',
			'split' => '數據拆分',
			'html' => '更新數據',
			'mymenu' => '定義面板',
			'module' => '模塊管理',
			'area' => '地區管理',
			'admin' => '管理員管理',
			'html' => '更新全站',
			'database' => '數據庫',
			'template' => '模板管理',
			'tag' => '標籤嚮導',
			'skin' => '風格管理',
			'scan' => '木馬掃瞄',
			'log' => '後台日誌',
			'upload' => '上傳記錄',
			'404' => '404日誌',
			'keyword' => '搜索記錄',
			'question' => '問題驗證',
			'banword' => '詞語過濾',
			'repeat' => '重名檢測',
			'banip' => '禁止IP',
			'fetch' => '單頁采編',
			'contact' => '聯繫會員',
			'grade' => '會員升級',
			'group' => '會員組',
			'vip' => VIP.'管理',
			'credit' => '榮譽資質',
			'news' => '公司新聞',
			'link' => '友情鏈接',
			'style' => '公司模板',
			'record' => '資金管理',
			'credits' => '積分管理',
			'charge' => '充值記錄',
			'trade' => '交易記錄',
			'cash' => '提現記錄',
			'pay' => '信息支付',
			'card' => '充值卡',
			'promo' => '優惠碼',
			'ask' => '客服中心',
			'validate' => '資料認證',
			'sendmail' => '電子郵件',
			'sms' => '手機短信',
			'alert' => '貿易提醒',
			'mail' => '郵件訂閱',
			'message' => '站內信件',
			'favorite' => '商機收藏',
			'friend' => '會員商友',
			'loginlog' => '登錄日誌',
			'spread' => '排名推廣',
			'ad' => '廣告管理',
			'announce' => '公告管理',
			'webpage' => '單頁管理',
			'comment' => '評論管理',
			'guestbook' => '留言管理',
			'vote' => '投票管理',
		);
		$A = array(
			'add' => '添加',
			'edit' => '修改',
			'delete' => '<span class="f_red">刪除</span>',
			'check' => '審核',
			'level' => '級別',
			'order' => '排序',
			'update' => '更新',
			'send' => '發送',
		);
		while($r = $db->fetch_array($result)) {
			parse_str($r['qstring'], $t);
			$m = isset($t['moduleid']) ? $t['moduleid'] : 1;
			$r['mid'] = $m;
			$r['module'] = $MODULE[$m]['name'];
			$f = isset($t['file']) ? $t['file'] : 'index';
			if(isset($F[$f])) $f = $F[$f];
			$r['file'] = $f;
			$a = isset($t['action']) ? $t['action'] : '';
			if(isset($A[$a])) $a = $A[$a];
			$r['action'] = $a;
			$i = isset($t['itemid']) ? $t['itemid'] : (isset($t['userid']) ? $t['userid'] : '');
			$r['itemid'] = $i;
			$r['logtime'] = timetodate($r['logtime'], 6);
			$lists[] = $r;
		}
		include tpl('log');
	break;
}
?>