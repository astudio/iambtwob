<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">廣告位搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $type_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
寬度：<input type="text" size="3" name="width" value="<?php echo $width;?>"/>&nbsp;
高度：<input type="text" size="3" name="height" value="<?php echo $height;?>"/>&nbsp;
<select name="open">
<option value="-1"<?php if($open == -1) echo ' selected';?>>前台</option>
<option value="1"<?php if($open == 1) echo ' selected';?>>顯示</option>
<option value="0"<?php if($open == 0) echo ' selected';?>>隱藏</option>
</select>&nbsp;
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>示意圖&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">管理廣告位</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="40">排序</th>
<th>ID</th>
<th>廣告類型</th>
<th width="15"></th>
<th>廣告位名稱</th>
<th>規格(px)</th>
<th title="(<?php echo $DT['money_unit'];?>/月)">價格</th>
<th>廣告</th>
<th>HTML調用代碼</th>
<th>JS調用代碼</th>
<th>操作</th>
</tr>
<?php foreach($places as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" name="編輯:<?php echo $v['editor'];?>&#10;更新時間:<?php echo $v['editdate'];?>">
<td><input type="checkbox" name="pids[]" value="<?php echo $v['pid'];?>"/></td>
<td><input type="text" size="2" name="listorder[<?php echo $v['pid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['pid'];?></td>
<td><a href="<?php echo $v['typeurl'];?>" target="_blank"><?php echo $v['typename'];?></td>
<td><?php if($v['thumb']) {?> <a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="admin/image/img.gif" width="10" height="10" title="廣告位示意圖,點擊查看" alt=""/></a><?php } ?></td>
<td align="left" title="添加時間:<?php echo $v['adddate'];?>&#10;編輯:<?php echo $v['editor'];?>&#10;上次修改:<?php echo $v['editdate'];?>"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list&pid=<?php echo $v['pid'];?>"><?php echo $v['name'];?></td>
<td><?php echo $v['width'];?> x <?php echo $v['height'];?></td>
<td><?php echo $v['price'] ? $v['price'].$unit : '面議';?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list&pid=<?php echo $v['pid'];?>"><?php echo $v['ads'];?></a></td>
<td><input type="text" size="12" <?php if($v['typeid'] == 6 || $v['typeid'] == 7) { ?>value="{ad($moduleid,$catid,$kw,<?php echo $v['typeid'];?>)}"<?php } else { ?>value="{ad(<?php echo $v['pid'];?>)}"<?php } ?> onmouseover="this.select();"/></td>
<td><input type="text" size="12" <?php if($v['typeid'] > 1 && $v['typeid'] < 6) { ?>value="<script type=&quot;text/javascript&quot; src=&quot;{DT_PATH}file/script/A<?php echo $v['pid'];?>.js&quot;></script>"<?php } else { ?>value="不支持" disabled<?php } ?> onmouseover="this.select();"/></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=add&pid=<?php echo $v['pid'];?>"><img src="admin/image/new.png" width="16" height="16" title="向此廣告位添加廣告" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list&pid=<?php echo $v['pid'];?>"><img src="admin/image/child.png" width="16" height="16" title="此廣告位廣告列表" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list&job=check&pid=<?php echo $v['pid'];?>"><img src="admin/image/import.png" width="16" height="16" title="此廣告位廣告待審核列表" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=view&pid=<?php echo $v['pid'];?>" target="_blank"/><img src="admin/image/view.png" width="16" height="16" title="預覽此廣告位" alt=""></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit_place&pid=<?php echo $v['pid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改此廣告位" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete_place&pids=<?php echo $v['pid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除此廣告位" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order_place';"/>&nbsp;
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中廣告位嗎？\n\n廣告位下的所有廣告也將被刪除\n\n此操作不可撤銷\n\n強烈建議不要刪除系統自帶的廣告位')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete_place'}else{return false;}"/>&nbsp;&nbsp;&nbsp;
提示：系統會定期自動更新廣告，如果需要立即看到效果，請點更新廣告。如果啟用了城市分站，請不要使用JS調用廣告
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>