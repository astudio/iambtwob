<?php
defined('IN_DESTOON') or exit('Access Denied');
/*請按照您的實際情況配置以下各參數*/

//私鑰文件，在CHINAPAY申請商戶號時獲取，請相應修改此處，可填相對路徑，下同
define("PRI_KEY", DT_ROOT.'/api/pay/chinapay/'.$PAY[$bank]['partnerid']);
//公鑰文件，示例中已經包含
define("PUB_KEY", DT_ROOT.'/api/pay/chinapay/PgPubk.key');

/*如您已有生產密鑰，請修改以下配置，默認為測試環境*/

//支付請求地址(測試)
//define("REQ_URL_PAY","http://payment-test.ChinaPay.com/pay/TransGet");
//支付請求地址(生產)
define("REQ_URL_PAY","https://payment.ChinaPay.com/pay/TransGet");

//查詢請求地址(測試)
//define("REQ_URL_QRY","http://payment-test.chinapay.com/QueryWeb/processQuery.jsp");
//查詢請求地址(生產)
define("REQ_URL_QRY","http://console.chinapay.com/QueryWeb/processQuery.jsp");

//退款請求地址(測試)
//define("REQ_URL_REF","http://payment-test.chinapay.com/refund/SingleRefund.jsp");
//退款請求地址(生產)
define("REQ_URL_REF","https://bak.chinapay.com/refund/SingleRefund.jsp");

function getcwdOL(){
$total = $_SERVER[PHP_SELF];
$file = explode("/", $total);
$file = $file[sizeof($file)-1];
return substr($total, 0, strlen($total)-strlen($file)-1);
}

function getSiteUrl(){
	$host = $_SERVER[SERVER_NAME];
	$port = ($_SERVER[SERVER_PORT]=="80")?"":":$_SERVER[SERVER_PORT]";
	return "http://" . $host . $port . getcwdOL();
}

function traceLog($file, $log){
	$f = fopen($file, 'a'); 
	if($f){
		fwrite($f, date('Y-m-d H:i:s') . " => $log\n");
		fclose($f);
	} 
}

//取得本示例安裝位置
$site_url = getSiteUrl();
?>