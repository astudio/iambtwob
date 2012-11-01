<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT."/api/pay/alipay/notify.class.php";
require DT_ROOT."/api/pay/alipay/config.inc.php";
/*
	*功能：付完款後跳轉的頁面
	*版本：2.0
	*日期：2008-08-01
	*作者：支付寶公司銷售部技術支持團隊
	*聯繫：0571-26888888
	*版權：支付寶公司
*/

$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->return_verify();
/*
 //獲取支付寶的反饋參數
   //$dingdan    = $out_trade_no;   //獲取訂單號
   //$total_fee  = $total_fee;      //獲取總價格
 
    $receive_name    =$receive_name;    //獲取收貨人姓名
	$receive_address =$receive_address; //獲取收貨人地址
	$receive_zip     =$receive_zip;     //獲取收貨人郵編
	$receive_phone   =$receive_phone;   //獲取收貨人電話
	$receive_mobile  =$receive_mobile;  //獲取收貨人手機
*/

if($verify_result) {    //認證合格
	if($out_trade_no != $charge_orderid) {
		$charge_status = 2;
		$charge_errcode = '訂單號不匹配';
		$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$out_trade_no;
		log_result($note);
	} else if($total_fee != $charge_money) {
		$charge_status = 2;
		$charge_errcode = '充值金額不匹配';
		$note = $charge_errcode.'S:'.$charge_money.'R:'.$total_fee;
		log_result($note);
	} else {
		$charge_status = 1;
	}
	//這裡放入你自定義代碼,比如根據不同的trade_status進行不同操作
	//log_result("verify_success"); 
}
function log_result($word) {
	log_write($word, 'ralipay');
}
?>