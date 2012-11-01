<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
if(!isset($CFG['edittpl']) || !$CFG['edittpl']) msg('系統禁止了在線修改模板，請FTP修改根目錄config.inc.php<br/>$CFG[\'edittpl\'] = \'0\'; 修改為 $CFG[\'edittpl\'] = \'1\';');
$menus = array (
    array('添加CSS', '?file=skin&action=add'),
    array('風格管理', '?file=skin'),
    array('模板管理', '?file=template'),
    array('標籤嚮導', '?file=tag'),
);
$this_forward = '?file='.$file;
$skin_root = DT_ROOT.'/skin/'.$CFG['skin'].'/';
is_dir($skin_root) or dir_create($skin_root);
$skin_path = './skin/'.$CFG['skin'].'/';
isset($fileid) or $fileid = '';
isset($bakid) or $bakid = '';
if($fileid && !preg_match("/^[0-9a-z_\-]+$/", $fileid))  msg('文件格式錯誤');

switch($action) {
	case 'add':
		if($submit) {
			if(!$fileid)  msg('文件名不能為空');
			if(!$content) msg('風格內容不能為空');
			$dfile = $skin_root.$fileid.'.css';
			if(isset($nowrite) && is_file($dfile)) msg('文件已經存在');
			file_put($dfile, stripslashes($content));
			dmsg('風格添加成功', $this_forward);
		} else {
			include tpl('skin_add');
		}
	break;
	case 'edit':
		if(!$fileid)  msg('文件名不能為空');
		if($submit) {
			if(!$dfileid) msg('Invalid Request');
			if(!$content) msg('風格內容不能為空');
			$dfile = $skin_root.$dfileid.'.css';
			$nfile = $skin_root.$fileid.'.css';
			if(isset($backup)) {
				$i = 0;
				while(++$i) {
					$bakfile = $skin_root.$dfileid.'.'.$i.'.bak';
					if(!is_file($bakfile)) {
						file_copy($dfile, $bakfile);
						break;
					}
				}
			}
			file_put($nfile, stripslashes($content));
			if($dfileid != $fileid) file_del($dfile);
			dmsg('風格修改成功', $forward);
		} else {
			if(!is_write($skin_root.$fileid.'.css')) msg($fileid.'.css不可寫，請將其屬性設置為可寫');
			$content = file_get($skin_root.$fileid.'.css');
			include tpl('skin_edit');
		}
	break;
	case 'import':
		if(!$fileid) msg('文件名不能為空');
		if(!$bakid) msg('Invalid Request');
		if(file_copy($skin_root.$fileid.'.'.$bakid.'.bak', $skin_root.$fileid.'.css')) dmsg('備份文件恢復成功', $this_forward);
		dmsg('備份文件恢復失敗');
	break;
	case 'download':
		if(!$fileid) msg('文件名不能為空');
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.css';
		file_down($skin_root.$fileid.$file_ext);
	break;
	case 'delete':
		if(!$fileid) msg('文件名不能為空');
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.css';
		file_del($skin_root.$fileid.$file_ext);
		dmsg('文件刪除成功', $this_forward);
	break;
	default:
		$files = $skins = $baks = array();
		$files = glob($skin_root.'*.*');
		if(!$files) msg('風格文件不存在，請先創建', "?file=$file&action=add");
		foreach($files as $k=>$v) {
			$filename = str_replace($skin_root, '', $v);
			if(preg_match("/^[0-9a-z_-]+\.css$/", $filename)) {
				$fileid = str_replace('.css', '', $filename);
				$skins[$fileid]['fileid'] = $fileid;
				$skins[$fileid]['filename'] = $filename;
				$skins[$fileid]['filesize'] = round(filesize($v)/1024, 2);
				$skins[$fileid]['mtime'] = date('Y-m-d H:i', filemtime($v));
			} else if(preg_match("/^([0-9a-z_-]+)\.([0-9]+)\.bak$/", $filename, $m)) {
				$fileid = str_replace('.bak', '', $filename);
				$baks[$fileid]['fileid'] = $fileid;
				$baks[$fileid]['filename'] = $filename;
				$baks[$fileid]['filesize'] = round(filesize($v)/1024, 2);
				$baks[$fileid]['number'] = $m[2];
				$baks[$fileid]['type'] = $m[1];
				$baks[$fileid]['mtime'] = date('Y-m-d H:i', filemtime($v));
			}
		}
		if($skins) ksort($skins);
		if($baks) ksort($baks);
		include tpl('skin');
	break;
}
?>