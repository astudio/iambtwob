<?php
require '../../../common.inc.php';
require 'init.inc.php';

function get_access_token($appid, $appkey, $request_token, $request_token_secret, $vericode)
{
    //請求具有Qzone訪問權限的access_token的接口地址, 不要更改!!
    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token?";
   
    //生成oauth_signature簽名值。簽名值生成方法詳見（http://wiki.opensns.qq.com/wiki/【QQ登錄】簽名參數oauth_signature的說明）
    //（1） 構造生成簽名值的源串（HTTP請求方式 & urlencode(uri) & urlencode(a=x&b=y&...)）
	$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token")."&";

    //必要參數，不要隨便更改!!
    $params = array();
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;
    $params["oauth_token"]            = $request_token;
    $params["oauth_vericode"]         = $vericode;

    //對參數按照字母升序做序列化
    $normalized_str = get_normalized_string($params);
    $sigstr        .= rawurlencode($normalized_str);

    //echo "sigstr = $sigstr";

	//（2）構造密鑰
    $key = $appkey."&".$request_token_secret;

	//（3）生成oauth_signature簽名值。這裡需要確保PHP版本支持hash_hmac函數
    $signature = get_signature($sigstr, $key);
    
	
	//構造請求url
    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);

    return file_get_contents($url);
}


/**
 * Tips：
 * QQ互聯登錄，授權成功後會回調註冊的callback地址
 * 必須要用授權的request token換取access token
 * 訪問QQ互聯的任何資源都需要access token
 * 目前access token是長期有效的，除非用戶解除與第三方綁定
 * 如果第三方發現access token失效，請引導用戶重新登錄QQ互聯，授權，獲取access token
 */
//print_r($_REQUEST);

//用戶使用QQ登錄，並授權成功後，會返回用戶的openid。此時需要檢查返回的openid是否是合法id
//我們不建議開發者使用該openid，而是使用獲取access token之後返回的openid。
if (!is_valid_openid($_REQUEST["openid"], $_REQUEST["timestamp"], $_REQUEST["oauth_signature"]))
{
    //demo對錯誤簡單處理
    echo "###invalid openid\n";
    echo "sig:".$_REQUEST["oauth_signature"]."\n";
    exit;
}

//tips
//這裡已經獲取到了openid，可以處理第三方賬戶與openid的綁定邏輯。
//但是我們建議第三方等到獲取access token之後在做綁定邏輯

//用授權的request token換取access token
$access_str = get_access_token(QQ_APPID, QQ_APPKEY, $_REQUEST["oauth_token"], $_SESSION["secret"], $_REQUEST["oauth_vericode"]);
//echo "access_str:$access_str\n";
$result = array();
parse_str($access_str, $result);

//print_r($result);

//錯誤處理
if (isset($result["error_code"]))
{
    echo "get access token error<br>";
    echo "error msg: $request_token<br>";
    echo "點擊<a href=\"http://wiki.opensns.qq.com/wiki/%E3%80%90QQ%E7%99%BB%E5%BD%95%E3%80%91%E5%85%AC%E5%85%B1%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E\" target=_blank>查看錯誤碼</a>";
    exit;
}


//將access token，openid保存起來！！！
//在demo演示中，直接保存在全局變量中.
//為避免網站存在多個子域名或同一個主域名不同服務器造成的session無法共享問題
//請開發者按照本SDK中comm/session.php中的註釋對session.php進行必要的修改，以解決上述2個問題，
$_SESSION["token"]   = $result["oauth_token"];
$_SESSION["secret"]  = $result["oauth_token_secret"]; 
$_SESSION["openid"]  = $result["openid"];


/*
echo "<p>現在您已經獲取到了用戶的關鍵數據</p>";
echo "<p>openid:".$result['openid']."用戶唯一標識</p>";
echo "<p>token:".$result['oauth_token']."具有訪問權限的token</p>";
echo "<p>secret:".$result['oauth_token_secret']."密鑰</p>";
echo "<p>以上三個參數您應該保存下來，用於訪問QQ互聯的其他接口,比如:</p>";
echo "<p>點擊<a href=\"../user/get_user_info.php\"    target=\"_blank\">獲取用戶信息</a></p>";
echo "<p>接下來您需要處理自己網站的登錄邏輯，祝您使用QQ登錄愉快</p>";
*/

dheader('./');
?>