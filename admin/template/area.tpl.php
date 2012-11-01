<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt"><?php if($parentid) echo $AREA[$parentid]['areaname'];?>地區管理</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="100">排序</th>
<th width="100">ID</th>
<th>上級ID</th>
<th>地區名</th>
<th width="80">子地區</th>
<th width="120">操作</th>
</tr>
<?php foreach($DAREA as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="areaids[]" value="<?php echo $v['areaid'];?>"/></td>
<td><input name="area[<?php echo $v['areaid'];?>][listorder]" type="text" size="5" value="<?php echo $v['listorder'];?>"/></td>
<td>&nbsp;<?php echo $v['areaid'];?></td>
<td><input name="area[<?php echo $v['areaid'];?>][parentid]" type="text" size="10" value="<?php echo $v['parentid'];?>"/></td>
<td><input name="area[<?php echo $v['areaid'];?>][areaname]" type="text" size="20" value="<?php echo $v['areaname'];?>"/></td>
<td>&nbsp;<a href="?file=<?php echo $file;?>&parentid=<?php echo $v['areaid'];?>"><?php echo $v['childs'];?></a></td>
<td>
<a href="?file=<?php echo $file;?>&parentid=<?php echo $v['areaid'];?>"><img src="admin/image/child.png" width="16" height="16" title="管理子地區，當前有<?php echo $v['childs'];?>個子地區" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=add&parentid=<?php echo $v['areaid'];?>"><img src="admin/image/new.png" width="16" height="16" title="添加子地區" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&areaid=<?php echo $v['areaid'];?>&parentid=<?php echo $parentid;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<span class="f_r">
地區總數:<strong class="f_red"><?php echo count($AREA);?></strong>&nbsp;&nbsp;
當前目錄:<strong class="f_blue"><?php echo count($DAREA);?></strong>&nbsp;&nbsp;
</span>
<input type="submit" name="submit" value="更新地區" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=update'"/>&nbsp;&nbsp;
<input type="submit" value="刪除選中" class="btn" onclick="if(confirm('確定要刪除選中地區嗎？此操作將不可撤銷')){this.form.action='?file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=delete'}else{return false;}"/>&nbsp;&nbsp;
<?php if($parentid) {?>
<input type="button" value="上級地區" class="btn" onclick="window.location='?file=<?php echo $file;?>&parentid=<?php echo $AREA[$parentid]['parentid'];?>';"/>
<?php }?>
</div>
</form>
<form method="post" action="?">
<div class="tt">快捷操作</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr align="center">
<td>
<div style="float:left;padding:10px;">
<?php echo ajax_area_select('aid', '地區結構', $parentid, 'size="2" style="width:200px;height:130px;" id="aid"');?></div>
<div style="float:left;padding:10px;">
	<table>
	<tr>
	<td><input type="submit" value="管理地區" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&parentid='+Dd('aid').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="添加地區" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&action=add&parentid='+Dd('aid').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="刪除地區" class="btn" onclick="if(confirm('確定要刪除選中地區嗎？此操作將不可撤銷')){this.form.action='?file=<?php echo $file;?>&action=delete&areaid='+Dd('aid').value;}else{return false;}"/></td>
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
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>