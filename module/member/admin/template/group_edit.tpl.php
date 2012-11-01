<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">會員組修改</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="groupid" value="<?php echo $groupid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 會員組名稱</td>
<td><input type="text" size="20" name="groupname" id="groupname" value="<?php echo $groupname;?>"/> <span id="dgroupname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 會員模式</td>
<td>
<input type="radio" name="setting[fee_mode]" value="1" <?php if($fee_mode) echo 'checked';?> onclick="Ds('mode_1');Dh('mode_0');"/> 收費會員&nbsp;&nbsp;
<input type="radio" name="setting[fee_mode]" value="0" <?php if(!$fee_mode) echo 'checked';?> onclick="Ds('mode_0');Dh('mode_1');"/> 免費會員
</td>
</tr>
<tbody id="mode_1" style="display:<?php echo $fee_mode ? '' : 'none';?>">
<tr>
<td class="tl"><span class="f_red">*</span> 收費設置</td>
<td><input type="text" size="20" name="setting[fee]" id="fee" value="<?php echo $fee;?>"/> <?php echo $DT['money_unit'];?>/年 <span class="f_gray">免費會員請填0</span> <span id="dfee" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo VIP;?>指數</td>
<td><input type="text" size="20" name="vip" id="vip" value="<?php echo $vip;?>"/> <span class="f_gray">免費會員請填0，收費會員請填1-9數字</span> <span id="dvip" class="f_red"></span></td>
</tr>
</tbody>
<tr id="mode_0" style="display:<?php echo $fee_mode ? 'none' : '';?>">
<td class="tl"><span class="f_red">*</span> 享受折扣</td>
<td><input type="text" size="20" name="setting[discount]" id="discount" value="<?php echo $discount;?>"/> % 折扣僅限系統收費，不針對會員產品</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 顯示順序</td>
<td><input type="text" size="5" name="listorder" id="listorder" value="<?php echo $listorder;?>"/>  <span class="f_gray">數字越小越靠前</span></td>
</tr>
</table>
<div class="tt">會員權限</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">設置說明</td>
<td>數量限制填 <strong>0</strong> 則表示不限&nbsp;&nbsp;&nbsp;填 <strong>-1</strong> 表示禁止使用</td>
</tr>
<tr>
<td class="tl">允許在會員升級頁面顯示</td>
<td>
<input type="radio" name="setting[grade]" value="1" <?php if($grade) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[grade]" value="0" <?php if(!$grade) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">允許在會員註冊頁面顯示</td>
<td>
<input type="radio" name="setting[reg]" value="1" <?php if($reg) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[reg]" value="0" <?php if(!$reg) echo 'checked';?>> 否 此設置對<?php echo VIP;?>會員無效
</td>
</tr>
<tr>
<td class="tl">編輯器工具按鈕</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>全部</option>
<option value="Destoon"<?php if($editor == 'Destoon') echo ' selected';?>>精簡</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>簡潔</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>基礎</option>
</select>&nbsp;
<?php tips('全部按鈕允許會員編輯源代碼和插入FLASH和視頻文件<br/>為了防止被惡意利用，建議僅對受信任的會員組開啟');?>
</td>
</tr>
<tr>
<td class="tl">允許上傳文件</td>
<td>
<input type="radio" name="setting[upload]" value="1" <?php if($upload) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[upload]" value="0" <?php if(!$upload) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">允許上傳的文件類型</td>
<td><input name="setting[uploadtype]" type="text" value="<?php echo $uploadtype;?>" size="60"/> <?php tips('用|號隔開文件後綴，留空表示繼承網站設置');?></td>
</tr>
<tr>
<td class="tl">允許上傳大小限制</td>
<td><input name="setting[uploadsize]" type="text" value="<?php echo $uploadsize;?>" size="10"/> Kb (1024Kb=1M) 不填或填0表示繼承網站設置</td>
</tr>
<tr>
<td class="tl">單條信息上傳數量限制</td>
<td><input name="setting[uploadlimit]" type="text" value="<?php echo $uploadlimit;?>" size="5"/> <?php tips('一條信息內最多上傳文件數量限制，0為不限制');?></td>
</tr>
<tr>
<td class="tl">24小時上傳數量限制</td>
<td><input name="setting[uploadday]" type="text" value="<?php echo $uploadday;?>" size="5"/> <?php tips('24小時內最大文件上傳數量限制，0為不限制<br/>此項會增加服務器壓力，且在開啟上傳記錄的情況下有效');?></td>
</tr>
<tr>
<td class="tl">產品圖片數量限制</td>
<td>
<input type="radio" name="setting[uploadpt]" value="1" <?php if($uploadpt) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[uploadpt]" value="0" <?php if(!$uploadpt) echo 'checked';?>> 否 <?php tips('如果選擇是，產品圖片只允許傳1張，如果不限可以傳3張，此項不針對'.VIP.'會員');?>
</td>
</tr>
<tr>
<td class="tl">發佈信息需要審核</td>
<td>
<input type="radio" name="setting[check]" value="1" <?php if($check) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check]" value="0" <?php if(!$check) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">發佈信息啟用驗證碼</td>
<td>
<input type="radio" name="setting[captcha]" value="1" <?php if($captcha) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha]" value="0" <?php if(!$captcha) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">發佈信息啟用驗證問題</td>
<td>
<input type="radio" name="setting[question]" value="1" <?php if($question) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question]" value="0" <?php if(!$question) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許申請提現</td>
<td>
<input type="radio" name="setting[cash]" value="1" <?php if($cash) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[cash]" value="0" <?php if(!$cash) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許使用客服中心</td>
<td>
<input type="radio" name="setting[ask]" value="1" <?php if($ask) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ask]" value="0" <?php if(!$ask) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許使用商機訂閱</td>
<td>
<input type="radio" name="setting[mail]" value="1" <?php if($mail) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[mail]" value="0" <?php if(!$mail) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許使用手機短信</td>
<td>
<input type="radio" name="setting[sms]" value="1" <?php if($sms) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sms]" value="0" <?php if(!$sms) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許發送電子郵件</td>
<td>
<input type="radio" name="setting[sendmail]" value="1" <?php if($sendmail) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sendmail]" value="0" <?php if(!$sendmail) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許站內付款</td>
<td>
<input type="radio" name="setting[trade_pay]" value="1" <?php if($trade_pay) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_pay]" value="0" <?php if(!$trade_pay) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許查看訂單</td>
<td>
<input type="radio" name="setting[trade_sell]" value="1" <?php if($trade_sell) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_sell]" value="0" <?php if(!$trade_sell) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許競價排名</td>
<td>
<input type="radio" name="setting[spread]" value="1" <?php if($spread) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[spread]" value="0" <?php if(!$spread) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許廣告預定</td>
<td>
<input type="radio" name="setting[ad]" value="1" <?php if($ad) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad]" value="0" <?php if(!$ad) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">允許發起聊天請求</td>
<td>
<input type="radio" name="setting[chat]" value="1" <?php if($chat) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[chat]" value="0" <?php if(!$chat) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">收件箱數量限制</td>
<td>
<input type="text" name="setting[inbox_limit]" size="5" value="<?php echo $inbox_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">商友數量限制</td>
<td>
<input type="text" name="setting[friend_limit]" size="5" value="<?php echo $friend_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">商機收藏數量限制</td>
<td>
<input type="text" name="setting[favorite_limit]" size="5" value="<?php echo $favorite_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">貿易提醒數量限制</td>
<td>
<input type="text" name="setting[alert_limit]" size="5" value="<?php echo $alert_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">收貨地址數量限制</td>
<td>
<input type="text" name="setting[address_limit]" size="5" value="<?php echo $address_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">每日可發站內信限制</td>
<td>
<input type="text" name="setting[message_limit]" size="5" value="<?php echo $message_limit;?>"/> <?php echo tips('詢盤和報價為特殊的站內信，發送一次詢盤或者報價會消耗一次站內信發送機會');?>
</td>
</tr>

<tr>
<td class="tl">每日詢盤次數限制</td>
<td>
<input type="text" name="setting[inquiry_limit]" size="5" value="<?php echo $inquiry_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">每日報價次數限制</td>
<td>
<input type="text" name="setting[price_limit]" size="5" value="<?php echo $price_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">自定義分類限制</td>
<td>
<input type="text" name="setting[type_limit]" size="5" value="<?php echo $type_limit;?>"/>
</td>
</tr>

</table>

<div class="tt">公司主頁</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">擁有公司主頁</td>
<td>
<input type="radio" name="setting[homepage]" value="1" <?php if($homepage) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[homepage]" value="0" <?php if(!$homepage) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">默認公司模板</td>
<td>
<?php echo homepage_select('setting[styleid]', '請選擇', $groupid, $styleid, 'id="styleid"');?>&nbsp;&nbsp;
<a href="javascript:" onclick="if(Dd('styleid').value>0)window.open('?moduleid=2&file=style&action=show&itemid='+Dd('styleid').value);" class="t">[預覽]</a>
</td>
</tr>
<tr>
<td class="tl">允許自定義主頁設置</td>
<td>
<input type="radio" name="setting[home]" value="1" <?php if($home) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home]" value="0" <?php if(!$home) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">允許自定義菜單</td>
<td>
<input type="radio" name="setting[home_menu]" value="1" <?php if($home_menu) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_menu]" value="0" <?php if(!$home_menu) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">可用菜單</td>
<td>
<ul class="mods">
<?php
	$_menu_c = ','.$menu_c.',';
	foreach($HMENU as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[menu_c][]" value="'.$k.'" '.(strpos($_menu_c, ','.$k.',') !== false ? 'checked' : '').' id="menu_c_'.$k.'"/><label for="menu_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">默認菜單</td>
<td>
<ul class="mods">
<?php
	$_menu_d = ','.$menu_d.',';
	foreach($HMENU as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[menu_d][]" value="'.$k.'" '.(strpos($_menu_d, ','.$k.',') !== false ? 'checked' : '').' id="menu_d_'.$k.'"/><label for="menu_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">允許自定義側欄</td>
<td>
<input type="radio" name="setting[home_side]" value="1" <?php if($home_side) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_side]" value="0" <?php if(!$home_side) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">可用側欄</td>
<td>
<ul class="mods">
<?php
	$_side_c = ','.$side_c.',';
	foreach($HSIDE as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[side_c][]" value="'.$k.'" '.(strpos($_side_c, ','.$k.',') !== false ? 'checked' : '').' id="side_c_'.$k.'"/><label for="side_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">默認側欄</td>
<td>
<ul class="mods">
<?php
	$_side_d = ','.$side_d.',';
	foreach($HSIDE as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[side_d][]" value="'.$k.'" '.(strpos($_side_d, ','.$k.',') !== false ? 'checked' : '').' id="side_d_'.$k.'"/><label for="side_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">允許自定義首頁</td>
<td>
<input type="radio" name="setting[home_main]" value="1" <?php if($home_main) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_main]" value="0" <?php if(!$home_main) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">可用首頁</td>
<td>
<ul class="mods">
<?php
	$_main_c = ','.$main_c.',';
	foreach($HMAIN as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[main_c][]" value="'.$k.'" '.(strpos($_main_c, ','.$k.',') !== false ? 'checked' : '').' id="main_c_'.$k.'"/><label for="main_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">默認首頁</td>
<td>
<ul class="mods">
<?php
	$_main_d = ','.$main_d.',';
	foreach($HMAIN as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[main_d][]" value="'.$k.'" '.(strpos($_main_d, ','.$k.',') !== false ? 'checked' : '').' id="main_d_'.$k.'"/><label for="main_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">允許選擇模板</td>
<td>
<input type="radio" name="setting[style]" value="1" <?php if($style) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[style]" value="0" <?php if(!$style) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許使用第三方地圖</td>
<td>
<input type="radio" name="setting[map]" value="1" <?php if($map) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[map]" value="0" <?php if(!$map) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許使用第三方統計</td>
<td>
<input type="radio" name="setting[stats]" value="1" <?php if($stats) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[stats]" value="0" <?php if(!$stats) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許使用第三方客服</td>
<td>
<input type="radio" name="setting[kf]" value="1" <?php if($kf) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[kf]" value="0" <?php if(!$kf) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">公司新聞數量限制</td>
<td>
<input type="text" name="setting[news_limit]" size="5" value="<?php echo $news_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">公司單頁數量限制</td>
<td>
<input type="text" name="setting[page_limit]" size="5" value="<?php echo $page_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">榮譽資質數量限制</td>
<td>
<input type="text" name="setting[honor_limit]" size="5" value="<?php echo $honor_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">友情鏈接數量限制</td>
<td>
<input type="text" name="setting[link_limit]" size="5" value="<?php echo $link_limit;?>"/>
</td>
</tr>
</table>
<div class="tt">信息發佈</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">允許發佈信息的模塊</td>
<td>
<ul class="mods">
<?php
	$moduleids = explode(',', $moduleids);
	foreach($MODULE as $m) {
		if($m['moduleid'] > 4 && is_file(DT_ROOT.'/module/'.$m['module'].'/my.inc.php')) {
			if($m['moduleid'] == 9) {
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="9" '.(in_array(9, $moduleids) ? 'checked' : '').' id="mod_9"/><label for="mod_9"> 招聘</label></li>';
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="-9" '.(in_array(-9, $moduleids) ? 'checked' : '').' id="mod__9"/><label for="mod__9"> 簡歷</label></li>';
			} else {
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="'.$m['moduleid'].'" '.(in_array($m['moduleid'], $moduleids) ? 'checked' : '').' id="mod_'.$m['moduleid'].'"/><label for="mod_'.$m['moduleid'].'"> '.$m['name'].'</label></li>';
			}
		}
	}
?>
</ul>
</td>
</tr>


<tr>
<td class="tl">開啟強制郵件認證</td>
<td>
<input type="radio" name="setting[vemail]" value="1" <?php if($vemail){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vemail]" value="0" <?php if(!$vemail){ ?>checked <?php } ?>/> 否&nbsp;&nbsp;
開啟之後，郵件認證成功才可以發佈信息
</td>
</tr>
<tr>
<td class="tl">開啟強制手機認證</td>
<td>
<input type="radio" name="setting[vmobile]" value="1" <?php if($vmobile){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vmobile]" value="0" <?php if(!$vmobile){ ?>checked <?php } ?>/> 否&nbsp;&nbsp;
開啟之後，手機認證成功才可以發佈信息
</td>
</tr>
<tr>
<td class="tl">開啟強制姓名認證</td>
<td>
<input type="radio" name="setting[vtruename]" value="1" <?php if($vtruename){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vtruename]" value="0" <?php if(!$vtruename){ ?>checked <?php } ?>/> 否&nbsp;&nbsp;
開啟之後，姓名認證成功才可以發佈信息
</td>
</tr>
<tr>
<td class="tl">開啟強制公司認證</td>
<td>
<input type="radio" name="setting[vcompany]" value="1" <?php if($vcompany){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vcompany]" value="0" <?php if(!$vcompany){ ?>checked <?php } ?>/> 否&nbsp;&nbsp;
開啟之後，公司認證成功才可以發佈信息
</td>
</tr>


<tr>
<td class="tl">允許刪除信息</td>
<td>
<input type="radio" name="setting[delete]" value="1" <?php if($delete) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[delete]" value="0" <?php if(!$delete) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允許複製信息</td>
<td>
<input type="radio" name="setting[copy]" value="1" <?php if($copy) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[copy]" value="0" <?php if(!$copy) echo 'checked';?>> 否 

複製信息可顯著提高發佈信息效率
</td>
</tr>

<tr>
<td class="tl">發佈信息時間間隔</td>
<td>
<input type="text" name="setting[add_limit]" size="5" value="<?php echo $add_limit;?>"/>
&nbsp;&nbsp;單位： 秒&nbsp;&nbsp;填 0 表示不限制&nbsp;&nbsp;填正數表示發佈兩次發佈時間間隔
</td>
</tr>

<tr>
<td class="tl">24小時發佈信息數量</td>
<td>
<input type="text" name="setting[day_limit]" size="5" value="<?php echo $day_limit;?>"/>
&nbsp;&nbsp;填 0 表示不限制&nbsp;&nbsp;填正數表示24小時內在單模塊發佈信息數量限制
</td>
</tr>

<tr>
<td class="tl">刷新信息時間間隔</td>
<td>
<input type="text" name="setting[refresh_limit]" size="5" value="<?php echo $refresh_limit;?>"/>
&nbsp;&nbsp;單位： 秒&nbsp;&nbsp;填 -1 表示不允許刷新&nbsp;&nbsp;填 0 表示不限制時間間隔&nbsp;&nbsp;填正數表示限制兩次刷新時間
</td>
</tr>

<tr>
<td class="tl">允許修改信息時間</td>
<td>
<input type="text" name="setting[edit_limit]" size="5" value="<?php echo $edit_limit;?>"/>
&nbsp;&nbsp;單位： 天&nbsp;&nbsp;填 -1 表示不允許修改&nbsp;&nbsp;填 0 表示不限制時間修改&nbsp;&nbsp;填正數表示發佈時間超出後不可修改
</td>
</tr>

<tr>
<td class="tl">發佈供應總數限制</td>
<td>
<input type="text" name="setting[sell_limit]" size="5" value="<?php echo $sell_limit;?>"/>
&nbsp;&nbsp;填 -1 表示禁止發佈 填 0 表示不限制數量 填正數表示限制數量，下同
</td>
</tr>

<tr>
<td class="tl">免費發佈供應數量</td>
<td>
<input type="text" name="setting[sell_free_limit]" size="5" value="<?php echo $sell_free_limit;?>"/>
&nbsp;&nbsp;填 -1 表示不收費 請填 0 表示無免費 填正數表示可免費發佈條數，下同
</td>
</tr>

<tr>
<td class="tl">發佈求購總數限制</td>
<td>
<input type="text" name="setting[buy_limit]" size="5" value="<?php echo $buy_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈求購數量</td>
<td>
<input type="text" name="setting[buy_free_limit]" size="5" value="<?php echo $buy_free_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">發佈商品總數限制</td>
<td>
<input type="text" name="setting[mall_limit]" size="5" value="<?php echo $mall_limit;?>"/> &nbsp;&nbsp;針對商城模塊
</td>
</tr>

<tr>
<td class="tl">免費發佈商品數量</td>
<td>
<input type="text" name="setting[mall_free_limit]" size="5" value="<?php echo $mall_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈團購總數限制</td>
<td>
<input type="text" name="setting[group_limit]" size="5" value="<?php echo $group_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈團購數量</td>
<td>
<input type="text" name="setting[group_free_limit]" size="5" value="<?php echo $group_free_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">發佈展會總數限制</td>
<td>
<input type="text" name="setting[exhibit_limit]" size="5" value="<?php echo $exhibit_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈展會數量</td>
<td>
<input type="text" name="setting[exhibit_free_limit]" size="5" value="<?php echo $exhibit_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈行情總數限制</td>
<td>
<input type="text" name="setting[quote_limit]" size="5" value="<?php echo $quote_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈行情數量</td>
<td>
<input type="text" name="setting[quote_free_limit]" size="5" value="<?php echo $quote_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈招聘總數限制</td>
<td>
<input type="text" name="setting[job_limit]" size="5" value="<?php echo $job_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈招聘數量</td>
<td>
<input type="text" name="setting[job_free_limit]" size="5" value="<?php echo $job_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈簡歷總數限制</td>
<td>
<input type="text" name="setting[resume_limit]" size="5" value="<?php echo $resume_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈簡歷數量</td>
<td>
<input type="text" name="setting[resume_free_limit]" size="5" value="<?php echo $resume_free_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">發佈文章總數限制</td>
<td>
<input type="text" name="setting[article_limit]" size="5" value="<?php echo $article_limit;?>"/>
「文章」指用文章模型創建的模塊，例如「資訊」模塊
</td>
</tr>

<tr>
<td class="tl">免費發佈文章數量</td>
<td>
<input type="text" name="setting[article_free_limit]" size="5" value="<?php echo $article_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈信息總數限制</td>
<td>
<input type="text" name="setting[info_limit]" size="5" value="<?php echo $info_limit;?>"/>
「信息」指用信息模型創建的模塊，例如「招商」模塊
</td>
</tr>

<tr>
<td class="tl">免費發佈信息數量</td>
<td>
<input type="text" name="setting[info_free_limit]" size="5" value="<?php echo $info_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈知道總數限制</td>
<td>
<input type="text" name="setting[know_limit]" size="5" value="<?php echo $know_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈知道數量</td>
<td>
<input type="text" name="setting[know_free_limit]" size="5" value="<?php echo $know_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈品牌總數限制</td>
<td>
<input type="text" name="setting[brand_limit]" size="5" value="<?php echo $brand_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈品牌數量</td>
<td>
<input type="text" name="setting[brand_free_limit]" size="5" value="<?php echo $brand_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈圖庫總數限制</td>
<td>
<input type="text" name="setting[photo_limit]" size="5" value="<?php echo $photo_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈圖庫數量</td>
<td>
<input type="text" name="setting[photo_free_limit]" size="5" value="<?php echo $photo_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">發佈視頻總數限制</td>
<td>
<input type="text" name="setting[video_limit]" size="5" value="<?php echo $video_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈視頻數量</td>
<td>
<input type="text" name="setting[video_free_limit]" size="5" value="<?php echo $video_free_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">發佈下載總數限制</td>
<td>
<input type="text" name="setting[down_limit]" size="5" value="<?php echo $down_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免費發佈下載數量</td>
<td>
<input type="text" name="setting[down_free_limit]" size="5" value="<?php echo $down_free_limit;?>"/>
</td>
</tr>
</table>

<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;</div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'groupname';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫會員組名稱', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>