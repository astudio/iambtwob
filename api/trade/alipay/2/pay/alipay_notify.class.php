<?php
/* *
 * 類名：AlipayNotify
 * 功能：支付寶通知處理類
 * 詳細：處理支付寶各接口通知返回
 * 版本：3.2
 * 日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考

 *************************注意*************************
 * 調試通知返回時，可查看或改寫log日誌的寫入TXT裡的數據，來檢查通知返回是否正常
 */

require_once DT_ROOT.'/api/trade/alipay/2/pay/alipay_core.function.php';

class AlipayNotify {
    /**
     * HTTPS形式消息驗證地址
     */
	var $https_verify_url = 'https://www.alipay.com/cooperate/gateway.do?service=notify_verify&';
	/**
     * HTTP形式消息驗證地址
     */
	var $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
	var $aliapy_config;

	function __construct($aliapy_config){
		$this->aliapy_config = $aliapy_config;
	}
    function AlipayNotify($aliapy_config) {
    	$this->__construct($aliapy_config);
    }
    /**
     * 針對notify_url驗證消息是否是支付寶發出的合法消息
     * @return 驗證結果
     */
	function verifyNotify(){
		if(empty($_POST)) {//判斷POST來的數組是否為空
			return false;
		}
		else {
			//生成簽名結果
			$mysign = $this->getMysign($_POST);
			//獲取支付寶遠程服務器ATN結果（驗證是否是支付寶發來的消息）
			$responseTxt = 'true';
			if (! empty($_POST["notify_id"])) {$responseTxt = $this->getResponse($_POST["notify_id"]);}
			
			//寫日誌記錄
			//$log_text = "responseTxt=".$responseTxt."\n notify_url_log:sign=".$_POST["sign"]."&mysign=".$mysign.",";
			//$log_text = $log_text.createLinkString($_POST);
			//logResult($log_text);
			
			//驗證
			//$responseTxt的結果不是true，與服務器設置問題、合作身份者ID、notify_id一分鐘失效有關
			//mysign與sign不等，與安全校驗碼、請求時的參數格式（如：帶自定義參數等）、編碼格式有關
			if (preg_match("/true$/i",$responseTxt) && $mysign == $_POST["sign"]) {
				return true;
			} else {
				return false;
			}
		}
	}
	
    /**
     * 針對return_url驗證消息是否是支付寶發出的合法消息
     * @return 驗證結果
     */
	function verifyReturn(){
		if(empty($_GET)) {//判斷POST來的數組是否為空
			return false;
		}
		else {
			//生成簽名結果
			$mysign = $this->getMysign($_GET);
			//獲取支付寶遠程服務器ATN結果（驗證是否是支付寶發來的消息）
			$responseTxt = 'true';
			if (! empty($_GET["notify_id"])) {$responseTxt = $this->getResponse($_GET["notify_id"]);}
			
			//寫日誌記錄
			//$log_text = "responseTxt=".$responseTxt."\n notify_url_log:sign=".$_GET["sign"]."&mysign=".$mysign.",";
			//$log_text = $log_text.createLinkString($_GET);
			//logResult($log_text);
			
			//驗證
			//$responseTxt的結果不是true，與服務器設置問題、合作身份者ID、notify_id一分鐘失效有關
			//mysign與sign不等，與安全校驗碼、請求時的參數格式（如：帶自定義參數等）、編碼格式有關
			if (preg_match("/true$/i",$responseTxt) && $mysign == $_GET["sign"]) {
				return true;
			} else {
				return false;
			}
		}
	}
	
    /**
     * 根據反饋回來的信息，生成簽名結果
     * @param $para_temp 通知返回來的參數數組
     * @return 生成的簽名結果
     */
	function getMysign($para_temp) {
		//除去待簽名參數數組中的空值和簽名參數
		$para_filter = paraFilter($para_temp);
		
		//對待簽名參數數組排序
		$para_sort = argSort($para_filter);
		
		//生成簽名結果
		$mysign = buildMysign($para_sort, trim($this->aliapy_config['key']), strtoupper(trim($this->aliapy_config['sign_type'])));
		
		return $mysign;
	}

    /**
     * 獲取遠程服務器ATN結果,驗證返回URL
     * @param $notify_id 通知校驗ID
     * @return 服務器ATN結果
     * 驗證結果集：
     * invalid命令參數不對 出現這個錯誤，請檢測返回處理中partner和key是否為空 
     * true 返回正確信息
     * false 請檢查防火牆或者是服務器阻止端口問題以及驗證時間是否超過一分鐘
     */
	function getResponse($notify_id) {
		$transport = strtolower(trim($this->aliapy_config['transport']));
		$partner = trim($this->aliapy_config['partner']);
		$veryfy_url = '';
		if($transport == 'https') {
			$veryfy_url = $this->https_verify_url;
		}
		else {
			$veryfy_url = $this->http_verify_url;
		}
		$veryfy_url = $veryfy_url."partner=" . $partner . "&notify_id=" . $notify_id;
		$responseTxt = getHttpResponse($veryfy_url);
		
		return $responseTxt;
	}
}
?>
