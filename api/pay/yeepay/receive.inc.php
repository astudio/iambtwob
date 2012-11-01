<?php
defined('IN_DESTOON') or exit('Access Denied');
/*
 * @Description 易寶支付B2C在線支付接口範例 
 * @V3.0
 * @Author rui.xin
 */
 
include DT_ROOT.'/api/pay/yeepay/yeepayCommon.php';	
	
#	只有支付成功時易寶支付才會通知商戶.
##支付成功回調有兩次，都會通知到在線支付請求參數中的p8_Url上：瀏覽器重定向;服務器點對點通訊.

#	解析返回參數.
$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

#	判斷返回簽名是否正確（True/False）
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
#	以上代碼和變量不需要修改.
	 	
#	校驗碼正確.
if($bRet){
	if($r1_Code=="1"){
		
	#	需要比較返回的金額與商家數據庫中訂單的金額是否相等，只有相等的情況下才認為是交易成功.
	#	並且需要對返回的處理進行事務控制，進行記錄的排它性處理，在接收到支付結果通知後，判斷是否進行過業務邏輯處理，不要重複進行業務邏輯處理，防止對同一條交易重複發貨的情況發生.      	  	
		
		if($r9_BType=="1"){
			if($r6_Order != $charge_orderid) {
				$charge_status = 2;
				$charge_errcode = '訂單號不匹配';
				$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$r6_Order;
				log_write($note, 'ryeepay');
			} else if($r3_Amt != $charge_money) {
				$charge_status = 2;
				$charge_errcode = '充值金額不匹配';
				$note = charge_errcode.'S:'.$charge_money.'R:'.$r3_Amt;
				log_write($note, 'ryeepay');
			} else {
				$charge_status = 1;
			}
			//echo "交易成功";
			//echo  "<br />在線支付頁面返回";
		}elseif($r9_BType=="2"){
			#如果需要應答機制則必須回寫流,以success開頭,大小寫不敏感.
			//echo "success";
			//echo "<br />交易成功";
			//echo  "<br />在線支付服務器返回";      			 
		}
	}
	
}else{
	//echo "交易信息被篡改";
}
   
?>