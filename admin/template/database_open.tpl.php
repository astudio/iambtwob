<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">備份系列 <?php echo $dir;?> 共<?php echo $tid;?>個分卷</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件名稱</th>
<th width="150">文件大小(M)</th>
<th width="200">修改時間</th>
<th width="100">分卷</th>
<th width="100">操作</th>
</tr>
<?php
for($i = 1; $i <= $tid; $i++) {
	$v = $sqls[$i];
?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td align="left">&nbsp;<img src="admin/image/sql.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php DT_PATH;?>file/backup/<?php echo $dir;?>/<?php echo $v['filename'];?>" title="點鼠標右鍵另存為保存此文件" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td title="備份時間:<?php echo $v['btime'];?>"><?php echo $v['mtime'];?></td>
<td><?php echo $v['number'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=import&filepre=<?php echo $v['pre'];?>&tid=<?php echo $tid;?>&import=1" onclick="return confirm('確定要導入此系列文件嗎？現有數據將被覆蓋，此操作將不可恢復');"><img src="admin/image/import.png" width="16" height="16" title="導入本系列備份文件" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=download&dir=<?php echo $dir;?>&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="下載" alt=""/></a></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>