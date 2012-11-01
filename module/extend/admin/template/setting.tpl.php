<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('模塊設置'),
    array('模板管理', '?file=template&dir='.$module),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">排名推廣</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr> 
<td class="tl">排名推廣綁定域名</td>
<td><input name="setting[spread_domain]"  type="text" size="30" value="<?php echo $spread_domain;?>"/><?php tips('例如 http://spread.destoon.com/<br/>請將此域名綁定至網站spread目錄');?></td>
</tr>
<tr> 
<td class="tl">供應排名起價</td>
<td><input name="setting[spread_sell_price]"  type="text" size="5" value="<?php echo $spread_sell_price;?>"/></td>
</tr>
<tr> 
<td class="tl">求購排名起價</td>
<td><input name="setting[spread_buy_price]"  type="text" size="5" value="<?php echo $spread_buy_price;?>"/></td>
</tr>
<tr>
<td class="tl">公司排名起價</td>
<td><input name="setting[spread_company_price]"  type="text" size="5" value="<?php echo $spread_company_price;?>"/></td>
</tr>
<tr>
<td class="tl">加價幅度</td>
<td><input name="setting[spread_step]"  type="text" size="5" value="<?php echo $spread_step;?>"/><?php tips('如果設置了加價幅度，則出價必須是起價加加價幅度的倍數');?></td>
</tr>
<tr>
<td class="tl">最多可購買月數</td>
<td><input name="setting[spread_month]"  type="text" size="5" value="<?php echo $spread_month;?>"/><?php tips('以月為單位 最少為1個月');?></td>
</tr>
<tr>
<td class="tl">同一月單詞最多購買次數</td>
<td><input name="setting[spread_max]"  type="text" size="5" value="<?php echo $spread_max;?>"/></td>
</tr>
<tr>
<td class="tl">購買排名需要審核</td>
<td>
<input type="radio" name="setting[spread_check]" value="1"  <?php if($spread_check) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[spread_check]" value="0"  <?php if(!$spread_check) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">歷史排名列表</td>
<td>
<input type="radio" name="setting[spread_list]" value="1"  <?php if($spread_list) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[spread_list]" value="0"  <?php if(!$spread_list) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">購買排名使用</td>
<td>
<input type="radio" name="setting[spread_currency]" value="money"  <?php if($spread_currency == 'money') echo 'checked';?>/> <?php echo $DT['money_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[spread_currency]" value="credit"  <?php if($spread_currency == 'credit') echo 'checked';?>/> <?php echo $DT['credit_name'];?>
</td>
</tr>
</table>
<div class="tt">廣告設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">廣告功能</td>
<td>
<input type="radio" name="setting[ad_enable]" value="1"  <?php if($ad_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad_enable]" value="0"  <?php if(!$ad_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">廣告綁定域名</td>
<td><input name="setting[ad_domain]"  type="text" size="30" value="<?php echo $ad_domain;?>"/><?php tips('例如 http://ad.destoon.com/<br/>請將此域名綁定至網站ad目錄');?></td>
</tr>
<tr>
<td class="tl">廣告位預覽</td>
<td>
<input type="radio" name="setting[ad_view]" value="1"  <?php if($ad_view) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad_view]" value="0"  <?php if(!$ad_view) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">廣告在線購買</td>
<td>
<input type="radio" name="setting[ad_buy]" value="1"  <?php if($ad_buy) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad_buy]" value="0"  <?php if(!$ad_buy) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">購買廣告使用</td>
<td>
<input type="radio" name="setting[ad_currency]" value="money"  <?php if($ad_currency == 'money') echo 'checked';?>/> <?php echo $DT['money_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad_currency]" value="credit"  <?php if($ad_currency == 'credit') echo 'checked';?>/> <?php echo $DT['credit_name'];?>
</td>
</tr>
</table>
<div class="tt">公告設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">公告功能</td>
<td>
<input type="radio" name="setting[announce_enable]" value="1"  <?php if($announce_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[announce_enable]" value="0"  <?php if(!$announce_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">公告綁定域名</td>
<td><input name="setting[announce_domain]"  type="text" size="30" value="<?php echo $announce_domain;?>"/><?php tips('例如 http://announce.destoon.com/<br/>請將此域名綁定至網站announce目錄');?></td>
</tr>
<tr>
<td class="tl">公告是否生成HTML</td>
<td>
<input type="radio" name="setting[announce_html]" value="1"  <?php if($announce_html) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[announce_html]" value="0"  <?php if(!$announce_html) echo 'checked';?>/> 關閉
</td>
</tr>
</table>
<div class="tt">友情鏈接</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">友情鏈接功能</td>
<td>
<input type="radio" name="setting[link_enable]" value="1"  <?php if($link_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[link_enable]" value="0"  <?php if(!$link_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">友情鏈接綁定域名</td>
<td><input name="setting[link_domain]"  type="text" size="30" value="<?php echo $link_domain;?>"/><?php tips('例如 http://link.destoon.com/<br/>請將此域名綁定至網站link目錄');?></td>
</tr>
<tr>
<td class="tl">友情鏈接在線申請</td>
<td>
<input type="radio" name="setting[link_reg]" value="1"  <?php if($link_reg) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[link_reg]" value="0"  <?php if(!$link_reg) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">鏈接說明</td>
<td><textarea name="setting[link_request]" id="link_request" style="width:500px;height:50px;"><?php echo $link_request;?></textarea><br/>支持HTML語法， 空格 &amp;nbsp; 換行  &lt;br/&gt;
</td> 
</tr>
</table>

<a name="comment"></a>
<div class="tt">評論設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr> 
<td class="tl">評論綁定域名</td>
<td><input name="setting[comment_domain]"  type="text" size="30" value="<?php echo $comment_domain;?>"/><?php tips('例如 http://comment.destoon.com/<br/>請將此域名綁定至網站comment目錄');?></td>
</tr>
<tr>
<td class="tl">內容頁顯示評論列表</td>
<td>
<input type="radio" name="setting[comment_show]" value="1"  <?php if($comment_show == 1) echo 'checked';?>> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_show]" value="0"  <?php if($comment_show == 0) echo 'checked';?>> 關閉
</td>
</tr>
<tr>
<td class="tl">允許評論的模塊</td>
<td><?php echo module_checkbox('setting[comment_module][]', $comment_module, '1,2,3');?></td>
</tr>
<tr>
<td class="tl">允許評論的會員組</td>
<td><?php echo group_checkbox('setting[comment_group][]', $comment_group);?></td>
</tr>
<tr>
<td class="tl">允許支持反對的會員組</td>
<td><?php echo group_checkbox('setting[comment_vote_group][]', $comment_group);?></td>
</tr>
<tr>
<td class="tl">審核評論</td>
<td>
<input type="radio" name="setting[comment_check]" value="2"  <?php if($comment_check == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_check]" value="1"  <?php if($comment_check == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_check]" value="0"  <?php if($comment_check == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
<tr>
<td class="tl">發佈評論啟用驗證碼</td>
<td>
<input type="radio" name="setting[comment_captcha_add]" value="2"  <?php if($comment_captcha_add == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_captcha_add]" value="1"  <?php if($comment_captcha_add == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_captcha_add]" value="0"  <?php if($comment_captcha_add == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
<tr>
<td class="tl">信息發佈者刪除評論</td>
<td><?php echo module_checkbox('setting[comment_user_del][]', $comment_user_del, '1,2,3');?></td>
</tr>
<tr>
<td class="tl">管理員前台刪除評論</td>
<td>
<input type="radio" name="setting[comment_admin_del]" value="1"  <?php if($comment_admin_del == 1) echo 'checked';?>> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_admin_del]" value="0"  <?php if($comment_admin_del == 0) echo 'checked';?>> 關閉
</td>
</tr>
<tr>
<td class="tl">評論支持反對</td>
<td>
<input type="radio" name="setting[comment_vote]" value="1"  <?php if($comment_vote) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment_vote]" value="0"  <?php if(!$comment_vote) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">評論內容字數限制</td>
<td>&nbsp;
<input type="text" size="5" name="setting[comment_min]" value="<?php echo $comment_min;?>"/> 至
<input type="text" size="5" name="setting[comment_max]" value="<?php echo $comment_max;?>"/> 字節
</td>
</tr>
<tr>
<td class="tl">兩次評論時間間隔</td>
<td>&nbsp;
<input type="text" size="5" name="setting[comment_time]" value="<?php echo $comment_time;?>"/> 秒
</td>
</tr>
<tr>
<td class="tl">每頁顯示評論個數</td>
<td>&nbsp;
<input type="text" size="5" name="setting[comment_pagesize]" value="<?php echo $comment_pagesize;?>"/> 條
</td>
</tr>
<tr>
<td class="tl">單會員或IP每日限評</td>
<td>&nbsp;
<input type="text" size="5" name="setting[comment_limit]" value="<?php echo $comment_limit;?>"/> 次
</td>
</tr>
<tr>
<td class="tl">發佈評論增加<?php echo $DT['credit_name'];?></td>
<td>&nbsp;
<input type="text" size="5" name="setting[credit_add_comment]" value="<?php echo $credit_add_comment;?>"/>
</td>
</tr>
<tr>
<td class="tl">評論刪除扣除<?php echo $DT['credit_name'];?></td>
<td>&nbsp;
<input type="text" size="5" name="setting[credit_del_comment]" value="<?php echo $credit_del_comment;?>"/>
</td>
</tr>
<tr>
<td class="tl">匿名評論暱稱</td>
<td>&nbsp;
<input type="text" size="10" name="setting[comment_am]" value="<?php echo $comment_am;?>"/>
</td>
</tr>
</table>
</div>

<div class="tt">留言設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">留言功能</td>
<td>
<input type="radio" name="setting[guestbook_enable]" value="1"  <?php if($guestbook_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[guestbook_enable]" value="0"  <?php if(!$guestbook_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">留言綁定域名</td>
<td><input name="setting[guestbook_domain]"  type="text" size="30" value="<?php echo $guestbook_domain;?>"/><?php tips('例如 http://guestbook.destoon.com/<br/>請將此域名綁定至網站guestbook目錄');?></td>
</tr>
<tr> 
<td class="tl">留言類型</td>
<td><input name="setting[guestbook_type]"  type="text" size="60" value="<?php echo $guestbook_type;?>"/></td>
</tr>
<tr>
<td class="tl">留言驗證碼</td>
<td>
<input type="radio" name="setting[guestbook_captcha]" value="1"  <?php if($guestbook_captcha) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[guestbook_captcha]" value="0"  <?php if(!$guestbook_captcha) echo 'checked';?>/> 關閉
</td>
</tr>
</table>


<div class="tt">積分換禮設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">積分換禮功能</td>
<td>
<input type="radio" name="setting[gift_enable]" value="1"  <?php if($gift_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[gift_enable]" value="0"  <?php if(!$gift_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">積分換禮綁定域名</td>
<td><input name="setting[gift_domain]"  type="text" size="30" value="<?php echo $gift_domain;?>"/><?php tips('例如 http://gift.destoon.com/<br/>請將此域名綁定至網站gift目錄');?></td>
</tr>
</table>

<div class="tt">投票設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">投票功能</td>
<td>
<input type="radio" name="setting[vote_enable]" value="1"  <?php if($vote_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vote_enable]" value="0"  <?php if(!$vote_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">投票綁定域名</td>
<td><input name="setting[vote_domain]"  type="text" size="30" value="<?php echo $vote_domain;?>"/><?php tips('例如 http://vote.destoon.com/<br/>請將此域名綁定至網站vote目錄');?></td>
</tr>
<tr>
<td class="tl">允許參與投票的會員組</td>
<td><?php echo group_checkbox('setting[vote_group][]', $vote_group);?></td>
</tr>
</table>

<div class="tt">票選設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">票選功能</td>
<td>
<input type="radio" name="setting[poll_enable]" value="1"  <?php if($poll_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[poll_enable]" value="0"  <?php if(!$poll_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">票選綁定域名</td>
<td><input name="setting[poll_domain]"  type="text" size="30" value="<?php echo $poll_domain;?>"/><?php tips('例如 http://poll.destoon.com/<br/>請將此域名綁定至網站poll目錄');?></td>
</tr>
<tr>
<td class="tl">允許參與票選的會員組</td>
<td><?php echo group_checkbox('setting[poll_group][]', $poll_group);?></td>
</tr>
</table>

<div class="tt dsn">問卷設置</div>
<table cellpadding="2" cellspacing="1" class="tb dsn">
<tr>
<td class="tl">問卷功能</td>
<td>
<input type="radio" name="setting[survey_enable]" value="1"  <?php if($survey_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[survey_enable]" value="0"  <?php if(!$survey_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">問卷綁定域名</td>
<td><input name="setting[survey_domain]"  type="text" size="30" value="<?php echo $survey_domain;?>"/><?php tips('例如 http://survey.destoon.com/<br/>請將此域名綁定至網站survey目錄');?></td>
</tr>
<tr>
<td class="tl">允許參與問卷的會員組</td>
<td><?php echo group_checkbox('setting[survey_group][]', $survey_group);?></td>
</tr>
<tr>
<td class="tl">允許查看結果的會員組</td>
<td><?php echo group_checkbox('setting[survey_result][]', $survey_result);?></td>
</tr>
</table>

<div class="tt">手機版設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">手機版功能</td>
<td>
<input type="radio" name="setting[wap_enable]" value="1"  <?php if($wap_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[wap_enable]" value="0"  <?php if(!$wap_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">手機版綁定域名</td>
<td><input name="setting[wap_domain]"  type="text" size="30" value="<?php echo $wap_domain;?>"/><?php tips('例如 http://wap.destoon.com/<br/>請將此域名綁定至網站wap目錄');?></td>
</tr>
<tr>
<td class="tl">手機版字符集</td>
<td>
<input type="radio" name="setting[wap_charset]" value="utf-8"  <?php if($wap_charset == 'utf-8'){ ?>checked <?php } ?>/> UTF-8
<input type="radio" name="setting[wap_charset]" value="unicode"  <?php if($wap_charset == 'unicode'){ ?>checked <?php } ?>/> UNICODE<?php tips('表達同樣內容的前提下，UTF-8 編碼尺寸較小，但遇有亂碼等情況可能導致頁面無法瀏覽；UNICODE 編碼尺寸大很多，但對亂碼等有良好的容錯性');?>
</td>
</tr>
<tr> 
<td class="tl">手機版列表頁顯示信息數</td>
<td><input name="setting[wap_pagesize]"  type="text" size="10" value="<?php echo $wap_pagesize;?>"/></td>
</tr>
<tr> 
<td class="tl">手機版內容頁最大長度</td>
<td><input name="setting[wap_maxlength]"  type="text" size="10" value="<?php echo $wap_maxlength;?>"/></td>
</tr>
</table>
<div class="tt">無圖版設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">無圖版功能</td>
<td>
<input type="radio" name="setting[archiver_enable]" value="1"  <?php if($archiver_enable) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[archiver_enable]" value="0"  <?php if(!$archiver_enable) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">僅搜索引擎訪問</td>
<td>
<input type="radio" name="setting[archiver_robot]" value="1"  <?php if($archiver_robot) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[archiver_robot]" value="0"  <?php if(!$archiver_robot) echo 'checked';?>/> 關閉<?php tips('選擇開啟時，此功能僅搜索引擎和網站管理員可以訪問');?>
</td>
</tr>
<tr> 
<td class="tl">無圖版綁定域名</td>
<td><input name="setting[archiver_domain]"  type="text" size="30" value="<?php echo $archiver_domain;?>"/><?php tips('例如 http://archiver.destoon.com/<br/>請將此域名綁定至網站archiver目錄');?></td>
</tr>
</table>
<div class="tt">RSS設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">RSS功能</td>
<td>
<input type="radio" name="setting[feed_enable]"  value="2" <?php if($feed_enable==2){ ?>checked <?php } ?>/> 完全開啟
<input type="radio" name="setting[feed_enable]"  value="1" <?php if($feed_enable==1){ ?>checked <?php } ?>/> 部分開啟
<input type="radio" name="setting[feed_enable]" value="0"  <?php if(!$feed_enable){ ?>checked <?php } ?>/> 關閉<?php tips('選擇完全開啟將允許用戶自定義條件訂閱<br/>選擇部分開啟僅支持按模型訂閱');?>
</td>
</tr>
<tr> 
<td class="tl">RSS綁定域名</td>
<td><input name="setting[feed_domain]"  type="text" size="30" value="<?php echo $feed_domain;?>"/><?php tips('例如 http://feed.destoon.com/<br/>請將此域名綁定至網站feed目錄');?></td>
</tr>
<tr> 
<td class="tl">RSS輸出數量</td>
<td><input name="setting[feed_pagesize]"  type="text" size="10" value="<?php echo $feed_pagesize;?>"/></td>
</tr>
</table>
<a name="sitemaps"></a>
<div class="tt">Sitemaps</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">生成Sitemaps</td>
<td>
<input type="radio" name="setting[sitemaps]" value="1"  <?php if($sitemaps == 1) echo 'checked';?>> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sitemaps]" value="0"  <?php if($sitemaps == 0) echo 'checked';?>> 關閉
</td>
</tr>
<tr>
<td class="tl">內容頁更新頻率</td>
<td>
<select name="setting[sitemaps_changefreq]">
<option value="always"<?php echo $sitemaps_changefreq == 'always' ? ' selected' : ''?>>一直</option>
<option value="hourly"<?php echo $sitemaps_changefreq == 'hourly' ? ' selected' : ''?>>時</option>
<option value="daily"<?php echo $sitemaps_changefreq == 'daily' ? ' selected' : ''?>>日</option>
<option value="weekly"<?php echo $sitemaps_changefreq == 'weekly' ? ' selected' : ''?>>周</option>
<option value="monthly"<?php echo $sitemaps_changefreq == 'monthly' ? ' selected' : ''?>>月</option>
<option value="yearly"<?php echo $sitemaps_changefreq == 'yearly' ? ' selected' : ''?>>年</option>
<option value="never"<?php echo $sitemaps_changefreq == 'never' ? ' selected' : ''?>>從不</option>
</select>
&nbsp;
<select name="setting[sitemaps_priority]">
<option value="1"<?php echo $sitemaps_priority == '1' ? ' selected' : ''?>>1</option>
<option value="0.9"<?php echo $sitemaps_priority == '0.9' ? ' selected' : ''?>>0.9</option>
<option value="0.8"<?php echo $sitemaps_priority == '0.8' ? ' selected' : ''?>>0.8</option>
<option value="0.7"<?php echo $sitemaps_priority == '0.7' ? ' selected' : ''?>>0.7</option>
<option value="0.6"<?php echo $sitemaps_priority == '0.6' ? ' selected' : ''?>>0.6</option>
<option value="0.5"<?php echo $sitemaps_priority == '0.5' ? ' selected' : ''?>>0.5</option>
<option value="0.4"<?php echo $sitemaps_priority == '0.4' ? ' selected' : ''?>>0.4</option>
<option value="0.3"<?php echo $sitemaps_priority == '0.3' ? ' selected' : ''?>>0.3</option>
<option value="0.2"<?php echo $sitemaps_priority == '0.2' ? ' selected' : ''?>>0.2</option>
<option value="0.1"<?php echo $sitemaps_priority == '0.1' ? ' selected' : ''?>>0.1</option>
</select>
</td>
</tr>
<tr>
<td class="tl">允許生成的模塊</td>
<td><?php echo module_checkbox('setting[sitemaps_module][]', $sitemaps_module, '1,2,3');?></td>
</tr>
<tr>
<td class="tl">更新週期</td>
<td><input type="text" size="5" name="setting[sitemaps_update]" value="<?php echo $sitemaps_update;?>"/> 分鐘</td>
</tr>
<tr>
<td class="tl">生成數量</td>
<td><input type="text" size="5" name="setting[sitemaps_items]" value="<?php echo $sitemaps_items;?>"/></td>
</tr>
<tr>
<td class="tl">URL地址</td>
<td>
<a href="<?php echo DT_PATH.'sitemaps.xml';?>" target="_blank"><?php echo DT_PATH.'sitemaps.xml';?></a>
<?php
	$mods = explode(',', $MOD['sitemaps_module']);
	foreach($MODULE as $m) {
		if($m['domain'] && !$m['islink'] && in_array($m['moduleid'], $mods)) {
			if($m['moduleid'] == 4 && $CFG['com_domain']) continue;
			echo '<br/><a href="'.$m['linkurl'].'sitemaps.xml" target="_blank">'.$m['linkurl'].'sitemaps.xml</a>';
		}
	}
?>
</td>
</tr>
<tr>
<td class="tl">上次更新</td>
<td><?php echo timetodate(filemtime(DT_ROOT.'/sitemaps.xml'));?>&nbsp;&nbsp; <a href="?moduleid=<?php echo $moduleid;?>&file=sitemap&action=sitemaps" class="t">立即更新</a></td>
</tr>
<tr>
<td class="tl">詳細瞭解Sitemaps?</td>
<td><a href="<?php echo $MOD['linkurl'];?>redirect.php?url=http://www.google.com/support/webmasters/bin/topic.py?topic=8476" target="_blank">http://www.google.com/support/webmasters/bin/topic.py?topic=8476</a></td>
</tr>
</table>
</div>

<a name="baidunews"></a>
<div class="tt">百度新聞(Baidu News) - 互聯網新聞開放協議</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">生成百度新聞</td>
<td>
<input type="radio" name="setting[baidunews]" value="1"  <?php if($baidunews == 1) echo 'checked';?>> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[baidunews]" value="0"  <?php if($baidunews == 0) echo 'checked';?>> 關閉
</td>
</tr>
<tr>
<td class="tl">負責人員的Email</td>
<td><input type="text" size="30" name="setting[baidunews_email]" value="<?php echo $baidunews_email;?>"/></td>
</tr>
<tr>
<td class="tl">更新週期</td>
<td><input type="text" size="5" name="setting[baidunews_update]" value="<?php echo $baidunews_update;?>"/> 分鐘</td>
</tr>
<tr>
<td class="tl">生成數量</td>
<td><input type="text" size="5" name="setting[baidunews_items]" value="<?php echo $baidunews_items;?>"/> 100個之內</td>
</tr>
<tr>
<td class="tl">URL地址</td>
<td><a href="<?php echo DT_PATH.'baidunews.xml';?>" target="_blank"><?php echo DT_PATH.'baidunews.xml';?></a></td>
</tr>
<tr>
<td class="tl">上次更新</td>
<td><?php echo timetodate(filemtime(DT_ROOT.'/baidunews.xml'));?>&nbsp;&nbsp; <a href="?moduleid=<?php echo $moduleid;?>&file=sitemap&action=baidunews" class="t">立即更新</a></td>
</tr>
<tr>
<td class="tl">詳細瞭解百度新聞?</td>
<td><a href="<?php echo $MOD['linkurl'];?>redirect.php?url=http://news.baidu.com/newsop.html" target="_blank">http://news.baidu.com/newsop.html</a></td>
</tr>
</table>
</div>
<div class="sbt">
<input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="展 開" id="ShowAll" class="btn" onclick="TabAll();" title="展開/合併所有選項"/>
</div>
</form>
<script type="text/javascript">
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