<?php
defined('IN_DESTOON') or exit('Access Denied');
$specialid = isset($specialid) ? intval($specialid) : 0;
$specialid or msg('請選擇'.$MOD['name']);
$special = $db->get_one("SELECT * FROM {$table} WHERE itemid=$specialid");
$special or msg($MOD['name'].'不存在');
!$special['islink'] or msg($MOD['name'].'為外部鏈接，無需添加信息');
$tid = 'special-'.$specialid;
$TYPE = get_type($tid);
require MD_ROOT.'/item.class.php';
$do = new item($specialid);
$_mid = 5;
foreach($MODULE as $m) {
	if($m['module'] == 'article') {
		$_mid = $m['moduleid'];
		break;
	}
}
$menus = array (
    array('添加信息', '?moduleid='.$moduleid.'&file='.$file.'&specialid='.$specialid.'&action=add'),
    array('批量添加', '?moduleid='.$moduleid.'&file='.$file.'&specialid='.$specialid.'&action=batch&mid='.$_mid),
    array('信息列表', '?moduleid='.$moduleid.'&file='.$file.'&specialid='.$specialid),
    array('信息分類', '?file=type&item='.$tid),
    array('專題預覽', $MODULE[3]['linkurl'].'redirect.php?mid='.$moduleid.'&itemid='.$specialid, ' target="_blank"'),
    array('專題列表', '?moduleid='.$moduleid),
);
$MOD['level'] = $MOD['level_item'];
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&specialid='.$specialid.'&typeid='.$post['typeid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$content = '';
			$addtime = timetodate($DT_TIME);
			$item = array();
			$menuid = 0;
			$tname = $menus[$menuid][0];
			include tpl('item_edit', $module);
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
			$item = $do->get_one();
			extract($item);
			$addtime = timetodate($addtime);
			$menuid = 1;
			$tname = $menus[$menuid][0];
			include tpl('item_edit', $module);
		}
	break;
	case 'batch':
		if($submit) {
			$mid or msg('請選擇模型');
			$itemid or msg('請選擇'.$MODULE[$mid]['name']);
			$typeid or msg('請選擇分類');
			$specialid or msg('請選擇專題');
			$itemids = implode(',', $itemid);
			$table = get_table($mid);
			$result = $db->query("SELECT * FROM {$table} WHERE itemid IN ($itemids)");
			while($r = $db->fetch_array($result)) {
				$post = array();
				$post['specialid'] = $specialid;
				$post['typeid'] = $typeid;
				$post['level'] = $level;
				$post['title'] = $r['title'];
				$post['style'] = $r['style'];
				if(strpos($r['linkurl'], '://') === false) $r['linkurl'] = $MODULE[$mid]['linkurl'].$r['linkurl'];
				$post['linkurl'] = $r['linkurl'];
				$post['thumb'] = $r['thumb'];
				$post['introduce'] = $r['introduce'];
				$post = daddslashes($post);
				$do->add($post);
			}
			dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&specialid='.$specialid);
		} else {
			$mid = isset($mid) ? intval($mid) : 0;
			$lists = array();
			$pages = '';
			$tname = '選擇信息';
			if($mid) {
				$CATEGORY = cache_read('category-'.$mid.'.php');
				$table = get_table($mid);
				$condition = 'status=3';
				if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
				if($catid) $condition .= ($CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
				$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
				$items = $r['num'];
				$pages = pages($items, $page, $pagesize);
				$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY addtime DESC LIMIT $offset,$pagesize");
				while($r = $db->fetch_array($result)) {
					$r['adddate'] = timetodate($r['addtime'], 5);
					$r['editdate'] = timetodate($r['edittime'], 5);
					$r['alt'] = $r['title'];
					$r['title'] = set_style($r['title'], $r['style']);
					if(strpos($r['linkurl'], '://') === false) $r['linkurl'] = $MODULE[$mid]['linkurl'].$r['linkurl'];
					$lists[] = $r;
				}
				$tname = $MODULE[$mid]['name'].'列表';
			}
			include tpl('item_batch', $module);
		}
	break;
	case 'delete':
		$itemid or msg('請選擇信息');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('刪除成功', $forward);
	break;
	case 'level':
		$itemid or msg('請選擇信息');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('級別設置成功', $forward);
	break;
	case 'type':
		$itemid or msg('請選擇信息');
		$typeid = intval($typeid);
		$do->type($itemid, $typeid);
		dmsg('分類設置成功', $forward);
	break;
	default:			
		$sfields = array('標題', '簡介', '會員名');
		$dfields = array('title', 'introduce', 'username');

		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$level = isset($level) ? intval($level) : 0;
		$typeid = isset($typeid) ? intval($typeid) : 0;

		$thumb = isset($thumb) ? intval($thumb) : 0;
		$itemid or $itemid = '';

		$fields_select = dselect($sfields, 'fields', '', $fields);
		$level_select = level_select('level', '級別', $level);
		$type_select = type_select($tid, 0, 'typeid', '默認', $typeid);

		$condition = "specialid=$specialid";
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($level) $condition .= " AND level=$level";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($thumb) $condition .= " AND thumb!=''";
		if($itemid) $condition = " AND itemid=$itemid";

		$lists = $do->get_list($condition);
		if($condition == "specialid=$specialid" && $items != $special['items']) $db->query("UPDATE {$table} SET items=$items WHERE itemid=$specialid");
		$menuid = 2;
		include tpl('item', $module);
	break;
}
?>