<?php
defined('IN_DESTOON') or exit('Access Denied');
$v_mid = $PAY[$bank]['partnerid']; // 商戶號
$v_url = $receive_url; // 返回url
$key = $PAY[$bank]['keycode']; // MD5密鑰

$v_oid = $orderid; 
$v_amount = $charge; //支付金額                 
$v_moneytype = 'CNY'; //幣種

$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key; //md5加密拼湊串,注意順序
$v_md5info = strtoupper(md5($text));

$remark1 = $DT['sitename'].' - 會員['.$_username.']帳戶充值'; //備註字段1
$remark2 = isset($remark2) ? trim($remark2) : ''; //備註字段2
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>">
<title>正在跳轉到<?php echo $PAY[$bank]['name'];?>在線支付平台...</title>
</head>
<body onload="document.getElementById('pay').submit();">
<form method="post" action="https://pay.chinabank.com.cn/select_bank" id="pay">
<input type="hidden" name="v_mid"       value="<?php echo $v_mid;?>">
<input type="hidden" name="v_oid"       value="<?php echo $v_oid;?>">
<input type="hidden" name="v_amount"    value="<?php echo $v_amount;?>">
<input type="hidden" name="v_moneytype" value="<?php echo $v_moneytype;?>">
<input type="hidden" name="v_url"       value="<?php echo $v_url;?>">
<input type="hidden" name="v_md5info"   value="<?php echo $v_md5info;?>">
<input type="hidden" name="remark1"     value="<?php echo $remark1;?>">
<input type="hidden" name="remark2"     value="<?php echo $remark2;?>">
</form>
</body>
</html>