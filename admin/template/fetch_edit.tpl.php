<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">添加規則</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 采編域名</td>
<td><input name="domain" type="text" id="domain" size="50" value="<?php echo $domain;?>"/>
<span id="ddomain" class="f_red"></span><br/>
不帶http及目錄，例如 bbs.destoon.com
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 網站名稱</td>
<td><input name="sitename" type="text" id="sitename" size="50" value="<?php echo $sitename;?>"/><span id="dsitename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 標題過濾</td>
<td><input name="title" type="text" id="title" size="50" value="<?php echo $title;?>"/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 內容規則</td>
<td><textarea name="content" rows="6" cols="50" id="content"><?php echo $content;?></textarea>
<span id="dcontent" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 內容編碼</td>
<td>
<input type="radio" name="encode" value="gbk"<?php echo $encode == 'gbk' ? ' checked' : '';?>/> GBK&nbsp;&nbsp;
<input type="radio" name="encode" value="utf-8"<?php echo $encode == 'utf-8' ? ' checked' : '';?>/> UTF-8
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('domain').value.length < 5) {
		Dmsg('請填寫域名', 'domain');
		return false;
	}
	if(Dd('content').value.length < 10) {
		Dmsg('請填寫內容規則', 'content');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>