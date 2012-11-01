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
<select name="bank">
<option value="">支付平台</option>
<?php
foreach($PAY as $k=>$v) {
	echo '<option value="'.$k.'" '.($bank == $k ? 'selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>&nbsp;
<?php echo $status_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="sendtime" <?php if($timetype == 'sendtime') echo 'selected';?>>下單時間</option>
<option value="receivetime" <?php if($timetype == 'receivetime') echo 'selected';?>>支付時間</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="mtype">
<option value="amount" <?php if($mtype == 'amount') echo 'selected';?>>充值金額</option>
<option value="fee" <?php if($mtype == 'fee') echo 'selected';?>>手續費</option>
<option value="money" <?php if($mtype == 'money') echo 'selected';?>>實收金額</option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> 至 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
會員名：<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
流水號：<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<div class="tt">充值記錄</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>流水號</th>
<th>充值金額</th>
<th>手續費</th>
<th>實收金額</th>
<th>會員名稱</th>
<th>支付平台</th>
<th width="110">下單時間</th>
<th width="110">支付時間</th>
<th>操作人</th>
<th>狀態</th>
<th>備註</th>
</tr>
<?php foreach($charges as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td><?php echo $v['amount'];?></td>
<td><?php echo $v['fee'];?></td>
<td class="f_blue"><?php echo $v['money'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $PAY[$v['bank']]['name'];?></td>
<td class="px11"><?php echo $v['sendtime'];?></td>
<td class="px11"><?php echo $v['receivetime'];?></td>
<td><?php echo $v['editor'];?></td>
<td><?php echo $v['dstatus'];?></td>
<td title="<?php echo $v['note'];?>"><input type="text" size="10" value="<?php echo $v['note'];?>"/></td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>小計</strong></td>
<td><?php echo $amount;?></td>
<td><?php echo $fee;?></td>
<td class="f_blue"><?php echo $money;?></td>
<td colspan="7"></td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" 人工審核 " class="btn" onclick="if(confirm('確定要通過選中記錄狀態嗎？此操作將不可撤銷\n\n如果金額未到帳或金額不符，請勿進行此操作')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check'}else{return false;}"/>&nbsp;
<input type="submit" value=" 作 廢 " class="btn" onclick="if(confirm('確定要作廢選中(限未知)記錄狀態嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=recycle'}else{return false;}"/>&nbsp;
<input type="submit" value=" 刪除記錄 " class="btn" onclick="if(confirm('警告：確定要刪除選中(限未知)記錄嗎？此操作將不可撤銷\n\n如果無特殊原因，建議不要刪除記錄，以便查詢對帳')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="button" value="導出SQL" class="btn" onclick="Go('?file=database&action=export&table=<?php echo $table;?>');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<br/>
<?php include tpl('footer');?>