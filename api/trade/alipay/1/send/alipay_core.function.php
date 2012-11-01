<?php
/* *
 * 支付寶接口公用函數
 * 詳細：該類是請求、通知返回兩個文件所調用的公用函數核心處理文件
 * 版本：3.2
 * 日期：2011-03-25
 * 說明：
 * 以下代碼只是為了方便商戶測試而提供的樣例代碼，商戶可以根據自己網站的需要，按照技術文檔編寫,並非一定要使用該代碼。
 * 該代碼僅供學習和研究支付寶接口使用，只是提供一個參考。
 */

/**
 * 生成簽名結果
 * @param $sort_para 要簽名的數組
 * @param $key 支付寶交易安全校驗碼
 * @param $sign_type 簽名類型 默認值：MD5
 * return 簽名結果字符串
 */
function buildMysign($sort_para,$key,$sign_type = "MD5") {
	//把數組所有元素，按照「參數=參數值」的模式用「&」字符拼接成字符串
	$prestr = createLinkstring($sort_para);
	//把拼接後的字符串再與安全校驗碼直接連接起來
	$prestr = $prestr.$key;
	//把最終的字符串簽名，獲得簽名結果
	$mysgin = sign($prestr,$sign_type);
	return $mysgin;
}
/**
 * 把數組所有元素，按照「參數=參數值」的模式用「&」字符拼接成字符串
 * @param $para 需要拼接的數組
 * return 拼接完成以後的字符串
 */
function createLinkstring($para) {
	$arg  = "";
	while (list ($key, $val) = each ($para)) {
		$arg.=$key."=".$val."&";
	}
	//去掉最後一個&字符
	$arg = substr($arg,0,count($arg)-2);
	
	//如果存在轉義字符，那麼去掉轉義
	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
	
	return $arg;
}
/**
 * 除去數組中的空值和簽名參數
 * @param $para 簽名參數組
 * return 去掉空值與簽名參數後的新簽名參數組
 */
function paraFilter($para) {
	$para_filter = array();
	while (list ($key, $val) = each ($para)) {
		if($key == "sign" || $key == "sign_type" || $val == "")continue;
		else	$para_filter[$key] = $para[$key];
	}
	return $para_filter;
}
/**
 * 對數組排序
 * @param $para 排序前的數組
 * return 排序後的數組
 */
function argSort($para) {
	ksort($para);
	reset($para);
	return $para;
}
/**
 * 簽名字符串
 * @param $prestr 需要簽名的字符串
 * @param $sign_type 簽名類型 默認值：MD5
 * return 簽名結果
 */
function sign($prestr,$sign_type='MD5') {
	$sign='';
	if($sign_type == 'MD5') {
		$sign = md5($prestr);
	}elseif($sign_type =='DSA') {
		//DSA 簽名方法待後續開發
		die("DSA 簽名方法待後續開發，請先使用MD5簽名方式");
	}else {
		die("支付寶暫不支持".$sign_type."類型的簽名方式");
	}
	return $sign;
}
/**
 * 寫日誌，方便測試（看網站需求，也可以改成把記錄存入數據庫）
 * 注意：服務器需要開通fopen配置
 * @param $word 要寫入日誌裡的文本內容 默認值：空值
 */
function logResult($word='') {
	$fp = fopen("log.txt","a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"執行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}

/**
 * 遠程獲取數據
 * 注意：該函數的功能可以用curl來實現和代替。curl需自行編寫。
 * $url 指定URL完整路徑地址
 * @param $input_charset 編碼格式。默認值：空值
 * @param $time_out 超時時間。默認值：60
 * return 遠程輸出的數據
 */
function getHttpResponse($url, $input_charset = '', $time_out = "60") {
	$urlarr     = parse_url($url);
	$errno      = "";
	$errstr     = "";
	$transports = "";
	$responseText = "";
	if($urlarr["scheme"] == "https") {
		$transports = "ssl://";
		$urlarr["port"] = "443";
	} else {
		$transports = "tcp://";
		$urlarr["port"] = "80";
	}
	$fp=@fsockopen($transports . $urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
	if(!$fp) {
		die("ERROR: $errno - $errstr<br />\n");
	} else {
		if (trim($input_charset) == '') {
			fputs($fp, "POST ".$urlarr["path"]." HTTP/1.1\r\n");
		}
		else {
			fputs($fp, "POST ".$urlarr["path"].'?_input_charset='.$input_charset." HTTP/1.1\r\n");
		}
		fputs($fp, "Host: ".$urlarr["host"]."\r\n");
		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, "Content-length: ".strlen($urlarr["query"])."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $urlarr["query"] . "\r\n\r\n");
		while(!feof($fp)) {
			$responseText .= @fgets($fp, 1024);
		}
		fclose($fp);
		$responseText = trim(stristr($responseText,"\r\n\r\n"),"\r\n");
		
		return $responseText;
	}
}
/**
 * 實現多種字符編碼方式
 * @param $input 需要編碼的字符串
 * @param $_output_charset 輸出的編碼格式
 * @param $_input_charset 輸入的編碼格式
 * return 編碼後的字符串
 */
function charsetEncode($input,$_output_charset ,$_input_charset) {
	$output = "";
	if(!isset($_output_charset) )$_output_charset  = $_input_charset;
	if($_input_charset == $_output_charset || $input ==null ) {
		$output = $input;
	} elseif (function_exists("mb_convert_encoding")) {
		$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	} elseif(function_exists("iconv")) {
		$output = iconv($_input_charset,$_output_charset,$input);
	} else die("sorry, you have no libs support for charset change.");
	return $output;
}
/**
 * 實現多種字符解碼方式
 * @param $input 需要解碼的字符串
 * @param $_output_charset 輸出的解碼格式
 * @param $_input_charset 輸入的解碼格式
 * return 解碼後的字符串
 */
function charsetDecode($input,$_input_charset ,$_output_charset) {
	$output = "";
	if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
	if($_input_charset == $_output_charset || $input ==null ) {
		$output = $input;
	} elseif (function_exists("mb_convert_encoding")) {
		$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	} elseif(function_exists("iconv")) {
		$output = iconv($_input_charset,$_output_charset,$input);
	} else die("sorry, you have no libs support for charset changes.");
	return $output;
}
?>