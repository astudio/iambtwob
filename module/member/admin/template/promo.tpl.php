<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($print) { ?>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>優惠碼</th>
<th>類型</th>
<th>面額</th>
<th>有效期至</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><?php echo $v['number'];?></td>
<td><?php echo $v['type'] ? '有效期' : '抵金額';?></td>
<td class="f_blue"><?php echo $v['amount'];?></td>
<td><?php echo $v['totime'];?></td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Dh('destoon_menu');</script>
<?php exit; } ?>
<div class="tt">優惠碼搜索</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<select name="status">
<option value="0">狀態</option>
<option value="1" <?php if($status == 1) echo 'selected';?>>已使用</option>
<option value="2" <?php if($status == 2) echo 'selected';?>>已過期</option>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="updatetime" <?php if($timetype == 'updatetime') echo 'selected';?>>使用時間</option>
<option value="totime" <?php if($timetype == 'totime') echo 'selected';?>>到期時間</option>
<option value="addtime" <?php if($timetype == 'addtime') echo 'selected';?>>制卡時間</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
額度：
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> 至 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
會員名：<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
代碼：<input type="text" name="number" value="<?php echo $number;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<div class="tt">優惠碼管理</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>優惠代碼</th>
<th>類型</th>
<th>優惠額度</th>
<th>有效期至</th>
<th>使用會員</th>
<th>使用時間/次數</th>
<th>使用IP</th>
<th>重複</th>
<th>生成時間</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td<?php if($v['reuse']) { ?> class="f_b"<?php } ?>><?php echo $v['number'];?></td>
<td><?php echo $v['type'] ? '有效期' : '抵金額';?></td>
<td class="f_blue"><?php echo $v['amount'];?><?php echo $v['type'] ? '天' : $DT['money_unit'];?></td>
<td><?php echo $v['totime'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $v['updatetime'];?></td>
<td><a href="javascript:_ip('<?php echo $v['ip'];?>');" title="顯示IP所在地"><?php echo $v['ip'];?></a></td>
<td><?php echo $v['reuse'] ? '<span class="f_red">是</span>' : '否';?></td>
<td title="制做人:<?php echo $v['editor'];?>"><?php echo $v['addtime'];?></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 批量刪除 " class="btn" onclick="if(confirm('確定要刪除選中優惠碼嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="button" value=" 打印代碼 " class="btn" onclick="window.open('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&print=1');"/>&nbsp;
<input type="button" value="導出SQL" class="btn" onclick="Go('?file=database&action=export&table=<?php echo $table;?>');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>