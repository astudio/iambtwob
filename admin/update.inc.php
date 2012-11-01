<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$release = isset($release) ? intval($release) : 0;
$release or msg();
$release_dir = DT_ROOT.'/file/update/'.$release;
switch($action) {
	case 'download':
		$PHP_URL = @get_cfg_var("allow_url_fopen");
		if(!$PHP_URL) msg('當前服務器不支持URL打開文件，請修改php.ini中allow_url_fopen = on');
		$url = 'http://www.destoon.com/update.php?product=b2b&release='.$release.'&charset='.DT_CHARSET;
		$code = @file_get_contents($url);
		if($code) {
			if(substr($code, 0, 8) == 'StatusOk') {
				$code = substr($code, 8);
			} else {
				msg($code);
			}
		} else {
			msg('無法連接官方服務器，請重試或稍後更新');
		}
		dir_create($release_dir);
		if(@copy($code, $release_dir.'/'.$release.'.zip')) {
			file_copy(DT_ROOT.'/file/index.html', $release_dir.'/index.html');
			dir_create($release_dir.'/source/');
			dir_create($release_dir.'/backup/');
			msg('更新下載成功，開始解壓縮..', '?file='.$file.'&action=unzip&release='.$release);
		} else {
			msg('更新下載失敗，請重試..');
		}
	break;
	case 'unzip':
		require DT_ROOT.'/admin/unzip.class.php';
		$zip = new unzip;
		$zip->extract_zip($release_dir.'/'.$release.'.zip', $release_dir.'/source/');
		if(is_file($release_dir.'/source/destoon/version.inc.php')) {			
			msg('更新解壓縮成功，開始更新文件..', '?file='.$file.'&action=copy&release='.$release);
		} else {
			msg('更新解壓縮失敗，請重試..');
		}
	break;
	case 'copy':
		if($CFG['template'] != 'default' && is_dir($release_dir.'/source/destoon/template/default')) @rename($release_dir.'/source/destoon/template/default', $release_dir.'/source/destoon/template/'.$CFG['template']);
		if($CFG['skin'] != 'default' && is_dir($release_dir.'/source/destoon/skin/default')) @rename($release_dir.'/source/destoon/skin/default', $release_dir.'/source/destoon/skin/'.$CFG['skin']);
		$files = file_list($release_dir.'/source/destoon');
		foreach($files as $v) {
			$file_a = str_replace('file/update/'.$release.'/source/destoon/', '', $v);
			$file_b = str_replace('source/destoon/', 'backup/', $v);
			if(is_file($file_a)) file_copy($file_a, $file_b);
			file_copy($v, $file_a) or msg('無法覆蓋'.str_replace(DT_ROOT.'/', '', $file_a).'<br/>請設置此文件及上級目錄屬性為可寫，然後刷新此頁');
		}
		msg('文件更新成功，開始運行更新..', '?file='.$file.'&action=cmd&release='.$release);
	break;
	case 'cmd':
		@include $release_dir.'/source/cmd.inc.php';
		msg('更新運行成功', '?file='.$file.'&action=finish&release='.$release);
	break;
	case 'finish':
		msg('系統更新成功 當前版本V'.DT_VERSION.' R'.DT_RELEASE, '?file=destoon&action=update', 2);
	break;
	case 'undo':
		is_file($release_dir.'/backup/version.inc.php') or msg('此版本備份文件不存在，無法還原', '?file=destoon&action=update', 2);
		@include $release_dir.'/source/cmd.inc.php';
		$files = file_list($release_dir.'/backup');
		foreach($files as $v) {
			file_copy($v, str_replace('file/update/'.$release.'/backup/', '', $v));
		}
		msg('系統還原成功', '?file=destoon&action=update', 2);
	break;
	default:
		$release > DT_RELEASE or msg('當前版本不需要運行此更新', '?file=destoon&action=update', 2);
		msg('在線更新已經啟動，開始下載更新..', '?file='.$file.'&action=download&release='.$release, 2);
	break;
}
?>