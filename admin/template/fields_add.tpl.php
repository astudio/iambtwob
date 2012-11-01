<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="tb" value="<?php echo $tb;?>"/>
<input type="hidden" name="post[tb]" value="<?php echo $tb;?>"/>
<div class="tt">添加字段</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 字段</td>
<td><input name="post[name]" type="text" id="name" size="20"/>
<span id="dname" class="f_red"></span>
小寫字母(a-z),數字(0-9) 推薦使用字母,不能以數字開頭
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 字段名稱</td>
<td><input name="post[title]" type="text" id="title" size="20" /> <?php tips('建議使用中文');?> 
<span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 提示信息</td>
<td><input name="post[note]" type="text" id="note" size="50" /></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 字段屬性</td>
<td>
<select name="post[type]" onchange="dtype(this.value)">
<option value="varchar">字符(Varchar)</option>
<option value="int">整數(Int)</option>
<option value="float">小數(Float)</option>
<option value="text">文本(Text)</option>
</select>
</td>
</tr>
<tr id="tr_length" style="display:">
<td class="tl"><span class="f_hid">*</span> 字段長度</td>
<td><input name="post[length]" type="text" id="length" size="20" value="255"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 表單類型</td>
<td>
<select name="post[html]" onchange="dhtml(this.value)">
<option value="text" selected>單行文本(text)</option>
<option value="textarea">多行文本(textarea)</option>
<option value="select">下拉框(select)</option>
<option value="radio">單選框(radio)</option>
<option value="checkbox">多選框(checkbox)</option>
<option value="hidden">隱藏域(hidden)</option>
<option value="date">日期選擇</option>
<option value="thumb">縮略圖上傳</option>
<option value="file">文件上傳</option>
<option value="editor">網頁編輯器</option>
<option value="area">地區選擇</option>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 默認值</td>
<td>
<textarea name="post[default_value]" style="width:250px;height:40px;overflow:visible;"></textarea>
<br/>支持PHP變量，例如 $_username
</td>
</tr>
<tr id="tr_option" style="display:none;">
<td class="tl"><span class="f_hid">*</span> 選項值</td>
<td>
<textarea name="post[option_value]" style="width:250px;height:80px;overflow:visible;">
選項值A|選項名A*
選項值B|選項名B*
選項值C|選項名C*
</textarea><br/>
一行一個 選項值|選項名稱* 注意*為結尾標誌符
</td>
</tr>
<tr id="tr_wh" style="display:none;">
<td class="tl"><span class="f_hid">*</span> 默認寬高</td>
<td><input name="post[width]" type="text" id="width" size="5" value="120"/> X <input name="post[height]" type="text" id="height" size="5" value="90"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 輸入限制</td>
<td><input name="post[input_limit]" type="text" id="input_limit" size="40" />
<select onchange="dlimit(this.value)">
<option value="">無限制</option>
<option value="notnull">不能為空</option>
<option value="numeric">限數字</option>
<option value="letter">限字母</option>
<option value="nl">限數字和字母</option>
<option value="email">限E-mail地址</option>
<option value="date">限日期格式</option>
</select><br/>
直接填數字表示限制最小長度,如果要限制長度範圍例如6到20之間,則填寫 6-20<br/>
可以直接書寫兼容js和php的正則表達式<br/>
對於單選框(radio),填非0數字表示必選<br/>
對於多選框(checkbox),填非0數字表示必選個數 填長度範圍表示必選個數範圍<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 附加內容</td>
<td>
<input name="post[addition]" type="text" size="60" id="addition" value=""/> <?php tips('可以添加表單屬性、JS事件或CSS樣式 如果有單引號請加 \\');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 直接顯示</td>
<td>
<input type="radio" name="post[display]" value="1" checked/> 是
<input type="radio" name="post[display]" value="0"/> 否 <?php tips('如果選擇否，可以手動將本字段加入到對應的模板文件裡，系統將不直接顯示');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 前台顯示</td>
<td>
<input type="radio" name="post[front]" value="1" checked/> 是
<input type="radio" name="post[front]" value="0"/> 否 <?php tips('如果選擇是，則會在前台顯示，會員可以修改');?>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"/></div>
</form>
<script type="text/javascript">
function dhtml(id) {
	if(id == 'select' || id == 'radio' || id == 'checkbox') {
		Dd('tr_option').style.display = '';
		Dd('tr_wh').style.display = 'none';		
	} else if(id == 'thumb' || id == 'editor') {
		Dd('tr_option').style.display = 'none';
		Dd('tr_wh').style.display = '';
		if(id == 'editor') {
			Dd('width').value = '600';
			Dd('height').value = '300';
		}
	} else {
		Dd('tr_option').style.display = 'none';
		Dd('tr_wh').style.display = 'none';
	}

	if(id == 'text') {
		Dd('addition').value = 'size="30"';
	} else if(id == 'textarea') {
		Dd('addition').value = 'rows="5" cols="80"';
	} else {
		Dd('addition').value = '';
	}
}
Dd('addition').value = 'size="30"';
function dtype(id) {
	if(id == 'varchar') {
		Dd('tr_length').style.display = '';
		Dd('length').value = '255';
	} else if(id == 'int') {
		Dd('tr_length').style.display = '';
		Dd('length').value = '10';
	} else if(id == 'float') {
		Dd('tr_length').style.display = 'none';
		Dd('length').value = '';
	} else if(id == 'text') {
		Dd('tr_length').style.display = 'none';
		Dd('length').value = '';
	}
}
function dlimit(id) {
	if(id == 'notnull') {
		Dd('input_limit').value = '1';
	} else if(id == 'numeric') {
		Dd('input_limit').value = '[0-9]{1,}';
	} else if(id == 'letter') {
		Dd('input_limit').value = '[a-z]{1,}';
	} else if(id == 'nl') {
		Dd('input_limit').value = '[a-z0-9]{1,}';
	} else if(id == 'email') {
		Dd('input_limit').value = 'is_email';
	} else if(id == 'date') {
		Dd('input_limit').value = 'is_date';
	} else {
		Dd('input_limit').value = '';
	}
}
function check() {
	if(Dd('name').value == '') {
		Dmsg('請填寫字段', 'name');
		return false;
	}
	if(Dd('title').value == '') {
		Dmsg('請填寫字段名稱', 'title');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>