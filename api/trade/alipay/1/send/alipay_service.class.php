<?php
/* *
 * 類名：AlipayService
 * 功能：支付寶各接口構造類
 * 詳細：構造支付寶各接口請求參數
 * 版本：3.2
 * 日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考。
 */

//require_once("alipay_submit.class.php");
require_once DT_ROOT.'/api/trade/alipay/1/send/alipay_submit.class.php';

class AlipayService {

	
	var $aliapy_config;
	/**
	 *支付寶網關地址（新）
	 */
	var $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?';
	/**
	 *支付寶網關地址（舊）
	 */
	var $alipay_gateway_old = 'https://www.alipay.com/cooperate/gateway.do?';

	function __construct($aliapy_config){
		$this->aliapy_config = $aliapy_config;
	}
    function AlipayService($aliapy_config) {
    	$this->__construct($aliapy_config);
    }
	/**
     * 構造確認發貨接口
     * @param $para_temp 請求參數數組
     * @return 獲取支付寶的返回XML處理結果
     */
	function send_goods_confirm_by_platform($para_temp) {

		//獲取支付寶的返回XML處理結果
		$alipaySubmit = new AlipaySubmit();
		$html_text = $alipaySubmit->sendPostInfo($para_temp, $this->alipay_gateway_new, $this->aliapy_config);

		return $html_text;
	}

	/**
     * 用於防釣魚，調用接口query_timestamp來獲取時間戳的處理函數
	 * 注意：該功能PHP5環境及以上支持，因此必須服務器、本地電腦中裝有支持DOMDocument、SSL的PHP配置環境。建議本地調試時使用PHP開發軟件
     * return 時間戳字符串
	 */
	function query_timestamp() {
		$url = $this->alipay_gateway_new."service=query_timestamp&partner=".trim($this->aliapy_config['partner']);
		$encrypt_key = "";		

		$doc = new DOMDocument();
		$doc->load($URL);
		$itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
		$encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
		
		return $encrypt_key;
	}
	
	/**
     * 構造支付寶其他接口
     * @param $para_temp 請求參數數組
     * @return 表單提交HTML信息/支付寶返回XML處理結果
     */
	function alipay_interface($para_temp) {
		//獲取遠程數據/生成表單提交HTML文本信息
		$alipaySubmit = new AlipaySubmit();
		$html_text = "";
		//請根據不同的接口特性，選擇一種請求方式
		//1.構造表單提交HTML數據:（$method可賦值為get或post）
		//$alipaySubmit->buildForm($para_temp, $this->alipay_gateway_new, "get", $button_name, $this->aliapy_config);
		//2.構造模擬遠程HTTP的POST請求，獲取支付寶的返回XML處理結果:
		//注意：若要使用遠程HTTP獲取數據，必須開通SSL服務，該服務請找到php.ini配置文件設置開啟，建議與您的網絡管理員聯繫解決。
		//$alipaySubmit->sendPostInfo($para_temp, $this->alipay_gateway_new, $this->aliapy_config);
		
		return $html_text;
	}
}
?>