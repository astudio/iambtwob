<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($submit) { ?>

<div class="tt">校驗結果</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>文件</th>
<th>大小</th>
<th>修改時間</th>
</tr>
	<?php foreach($lists as $f) { ?>
	<tr align="center">
	<td align="left">&nbsp;<img src="admin/image/notice.gif" alt="" align="absmiddle"/> <a href="<?php echo $f;?>" target="_blank" class="f_fd"> <?php echo $f;?></a></td>
	<td class="px11"><?php echo dround(filesize(DT_ROOT.'/'.$f)/1024);?> Kb</td>
	<td class="px11"><?php echo timetodate(filemtime(DT_ROOT.'/'.$f), 6);?></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="3" height="30" class="f_blue">&nbsp;&nbsp;&nbsp;&nbsp;- 以上文件曾被修改或創建，請下載手動檢查文件內容是否安全</td>
	</tr>
<?php } else { ?>
<tr>
<td class="f_green" height="40">&nbsp;- 沒有文件被修改或創建&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[重新校驗]</a></td>
</tr>
<?php } ?>
</table>

<?php } else { ?>
<form method="post">
<div class="tt">文件校驗</div>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;選擇目錄</td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="filedir[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?><?php echo in_array($d, $fbs) ? ' disabled' : '';?> id="cdir_<?php echo $d;?>"/><label for="cdir_<?php echo $d;?>">&nbsp;<img src="admin/image/folder.gif" width="16" height="16" alt="" align="absmiddle"/> <?php echo $d;?></label></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;文件類型</td>
<td>&nbsp;<input type="text" size="40" name="fileext" value="php|js|htm" class="f_fd"/></td>
</tr>
<tr>
<td>&nbsp;鏡像文件</td>
<td>&nbsp;<select name="mirror" id="mirror">
<option value="">系統默認</option>
<?php 
	foreach($mfiles as $f) {
	$n = basename($f, '.php');
	if(strlen($n) < 16) continue;
?>
<option value="<?php echo $n;?>"><?php echo $n.' '.dround(filesize($f)/1024, 2);?> K</option>
<?php } ?>
</select>
&nbsp;<input type="submit" name="submit" value="開始校驗" class="btn" onclick="this.form.action='?file=<?php echo $file;?>';this.value='校驗中..';this.blur();this.className='btn f_gray';"/>
&nbsp;<input type="submit" name="submit" value="刪除鏡像" class="btn" onclick="if(Dd('mirror').value==''){alert('請選擇需要刪除的鏡像文件');Dd('mirror').focus();return false;}if(confirm('確定要刪除嗎？此操作將不可恢復')){this.form.action='?file=<?php echo $file;?>&action=delete';}else{return false;}"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<div class="tt">創建鏡像</div>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;選擇目錄</td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="filedir[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?><?php echo in_array($d, $fbs) ? ' disabled' : '';?> id="adir_<?php echo $d;?>"/><label for="adir_<?php echo $d;?>">&nbsp;<img src="admin/image/folder.gif" width="16" height="16" alt="" align="absmiddle"/> <?php echo $d;?></label></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;文件類型</td>
<td>&nbsp;<input type="text" size="40" name="fileext" value="php|js|htm" class="f_fd"/></td>
</tr>
<tr>
<td></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="創建鏡像" class="btn" onclick="this.value='創建中..';this.blur();this.className='btn f_gray';"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>