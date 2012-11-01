<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
$menus = array (
  array('基本設置'),
  array('公司相關'),
  array('財務相關'),
  array('支付接口'),
  array($DT['credit_name'].'規則'),
  array('會員整合'),
  array('定義字段', '?file=fields&tb='.$table),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">基本設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">新用戶註冊</td>
<td>
<input type="radio" name="setting[enable_register]" value="1" <?php if($enable_register) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[enable_register]" value="0" <?php if(!$enable_register) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">用戶名長度</td>
<td>
<input type="text" size="3" name="setting[minusername]" value="<?php echo $minusername;?>"/>
至
<input type="text" size="3" name="setting[maxusername]" value="<?php echo $maxusername;?>"/>
字符<?php tips('建議設置為4-20個字符之間');?>
</td>
</tr>
<tr>
<td class="tl">用戶密碼長度</td>
<td>
<input type="text" size="3" name="setting[minpassword]" value="<?php echo $minpassword;?>"/>
至
<input type="text" size="3" name="setting[maxpassword]" value="<?php echo $maxpassword;?>"/>
字符<?php tips('過短的密碼不利於用戶的帳戶安全<br/>建議設置為6-20個字符之間，不要超過31位');?>
</td>
</tr>
<tr>
<td class="tl">用戶名保留關鍵字</td>
<td><textarea name="setting[banusername]" style="width:96%;height:30px;overflow:visible;"><?php echo $banusername;?></textarea><?php tips('含有保留的關鍵字的用戶名將被禁止註冊<br/>多個保留關鍵字請用|隔開');?>
</td>
</tr>
<tr>
<td class="tl">用戶名保留關鍵字匹配模式</td>
<td>
<input type="radio" name="setting[banmodeu]" value="1" <?php if($banmodeu) echo 'checked';?>/> 相同&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[banmodeu]" value="0" <?php if(!$banmodeu) echo 'checked';?>/> 包含<?php tips('選擇包含時，當用戶名中含有關鍵字時即禁止註冊<br/>選擇相同時，當用戶名和關鍵字相同時才禁止註冊');?>
</td>
</tr>
<tr>
<td class="tl">公司名保留關鍵字</td>
<td><textarea name="setting[bancompany]" style="width:96%;height:30px;overflow:visible;"><?php echo $bancompany;?></textarea><?php tips('含有保留的關鍵字的公司名將被禁止註冊<br/>多個保留關鍵字請用|隔開');?>
</td>
</tr>
<tr>
<td class="tl">公司名保留關鍵字匹配模式</td>
<td>
<input type="radio" name="setting[banmodec]" value="1" <?php if($banmodec) echo 'checked';?>/> 相同&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[banmodec]" value="0" <?php if(!$banmodec) echo 'checked';?>/> 包含<?php tips('選擇包含時，當公司名中含有關鍵字時即禁止註冊<br/>選擇相同時，當公司名和關鍵字相同時才禁止註冊');?>
</td>
</tr>
<tr>
<td class="tl">電子郵件禁止域名</td>
<td><textarea name="setting[banemail]" style="width:96%;height:30px;overflow:visible;"><?php echo $banemail;?></textarea><?php tips('例如禁止abc@xxx.com的郵件註冊，可以填寫xxx.com<br/>多個域名請用|隔開');?>
</td>
</tr>
<tr>
<td class="tl">新用戶註冊驗證</td>
<td>
<input type="radio" name="setting[checkuser]" value="0" <?php if(!$checkuser) echo 'checked';?>> 不驗證
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[checkuser]" value="1" <?php if($checkuser==1) echo 'checked';?>> 人工審核&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[checkuser]" value="2" <?php if($checkuser==2) echo 'checked';?>> 郵件驗證
</td>
</tr>

<tr>
<td class="tl">註冊發送歡迎站內信件</td>
<td>
<input type="radio" name="setting[welcome_message]" value="1" <?php if($welcome_message) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[welcome_message]" value="0" <?php if(!$welcome_message) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">註冊發送歡迎電子郵件</td>
<td>
<input type="radio" name="setting[welcome_email]" value="1" <?php if($welcome_email) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[welcome_email]" value="0" <?php if(!$welcome_email) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">註冊發送歡迎手機短信</td>
<td>
<input type="radio" name="setting[welcome_sms]" value="1" <?php if($welcome_sms) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[welcome_sms]" value="0" <?php if(!$welcome_sms) echo 'checked';?>/> 關閉<?php tips('短信費用由網站支付，建議開啟郵件驗證碼註冊後，再開啟此功能，以過濾惡意註冊');?>
</td>
</tr>


<tr>
<td class="tl">註冊郵件驗證碼</td>
<td>
<input type="radio" name="setting[emailcode_register]" value="1" <?php if($emailcode_register) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[emailcode_register]" value="0" <?php if(!$emailcode_register) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">註冊驗證碼</td>
<td>
<input type="radio" name="setting[captcha_register]" value="1" <?php if($captcha_register) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[captcha_register]" value="0" <?php if(!$captcha_register) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">註冊驗證問題</td>
<td>
<input type="radio" name="setting[question_register]" value="1" <?php if($question_register) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[question_register]" value="0" <?php if(!$question_register) echo 'checked';?>/> 關閉
</td>
</tr>
<!--
<tr>
<td class="tl">用戶註冊邀請碼</td>
<td>
<input type="radio" name="setting[promo_register]" value="1" <?php if($promo_register) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[promo_register]" value="0" <?php if(!$promo_register) echo 'checked';?>/> 關閉
</td>
</tr>
-->
<tr>
<td class="tl">註冊贈送<?php echo $DT['money_name'];?></td>
<td>
<input type="text" size="5" name="setting[money_register]" value="<?php echo $money_register;?>"/> <?php echo $DT['money_unit'];?>
</td>
</tr>
<tr>
<td class="tl">註冊贈送<?php echo $DT['credit_name'];?></td>
<td>
<input type="text" size="5" name="setting[credit_register]" value="<?php echo $credit_register;?>"/> <?php echo $DT['credit_unit'];?>
</td>
</tr>
<tr>
<td class="tl">註冊贈送短信</td>
<td>
<input type="text" size="5" name="setting[sms_register]" value="<?php echo $sms_register;?>"/> 條
</td>
</tr>

<tr>
<td class="tl">禁止代理服務器註冊</td>
<td>
<input type="radio" name="setting[defend_proxy]" value="1" <?php if($defend_proxy) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[defend_proxy]" value="0" <?php if(!$defend_proxy) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">註冊客戶端屏蔽</td>
<td><textarea name="setting[banagent]" style="width:96%;height:30px;overflow:visible;"><?php echo $banagent;?></textarea><?php tips('群發軟件可以偽造IP，但是部分軟件發送的客戶端信息相同<br/>例如某群發軟件的客戶端信息全部包含 .NET CLR 1.0.3705<br/>可在此直接屏蔽含有此類特徵碼的客戶端註冊<br/>多個特徵碼請用 | 分割');?>
</td>
</tr>
<tr>
<td class="tl">IP註冊間隔限制(小時)</td>
<td>
<input type="text" size="3" name="setting[iptimeout]" value="<?php echo $iptimeout;?>"/><?php tips('同一IP在本時間間隔內將只能註冊一個帳號，填0為不限制');?>
</td>
</tr>

<tr>
<td class="tl">會員便簽默認值</td>
<td><textarea name="setting[usernote]" style="width:96%;height:30px;overflow:visible;"><?php echo $usernote;?></textarea><?php tips('會員便簽沒有填寫時，默認顯示此值');?>
</td>
</tr>
<tr>
<td class="tl">站內短信同時最多發送至</td>
<td>
<input type="text" size="3" name="setting[maxtouser]" value="<?php echo $maxtouser;?>"/> 位會員<?php tips('最小填1，例如填5則表示，同一信件一次最多可以同時發送給5位會員');?>
</td>
</tr>
<tr>
<td class="tl">發送站內短信啟用驗證碼</td>
<td>
<input type="radio" name="setting[captcha_sendmessage]" value="2" <?php if($captcha_sendmessage == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_sendmessage]" value="1" <?php if($captcha_sendmessage == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_sendmessage]" value="0" <?php if($captcha_sendmessage == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
<tr>
<td class="tl">登錄失敗次數限制</td>
<td><input type="text" size="3" name="setting[login_times]" value="<?php echo $login_times;?>"/> 次登錄失敗後鎖定登錄 <input type="text" size="3" name="setting[lock_hour]" value="<?php echo $lock_hour;?>"/> 小時
</td>
</tr>
<tr>
<td class="tl">驗證郵件有效期</td>
<td>
<input type="text" size="3" name="setting[auth_days]" value="<?php echo $auth_days;?>"/> 天<?php tips('驗證信鏈接超過有效期天數將失效 填0為不限制');?>
</td>
</tr>

<tr>
<td class="tl">貿易提醒模塊ID</td>
<td>
<input type="text" size="20" name="setting[alertid]" value="<?php echo $alertid;?>"/> <?php tips('例如5|6代表 供應|求購，模塊ID至少為5');?>
</td>
</tr>
<tr>
<td class="tl">貿易提醒需審核</td>
<td>
<input type="radio" name="setting[alert_check]" value="2" <?php if($alert_check == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[alert_check]" value="1" <?php if($alert_check == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[alert_check]" value="0" <?php if($alert_check == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
<tr>
<td class="tl">在線交談內容長度限制</td>
<td><input type="text" size="5" name="setting[chat_maxlen]" value="<?php echo $chat_maxlen;?>"/> 字符</td>
</tr>
<tr>
<td class="tl">在線交談超時限制</td>
<td><input type="text" size="5" name="setting[chat_timeout]" value="<?php echo $chat_timeout;?>"/> 秒<?php tips('當交談雙方超過此時間沒有發言時，系統自動斷開以減輕服務器壓力，填0表示不自動斷開');?></td>
</tr>
<tr>
<td class="tl">在線交談輪詢時間</td>
<td><input type="text" size="5" name="setting[chat_poll]" value="<?php echo $chat_poll;?>"/> 秒<?php tips('交談雙方客戶端需要定時請求服務器端數據，時間設置越短，信息發送的延遲越小，但是服務器壓力越大，至少需要設置為1秒，一般建議設置為2秒-5秒之間的數值，推薦設置為3秒');?></td>
</tr>
<tr>
<td class="tl">兩次發言間隔時間</td>
<td><input type="text" size="5" name="setting[chat_mintime]" value="<?php echo $chat_mintime;?>"/> 秒<?php tips('防止發言過快');?></td>
</tr>
<tr>
<td class="tl">在線交談發送文件</td>
<td>
<input type="radio" name="setting[chat_file]" value="1" <?php if($chat_file) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[chat_file]" value="0" <?php if(!$chat_file) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">在線交談發送文件類型</td>
<td><input type="text" size="50" name="setting[chat_ext]" value="<?php echo $chat_ext;?>"/></td>
</tr>
<tr>
<td class="tl">在線交談自動解析網址</td>
<td>
<input type="radio" name="setting[chat_url]" value="1" <?php if($chat_url) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[chat_url]" value="0" <?php if(!$chat_url) echo 'checked';?>/> 關閉<?php tips('當內容含有網址時，自動解析為超鏈接');?>
</td>
</tr>
<tr>
<td class="tl">在線交談解析圖片地址</td>
<td>
<input type="radio" name="setting[chat_img]" value="1" <?php if($chat_img) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[chat_img]" value="0" <?php if(!$chat_img) echo 'checked';?>/> 關閉<?php tips('當內容含有圖片地址時，自動顯示圖片');?>
</td>
</tr>
<tr>
<td class="tl">會員資料認證</td>
<td>
<input type="radio" name="setting[vmember]" value="1" <?php if($vmember){ ?>checked <?php } ?> onclick="Ds('dvm');"/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[vmember]" value="0" <?php if(!$vmember){ ?>checked <?php } ?> onclick="Dh('dvm');"/> 關閉
</td>
</tr>
<tbody id="dvm" style="display:<?php if(!$vmember) echo 'none';?>">
<tr>
<td class="tl">郵件認證</td>
<td>
<input type="radio" name="setting[vemail]" value="1" <?php if($vemail){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[vemail]" value="0" <?php if(!$vemail){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">手機認證</td>
<td>
<input type="radio" name="setting[vmobile]" value="1" <?php if($vmobile){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[vmobile]" value="0" <?php if(!$vmobile){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">姓名認證</td>
<td>
<input type="radio" name="setting[vtruename]" value="1" <?php if($vtruename){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[vtruename]" value="0" <?php if(!$vtruename){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">銀行帳號認證</td>
<td>
<input type="radio" name="setting[vbank]" value="1" <?php if($vbank){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[vbank]" value="0" <?php if(!$vbank){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">公司認證</td>
<td>
<input type="radio" name="setting[vcompany]" value="1" <?php if($vcompany){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[vcompany]" value="0" <?php if(!$vcompany){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">認證專用傳真號碼</td>
<td>
<input type="text" size="30" name="setting[vfax]" value="<?php echo $vfax;?>"/> <?php tips('如果設置傳真，將提示用戶可以選擇傳真證件進行認證');?>
</td>
</tr>
</tbody>
<tr>
<td class="tl">編輯器工具按鈕</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>全部</option>
<option value="Destoon"<?php if($editor == 'Destoon') echo ' selected';?>>精簡</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>簡潔</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>基礎</option>
</select>
</td>
</tr>
<tr>
<td class="tl">商務中心顯示所有菜單</td>
<td>
<input type="radio" name="setting[show_menu]" value="1" <?php if($show_menu) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[show_menu]" value="0" <?php if(!$show_menu) echo 'checked';?>/> 關閉<?php tips('選擇關閉 則隱藏無權限訪問的菜單');?>
</td>
</tr>
<tr>
<td class="tl">用戶登錄啟用驗證碼</td>
<td>
<input type="radio" name="setting[captcha_login]" value="1" <?php if($captcha_login) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[captcha_login]" value="0" <?php if(!$captcha_login) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">用戶登錄默認記住會員</td>
<td>
<input type="radio" name="setting[login_remember]" value="1" <?php if($login_remember) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[login_remember]" value="0" <?php if(!$login_remember) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">用戶登錄默認進入商務室</td>
<td>
<input type="radio" name="setting[login_goto]" value="1" <?php if($login_goto) echo 'checked';?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[login_goto]" value="0" <?php if(!$login_goto) echo 'checked';?>/> 關閉
</td>
</tr>
</table>
</div>

<div id="Tabs1" style="display:none;">
<div class="tt">公司相關</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">公司類型</td>
<td><input type="text" name="setting[com_type]" style="width:98%;" value="<?php echo $com_type;?>"/></td>
</tr>
<tr>
<td class="tl">公司規模</td>
<td><input type="text" name="setting[com_size]" style="width:98%;" value="<?php echo $com_size;?>"/></td>
</tr>
<tr>
<td class="tl">經營模式</td>
<td><input type="text" name="setting[com_mode]" style="width:98%;" value="<?php echo $com_mode;?>"/></td>
</tr>
<tr>
<td class="tl">公司註冊資本貨幣類型</td>
<td><input type="text" name="setting[money_unit]" style="width:98%;" value="<?php echo $money_unit;?>"/></td>
</tr>
<tr>
<td class="tl"></td>
<td class="f_red">以上設置請用 | 分隔類型，結尾不需要 |</td>
</tr>
<tr>
<td class="tl">經營模式最多可選</td>
<td>
<input type="text" size="3" name="setting[mode_max]" value="<?php echo $mode_max;?>"/>
</td>
</tr>
<tr>
<td class="tl">主營行業最多可選</td>
<td>
<input type="text" size="3" name="setting[cate_max]" value="<?php echo $cate_max;?>"/>
</td>
</tr>
<tr>
<td class="tl">默認形象圖[寬X高]</td>
<td>
<input type="text" size="3" name="setting[thumb_width]" value="<?php echo $thumb_width;?>"/>
X
<input type="text" size="3" name="setting[thumb_height]" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>
<tr>
<td class="tl">截取公司介紹至簡介</td>
<td>默認截取 <input type="text" size="3" name="setting[introduce_length]" value="<?php echo $introduce_length;?>"/> 字符
</td>
</tr>
<tr>
<td class="tl">下載公司介紹遠程圖片</td>
<td>
<input type="radio" name="setting[introduce_save]" value="1" <?php if($introduce_save) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[introduce_save]" value="0" <?php if(!$introduce_save) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">清除公司介紹內容鏈接</td>
<td>
<input type="radio" name="setting[introduce_clear]" value="1" <?php if($introduce_clear) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[introduce_clear]" value="0" <?php if(!$introduce_clear) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">公司新聞需審核</td>
<td>
<input type="radio" name="setting[news_check]" value="2" <?php if($news_check == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_check]" value="1" <?php if($news_check == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_check]" value="0" <?php if($news_check == 0) echo 'checked';?>> 全部關閉

</td>
</tr>

<tr>
<td class="tl">下載新聞內容遠程圖片</td>
<td>
<input type="radio" name="setting[news_save]" value="1" <?php if($news_save) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_save]" value="0" <?php if(!$news_save) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">清除新聞內容內容鏈接</td>
<td>
<input type="radio" name="setting[news_clear]" value="1" <?php if($news_clear) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_clear]" value="0" <?php if(!$news_clear) echo 'checked';?>/> 關閉
</td>
</tr>


<tr>
<td class="tl">公司單頁需審核</td>
<td>
<input type="radio" name="setting[page_check]" value="2" <?php if($page_check == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_check]" value="1" <?php if($page_check == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_check]" value="0" <?php if($page_check == 0) echo 'checked';?>> 全部關閉

</td>
</tr>

<tr>
<td class="tl">下載單頁內容遠程圖片</td>
<td>
<input type="radio" name="setting[page_save]" value="1" <?php if($page_save) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_save]" value="0" <?php if(!$page_save) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">清除單頁內容內容鏈接</td>
<td>
<input type="radio" name="setting[page_clear]" value="1" <?php if($page_clear) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_clear]" value="0" <?php if(!$page_clear) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">榮譽資質需審核</td>
<td>
<input type="radio" name="setting[credit_check]" value="2" <?php if($credit_check == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_check]" value="1" <?php if($credit_check == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_check]" value="0" <?php if($credit_check == 0) echo 'checked';?>> 全部關閉
</td>
</tr>

<tr>
<td class="tl">下載證書介紹遠程圖片</td>
<td>
<input type="radio" name="setting[credit_save]" value="1" <?php if($credit_save) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_save]" value="0" <?php if(!$credit_save) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">清除證書介紹鏈接</td>
<td>
<input type="radio" name="setting[credit_clear]" value="1" <?php if($credit_clear) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_clear]" value="0" <?php if(!$credit_clear) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">友情鏈接需審核</td>
<td>
<input type="radio" name="setting[link_check]" value="2" <?php if($link_check == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[link_check]" value="1" <?php if($link_check == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[link_check]" value="0" <?php if($link_check == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
</table>
</div>
<div id="Tabs2" style="display:none">
<div class="tt">財務相關</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">會員在線充值</td>
<td>
<input type="radio" name="setting[pay_online]" value="1" <?php if($pay_online) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[pay_online]" value="0" <?php if(!$pay_online) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">最小充值額度</td>
<td><input type="text" size="20" name="setting[mincharge]" value="<?php echo $mincharge;?>"/> 0表示不限，填數字表示最小額度，填多個數字用|分割表示選擇額度</td>
<tr>
<td class="tl">線下付款方式網頁地址</td>
<td><input type="text" size="60" name="setting[pay_url]" value="<?php echo $pay_url;?>"/><?php tips('如果未啟用會員在線充值，則系統自動調轉至此地址查看普通付款方式。建議用插件的單網頁功能建立');?></td>
</tr>
<tr>
<td class="tl">會員提現</td>
<td>
<input type="radio" name="setting[cash_enable]" value="1" <?php if($cash_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[cash_enable]" value="0" <?php if(!$cash_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">提現方式</td>
<td><input type="text" name="setting[cash_banks]" style="width:95%;" value="<?php echo $cash_banks;?>"/><?php tips('不同方式請用 | 分隔');?></td>
</tr>
<tr>
<td class="tl">24小時提現次數</td>
<td><input type="text" size="5" name="setting[cash_times]" value="<?php echo $cash_times;?>"/> 0為不限</td>
</tr>
<tr>
<td class="tl">單次提現最小金額</td>
<td><input type="text" size="5" name="setting[cash_min]" value="<?php echo $cash_min;?>"/> 0為不限</td>
</tr>
<tr>
<td class="tl">單次提現最大金額</td>
<td><input type="text" size="5" name="setting[cash_max]" value="<?php echo $cash_max;?>"/> 0為不限</td>
</tr>
<tr>
<td class="tl">提現費率</td>
<td><input type="text" size="2" name="setting[cash_fee]" value="<?php echo $cash_fee;?>"/> %</td>
</tr>
<tr>
<td class="tl">費率最小值</td>
<td><input type="text" size="5" name="setting[cash_fee_min]" value="<?php echo $cash_fee_min;?>"/> 0為不限</td>
</tr>
<tr>
<td class="tl">費率封頂值</td>
<td><input type="text" size="5" name="setting[cash_fee_max]" value="<?php echo $cash_fee_max;?>"/> 0為不限</td>
</tr>
<tr>
<td class="tl">買家確認收貨時間限制</td>
<td><input type="text" size="2" name="setting[trade_day]" value="<?php echo $trade_day;?>"/> 天<?php tips('買家在此時間內未確認收貨或申請仲裁，則系統自動付款給賣家，交易成功');?></td>
</tr>
<tr>
<td class="tl">賣家確認發貨時間限制</td>
<td><input type="text" size="2" name="setting[trade_send]" value="<?php echo $trade_send;?>"/> 天<?php tips('買家付款後，賣家在此時間內未發貨，則系統自動退款給買家');?></td>
</tr>
<tr>
<td class="tl">常用支付方式</td>
<td><input type="text" name="setting[pay_banks]" style="width:95%;" value="<?php echo $pay_banks;?>"/><?php tips('手動添加'.$DT['money_name'].'流水時需選擇');?></td>
</tr>
<tr>
<td class="tl">常用物流方式</td>
<td><input type="text" name="setting[send_types]" style="width:95%;" value="<?php echo $send_types;?>"/></td>
</tr>
</table>
</div>
<div id="Tabs3" style="display:none">
<div class="tt">支付接口</div>
<?php include DT_ROOT.'/api/pay/setting.inc.php';?>
</div>
<div id="Tabs4" style="display:none;">
<div class="tt"><?php echo $DT['credit_name'];?>規則</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">完善個人資料獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_edit]" value="<?php echo $credit_edit;?>"/>
</td>
</tr>
<tr>
<td class="tl">24小時登錄一次獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_login]" value="<?php echo $credit_login;?>"/>
</td>
</tr>
<tr>
<td class="tl">引導一位會員註冊獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_user]" value="<?php echo $credit_user;?>"/>
</td>
</tr>
<tr>
<td class="tl">引導一個IP訪問獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_ip]" value="<?php echo $credit_ip;?>"/>
</td>
</tr>
<tr>
<td class="tl">24小時引導<?php echo $DT['credit_name'];?>上限</td>
<td>
<input type="text" size="5" name="setting[credit_maxip]" value="<?php echo $credit_maxip;?>"/>
<?php tips('為了防止作弊，超過'.$DT['credit_name'].'上限將不再計算');?>
</td>
</tr>
<tr>
<td class="tl">在線充值1<?php echo $DT['money_unit'];?>獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_charge]" value="<?php echo $credit_charge;?>"/> <?php tips('每充值1'.$DT['money_unit'].' 獎勵對應倍數的'.$DT['credit_name']);?>
</td>
</tr>
<tr>
<td class="tl">上傳資質證書獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_add_credit]" value="<?php echo $credit_add_credit;?>"/>
</td>
</tr>
<tr>
<td class="tl">資質證書被刪除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del_credit]" value="<?php echo $credit_del_credit;?>"/>
</td>
</tr>
<tr>
<td class="tl">發佈企業新聞獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_add_news]" value="<?php echo $credit_add_news;?>"/>
</td>
</tr>
<tr>
<td class="tl">企業新聞被刪除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del_news]" value="<?php echo $credit_del_news;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈企業單頁獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_add_page]" value="<?php echo $credit_add_page;?>"/>
</td>
</tr>
<tr>
<td class="tl">企業單頁被刪除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del_page]" value="<?php echo $credit_del_page;?>"/>
</td>
</tr>
</table>
<div class="tt"><?php echo $DT['credit_name'];?>購買</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>購買額度</td>
<td>
<input type="text" size="50" name="setting[credit_buy]" value="<?php echo $credit_buy;?>"/>
</td>
</tr>
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>對應價格</td>
<td>
<input type="text" size="50" name="setting[credit_price]" value="<?php echo $credit_price;?>"/><br/>
<span class="f_gray"><?php echo $DT['credit_name'];?>和價格用|分割，二者必須一一對應</span>
</td>
</tr>
</table>
<div class="tt"><?php echo $DT['credit_name'];?>兌換</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">會員積分兌換</td>
<td>
<input type="radio" name="setting[credit_exchange]" value="0" <?php if(!$credit_exchange) echo 'checked';?> onclick="Dh('e_x');"/> 關閉&nbsp;&nbsp;
<input type="radio" name="setting[credit_exchange]" value="1" <?php if($credit_exchange) echo 'checked';?> onclick="Ds('e_x');"/> 開啟
</td>
</tr>
<tbody id="e_x" style="display:<?php echo $credit_exchange ? '' : 'none';?>">
<tr>
<td class="tl">論壇類型</td>
<td>
<select name="setting[ex_type]">
<option value="DZX"<?php if($ex_type == 'DZX') echo ' selected';?>>Discuz!X</option>
<option value="DZ"<?php if($ex_type == 'DZ') echo ' selected';?>>Discuz!</option>
<option value="PW"<?php if($ex_type == 'PW') echo ' selected';?>>PHPWind</option>
</select>
</td>
</tr>
<tr>
<td class="tl">數據庫務器</td>
<td><input name="setting[ex_host]" type="text" size="30" value="<?php echo $ex_host;?>"/></td>
</tr>
<tr>
<td class="tl">數據庫戶名</td>
<td><input name="setting[ex_user]" type="text" size="15" value="<?php echo $ex_user;?>"/></td>
</tr>
<tr>
<td class="tl">數據庫密碼</td>
<td><input name="setting[ex_pass]" type="text" size="15" value="<?php echo $ex_pass;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">數據庫名稱</td>
<td><input name="setting[ex_data]" type="text" size="15" value="<?php echo $ex_data;?>"/></td>
</tr>
<tr>
<td class="tl">數據表前綴</td>
<td><input name="setting[ex_prex]" type="text" size="15" value="<?php echo $ex_prex;?>"/></td>
</tr>
<tr>
<td class="tl">數據表字段</td>
<td><input name="setting[ex_fdnm]" type="text" size="15" value="<?php echo $ex_fdnm;?>"/><?php tips('DZ論壇一般為extcredits1、extcredits2...<br/>PW論壇一般為credit');?></td>
</tr>
<tr>
<td class="tl">兌換比率</td>
<td><input name="setting[ex_rate]" type="text" size="15" value="<?php echo $ex_rate;?>"/><?php tips('例如填5表示1個論壇積分可兌換5個'.$DT['credit_name']);?></td>
</tr>
<tr>
<td class="tl">論壇積分名稱</td>
<td><input name="setting[ex_name]" type="text" size="15" value="<?php echo $ex_name;?>"/></td>
</tr>
</tbody>
</table>
</div>
<div id="Tabs5" style="display:none">
<div class="tt">會員整合</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">啟用會員整合</td>
<td>
<input type="radio" name="setting[passport]" value="0" <?php if(!$passport) echo 'checked';?> onclick="Dh('p_s');Dh('u_c');"/> 關閉&nbsp;&nbsp;
<input type="radio" name="setting[passport]" value="phpwind" <?php if($passport == 'phpwind') echo 'checked';?> onclick="Ds('p_s');Dh('u_c');"/> PHPWind&nbsp;&nbsp;
<input type="radio" name="setting[passport]" value="discuz" <?php if($passport == 'discuz') echo 'checked';?> onclick="Ds('p_s');Dh('u_c');"/> Discuz!(5.x,6.x)&nbsp;&nbsp;
<input type="radio" name="setting[passport]" value="uc" <?php if($passport == 'uc') echo 'checked';?> onclick="Dh('p_s');Ds('u_c');"/> Ucenter(Discuz!7.x,Discuz! X)
</td>
</tr>
<tbody id="p_s" style="display:<?php echo $passport && $passport != 'uc' ? '' : 'none';?>">
<tr>
<td class="tl">整合程序字符編碼</td>
<td>
<select name="setting[passport_charset]">
<option value="gbk"<?php if($passport_charset == 'gbk') echo ' selected';?>>GBK/GB2312</option>
<option value="utf-8"<?php if($passport_charset == 'utf-8') echo ' selected';?>>UTF-8</option>
</select>
</td>
</tr>
<tr>
<td class="tl">整合程序地址</td>
<td><input name="setting[passport_url]" type="text" size="50" value="<?php echo $passport_url;?>"/><?php tips('整合程序接口地址 例如:http://bbs.destoon.com 結尾不要帶斜線');?></td>
</tr>
<tr>
<td class="tl">整合密鑰</td>
<td><input name="setting[passport_key]" id="passport_key" type="text" size="30" value="<?php echo $passport_key;?>"/> <a href="javascript:Dd('passport_key').value=RandStr();void(0);" class="t">[隨機]</a> </td>
</tr>
</tbody>
<tbody id="u_c" style="display:<?php echo $passport && $passport == 'uc' ? '' : 'none';?>">
<tr>
<td class="tl">UCenter配置信息</td>
<td>
<textarea name="ucconfig" id="ucconfig" style="width:450px;height:50px;overflow:visible;"></textarea><br/>
<input type="button" class="btn" value="自動填表" onclick="AutoUC();"/> <span class="f_gray">請將應用的UCenter配置信息粘貼在上面的輸入框，然後點擊自動填表</span>
</td>
</tr>
<tr>
<td class="tl">API地址</td>
<td><input name="setting[uc_api]" type="text" size="50" value="<?php echo $uc_api;?>" id="uc_api"/><?php tips('整合程序接口地址 例如:http://bbs.destoon.com 結尾不要帶斜線');?></td>
</tr>
<tr>
<td class="tl">主機IP</td>
<td><input name="setting[uc_ip]" type="text" size="50" value="<?php echo $uc_ip;?>" id="uc_ip"/><?php tips('一般不用填寫,遇到無法同步時,請填寫Ucenter主機的IP地址');?></td>
</tr>
<tr>
<td class="tl">整合方式</td>
<td>
<input type="radio" name="setting[uc_mysql]" value="1" <?php if($uc_mysql) echo 'checked';?> onclick="Ds('u_c_m');" id="uc_connect_mysql"/> MySQL
<input type="radio" name="setting[uc_mysql]" value="0" <?php if(!$uc_mysql) echo 'checked';?> onclick="Dh('u_c_m');" id="uc_connect_fopen"/> 遠程連接 <?php tips('當UC數據庫不在當前服務器且無法直接連接時，請選擇遠程連接');?>
</td>
</tr>
<tr id="u_c_m" style="display:<?php echo $uc_mysql ? '' : 'none';?>">
<td colspan="2" style="padding:10px;">
	<table cellpadding="2" cellspacing="1" class="tb">
	<tr>
	<td class="tl">數據庫主機名</td>
	<td><input name="setting[uc_dbhost]" type="text" size="30" value="<?php echo $uc_dbhost;?>" id="uc_dbhost"/></td>
	</tr>
	<tr>
	<td class="tl">數據庫用戶名</td>
	<td><input name="setting[uc_dbuser]" type="text" size="30" value="<?php echo $uc_dbuser;?>" id="uc_dbuser"/></td>
	</tr>
	<tr>
	<td class="tl">數據庫密碼</td>
	<td><input name="setting[uc_dbpwd]" type="text" size="30" value="<?php echo $uc_dbpwd;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';" id="uc_dbpw"/></td>
	</tr>
	<tr>
	<td class="tl">數據庫名</td>
	<td><input name="setting[uc_dbname]" type="text" size="30" value="<?php echo $uc_dbname;?>" id="uc_dbname"/></td>
	</tr>
	<tr>
	<td class="tl">數據表前綴</td>
	<td><input name="setting[uc_dbpre]" type="text" size="30" value="<?php echo $uc_dbpre;?>" id="uc_dbtablepre"/></td>
	</tr>
	<tr>
	<td class="tl">數據庫字符集</td>
	<td>	
	<input type="radio" name="setting[uc_charset]" value="utf8"<?php if($uc_charset == 'utf8') echo ' checked';?> id="uc_charset_utf8"/> UTF-8
	<input type="radio" name="setting[uc_charset]" value="gbk"<?php if($uc_charset == 'gbk') echo ' checked';?> id="uc_charset_gbk"/> GBK/GB2312
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td class="tl">應用ID(APP ID)</td>
<td><input name="setting[uc_appid]" type="text" size="30" value="<?php echo $uc_appid;?>" id="uc_appid"/></td>
</tr>
<tr>
<td class="tl">通信密鑰</td>
<td><input name="setting[uc_key]" id="uc_key" type="text" size="30" value="<?php echo $uc_key;?>" id="uc_key"/> <a href="javascript:Dd('uc_key').value=RandStr();void(0);" class="t">[隨機]</a></td>
</tr>
<tr>
<td class="tl">論壇會員自動激活</td>
<td>
<input type="radio" name="setting[uc_bbs]" value="0" <?php if(!$uc_bbs) echo 'checked';?>/> 關閉&nbsp;&nbsp;
<input type="radio" name="setting[uc_bbs]" value="1" <?php if($uc_bbs) echo 'checked';?>/> 開啟 <?php tips('此項可以在會員註冊後自動激活論壇帳號，但僅適用於使用DZX2版本的論壇，且論壇與UC安裝在同一數據庫，且整合方式為MySQL連接，請確認你的整合符合上述條件，否則請勿開啟');?>
</td>
</tr>
<tr>
<td class="tl">論壇表前綴</td>
<td><input name="setting[uc_bbspre]" type="text" size="10" value="<?php echo $uc_bbspre;?>" id="uc_bbspre"/> <?php tips('如果開啟自動激活，此項必須填寫。注意：填寫錯誤可能導致會員無法註冊！<br/>默認的表前綴為pre_，具體請參考論壇數據庫配置文件');?></td>
</tr>
</tbody>
</table>
<div class="tt">SSO站群整合</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">SSO站群</td>
<td>
<input type="radio" name="setting[sso]" value="0" <?php if(!$sso) echo 'checked';?> onclick="Dh('sso');"/> 關閉&nbsp;&nbsp;
<input type="radio" name="setting[sso]" value="1" <?php if($sso) echo 'checked';?> onclick="Ds('sso');"/> 開啟
</td>
</tr>
<tbody id="sso" style="display:<?php echo $sso ? '' : 'none';?>">
<tr>
<td class="tl">SSO API地址</td>
<td><input name="setting[sso_url]" type="text" size="50" value="<?php echo $sso_url;?>"/> <?php tips('SSO安裝地址，以 / 結尾，例如 http://sso.destoon.com/');?></td>
</tr>
<tr>
<td class="tl">SSO 站點ID</td>
<td><input name="setting[sso_id]" type="text" size="5" value="<?php echo $sso_id;?>"/></td>
</tr>
<tr>
<td class="tl">SSO 通信密鑰</td>
<td><input name="setting[sso_auth]" type="text" size="50" value="<?php echo $sso_auth;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
</tbody>
</table>
<div class="tt">一鍵登錄</div>
<?php include DT_ROOT.'/api/oauth/setting.inc.php';?>
</div>
<div class="sbt">
<input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="展 開" id="ShowAll" class="btn" onclick="TabAll();" title="展開/合併所有選項"/>
</div>
</form>
<script type="text/javascript">
function AutoUC() {
	if(Dd('ucconfig').value.length < 300) {
		Dalert('請先粘貼應用的UCenter配置信息');
		Dd('ucconfig').focus();
		return false;
	}
	var r,c;
	var cfg = Dd('ucconfig').value;
	cfg = cfg.replace(/define\(\'/g, '');
	cfg = cfg.replace(/\'\)\;/g, '');
	cfg = cfg.replace(/\r/g, '');
	r = cfg.split("\n");
	for(var i=0; i<r.length; i++) {
		if(!r[i]) continue;
		c = r[i].split("', '");
		c[0] = c[0].toLowerCase();
		if(c[0] == 'uc_connect') {
			if(c[1] == 'mysql'){Dd('uc_connect_mysql').checked=true;}else{Dd('uc_connect_fopen').checked=true;}
		} else if(c[0] == 'uc_dbcharset') {
			if(c[1] == 'gbk'){Dd('uc_charset_gbk').checked=true;}else{Dd('uc_charset_utf8').checked=true;}
		} else if(c[0] == 'uc_dbtablepre') {
			Dd(c[0]).value=ext(c[1]);
		} else {
			try{Dd(c[0]).value=c[1];}catch(e){}
		}
	}
}
var tab = <?php echo $tab;?>;
var all = <?php echo $all;?>;
function TabAll() {
	var i = 0;
	while(1) {
		if(Dd('Tabs'+i) == null) break;
		Dd('Tabs'+i).style.display = all ? (i == tab ? '' : 'none') : '';
		i++;
	}
	Dd('ShowAll').value = all ? '展 開' : '合 並';
	all = all ? 0 : 1;
}
window.onload=function() {
	if(tab) Tab(tab);
	if(all) {all = 0; TabAll();}
}
</script>
<?php include tpl('footer');?>