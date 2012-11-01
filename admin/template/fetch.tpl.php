<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">規則搜索</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="60" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">采編規則</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>域名</th>
<th>編碼</th>
<th>網站</th>
<th width="150">修改時間</th>
<th width="60">管理</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" type="checkbox" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['domain'];?></td>
<td><?php echo $v['encode'];?></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=http://<?php echo $v['domain'];?>" target="_blank"><?php echo $v['sitename'];?></a></td>
<td class="px11" title="<?php echo $v['editor'];?>"><?php echo $v['edittime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value="批量刪除" class="btn" onclick="if(confirm('確定要刪除選中規則嗎？此操作將不可撤銷')){this.form.action='?file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>