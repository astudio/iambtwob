<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">注意事項</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;&nbsp;&nbsp;1、如果進行了<span class="f_red">修改</span>或<span class="f_red">刪除</span>分類操作，為了保證操作速度，系統不自動修復結構。請在<span class="f_red">管理完成</span>或<span class="f_red">操作失敗</span>時，點更新緩存以修復分類結構至最新。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;2、刪除分類不會刪除分類下的文章或信息，請在刪除分類之前手動批量刪除。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;3、修改上級ID可以快速修改分類的上級分類，改變分類結構。</td>
</tr>
</table>
<div class="tt"><?php if($parentid) echo $CATEGORY[$parentid]['catname'];?>分類管理</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>排序</th>
<th>ID</th>
<th>上級ID</th>
<th>分類名</th>
<th>分類目錄</th>
<th>索引</th>
<th>級別</th>
<th colspan="2">信息數量</th>
<th>子類</th>
<th>屬性</th>
<th width="80">操作</th>
</tr>
<?php foreach($DTCAT as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="catids[]" value="<?php echo $v['catid'];?>"/></td>
<td><input name="category[<?php echo $v['catid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td>&nbsp;<a href="<?php echo $MODULE[$mid]['linkurl'].$v['linkurl'];?>" target="_blank"><?php echo $v['catid'];?></a>&nbsp;</td>
<td><input name="category[<?php echo $v['catid'];?>][parentid]" type="text" size="5" value="<?php echo $v['parentid'];?>"/></td>
<td>
<input name="category[<?php echo $v['catid'];?>][catname]" type="text" value="<?php echo $v['catname'];?>" style="width:100px;color:<?php echo $v['style'];?>"/>
<?php echo dstyle('category['.$v['catid'].'][style]', $v['style']);?>
</td>
<td><input name="category[<?php echo $v['catid'];?>][catdir]" type="text" value="<?php echo $v['catdir'];?>" size="10"/></td>
<td>
<input name="category[<?php echo $v['catid'];?>][letter]" type="text" value="<?php echo $v['letter'];?>" size="1"/>
</td>
<td>
<input name="category[<?php echo $v['catid'];?>][level]" type="text" value="<?php echo $v['level'];?>" size="1"/>
</td>
<td><script type="text/javascript">perc(<?php echo $v['item'];?>,<?php echo $total;?>,'80px');</script></td>
<td><?php echo $v['item'];?></td>
<td title="管理子分類"><a href="?file=<?php echo $file;?>&mid=<?php echo $mid;?>&parentid=<?php echo $v['catid'];?>"><?php echo $v['childs'];?></a></td>
<td title="管理屬性"><a href="###" onclick="Dwindow('?file=property&catid=<?php echo $v['catid'];?>', '[<?php echo $v['catname'];?>]擴展屬性');"><?php echo $v['property'];?></a></td>
<td>
<a href="?file=<?php echo $file;?>&action=add&mid=<?php echo $mid;?>&parentid=<?php echo $v['catid'];?>"><img src="admin/image/add.png" width="16" height="16" title="添加子分類" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=edit&mid=<?php echo $mid;?>&catid=<?php echo $v['catid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&mid=<?php echo $mid;?>&catid=<?php echo $v['catid'];?>&parentid=<?php echo $parentid;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<span class="f_r">
分類總數:<strong class="f_red"><?php echo count($CATEGORY);?></strong>&nbsp;&nbsp;
當前目錄:<strong class="f_blue"><?php echo count($DTCAT);?></strong>&nbsp;&nbsp;
</span>
<input type="submit" name="submit" value="更新分類" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=update'"/>&nbsp;
<input type="submit" value="刪除選中" class="btn" onclick="if(confirm('確定要刪除選中分類嗎？此操作將不可撤銷')){this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=delete'}else{return false;}"/>
<?php if($parentid) {?>&nbsp;
<input type="button" value="上級分類" class="btn" onclick="window.location='?file=<?php echo $file;?>&mid=<?php echo $mid;?>&parentid=<?php echo $CATEGORY[$parentid]['parentid'];?>';"/>
<?php }?>
</div>
</form>
<form method="post" action="?">
<div class="tt">快捷操作</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr align="center">
<td>
<div style="float:left;padding:10px;">
<?php echo category_select('cid', '分類結構', $parentid, $mid, 'size="2" style="width:200px;height:130px;"');?></div>
<div style="float:left;padding:10px;">
	<table>
	<tr>
	<td><input type="submit" value="管理分類" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&parentid='+Dd('catid_1').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="添加分類" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&action=add&parentid='+Dd('catid_1').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="修改分類" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&action=edit&catid='+Dd('catid_1').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="刪除分類" class="btn" onclick="if(confirm('確定要刪除選中分類嗎？此操作將不可撤銷')){this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&action=delete&catid='+Dd('catid_1').value;}else{return false;}"/></td>
	</tr>
	</table>
</div>
</td>
</tr>
</table>
</div>
</form>
<br/>
<br/>
<br/>
<script type="text/javascript">
function Prop(t, n) {
	mkDialog('', '<iframe src="?file=property&catid='+n+'" width="700" height=300" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '['+t+']擴展屬性', 720, 0, 0);
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>