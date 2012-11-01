<?php
require '../../../common.inc.php';
require 'init.inc.php';

 /**
 * @brief 請求臨時token.請求需經過URL編碼，編碼時請遵循 RFC 1738
 *  
 * @param $appid
 * @param $appkey
 *
 * @return 返回字符串格式為：oauth_token=xxx&oauth_token_secret=xxx
 */
function get_request_token($appid, $appkey)
{
    //請求臨時token的接口地址, 不要更改!!
    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token?";


    //生成oauth_signature簽名值。簽名值生成方法詳見（http://wiki.opensns.qq.com/wiki/【QQ登錄】簽名參數oauth_signature的說明）
    //（1） 構造生成簽名值的源串（HTTP請求方式 & urlencode(uri) & urlencode(a=x&b=y&...)）
	$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token")."&";

	//必要參數
    $params = array();
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;

    //對參數按照字母升序做序列化
    $normalized_str = get_normalized_string($params);
    $sigstr        .= rawurlencode($normalized_str);
   
	
	//（2）構造密鑰
    $key = $appkey."&";


 	//（3）生成oauth_signature簽名值。這裡需要確保PHP版本支持hash_hmac函數
    $signature = get_signature($sigstr, $key);
    
		
	//構造請求url
    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);

    //echo "$sigstr\n";
    //echo "$url\n";

    return file_get_contents($url);
}

/**
 * @brief 跳轉到QQ登錄頁面.請求需經過URL編碼，編碼時請遵循 RFC 1738
 *
 * @param $appid
 * @param $appkey
 * @param $callback
 *
 * @return 返回字符串格式為：oauth_token=xxx&openid=xxx&oauth_signature=xxx&timestamp=xxx&oauth_vericode=xxx
 */
function redirect_to_login($appid, $appkey, $callback)
{
    //跳轉到QQ登錄頁的接口地址, 不要更改!!
    $redirect = "http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize?oauth_consumer_key=$appid&";

    //調用get_request_token接口獲取未授權的臨時token
    $result = array();
    $request_token = get_request_token($appid, $appkey);
    parse_str($request_token, $result);

    //request token, request token secret 需要保存起來
    //在demo演示中，直接保存在全局變量中.
    //為避免網站存在多個子域名或同一個主域名不同服務器造成的session無法共享問題
    //請開發者按照本SDK中comm/session.php中的註釋對session.php進行必要的修改，以解決上述2個問題，
    $_SESSION["token"]        = $result["oauth_token"];
    $_SESSION["secret"]       = $result["oauth_token_secret"];

    if ($result["oauth_token"] == "")
    {
        //示例代碼中沒有對錯誤情況進行處理。真實情況下網站需要自己處理錯誤情況
		//See http://wiki.opensns.qq.com/wiki/%E3%80%90QQ%E7%99%BB%E5%BD%95%E3%80%91%E5%85%AC%E5%85%B1%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E
		echo $request_token;exit;
    }

    ////構造請求URL
    $redirect .= "oauth_token=".$result["oauth_token"]."&oauth_callback=".rawurlencode($callback);
    header("Location:$redirect");
}

//redirect_to_login接口調用示例(當用戶點擊QQ登錄按鈕時，應該調用該接口以引導用戶到QQ登錄頁面)
redirect_to_login(QQ_APPID, QQ_APPKEY, QQ_CALLBACK);
?>