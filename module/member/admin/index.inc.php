<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/member.class.php';
$do = new member;
$menus = array (
    array('添加會員', '?moduleid='.$moduleid.'&action=add'),
    array('會員列表', '?moduleid='.$moduleid),
    array('審核會員', '?moduleid='.$moduleid.'&action=check'),
    array('會員升級', '?moduleid='.$moduleid.'&file=grade&action=check'),
    array('聯繫會員', '?moduleid='.$moduleid.'&file=contact'),
    array('公司列表', '?moduleid=4'),
    array(VIP.'列表', '?moduleid=4&file=vip'),
);
isset($userid) or $userid = 0;
$CATEGORY = cache_read('category-4.php');

if(in_array($action, array('add', 'edit'))) {
	$MFD = cache_read('fields-member.php');
	$CFD = cache_read('fields-company.php');
	isset($post_fields) or $post_fields = array();
	if($MFD || $CFD) require DT_ROOT.'/include/fields.func.php';
}

if($_catids || $_areaids) {
	if(isset($userid)) $itemid = $userid;
	if(isset($member['areaid'])) $post['areaid'] = $member['areaid'];
	require DT_ROOT.'/admin/admin_check.inc.php';
}

if(in_array($action, array('', 'check'))) {
	$sfields = array('按條件', '公司名', '會員名', '通行證名','姓名', '手機號碼', '部門', '職位', 'Email', 'QQ', 'MSN', '阿里旺旺', 'Skype', '註冊IP', '登錄IP', '客服專員', '開戶銀行', '銀行帳號', $DT['trade_nm'], '推薦人');
	$dfields = array('username', 'company', 'username', 'passport', 'truename', 'mobile', 'department', 'career', 'email', 'qq', 'msn', 'ali', 'skype', 'regip', 'loginip', 'support', 'bank', 'account', 'trade', 'inviter');
	$sorder  = array('結果排序方式', '註冊時間降序', '註冊時間升序', '登錄時間降序', '登錄時間升序', '登錄次數降序', '登錄次數升序', '賬戶'.$DT['money_name'].'降序', '賬戶'.$DT['money_name'].'升序', '會員'.$DT['credit_name'].'降序', '會員'.$DT['credit_name'].'升序', '短信餘額降序', '短信餘額升序');
	$dorder  = array('userid DESC', 'regtime DESC', 'regtime ASC', 'logintime DESC', 'logintime ASC', 'logintimes DESC', 'logintimes ASC', 'money DESC', 'money ASC', 'credit DESC', 'credit ASC', 'sms DESC', 'sms ASC');
	$sgender = array('性別', '先生' , '女士');
	$sprofile = array('資料', '已完善' , '未完善');
	$semail = array('郵件', '已認證' , '未認證');
	$smobile = array('手機', '已認證' , '未認證');
	$struename = array('實名', '已認證' , '未認證');
	$sbank = array('銀行', '已認證' , '未認證');
	$scompany = array('公司', '已認證' , '未認證');
	$strade = array($DT['trade_nm'], '已認證' , '未認證');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$groupid = isset($groupid) ? intval($groupid) : 0;
	$gender = isset($gender) ? intval($gender) : 0;
	$uid = isset($uid) ? intval($uid) : '';
	$username = isset($username) ? trim($username) : '';
	$vprofile = isset($vprofile) ? intval($vprofile) : 0;
	$vemail = isset($vemail) ? intval($vemail) : 0;
	$vmobile = isset($vmobile) ? intval($vmobile) : 0;
	$vtruename = isset($vtruename) ? intval($vtruename) : 0;
	$vbank = isset($vbank) ? intval($vbank) : 0;
	$vcompany = isset($vcompany) ? intval($vcompany) : 0;
	$vtrade = isset($vtrade) ? intval($vtrade) : 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	isset($timetype) or $timetype = 'regtime';
	$minmoney = isset($minmoney) ? intval($minmoney) : '';
	$maxmoney = isset($maxmoney) ? intval($maxmoney) : '';
	$mincredit = isset($mincredit) ? intval($mincredit) : '';
	$maxcredit = isset($maxcredit) ? intval($maxcredit) : '';
	$minsms = isset($minsms) ? intval($minsms) : '';
	$maxsms = isset($maxsms) ? intval($maxsms) : '';

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$gender_select = dselect($sgender, 'gender', '', $gender);
	$group_select = group_select('groupid', '會員組', $groupid);
	$vprofile_select = dselect($sprofile, 'vprofile', '', $vprofile);
	$vemail_select = dselect($semail, 'vemail', '', $vemail);
	$vmobile_select = dselect($smobile, 'vmobile', '', $vmobile);
	$vtruename_select = dselect($struename, 'vtruename', '', $vtruename);
	$vbank_select = dselect($sbank, 'vbank', '', $vbank);
	$vcompany_select = dselect($scompany, 'vcompany', '', $vcompany);
	$vtrade_select = dselect($strade, 'vtrade', '', $vtrade);

	$condition = $action ? 'groupid=4' : 'groupid!=4';//
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($gender) $condition .= " AND gender=$gender";
	if($groupid) $condition .= " AND groupid=$groupid";
	if($uid) $condition .= " AND userid=$uid";
	if($username) $condition .= " AND username='$username'";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	if($vprofile) $condition .= $vprofile == 1 ? " AND edittime>0" : " AND edittime=0";
	if($vemail) $condition .= $vemail == 1 ? " AND vemail>0" : " AND vemail=0";
	if($vmobile) $condition .= $vmobile == 1 ? " AND vmobile>0" : " AND vmobile=0";
	if($vtruename) $condition .= $vtruename == 1 ? " AND vtruename>0" : " AND vtruename=0";
	if($vbank) $condition .= $vbank == 1 ? " AND vbank>0" : " AND vbank=0";
	if($vcompany) $condition .= $vcompany == 1 ? " AND vcompany>0" : " AND vcompany=0";
	if($vtrade) $condition .= $vtrade == 1 ? " AND vtrade>0" : " AND vtrade=0";
	if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
	if($minmoney) $condition .= " AND money>=$minmoney";
	if($maxmoney) $condition .= " AND money<=$maxmoney";
	if($mincredit) $condition .= " AND credit>=$mincredit";
	if($maxcredit) $condition .= " AND credit<=$maxcredit";
	if($minsms) $condition .= " AND sms>=$minsms";
	if($maxsms) $condition .= " AND sms<=$maxsms";
}
if(in_array($action, array('add', 'edit'))) {
	$COM_TYPE = explode('|', $MOD['com_type']);
	$COM_SIZE = explode('|', $MOD['com_size']);
	$COM_MODE = explode('|', $MOD['com_mode']);
	$MONEY_UNIT = explode('|', $MOD['money_unit']);
	$BANKS = explode('|', trim($MOD['cash_banks']));
}
switch($action) {
	case 'add':
		if($submit) {
			$member['groupid'] = $member['regid'];
			if($member['groupid'] == 5) $member['company'] = $member['truename'];
			$member['passport'] = $member['passport'] ? $member['passport'] : $member['username'];
			$member['edittime'] = $member['edittime'] ? $DT_TIME : 0;
			$member['inviter'] = $member['username'];
			if($MFD) fields_check($post_fields, $MFD);
			if($CFD) fields_check($post_fields, $CFD);
			if($do->add($member)) {
				if($MFD) fields_update($post_fields, $do->table_member, $do->userid, 'userid', $MFD);
				if($CFD) fields_update($post_fields, $do->table_company, $do->userid, 'userid', $CFD);
				if($MOD['welcome_sms'] && $DT['sms'] && is_mobile($member['mobile'])) {
					$message = lang('sms->wel_reg', array($member['truename'], $DT['sitename'], $member['username'], $member['password']));
					$message = strip_sms($message);
					send_sms($member['mobile'], $message);
				}
				if($MOD['welcome_message'] || $MOD['welcome_email']) {
					$post = $member;
					$username = $member['username'];
					$email = $member['email'];
					$title = $L['register_msg_welcome'];
					$content = ob_template('welcome', 'mail');
					if($MOD['welcome_message']) send_message($username, $title, $content);
					if($MOD['welcome_email'] && $DT['mail_type'] != 'close') send_mail($email, $title, $content);
				}
				dmsg('添加成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			include tpl('member_add', $module);
		}
	break;
	case 'edit':
		$userid or msg();
		$do->userid = $userid;
		$user = $do->get_one();
		if(!$_founder && $userid != $_userid && $user['groupid'] == 1) msg('您無權修改其他管理員資料');
		if($submit) {
			if($userid == $_userid && $member['password']) msg('系統檢查到您要修改密碼，正在進入密碼修改界面...', '?action=password', 3);
			$member['edittime'] = $member['edittime'] ? $DT_TIME : 0;
			$member['validtime'] = $member['validtime'] ? strtotime($member['validtime']) : 0;
			if($userid == 1 || $userid == $CFG['founderid']) $member['groupid'] = 1;
			if($MFD) fields_check($post_fields, $MFD);
			if($CFD) fields_check($post_fields, $CFD);
			$status = 0;
			if($gid != $member['groupid']) {
				$groupid = $member['groupid'];
				if($groupid == 1) {
					$status = 1;
					$member['groupid'] = $gid;
				} else if($GROUP[$groupid]['vip']) {
					$status = 2;
					$member['groupid'] = $gid;
				}
			}
			if($do->edit($member)) {
				if($MFD) fields_update($post_fields, $do->table_member, $do->userid, 'userid', $MFD);
				if($CFD) fields_update($post_fields, $do->table_company, $do->userid, 'userid', $CFD);
				if($status == 1) msg('會員資料修改成功，如果需要添加管理員，請進入管理員管理...', '?file=admin&action=add&username='.$username, 5);
				if($status == 2) msg('會員資料修改成功，如果需要添加'.VIP.'會員，請進入'.VIP.'管理...', '?moduleid=4&file=vip&action=add&username='.$username, 5);
				dmsg('會員資料修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($user);
			$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $DT_PRE.'company_data');
			$d = $db->get_one("SELECT content FROM {$content_table} WHERE userid=$userid");
			$introduce = $d['content'];
			$cates = $catid ? explode(',', substr($catid, 1, -1)) : array();
			$validtime = $validtime ? timetodate($validtime, 3) : '';
			include tpl('member_edit', $module);
		}
	break;
	case 'show':
		if(isset($mobile)) {
			$r = $db->get_one("SELECT username FROM {$table} WHERE mobile='$mobile'");
			if($r) $username = $r['username'];
		}
		if(isset($email)) {
			$r = $db->get_one("SELECT username FROM {$table} WHERE email='$email'");
			if($r) $username = $r['username'];
		}
		$username = isset($username) ? $username : '';
		($userid || $username) or msg('會員不存在');
		if($userid) $do->userid = $userid;
		$user = $do->get_one($username);
		$user or msg('會員不存在');
		if(!$_founder && $userid != $_userid && $user['groupid'] == 1) msg('您無權查看其他管理員資料');
		extract($user);
		include tpl('member_show', $module);
	break;
	case 'delete':
		$userid or msg('請選擇會員');
		$db->halt = 0;
		if(!$_founder) {
			if(is_array($userid)) {
				foreach($userid as $uid) {
					$do->userid = $uid;
					$user = $do->get_one();
					if($user['groupid'] == 1) dalert('您無權刪除管理員', '?file=logout');
				}
			} else {
				$do->userid = $userid;
				$user = $do->get_one();
				if($user['groupid'] == 1) dalert('您無權刪除管理員', '?file=logout');
			}
		}
		if($do->delete($userid)) {
			dmsg('刪除成功', $forward);
		} else {
			msg($do->errmsg);
		}
	break;
	case 'move':
		$userid or msg('請選擇會員');
		$gid = isset($groupids) ? $groupids : $groupid;
		if($gid == 1) msg('操作失敗！&nbsp;如果需要添加管理員<br/><a href="?file=admin&action=add">請點這裡進入管理員管理...</a>');
		if($GROUP[$gid]['vip']) msg('操作失敗！&nbsp;如果需要添加'.VIP.'會員<br/><a href="?moduleid=4&file=vip&action=add">請點這裡進入'.VIP.'管理...</a>');
		$do->move($userid, $gid);
		dmsg('移動成功', $forward);
	break;
	case 'check':
		if($userid) {
			if(is_array($userid)) {
				$userids = $userid;
			} else {
				$userids[0] = $userid;
			}
			foreach($userids as $userid) {
				$do->userid = $userid;
				$member = $do->get_one();
				$groupid = $member['regid'];
				$db->query("UPDATE {$DT_PRE}member SET groupid=$groupid WHERE userid=$userid");
				$db->query("UPDATE {$DT_PRE}company SET groupid=$groupid WHERE userid=$userid");
				$db->query("UPDATE {$DT_PRE}company_catid SET groupid=$groupid WHERE userid=$userid");
				if($MOD['welcome_message'] || $MOD['welcome_email']) {
					$username = $member['username'];
					$email = $member['email'];
					$title = $L['register_msg_welcome'];
					$content = ob_template('welcome', 'mail');
					if($MOD['welcome_message']) send_message($username, $title, $content);
					if($MOD['welcome_email'] && $DT['mail_type'] != 'close') send_mail($email, $title, $content);
				}
			}
			dmsg('審核成功', $forward);
		} else {
			$members = $do->get_list($condition, $dorder[$order]);
			include tpl('member_check', $module);
		}
	break;
	case 'rename':
		$cusername or message('當前會員名不能為空');
		$nusername or message('會員名不能為空');
		$user = $do->get_one($cusername);
		$userid = $user['userid'];
		if(!$_founder && $cusername != $_username) {
			if($user['groupid'] == 1) msg('您無權修改其他管理員用戶名');
		}
		if($do->rename($cusername, $nusername)) {
			if(!$user['domain']) {
				$linkurl = userurl($nusername);
				$db->query("UPDATE {$DT_PRE}company SET linkurl='$linkurl' WHERE userid=$userid");
			}
			dmsg('修改成功', $forward);
		} else {
			msg($do->errmsg);
		}
	break;
	case 'login':
		if($userid) {
			if($_userid == $userid) msg('', $MODULE[2]['linkurl']);
			if(!$_founder) {
				$do->userid = $userid;
				$user = $do->get_one();
				if($user['groupid'] == 1) msg('您無權登入其他管理員會員中心');
				if($_admin > 1 && $user['support'] && $user['support'] != $_username) msg('您無權登入該會員的會員中心');
			}
			$auth = encrypt($userid.'|'.$_username);
			set_cookie('admin_user', $auth);
			msg('授權成功，正在轉入會員商務中心...', $MODULE[2]['linkurl']);
		} else {
			msg();
		}
	break;
	case 'unlock':
		$ip or msg('請填寫需要解鎖的IP');
		$ipfile = DT_CACHE.'/ban/'.$ip.'.php';
		if(is_file($ipfile)) {
			cache_delete($ip.'.php', 'ban');
			msg('IP:'.$ip.' 已經成功解除鎖定', $forward);
		} else {
			msg('IP:'.$ip.' 未被系統鎖定');
		}
	break;
	default:
		$members = $do->get_list($condition, $dorder[$order]);
		include tpl('member', $module);
	break;
}
?>