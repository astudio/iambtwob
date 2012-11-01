<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">風格文件管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件名</th>
<th width="180">文件大小</th>
<th width="180">修改時間</th>
<th width="150">操作</th>
</tr>
<?php foreach($skins as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';">

<td>&nbsp;<a href="<?php echo $skin_path.$v['filename'];?>" title="查看" target="_blank"><img src="admin/image/css.gif" width="16" height="16" alt="" align="absmiddle"/></a> <a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>" title="修改"><?php echo $v['filename'];?></a></td>

<td align="center"><?php echo $v['filesize'];?> Kb</td>

<td align="center"><?php echo $v['mtime'];?></td>

<td align="center">
<a href="?file=<?php echo $file;?>&action=add"><img src="admin/image/new.png" width="16" height="16" title="新建" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['fileid'];?>"><img src="admin/image/save.png" width="16" height="16" title="下載" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['fileid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>

</tr>
<?php }?>
</table>
<?php if($baks) { ?>
<div class="tt">風格備份管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件名</th>
<th width="180">文件大小</th>
<th width="180">備份時間</th>
<th width="150">操作</th>
</tr>
<?php foreach($baks as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';">

<td>&nbsp;<img src="admin/image/unknow.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php echo $skin_path.$v['filename'];?>" title="查看" target="_blank"><?php echo $v['filename'];?></a></td>

<td align="center"><?php echo $v['filesize'];?> Kb</td>

<td align="center"><?php echo $v['mtime'];?></td>

<td align="center">
<a href="javascript:Dconfirm('確定要恢復<?php echo $v['fileid'];?>備份嗎？此操作將不可撤銷<br/>文件<?php echo $v['type'];?>.css的內容將被<?php echo $v['filename'];?>覆蓋', '?file=<?php echo $file;?>&action=import&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>');"><img src="admin/image/import.png" width="16" height="16" title="恢復" alt=""/></a>&nbsp;
<a href="<?php echo $skin_path.$v['filename'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16" title="查看" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>"><img src="admin/image/save.png" width="16" height="16" title="下載" alt=""/></a>&nbsp;
<a href="javascript:Dconfirm('確定要刪除<?php echo $v['filename'];?>備份嗎？此操作不可撤銷', '?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>');"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php }?>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>