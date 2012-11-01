<?php
/**
 * 即時到帳請求類
 * ============================================================================
 * api說明：
 * init(),初始化函數，默認給一些參數賦值，如cmdno,date等。
 * getGateURL()/setGateURL(),獲取/設置入口地址,不包含參數值
 * getKey()/setKey(),獲取/設置密鑰
 * getParameter()/setParameter(),獲取/設置參數值
 * getAllParameters(),獲取所有參數
 * getRequestURL(),獲取帶參數的請求URL
 * doSend(),重定向到財付通支付
 * getDebugInfo(),獲取debug信息
 * 
 * ============================================================================
 *
 */

require (DT_ROOT."/api/pay/tenpay/RequestHandler.class.php");
class PayRequestHandler extends RequestHandler {
	
	function __construct() {
		$this->PayRequestHandler();
	}
	
	function PayRequestHandler() {
		//默認支付網關地址
		$this->setGateURL("http://service.tenpay.com/cgi-bin/v3.0/payservice.cgi");	
	}
	
	/**
	*@Override
	*初始化函數，默認給一些參數賦值，如cmdno,date等。
	*/
	function init() {
		//任務代碼
		$this->setParameter("cmdno", "1");
		
		//日期
		$this->setParameter("date",  date("Ymd"));
		
		//商戶號
		$this->setParameter("bargainor_id", "");
		
		//財付通交易單號
		$this->setParameter("transaction_id", "");
		
		//商家訂單號
		$this->setParameter("sp_billno", "");
		
		//商品價格，以分為單位
		$this->setParameter("total_fee", "");
		
		//貨幣類型
		$this->setParameter("fee_type",  "1");
		
		//返回url
		$this->setParameter("return_url",  "");
		
		//自定義參數
		$this->setParameter("attach",  "");
		
		//用戶ip
		$this->setParameter("spbill_create_ip",  "");
		
		//商品名稱
		$this->setParameter("desc",  "");
		
		//銀行編碼
		$this->setParameter("bank_type",  "0");
		
		//字符集編碼
		$this->setParameter("cs",  DT_CHARSET);
		
		//摘要
		$this->setParameter("sign",  "");
		
	}
	
	/**
	*@Override
	*創建簽名
	*/
	function createSign() {
		$cmdno = $this->getParameter("cmdno");
		$date = $this->getParameter("date");
		$bargainor_id = $this->getParameter("bargainor_id");
		$transaction_id = $this->getParameter("transaction_id");
		$sp_billno = $this->getParameter("sp_billno");
		$total_fee = $this->getParameter("total_fee");
		$fee_type = $this->getParameter("fee_type");
		$return_url = $this->getParameter("return_url");
		$attach = $this->getParameter("attach");
		$spbill_create_ip = $this->getParameter("spbill_create_ip");
		$key = $this->getKey();
		
		$signPars = "cmdno=" . $cmdno . "&" .
				"date=" . $date . "&" .
				"bargainor_id=" . $bargainor_id . "&" .
				"transaction_id=" . $transaction_id . "&" .
				"sp_billno=" . $sp_billno . "&" .
				"total_fee=" . $total_fee . "&" .
				"fee_type=" . $fee_type . "&" .
				"return_url=" . $return_url . "&" .
				"attach=" . $attach . "&";
		
		if($spbill_create_ip != "") {
			$signPars .= "spbill_create_ip=" . $spbill_create_ip . "&";
		}
		
		$signPars .= "key=" . $key;
		
		$sign = strtolower(md5($signPars));
		
		$this->setParameter("sign", $sign);
		
		//debug信息
		$this->_setDebugInfo($signPars . " => sign:" . $sign);
		
	}

}

?>