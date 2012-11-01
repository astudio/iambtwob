<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<div class="tt">分類複製</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 來源模塊</td>
<td>
<select name="fromid" id="fromid">
<option value="0">請選擇</option>
<?php
foreach($MODULE as $m) {
	if($m['moduleid'] < 4 || $m['moduleid'] == $mid || $m['islink']) continue;
	echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
}
?>
</select>
<span id="dfromid" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 當前模塊分類數據</td>
<td>
<input type="radio" name="save" value="1" checked/> 保留
<input type="radio" name="save" value="0"/> 刪除
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="復 制" class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('fromid').value==0) {
		Dmsg('請選擇來源模塊', 'fromid');
		return false;
	}
	return confirm('此操作不可撤銷，確定要執行嗎？');
}
</script>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>