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
<input type="hidden" name="specialid" value="<?php echo $specialid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="post[specialid]" value="<?php echo $specialid;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 選擇信息源</td>
<td><select id="s_mid" onchange="if(this.value){select_item(this.value, 'special');select_op('s_mid', 0);}">
<option value="0">請選擇</option>
<?php
foreach($MODULE as $m) {
	if(!$m['islink'] && $m['moduleid'] > 3 && $m['moduleid'] != $moduleid) echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
}
?>
</select></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 所屬分類</td>
<td><?php echo type_select($tid, 0, 'post[typeid]', '請選擇分類', $typeid, 'id="typeid"');?>&nbsp;&nbsp;<a href="?file=type&item=<?php echo $tid;?>" target="_blank" class="t">[管理分類]</a> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 信息標題</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '級別', $level, 'id="level"');?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 鏈接地址</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="60" value="<?php echo $linkurl;?>"/> <br/><span id="dlinkurl" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 標題圖片</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容摘要</td>
<td>
<textarea rows="5" cols="100" name="post[introduce]" id="introduce"><?php echo $introduce;?></textarea>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>" id="addtime"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/>
</div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('標題最少2字，當前已輸入'+l+'字', f);
		return false;
	}
	f = 'linkurl';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫鏈接地址', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>