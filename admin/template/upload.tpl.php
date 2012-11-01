<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">分表[<?php echo $id;?>]記錄搜索</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> 至 <?php echo dcalendar('todate', $todate);?>&nbsp;
<select name="mid">
<option value="0">模塊</option>
<?php foreach($MODULE as $m) { if(!$m['islink']) { ?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : '';?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>圖文&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>&id=<?php echo $id;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<div class="tt">分表[<?php echo $id;?>]上傳記錄</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="20"></th>
<th>文件名</th>
<th>大小</th>
<th>寬度</th>
<th>高度</th>
<th>模塊</th>
<th>信息ID</th>
<th>來源</th>
<th>會員名</th>
<th width="150">時間</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" type="checkbox" value="<?php echo $v['pid'];?>"/></td>
<td><img src="<?php echo DT_PATH.'file/ext/'.$v['ext'].'.gif';?>"/></td>
<td align="left" title="<?php echo $v['fileurl'];?>">
<?php if($thumb && $v['image']) { ?>
<a href="javascript:_preview('<?php echo $v['fileurl'];?>');"><img src="<?php echo $v['fileurl'];?>" width="80" style="margin:5px;"/></a>
<?php } else { ?>
&nbsp;<a href="<?php echo $v['fileurl'];?>" target="_blank"><?php echo basename($v['fileurl']);?></a><?php if($v['image']) { ?>&nbsp;<a href="javascript:_preview('<?php echo $v['fileurl'];?>');"><img src="admin/image/img.gif" width="10" height="10" title="點擊預覽" alt=""/><?php } ?>
<?php } ?>
</td>
<td><?php echo $v['size'];?></td>
<td><?php echo $v['width'] ? $v['width'] : '';?></td>
<td><?php echo $v['height'] ? $v['height'] : '';?></td>
<td><a href="?file=<?php echo $file;?>&mid=<?php echo $v['moduleid'];?>"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['moduleid'];?>&itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['itemid'];?></a></td>
<td><a href="?file=<?php echo $file;?>&upfrom=<?php echo $v['upfrom'];?>"><?php echo $v['upfrom'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input title="僅刪除記錄" type="submit" value="刪除記錄" class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？此操作將不可撤銷')){this.form.action='?file=<?php echo $file;?>&id=<?php echo $id;?>&action=delete_record'}else{return false;}"/>&nbsp;&nbsp;
<input title="刪除記錄和對應文件" type="submit" value="徹底刪除" class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？系統同時會刪除對應文件，此操作將不可撤銷')){this.form.action='?file=<?php echo $file;?>&id=<?php echo $id;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>