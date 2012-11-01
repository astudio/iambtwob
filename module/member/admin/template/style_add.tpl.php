<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">安裝模板</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 模板分類</td>
<td><?php echo type_select('style', 1, 'post[typeid]', '請選擇分類', 0, 'id="typeid"');?> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 模板名稱</td>
<td><input name="post[title]" type="text" id="title" size="30" /> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 風格目錄</td>
<td>
<select name="post[skin]" id="skin" onchange="if(this.value){Dskin(this.value);}">
<option value="">請選擇</option>
<?php
$d = DT_ROOT.'/'.$MODULE[4]['moduledir'].'/skin/';
foreach(glob($d.'*') as $v) {
	if(is_dir($v) && is_file($v.'/style.css')) {
		$n = basename($v);
		echo '<option value="'.$n.'">'.$n.'</option>';
	}
}
?>
</select>
<?php tips('請上傳目錄至 ./'.$MODULE[4]['moduledir'].'/skin/ 名稱為數字、字母組合');?> <span id="dskin" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 模板目錄</td>
<td>
<select name="post[template]" id="template">
<option value="">請選擇</option>
<?php
$d = DT_ROOT.'/template/'.$CFG['template'].'/';
foreach(glob($d.'*') as $v) {
	if(is_dir($v) && is_file($v.'/side_search.htm')) {
		$n = basename($v);
		echo '<option value="'.$n.'">'.$n.'</option>';
	}
}
?>
</select>
<?php tips('請上傳目錄至 ./template/'.$CFG['template'].'/ 名稱為數字、字母組合');?> <span id="dtemplate" class="f_red"></span></td>
</tr> 
<tr>
<td class="tl"><span class="f_hid">*</span> 預覽</td>
<td id="preview"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 模板作者</td>
<td><input name="post[author]" type="text" size="20" /></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 會員組</td>
<td><?php echo group_checkbox('post[groupid][]', '6,7', '1,2,3,4');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 價格(/月)</td>
<td>
<input name="post[fee]" type="text" size="5" value="0"/>&nbsp;&nbsp;
<input type="radio" name="post[currency]" value="money" checked/> <?php echo $DT['money_name'];?>&nbsp;&nbsp;
<input type="radio" name="post[currency]" value="credit"/> <?php echo $DT['credit_name'];?> 
</td>
</tr>
<tr title="請保持時間格式">
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function Dskin(i) {
	var nopic = '<?php echo $MODULE[4]['linkurl'];?>image/nothumb.gif';
	Dd('preview').innerHTML = '<img src="<?php echo $MODULE[4]['linkurl'];?>skin/'+i+'/thumb.gif" onerror="this.src=\''+nopic+'\';"/>';
}
Dskin('?');
function check() {
	var f;
	f = 'title';
	if(Dd(f).value == '') {
		Dmsg('請填寫模板名稱', f);
		return false;
	}
	f = 'skin';
	if(Dd(f).value == '') {
		Dmsg('請選擇風格', f);
		return false;
	}
	f = 'template';
	if(Dd(f).value == '') {
		Dmsg('請選擇模板', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>