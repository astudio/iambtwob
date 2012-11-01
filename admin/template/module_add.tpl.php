<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">添加模塊</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 模塊類型</td>
<td><input type="radio" name="post[islink]" value="0" onclick="Dd('link0').style.display='';Dd('link1').style.display='none';" id="islink" checked/> 內置模型 <input type="radio" name="post[islink]" value="1" onclick="Dd('link0').style.display='none';Dd('link1').style.display='';"/> 外部鏈接</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 模塊名稱</td>
<td><input name="post[name]" type="text" id="name" size="10" /> <?php echo dstyle('post[style]');?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 導航菜單</td>
<td><input type="radio" name="post[ismenu]" value="1" checked/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[ismenu]" value="0" /> 否</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 新窗口打開</td>
<td><input type="radio" name="post[isblank]" value="1"/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[isblank]" value="0" checked /> 否</td>
</tr>
<tbody id="link1" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> 鏈接地址</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="40" /> <span id="dlinkurl" class="f_red"></span></td>
</tr>
</tbody>
<tbody id="link0" style="display:;">
<tr>
<td class="tl"><span class="f_red">*</span> 所屬模型</td>
<td><?php echo $module_select;?> <span id="dmodule" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 安裝目錄</td>
<td><input name="post[moduledir]" type="text" id="moduledir" size="30" /> <input type="button" class="btn" value="目錄檢測" onclick="ckDir();"><?php tips('限英文、數字、中劃線、下劃線');?> <span id="dmoduledir" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 綁定域名</td>
<td><input name="post[domain]" type="text" id="domain" size="30" /><?php tips('例如http://sell.destoon.com/,以 / 結尾<br/>如果不綁定請勿填寫');?></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="確 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"></div>
</form>
<script type="text/javascript">
function ckDir() {
	if(Dd('moduledir').value == '') {
		Dalert('請填寫安裝目錄');
		Dd('moduledir').focus();
		return false;
	}
	var url = '?file=module&action=ckdir&moduledir='+Dd('moduledir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	var l;
	var f;
	f = 'name';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('請填寫模塊名稱', f);
		return false;
	}
	if(Dd('islink').checked) {
		f = 'module';
		l = Dd(f).value;
		if(l == 0) {
			Dmsg('請選擇所屬模型', f);
			return false;
		}
		f = 'moduledir';
		l = Dd(f).value;
		if(l == '') {
			Dmsg('請填寫安裝目錄', f);
			return false;
		}
	} else {
		f = 'linkurl';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('請填寫鏈接地址', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>