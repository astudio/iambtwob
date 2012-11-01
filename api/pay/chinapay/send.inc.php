<?php
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT."/api/pay/chinapay/netpayclient_config.php";
//加載 netpayclient 組件
require DT_ROOT."/api/pay/chinapay/netpayclient.php";
//導入私鑰文件, 返回值即為您的商戶號，長度15位
$merid = buildKey(PRI_KEY);
$merid or exit('導入私鑰文件失敗！');

//生成訂單號，定長16位，任意數字組合，一天內不允許重複，本例採用當前時間戳，必填
$ordid = "00" . date('YmdHis');
//訂單金額，定長12位，以分為單位，不足左補0，必填
$transamt = padstr($charge*100,12);
//貨幣代碼，3位，境內商戶固定為156，表示人民幣，必填
$curyid = "156";
//訂單日期，本例採用當前日期，必填
$transdate = date('Ymd');
//交易類型，0001 表示支付交易，0002 表示退款交易
$transtype = "0001";
//接口版本號，境內支付為 20070129，必填
$version = "20070129";
//頁面返回地址(您服務器上可訪問的URL)，最長80位，當用戶完成支付後，銀行頁面會自動跳轉到該頁面，並POST訂單結果信息，可選
$pagereturl = $receive_url;
//後台返回地址(您服務器上可訪問的URL)，最長80位，當用戶完成支付後，我方服務器會POST訂單結果信息到該頁面，必填
$bgreturl = DT_PATH.'api/pay/'.$bank.'/notify.php';

/************************
頁面返回地址和後台返回地址的區別：
後台返回從我方服務器發出，不受用戶操作和瀏覽器的影響，從而保證交易結果的送達。
************************/

//支付網關號，4位，上線時建議留空，以跳轉到銀行列表頁面由用戶自由選擇，本示例選用0001農商行網關便於測試，可選
$gateid = "";//"0001";
//備註，最長60位，交易成功後會原樣返回，可用於額外的訂單跟蹤等，可選
$priv1 = $orderid;//設置為訂單ID

//按次序組合訂單信息為待簽名串
$plain = $merid . $ordid . $transamt . $curyid . $transdate . $transtype . $priv1;
//生成簽名值，必填
$chkvalue = sign($plain);
$chkvalue or exit('簽名失敗！');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>">
<title>正在跳轉到<?php echo $PAY[$bank]['name'];?>在線支付平台...</title>
</head>
<body onload="document.getElementById('pay').submit();">
<form method="post" action="<?php echo REQ_URL_PAY;?>" id="pay">
<input type="hidden" name="MerId"		value="<?php echo $merid;?>">
<input type="hidden" name="Version"     value="<?php echo $version;?>">
<input type="hidden" name="OrdId"		value="<?php echo $ordid;?>">
<input type="hidden" name="TransAmt"    value="<?php echo $transamt;?>">
<input type="hidden" name="CuryId"		value="<?php echo $curyid;?>">
<input type="hidden" name="TransDate"   value="<?php echo $transdate;?>">
<input type="hidden" name="TransType"   value="<?php echo $transtype;?>">
<input type="hidden" name="BgRetUrl"    value="<?php echo $bgreturl;?>">
<input type="hidden" name="PageRetUrl"  value="<?php echo $pagereturl;?>">
<input type="hidden" name="GateId"      value="<?php echo $gateid;?>">
<input type="hidden" name="Priv1"		value="<?php echo $priv1;?>">
<input type="hidden" name="ChkValue"    value="<?php echo $chkvalue;?>">
</form>
</body>
</html>