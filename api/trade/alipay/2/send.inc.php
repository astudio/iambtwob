<?php
defined('IN_DESTOON') or exit('Access Denied');
/* *
 * 功能：確認發貨接口接入頁
 * 版本：3.2
 * 修改日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考。

 *************************注意*************************
 * 如果您在接口集成過程中遇到問題，可以按照下面的途徑來解決
 * 1、商戶服務中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申請集成協助，我們會有專業的技術工程師主動聯繫您協助解決
 * 2、商戶幫助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
 * 3、支付寶論壇（http://club.alipay.com/read-htm-tid-8681712.html）
 * 如果不想使用擴展功能請把擴展功能參數賦空值。
 
 * 確認發貨沒有服務器異步通知頁面（notify_url）與頁面跳轉同步通知頁面（return_url），
 * 發貨操作後，該筆交易的狀態發生了變更，支付寶會主動發送通知給商戶網站，而商戶網站在擔保交易或雙功能的接口中的服務器異步通知頁面（notify_url）
 * 該發貨接口僅針對擔保交易接口、雙功能接口中的擔保交易支付裡涉及到需要賣家做發貨的操作

 * 各家快遞公司都屬於EXPRESS（快遞）的範疇
 */


//require_once("lib/alipay_service.class.php");
require_once DT_ROOT.'/api/trade/alipay/2/send/alipay_service.class.php';
/**************************請求參數**************************/

//必填參數//

//支付寶交易號。它是登陸支付寶網站在交易管理中查詢得到，一般以8位日期開頭的純數字（如：20100419XXXXXXXXXX） 
$trade_no		= $td['trade_no'];

//物流公司名稱
$logistics_name	= $send_type;

//物流發貨單號
$invoice_no		= $send_no;

//物流發貨時的運輸類型，三個值可選：POST（平郵）、EXPRESS（快遞）、EMS（EMS）
$transport_type	= 'EXPRESS';

/************************************************************/

//構造要請求的參數數組，無需改動
$parameter = array(
		"service"			=> "send_goods_confirm_by_platform",
		"partner"			=> trim($aliapy_config['partner']),
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
		"trade_no"			=> $trade_no,
		"logistics_name"	=> $logistics_name,
		"invoice_no"		=> $invoice_no,
		"transport_type"	=> $transport_type
);

//構造確認發貨接口
$alipayService = new AlipayService($aliapy_config);
$doc = $alipayService->send_goods_confirm_by_platform($parameter);

//請在這裡加上商戶的業務邏輯程序代碼

//－－請根據您的業務邏輯來編寫程序（以下代碼僅作參考）－－

//獲取支付寶的通知返回參數，可參考技術文檔中頁面跳轉同步通知參數列表

//解析XML
$response = '';
if( ! empty($doc->getElementsByTagName( "response" )->item(0)->nodeValue) ) {
	$response= $doc->getElementsByTagName( "response" )->item(0)->nodeValue;
}
/*
echo $response;
20880020086056250156[REFUND, CONFIRM_GOODS]debonair@netease.comPRIVATE_ACCOUNT2088002008605625interface/dual2011-08-10 10:06:5715612011-08-12 10:43:26B6208800205173067120884022833126540156[EXTEND_TIMEOUT]625842207@qq.comPRIVATE_ACCOUNT20884022833126540.000.0F0.10INST_PARTNER2011081016342262WAIT_BUYER_CONFIRM_GOODSS
exit('Here');
*/
//－－請根據您的業務邏輯來編寫程序（以上代碼僅作參考）－－
?>