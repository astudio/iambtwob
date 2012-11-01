<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="backup" value="1"/>
<div class="tt">DESTOON系統表[共<?php echo $dtotalsize;?>M,<?php echo count($dtables);?>個表]</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>表 名</th>
<th width="100">表註釋</th>
<th width="70">記錄數</th>
<th width="200" colspan="2">大小(M)</th>
<th width="50">碎片</th>
<th width="150">操 作</th>
</tr>
<?php foreach($dtables as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td>
<input type="checkbox" name="tables[]" value="<?php echo $v['name'];?>" checked/>
<input type="hidden" name="sizes[<?php echo $v['name'];?>]" value="<?php echo $v['tsize'];?>"/>
</td>
<td align="left">&nbsp;<?php echo $v['name'];?></td>
<td><a href="?file=<?php echo $file;?>&action=comment&table=<?php echo $v['name'];?>&note=<?php echo urlencode($v['note']);?>" title="點擊修改表註釋"><?php echo $v['note'] ? $v['note'] : '--';?></a></td>
<td class="px11"><?php echo $v['rows'];?></td>
<td><script type="text/javascript">perc(<?php echo $v['tsize'];?>,<?php echo $dtotalsize;?>,'100px');</script></td>
<td class="px11" title="數據:<?php echo $v['size'];?> 索引:<?php echo $v['index'];?>"><?php echo $v['tsize'];?></td>
<td class="px11"><?php echo $v['chip'];?></td>
<td><a href="?file=<?php echo $file;?>&action=optimize&tables=<?php echo $v['name'];?>">優化</a> | <a href="?file=<?php echo $file;?>&action=repair&tables=<?php echo $v['name'];?>">修復</a> | <a href="?file=<?php echo $file;?>&action=export&table=<?php echo $v['name'];?>">下載</a> | <a href="###" onclick="Dict('<?php echo $v['name'];?>','<?php echo urlencode($v['note']);?>');">字典</a></td>
</tr>
<?php }?>
</table>
<?php if($tables) {?>
<div class="tt">其他系統表[共<?php echo $totalsize;?>M,<?php echo count($tables);?>個表]</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25">-</th>
<th>表 名</th>
<th width="100">表註釋</th>
<th width="70">記錄數</th>
<th width="200" colspan="2">大小(M)</th>
<th width="50">碎片</th>
<th width="150">操 作</th>
</tr>
<?php foreach($tables as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td>
<input type="checkbox" name="tables[]" value="<?php echo $v['name'];?>"/>
<input type="hidden" name="sizes[<?php echo $v['name'];?>]" value="<?php echo $v['tsize'];?>"/>
</td>
<td align="left">&nbsp;<?php echo $v['name'];?></td>
<td><a href="?file=<?php echo $file;?>&action=comment&table=<?php echo $v['name'];?>&note=<?php echo urlencode($v['note']);?>" title="點擊修改表註釋"><?php echo $v['note'] ? $v['note'] : '--';?></a></td>
<td class="px11"><?php echo $v['rows'];?></td>
<td><script type="text/javascript">perc(<?php echo $v['tsize'];?>,<?php echo $totalsize;?>,'100px');</script></td>
<td class="px11" title="數據:<?php echo $v['size'];?> 索引:<?php echo $v['index'];?>"><?php echo $v['tsize'];?></td>
<td class="px11"><?php echo $v['chip'];?></td>
<td><a href="?file=<?php echo $file;?>&action=optimize&tables=<?php echo $v['name'];?>">優化</a> | <a href="?file=<?php echo $file;?>&action=repair&tables=<?php echo $v['name'];?>">修復</a> | <a href="?file=<?php echo $file;?>&action=export&table=<?php echo $v['name'];?>">下載</a> | <a href="###" onclick="Dict('<?php echo $v['name'];?>','<?php echo urlencode($v['note']);?>');">字典</a></td>
</tr>
<?php }?>
</table>
<?php } ?>
<div class="tt">備份選中表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="120">&nbsp;&nbsp;&nbsp;分卷文件大小</td>
<td>
<span class="f_r">
<a href="javascript:" onclick="checkall(Dd('dform'), 1);" class="t">反選</a>&nbsp;&nbsp;
<a href="javascript:" onclick="checkall(Dd('dform'), 2);" class="t">全選</a>&nbsp;&nbsp;
<a href="javascript:" onclick="checkall(Dd('dform'), 3);" class="t">全不選</a>&nbsp;&nbsp;
</span>
&nbsp;<input type="text" name="sizelimit" value="2048" size="5"/> K</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;建表語句格式</td>
<td>&nbsp;<input type="radio" name="sqlcompat" value="" checked="checked"/> 默認 &nbsp; <input type="radio" name="sqlcompat" value="MYSQL40"/> MySQL 3.23/4.0.x &nbsp; <input type="radio" name="sqlcompat" value="MYSQL41"/> MySQL 4.1.x/5.x &nbsp;</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;強制字符集</td>
<td>&nbsp;<input type="radio" name="sqlcharset" value="" checked/> 默認 &nbsp; <input type="radio" name="sqlcharset" value="utf8"/> UTF-8 &nbsp; <input type="radio" name="sqlcharset" value="gbk"/> GBK &nbsp; <input type="radio" name="sqlcharset" value="latin1"/> LATIN1</td>
</tr>
</table>
<div class="btns">
<input type="submit" name="submit" value="開始備份" class="btn"/>&nbsp;
<input type="submit" value="優化表" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&action=optimize';"/>&nbsp;
<input type="submit" value="修復表" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&action=repair';"/>&nbsp;
<input type="submit" value="重建註釋" class="btn" onclick="if(confirm('確定要重建表註釋嗎？')){this.form.action='?file=<?php echo $file;?>&action=comments';}else{return false;}"/>&nbsp;
<input type="submit" value="刪除表" class="btn" onclick="if(confirm('警告！確定要刪除中表嗎？此操作將不可恢復\n\n為了系統安全，系統僅刪除非Destoon系統表')){this.form.action='?file=<?php echo $file;?>&action=drop';}else{return false;}"/>
</div>
</form>
<br/>
<script type="text/javascript">
function Dict(t, n) {
	mkDialog('', '<iframe src="?file=tag&action=dict&table='+t+'&note='+n+'" width="600" height=300" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '數據字典', 620, 0, 0);
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>