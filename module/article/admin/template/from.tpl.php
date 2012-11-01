<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
?>
<form action="?">
<div class="tt">來源搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<input type="text" size="60" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>&nbsp;
<input type="button" value="關 閉" class="btn" onclick="parent.cDialog();"/>
</td>
</tr>
</table>
</form>
<div class="tt">來源列表</div>
<table cellpadding="3" cellspacing="1" class="tb">
<tr>
<th>來源</th>
<th>網址</th>
<th width="40">選擇</th>
</tr> 
<?php foreach($lists as $k=>$v) { ?>
<tr>
<td>&nbsp;<a href="javascript:TopUseBack('<?php echo $v['copyfrom'];?>','<?php echo $v['fromurl'];?>');"><?php echo $v['copyfrom'];?></a></td>
<td>&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=<?php echo urlencode(fix_link($v['fromurl']));?>" target="_blank"><?php echo $v['fromurl'];?></a></td>
<td align="center"><a href="javascript:TopUseBack('<?php echo $v['copyfrom'];?>','<?php echo $v['fromurl'];?>');" class="t">[選擇]</a></td>
</tr>
<?php } ?>
</table>
<script type="text/javascript">
function TopUseBack(v, u) {
	parent.Dd('copyfrom').value = v;
	parent.Dd('fromurl').value = u;
	parent.cDialog();
}
</script>
<?php include tpl('footer');?>