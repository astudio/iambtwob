<?php
/**
 * 請求類
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
class RequestHandler {
	
	/** 網關url地址 */
	var $gateUrl;
	
	/** 密鑰 */
	var $key;
	
	/** 請求的參數 */
	var $parameters;
	
	/** debug信息 */
	var $debugInfo;
	
	function __construct() {
		$this->RequestHandler();
	}
	
	function RequestHandler() {
		$this->gateUrl = "http://service.tenpay.com/cgi-bin/v3.0/payservice.cgi";
		$this->key = "";
		$this->parameters = array();
		$this->debugInfo = "";
	}
	
	/**
	*初始化函數。
	*/
	function init() {
		//nothing to do
	}
	
	/**
	*獲取入口地址,不包含參數值
	*/
	function getGateURL() {
		return $this->gateUrl;
	}
	
	/**
	*設置入口地址,不包含參數值
	*/
	function setGateURL($gateUrl) {
		$this->gateUrl = $gateUrl;
	}
	
	/**
	*獲取密鑰
	*/
	function getKey() {
		return $this->key;
	}
	
	/**
	*設置密鑰
	*/
	function setKey($key) {
		$this->key = $key;
	}
	
	/**
	*獲取參數值
	*/
	function getParameter($parameter) {
		return $this->parameters[$parameter];
	}
	
	/**
	*設置參數值
	*/
	function setParameter($parameter, $parameterValue) {
		$this->parameters[$parameter] = $parameterValue;
	}
	
	/**
	*獲取所有請求的參數
	*@return array
	*/
	function getAllParameters() {
		return $this->parameters;
	}
	
	/**
	*獲取帶參數的請求URL
	*/
	function getRequestURL() {
	
		$this->createSign();
		
		$reqPar = "";
		ksort($this->parameters);
		foreach($this->parameters as $k => $v) {
			$reqPar .= $k . "=" . urlencode($v) . "&";
		}
		
		//去掉最後一個&
		$reqPar = substr($reqPar, 0, strlen($reqPar)-1);
		
		$requestURL = $this->getGateURL() . "?" . $reqPar;
		
		return $requestURL;
		
	}
		
	/**
	*獲取debug信息
	*/
	function getDebugInfo() {
		return $this->debugInfo;
	}
	
	/**
	*重定向到財付通支付
	*/
	function doSend() {
		header("Location:" . $this->getRequestURL());
		exit;
	}
	
	/**
	*創建md5摘要,規則是:按參數名稱a-z排序,遇到空值的參數不參加簽名。
	*/
	function createSign() {
		$signPars = "";
		ksort($this->parameters);
		foreach($this->parameters as $k => $v) {
			if("" != $v && "sign" != $k) {
				$signPars .= $k . "=" . $v . "&";
			}
		}
		$signPars .= "key=" . $this->getKey();
		
		$sign = strtolower(md5($signPars));
		
		$this->setParameter("sign", $sign);
		
		//debug信息
		$this->_setDebugInfo($signPars . " => sign:" . $sign);
		
	}	
	
	/**
	*設置debug信息
	*/
	function _setDebugInfo($debugInfo) {
		$this->debugInfo = $debugInfo;
	}

}

?>