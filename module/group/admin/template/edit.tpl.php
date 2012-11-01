<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 所屬分類</td>
<td><?php echo $_admin == 1 ? category_select('post[catid]', '選擇分類', $catid, $moduleid) : ajax_category_select('post[catid]', '選擇分類', $catid, $moduleid);?><span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>標題</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '級別', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 標題圖片</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span><span id="dthumb" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 團購價</td>
<td><input name="post[price]" type="text" size="10" value="<?php echo $price;?>" id="rice"/><span id="dprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 市場價</td>
<td><input name="post[marketprice]" type="text" size="10" value="<?php echo $marketprice;?>" id="marketprice"/><span id="dmarketprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 最低人數</td>
<td><input name="post[minamount]" type="text" size="10" value="<?php echo $minamount;?>" id="minamount"/><span id="dminamount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 最多人數</td>
<td><input name="post[amount]" type="text" size="10" value="<?php echo $amount;?>" id="damount"/><span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 過期時間</td>
<td><?php echo dcalendar('post[totime]', $totime);?>&nbsp;
<select onchange="Dd('posttotime').value=this.value;">
<option value="">快捷選擇</option>
<option value="">長期有效</option>
<option value="<?php echo timetodate($DT_TIME+86400*3, 3);?>">3天</option>
<option value="<?php echo timetodate($DT_TIME+86400*7, 3);?>">一周</option>
<option value="<?php echo timetodate($DT_TIME+86400*15, 3);?>">半月</option>
<option value="<?php echo timetodate($DT_TIME+86400*30, 3);?>">一月</option>
<option value="<?php echo timetodate($DT_TIME+86400*182, 3);?>">半年</option>
<option value="<?php echo timetodate($DT_TIME+86400*365, 3);?>">一年</option>
</select>&nbsp;
<span id="dposttotime" class="f_red"></span> 不選表示長期有效</td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 1;
</script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/property.js"></script>
<?php if($itemid) { ?><script type="text/javascript">setTimeout("load_property()", 1000);</script><?php } ?>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>簡介</td>
<td><textarea name="post[introduce]" style="width:90%;height:45px;"><?php echo $introduce;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 詳細說明</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<?php
if($MOD['swfu']) { 
	include DT_ROOT.'/file/swfupload/editor.inc.php';
}
?>
<tr>
<td class="tl"><span class="f_hid">*</span> 需要物流</td>
<td>
<input type="radio" name="post[logistic]" value="1" <?php if($logistic) echo 'checked';?> id="logistic_1"/><label for="logistic_1"> 是</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[logistic]" value="0" <?php if(!$logistic) echo 'checked';?> id="logistic_0"/><label for="logistic_0"> 否</label>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 團購人數</td>
<td><input name="post[orders]" type="text" size="10" value="<?php echo $orders;?>"/><?php tips('如果沒有特殊情況，不建議修改，以免出現購買人數和銷量不一致的情況');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 會員名</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[資料]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 信息狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通過
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待審
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';"/> 拒絕
<input type="radio" name="post[status]" value="4" <?php if($status == 4) echo 'checked';?>/> 過期
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?>/> 刪除
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 拒絕理由</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 瀏覽次數</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容收費</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('不填或填0表示繼承模塊設置價格，-1表示不收費<br/>大於0的數字表示具體收費價格');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('show', $module, 'post[template]', '默認模板', $template, 'id="template"');?><?php tips('如果沒有特殊需要，一般不需要選擇<br/>系統會自動繼承分類或模塊設置');?></td>
</tr>
<?php if($MOD['show_html']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 自定義文件路徑</td>
<td><input type="text" size="50" name="post[filepath]" value="<?php echo $filepath;?>" id="filepath"/>&nbsp;<input type="button" value="重名檢測" onclick="ckpath(<?php echo $moduleid;?>, <?php echo $itemid;?>);" class="btn"/>&nbsp;<?php tips('可以包含目錄和文件 例如 destoon/b2b.html<br/>請確保目錄和文件名合法且可寫入，否則可能生成失敗');?>&nbsp; <span id="dfilepath" class="f_red"></span></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">單頁采編</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 目標網址</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" 獲 取 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 管理規則 " class="btn" onclick="window.open('?file=fetch');"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function _p() {
	if(Dd('tag').value) {
		Ds('reccate');
	}
}
function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('請選擇所屬分類', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('標題最少2字，當前已輸入'+l+'字', f);
		return false;
	}
	f = 'thumb';
	l = Dd(f).value.length;
	if(l < 15) {
		Dmsg('請上傳標題圖片', f);
		return false;
	}
	f = 'price';
	l = Dd(f).value;
	if(l < 0.1) {
		Dmsg('請填寫團購價', f);
		return false;
	}
	f = 'marketprice';
	l = Dd(f).value;
	if(l < 0.1) {
		Dmsg('請填寫市場價', f);
		return false;
	}
	if(l <= Dd('price').value) {
		Dmsg('團購價必須低於市場價', f);
		return false;
	}
	if(Dd('ismember_1').checked) {
		f = 'username';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('請填寫會員名', f);
			return false;
		}
	} else {
		f = 'company';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('請填寫公司名稱', f);
			return false;
		}
		if(Dd('areaid_1').value == 0) {
			Dmsg('請選擇所在地區', 'areaid', 1);
			return false;
		}
		f = 'truename';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('請填寫聯繫人', f);
			return false;
		}
		f = 'mobile';
		l = Dd(f).value.length;
		if(l < 7) {
			Dmsg('請填寫手機', f);
			return false;
		}
	}
	<?php echo $FD ? fields_js() : '';?>
	if(Dd('property_require') != null) {
		var ptrs = Dd('property_require').getElementsByTagName('option');
		for(var i = 0; i < ptrs.length; i++) {		
			f = 'property-'+ptrs[i].value;
			if(Dd(f).value == 0 || Dd(f).value == '') {
				Dmsg('請填寫或選擇'+ptrs[i].innerHTML, f);
				return false;
			}
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>