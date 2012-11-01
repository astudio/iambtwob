<?php
defined('IN_DESTOON') or exit('Access Denied');
$tab = isset($tab) ? intval($tab) : 0;
$all = isset($all) ? intval($all) : 0;
if($submit) {
	$P = cache_read('pay.php');
	$pay['chinabank']['keycode'] = pass_decode($pay['chinabank']['keycode'], $P['chinabank']['keycode']);
	$pay['alipay']['keycode'] = pass_decode($pay['alipay']['keycode'], $P['alipay']['keycode']);
	$pay['tenpay']['keycode'] = pass_decode($pay['tenpay']['keycode'], $P['tenpay']['keycode']);
	$pay['yeepay']['keycode'] = pass_decode($pay['yeepay']['keycode'], $P['tenpay']['keycode']);
	$setting['uc_dbpwd'] = pass_decode($setting['uc_dbpwd'], $MOD['uc_dbpwd']);
	$setting['ex_pass'] = pass_decode($setting['ex_pass'], $MOD['ex_pass']);
	$setting['sso_auth'] = pass_decode($setting['sso_auth'], $MOD['sso_auth']);
	foreach($pay as $k=>$v) {
		update_setting('pay-'.$k, $v);
	}
	$setting['oauth'] = 0;
	foreach($oauth as $k=>$v) {
		if($v['enable']) $setting['oauth'] = 1;
		update_setting('oauth-'.$k, $v);
	}
	update_setting($moduleid, $setting);
	cache_module($moduleid);
	dmsg('更新成功', '?moduleid='.$moduleid.'&file='.$file.'&tab='.$tab);
} else {
	extract(dhtmlspecialchars($MOD));
	cache_pay();
	$P = cache_read('pay.php');
	extract($P);
	cache_oauth();	
	$O = cache_read('oauth.php');
	extract($O);
	$chinabank['keycode'] = pass_encode($chinabank['keycode']);
	$alipay['keycode'] = pass_encode($alipay['keycode']);
	$tenpay['keycode'] = pass_encode($tenpay['keycode']);
	$yeepay['keycode'] = pass_encode($yeepay['keycode']);
	$uc_dbpwd = pass_encode($uc_dbpwd);
	$ex_pass = pass_encode($ex_pass);
	$sso_auth = pass_encode($sso_auth);
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
?>