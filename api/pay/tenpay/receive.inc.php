<?php
defined('IN_DESTOON') or exit('Access Denied');
//---------------------------------------------------------
//財付通即時到帳支付應答（處理回調）示例，商戶按照此文檔進行開發即可
//---------------------------------------------------------

require_once (DT_ROOT."/api/pay/tenpay/PayResponseHandler.class.php");

/* 密鑰 */
$key = $PAY[$bank]['keycode'];

/* 創建支付應答對像 */
$resHandler = new PayResponseHandler();
$resHandler->setKey($key);

//判斷簽名
if($resHandler->isTenpaySign()) {
	
	//交易單號
	$transaction_id = $resHandler->getParameter("transaction_id");
	
	//金額,以分為單位
	$total_fee = $resHandler->getParameter("total_fee");
	
	//支付結果
	$pay_result = $resHandler->getParameter("pay_result");

	$out_trade_no = $resHandler->getParameter("sp_billno");
	$total_fee = $total_fee/100;
	
	if( "0" == $pay_result ) {
	
		//------------------------------
		//處理業務開始
		//------------------------------
		
		//注意交易單不要重複處理
		//注意判斷返回金額
		
		//------------------------------
		//處理業務完畢
		//------------------------------
		if($out_trade_no != $charge_orderid) {
			$charge_status = 2;
			$charge_errcode = '訂單號不匹配';
			$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$out_trade_no;
			log_write($note, 'rtenpay');
		} else if($total_fee != $charge_money) {
			$charge_status = 2;
			$charge_errcode = '充值金額不匹配';
			$note = $charge_errcode.'S:'.$charge_money.'R:'.$total_fee;
			log_write($note, 'rtenpay');
		} else {
			$charge_status = 1;
			$db->query("UPDATE {$DT_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$DT_TIME',editor='$editor' WHERE itemid=$charge_orderid");
			money_add($r['username'], $r['amount']);
			money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '在線充值', '訂單ID:'.$charge_orderid);
			$show = linkurl($MOD['linkurl'], 1).'charge.php';
			$resHandler->doShow($show);
		}
		
		//調用doShow, 打印meta值跟js代碼,告訴財付通處理成功,並在用戶瀏覽器顯示$show頁面.
	
	} else {
		//當做不成功處理
		//echo "<br/>" . "支付失敗" . "<br/>";
	}
	
} else {
	//echo "<br/>" . "認證簽名失敗" . "<br/>";
}

//echo $resHandler->getDebugInfo();

?>