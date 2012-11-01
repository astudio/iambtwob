<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('基本設置'),
    array('SEO優化'),
    array('服務器優化'),
    array('安全中心'),
    array('圖片處理'),
    array('郵件發送'),
    array('頁面細節'),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">基本設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">網站名稱</td>
<td><input name="setting[sitename]" type="text" value="<?php echo $sitename;?>" size="40"/></td>
</tr>
<tr>
<td class="tl">網站地址</td>
<td><input name="config[url]" type="text" value="<?php echo $url;?>" size="40"/><?php tips('請添寫完整URL地址,例如http://www.destoon.com/<br/>注意以 / 結尾');?></td>
</tr>
<tr>
<td class="tl">網站LOGO</td>
<td><input name="setting[logo]" type="text" value="<?php echo $logo;?>" id="logo" size="60"/> <span onclick="Dthumb(1,180,60, Dd('logo').value, 0, 'logo');" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="if(Dd('logo').value){Dd('showlogo').src=Dd('logo').value;}" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('logo').value='';Dd('showlogo').src='<?php echo DT_SKIN;?>image/logo.gif';" class="jt">[刪除]</span><br/>
<a href="<?php echo DT_PATH;?>" target="_blank"><img src="<?php echo $logo ? $logo : DT_SKIN.'image/logo.gif';?>" style="margin:2px;" id="showlogo"/></a></td>
</tr>
<tr>
<td class="tl">版權信息</td>
<td><textarea name="setting[copyright]" id="copyright" style="width:500px;height:50px;"><?php echo $copyright;?></textarea><br/>支持HTML語法，常用代碼：版權&copy; &amp;copy; 空格 &amp;nbsp; 換行  &lt;br/&gt;
</td> 
</tr>
<tr>
<td class="tl">客服電話</td>
<td><input name="setting[telephone]" type="text" value="<?php echo $telephone;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">ICP備案序號</td>
<td><input name="setting[icpno]" type="text" value="<?php echo $icpno;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">網站狀態</td>
<td>
<input type="radio" name="setting[close]" value="0"  <?php if(!$close){ ?>checked <?php } ?> onclick="Dh('dclose');"/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[close]" value="1"  <?php if($close){ ?>checked <?php } ?> onclick="Ds('dclose');"/> 關閉
</td>
</tr>
<tr id="dclose" style="display:<?php if(!$close) echo 'none';?>">
<td class="tl">關閉原因</td>
<td><textarea name="setting[close_reason]" id="close_reason" style="width:500px;height:50px;overflow:visible;"><?php echo $close_reason;?></textarea><br/>支持HTML語法，網站關閉不影響後台管理
</td> 
</tr>
<tr>
<td class="tl">城市分站</td>
<td>
<input type="radio" name="setting[city]" value="1"  <?php if($city){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[city]" value="0"  <?php if(!$city){ ?>checked <?php } ?>/> 關閉&nbsp;&nbsp;<?php tips('如果開啟城市分站，網站首頁、模塊首頁、模塊列表頁請關閉生成靜態');?></a>
</td>
</tr>
<tr>
<td class="tl">根據IP自動跳轉分站</td>
<td>
<input type="radio" name="setting[city_ip]" value="1"  <?php if($city_ip){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[city_ip]" value="0"  <?php if(!$city_ip){ ?>checked <?php } ?>/> 關閉&nbsp;&nbsp;<?php tips('此項比較耗費系統資源。為了防止搜索引擎重複收錄，系統在判斷訪客為搜索引擎時不自動跳轉');?></a>
</td>
</tr>
<tr>
<td class="tl">網站默認語言</td>
<td>
<?php
$select = '';
$dirs = list_dir('lang');
foreach($dirs as $v) {
	$selected = ($v['dir'] == DT_LANG) ? 'selected' : '';
	$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
$select = '<select name="config[language]">'.$select.'</select>';
echo $select;
?>
</td> 
</tr>

<tr>
<td class="tl">網站默認風格</td>
<td>
<?php
$select = '';
$dirs = list_dir('skin');
foreach($dirs as $v) {
	$selected = ($CFG['skin'] && $v['dir'] == $CFG['skin']) ? 'selected' : '';
	$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
$select = '<select name="config[skin]">'.$select.'</select>';
echo $select;
tips('位於./skin/目錄,一個目錄即為一套風格');
?>
</td> 
</tr>
<tr>
<td class="tl">網站默認模板</td>
<td>
<?php
$select = '';
$dirs = list_dir('template');
foreach($dirs as $v) {
	$selected = ($CFG['template'] && $v['dir'] == $CFG['template']) ? 'selected' : '';
	$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
$select = '<select name="config[template]">'.$select.'</select>';
echo $select;
tips('位於./template/目錄,一個目錄即為一套模板');
?>
</td> 
</tr>
<tr>
<td class="tl">VIP會員名稱</td>
<td><input name="config[com_vip]" type="text" value="<?php echo $com_vip;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">真實貨幣名稱</td>
<td><input name="setting[money_name]" type="text" value="<?php echo $money_name;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">真實貨幣單位</td>
<td><input name="setting[money_unit]" type="text" value="<?php echo $money_unit;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">虛擬積分名稱</td>
<td><input name="setting[credit_name]" type="text" value="<?php echo $credit_name;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">虛擬積分單位</td>
<td><input name="setting[credit_unit]" type="text" value="<?php echo $credit_unit;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">後台左側欄寬度</td>
<td><input name="setting[admin_left]" type="text" value="<?php echo $admin_left;?>" size="5"/> px</td>
</tr>
<tr>
<td class="tl">即時通訊站內交談</td>
<td>
<input type="radio" name="setting[im_web]" value="1"  <?php if($im_web){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[im_web]" value="0"  <?php if(!$im_web){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">即時通訊QQ</td>
<td>
<input type="radio" name="setting[im_qq]" value="1"  <?php if($im_qq){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[im_qq]" value="0"  <?php if(!$im_qq){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">即時通訊阿里旺旺</td>
<td>
<input type="radio" name="setting[im_ali]" value="1"  <?php if($im_ali){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[im_ali]" value="0"  <?php if(!$im_ali){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">即時通訊MSN</td>
<td>
<input type="radio" name="setting[im_msn]" value="1"  <?php if($im_msn){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[im_msn]" value="0"  <?php if(!$im_msn){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">即時通訊Skype</td>
<td>
<input type="radio" name="setting[im_skype]" value="1"  <?php if($im_skype){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[im_skype]" value="0"  <?php if(!$im_skype){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<?php include DT_ROOT.'/api/trade/setting.inc.php';?>
<tr>
<td class="tl">手機短信</td>
<td>
<input type="radio" name="setting[sms]" value="1"  <?php if($sms){ ?>checked <?php } ?> onclick="Ds('dsms');"/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[sms]" value="0"  <?php if(!$sms){ ?>checked <?php } ?> onclick="Dh('dsms');"/> 關閉&nbsp;&nbsp;&nbsp;&nbsp;
<img src="<?php echo DT_SKIN;?>image/mobile.gif" align="absmiddle"/> <a href="?file=destoon&action=sms" target="_blank" class="t">[申請帳號<?php if($sms && $sms_uid && $sms_key) { ?> 可用短信<strong class="f_red"><script type="text/javascript" src="http://www.destoon.com/sms.php?uid=<?php echo $sms_uid;?>&key=<?php echo $sms_key;?>"></script></strong>條<?php } ?>]</a>
</td>
</tr>
<tbody id="dsms" style="display:<?php if(!$sms) echo 'none';?>">
<tr>
<td class="tl">短信接口線路</td>
<td>
<select name="setting[sms_host]">
<option value="sms"<?php if($sms_host == 'sms') echo ' selected';?>>線路1(國內)</option>
<option value="smsm"<?php if($sms_host == 'smsm') echo ' selected';?>>線路2(國外)</option>
</select><?php tips('建議優先選擇線路1(國內)，速度更快，如果短信發送提示Can Not Connect SMS Server，可以嘗試選擇線路2(國外)');?>
</td> 
</tr>
<tr>
<td class="tl">短信接口帳號</td>
<td><input name="setting[sms_uid]" type="text" value="<?php echo $sms_uid;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">短信接口密鑰</td>
<td><input name="setting[sms_key]" type="text" id="sms_key" size="30" value="<?php echo $sms_key;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">短信內容簽名</td>
<td><input name="setting[sms_sign]" type="text" value="<?php echo $sms_sign;?>" size="30"/> <?php tips('將顯示在短信內容結尾，以便會員識別，請盡量簡短<br/>例如 [某某網]');?></td> 
</tr>
<tr>
<td class="tl">短信單價</td>
<td><input name="setting[sms_fee]" type="text" value="<?php echo $sms_fee;?>" size="5"/> 元/條 <?php tips('此項針對會員收費');?></td> 
</tr>
<tr>
<td class="tl">短信長度</td>
<td><input name="setting[sms_len]" type="text" value="<?php echo $sms_len;?>" size="5"/> 字/條</td> 
</tr>
<tr>
<td class="tl">成功標識</td>
<td><input name="setting[sms_ok]" type="text" value="<?php echo $sms_ok;?>" size="10"/> <?php tips('短信發送成功標識字符，系統根據此字符確定是否扣除會員短信餘額');?></td> 
</tr>
</tbody>
</table>
</div>

<div id="Tabs1" style="display:none">
<div class="tt">SEO優化</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">標題分隔符</td>
<td><input name="setting[seo_delimiter]" type="text" value="<?php echo $seo_delimiter;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">Title(網站標題)</td>
<td><input name="setting[seo_title]" type="text" value="<?php echo $seo_title;?>" size="61"><?php tips('針對搜索引擎設置的網頁標題');?></td>
</tr>
<tr>
<td class="tl">Meta Keywords<br/>(網頁關鍵詞)</td>
<td><textarea name="setting[seo_keywords]" cols="60" rows="3"><?php echo $seo_keywords;?></textarea><?php tips('針對搜索引擎設置的關鍵詞');?></td>
</tr>
<tr>
<td class="tl">Meta Description<br/>(網頁描述)</td>
<td><textarea name="setting[seo_description]" cols="60" rows="3"><?php echo $seo_description;?></textarea><?php tips('針對搜索引擎設置的網頁描述');?></td>
</tr>


<tr>
<td class="tl">目錄首頁文件名</td>
<td><input name="setting[index]" type="text" value="<?php echo $index;?>" size="8"/>
</td>
</tr>
<tr>
<td class="tl">生成文件擴展名</td>
<td>
<select name="setting[file_ext]">
<option value="html"<?php if($file_ext == 'html') echo ' selected';?>>.html</option>
<option value="htm"<?php if($file_ext == 'htm') echo ' selected';?>>.htm</option>
<option value="shtm"<?php if($file_ext == 'shtm') echo ' selected';?>>.shtm</option>
<option value="shtml"<?php if($file_ext == 'shtml') echo ' selected';?>>.shtml</option>
</select>
</td>
</tr>
<tr>
<td class="tl">網站首頁生成html</td>
<td>
<input type="radio" name="setting[index_html]" value="1"  <?php if($index_html){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[index_html]" value="0"  <?php if(!$index_html){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">URL Rewrite(偽靜態)</td>
<td>
<input type="radio" name="setting[rewrite]" value="1"  <?php if($rewrite){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[rewrite]" value="0"  <?php if(!$rewrite){ ?>checked <?php } ?>/> 關閉 <?php tips('請確認服務器已做過規則配置，否則請勿開啟<br/>ReWrite規則見幫助文檔<br/>請點擊下面的地址，如果可以正常顯示，說明規則配置成功<br/><a href=index-htm-url-rule.html target=_blank>index-htm-url-rule.html</a>');?>
</td>
</tr>
<tr>
<td class="tl">公司主頁綁定二級域名</td>
<td><input name="config[com_domain]" type="text" value="<?php echo $com_domain;?>" size="30"/> <?php tips('如果填寫 .destoon.com 同時需要將域名泛解析 *.destoon.com 指向服務器IP，並且在服務器端綁定泛域名至 網站根目錄 或者 網站根目錄/company 目錄，生成的主頁形式為username.destoon.com<br/>如果填寫 i.destoon.com 同時需要將域名泛解析 i.destoon.com 指向服務器IP，並且在服務器端綁定域名至網站根目錄/company 目錄，生成的主頁形式為i.destoon.com/username/(註：此方式必須支持偽靜態)');?></td>
</tr>
<tr>
<td class="tl">泛解析綁定目錄</td>
<td>
<select name="config[com_dir]">
<option value="0"<?php echo $com_dir == 0 ? ' selected' : '';?>>根目錄</option>
<option value="1"<?php echo $com_dir == 1 ? ' selected' : '';?>>company目錄</option>
</select>&nbsp;
<?php tips('如果服務器支持，推薦綁定至company目錄');?>
</td>
</tr>
<tr>
<td class="tl">公司二級域名加www</td>
<td>
<input type="radio" name="setting[com_www]" value="1"  <?php if($com_www){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[com_www]" value="0"  <?php if(!$com_www){ ?>checked <?php } ?>/> 關閉 <?php tips('例如二級域名為sell.destoon.com<br/>添加www後為 www.sell.destoon.com');?>
</td>
</tr>
<tr>
<td class="tl">會員頂級域名Rewrite</td>
<td>
<input type="radio" name="config[com_rewrite]" value="1"  <?php if($com_rewrite){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="config[com_rewrite]" value="0"  <?php if(!$com_rewrite){ ?>checked <?php } ?>/> 關閉 <?php tips('部分服務器可能無法開啟會員綁定的頂級域名Rewrite，如果無法開啟，可在此關閉，以免出現打不開頁面的情況，此項僅針對會員頂級域名，不影響其他頁面Rewrite');?>
</td>
</tr>

<tr>
<td class="tl">服務器中文路徑編碼</td>
<td>
<input type="radio" name="setting[pcharset]" value="0"  <?php if(!$pcharset){ ?>checked <?php } ?>/> 未用&nbsp;&nbsp;
<input type="radio" name="setting[pcharset]" value="gbk"  <?php if($pcharset == 'gbk'){ ?>checked <?php } ?>/> GBK&nbsp;&nbsp;
<input type="radio" name="setting[pcharset]" value="utf-8"  <?php if($pcharset == 'utf-8'){ ?>checked <?php } ?>/> UTF-8 <?php tips('當生成包含中文文件名的文件出現亂碼或者下載帶有中文名文件提示找不到文件時，可嘗試設置此項');?>
</td>
</tr>

<tr>
<td class="tl">404錯誤日誌</td>
<td>
<input type="radio" name="setting[log_404]" value="1"  <?php if($log_404){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[log_404]" value="0"  <?php if(!$log_404){ ?>checked <?php } ?>/> 關閉
<?php tips('開啟404日誌有利於分析站內死鏈接和用戶或搜索引擎蜘蛛的錯誤記錄<br/>同時需要設置站點的404頁面至網站根目錄404.php');?>
</td>
</tr>
</table>
</div>

<div id="Tabs2" style="display:none">
<div class="tt">服務器優化</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">首頁自動更新頻率</td>
<td>
<input name="setting[task_index]" type="text" value="<?php echo $task_index;?>" size="5"/> 秒 <?php tips('僅對生成的靜態網頁有效');?>
</td>
</tr>
<tr>
<td class="tl">列表頁自動更新頻率</td>
<td>
<input name="setting[task_list]" type="text" value="<?php echo $task_list;?>" size="5"/> 秒 <?php tips('僅對生成的靜態網頁有效');?>
</td>
</tr>
<tr>
<td class="tl">內容頁自動更新頻率</td>
<td>
<input name="setting[task_item]" type="text" value="<?php echo $task_item;?>" size="5"/> 秒 <?php tips('僅對生成的靜態網頁有效');?>
</td>
</tr>
<tr>
<td class="tl">TAG(標籤)緩存更新週期</td>
<td><input type="text" name="config[tag_expires]" value="<?php echo $tag_expires;?>" size="5"/> 秒<?php tips('此項可明顯減輕標籤數據調用對服務器的壓力');?></td>
</tr>
<tr>
<td class="tl">SQL查詢緩存更新週期</td>
<td><input type="text" name="config[db_expires]" value="<?php echo $db_expires;?>" size="5"/> 秒<?php tips('此項可明顯減輕數據庫查詢對服務器的壓力<br/>但是會在一定程度上增加緩存目錄的體積');?></td>
</tr>
<tr>
<td class="tl">搜索結果緩存更新週期</td>
<td><input type="text" name="setting[cache_search]" value="<?php echo $cache_search;?>" size="5"/> 秒<?php tips('此項可減輕搜索等大量耗費資源的操作對服務器的壓力<br/>但是會在一定程度上增加緩存目錄的體積');?></td>
</tr>
<tr>
<td class="tl">點擊次數緩存更新週期</td>
<td><input type="text" name="setting[cache_hits]" value="<?php echo $cache_hits;?>" size="5"/> 秒<?php tips('此項可明顯減輕數據庫服務壓力，但是會造成瀏覽次數的延遲顯示');?></td>
</tr>
<tr>
<td class="tl">公司首頁緩存更新週期</td>
<td><input type="text" name="setting[cache_home]" value="<?php echo $cache_home;?>" size="5"/> 秒<?php tips('此項可明顯加快公司首頁打開速度，但是會造成會員主頁延遲更新和在一定程度上增加緩存目錄的體積');?></td>
</tr>
<tr>
<td class="tl">數據緩存方式</td>
<td>
<select name="config[cache]" onchange="if(this.options[this.selectedIndex].innerHTML.indexOf('不')!=-1){alert('系統不支持 '+this.value);select_op('ccf', '<?php echo $cache;?>')}" id="ccf">
<option value="file"<?php echo $cache == 'file' ? ' selected' : '';?>>文件 (支持)</option>
<option value="memcache"<?php echo $cache == 'memcache' ? ' selected' : '';?>>Memcache (<?php echo class_exists('Memcache') ? '支持' : '不支持'?>)</option>
<option value="xcache"<?php echo $cache == 'xcache' ? ' selected' : '';?>>Xcache (<?php echo function_exists('xcache_get') ? '支持' : '不支持'?>)</option>
<option value="eaccelerator"<?php echo $cache == 'eaccelerator' ? ' selected' : '';?>>eAccelerator (<?php echo function_exists('eaccelerator_get') ? '支持' : '不支持'?>)</option>
<option value="shmop"<?php echo $cache == 'shmop' ? ' selected' : '';?>>shmop (<?php echo (function_exists('shmop_open') && function_exists('ftok')) ? '支持' : '不支持'?>)</option>
<option value="apc"<?php echo $cache == 'apc' ? ' selected' : '';?>>apc (<?php echo function_exists('apc_fetch') ? '支持' : '不支持'?>)</option>
</select>
<?php tips('除了文件緩存，其他緩存方式需要服務器端支持，具體請查看phpinfo信息。<br/>請在確認服務器環境支持的情況下開啟，否則可能導致未知的錯誤<br/>如果需要開啟Memcache緩存，請先配置file/config/memcache.inc.php連接參數');?>&nbsp;&nbsp;
<a href="?action=phpinfo" target="_blank" class="t">[查看phpinfo]</a>&nbsp;&nbsp;
<a href="?action=cacheclear" target="_blank" class="t">[清空緩存]</a>
</td>
</tr>
<tr>
<td class="tl">數據庫/連接方式</td>
<td>
<select name="config[database]">
<option value="mysql"<?php echo $database == 'mysql' ? ' selected' : '';?>>mysql</option>
<option value="mysqli"<?php echo $database == 'mysqli' ? ' selected' : '';?>>mysqli</option>
<option value="mysqlrw"<?php echo $database == 'mysqlrw' ? ' selected' : '';?>>mysqlrw</option>
<option value="mysqlirw"<?php echo $database == 'mysqlirw' ? ' selected' : '';?>>mysqlirw</option>
</select>
<?php tips('mysqli是PHP對mysql新特性的一個擴展支持，如果已加載此擴展，請選擇mysqli，具體請查看phpinfo信息<br/>mysqlrw/mysqlirw指多台mysql服務器實現讀寫分離，開啟之前需要配置file/config/mysqlrw.inc.php只讀數據庫連接參數');?>
</td>
</tr>
<tr>
<td class="tl">去除模板換行標記</td>
<td>
<input type="radio" name="config[template_trim]" value="1" <?php if($template_trim){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="config[template_trim]" value="0" <?php if(!$template_trim){ ?>checked <?php } ?>/> 關閉 <?php tips('去除換行等多餘標記，在一定程度上可以壓縮網頁體積<br/>開啟此項可能導致自定義的js(例如廣告代碼)等錯誤，需要注意排查js的註釋及結尾的分號');?></td>
</tr>
<tr>
<td class="tl">模板緩存自動更新</td>
<td>
<input type="radio" name="config[template_refresh]" value="1" <?php if($template_refresh){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="config[template_refresh]" value="0" <?php if(!$template_refresh){ ?>checked <?php } ?>/> 關閉 <?php tips('如果網站模板無需修改，建議您關閉此功能');?></td>
</tr>
<tr title="將頁面內容以gzip壓縮後傳輸，可以加快傳輸速度，需PHP 4.0.4以上且支持Zlib模塊才能使用">
<td class="tl">頁面Gzip壓縮</td>
<td>
<input type="radio" name="setting[gzip_enable]" value="1" <?php if($gzip_enable){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[gzip_enable]" value="0" <?php if(!$gzip_enable){ ?>checked <?php } ?>/> 關閉 <?php tips(function_exists('ob_gzhandler') ? '當前服務器支持Gzip，建議開啟' : '當前服務器不支持Gzip，請關閉');?>
</td>
</tr>
<tr>
<td class="tl">分頁顯示方式</td>
<td>
<input type="radio" name="setting[pages_mode]" value="0" <?php if(!$pages_mode){ ?>checked <?php } ?>/> 默認&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[pages_mode]" value="1" <?php if($pages_mode){ ?>checked <?php } ?>/> 簡潔
</td>
</tr>
<tr>
<td class="tl">積分記錄</td>
<td>
<input type="radio" name="setting[log_credit]" value="1" <?php if($log_credit){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[log_credit]" value="0" <?php if(!$log_credit){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">顯示聯繫方式圖片化</td>
<td>
<input type="radio" name="setting[anti_spam]" value="1" <?php if($anti_spam){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[anti_spam]" value="0" <?php if(!$anti_spam){ ?>checked <?php } ?>/> 關閉 <?php tips('將電話、傳真、Email等重要信息顯示為圖片格式，防止採集和複製');?>
</td>
</tr>
<tr>
<td class="tl">智能搜索提示</td>
<td>
<input type="radio" name="setting[search_tips]" value="1" <?php if($search_tips){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[search_tips]" value="0" <?php if(!$search_tips){ ?>checked <?php } ?>/> 關閉</td>
</tr>
<tr>
<td class="tl">編輯器自動保存草稿</td>
<td>
<input type="radio" name="setting[save_draft]" value="1" <?php if($save_draft == 1){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_draft]" value="0" <?php if($save_draft == 0){ ?>checked <?php } ?>/> 關閉&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_draft]" value="2" <?php if($save_draft == 2){ ?>checked <?php } ?>/> 後台開啟 <?php tips('後台開啟指僅在後台開啟，前台將不開啟<br/>注意：開啟此功能會佔用一定的服務器空間');?></td>
</tr>
<tr>
<td class="tl">搜索關鍵詞自動記錄</td>
<td>
<input type="radio" name="setting[search_kw]" value="1" <?php if($search_kw){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[search_kw]" value="0" <?php if(!$search_kw){ ?>checked <?php } ?>/> 關閉</td>
</tr>
<tr>
<td class="tl">人工審核關鍵詞記錄</td>
<td>
<input type="radio" name="setting[search_check_kw]" value="1" <?php if($search_check_kw){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[search_check_kw]" value="0" <?php if(!$search_check_kw){ ?>checked <?php } ?>/> 關閉</td>
</tr>
<tr>
<td class="tl">搜索關鍵詞長度限制</td>
<td><input type="text" size="3" name="setting[min_kw]" value="<?php echo $min_kw;?>"/>
至
<input type="text" size="3" name="setting[max_kw]" value="<?php echo $max_kw;?>"/>
字符<?php tips('一個漢字的長度為2個字符，建議設置為3-30個字符之間');?></td>
</tr>
<tr>
<td class="tl">兩次搜索時間間隔</td>
<td><input type="text" size="3" name="setting[search_limit]" value="<?php echo $search_limit;?>"/> 秒<?php tips('填0為不限制');?></td>
</tr>

<tr>
<td class="tl">會員在線保持時間</td>
<td><input type="text" name="setting[online]" value="<?php echo $online;?>" size="5"/> 秒<?php tips('超過此時間未有活動的會員將視為離線');?></td>
</tr>

<tr>
<td class="tl">定時更新會員新消息</td>
<td><input type="text" name="setting[pushtime]" value="<?php echo $pushtime;?>" size="5"/> 秒<?php tips('當會員停留在前台頁面時，每隔一段時間，系統自動發送一次服務器請求，以更新會員站內信、新對話、購物車數量，以便會員及時收到新消息，填0為關閉，此項會增加服務器壓力，建議設置30秒以上');?></td>
</tr>

<tr>
<td class="tl">列表每頁默認信息條數</td>
<td><input name="setting[pagesize]" type="text" value="<?php echo $pagesize;?>" size="3"/> 條</td>
</tr>
<tr>
<td class="tl">搜索分類返回結果數限制</td>
<td><input type="text" size="3" name="setting[schcate_limit]" value="<?php echo $schcate_limit;?>"/> 條<?php tips('填0為禁用分類搜索');?></td>
</tr>
<tr>
<td class="tl">遠程FTP文件上傳</td>
<td>
<input type="radio" name="setting[ftp_remote]" value="1"  <?php if($ftp_remote){ ?>checked <?php } ?> onclick="Ds('ftp');"/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ftp_remote]" value="0"  <?php if(!$ftp_remote){ ?>checked <?php } ?> onclick="Dh('ftp');"/> 關閉<?php tips('開啟遠程文件上傳後，所有上傳文件將被FTP移動到遠程服務器上，可以極大的緩解主站流量壓力');?></td>
</tr>
<tbody id="ftp" style="display:<?php echo $ftp_remote ? '' : 'none';?>">
<?php if(!extension_loaded("ftp")){ ?>
<tr>
<td class="tl">系統提示</td>
<td class="f_red">當前PHP環境不支持FTP功能</td>
</tr>
<?php }?>
<tr> 
<td class="tl">FTP主機</td>
<td><input name="setting[ftp_host]" id="ftp_host" type="text" size="30" value="<?php echo $ftp_host;?>"/><?php tips('可以是 FTP 服務器的 IP 地址或域名');?></td>
</tr>
<tr> 
<td class="tl">FTP端口</td>
<td><input name="setting[ftp_port]" id="ftp_port" type="text" size="30" value="<?php echo $ftp_port;?>"/><?php tips('默認為 21');?></td>
</tr>
<tr> 
<td class="tl">FTP帳號</td>
<td><input name="setting[ftp_user]" id="ftp_user" type="text" size="30" value="<?php echo $ftp_user;?>"/><?php tips('該帳號必需具有以下權限：讀取文件、寫入文件、刪除文件、創建目錄、子目錄繼承');?></td>
</tr>
<tr> 
<td class="tl">FTP密碼<br></td>
<td><input name="setting[ftp_pass]" type="text" id="ftp_pass" size="30" value="<?php echo $ftp_pass;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">SSL連接</td>
<td>
<input type="radio" name="setting[ftp_ssl]" value="1"  <?php if($ftp_ssl){ ?>checked <?php } ?> id="ftp_ssl"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ftp_ssl]" value="0"  <?php if(!$ftp_ssl){ ?>checked <?php } ?>/> 否<?php tips('FTP 服務器必需開啟了 SSL 才可以啟用');?></td>
</tr>
<tr>
<td class="tl">被動模式(PASV)連接</td>
<td>
<input type="radio" name="setting[ftp_pasv]" value="1"  <?php if($ftp_pasv){ ?>checked <?php } ?> id="ftp_pasv"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ftp_pasv]" value="0"  <?php if(!$ftp_pasv){ ?>checked <?php } ?>/> 否<?php tips('一般情況下非被動模式即可，如果存在上傳失敗問題，可嘗試打開此設置');?>
</td>
</tr>
<tr> 
<td class="tl">遠程存儲目錄</td>
<td><input name="setting[ftp_path]" id="ftp_path" type="text" size="60" value="<?php echo $ftp_path;?>"/><?php tips('例如 /wwwroot/img/ 或者 /httpdocs/img/<br/>具體以實際情況為準');?></td>
</tr>
<tr>
<td class="tl">遠程訪問URL</td>
<td><input name="setting[remote_url]" type="text" value="<?php echo $remote_url;?>" size="60"/><?php tips('例如 http://static.destoon.com/，注意以 / 結尾');?></td>
</tr>
<tr> 
<td class="tl">測試FTP連接</td>
<td><input name="testftp" type="button" class="btn" value="點擊測試" onclick="TestFTP();"/></td>
</tr>
</table>
<script type="text/javascript">
function TestFTP() {
	if(Dd('ftp_host').value.length < 4) {
		Dalert('FTP主機不能為空');
		Dd('ftp_host').focus();
		return false;
	}	
	var fssl = Dd('ftp_ssl').checked ? 1 : 0;
	var fpasv = Dd('ftp_pasv').checked ? 1 : 0;
	var url = '?file=setting&action=ftp&ftp_host='+Dd('ftp_host').value+'&ftp_port='+Dd('ftp_port').value+'&ftp_user='+Dd('ftp_user').value+'&ftp_pass='+Dd('ftp_pass').value+'&ftp_path='+Dd('ftp_path').value+'&ftp_ssl='+fssl+'&ftp_pasv='+fpasv;
	Diframe(url, 0, 0 , 1);
}
</script>
</div>
<div id="Tabs3" style="display:none">
<div class="tt">安全中心</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">允許登錄後台的IP</td>
<td><input name="setting[admin_ip]" type="text" value="<?php echo $admin_ip;?>" size="60"/><?php tips('請謹慎設置，以免發生不可登錄後台的情況<br/>IP段用*代替數字，例如192.168.*.*<br/>多個IP地址或者IP段用|分割，例如192.168.1.2|10.0.*.*');?></td>
</tr>
<tr>
<td class="tl">允許登錄後台的時段</td>
<td><input name="setting[admin_hour]" type="text" value="<?php echo $admin_hour;?>" size="60"/><?php tips('留空表示不限制，建議設置為工作人員下班時間。多個時間段請用|分割，單時間段用-分割，時間請使用24小時制<br/>例如：8:30-18:00 表示時間段上午8:30至下午18:00<br/>22:30-2:05|5:00-13:15表示晚上22:30至次日凌晨2:05和凌晨5:00至下午13:15兩個時間段<br/>網站創始人帳號不受此限制');?></td>
</tr>
<tr>
<td class="tl">允許登錄後台的日期</td>
<td>
<?php for($i = 0; $i < 7; $i++) { ?>
<input type="checkbox" name="setting[admin_week][]" value="<?php echo $i;?>"<?php echo strpos(','.$admin_week.',', ','.$i.',') !== false ? ' checked' : '';?>/> 星期<?php echo $W[$i];?> 
<?php } ?>
<?php tips('不選擇表示不限制，網站創始人帳號不受此限制');?>
</td>
</tr>
<tr>
<td class="tl">發佈信息轉為待審的時段</td>
<td><input name="setting[check_hour]" type="text" value="<?php echo $check_hour;?>" size="60"/><?php tips('此項針對前台會員發佈信息，留空表示不限制，建議設置為工作人員下班時間。時間設置請參考允許登錄後台的時段 Tips');?></td>
</tr>
<tr>
<td class="tl">發佈信息轉為待審的日期</td>
<td>
<?php for($i = 0; $i < 7; $i++) { ?>
<input type="checkbox" name="setting[check_week][]" value="<?php echo $i;?>"<?php echo strpos(','.$check_week.',', ','.$i.',') !== false ? ' checked' : '';?>/> 星期<?php echo $W[$i];?> 
<?php } ?>
</td>
</tr>
<tr>
<td class="tl">驗證碼組成字符</td>
<td><input name="setting[captcha_chars]" type="text" value="<?php echo $captcha_chars;?>" size="60"/><?php tips('可填寫0-9的數字、a-z的字母組合，勿填特殊符號或中文<br/>例如只顯示數字驗證碼可填寫0123456789<br/>留空系統自動顯示大小寫字母和數字的組合');?></td>
</tr>
<tr>
<td class="tl">中文驗證碼 </td>
<td>
<input type="radio" name="setting[captcha_cn]" value="1"  <?php if($captcha_cn){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_cn]" value="0"  <?php if(!$captcha_cn){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">後台登錄驗證碼 </td>
<td>
<input type="radio" name="setting[captcha_admin]" value="1"  <?php if($captcha_admin){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_admin]" value="0"  <?php if(!$captcha_admin){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">加密傳輸密碼</td>
<td>
<input type="radio" name="setting[md5_pass]" value="1"  <?php if($md5_pass){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[md5_pass]" value="0"  <?php if(!$md5_pass){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">後台在線記錄</td>
<td>
<input type="radio" name="setting[admin_online]" value="1"  <?php if($admin_online){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[admin_online]" value="0"  <?php if(!$admin_online){ ?>checked <?php } ?>/> 關閉&nbsp;&nbsp;
<a href="?moduleid=2&file=online&action=admin" class="t">[點擊查看]</a>
</td>
</tr>
<tr>
<td class="tl">後台操作日誌 </td>
<td>
<input type="radio" name="setting[admin_log]" value="0" <?php if(!$admin_log){ ?>checked <?php } ?>/> 關閉&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[admin_log]" value="1" <?php if($admin_log == 1){ ?>checked <?php } ?>/> 部分開啟<?php tips('僅記錄添加、修改、刪除、設置等關鍵操作');?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[admin_log]" value="2" <?php if($admin_log == 2){ ?>checked <?php } ?>/> 完全開啟<?php tips('記錄後台所有操作');?>
</td>
</tr>
<tr>
<td class="tl">會員登錄日誌 </td>
<td>
<input type="radio" name="setting[login_log]" value="0" <?php if(!$login_log){ ?>checked <?php } ?>/> 關閉&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[login_log]" value="1" <?php if($login_log == 1){ ?>checked <?php } ?>/> 後台開啟<?php tips('僅記錄網站後台登錄日誌');?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[login_log]" value="2" <?php if($login_log == 2){ ?>checked <?php } ?>/> 完全開啟<?php tips('記錄所有登錄日誌');?>
</td>
</tr>
<tr>
<td class="tl">同一帳號同時異地登錄</td>
<td>
<input type="radio" name="setting[ip_login]" value="0"  <?php if(!$ip_login){ ?>checked <?php } ?>/> 允許&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ip_login]" value="1"  <?php if($ip_login == 1){ ?>checked <?php } ?>/> 僅限前台<?php tips('僅限前台允許同一帳號同時異地登錄<br/>後台將不允許同一帳號同時異地登錄');?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ip_login]" value="2"  <?php if($ip_login == 2){ ?>checked <?php } ?>/> 完全禁止<?php tips('完全禁止同一帳號同時異地登錄');?>
</td>
</tr>
<tr>
<td class="tl">內容頁禁止複製</td>
<td>
<input type="radio" name="setting[anticopy]" value="1"  <?php if($anticopy){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[anticopy]" value="0"  <?php if(!$anticopy){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">文件上傳記錄</td>
<td>
<input type="radio" name="setting[uploadlog]" value="1"  <?php if($uploadlog){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[uploadlog]" value="0"  <?php if(!$uploadlog){ ?>checked <?php } ?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">允許上傳的文件類型</td>
<td><input name="setting[uploadtype]" type="text" value="<?php echo $uploadtype;?>" size="60"/> <?php tips('用|號隔開文件後綴');?></td>
</tr>
<tr>
<td class="tl">允許上傳大小限制</td>
<td><input name="setting[uploadsize]" type="text" value="<?php echo $uploadsize;?>" size="10"/> Kb (1024Kb=1M) <?php tips('當前服務器最大支持'.ini_get('upload_max_filesize').'文件上傳<br/>如果需要修改最大值，可以修改php.ini的upload_max_filesize參數');?></td>
</tr>
<tr>
<td class="tl">文件保存目錄</td>
<td>
<select name="setting[uploaddir]">
<option value="Ym/d" <?php if($uploaddir == 'Ym/d') echo 'selected';?>>年月/日</option>
<option value="Ym/d/H" <?php if($uploaddir == 'Ym/d/H') echo 'selected';?>>年月/日/時</option>
<option value="Ym/d/H/i" <?php if($uploaddir == 'Ym/d/H/i') echo 'selected';?>>年月/日/時/分</option>
<option value="Ym/d/H/i/s" <?php if($uploaddir == 'Ym/d/H/i/s') echo 'selected';?>>年月/日/時/分/秒</option>
</select>
 <?php tips('上傳文件保存於 file/upload 目錄');?>
</td>
</tr>
<tr>
<td class="tl">後台驗證方式</td>
<td>
<select name="setting[authadmin]">
<option value="session" <?php if($authadmin == 'session') echo 'selected';?>>Session</option>
<option value="cookie" <?php if($authadmin == 'cookie') echo 'selected';?>>Cookie</option>
</select>
<?php tips('Session驗證可能出現後台自動退出的情況，如果自動退出的情況頻繁出現影響使用，請使用cookie驗證，cookie驗證僅在關閉瀏覽器時自動退出後台');?>
</td>
</tr>
<tr>
<td class="tl">網站安全密鑰</td>
<td><input name="config[authkey]" id="authkey" type="text" value="<?php echo $authkey;?>" size="30"/> <a href="javascript:Dd('authkey').value=RandStr();void(0);" class="t">[隨機]</a> <?php tips('可用英文大小寫字母、數字的組合，不可使用特殊符號，建議定期修改');?></td>
</tr>

<tr>
<td class="tl">驗證數據來源</td>
<td>
<input type="radio" name="setting[check_referer]" value="1"  <?php if($check_referer){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_referer]" value="0"  <?php if(!$check_referer){ ?>checked <?php } ?>/> 關閉
</td>
</tr>

<tr>
<td class="tl">信任域名</td>
<td><input name="setting[safe_domain]" type="text" value="<?php echo $safe_domain;?>" size="60"/><?php tips('不填寫則默認為當前域名<br/>多個域名請用|分開 例如destoon.com|destoon.cn');?></td>
</tr>
<tr>
<td class="tl">系統負載係數</td>
<td><input name="setting[defend_cc]" type="text" value="<?php echo $defend_cc;?>" size="5"/><?php tips('僅適用部分Unix/Linux主機，系統高於此值時會禁止新用戶訪問，通常情況可設置為5到10，0為不限制');?>
</td>
</tr>
<tr>
<td class="tl">防止頁面刷新</td>
<td><input name="setting[defend_reload]" type="text" value="<?php echo $defend_reload;?>" size="5"/><?php tips('防止惡意刷新頁面時間，單位秒，0為不限制');?></td>
</tr>
<tr>
<td class="tl">限制代理訪問</td>
<td>
<input type="radio" name="setting[defend_proxy]" value="1"  <?php if($defend_proxy){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[defend_proxy]" value="0"  <?php if(!$defend_proxy){ ?>checked <?php } ?>/> 關閉<?php tips('限制用戶使用代理服務器連接網站');?>
</td>
</tr>
<tr>
<td class="tl">Cookie作用域</td>
<td><input name="config[cookie_domain]" type="text" value="<?php echo $cookie_domain;?>" size="20"/><?php tips('例如要保證頂級域名destoon.com所有二級域名均可正常登錄註銷，則填寫.destoon.com(注意頂級域名前加.)');?></td>
</tr>
<tr>
<td class="tl">Cookie前綴</td>
<td><input name="config[cookie_pre]" type="text" value="<?php echo $cookie_pre;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">用戶註冊文件名</td>
<td><input name="setting[file_register]" type="text" value="<?php echo $file_register;?>" size="20"/><input name="old_file_register" type="hidden" value="<?php echo $file_register;?>"/> <a href="<?php echo $MODULE[2]['linkurl'];?><?php echo $file_register;?>" target="_blank">訪問</a><?php tips('請保證對應文件可寫，提交後系統會嘗試修改，如果系統修改失敗，請通過ftp修改<br/>文件名建議使用數字和字母，文件保存於 member/ 目錄');?></td>
</tr>
<tr>
<td class="tl">用戶登錄文件名</td>
<td><input name="setting[file_login]" type="text" value="<?php echo $file_login;?>" size="20"/><input name="old_file_login" type="hidden" value="<?php echo $file_login;?>"/> <a href="<?php echo $MODULE[2]['linkurl'];?><?php echo $file_login;?>" target="_blank">訪問</a></td>
</tr>
<tr>
<td class="tl">用戶發佈信息文件名</td>
<td><input name="setting[file_my]" type="text" value="<?php echo $file_my;?>" size="20"/><input name="old_file_my" type="hidden" value="<?php echo $file_my;?>"/> <a href="<?php echo $MODULE[2]['linkurl'];?><?php echo $file_my;?>" target="_blank">訪問</a></td>
</tr>
</table>
</div>

<div id="Tabs4" style="display:none">
<div class="tt">圖片水印</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">水印圖片</td>
<td><input name="setting[water_mark]" type="text" value="<?php echo $water_mark;?>" size="40"/><br/>
<img src="file/image/<?php echo $water_mark;?>"/></td>
</tr>
<tr>
<td class="tl">水印透明度</td>
<td><input name="setting[water_transition]" type="text" value="<?php echo $water_transition;?>" size="5"><?php tips('如果水印圖為gif格式，請設置範圍為 1~100 的整數,數值越小水印圖片越透明。PNG 類型水印本身具有真彩透明效果，無須此設置');?></td>
</tr>
<tr>
<td class="tl">JPEG 水印質量</td>
<td><input name="setting[water_jpeg_quality]" type="text" value="<?php echo $water_jpeg_quality;?>" size="5"><?php tips('範圍為 0~100 的整數,數值越大結果圖片效果越好,但尺寸也越大');?></td>
</tr>
</table>
<div class="tt">文字水印</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">水印文字</td>
<td><input name="setting[water_text]" type="text" id="water_text" value="<?php echo $water_text;?>" size="30" style="color:<?php echo $water_fontcolor;?>;font-size:<?php echo $water_fontsize;?>px;"></td>
</tr>
<tr>
<td class="tl">中文字體</td>
<td><input name="setting[water_font]" type="text" value="<?php echo $water_font;?>" size="30"> <?php if($water_font && !is_file(DT_ROOT."/file/font/".$water_font)){ ?><span class="f_red">字體不存在,請上傳字體到./file/font/目錄</span><?php } ?></td>
</tr>
<tr>
<td class="tl">文字大小</td>
<td><input name="setting[water_fontsize]" type="text" value="<?php echo $water_fontsize;?>" size="8" style="font-size:<?php echo $water_fontsize;?>px;" onblur="this.style.fontSize=this.value+'px';Dd('water_text').style.fontSize=this.value+'px';"> px</td>
</tr>
<tr>
<td class="tl">文字顏色</td>
<td><input name="setting[water_fontcolor]" type="text" value="<?php echo $water_fontcolor;?>" size="8" style="color:<?php echo $water_fontcolor;?>" onblur="this.style.color=this.value;Dd('water_text').style.color=this.value;"></td>
</tr>
</table>
<div class="tt">圖片處理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">水印類型</td>
<td>
<input type="radio" name="setting[water_type]" value="0"  <?php if($water_type==0){ ?>checked <?php } ?> /> 禁用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_type]" value="1"  <?php if($water_type==1){ ?>checked <?php } ?> /> 文字水印&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_type]" value="2"  <?php if($water_type==2){ ?>checked <?php } ?> /> 圖片水印
</td>
</tr>

<tr>
<td class="tl">水印圖片或文字邊距</td>
<td><input name="setting[water_margin]" type="text" value="<?php echo $water_margin;?>" size="5"> px <?php tips('水印圖片或文字在原圖的邊距');?>
</td>
</tr>
<tr>
<td class="tl">圖片處理條件</td>
<td><input name="setting[water_min_wh]" type="text" value="<?php echo $water_min_wh;?>" size="5"> px <?php tips('圖片寬度或者高度小於此值將不做水印處理');?>
</td>
</tr>
<tr>
<td class="tl">水印位置</td>
<td>
	<table cellspacing="1" cellpadding="5" width="150" bgcolor="#DDDDDD">
	<tr align="center" bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="1" <?php if($water_pos==1){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="2" <?php if($water_pos==2){ ?>checked <?php } ?>/></td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="3" <?php if($water_pos==3){ ?>checked <?php } ?>/> </td>
	</tr>

	<tr align="center"  bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="4" <?php if($water_pos==4){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="5" <?php if($water_pos==5){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="6" <?php if($water_pos==6){ ?>checked <?php } ?>/> </td>
	</tr>

	<tr align="center" bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="7" <?php if($water_pos==7){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="8" <?php if($water_pos==8){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="9" <?php if($water_pos==9){ ?>checked <?php } ?>/> </td>
	</tr>
	<tr align="center" bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'" colspan="3">隨機 <input type="radio" name="setting[water_pos]" value="0" <?php if($water_pos==0){ ?>checked <?php } ?>/></td>
	</tr>
	</table>
</tr>
<tr>
<td class="tl">BMP圖片轉JPG格式</td>
<td>
<input type="radio" name="setting[bmp_jpg]" value="1"  <?php if($bmp_jpg==1){ ?>checked <?php } ?> /> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[bmp_jpg]" value="0"  <?php if($bmp_jpg==0){ ?>checked <?php } ?> /> 關閉
<?php tips('BMP格式圖片體積較大，且不能生成縮略圖，建議開啟');?>
</td>
</tr>
<tr>
<td class="tl">產品大圖加公司名水印</td>
<td>
<input type="radio" name="setting[water_com]" value="1"  <?php if($water_com==1){ ?>checked <?php } ?> /> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_com]" value="0"  <?php if($water_com==0){ ?>checked <?php } ?> /> 關閉
</td>
</tr>
<tr>
<td class="tl">產品中圖加水印</td>
<td>
<input type="radio" name="setting[water_middle]" value="1"  <?php if($water_middle==1){ ?>checked <?php } ?> /> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_middle]" value="0"  <?php if($water_middle==0){ ?>checked <?php } ?> /> 關閉
</td>
</tr>
<tr>
<td class="tl">產品中圖縮略大小</td>
<td><input name="setting[middle_w]" type="text" value="<?php echo $middle_w;?>" size="3"/> X <input name="setting[middle_h]" type="text" value="<?php echo $middle_h;?>" size="3"/> px
</td>
</tr>
<tr>
<td class="tl">產品圖片縮略模式</td>
<td>
<input type="radio" name="setting[thumb_album]" value="0"  <?php if($thumb_album==0){ ?>checked <?php } ?> /> 裁剪&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[thumb_album]" value="1"  <?php if($thumb_album==1){ ?>checked <?php } ?> /> 壓縮
<?php tips('裁剪模式，圖片顯示清晰，縮略圖可能會被裁多餘部分<br/>壓縮模式，圖片顯示完整，縮略圖可能會留白邊');?>
</td>
</tr>
<tr>
<td class="tl">標題圖片縮略模式</td>
<td>
<input type="radio" name="setting[thumb_title]" value="0"  <?php if($thumb_title==0){ ?>checked <?php } ?> /> 裁剪&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[thumb_title]" value="1"  <?php if($thumb_title==1){ ?>checked <?php } ?> /> 壓縮
</td>
</tr>
<tr>
<td class="tl">圖片文件最大寬度</td>
<td><input name="setting[max_image]" type="text" value="<?php echo $max_image;?>" size="5"/> px
<?php tips('由於顯示器寬度有限，超過此寬度的圖片將被等比調整為此寬度以節省存儲空間');?>
</td>
</tr>
</table>
</div>

<div id="Tabs5" style="display:none">
<div class="tt">郵件發送</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">發送方式</td>
<td>
<input type="radio" name="setting[mail_type]" value="close" <?php if($mail_type=="close"){ ?>checked <?php } ?> id="mailtype_close"/> <label for="mailtype_close">關閉郵件發送</label><br/>
<input type="radio" name="setting[mail_type]" value="smtp" <?php if($mail_type=="smtp"){ ?>checked <?php } ?> onclick="Ds('dsmtp');Ds('demail');Dd('l_rn').checked=true;" id="mailtype_smtp"/> <label for="mailtype_smtp">通過SMTP SOCKET 連接 SMTP 服務器發送(支持ESMTP驗證)</label><br/>
<input type="radio" name="setting[mail_type]" value="mail"  <?php if($mail_type=="mail"){ ?>checked <?php } ?> onclick="Dh('dsmtp');Dh('demail');Dd('l_n').checked=true;" id="mailtype_mail"/> <label for="mailtype_mail">通過PHP mail 函數發送(通常為Unix/Linux 主機)</label><br/>
<input type="radio" name="setting[mail_type]" value="psmtp"  <?php if($mail_type=="psmtp"){ ?>checked <?php } ?> onclick="Ds('dsmtp');Dh('demail');Dd('l_rn').checked=true;" id="mailtype_psmtp"/> <label for="mailtype_psmtp">通過PHP mail 函數SMTP發送(通常為WIN主機)</label>
</td>
</tr>
<tr>
<td class="tl">郵件頭的分隔符</td>
<td><input type="radio" name="setting[mail_delimiter]" value="1" <?php if($mail_delimiter==1){ ?>checked <?php } ?> id="l_rn"/> <label for="l_rn">使用 CRLF 作為分隔符(通常為Windows主機)</label><br/>
<input type="radio" name="setting[mail_delimiter]" value="2" <?php if($mail_delimiter==2){ ?>checked <?php } ?> id="l_n"/> <label for="l_n">使用 LF 作為分隔符(通常為Unix/Linux主機)</label><br/>
<input type="radio" name="setting[mail_delimiter]" value="3" <?php if($mail_delimiter==3){ ?>checked <?php } ?> id="l_r"/> <label for="l_r">使用 CR 作為分隔符(通常為Mac主機)</label>
</td>
</tr>
<tbody id="dsmtp" style="display:<?php if($mail_type == "mail") echo 'none';?>">
<tr> 
<td class="tl">SMTP服務器</td>
<td><input name="setting[smtp_host]" id="smtp_host" type="text" size="40" value="<?php echo $smtp_host;?>"/><?php tips('SMTP服務器,例如smtp.xxx.com<br/>提示:目前大部分新申請的免費郵箱並不支持smtp發信');?></td>
</tr>
<tr> 
<td class="tl">SMTP端口</td>
<td><input name="setting[smtp_port]" id="smtp_port" type="text" size="5" value="<?php echo $smtp_port;?>"/></td>
</tr>
</tbody>
<tbody id="demail" style="display:<?php if($mail_type != "smtp") echo 'none';?>">
<tr> 
<td class="tl">SMTP服務器是否驗證</td>
<td>
<input type="radio" name="setting[smtp_auth]" value="1"  <?php if($smtp_auth==1){ ?>checked <?php } ?> id="smtp_auth" onclick="Ds('dsmtp_user');Ds('dsmtp_pass');"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[smtp_auth]" value="0" <?php if($smtp_auth==0){ ?>checked <?php } ?> onclick="Dh('dsmtp_user');Dh('dsmtp_pass');"/> 否
</tr>
<tr id="dsmtp_user" style="display:<?php if(!$smtp_auth) echo 'none';?>">
<td class="tl">郵箱帳號</td>
<td><input name="setting[smtp_user]" id="smtp_user" type="text" size="40" value="<?php echo $smtp_user;?>"/><?php tips('SMTP服務器的用戶帳號,一般為郵件地址');?></td>
</tr>
<tr id="dsmtp_pass" style="display:<?php if(!$smtp_auth) echo 'none';?>"> 
<td class="tl">郵箱密碼</td>
<td><input name="setting[smtp_pass]" type="text" id="smtp_pass" size="40" value="<?php echo $smtp_pass;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
</tbody>
<tr> 
<td class="tl">郵件簽名</td>
<td><textarea name="setting[mail_sign]" id="mail_sign" cols="60" rows="4"><?php echo $mail_sign;?></textarea><?php tips('支持HTML語法');?></td>
</tr>
<tr> 
<td class="tl">發件人郵箱</td>
<td><input name="setting[mail_sender]" id="mail_sender" type="text" size="40" value="<?php echo $mail_sender;?>"/><?php tips('系統發送的信件將以此郵箱名義發送');?></td>
</tr>
<tr> 
<td class="tl">發件人名稱</td>
<td><input name="setting[mail_name]" id="mail_name" type="text" size="40" value="<?php echo $mail_name;?>"/><?php tips('系統發送的信件將顯示此名稱，不填則顯示網站名');?></td>
</tr>
<tr> 
<td class="tl">測試收件人</td>
<td><input name="testemail" type="text" id="testemail" value="" size="30"/> <input type="button" class="btn" value="測試發送" onclick="TestMail();"/><?php tips('請在左側輸入一個接收測試郵件的郵件地址');?></td>
</tr>
<tr> 
<td class="tl">郵件發送記錄</td>
<td>
<input type="radio" name="setting[mail_log]" value="1"  <?php if($mail_log) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[mail_log]" value="0"  <?php if(!$mail_log) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">自動轉發未讀站內信</td>
<td>
<input type="radio" name="setting[message_email]" value="1"  <?php if($message_email) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[message_email]" value="0"  <?php if(!$message_email) echo 'checked';?>/> 關閉
</td>
</tr>
<tr> 
<td class="tl">自動轉發會員組</td>
<td><?php echo group_checkbox('setting[message_group][]', $message_group, '1,2,3,4');?></td>
</tr>
<tr> 
<td class="tl">未讀時間限制</td>
<td><input name="setting[message_time]" type="text" size="5" value="<?php echo $message_time;?>"/> 分鐘
<?php tips('未讀時間超過此時間時開始轉發');?></td>
</tr>
<tr> 
<td class="tl">轉發信件類型</td>
<td>
<?php
$NAME = array('普通', '詢價', '報價', '留言', '信使');
$message_type = explode(',', $message_type);
foreach($NAME as $k=>$v) {
	$checked = in_array($k, $message_type) ? ' checked' : '';
	echo '<input type="checkbox" name="setting[message_type][]" value="'.$k.'"'.$checked.'/> '.$v.'&nbsp;';
}
?>
</td>
</tr>
</table>
</div>

<div id="Tabs6" style="display:none">
<div class="tt">頁面細節</div>
<table cellpadding="2" cellspacing="1" class="tb">

<tr>
<td class="tl">首頁行業分類大類</td>
<td><input type="text" name="setting[page_bigcat]" value="<?php echo $page_bigcat;?>" size="60"/><?php tips('例如填寫工業品|消費品|原材料|商業服務，然後把供應的一級分類級別設置為1即可歸入工業品，設置為2歸入消費品，設置為3歸入原材料，設置為4歸入商業服務，依次類推');?></td>
</tr>

<tr>
<td class="tl">首頁商品數量</td>
<td><input type="text" name="setting[page_mall]" value="<?php echo $page_mall;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁顯示行業類別</td>
<td><input type="radio" name="setting[page_catalog]" value="1"  <?php if($page_catalog){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_catalog]" value="0"  <?php if(!$page_catalog){ ?>checked <?php } ?>/> 否</td>
</tr>

<tr>
<td class="tl">首頁顯示字母索引</td>
<td><input type="radio" name="setting[page_letter]" value="1"  <?php if($page_letter){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_letter]" value="0"  <?php if(!$page_letter){ ?>checked <?php } ?>/> 否</td>
</tr>


<tr>
<td class="tl">首頁品牌展示數量</td>
<td><input type="text" name="setting[page_brand]" value="<?php echo $page_brand;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁行業展會數量</td>
<td><input type="text" name="setting[page_exhibit]" value="<?php echo $page_exhibit;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁圖片中心數量</td>
<td><input type="text" name="setting[page_photo]" value="<?php echo $page_photo;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁視頻推薦數量</td>
<td><input type="text" name="setting[page_video]" value="<?php echo $page_video;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁顯示會員登錄</td>
<td><input type="radio" name="setting[page_login]" value="1"  <?php if($page_login){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_login]" value="0"  <?php if(!$page_login){ ?>checked <?php } ?>/> 否</td>
</tr>

<tr>
<td class="tl">首頁顯示頭條資訊</td>
<td><input type="radio" name="setting[page_newsh]" value="1"  <?php if($page_newsh){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_newsh]" value="0"  <?php if(!$page_newsh){ ?>checked <?php } ?>/> 否</td>
</tr>

<tr>
<td class="tl">首頁最新資訊數量</td>
<td><input type="text" name="setting[page_news]" value="<?php echo $page_news;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁推薦專題數量</td>
<td><input type="text" name="setting[page_special]" value="<?php echo $page_special;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁推薦團購數量</td>
<td><input type="text" name="setting[page_group]" value="<?php echo $page_group;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁最新企業數量</td>
<td><input type="text" name="setting[page_com]" value="<?php echo $page_com;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁企業新聞數量</td>
<td><input type="text" name="setting[page_comnews]" value="<?php echo $page_comnews;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁行情報價數量</td>
<td><input type="text" name="setting[page_quote]" value="<?php echo $page_quote;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁招商代理數量</td>
<td><input type="text" name="setting[page_info]" value="<?php echo $page_info;?>" size="5"/></td>
</tr>


<tr>
<td class="tl">首頁招聘求職數量</td>
<td><input type="text" name="setting[page_job]" value="<?php echo $page_job;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁行業知道數量</td>
<td><input type="text" name="setting[page_know]" value="<?php echo $page_know;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">首頁資料下載數量</td>
<td><input type="text" name="setting[page_down]" value="<?php echo $page_down;?>" size="5"/></td>
</tr>
<tr>
<td class="tl">首頁投票調查數量</td>
<td><input type="text" name="setting[page_vote]" value="<?php echo $page_vote;?>" size="5"/></td>
</tr>
<tr>
<td class="tl">首頁圖片鏈接數量</td>
<td><input type="text" name="setting[page_logo]" value="<?php echo $page_logo;?>" size="5"/></td>
</tr>
<tr>
<td class="tl">首頁文字鏈接數量</td>
<td><input type="text" name="setting[page_text]" value="<?php echo $page_text;?>" size="5"/></td>
</tr>
</table>
</div>
<script type="text/javascript">
function TestMail() {
	if(Dd('testemail').value == '') {
		Dalert('請先輸入一個接收測試郵件的郵件地址');
		Dd('testemail').focus();
		return false;
	}
	if(Dd('testemail').value == Dd('mail_sender').value) {
		Dalert('測試收件人請不要與發件人相同');
		Dd('testemail').focus();
		return false;
	}
	var url = '?file=setting&action=mail';
	var mail_type = '';
	if(Dd('mailtype_close').checked) mail_type = 'close';
	if(Dd('mailtype_mail').checked) mail_type = 'mail';
	if(Dd('mailtype_smtp').checked) mail_type = 'smtp';
	if(Dd('mailtype_psmtp').checked) mail_type = 'psmtp';
	var mail_delimiter = Dd('l_rn').checked ? 1 : (Dd('l_n').checked ? 2 : 3);
	var smtp_auth = Dd('smtp_auth').checked ? 1 : 0;
	url += '&mail_type='+mail_type+'&mail_delimiter='+mail_delimiter+'&smtp_host='+Dd('smtp_host').value+'&smtp_auth='+smtp_auth+'&smtp_user='+Dd('smtp_user').value+'&smtp_pass='+Dd('smtp_pass').value+'&smtp_port='+Dd('smtp_port').value+'&mail_sender='+Dd('mail_sender').value+'&testemail='+Dd('testemail').value+'&mail_name='+Dd('mail_name').value;
	//window.open(url);
	Diframe(url, 0, 0, 1);
}
</script>
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