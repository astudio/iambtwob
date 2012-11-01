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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>鏈接</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 網站分類</td>
<td><?php echo type_select('link', 1, 'post[typeid]', '請選擇分類', $typeid, 'id="typeid"');?> <a href="?file=type&item=<?php echo $file;?>" class="t">[管理分類]</a> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 網站名稱</td>
<td><input name="post[title]" type="text" id="title" size="40" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '級別', $level);?> <?php echo dstyle('post[style]', $style);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 網站地址</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="40" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 網站LOGO</td>
<td><input name="post[thumb]" type="text" id="thumb" size="40" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,88,31, Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 網站介紹</td>
<td><textarea name="post[introduce]" style="width:400px;height:40px;"><?php echo $introduce;?></textarea>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 鏈接狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status==3) echo 'checked';?>/> 通過
<input type="radio" name="post[status]" value="2" <?php if($status==2) echo 'checked';?>/> 待審
</td>
</tr>
<?php if($DT['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地區(分站)</td>
<td><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'typeid';
	l = Dd(f).value;
	if(l == 0) {
		Dmsg('請選擇分類', f);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請輸入網站名稱', f);
		return false;
	}
	f = 'linkurl';
	l = Dd(f).value.length;
	if(l < 12) {
		Dmsg('請輸入網站地址', f);
		return false;
	}
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>