<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
<div class="tt">模板添加</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;模板目錄</td>
<td><?php echo $template_path;?></td>
</tr>
<tr>
<td>&nbsp;模板名稱</td>
<td><input type="text" size="20" name="name" value="<?php if(isset($type)) echo $type;?>"/> <span class="f_gray">可以為中文</span></td>
</tr>
<tr>
<td>&nbsp;文件名</td>
<td><input type="text" size="20" name="fileid" value="<?php if(isset($type)) echo $type.'-';?>"/>.htm <span class="f_gray">只能為小寫字母、數字、中劃線、下劃線</span></td>
</tr>
<tr>
<td colspan="2">
<textarea name="content" id="content"  style="width:98%;height:300px;font-family:Fixedsys,verdana;overflow:visible;"><?php echo $content;?></textarea>
</td>
</tr>
<tr>
<td colspan="2"><input type="checkbox" name="nowrite" value="1" checked/> 如果模板已經存在,請不要覆蓋&nbsp;&nbsp;<input type="submit" name="submit" value="保 存" class="btn"/>&nbsp;&nbsp;<input type="button" value="預 覽" class="btn" onclick="Preview();"/>&nbsp;&nbsp;<input type="button" value="返 回" class="btn" onclick="window.history.go(-1);"/>&nbsp;&nbsp;<input type="reset" value="重 置" class="btn"/>&nbsp;&nbsp;<input type="button" value="縮 小" class="btn" onclick="Zoom('-');"/>&nbsp;&nbsp;<input type="button" value="放 大" class="btn" onclick="Zoom('+');"/></td>
</tr>
</table>
</form>
<br/>
<form method="post" action="?" target="_blank" id="p">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="preview"/>
<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
<input type="hidden" id="pcontent" name="content" value=""/>
</form>
<script type="text/javascript">
function Zoom(t) {
	var h = Dd('content').style.height ? Dd('content').style.height : '300px';
	var n = Number(h.replace('px', ''));
	n = t == '+' ? n+100 : n-100;
	if(n > 100) Dd('content').style.height = n+'px';
}
function Preview() {
	if(Dd('content').value == '') {
		Dtip('模板內容為空');
	} else {
		Dd('pcontent').value = Dd('content').value;
		Dd('p').submit();
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>