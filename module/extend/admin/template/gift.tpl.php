<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">禮品搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $type_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $DT['city'] ? ajax_area_select('areaid', '地區(分站)', $areaid).'&nbsp;' : '';?>
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">管理禮品</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>分類</th>
<th width="14"> </th>
<th>圖片</th>
<th>標題</th>
<th>積分</th>
<th>名額</th>
<th>訂單</th>
<th>瀏覽</th>
<th>添加時間</th>
<th width="80">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="編輯:<?php echo $v['editor'];?>&#10;更新時間:<?php echo $v['editdate'];?>">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="<?php echo $v['typeurl'];?>" target="_blank"><?php echo $v['typename'];?></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>級" alt=""/></a><?php } ?></td>
<td><a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="<?php echo $v['thumb'] ? $v['thumb'] : DT_SKIN.'image/nopic60.gif';?>" width="60" style="padding:5px;"/></a></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['title'];?></td>
<td class="px11"><?php echo $v['credit'];?></td>
<td class="px11"><?php echo $v['amount'];?></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order&itemid=<?php echo $v['itemid'];?>"><?php echo $v['orders'] ? '<span class="f_red">'.$v['orders'].'</span>' : $v['orders'];?></a></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/order.gif" width="16" height="16" title="訂單管理" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中禮品嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<?php echo level_select('level', '設置級別為</option><option value="0">取消', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>