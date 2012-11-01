<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">標籤創建嚮導</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 所屬模塊</td>
<td><input type="text" name="setting[moduleid]" size="20" id="moduleid" value="<?php echo $mid;?>"/>
<select onchange="mod(this.value);">
<option value="">請選擇</option>
<option value="$moduleid">變量</option>
<?php foreach($MODULE as $k=>$v) {
	if($k > 4 && !$v['islink']) echo '<option value="'.$k.'"'.($k == $mid ? ' selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>
</td>
<td width="100">moduleid</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 數據表</td>
<td><input type="text" name="setting[table]" size="20" id="table"/>
<span id="stable"><select onchange="Dd('table').value=this.value">
<option value="">選擇表</option>
<?php echo $table_select;?>
</select></span>
<a href="###" onclick="Dict();" class="t">[數據字典]</a>&nbsp;
<a href="###" onclick="Dd('stable').innerHTML=Dd('alltable').value;void(0);" class="t">[顯示所有]</a>
<?php tips('數據表是調用數據的來源<br>系統允許調用同數據庫其他表的數據');?>
<textarea style="display:none;" id="alltable">
<select onchange="Dd('table').value=this.value">
<option value="">選擇表</option>
<?php echo $all_select;?>
</select>
</textarea>
</td>
<td>table</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 調用條件</td>
<td><input type="text" name="setting[condition]" size="50" value="1" id="condition"/>
<select onchange="Dd('condition').value=this.value">
<option value="">常用調用條件</option>
<option value="1">不限條件</option>
<option value="status=3">已發佈的信息</option>
<option value="status=3 and thumb<>''">有圖的信息</option>
<option value="status=3 and vip>0"><?php echo VIP;?>信息</option>
</select>
<?php tips('1表示不限條件<br>此項需要對MySQL語法有一定瞭解');?>
</td>
<td>condition</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 調用數量</td>
<td><input type="text" name="setting[pagesize]" size="10" value="10" id="pagesize"/></td>
<td>pagesize</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 排序方式</td>
<td><input type="text" name="setting[order]" size="30" id="order"/>
<select onchange="Dd('order').value=this.value">
<option value="">常用排序方式</option>
<option value="itemid desc">按信息ID排序</option>
<option value="edittime desc">按修改時間排序</option>
<option value="addtime desc">按添加時間排序</option>
<option value="vip desc">按VIP排序</option>
<option value="hits desc">按瀏覽次數排序</option>
<option value="rand() desc">按隨機排序</option>
</select>
<?php tips('標籤模板位與模板目錄的tag目錄裡');?>
</td>
<td>order</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 所屬分類</td>
<td><input type="text" name="setting[catid]" size="30" id="catid"/>
<?php if($mid) { ?>
<?php echo ajax_category_select('catids', '不限分類', 0, $mid);?>
<a href="javascript:cat();" class="t">&larr;添加</a>
<?php } else { ?>
<span id="scatid"><select onchange="Dd('catid').value=this.value;">
<option value="">不限分類</option>
<option value="$catid">變量</option>
</select></span>
<?php } ?>
</td>
<td>catid</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 包含子分類</td>
<td>
<input type="radio" name="setting[child]" value="1" checked/> 是&nbsp;&nbsp;
<input type="radio" name="setting[child]" value="0" id="child"/> 否
</td>
<td>child</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 所屬地區</td>
<td><input type="text" name="setting[areaid]" size="30" id="areaid"/>
<?php echo ajax_area_select('areaids', '不限地區');?>
<a href="javascript:are();" class="t">&larr;添加</a>
</td>
<td>areaid</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 包含子地區</td>
<td>
<input type="radio" name="setting[areachild]" value="1" checked/> 是&nbsp;&nbsp;
<input type="radio" name="setting[areachild]" value="0" id="areachild"/> 否
</td>
<td>areachild</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 緩存時間</td>
<td><input type="text" name="setting[expires]" size="10" id="expires"/>
<select onchange="Dd('expires').value=this.value">
<option value="">默認緩存</option>
<option value="-1">不緩存</option>
<option value="-2">SQL緩存</option>
<option value="600">自定義時間(秒)</option>
</select>
</td>
<td>expires</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 顯示調試信息</td>
<td>
<input type="radio" name="setting[debug]" value="1" id="debug"/> 是&nbsp;&nbsp;
<input type="radio" name="setting[debug]" value="0" checked/> 否
</td>
<td>debug</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 標籤模板</td>
<td>
<?php echo tpl_select('', 'tag', 'setting[template]', '請選擇', '0', 'id="template"');?>
</td>
<td>template</td>
</tr>
<tr>
<td class="tl">

</td>
<td>
<input type="button" value="生成標籤" class="btn" onclick="mk_tag();"/>
</td>
<td> </td>
</table>
<form method="post" action="?" target="destoon_tag" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="preview"/>
<input type="hidden" id="tag_expires" name="tag_expires"/>
<div class="tt">標籤代碼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 自定義CSS</td>
<td><textarea name="tag_css" id="tag_css"  style="width:98%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:green;"></textarea> 
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> HTML開始標籤</td>
<td><input type="text" name="tag_html_s" id="tag_html_s" size="30" value="" style="font-family:Fixedsys,verdana;"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 標籤代碼</td>
<td><textarea name="tag_code" id="tag_code"  style="width:98%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:blue;"></textarea> 
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> JS調用</td>
<td><textarea name="tag_js" id="tag_js"  style="width:98%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:#800000;"></textarea> 
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> HTML結束標籤</td>
<td><input type="text" name="tag_html_e" id="tag_html_e" size="10" value="" style="font-family:Fixedsys,verdana;"/></td>
</tr>
<tr>
<td class="tl"></td>
<td>
<input type="submit" name="submit" value="預覽標籤" class="btn"/>
<input type="button" value="複製標籤" class="btn" onclick="copy_tag();"/>
<input type="button" value="清空標籤" class="btn" onclick="Dd('tag_code').value='';"/>
<input type="button" value="清空CSS" class="btn" onclick="Dd('tag_css').value='';"/>
<input type="button" value="清空HTML" class="btn" onclick="Dd('tag_html_s').value='';Dd('tag_html_e').value='';"/>
</td>
</tr>
</table>
</form>
<div class="tt">調用手冊</div>
<table cellpadding="2" cellspacing="1" class="tb" style="line-height:200%;">
<tr>
<td class="tl"><span class="f_hid">*</span> 前言</td>
<td>
標籤調用理論上需要網站管理人員有一定的HTML+CSS知識，並對PHP+MySQL有初步的瞭解。<br/>
<strong>調用過程</strong>實際是按照<span style="color:#006699;">調用條件</span>從<span style="color:#006699;">數據表</span>讀取<span style="color:#006699;">調用數量</span>條數據，並依<span style="color:#006699;">排序方式</span>排序，最終通過<span style="color:#006699;">標籤模板</span>的佈局輸出數據。<br/>
本頁內容有限，僅為概述，更多方法技巧請關注官方教程及論壇。<a href="http://help.destoon.com/faq/tag.php?tc=client" target="_blank">http://help.destoon.com/faq/tag.php</a><br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 函數原型</td>
<td>
<strong>tag</strong>($parameter, $expires = 0)<br/>
$parameter 表示傳遞給tag函數的字符串，系統自動將其轉換為多個變量<br/>
例如傳遞 table=destoon&pagesize=10，系統相當於得到$table = 'destoon'；$pagesize = 10；兩個變量<br/>
$expires 表示緩存過期時間<br/>
<span style="color:blue;">>0</span>  緩存$expires秒；<span style="color:blue;">0</span> - 系統默認時間；<span style="color:blue;">-1</span> - 不緩存；<span style="color:blue;">-2</span> - 緩存SQL；一般情況保持默認即可。<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 常量</td>
<td>
<strong>{DT_SKIN}</strong><br/>
系統風格網址。<br/>
<strong>{DT_PATH}</strong><br/>
網站首頁網址。<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 變量</td>
<td>
<strong>$tags</strong><br/>
以數組類型保存標籤調用的數據，可通過loop語法遍歷顯示。<br/>
<strong>$pages</strong><br/>
保存數據分頁代碼，僅在調用了分頁時有效。<br/>
<strong>$MODULE[5][name]</strong><br/>
ID為5的模塊名稱。<br/>
<strong>$MODULE[5][linkurl]</strong><br/>
ID為5的模塊網址。<br/>
<strong>$CATEGORY[5][catname]</strong><br/>
ID為5的分類名稱(僅變量$CATEGORY存在時有效)。<br/>
<strong>$CATEGORY[5][linkurl]</strong><br/>
ID為5的分類網址(僅變量$CATEGORY存在時有效)。<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 常用字段</td>
<td>
<strong>title</strong> 標題； <strong>linkurl</strong> 鏈接； <strong>catid</strong> 分類ID； <strong>introduce</strong> 簡介； <strong>addtime</strong> 添加時間；
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 常用函數</td>
<td>
<strong>dsubstr</strong>($string, $length, $suffix = '')<br/>
將字符串$string截取為$length長,尾部追加$suffix(例如..)<br/>
<strong>date</strong>($format, $timestamp)<br/>
將時間戳$timestamp轉化為$format(例如Y-m-d)格式<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 標籤模板</td>
<td>
模板保存於./template/<?php echo $CFG['template'];?>/tag/目錄；<br/>
建議不要刪除或者修改自帶的模板，推薦在自帶模板基礎上新建模板並應用。<br/>
</td>
</tr>
</table>
</div>
<script type="text/javascript">
function mk_tag() {
	var tag = js = '';
	if(Dd('moduleid').value == '' && Dd('table').value == '') {
		alert('所屬模塊 或 數據表 必須指定一項');
		return false;
	}
	if(Dd('moduleid').value != '') tag += '&moduleid='+Dd('moduleid').value;
	if(Dd('table').value != '') tag += '&table='+Dd('table').value;
	if(Dd('catid').value != '') tag += '&catid='+Dd('catid').value;
	if(Dd('catid').value != '' && Dd('child').checked) tag += '&child=0';
	if(Dd('areaid').value != '') tag += '&areaid='+Dd('areaid').value;
	if(Dd('areaid').value != '' && Dd('areachild').checked) tag += '&areachild=0';
	if(Dd('condition').value != '' && Dd('condition').value != '1') tag += '&condition='+Dd('condition').value;
	if(Dd('pagesize').value == '') {
		alert('請填寫調用數量');
		Dd('pagesize').focus();
		return;
	} else {
		tag += '&pagesize='+Dd('pagesize').value;
	}
	if(Dd('order').value != '') tag += '&order='+Dd('order').value;
	if(Dd('template').value != 0) tag += '&template='+Dd('template').value;
	if(Dd('debug').checked) tag += '&debug=1';
	tag = tag.substr(1);
	var rp = false;
	for(var i=0;i<tag.length;i++) {
		if(tag.charAt(i) == '$') {
			js += '{$'
			rp = true;
		} else if(rp && tag.charAt(i) == '&') {
			js += '}&';
			rp = false;
		} else {
			js += tag.charAt(i);
		}
	}
	js = '<script type="text/javascript" src="<?php echo DT_PATH;?>api/js.php?'+js;
	tag = '<!--{tag("'+tag+'"';
	if(Dd('expires').value != '') {
		tag += ', '+Dd('expires').value;
		js += '&tag_expires='+Dd('expires').value;
	}
	js = js+'"><\/script>';
	tag = tag+')}-->';
	Dd('tag_code').value = tag;
	Dd('tag_js').value = js;
}
function copy_tag() {
	if(!Dd('tag_code').value) return;
	Dd('tag_code').select();
	if(isIE) {
		clipboardData.setData('text', Dd('tag_code').value);
	} else {
		prompt('Press Ctrl+C Copy to Clipboard', Dd('tag_code').value);
	}
}
function check() {
	if(Dd('expires').value != '') Dd('tag_expires').value = Dd('expires').value
	if(Dd('tag_code').value == '') {
		if(confirm('標籤代碼尚未生成，現在生成嗎？')) mk_tag();
		return false;
	}
}
function mod(m) {
	Dd('moduleid').value = m;
	if(m == '' || m == '$moduleid') return false;
	Go('?file=<?php echo $file;?>&mid='+m);
}
function cat() {
	if(Dd('catid_1').value > 0) {
		stoinp(Dd('catid_1').value, 'catid');
	} else {
		Dd('catid').value = '';
	}
}
function are() {
	if(Dd('areaid_1').value > 0) {
		stoinp(Dd('areaid_1').value, 'areaid');
	} else {
		Dd('areaid').value = '';
	}
}
function Dict() {
	if(Dd('moduleid').value == '' && Dd('table').value == '') {
		alert('所屬模塊 或 數據表 必須指定一項');
		return false;
	}
	mkDialog('', '<iframe src="?file=tag&action=find&mid='+Dd('moduleid').value+'&tb='+Dd('table').value+'" width="600" height=300" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '數據字典', 620, 0, 0);
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>