<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT."/api/pay/alipay/service.class.php";
require DT_ROOT."/api/pay/alipay/config.inc.php";
$parameter = array(
	'service' => $service_type,	//交易類型，必填實物交易＝trade_create_by_buyer（需要填寫物流） 虛擬物品交易＝create_digital_goods_trade_p
	'partner' =>$partner,					//合作商戶號
	'return_url' =>$return_url,				//同步返回
	'notify_url' =>$notify_url,				//異步返回
	'_input_charset' => $_input_charset,	//字符集，默認為GBK
	'subject' => $DT['sitename'].'會員充值',	//商品名稱，必填
	'body' => '會員('.$_username.')帳戶充值(訂單號:'.$orderid.')',      //商品描述，必填

	"out_trade_no"   => $orderid,     //商品外部交易號，必填（保證唯一性）
	"price"          => $charge,           //商品單價，必填（價格不能為0）
	"payment_type"   => "1",              //默認為1,不需要修改
	"quantity"       => "1",              //商品數量，必填
		
	"logistics_fee"      =>'0.00',        //物流配送費用
	"logistics_payment"  =>'SELLER_PAY',   //物流費用付款方式：SELLER_PAY(賣家支付)、BUYER_PAY(買家支付)、BUYER_PAY_AFTER_RECEIVE(貨到付款)
	"logistics_type"     =>'EXPRESS',     //物流配送方式：POST(平郵)、EMS(EMS)、EXPRESS(其他快遞)

	"show_url"       => $show_url,        //商品相關網站
	"seller_email"   => $seller_email,     //賣家郵箱，必填
	"buyer_email"    =>  $_email,
);

//對URL組合
$alipay = new alipay_service($parameter, $security_code, $sign_type);
$URI = $alipay->create_url();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>">
<title>正在跳轉到<?php echo $PAY[$bank]['name'];?>在線支付平台...</title>
<meta http-equiv="refresh" content="0;url=<?php echo $URI;?>">
</head>
<body>
</body>
</html>