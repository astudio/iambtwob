<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('添加模塊', '?file='.$file.'&action=add'),
    array('模塊管理', '?file='.$file),
    array('更新緩存', '?file='.$file.'&action=cache'),
);
require DT_ROOT.'/include/sql.func.php';
$this_forward = '?update=1&file='.$file;
$modid = isset($modid) ? intval($modid) : 0;
function get_modules() {
	$moduledirs = glob(DT_ROOT.'/module/*');
	$sysmodules = array();
	foreach($moduledirs as $k=>$v) {
		if(is_file($v.'/admin/config.inc.php')) {
			include $v.'/admin/config.inc.php';
			$sysmodules[$MCFG['module']] = $MCFG;
		}
	}
	return $sysmodules;
}
switch($action) {
	case 'add':
		if($submit) {
			if(!$post['name']) msg('請填寫模塊名稱');
			if($post['islink']) {
				if(!$post['linkurl']) msg('請填寫鏈接地址');
			} else {
				$dir = $post['moduledir'];
				$module = $post['module'];
				if(!$module) msg('請選擇所屬模型');
				$module_cfg = DT_ROOT.'/module/'.$module.'/admin/config.inc.php';
				if(!is_file($module_cfg)) msg('此模型無法安裝，請檢查');
				include $module_cfg;
				if($MCFG['uninstall'] == false) msg('此模型無法安裝，請檢查');
				if($MCFG['copy'] == false) {
					$r = $db->get_one("SELECT moduleid FROM {$DT_PRE}module WHERE module='$module' AND islink=0");
					if($r) msg('此模型已經安裝過，請檢查');
				}
				if(!$dir) msg('請填寫安裝目錄');
				if(!preg_match("/^[0-9a-z_-]+$/i", $dir)) msg('目錄名不合法,請更換一個再試');
				$r = $db->get_one("SELECT moduleid FROM {$DT_PRE}module WHERE moduledir='$dir' AND islink=0");
				if($r) msg('此目錄名已經被其他模塊使用,請更換一個再試');
				$sysdirs = array('admin', 'api', 'file', 'include', 'install', 'module', 'skin', 'template', 'wap');
				if(in_array($dir, $sysdirs)) msg('安裝目錄與系統目錄衝突，請更換安裝目錄');
				if(!dir_create(DT_ROOT.'/'.$dir.'/')) msg('無法創建'.$dir.'目錄，請檢查PHP是否有創建權限或手動創建');
				if(!is_write(DT_ROOT.'/'.$dir.'/')) msg('目錄'.$dir.'無法寫入，請設置此目錄可寫權限');
				if(!file_put(DT_ROOT.'/'.$dir.'/config.inc.php', "DESTOON")) msg('目錄'.$dir.'無法寫入，請設置此目錄可寫權限');
			}
			$post['linkurl'] = $post['islink'] ? $post['linkurl'] : ($post['domain'] ? $post['domain'] : linkurl($post['moduledir']."/"));
			if($post['islink']) $post['module'] = 'destoon';
			$post['installtime'] = $DT_TIME;
			if($MCFG['moduleid']) {
				$db->query("DELETE FROM {$DT_PRE}module WHERE moduleid=".$MCFG['moduleid']);
				$post['moduleid'] = $MCFG['moduleid'];
			}
			$sql1 = $sql2 = $s = "";
			foreach($post as $key=>$value) {
				$sql1 .= $s.$key;
				$sql2 .= $s."'".$value."'";
				$s = ",";
			}
			$db->query("INSERT INTO {$DT_PRE}module ($sql1) VALUES ($sql2)");
			$moduleid = $db->insert_id();
			$db->query("UPDATE {$DT_PRE}module SET listorder=$moduleid WHERE moduleid=$moduleid");
			if($post['islink']) {
			} else {
				$module = $post['module'];
				$dir = $post['moduledir'];
				$modulename = $post['name'];
				file_put(DT_ROOT.'/'.$dir.'/config.inc.php', "<?php\n\$moduleid = ".$moduleid.";\n?>");
				@include DT_ROOT.'/module/'.$module.'/admin/install.inc.php';
			}
			cache_module();
			dmsg('模塊安裝成功', $this_forward);
		} else {
			$imodules = array();
			$result = $db->query("SELECT module FROM {$DT_PRE}module");
			while($r = $db->fetch_array($result)) {
				$imodules[$r['module']] = $r['module'];
			}
			$modules = get_modules();
			$module_select = '<select name="post[module]"  id="module"><option value="0">請選擇</option>';
			foreach($modules as $k=>$v) {
				if($v['copy'] == false) {
					if(in_array($v['module'], $imodules)) continue;
				}
				$module_select .= '<option value="'.$v['module'].'">'.$v['name'].'</option>';
			}
			$module_select .= '</select>';
			include tpl('module_add');
		}
	break;
	case 'edit':
		if(!$modid) msg('模塊ID不能為空');
		$r = $db->get_one("SELECT * FROM {$DT_PRE}module WHERE moduleid='$modid'");
		if(!$r) msg('模塊不存在');
		extract($r);
		if($submit) {
			if(!$post['name']) msg('請填寫模塊名稱');
			if($islink) {
				if(!$post['linkurl']) msg('請填寫鏈接地址');
			} else {
				if(!$post['moduledir']) msg('請填寫安裝目錄');
				if(!preg_match("/^[0-9a-z_-]+$/i", $post['moduledir'])) msg('目錄名不合法,請更換一個再試');
				$sysdirs = array('admin', 'api', 'cache', 'editor', 'file', 'include', 'install', 'module', 'skin', 'template', 'wap');
				if(in_array($post['moduledir'], $sysdirs)) msg('安裝目錄與系統目錄衝突，請更換安裝目錄');
				$r = $db->get_one("SELECT moduleid FROM {$DT_PRE}module WHERE moduledir='$post[moduledir]' AND moduleid!=$modid");
				if($r) msg('此目錄名已經被其他模塊使用,請更換一個再試');
				$post['linkurl'] = $post['domain'] ? $post['domain'] : linkurl($post['moduledir']."/");
			}			
			$sql = $s = "";
			foreach($post as $key=>$value) {
				$sql .= $s.$key."='".$value."'";
				$s = ",";
			}
			$db->query("UPDATE {$DT_PRE}module SET $sql WHERE moduleid=$modid");
			if(!$islink && $moduledir != $post['moduledir']) {
				rename(DT_ROOT.'/'.$moduledir, DT_ROOT.'/'.$post['moduledir']) or msg('無法重命名目錄'.$moduledir.'為'.$post['moduledir'].',請手動修改');
			}
			cache_module();
			dmsg('模塊修改成功', $this_forward);
		} else {
			@include DT_ROOT.'/module/'.$module.'/admin/config.inc.php';
			$modulename = isset($MCFG['name']) ? $MCFG['name'] : '';
			include tpl('module_edit');
		}
	break;
	case 'delete':
		if(!$modid) msg('模塊ID不能為空');	
		if($modid < 5) msg('系統模型不可刪除');
		//if($modid < 23) dheader('?file='.$file.'&action=disable&value=1&modid='.$modid);
		$r = $db->get_one("SELECT * FROM {$DT_PRE}module WHERE moduleid='$modid'");
		if(!$r) msg('此模塊不存在');
		if(!$r['islink']) {
			$moduleid = $r['moduleid'];
			$module = $r['module'];
			$dir = $r['moduledir'];
			$module_cfg = DT_ROOT.'/module/'.$module.'/admin/config.inc.php';
			if(!is_file($module_cfg)) msg('此模型不可卸載，請檢查');
			include $module_cfg;
			if($MCFG['uninstall'] == false) msg('此模型不可卸載，請檢查');
			@include DT_ROOT.'/module/'.$module.'/admin/uninstall.inc.php';			
			$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			while($r = $db->fetch_row($result)) {
				$tb = $r[0];
				$pt = str_replace($DT_PRE.$moduleid.'_', '', $tb);
				if(is_numeric($pt)) $db->query("DROP TABLE IF EXISTS `".$tb."`");
			}
			$db->query("DELETE FROM `".$DT_PRE."category` WHERE moduleid=$moduleid");
			$db->query("DELETE FROM `".$DT_PRE."keylink` WHERE item=$moduleid");
			$db->query("DELETE FROM `".$DT_PRE."setting` WHERE item=$moduleid");
			$tb = str_replace($DT_PRE, '', get_table($moduleid));
			$db->query("DELETE FROM `".$DT_PRE."fields` WHERE tb='$tb'");
			dir_delete(DT_ROOT.'/'.$dir);
		}
		$db->query("DELETE FROM {$DT_PRE}module WHERE moduleid='$modid'");
		cache_module();
		dmsg('模塊刪除成功', $this_forward);
		break;
	case 'remkdir':
		if(!$modid) msg('模塊ID不能為空');
		$r = $db->get_one("SELECT * FROM {$DT_PRE}module WHERE moduleid='$modid'");
		$remkdir = DT_ROOT.'/module/'.$r['module'].'/admin/remkdir.inc.php';
		if(is_file($remkdir)) {
			$moduleid = $r['moduleid'];
			$module = $r['module'];
			$dir = $r['moduledir'];
			if(!dir_create(DT_ROOT.'/'.$dir)) msg('無法創建'.$dir.'目錄，請檢查PHP是否有創建權限或手動創建');
			if(!file_put(DT_ROOT.'/'.$dir.'/config.inc.php', "DesToon Test")) msg('目錄'.$dir.'無法寫入，如果是Linux/Unix服務器，請設置此目錄可寫權限');
			file_put(DT_ROOT.'/'.$dir.'/config.inc.php', "<?php\n\$moduleid = ".$moduleid.";\n?>");
			include $remkdir;			
			cache_module();
			dmsg('目錄重建成功', '?file='.$file);
		} else {
			msg('此模型無需重建目錄', '?file='.$file);
		}
	break;
	case 'disable':
		if(!$modid) msg('模塊ID不能為空');
		if($modid < 5) msg('系統模型不可禁用');
		$value = $value ? 1 : 0;
		$db->query("UPDATE {$DT_PRE}module SET disabled='$value' WHERE moduleid=$modid");
		cache_module();
		dmsg('模塊狀態已經修改', $this_forward);
	break;
	case 'order':
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$db->query("UPDATE {$DT_PRE}module SET listorder='$v' WHERE moduleid=$k");
		}
		cache_module();
		dmsg('更新成功', $this_forward);
	break;
	case 'cache':
		cache_module();
		dmsg('更新成功', '?file='.$file);
	break;
	case 'ckdir':
		if(!preg_match("/^[0-9a-z_-]+$/i", $moduledir)) dialog('不是一個合法的目錄名,請更換一個再試');
		$r = $db->get_one("SELECT moduleid FROM {$DT_PRE}module WHERE moduledir='$moduledir'");
		if($r || is_dir(DT_ROOT.'/'.$moduledir.'/')) dialog('該目錄名已經被使用,請更換一個再試');
		dialog('目錄名可以使用');
	break;
	default:
		$sysmodules = get_modules();
		$modules = $_modules = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}module ORDER BY listorder ASC,moduleid DESC");
		while($r = $db->fetch_array($result)) {
			if($r['moduleid'] == 1) continue;
			$r['installdate'] = timetodate($r['installtime'], 3);
			$r['modulename'] = isset($sysmodules[$r['module']]) ? $sysmodules[$r['module']]['name'] : '外鏈';
			if($r['disabled']) {
				$_modules[] = $r;
			} else {
				$modules[] = $r;
			}
		}
		include tpl('module');
	break;
}
?>