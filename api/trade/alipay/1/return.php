<?php
$_DPOST = $_POST;
$_DGET = $_GET;
require '../../../../common.inc.php';
$_POST = $_DPOST;
$_GET = $_DGET;
require '../config.inc.php';
if($_GET['seller_email']) $aliapy_config['seller_email'] = $_GET['seller_email'];
#cache_write('ali/'.$api.'-return-server-'.date('Ymdhis').'.php', $_SERVER);
#cache_write('ali/'.$api.'-return-post-'.date('Ymdhis').'.php', $_POST);
#cache_write('ali/'.$api.'-return-get-'.date('Ymdhis').'.php', $_GET);
/* * 
 * 功能：支付寶頁面跳轉同步通知頁面
 * 版本：3.2
 * 日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考。

 *************************頁面功能說明*************************
 * 該頁面可在本機電腦測試
 * 可放入HTML等美化頁面的代碼、商戶業務邏輯程序代碼
 * 該頁面可以使用PHP開發工具調試，也可以使用寫文本函數AlipayFunction.logResult，該函數已被默認關閉，見alipay_notify_class.php中的函數verifyReturn
 
 * WAIT_SELLER_SEND_GOODS(表示買家已在支付寶交易管理中產生了交易記錄且付款成功，但賣家沒有發貨);
 */

//require_once("alipay.config.php");
require_once DT_ROOT.'/api/trade/alipay/1/pay/alipay_notify.class.php';

$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//驗證成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//請在這裡加上商戶的業務邏輯程序代碼
	
	//－－請根據您的業務邏輯來編寫程序（以下代碼僅作參考）－－
    //獲取支付寶的通知返回參數，可參考技術文檔中頁面跳轉同步通知參數列表
    $out_trade_no	= $_GET['out_trade_no'];	//獲取訂單號
    $trade_no		= $_GET['trade_no'];		//獲取支付寶交易號
    $total_fee		= $_GET['price'];			//獲取總價格

	$itemid = $out_trade_no;
	$td = $db->get_one("SELECT * FROM {$DT_PRE}mall_order WHERE itemid=$itemid");
	$money = $td['amount'] + $td['fee'];
	if(!$td || $total_fee != $money) message('金額不符(Code:002)', $MODULE[2]['linkurl'].'trade.php?error=2');
	$seller = $td['seller'];
	$seller_email = $_GET['seller_email'];
	$buyer = $td['buyer'];
	$buyer_email = $_GET['buyer_email'];
	$mallid = $td['mallid'];
	$timenow = timetodate($DT_TIME, 3);
	$memberurl = linkurl($MODULE[2]['linkurl'], 1);	
	include load('member.lang');

    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//判斷該筆訂單是否在商戶網站中已經做過處理（可參考「集成教程」中「3.4返回數據處理」）
			//如果沒有做過處理，根據訂單號（out_trade_no）在商戶網站的訂單系統中查到該筆訂單的詳細，並執行商戶的業務程序
			//如果有做過處理，不執行商戶的業務程序
		if($td['status'] == 1) {
			$db->query("UPDATE {$DT_PRE}mall_order SET trade_no='$trade_no',status=2,updatetime=$DT_TIME WHERE itemid=$itemid");
			$db->query("UPDATE {$DT_PRE}member SET trade='$seller_email',vtrade=1 WHERE username='$seller' AND vtrade=0");
			$db->query("UPDATE {$DT_PRE}member SET trade='$buyer_email',vtrade=1 WHERE username='$buyer' AND vtrade=0");

			$myurl = userurl($td['buyer']);
			$_username = $td['seller'];
			//send message
			$touser = $td['seller'];
			$title = lang($L['trade_message_t2'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$content = lang($L['trade_message_c2'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message('訂單付款成功，請等待賣家發貨', $MODULE[2]['linkurl'].'trade.php?action=order&itemid='.$itemid);
		}
    } else if($_GET['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
		//賣家發貨
		if($td['status'] == 2) {
			$db->query("UPDATE {$DT_PRE}mall_order SET status=3,updatetime=$DT_TIME WHERE itemid=$itemid");

			$myurl = userurl($td['seller']);
			$_username = $td['buyer'];
			//send message
			$touser = $td['buyer'];
			$title = lang($L['trade_message_t3'], array($itemid));
			$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
			$content = lang($L['trade_message_c3'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message('發貨成功，請等待買家確認收貨', $MODULE[2]['linkurl'].'trade.php?itemid='.$itemid);
		}
    } else if($_GET['trade_status'] == 'TRADE_FINISHED') {
		//判斷該筆訂單是否在商戶網站中已經做過處理（可參考「集成教程」中「3.4返回數據處理」）
			//如果沒有做過處理，根據訂單號（out_trade_no）在商戶網站的訂單系統中查到該筆訂單的詳細，並執行商戶的業務程序
			//如果有做過處理，不執行商戶的業務程序
		if($td['status'] == 3) {
			$db->query("UPDATE {$DT_PRE}mall_order SET status=4,updatetime=$DT_TIME WHERE itemid=$itemid");
			//更新商品數據
			$db->query("UPDATE {$DT_PRE}mall SET orders=orders+1,sales=sales+$td[number],amount=amount-$td[number] WHERE itemid=$mallid");

			$myurl = userurl($td['buyer']);
			$_username = $td['seller'];			
			//send message
			$touser = $td['seller'];
			$title = lang($L['trade_message_t4'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$content = lang($L['trade_message_c4'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message('交易成功', $MODULE[2]['linkurl'].'trade.php?action=order&itemid='.$itemid);
		}
	} else if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
		message('訂單創建成功，請盡快通過支付寶付款', $MODULE[2]['linkurl'].'trade.php?action=order&itemid='.$itemid);
    } else {
      //echo "trade_status=".$_GET['trade_status'];
    }
	
	message('驗證成功(Code:000)', $MODULE[2]['linkurl'].'trade.php?error=0');
	//echo "驗證成功<br />";
	//echo "trade_no=".$trade_no;

	//－－請根據您的業務邏輯來編寫程序（以上代碼僅作參考）－－
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //驗證失敗
    //如要調試，請看alipay_notify.php頁面的return_verify函數，比對sign和mysign的值是否相等，或者檢查$veryfy_result有沒有返回true
    message('驗證失敗(Code:001)', $MODULE[2]['linkurl'].'trade.php?error=1');
}
?>