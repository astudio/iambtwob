<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">會員搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="40" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<select name="online">
<option value="2"<?php if($online==2) echo ' selected';?>>狀態</option>
<option value="1"<?php if($online==1) echo ' selected';?>>在線</option>
<option value="0"<?php if($online==0) echo ' selected';?>>隱身</option>
</select>&nbsp;
<?php echo module_select('mid', '模塊', $mid);?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<div class="tt">在線會員</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>會員名</th>
<th>狀態</th>
<th>所在模塊</th>
<th>IP</th>
<th>IP所在地</th>
<th>訪問時間</th>
<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><a href="javascript:_user('<?php echo $v['username'];?>')"><?php echo $v['username'];?></a></td>
<td><?php echo $v['online'] ? '<span class="f_green">在線</span>' : '<span class="f_gray">隱身</span>';?></td>
<td><a href="<?php echo $MODULE[$v['moduleid']]['linkurl'];?>" target="_blank"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['lasttime'];?></td>
<td>
<a href="javascript:_user('<?php echo $v['username'];?>')"><img src="admin/image/view.png" width="16" height="16" title="會員[<?php echo $v['username'];?>]詳細資料" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="進入會員商務中心" alt=""/></a> 
</td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>