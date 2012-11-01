<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">創建新組</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 新組名稱</td>
<td><input name="name" type="text" size="20" value="<?php echo $name;?>"/> <span class="f_gray">中文名稱，例如 關於我們</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 新組標識</td>
<td><input name="item" type="text" size="20" value="<?php echo $item;?>"/> <span class="f_gray">數字和字母組合，例如 aboutus</span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>