<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">var errimg = '<?php echo DT_SKIN;?>image/nopic50.gif';</script>
<div class="tt">記錄搜索</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<?php echo $status_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<select name="logistic">
<option value="-1">物流</option>
<option value="0" <?php if($logistic == 0) echo 'selected';?>>不需要</option>
<option value="1" <?php if($logistic == 1) echo 'selected';?>>需要</option>
</select>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="addtime" <?php if($timetype == 'addtime') echo 'selected';?>>下單時間</option>
<option value="updatetime" <?php if($timetype == 'updatetime') echo 'selected';?>>更新時間</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="mtype">
<option value="money" <?php if($mtype == 'money') echo 'selected';?>>交易總額</option>
<option value="amount" <?php if($mtype == 'amount') echo 'selected';?>>下單金額</option>
<option value="price" <?php if($mtype == 'price') echo 'selected';?>>商品單價</option>
<option value="number" <?php if($mtype == 'number') echo 'selected';?>>購買數量</option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> 至 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
訂單單號：<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/>&nbsp;
商品單號：<input type="text" name="gid" value="<?php echo $gid;?>" size="10"/>&nbsp;
賣家：<input type="text" name="seller" value="<?php echo $seller;?>" size="10"/>&nbsp;
買家：<input type="text" name="buyer" value="<?php echo $buyer;?>" size="10"/>&nbsp;

</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">交易記錄</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="20"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="60">縮略圖</th>
<th>商品或服務</th>
<th>交易總額</th>
<th>數量</th>
<th>賣家</th>
<th>買家</th>
<th width="75">下單時間</th>
<th width="75">更新時間</th>
<th>狀態</th>
<th>操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><img src="<?php if($v['thumb']) { ?><?php echo $v['thumb'];?><?php } else { ?><?php echo DT_SKIN;?>image/nopic50.gif<?php } ?>" width="50" height="50" onerror="this.src=errimg;" style="padding:5px;"/></a></td>
<td align="left" class="f_gray">
&nbsp;
<a href="<?php echo $v['linkurl'];?>" target="_blank" class="t px14 f_b"><?php echo $v['title'];?></a><br/>&nbsp;
<strong>單號：</strong><?php echo $v['itemid'];?>&nbsp;
<strong>單價：</strong><?php echo $v['price'];?>&nbsp;
<strong>密碼：</strong><?php echo $v['password'];?>
</td>
<td class="f_red px11"><?php echo $v['money'];?></td>
<td class="px11"><?php echo $v['number'];?></td>
<td class="px11">
<a href="javascript:_user('<?php echo $v['seller'];?>');"><?php echo $v['seller'];?></a>
</td>
<td class="px11">
<a href="javascript:_user('<?php echo $v['buyer'];?>');"><?php echo $v['buyer'];?></a>
</td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td class="px11"><?php echo $v['updatetime'];?></td>
<td><?php echo $v['dstatus'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/view.png" width="16" height="16" title="查看" alt=""/></a>
</td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>小計</strong></td>
<td></td>
<td class="f_red f_b"><?php echo $money;?></td>
<td colspan="7">&nbsp;</td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" 批量刪除 " class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？請謹慎!此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" 批量退款 " class="btn" onclick="if(confirm('確定要退款選中記錄嗎？請謹慎!此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=refund'}else{return false;}"/>&nbsp;
<input type="button" value="導出SQL" class="btn" onclick="Go('?file=database&action=export&table=<?php echo $table;?>');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>