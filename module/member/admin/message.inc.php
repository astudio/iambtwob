<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/message.class.php';
$menus = array (
    array('發送信件', '?moduleid='.$moduleid.'&file='.$file.'&action=send'),
    array('會員信件', '?moduleid='.$moduleid.'&file='.$file),
    array('系統信件', '?moduleid='.$moduleid.'&file='.$file.'&action=system'),
    array('郵件轉發', '?moduleid='.$moduleid.'&file='.$file.'&action=mail'),
    array('信件清理', '?moduleid='.$moduleid.'&file='.$file.'&action=clear'),
);
$do = new message;
$this_forward = '?moduleid='.$moduleid.'&file='.$file;

$NAME = array('普通', '詢價', '報價', '留言', '信使');

switch($action) {
	case 'send':
		if($submit) {
			if($do->_send($message)) {
				dmsg('發送成功', $this_forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			isset($touser) or $touser = '';
			include tpl('message_send', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			$do->_edit($message);
			dmsg('修改成功', '?moduleid='.$moduleid.'&file='.$file.'&action=system');
		} else {
			extract($do->get_one());
			include tpl('message_edit', $module);
		}
	break;
	case 'clear':
		if($submit) {
			if($do->_clear($message)) {
				dmsg('清理成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$todate = timetodate(strtotime('-1 year'), 3);
			include tpl('message_clear', $module);
		}
	break;
	case 'mail':
		if(isset($send)) {
			isset($num) or $num = 0;
			$hour = intval($hour);
			if(!$hour) $hour = 48;
			$pernum = intval($pernum);
			if(!$pernum) $pernum = 10;
			$pagesize = $pernum;
			$offset = ($page-1)*$pagesize;
			$time = $DT_TIME - $hour*3600;
			$result = $db->query("SELECT * FROM {$DT_PRE}message WHERE isread=0 AND issend=0 AND addtime<$time AND status=3 ORDER BY itemid DESC LIMIT $offset,$pagesize");
			$i = false;
			while($r = $db->fetch_array($result)) {
				$m = $db->get_one("SELECT email FROM {$DT_PRE}member WHERE username='$r[touser]' AND groupid>4");
				if(!$m) continue;
				$linkurl = linkurl($MODULE[2]['linkurl'], 2).'message.php?action=show&itemid='.$r['itemid'];
				$r['fromuser'] or $r['fromuser'] = '系統信使';
				$r['content'] = $r['fromuser'].' 於 '.timetodate($r['addtime'], 5).' 向您發送一封站內信，內容如下：<br/><br/>'.$r['content'].'<br/><br/>原始地址：<a href="'.$linkurl.'" target="_blank">'.$linkurl.'</a><br/><br/>此郵件通過 <a href="'.DT_PATH.'" target="_blank">'.$DT['sitename'].'</a> 郵件系統發出<br/><br/>如果您不希望收到類似郵件，請經常登錄網站查收站內信件或將未讀信件標記為已讀<br/><br/>';
				send_mail($m['email'], $r['title'], $r['content']);
				$db->query("UPDATE {$DT_PRE}message SET issend=1 WHERE itemid=$r[itemid]");
				$i = true;
				$num++;
			}
			if($i) {
				$page++;
				msg('已發送 '.$num.' 封郵件，系統將自動繼續，請稍候...', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&page='.$page.'&hour='.$hour.'&pernum='.$pernum.'&num='.$num.'&send=1');
			} else {
				file_put(DT_CACHE.'/message.dat', $DT_TIME);
				msg('郵件發送成功 共發送 '.$num.' 封郵件', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action, 5);
			}
		} else {
			$lasttime = is_file(DT_CACHE.'/message.dat') ? file_get(DT_CACHE.'/message.dat') : 0;
			$lasttime = $lasttime ? timetodate($lasttime, 5) : '';
			include tpl('message_mail', $module);
		}
	break;
	case '_delete':
		if(!$itemid) msg();
		$do->_delete($itemid);
		dmsg('刪除成功', $this_forward);
	break;
	case 'system':
		$messages = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}message WHERE groupids!='' ORDER BY itemid DESC");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['group'] = '<select>';
			$groupids = explode(',', $r['groupids']);
			foreach($groupids as $groupid) {
				$r['group'] .= '<option>'.$GROUP[$groupid]['groupname'].'</option>';
			}
			$r['group'] .= '</select>';
			$messages[] = $r;
		}
		include tpl('message_system', $module);
	break;
	case 'delete':
		if(!$itemid) msg();
		$do->itemid = $itemid;
		$do->delete();
		dmsg('刪除成功', $forward);
	break;
	case 'show':
		$itemid or msg();
		$do->itemid = $itemid;
		$item = $do->get_one();
		$item or msg();
		extract($item);
		include tpl('message_show', $module);		
	break;
	default:
		$sfields = array('標題', '發件人', '收件人', 'IP', '內容');
		$dfields = array('title', 'fromuser', 'touser', 'ip', 'content');
		$S = array('狀態', '草稿箱', '發件箱', '收件箱', '回收站');

		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$typeid = isset($typeid) ? intval($typeid) : -1;
		$read = isset($read) ? intval($read) : -1;
		$send = isset($send) ? intval($send) : -1;
		$status = isset($status) ? intval($status) : 0;

		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($S, 'status', '', $status);

		$condition = "groupids=''";
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($status) $condition .= " AND status=$status";
		if($typeid > -1) $condition .= " AND typeid=$typeid";
		if($read > -1) $condition .= " AND isread=$read";
		if($send > -1) $condition .= " AND issend=$send";

		$lists = $do->get_list($condition);
		include tpl('message', $module);
	break;
}
?>