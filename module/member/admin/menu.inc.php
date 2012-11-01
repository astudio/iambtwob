<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array('添加會員', '?moduleid=2&action=add'),
	array('會員列表', '?moduleid=2'),
	array('審核會員', '?moduleid=2&action=check'),
	array(VIP.'管理', '?moduleid=4&file=vip'),
	array('聯繫會員', '?moduleid=2&file=contact'),
	array('在線會員', '?moduleid=2&file=online'),
	array('在線對話', '?moduleid=2&file=chat'),
	array('一鍵登錄', '?moduleid=2&file=oauth'),
	array('會員升級', '?moduleid=2&file=grade&action=check'),
	array('會員組管理', '?moduleid=2&file=group'),
	array('模塊設置', '?moduleid=2&file=setting'),
);
$menu_finance = array(
	array($DT['money_name'].'管理', '?moduleid=2&file=record'),
	array($DT['credit_name'].'管理', '?moduleid=2&file=credit'),
	array('短信管理', '?moduleid=2&file=sms&action=record'),
	array('充值記錄', '?moduleid=2&file=charge'),
	array('提現記錄', '?moduleid=2&file=cash'),
	array('信息支付', '?moduleid=2&file=pay'),
	array('充值卡管理', '?moduleid=2&file=card'),
	array('優惠碼管理', '?moduleid=2&file=promo'),
);
$menu_relate = array(
	array('客服中心', '?moduleid=2&file=ask'),
	array('資料認證', '?moduleid=2&file=validate'),
	array('電子郵件', '?moduleid=2&file=sendmail'),
	array('手機短信', '?moduleid=2&file=sms'),
	array('貿易提醒', '?moduleid=2&file=alert'),
	array('郵件訂閱', '?moduleid=2&file=mail'),
	array('站內信件', '?moduleid=2&file=message'),
	array('商機收藏', '?moduleid=2&file=favorite'),
	array('會員商友', '?moduleid=2&file=friend'),
	array('收貨地址', '?moduleid=2&file=address'),
	array('登錄日誌', '?moduleid=2&file=loginlog'),
);
if(!$_founder) unset($menu_relate[7]);
?>