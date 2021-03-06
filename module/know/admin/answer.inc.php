<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/answer.class.php';
$do = new answer();
$menus = array (
    array('答案列表', '?moduleid='.$moduleid.'&file='.$file),
    array('答案審核', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
);
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sfields = array('內容', '會員名', 'IP', '問題ID', '答案ID', '參考資料');
	$dfields = array('content', 'username', 'ip', 'qid', 'itemid', 'linkurl');
	$sorder  = array('結果排序方式', '添加時間降序', '添加時間升序', '投票次數降序', '投票次數升序');
	$dorder  = array('itemid desc', 'addtime DESC', 'addtime ASC', 'vote DESC', 'vote ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	isset($ip) or $ip = '';
	$qid = isset($qid) ? intval($qid) : 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= in_array($dfields[$fields], array('qid', 'itemid', 'ip')) ? " AND $dfields[$fields]='$kw'" : " AND $dfields[$fields] LIKE '%$keyword%'";
	if($qid) $condition .= " AND qid='$qid'";
	if($ip) $condition .= " AND ip='$ip'";
}
switch($action) {
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
			extract($do->get_one());
			$addtime = timetodate($addtime);
			include tpl('answer_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('請選擇答案');
		$do->delete($itemid);
		dmsg('刪除成功', $this_forward);
	break;
	case 'check':
		if($itemid) {
			$status = $status == 3 ? 3 : 2;
			$do->check($itemid, $status);
			dmsg($status == 3 ? '審核成功' : '取消成功', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			$menuid = 1;
			include tpl('answer', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 0;
		include tpl('answer', $module);
	break;
}
?>