<?php
/* *
 * 類名：AlipaySubmit
 * 功能：支付寶各接口請求提交類
 * 詳細：構造支付寶各接口表單HTML文本，獲取遠程HTTP數據
 * 版本：3.2
 * 日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考。
 */
//require_once("alipay_core.function.php");
require_once DT_ROOT.'/api/trade/alipay/2/send/alipay_core.function.php';
class AlipaySubmit {
	/**
     * 生成要請求給支付寶的參數數組
     * @param $para_temp 請求前的參數數組
     * @param $aliapy_config 基本配置信息數組
     * @return 要請求的參數數組
     */
	function buildRequestPara($para_temp,$aliapy_config) {
		//除去待簽名參數數組中的空值和簽名參數
		$para_filter = paraFilter($para_temp);

		//對待簽名參數數組排序
		$para_sort = argSort($para_filter);

		//生成簽名結果
		$mysign = buildMysign($para_sort, trim($aliapy_config['key']), strtoupper(trim($aliapy_config['sign_type'])));
		
		//簽名結果與簽名方式加入請求提交參數組中
		$para_sort['sign'] = $mysign;
		$para_sort['sign_type'] = strtoupper(trim($aliapy_config['sign_type']));
		
		return $para_sort;
	}

	/**
     * 生成要請求給支付寶的參數數組
     * @param $para_temp 請求前的參數數組
	 * @param $aliapy_config 基本配置信息數組
     * @return 要請求的參數數組字符串
     */
	function buildRequestParaToString($para_temp,$aliapy_config) {
		//待請求參數數組
		$para = $this->buildRequestPara($para_temp,$aliapy_config);
		
		//把參數組中所有元素，按照「參數=參數值」的模式用「&」字符拼接成字符串
		$request_data = createLinkstring($para);
		
		return $request_data;
	}
	
    /**
     * 構造提交表單HTML數據
     * @param $para_temp 請求參數數組
     * @param $gateway 網關地址
     * @param $method 提交方式。兩個值可選：post、get
     * @param $button_name 確認按鈕顯示文字
     * @return 提交表單HTML文本
     */
	function buildForm($para_temp, $gateway, $method, $button_name, $aliapy_config) {
		//待請求參數數組
		$para = $this->buildRequestPara($para_temp,$aliapy_config);
		
		$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$gateway."_input_charset=".trim(strtolower($aliapy_config['input_charset']))."' method='".$method."'>";
		while (list ($key, $val) = each ($para)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

		//submit按鈕控件請不要含有name屬性
        $sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";
		
		$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
		
		return $sHtml;
	}
	
	/**
     * 構造模擬遠程HTTP的POST請求，獲取支付寶的返回XML處理結果
	 * 注意：該功能PHP5環境及以上支持，因此必須服務器、本地電腦中裝有支持DOMDocument、SSL的PHP配置環境。建議本地調試時使用PHP開發軟件
     * @param $para_temp 請求參數數組
     * @param $gateway 網關地址
	 * @param $aliapy_config 基本配置信息數組
     * @return 支付寶返回XML處理結果
     */
	function sendPostInfo($para_temp, $gateway, $aliapy_config) {
		$xml_str = '';
		
		//待請求參數數組字符串
		$request_data = $this->buildRequestParaToString($para_temp,$aliapy_config);
		//請求的url完整鏈接
		$url = $gateway . $request_data;
		//遠程獲取數據
		$xml_data = getHttpResponse($url,trim(strtolower($aliapy_config['input_charset'])));
		//解析XML
		$doc = new DOMDocument();
		$doc->loadXML($xml_data);

		return $doc;
	}
}
?>