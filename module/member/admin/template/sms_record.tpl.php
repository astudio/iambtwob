<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">流水搜索</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<select name="type">
<option value="0">類型</option>
<option value="1" <?php if($type == 1) echo 'selected';?>>增加</option>
<option value="2" <?php if($type == 2) echo 'selected';?>>扣除</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<?php echo $order_select;?>&nbsp;
會員:<input type="text" name="username" value="<?php echo $username;?>" size="6" title="請輸入會員名"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">流水記錄</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>流水號</th>
<th>增加</th>
<th>扣除</th>
<th>餘額</th>
<th>會員名稱</th>
<th width="110">發生時間</th>
<th>操作人</th>
<th>事由</th>
<th>備註</th>
</tr>
<?php foreach($records as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td class="f_blue"><?php if($v['amount'] > 0) echo $v['amount'];?></td>
<td class="f_red"><?php if($v['amount'] < 0) echo $v['amount'];?></td>
<td><?php echo $v['balance'] ? $v['balance'] : '';?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td><?php echo $v['editor'];?></td>
<td title="<?php echo $v['reason'];?>"><input type="text" size="15" value="<?php echo $v['reason'];?>"/></td>
<td title="<?php echo $v['note'];?>"><input type="text" size="15" value="<?php echo $v['note'];?>"/></td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>小計</strong></td>
<td class="f_blue"><?php echo $income;?></td>
<td class="f_red"><?php echo $expense;?></td>
<td colspan="6">&nbsp;</td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" 批量刪除 " class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete_record'}else{return false;}"/>&nbsp;
<input type="button" value="導出SQL" class="btn" onclick="Go('?file=database&action=export&table=<?php echo $table;?>');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(3);</script>
<br/>
<?php include tpl('footer');?>