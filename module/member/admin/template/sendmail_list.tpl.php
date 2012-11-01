<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">郵件列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件</th>
<th>文件大小(Kb)</th>
<th>記錄數</th>
<th width="150">獲取時間</th>
<th width="50">操作</th>
</tr>
<?php foreach($mails as $k=>$v) {?>
<tr align="center">
<td align="left">&nbsp;&nbsp;<a href="<?php DT_PATH;?>file/email/<?php echo $v['filename'];?>" title="點鼠標右鍵另存為保存此文件" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td><?php echo $v['count'];?></td>
<td><?php echo $v['mtime'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=download&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="下載" alt=""/></a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&filenames=<?php echo $v['filename'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<table cellpadding="2" cellspacing="1" width="100%" bgcolor="#F1F2F3">
<tr>
<td height="50">
<form method="post" action="?" enctype="multipart/form-data">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="upload"/>
<td title="上傳成功後文件將自動在文件列表中顯示">
<input name="uploadfile" type="file" size="25"/>
<input type="submit" name="submit" value=" 上 傳 " class="btn"/>&nbsp;
</form>
</td>
</tr>
</table>
<br/>
<br/>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>