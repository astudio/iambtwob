<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">生成充值卡</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 面額</td>
<td><input name="amount" id="amount" type="text" size="10" value="100"/> <span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 卡號前綴 </td>
<td><input name="prefix" id="prefix" type="text" size="20" value="<?php echo $prefix;?>"/> <a href="javascript:" onclick="window.location.reload();" class="t">[刷新]</a> <span id="dprefix" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 卡號組成</td>
<td><input name="number_part" id="number_part" type="text" size="50" value="0123456789"/>
<select onchange="Dd('number_part').value=this.value">
<option value="0123456789">數字</option>
<option value="abcdefghijklmnopqrstuvwxyz">小寫字母</option>
<option value="ABCDEFGHIJKLMNOPQRSTUVWXYZ">大寫字母</option>
<option value="0123456789abcdefghijklmnopqrstuvwxyz">數字和小寫字母</option>
<option value="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ">數字和大寫字母</option>
</select>
<span id="dnumber_part" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 卡號長度</td>
<td><input name="number_length" id="number_length" type="text" size="20" value="10"/> 推薦8-15位之間 <span id="dnumber_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 密碼長度</td>
<td><input name="password_length" id="password_length" type="text" size="20" value="8"/> 6位以上 <span id="dpassword_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 有效期至</td>
<td><?php echo dcalendar('totime', $totime);?>  <span id="dtotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 生成數量</td>
<td><input name="total" id="total" type="text" size="10" value="100"/> <span id="dtotal" class="f_red"></span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	return confirm('確定要生成嗎？');
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>