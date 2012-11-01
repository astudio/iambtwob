<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">模板管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件名</th>
<th width="120">模板名稱</th>
<th width="100">模板系列</th>
<th width="80">文件大小</th>
<th width="130">修改時間</th>
<th width="50">屬性</th>
<th width="110">操作</th>
</tr>
<?php foreach($dirs as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;<img src="admin/image/folder.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="?file=<?php echo $file;?>&dir=<?php echo $v['dirname'];?>" title="修改"><?php echo $v['dirname'];?></a></td>
<td><input type="text" style="width:130px;" value="<?php echo $v['name'];?>" onblur="template_name('<?php echo $v['dirname'];?>', this.value);"/></td>
<td>&lt;目錄&gt;</td>
<td>&lt;目錄&gt;</td>
<td><?php echo $v['mtime'];?></td>
<td><?php echo $v['mod'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=add&dir=<?php echo $v['dirname'];?>"><img src="admin/image/new.png" width="16" height="16" title="新建" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&dir=<?php echo $v['dirname'];?>"><img src="admin/image/edit.png" width="16" height="16" title="管理" alt=""/></a>
</td>
</tr>
<?php }?>

<?php foreach($templates as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;<a href="<?php echo $template_path.$v['filename'];?>" title="查看" target="_blank"><img src="admin/image/htm.gif" width="16" height="16" alt="" align="absmiddle"/></a> <a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>" title="修改"><?php echo $v['filename'];?></a></td>
<td><input type="text" style="width:130px;" value="<?php echo $v['name'];?>" onblur="template_name('<?php echo $v['fileid'];?>', this.value);"/></td>
<td>&nbsp;<a href="?file=<?php echo $file;?>&action=add&type=<?php echo $v['type'];?>&dir=<?php echo $dir;?>" title="新建"><?php echo $v['type'];?></a></td>
<td><?php echo $v['filesize'];?> Kb</td>
<td><?php echo $v['mtime'];?></td>
<td><?php echo $v['mod'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=add&type=<?php echo $v['type'];?>&dir=<?php echo $dir;?>"><img src="admin/image/new.png" width="16" height="16" title="新建" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>"><img src="admin/image/save.png" width="16" height="16" title="下載" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php if($baks) { ?>
<div class="tt"><? echo $dirS[$dir]['name']?>模板備份管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件名</th>
<th width="120">所屬模板</th>
<th width="100">備份編號</th>
<th width="80">文件大小</th>
<th width="130">備份時間</th>
<th width="50">屬性</th>
<th width="110">操作</th>
</tr>
<?php foreach($baks as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;<img src="admin/image/unknow.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php echo $template_path.$v['filename'];?>" title="查看" target="_blank"><?php echo $v['filename'];?></a></td>
<td>&nbsp;<?php echo $v['type'];?>.htm</td>
<td>&nbsp;<?php echo $v['number'];?></td>
<td><?php echo $v['filesize'];?> Kb</td>
<td><?php echo $v['mtime'];?></td>
<td><?php echo $v['mod'];?></td>
<td>
<a href="javascript:Dconfirm('確定要恢復<?php echo $v['fileid'];?>備份嗎？此操作將不可撤銷<br/>文件<?php echo $v['type'];?>.htm的內容將被<?php echo $v['filename'];?>覆蓋', '?file=<?php echo $file;?>&action=import&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>&dir=<?php echo $dir;?>');"><img src="admin/image/import.png" width="16" height="16" title="恢復" alt=""/></a>&nbsp;
<a href="<?php echo $template_path.$v['filename'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16" title="查看" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>&dir=<?php echo $dir;?>"><img src="admin/image/save.png" width="16" height="16" title="下載" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>&dir=<?php echo $dir;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php }?>
<script type="text/javascript">
function template_name(fileid, name) {
	makeRequest('file=<?php echo $file;?>&dir=<?php echo $dir;?>&action=template_name&fileid='+fileid+'&name='+name, '?', '_template_name');
}
function _template_name() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) showmsg('模板名修改成功');
	}
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>