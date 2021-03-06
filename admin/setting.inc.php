<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
if($action == 'ftp') {
	require DT_ROOT.'/include/ftp.class.php';
	if(strpos($ftp_pass, '***') !== false) $ftp_pass = $DT['ftp_pass'];
	$ftp = new dftp($ftp_host, $ftp_user, $ftp_pass, $ftp_port, $ftp_path, $ftp_pasv, $ftp_ssl);
	if(!$ftp->connected) dialog('FTP無法連接，請檢查設置');
	if(!$ftp->dftp_chdir()) dialog('FTP無法進入遠程存儲目錄，請檢查遠程存儲目錄');
	dialog('FTP設置正常,可以使用');
} else if ($action == 'mail') {
	define('TESTMAIL', true);
	if(strpos($smtp_pass, '***') !== false) $smtp_pass = $DT['smtp_pass'];
	$DT['mail_type'] = $mail_type;
	$DT['smtp_host'] = $smtp_host;
	$DT['smtp_port'] = $smtp_port;
	$DT['smtp_auth'] = $smtp_auth;
	$DT['smtp_user'] = $smtp_user;
	$DT['smtp_pass'] = $smtp_pass;
	$DT['mail_sender'] = $mail_sender;
	$DT['mail_name'] = $mail_name;
	$DT['mail_delimiter'] = $mail_delimiter;
	$DT['mail_sign'] = '<br/>------------------------------------<br><a href="http://www.destoon.com/" target="_blank">Send By Destoon Mail Tester</a>';
	if(send_mail($testemail, $DT['sitename'].'郵件發送測試', '<b>恭喜！您的站點['.$DT['sitename'].']郵件發送設置成功！</b>')) dialog('郵件已發送至'.$testemail.'，請注意查收', $mail_sender);
	dialog('郵件發送失敗，請檢查設置');
} else {
	$tab = isset($tab) ? intval($tab) : 0;
	$all = isset($all) ? intval($all) : 0;
	if($submit) {
		if(!preg_match("/^[0-9a-z]{10,}$/i", $config['authkey'])) $config['authkey'] = random(18);
		$setting['safe_domain'] = str_replace(array('http://', 'www.'), array('', ''), $setting['safe_domain']);
		if(!preg_match("/^[a-z]{1}[0-9a-z]{2}_$/i", $config['cookie_pre'])) $config['cookie_pre'] = 'D'.random(2).'_';
		if(substr($config['url'], -1) != '/') $config['url'] = $config['url'].'/';
		if($config['cookie_domain'] && substr($config['cookie_domain'], 0, 1) != '.') $config['cookie_domain'] = '.'.$config['cookie_domain'];
		$setting['smtp_pass'] = pass_decode($setting['smtp_pass'], $DT['smtp_pass']);
		$setting['ftp_pass'] = pass_decode($setting['ftp_pass'], $DT['ftp_pass']);
		$setting['sms_key'] = pass_decode($setting['sms_key'], $DT['sms_key']);
		$setting['trade_pw'] = pass_decode($setting['trade_pw'], $DT['trade_pw']);
		$setting['admin_week'] = implode(',', $setting['admin_week']);
		$setting['check_week'] = implode(',', $setting['check_week']);		
		if($setting['logo'] != $DT['logo']) clear_upload($setting['logo']);
		if(!is_writable(DT_ROOT.'/config.inc.php')) msg('根目錄config.inc.php無法寫入，請設置可寫權限');
		$tmp = file_get(DT_ROOT.'/config.inc.php');
		foreach($config as $k=>$v)	{
			$tmp = preg_replace("/[$]CFG\['$k'\]\s*\=\s*[\"'].*?[\"']/is", "\$CFG['$k'] = '$v'", $tmp);
		}
		file_put(DT_ROOT.'/config.inc.php', $tmp);
		update_setting($moduleid, $setting);
		cache_module(1);
		cache_module();
		$filename = DT_ROOT.'/'.$setting['index'].'.'.$setting['file_ext'];
		if(!$setting['index_html'] && $setting['file_ext'] != 'php') @unlink($filename);
		$mdir = DT_ROOT.'/'.$MODULE[2]['moduledir'].'/';
		if($setting['file_register'] != $old_file_register) @rename($mdir.$old_file_register, $mdir.$setting['file_register']);
		if($setting['file_login'] != $old_file_login) @rename($mdir.$old_file_login, $mdir.$setting['file_login']);
		if($setting['file_my'] != $old_file_my) @rename($mdir.$old_file_my, $mdir.$setting['file_my']);
		dmsg('更新成功', '?moduleid='.$moduleid.'&file='.$file.'&tab='.$tab);
	} else {
		include DT_ROOT.'/config.inc.php';
		extract(dhtmlspecialchars($CFG));
		extract(dhtmlspecialchars($DT));
		$W = array('天', '一', '二', '三', '四', '五', '六');
		$smtp_pass = pass_encode($smtp_pass);
		$ftp_pass = pass_encode($ftp_pass);
		$sms_key = pass_encode($sms_key);
		$trade_pw = pass_encode($trade_pw);
		if($kw) {
			$all = 1;
			ob_start();
		}
		include tpl('setting', $module);
		if($kw) {
			$data = $content = ob_get_contents();
			ob_clean();
			$data = preg_replace('\'(?!((<.*?)|(<a.*?)|(<strong.*?)))('.$kw.')(?!(([^<>]*?)>)|([^>]*?</a>)|([^>]*?</strong>))\'si', '<span class=highlight>'.$kw.'</span>', $data);
			$data = preg_replace('/<span class=highlight>/', '<a name=high></a><span class=highlight>', $data, 1);
			echo $data ? $data : $content;
		}
	}
}
?>