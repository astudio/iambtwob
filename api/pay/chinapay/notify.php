<?php
$_DPOST = $_POST;
require '../../.../common.inc.php';
$_POST = $_DPOST;
if(!$_POST) exit('fail');
$bank = 'chinapay';
$PAY = cache_read('pay.php');
if(!$PAY[$bank]['enable']) exit('fail');
if(!$PAY[$bank]['partnerid']) exit('fail');
//if(!$PAY[$bank]['keycode']) exit('fail');
require DT_ROOT.'/include/module.func.php';
$receive_url = '';
function log_result($word) {
	log_write($word, 'nchinapay');
}
require DT_ROOT."/api/pay/chinapay/netpayclient_config.php";
//加載 netpayclient 組件
require DT_ROOT."/api/pay/chinapay/netpayclient.php";
//導入公鑰文件
$flag = buildKey(PUB_KEY);
$flag or exit('導入公鑰文件失敗！');

//獲取交易應答的各項值
$merid = $_POST["merid"];
$orderno = $_POST["orderno"];
$transdate = $_POST["transdate"];
$amount = $_POST["amount"];
$currencycode = $_POST["currencycode"];
$transtype = $_POST["transtype"];
$status = $_POST["status"];
$checkvalue = $_POST["checkvalue"];
$gateId = $_POST["GateId"];
$priv1 = $_POST["Priv1"];
$flag = verifyTransResponse($merid, $orderno, $amount, $currencycode, $transdate, $transtype, $status, $checkvalue);
if($flag) {
	if($status == '1001') {
		//您的處理邏輯請寫在這裡，如更新數據庫等。
		//注意：如果您在提交時同時填寫了頁面返回地址和後台返回地址，且地址相同，請在這裡先做一次數據庫查詢判斷訂單狀態，以防止重複處理該筆訂單
		$r = $db->get_one("SELECT * FROM {$DT_PRE}finance_charge WHERE itemid='$priv1'");
		if($r) {
			if($r['status'] == 0) {
				$charge_orderid = $r['itemid'];
				$charge_money = $r['amount'] + $r['fee'];
				$charge_amount = $r['amount'];
				$editor = 'N'.$bank;
				if($amount == padstr($charge_money*100, 12)) {
					$db->query("UPDATE {$DT_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$DT_TIME',editor='$editor' WHERE itemid=$charge_orderid");
					money_add($r['username'], $r['amount']);
					money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '在線充值', '訂單ID:'.$charge_orderid);
					exit('success');
				} else {
					$note = '充值金額不匹配S:'.$charge_money.'R:'.$amount;
					$db->query("UPDATE {$DT_PRE}finance_charge SET status=1,receivetime='$DT_TIME',editor='$editor',note='$note' WHERE itemid=$charge_orderid");//支付失敗
					log_result($note);
					exit('fail');
				}
			} else if($r['status'] == 1) {
				exit('fail');
			} else if($r['status'] == 2) {
				exit('fail');
			} else {
				exit('success');
			}
		} else {
			log_result('通知訂單號不存在R:'.$priv1);
			exit('fail');
		}
	}
}
exit('fail');
?>