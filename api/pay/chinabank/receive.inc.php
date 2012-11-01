<?php
defined('IN_DESTOON') or exit('Access Denied');
//****************************************	//MD5密鑰要跟訂單提交頁相同，如Send.asp裡的 key = "test" ,修改""號內 test 為您的密鑰
											//如果您還沒有設置MD5密鑰請登錄我們為您提供商戶後台，地址：https://merchant3.chinabank.com.cn/
$key = $PAY[$bank]['keycode'];	//登錄後在上面的導航欄裡可能找到「B2C」，在二級導航欄裡有「MD5密鑰設置」
											//建議您設置一個16位以上的密鑰或更高，密鑰最多64位，但設置16位已經足夠了
//****************************************
	
$v_oid     =trim($_POST['v_oid']);       // 商戶發送的v_oid定單編號   
$v_pmode   =trim($_POST['v_pmode']);    // 支付方式（字符串）   
$v_pstatus =trim($_POST['v_pstatus']);   //  支付狀態 ：20（支付成功）；30（支付失敗）
$v_pstring =trim($_POST['v_pstring']);   // 支付結果信息 ： 支付完成（當v_pstatus=20時）；失敗原因（當v_pstatus=30時,字符串）； 
$v_amount  =trim($_POST['v_amount']);     // 訂單實際支付金額
$v_moneytype  =trim($_POST['v_moneytype']); //訂單實際支付幣種    
$remark1   =trim($_POST['remark1' ]);      //備註字段1
$remark2   =trim($_POST['remark2' ]);     //備註字段2
$v_md5str  =trim($_POST['v_md5str' ]);   //拼湊後的MD5校驗值  

/**
 * 重新計算md5的值
 */
                           
$md5string = strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));

/**
 * 判斷返回信息，如果支付成功，並且支付結果可信，則做進一步的處理
 */


if ($v_md5str == $md5string) {
	if($v_pstatus == "20") {
		//支付成功，可進行邏輯處理！
		//商戶系統的邏輯處理（例如判斷金額，判斷支付狀態，更新訂單狀態等等）......
		if($v_oid != $charge_orderid) {
			$charge_status = 2;
			$charge_errcode = '訂單號不匹配';
			$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$v_oid;
			log_write($note, 'rchinabank');
		} else if($v_amount != $charge_money) {
			$charge_status = 2;
			$charge_errcode = '充值金額不匹配';
			$note = charge_errcode.'S:'.$charge_money.'R:'.$v_amount;
			log_write($note, 'rchinabank');
		} else {
			$charge_status = 1;
		}
	}
}
?>