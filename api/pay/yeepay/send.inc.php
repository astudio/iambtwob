<?php
defined('IN_DESTOON') or exit('Access Denied');
/*
 * @Description 易寶支付產品通用支付接口範例 
 * @V3.0
 * @Author rui.xin
 */

include DT_ROOT.'/api/pay/yeepay/yeepayCommon.php';	
		
#	商家設置用戶購買商品的支付信息.
##易寶支付平台統一使用GBK/GB2312編碼方式,參數如用到中文，請注意轉碼

#	商戶訂單號,選填.
##若不為""，提交的訂單號必須在自身賬戶交易中唯一;為""時，易寶支付會自動生成隨機的商戶訂單號.
$p2_Order					= $orderid;

#	支付金額,必填.
##單位:元，精確到分.
$p3_Amt						= $charge;

#	交易幣種,固定值"CNY".
$p4_Cur						= "CNY";

#	商品名稱
##用於支付時顯示在易寶支付網關左側的訂單產品信息.

$desc = '會員('.$_username.')帳戶充值(訂單號:'.$orderid.')';

$p5_Pid						= convert($desc, DT_CHARSET, 'GBK');

#	商品種類
$p6_Pcat					= '';

#	商品描述
$p7_Pdesc					= '';

#	商戶接收支付成功數據的地址,支付成功後易寶支付會向該地址發送兩次成功通知.
$p8_Url						= $receive_url;

#	商戶擴展信息
##商戶可以任意填寫1K 的字符串,支付成功時將原樣返回.												
$pa_MP						= '';

#	支付通道編碼
##默認為""，到易寶支付網關.若不需顯示易寶支付的頁面，直接跳轉到各銀行、神州行支付、駿網一卡通等支付頁面，該字段可依照附錄:銀行列表設置參數值.			
$pd_FrpId					= '';

#	應答機制
##默認為"1": 需要應答機制;
$pr_NeedResponse	= "1";

#調用簽名函數生成簽名串
$hmac = getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);
     
?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>">
<title>正在跳轉到<?php echo $PAY[$bank]['name'];?>在線支付平台...</title>
</head>
<body onload="document.getElementById('pay').submit();">
<form action="<?php echo $reqURL_onLine; ?>" method="post" id="pay">
<input type='hidden' name='p0_Cmd'					value='<?php echo $p0_Cmd; ?>'>
<input type='hidden' name='p1_MerId'				value='<?php echo $p1_MerId; ?>'>
<input type='hidden' name='p2_Order'				value='<?php echo $p2_Order; ?>'>
<input type='hidden' name='p3_Amt'					value='<?php echo $p3_Amt; ?>'>
<input type='hidden' name='p4_Cur'					value='<?php echo $p4_Cur; ?>'>
<input type='hidden' name='p5_Pid'					value='<?php echo $p5_Pid; ?>'>
<input type='hidden' name='p6_Pcat'					value='<?php echo $p6_Pcat; ?>'>
<input type='hidden' name='p7_Pdesc'				value='<?php echo $p7_Pdesc; ?>'>
<input type='hidden' name='p8_Url'					value='<?php echo $p8_Url; ?>'>
<input type='hidden' name='p9_SAF'					value='<?php echo $p9_SAF; ?>'>
<input type='hidden' name='pa_MP'						value='<?php echo $pa_MP; ?>'>
<input type='hidden' name='pd_FrpId'				value='<?php echo $pd_FrpId; ?>'>
<input type='hidden' name='pr_NeedResponse'	value='<?php echo $pr_NeedResponse; ?>'>
<input type='hidden' name='hmac'						value='<?php echo $hmac; ?>'>
</form>
</body>
</html>