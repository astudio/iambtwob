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
<div class="tt">修改地址 </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 會員名</td>
<td class="tr"><input type="text" size="20" name="post[username]" id="username" value="<?php echo $username;?>"/> <a href="javascript:_user(Dd('username').value);" class="t">[資料]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 詳細地址</td>
<td class="tr"><input name="post[address]" type="text" id="title" size="60" value="<?php echo $address;?>"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 郵政編碼</td>
<td class="tr"><input name="post[postcode]" type="text" id="postcode" size="10" value="<?php echo $postcode;?>" /> <span id="dpostcode" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 真實姓名</td>
<td class="tr"><input name="post[truename]" type="text" id="truename" size="10" value="<?php echo $truename;?>"/> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 手機號碼</td>
<td class="tr"><input name="post[mobile]" type="text" id="mobile" size="20" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 電話號碼</td>
<td class="tr"><input name="post[telephone]" type="text" id="telephone" size="20" value="<?php echo $telephone;?>"/> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 顯示順序</td>
<td class="tr f_gray"><input name="post[listorder]" type="text" id="listorder" size="4" value="<?php echo $listorder;?>"/> 數字越小越靠前<span id="dlistorder" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 備註信息</td>
<td class="tr"><input type="text" size="60" name="post[note]" id="note" value="<?php echo $note;?>"/> <span id="dnote" class="f_red"></span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫會員名', f);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 5) {
		Dmsg('請填寫詳細地址', f);
		return false;
	}
	f = 'postcode';
	l = Dd(f).value.length;
	if(l < 6) {
		Dmsg('請填寫郵政編碼', f);
		return false;
	}
	f = 'truename';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫真實姓名', f);
		return false;
	}
	f = 'mobile';
	l = Dd(f).value.length;
	if(l < 11) {
		Dmsg('請填寫手機號碼', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>