<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">記錄搜索</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<?php echo $module_select;?>
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
信息ID：<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/> 
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="currency">
<option value=""<?php echo $currency == '' ? ' selected' : '';?>>支付</option>
<option value="money"<?php echo $currency == 'money' ? ' selected' : '';?>><?php echo $DT['money_name'];?></option>
<option value="credit"<?php echo $currency == 'credit' ? ' selected' : '';?>><?php echo $DT['credit_name'];?></option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> 至 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
會員名：<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
流水號：<input type="text" name="pid" value="<?php echo $pid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">支付記錄</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>流水號</th>
<th>金額</th>
<th>單位</th>
<th>模塊</th>
<th>標題</th>
<th>會員名稱</th>
<th>IP</th>
<th width="130">支付時間</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['pid'];?>"/></td>
<td><?php echo $v['pid'];?></td>
<td class="f_blue"><?php echo $v['fee'];?></td>
<td><?php echo $v['currency'] == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?></td>
<td><?php echo $MODULE[$v['moduleid']]['name'];?></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['moduleid'];?>&itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['title'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><a href="javascript:_ip('<?php echo $v['ip'];?>');"><?php echo $v['ip'];?></a></td>
<td class="px11"><?php echo $v['paytime'];?></td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>小計</strong></td>
<td class="f_blue"><?php echo $fee;?></td>
<td colspan="7">&nbsp;</td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" 批量刪除 " class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="button" value="導出SQL" class="btn" onclick="Go('?file=database&action=export&table=<?php echo $table;?>');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(2);</script>
<br/>
<?php include tpl('footer');?>