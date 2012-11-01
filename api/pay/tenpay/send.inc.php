<?php
defined('IN_DESTOON') or exit('Access Denied');
//---------------------------------------------------------
//財付通即時到帳支付請求示例，商戶按照此文檔進行開發即可
//---------------------------------------------------------
require_once (DT_ROOT."/api/pay/tenpay/PayRequestHandler.class.php");

/* 商戶號 */
$bargainor_id = $PAY[$bank]['partnerid'];

/* 密鑰 */
$key = $PAY[$bank]['keycode'];

/* 返回處理地址 */
$return_url = $receive_url;

//date_default_timezone_set(PRC);
$strDate = date("Ymd", $DT_TIME);
$strTime = date("His", $DT_TIME);

//4位隨機數
$randNum = rand(1000, 9999);

//10位序列號,可以自行調整。
$strReq = $strTime . $randNum;

/* 商家訂單號,長度若超過32位，取前32位。財付通只記錄商家訂單號，不保證唯一。 */
$sp_billno = $orderid;

/* 財付通交易單號，規則為：10位商戶號+8位時間（YYYYmmdd)+10位流水號 */
$transaction_id = $bargainor_id . $strDate . $strReq;

/* 商品價格（包含運費），以分為單位 */
$total_fee = $charge*100;

/* 商品名稱 */
$desc = '會員('.$_username.')帳戶充值(訂單號:'.$orderid.')';

/* 創建支付請求對像 */
$reqHandler = new PayRequestHandler();
$reqHandler->init();
$reqHandler->setKey($key);

//----------------------------------------
//設置支付參數
//----------------------------------------
$reqHandler->setParameter("bargainor_id", $bargainor_id);			//商戶號
$reqHandler->setParameter("sp_billno", $sp_billno);					//商戶訂單號
$reqHandler->setParameter("transaction_id", $transaction_id);		//財付通交易單號
$reqHandler->setParameter("total_fee", $total_fee);					//商品總金額,以分為單位
$reqHandler->setParameter("return_url", $return_url);				//返回處理地址
$reqHandler->setParameter("desc", $desc);	//商品名稱

//用戶ip,測試環境時不要加這個ip參數，正式環境再加此參數
$reqHandler->setParameter("spbill_create_ip", $DT_IP);

//請求的URL
$reqUrl = $reqHandler->getRequestURL();

//debug信息
//$debugInfo = $reqHandler->getDebugInfo();

//echo "<br/>" . $reqUrl . "<br/>";
//echo "<br/>" . $debugInfo . "<br/>";

//重定向到財付通支付
//$reqHandler->doSend();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>">
<title>正在跳轉到<?php echo $PAY[$bank]['name'];?>在線支付平台...</title>
</head>
<body onload="document.getElementById('pay').submit();">
<?php
$tmp = parse_url($reqUrl);
parse_str($tmp['query'], $par);
$act = $tmp['scheme'].'://'.$tmp['host'].$tmp['path'];
echo '<form method="post" action="'.$act.'" id="pay">';
foreach($par as $k=>$v) {
	echo '<input type="hidden" name="'.$k.'" value="'.$v.'"/>';
}
echo '</form>';
?>
</body>
</html>