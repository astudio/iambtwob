<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('添加會員', '?moduleid='.$moduleid.'&action=add'),
    array('會員列表', '?moduleid='.$moduleid),
    array('審核會員', '?moduleid='.$moduleid.'&action=check'),
    array('會員升級', '?moduleid='.$moduleid.'&file=grade&action=check'),
    array('聯繫會員', '?moduleid='.$moduleid.'&file=contact'),
    array('公司列表', '?moduleid=4'),
    array(VIP.'列表', '?moduleid=4&file=vip'),
);
$CATEGORY = cache_read('category-4.php');

$sfields = array('按條件', '公司名', '會員名', '通行證名','姓名', '部門', '職位', '手機號碼','電話號碼','傳真號碼', '詳細地址', '郵政編碼', '公司類型', '公司規模', '銷售', '採購', '主營行業', '經營模式', 'Email', 'QQ', 'MSN', '阿里旺旺', 'Skype', '註冊IP', '登錄IP', '推薦人');
$dfields = array('m.username', 'm.company', 'm.username', 'm.passport', 'm.truename', 'm.department', 'm.career', 'm.mobile', 'c.telephone', 'c.fax', 'c.address', 'c.postcode', 'c.type', 'c.size', 'c.sell', 'c.buy', 'c.business', 'c.mode', 'm.email', 'm.qq', 'm.msn', 'm.ali', 'm.skype', 'm.regip', 'm.loginip', 'm.inviter');
$sorder  = array('結果排序方式', '註冊時間降序', '註冊時間升序', '登錄時間降序', '登錄時間升序', '登錄次數降序', '登錄次數升序', '賬戶'.$DT['money_name'].'降序', '賬戶'.$DT['money_name'].'升序', '會員'.$DT['credit_name'].'降序', '會員'.$DT['credit_name'].'升序', '短信餘額降序', '短信餘額升序', VIP.'指數降序', VIP.'指數升序', '註冊年份降序', '註冊年份升序', '註冊資本降序', '註冊資本升序', '服務開始降序', '服務開始升序', '服務結束降序', '服務結束升序','瀏覽人氣降序','瀏覽人氣升序');
$dorder  = array('m.userid DESC', 'm.regtime DESC', 'm.regtime ASC', 'm.logintime DESC', 'm.logintime ASC', 'm.logintimes DESC', 'm.logintimes ASC', 'm.money DESC', 'm.money ASC', 'm.credit DESC', 'm.credit ASC', 'm.sms DESC', 'm.sms ASC', 'c.vip DESC', 'c.vip ASC', 'c.regyear DESC', 'c.regyear ASC', 'c.capital DESC', 'c.capital ASC', 'c.fromtime DESC', 'c.fromtime ASC', 'c.totime DESC', 'c.totime ASC', 'c.hits DESC', 'c.hits ASC');
$sgender = array('性別', '先生' , '女士');
$sprofile = array('資料', '已完善' , '未完善');
$semail = array('郵件', '已認證' , '未認證');
$smobile = array('手機', '已認證' , '未認證');
$struename = array('實名', '已認證' , '未認證');
$sbank = array('銀行', '已認證' , '未認證');
$scompany = array('公司', '已認證' , '未認證');
$svalid = array('認證', '已通過' , '未通過');
$modes = explode('|', '經營模式|'.$MOD['com_mode']);
$types = explode('|', '公司類型|'.$MOD['com_type']);
$sizes = explode('|', '公司規模|'.$MOD['com_size']);
		
$thumb = isset($thumb) ? intval($thumb) : 0;
$mincapital = isset($mincapital) ? dround($mincapital) : '';
$mincapital or $mincapital = '';
$maxcapital = isset($maxcapital) ? dround($maxcapital) : '';
$maxcapital or $maxcapital = '';
$areaid = isset($areaid) ? intval($areaid) : 0;
isset($mode) && isset($modes[$mode]) or $mode = 0;
isset($type) && isset($types[$type]) or $type = 0;
isset($size) && isset($sizes[$size]) or $size = 0;
$vip = isset($vip) ? ($vip === '' ? -1 : intval($vip)) : -1;
$valid = isset($valid) ? intval($valid) : 0;
isset($fields) && isset($dfields[$fields]) or $fields = 0;
isset($order) && isset($dorder[$order]) or $order = 0;
$groupid = isset($groupid) ? intval($groupid) : 0;
$gender = isset($gender) ? intval($gender) : 0;
$export = isset($export) ? intval($export) : 0;
$uid = isset($uid) ? intval($uid) : '';
$username = isset($username) ? trim($username) : '';
$vprofile = isset($vprofile) ? intval($vprofile) : 0;
$vemail = isset($vemail) ? intval($vemail) : 0;
$vmobile = isset($vmobile) ? intval($vmobile) : 0;
$vtruename = isset($vtruename) ? intval($vtruename) : 0;
$vbank = isset($vbank) ? intval($vbank) : 0;
$vcompany = isset($vcompany) ? intval($vcompany) : 0;
isset($fromtime) or $fromtime = '';
isset($totime) or $totime = '';
isset($timetype) or $timetype = 'm.regtime';
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
$valid_select = dselect($svalid, 'valid', '', $valid);
$mode_select = dselect($modes, 'mode', '', $mode);
$type_select = dselect($types, 'type', '', $type);
$size_select = dselect($sizes, 'size', '', $size);

$condition = 'm.userid=c.userid';//
if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
if($gender) $condition .= " AND m.gender=$gender";
if($groupid) $condition .= " AND m.groupid=$groupid";
if($uid) $condition .= " AND m.userid=$uid";
if($username) $condition .= " AND m.username='$username'";
if($vprofile) $condition .= $vprofile == 1 ? " AND m.edittime>0" : " AND m.edittime=0";
if($vemail) $condition .= $vemail == 1 ? " AND m.vemail>0" : " AND m.vemail=0";
if($vmobile) $condition .= $vmobile == 1 ? " AND m.vmobile>0" : " AND m.vmobile=0";
if($vtruename) $condition .= $vtruename == 1 ? " AND m.vtruename>0" : " AND m.vtruename=0";
if($vbank) $condition .= $vbank == 1 ? " AND m.vbank>0" : " AND m.vbank=0";
if($vcompany) $condition .= $vcompany == 1 ? " AND m.vcompany>0" : " AND m.vcompany=0";
if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
if($minmoney) $condition .= " AND m.money>=$minmoney";
if($maxmoney) $condition .= " AND m.money<=$maxmoney";
if($mincredit) $condition .= " AND m.credit>=$mincredit";
if($maxcredit) $condition .= " AND m.credit<=$maxcredit";
if($minsms) $condition .= " AND m.sms>=$minsms";
if($maxsms) $condition .= " AND m.sms<=$maxsms";
if($valid) $condition .= $valid == 1 ? " AND c.validated=1" : " AND c.validated=0";
if($catid) $condition .= " AND c.catids LIKE '%,".$catid.",%'";
if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND c.areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND c.areaid=$areaid";
if($mode) $condition .= " AND c.mode LIKE '%$modes[$mode]%'";
if($type) $condition .= " AND c.type='$types[$type]'";
if($size) $condition .= " AND c.size='$sizes[$size]'";
if($mincapital) $condition .= " AND c.capital>$mincapital";
if($maxcapital) $condition .= " AND c.capital<$maxcapital";
$order = $dorder[$order];
if($export) {
	$data = '會員ID,會員名,會員組,公司名,聯繫人,職位,性別,電話,手機,電子郵件,QQ,阿里旺旺,MSN,Skype,詳細地址,郵編,註冊時間,最後登錄,登錄次數,資金餘額,積分餘額,短信餘額,'.VIP.'指數'."\n";
	$result = $db->query("SELECT * FROM {$DT_PRE}member m,{$DT_PRE}company c WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$data .= $r['userid'].',';
		$data .= $r['username'].',';
		$data .= $GROUP[$r['groupid']]['groupname'].',';
		$data .= $r['company'].',';
		$data .= $r['truename'].',';
		$data .= $r['career'].',';
		$data .= gender($r['gender']).',';
		$data .= $r['telephone'].',';
		$data .= $r['mobile'].',';
		$data .= $r['email'].',';
		$data .= $r['qq'].',';
		$data .= $r['ali'].',';
		$data .= $r['msn'].',';
		$data .= $r['skype'].',';
		$data .= $r['address'].',';
		$data .= $r['postcode'].',';
		$data .= timetodate($r['regtime']).',';
		$data .= timetodate($r['logintime']).',';
		$data .= $r['logintimes'].',';
		$data .= $r['money'].',';
		$data .= $r['credit'].',';
		$data .= $r['sms'].',';
		$data .= $r['vip'].',';
		$data .= "\n";
	}
	$data = convert($data, DT_CHARSET, 'GBK');
	file_down('', 'contact.csv', $data);
}
$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}member m,{$DT_PRE}company c WHERE $condition");
$pages = pages($r['num'], $page, $pagesize);
$members = array();
$result = $db->query("SELECT * FROM {$DT_PRE}member m,{$DT_PRE}company c WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
while($r = $db->fetch_array($result)) {
	$r['logindate'] = timetodate($r['logintime'], 5);
	$r['regdate'] = timetodate($r['regtime'], 5);
	$members[] = $r;
}
include tpl('contact', $module);
?>