<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">修改模塊</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="edit"/>
<input type="hidden" name="modid" value="<?php echo $modid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 模塊類型</td>
<td class="f_red"><?php echo $islink ? '外部鏈接' : '內置模型('.$modulename.$module.')'?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 模塊名稱</td>
<td><input name="post[name]" type="text" id="name" size="10" value="<?php echo $name;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 導航菜單</td>
<td><input type="radio" name="post[ismenu]" value="1"  <?php if($ismenu) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[ismenu]" value="0"  <?php if(!$ismenu) echo 'checked';?>/> 否</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 新窗口打開</td>
<td><input type="radio" name="post[isblank]" value="1"  <?php if($isblank) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[isblank]" value="0"  <?php if(!$isblank) echo 'checked';?>/> 否</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 獨立LOGO</td>
<td><input type="radio" name="post[logo]" value="1"  <?php if($logo) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[logo]" value="0"  <?php if(!$logo) echo 'checked';?>/> 否 <?php tips('如果選擇是，請將LOGO圖片命名為logo_'.$modid.'.gif<br/>上傳至skin/'.$CFG['skin'].'/image/目錄');?></td>
</tr>
<?php if($islink) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 鏈接地址</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="40" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 安裝目錄</td>
<td><input name="post[moduledir]" type="text" id="moduledir" size="30"  value="<?php echo $moduledir;?>"/> <input type="button" class="btn" value="目錄檢測" onclick="ckDir();"><?php tips('限英文、數字、中劃線、下劃線');?> <span id="dmoduledir" class="f_red"></span>
<br/>提示:如果不是十分必要，建議不要頻繁更改安裝目錄
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 綁定域名</td>
<td><input name="post[domain]" type="text" id="domain" size="30"  value="<?php echo $domain;?>"/><?php tips('例如http://sell.destoon.com/,以 / 結尾<br/>如果不綁定請勿填寫');?></td>
</tr>
<?php } ?>
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
<?php if($islink) { ?>
	f = 'linkurl';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫鏈接地址', f);
		return false;
	}
<?php } else { ?>
	f = 'moduledir';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('請填寫安裝目錄', f);
		return false;
	}
<?php } ?>
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>