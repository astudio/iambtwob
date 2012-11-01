<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">商機搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<select name="mid">
<option value="0">類型</option>
<?php foreach($mids as $v) { ?>
<option value="<?php echo $v;?>"<?php echo $mid == $v ? ' selected' : '';?>><?php echo $MODULE[$v]['name'];?></option>
<?php } ?>
</select>&nbsp;
<?php echo ajax_area_select('areaid', '所在地區', $areaid);?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">貿易提醒</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>類別</th>
<th>關鍵詞</th>
<th>行業</th>
<th>地區</th>
<th>添加時間</th>
<th>上次發送</th>
<th>頻率</th>
<th>會員</th>
<th>郵件</th>
<th width="50">管理</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="<?php echo $MODULE[$v['mid']]['linkurl'];?>" class="t" target="_blank"><?php echo $MODULE[$v['mid']]['name'];?></a></td>
<td><?php if($v['word']) { ?><a href="<?php echo $MODULE[$v['mid']]['linkurl'];?>search.php?kw=<?php echo urlencode($v['word']);?>" class="t" target="_blank"><?php echo $v['word'];?></a><?php } else { ?>不限<?php } ?></td>
<td><?php if($v['catid']) { ?><?php echo $v['cate'];?><?php } else { ?>不限<?php } ?></td>
<td><?php if($v['areaid']) { ?><a href="<?php echo $MODULE[$v['mid']]['linkurl'];?>search.php?areaid=<?php echo $v['areaid'];?>" target="_blank"><?php echo area_pos($v['areaid'], '-');?></a><?php } else { ?>不限<?php } ?></td>
<td class="px11 f_gray"><?php echo timetodate($v['addtime'], 5);?></td>
<?php if($v['sendtime']) { ?>
<td class="px11 f_gray"><?php echo timetodate($v['sendtime'], 5);?></td>
<?php } else { ?>
<td class="f_gray">從未</td>
<?php } ?>
<td class="f_red"><?php if($v['rate']) { ?><?php echo $v['rate'];?>天<?php } else { ?>不限<?php } ?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>

<td class="px11 f_gray"><?php echo $v['email'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<?php if($action == 'check') { ?>
<input type="submit" value=" 通過審核 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check';"/>&nbsp;
<?php } else { ?>
<input type="submit" value=" 撤銷審核 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=reject';"/>&nbsp;
<?php } ?>
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中貿易提醒嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">添加提醒</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">請選擇商機類型</td>
<td><?php if(is_array($mids)) { foreach($mids as $v) { ?>
<input type="radio" name="mid" value="<?php echo $v;?>" id="mid_<?php echo $v;?>" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=add&mid=<?php echo $v;?>');"/><label for="mid_<?php echo $v;?>"> <?php echo $MODULE[$v]['name'];?></label>&nbsp;&nbsp;<?php } } ?></td>
</tr>
</table>
<br/>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>