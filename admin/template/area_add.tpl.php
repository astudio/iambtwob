<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">地區添加</div>
<form method="post" action="?" onsubmit="return Dcheck();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="area[parentid]" value="<?php echo $parentid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($parentid) {?>
<tr>
<td class="tl"><span class="f_hid">*</span> 上級地區</td>
<td><?php echo $AREA[$parentid]['areaname'];?></td>
</tr>
<?php }?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地區名稱</td>
<td><textarea name="area[areaname]"  id="areaname" style="width:200px;height:100px;overflow:visible;"></textarea><?php tips('允許批量添加，一行一個，點回車換行');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="確 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"></div>
</form>
<script type="text/javascript">
function Dcheck() {
	if(Dd('areaname').value == '') {
		Dtip('請填寫地區名稱。允許批量添加，一行一個，點回車換行');
		Dd('areaname').focus();
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>