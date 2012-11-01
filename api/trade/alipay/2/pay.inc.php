<?php
defined('IN_DESTOON') or exit('Access Denied');
set_cookie('trade_id', $itemid);
require_once DT_ROOT.'/api/trade/alipay/2/pay/alipay_service.class.php';

/**************************請求參數**************************/

//必填參數//

$out_trade_no		= $itemid;		//請與貴網站訂單系統中的唯一訂單號匹配
$subject			= $td['title'];	//訂單名稱，顯示在支付寶收銀台裡的「商品名稱」裡，顯示在支付寶的交易管理的「商品名稱」的列表裡。
$body				= $td['note'];	//訂單描述、訂單詳細、訂單備註，顯示在支付寶收銀台裡的「商品描述」裡
$price				= $money;	//訂單總金額，顯示在支付寶收銀台裡的「應付總額」裡

$logistics_fee		= "0.00";				//物流費用，即運費。
$logistics_type		= "EXPRESS";			//物流類型，三個值可選：EXPRESS（快遞）、POST（平郵）、EMS（EMS）
$logistics_payment	= "SELLER_PAY";			//物流支付方式，兩個值可選：SELLER_PAY（賣家承擔運費）、BUYER_PAY（買家承擔運費）

$quantity			= "1";					//商品數量，建議默認為1，不改變值，把一次交易看成是一次下訂單而非購買一件商品。

//選填參數//

//買家收貨信息（推薦作為必填）
//該功能作用在於買家已經在商戶網站的下單流程中填過一次收貨信息，而不需要買家在支付寶的付款流程中再次填寫收貨信息。
//若要使用該功能，請至少保證receive_name、receive_address有值
//收貨信息格式請嚴格按照姓名、地址、郵編、電話、手機的格式填寫
$receive_name		= $td['buyer_name'];			//收貨人姓名，如：張三
$receive_address	= $td['buyer_address'];			//收貨人地址，如：XX省XXX市XXX區XXX路XXX小區XXX棟XXX單元XXX號
$receive_zip		= $td['buyer_postcode'];				//收貨人郵編，如：123456
$receive_phone		= $td['buyer_phone'];		//收貨人電話號碼，如：0571-81234567
$receive_mobile		= $td['buyer_phone'];		//收貨人手機號碼，如：13312341234

//網站商品的展示地址，不允許加?id=123這類自定義參數
$show_url			= DT_PATH.'api/trade/alipay/show.php';

/************************************************************/
//構造要請求的參數數組
$parameter = array(
		"service"		=> "trade_create_by_buyer",
		"payment_type"	=> "1",
		
		"partner"		=> trim($aliapy_config['partner']),
		"_input_charset"=> trim(strtolower($aliapy_config['input_charset'])),
		"seller_email"	=> trim($aliapy_config['seller_email']),
		"return_url"	=> trim($aliapy_config['return_url']),
		"notify_url"	=> trim($aliapy_config['notify_url']),

		"out_trade_no"	=> $out_trade_no,
		"subject"		=> $subject,
		"body"			=> $body,
		"price"			=> $price,
		"quantity"		=> $quantity,

		"buyer_email" => $_trade,//DT ADD
		
		"logistics_fee"		=> $logistics_fee,
		"logistics_type"	=> $logistics_type,
		"logistics_payment"	=> $logistics_payment,

		
		"receive_name"		=> $receive_name,
		"receive_address"	=> $receive_address,
		"receive_zip"		=> $receive_zip,
		"receive_phone"		=> $receive_phone,
		"receive_mobile"	=> $receive_mobile,
		
		"show_url"		=> $show_url
);

//構造標準雙接口
$alipayService = new AlipayService($aliapy_config);
$html_text = $alipayService->trade_create_by_buyer($parameter);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>">
<meta http-equiv="cache-control" content="no-cache">
<title>Loading...</title>
</head>
<body onload="document.getElementById('alipaysubmit').submit();">
<?php echo $html_text;?>
</body>
</html>