<?php
defined('IN_DESTOON') or exit('Access Denied');
define("UC_DBHOST", $MOD['uc_dbhost']) ;
define("UC_DBUSER", $MOD['uc_dbuser']) ;
define("UC_DBPW", $MOD['uc_dbpwd']) ;
define("UC_DBNAME", $MOD['uc_dbname']) ;
define("UC_DBPRE", $MOD['uc_dbpre']) ;
define("UC_KEY", $MOD['uc_key']) ;
define('UC_APPID', $MOD['uc_appid']) ;
define("UC_API", $MOD['uc_api']) ;
define("UC_IP", $MOD['uc_ip']) ;
define("UC_DBTABLEPRE", $MOD['uc_dbpre']);
define("UC_CONNECT", $MOD['uc_mysql'] ? 'mysql' : '');
define('API_RETURN_SUCCEED', 1);
define('UC_DBCHARSET', $MOD['uc_charset']); 
define('API_UPDATECREDIT', 0);
define('API_GETCREDITSETTINGS', 0);
define('API_UPDATECREDITSETTINGS', 0);
define("UC_BBSPRE", $MOD['uc_bbspre'] ? $MOD['uc_bbspre'] : 'pre_');
require_once DT_ROOT.'/api/ucenter/client.php';
switch($action) {
	case 'login':
		$uc_username = convert($passport, DT_CHARSET, $MOD['uc_charset']);
		$user = $db->get_one("SELECT username,passport,password,groupid,email FROM {$DT_PRE}member WHERE username='$username'");
		list($uid, $rt_username, $rt_password, $rt_email) = uc_user_login($uc_username, $password, 0, 0);
		if($uid == -1) {/* Ucenter 用戶不存在或被刪除 */
			if($user) {
				$vpassword = is_md5($password) ? md5($password) : md5(md5($password));
				if($user['password'] !=  $vpassword) message('密碼錯誤，請重試');
				if($user['groupid'] == 2) message('該帳號已被禁止訪問');
				//if($user['groupid'] == 4) message('該帳號尚在審核中');
				/* 嘗試註冊一個UC帳戶 */
				$uid = uc_user_register($uc_username, $password, $user['email']);
				if($uid > 0) $api_msg = uc_user_synlogin($uid);
			} else {
				message('用戶不存在或被刪除');
			}
		} else if($uid == -2) {/* Ucenter 密碼錯誤 */
			if($user) {
				if($user['password'] == (is_md5($password) ? md5($password) : md5(md5($password)))) { /* 更新UC密碼 */
					uc_user_edit($uc_username, '', $password, '', 1);
					$uc_get_user = uc_get_user($uc_username);
					if($uc_get_user[0]) $api_msg = uc_user_synlogin($uc_get_user[0]);
				} else {
					message('密碼錯誤，請重試');
				}
			} else {
				message('Ucenter密碼錯誤，請用Ucenter密碼登錄');
			}
		} else if($uid == -3) {/* Ucenter 安全提問錯 */
			message('如果需要同步登錄Ucenter，請取消Ucenter安全提問');
		} else if($uid > 0) {/* Ucenter 驗證成功 */
			$api_msg = uc_user_synlogin($uid);
			if($user) {
				$vpassword = is_md5($password) ? md5($password) : md5(md5($password));/* 同步DT密碼 */
				if($user['password'] != $vpassword) $db->query("UPDATE {$DT_PRE}member SET password='$vpassword' WHERE username='$username'");
			} else {/* 會員不存在 */
				$auth = rawurlencode(encrypt($username.'|'.$rt_password.'|'.$rt_email));
				message('請激活您的通行證賬號', $MOD['linkurl'].$DT['file_register'].'?auth='.$auth);
			}
		}
	break;
	case 'logout':
		$api_msg = uc_user_synlogout();
	break;
	case 'passport':
		$could_passport = false;
		$uc_username = convert($passport, DT_CHARSET, $MOD['uc_charset']);
		list($uid, $rt_username, $rt_password, $rt_email) = uc_user_login($uc_username, md5(random(8)));
		if($uid == -1) $could_passport = true;
	break;
	case 'oauth':
		$uc_username = convert($passport, DT_CHARSET, $MOD['uc_charset']);
		$uc_get_user = uc_get_user($uc_username);
		if($uc_get_user[0]) $api_msg = uc_user_synlogin($uc_get_user[0]);
	break;
}
?>