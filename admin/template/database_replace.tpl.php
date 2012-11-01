<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>

<form method="post" action="?" onsubmit="return fcheck();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="file_replace"/>
<div class="tt">備份文件內容替換</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 備份系列</td>
<td>
<select name="file_pre">
<option value="">選擇備份文件系列</option>
<?php echo $sql_select;?>
</select> <span id="dfile_pre" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 查找</td>
<td><input type="text" name="file_from" value="" size="60" id="file_from"/><br/><span id="dfile_from" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 替換為 </td>
<td><input type="text" name="file_to" value="" size="60" id="file_to"/><br/><span id="dfile_to" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td><input type="submit" name="submit" value="執 行" class="btn"/></td> 
</tr>
</table>
</form>

<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">數據庫內容替換</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 數據字段</td>
<td>
<select name="table" onchange="get_fields(this.value);">
<option value="">選擇表</option>
<?php echo $table_select;?>
</select>
&nbsp;&nbsp;&nbsp;
<span id="fields"><select name="fields" id="fd"><option value="">選擇字段</option></select></span> <span id="dfd" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 替換類型</td>
<td>
<input name="type" type="radio" value="1" checked id="type" onclick="Dd('adds').style.display='none';Dd('replace').style.display='';"/> 直接替換
<input name="type" type="radio" value="2" onclick="Dd('adds').style.display='';Dd('replace').style.display='none';"/> 頭部追加
<input name="type" type="radio" value="3" onclick="Dd('adds').style.display='';Dd('replace').style.display='none';"/> 尾部追加
</td>
</tr>
<tbody id="replace" style="display:;">
<tr>
<td class="tl"><span class="f_red">*</span> 查找</td>
<td><textarea name="from" id="from" style="width:500px;height:50px;overflow:visible;"></textarea><br/><span id="dfrom" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 替換為 </td>
<td><textarea name="to" id="to" style="width:500px;height:50px;overflow:visible;"></textarea><br/><span id="dto" class="f_red"></span></td>
</tr>
</tbody>
<tbody id="adds" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> 追加內容</td>
<td><textarea name="add" id="add" style="width:500px;height:50px;overflow:visible;"></textarea><br/><span id="dadd" class="f_red"></span></td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> 替換條件</td>
<td><input name="conditon" type="text" size="50"/> <span class="f_gray">請輸入MySQL條件語句（AND開頭）</span></td> 
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td><input type="submit" name="submit" value="執 行" class="btn"/></td> 
</tr>
</table>
</form>

<script type="text/javascript">
var vid = '';
function get_fields(tb) {
	if(!tb) return false;
	makeRequest('file=<?php echo $file;?>&action=fields&table='+tb, '?', 'dget_fields')
}
function dget_fields() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) Dd('fields').innerHTML = xmlHttp.responseText;
	}
}
function fcheck() {
	if(Dd('file_pre').value == '') {
		Dmsg('請選擇備份系列', 'file_pre');
		return false;
	}
	if(Dd('file_from').value == '') {
		Dmsg('請填寫查找內容', 'file_from');
		return false;
	}
	return confirm('您確定要開始替換嗎？');
}
function check() {
	if(Dd('fd').value == '') {
		Dmsg('請選擇數據字段', 'fd');
		return false;
	}
	if(Dd('type').checked) {
		if(Dd('from').value == '') {
			Dmsg('請填寫查找內容', 'from');
			return false;
		}
	} else {
		if(Dd('add').value == '') {
			Dmsg('請填寫追加內容', 'add');
			return false;
		}
	}
	return confirm('重要提示:為防止操作失誤，請務必在操作之前備份數據\n\n此操作不可恢復，您確定要執行嗎？');
}
</script>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>