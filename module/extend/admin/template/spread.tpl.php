<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">排名搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="type">
<option value="0">時間類型</option>
<option value="1" <?php if($type == 1) echo 'selected';?>>開始時間</option>
<option value="2" <?php if($type == 2) echo 'selected';?>>到期時間</option>
<option value="3" <?php if($type == 3) echo 'selected';?>>添加時間</option>
</select>&nbsp;
<select name="mid">
<option value="0"<?php if($mid == 0) echo ' selected';?>>模塊</option>
<option value="5"<?php if($mid == 5) echo ' selected';?>>供應</option>
<option value="6"<?php if($mid == 6) echo ' selected';?>>求購</option>
<option value="4"<?php if($mid == 4) echo ' selected';?>>公司</option>
</select>&nbsp;
<?php echo $order_select;?>
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">管理排名</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>模塊</th>
<th>關鍵詞</th>
<th>出價</th>
<th>單位</th>
<th>公司</th>
<th>信息ID</th>
<th>開始時間</th>
<th>結束時間</th>
<th>剩餘(天)</th>
<th>狀態</th>
<th>添加時間</th>
<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $MODULE[$v['mid']]['name'];?></td>
<td>&nbsp;<a href="<?php echo $MODULE[$v['mid']]['linkurl'];?>search.php?kw=<?php echo urlencode($v['word']);?>" target="_blank"><?php echo $v['word'];?></td>
<td><?php echo $v['price'];?></td>
<td><?php echo $v['currency'] == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['company'];?></a></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['mid'];?>&itemid=<?php echo $v['tid'];?>" target="_blank"><?php echo $v['tid'];?></a></td>
<td class="px11"><?php echo $v['fromdate'];?></td>
<td class="px11"><?php echo $v['todate'];?></td>
<td<?php if($v['days']<5) echo ' class="f_red"';?>><?php echo $v['days'];?></td>
<td><?php echo $v['process'];?></td>
<td class="px11" title="編輯:<?php echo $v['editor'];?>&#10;更新時間:<?php echo $v['editdate'];?>"><?php echo $v['adddate'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中排名嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<?php if($action == 'check') { ?>
<input type="submit" value=" 通過審核 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check&status=3';"/>&nbsp;
<?php } else { ?>
<input type="submit" value=" 取消審核 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check&status=2';"/>&nbsp;
<?php } ?>
&nbsp;&nbsp;
提示：系統會定期自動生成排名，如果需要立即看到效果，請點生成排名
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>