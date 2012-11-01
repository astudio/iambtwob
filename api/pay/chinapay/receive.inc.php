<?php
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT."/api/pay/chinapay/netpayclient_config.php";
//加載 netpayclient 組件
require DT_ROOT."/api/pay/chinapay/netpayclient.php";
//導入公鑰文件
$flag = buildKey(PUB_KEY);
if(!$flag) {
	echo "導入公鑰文件失敗！";
	exit;
}
//獲取交易應答的各項值
$merid = $merid;
$orderno = $orderno;
$transdate = $transdate;
$amount = $amount;
$currencycode = $currencycode;
$transtype = $transtype;
$status = $status;
$checkvalue = $checkvalue;
$gateId = $GateId;
$priv1 = $Priv1;
/*	
	$merid = $_REQUEST["merid"];
	$orderno = $_REQUEST["orderno"];
	$transdate = $_REQUEST["transdate"];
	$amount = $_REQUEST["amount"];
	$currencycode = $_REQUEST["currencycode"];
	$transtype = $_REQUEST["transtype"];
	$status = $_REQUEST["status"];
	$checkvalue = $_REQUEST["checkvalue"];
	$gateId = $_REQUEST["GateId"];
	$priv1 = $_REQUEST["Priv1"];

	echo "商戶號: [$merid]<br/>";
	echo "訂單號: [$orderno]<br/>";
	echo "訂單日期: [$transdate]<br/>";
	echo "訂單金額: [$amount]<br/>";
	echo "貨幣代碼: [$currencycode]<br/>";
	echo "交易類型: [$transtype]<br/>";
	echo "交易狀態: [$status]<br/>";
	echo "網關號: [$gateId]<br/>";
	echo "備註: [$priv1]<br/>";
	echo "簽名值: [$checkvalue]<br/>";
	echo "===============================<br/>";
*/	
//驗證簽名值，true 表示驗證通過
$flag = verifyTransResponse($merid, $orderno, $amount, $currencycode, $transdate, $transtype, $status, $checkvalue);
if($flag) {
	if($status == '1001') {
		//您的處理邏輯請寫在這裡，如更新數據庫等。
		//注意：如果您在提交時同時填寫了頁面返回地址和後台返回地址，且地址相同，請在這裡先做一次數據庫查詢判斷訂單狀態，以防止重複處理該筆訂單
		if($priv1 != $charge_orderid) {
			$charge_status = 2;
			$charge_errcode = '訂單號不匹配';
			$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$priv1;
			log_write($note, 'rchinapay');
		} else if($amount != padstr($charge_money*100, 12)) {
			$charge_status = 2;
			$charge_errcode = '充值金額不匹配';
			$note = charge_errcode.'S:'.$charge_money.'R:'.$amount;
			log_write($note, 'rchinapay');
		} else {
			$charge_status = 1;
		}
	}
}