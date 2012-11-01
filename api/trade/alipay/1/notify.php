<?php
$_DPOST = $_POST;
$_DGET = $_GET;
require '../../../../common.inc.php';
$_POST = $_DPOST;
$_GET = $_DGET;
require '../config.inc.php';
if($_POST['seller_email']) $aliapy_config['seller_email'] = $_POST['seller_email'];
#cache_write('ali/'.$api.'-notify-server-'.date('Ymdhis').'.php', $_SERVER);
#cache_write('ali/'.$api.'-notify-post-'.date('Ymdhis').'.php', $_POST);
#cache_write('ali/'.$api.'-notify-get-'.date('Ymdhis').'.php', $_GET);
/* *
 * 功能：支付寶服務器異步通知頁面
 * 版本：3.2
 * 日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考。


 *************************頁面功能說明*************************
 * 創建該頁面文件時，請留心該頁面文件中無任何HTML代碼及空格。
 * 該頁面不能在本機電腦測試，請到服務器上做測試。請確保外部可以訪問該頁面。
 * 該頁面調試工具請使用寫文本函數AlipayFunction.logResult，該函數已被默認關閉，見alipay_notify_class.php中的函數verifyNotify
 * 如果沒有收到該頁面返回的 success 信息，支付寶會在24小時內按一定的時間策略重發通知
 
 * WAIT_BUYER_PAY(表示買家已在支付寶交易管理中產生了交易記錄，但沒有付款);
 * WAIT_SELLER_SEND_GOODS(表示買家已在支付寶交易管理中產生了交易記錄且付款成功，但賣家沒有發貨);
 * WAIT_BUYER_CONFIRM_GOODS(表示賣家已經發了貨，但買家還沒有做確認收貨的操作);
 * TRADE_FINISHED(表示買家已經確認收貨，這筆交易完成);
 */

//require_once("alipay.config.php");
require_once DT_ROOT.'/api/trade/alipay/1/pay/alipay_notify.class.php';

//計算得出通知驗證結果
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//驗證成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//請在這裡加上商戶的業務邏輯程序代
	
	//－－請根據您的業務邏輯來編寫程序（以下代碼僅作參考）－－
    //獲取支付寶的通知返回參數，可參考技術文檔中服務器異步通知參數列表
    $out_trade_no	= $_POST['out_trade_no'];	    //獲取訂單號
    $trade_no		= $_POST['trade_no'];	    	//獲取支付寶交易號
    $total			= $_POST['price'];				//獲取總價格

	$itemid = $out_trade_no;
	$td = $db->get_one("SELECT * FROM {$DT_PRE}mall_order WHERE itemid=$itemid");
	$money = $td['amount'] + $td['fee'];
	if(!$td || $total_fee != $money) exit("fail");
	$seller = $td['seller'];
	$seller_email = $_POST['seller_email'];
	$buyer = $td['buyer'];
	$buyer_email = $_POST['buyer_email'];
	$mallid = $td['mallid'];
	$timenow = timetodate($DT_TIME, 3);
	$memberurl = linkurl($MODULE[2]['linkurl'], 1);	
	include load('member.lang');

	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
	//該判斷表示買家已在支付寶交易管理中產生了交易記錄，但沒有付款
	
		//判斷該筆訂單是否在商戶網站中已經做過處理（可參考「集成教程」中「3.4返回數據處理」）
			//如果沒有做過處理，根據訂單號（out_trade_no）在商戶網站的訂單系統中查到該筆訂單的詳細，並執行商戶的業務程序
			//如果有做過處理，不執行商戶的業務程序
			
        echo "success";		//請不要修改或刪除

        //調試用，寫文本函數記錄程序運行情況是否正常
        //logResult("這裡寫入想要調試的代碼變量值，或其他運行的結果記錄");
    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
	//該判斷表示買家已在支付寶交易管理中產生了交易記錄且付款成功，但賣家沒有發貨
	
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

			echo "success";
		}
			
        		//請不要修改或刪除

        //調試用，寫文本函數記錄程序運行情況是否正常
        //logResult("這裡寫入想要調試的代碼變量值，或其他運行的結果記錄");
    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
	//該判斷表示賣家已經發了貨，但買家還沒有做確認收貨的操作
	
		//判斷該筆訂單是否在商戶網站中已經做過處理（可參考「集成教程」中「3.4返回數據處理」）
			//如果沒有做過處理，根據訂單號（out_trade_no）在商戶網站的訂單系統中查到該筆訂單的詳細，並執行商戶的業務程序
			//如果有做過處理，不執行商戶的業務程序
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

			echo "success";
		}
			
        //請不要修改或刪除

        //調試用，寫文本函數記錄程序運行情況是否正常
        //logResult("這裡寫入想要調試的代碼變量值，或其他運行的結果記錄");
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {
	//該判斷表示買家已經確認收貨，這筆交易完成
	
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

			echo "success";
		}
			
        		//請不要修改或刪除

        //調試用，寫文本函數記錄程序運行情況是否正常
        //logResult("這裡寫入想要調試的代碼變量值，或其他運行的結果記錄");
    }
    else {
		//其他狀態判斷
        echo "success";

        //調試用，寫文本函數記錄程序運行情況是否正常
        //logResult ("這裡寫入想要調試的代碼變量值，或其他運行的結果記錄");
    }

	//－－請根據您的業務邏輯來編寫程序（以上代碼僅作參考）－－
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //驗證失敗
    echo "fail";

    //調試用，寫文本函數記錄程序運行情況是否正常
    //AlipayFunction.logResult("這裡寫入想要調試的代碼變量值，或其他運行的結果記錄");
}
?>