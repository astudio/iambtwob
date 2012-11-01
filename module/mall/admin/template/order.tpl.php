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
<option value="fee" <?php if($mtype == 'fee') echo 'selected';?>>附加費用</option>
<option value="number" <?php if($mtype == 'number') echo 'selected';?>>購買數量</option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> 至 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;

<select name="seller_star">
<option value="0" <?php if($seller_star == 0) echo 'selected';?>>賣家評價</option>
<option value="3" <?php if($seller_star == 3) echo 'selected';?>>好評</option>
<option value="2" <?php if($seller_star == 2) echo 'selected';?>>中評</option>
<option value="1" <?php if($seller_star == 1) echo 'selected';?>>差評</option>
</select>&nbsp;

<select name="buyer_star">
<option value="0" <?php if($buyer_star == 0) echo 'selected';?>>買家評價</option>
<option value="3" <?php if($buyer_star == 3) echo 'selected';?>>好評</option>
<option value="2" <?php if($buyer_star == 2) echo 'selected';?>>中評</option>
<option value="1" <?php if($buyer_star == 1) echo 'selected';?>>差評</option>
</select>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
訂單單號：<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/>&nbsp;
商品單號：<input type="text" name="mallid" value="<?php echo $mallid;?>" size="10"/>&nbsp;
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
<strong>數量：</strong><?php echo $v['number'];?>
</td>
<td class="f_red px11 f_b"><?php echo $v['money'];?></td>
<td class="px11">
<a href="javascript:_user('<?php echo $v['seller'];?>');"><?php echo $v['seller'];?></a><br/>
<?php if($v['seller_star'] > 0) {?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>#comment1"><img src="<?php echo DT_PATH;?>file/image/star<?php echo $v['seller_star'];?>.gif" width="36" height="12" title="買家評價賣家：<?php echo $STARS[$v['seller_star']];?> 點擊查看詳情"/></a>
<?php } ?>
</td>
<td class="px11">
<a href="javascript:_user('<?php echo $v['buyer'];?>');"><?php echo $v['buyer'];?></a><br/>
<?php if($v['buyer_star'] > 0) {?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>#comment2"><img src="<?php echo DT_PATH;?>file/image/star<?php echo $v['buyer_star'];?>.gif" width="36" height="12" title="賣家評價買家：<?php echo $STARS[$v['buyer_star']];?> 點擊查看詳情"/></a>
<?php } ?>
</td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td class="px11"><?php echo $v['updatetime'];?></td>
<td><?php echo $v['dstatus'];?></td>
<td>
<?php if($v['status'] == 5) {?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=refund&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="受理" alt=""/></a>
<?php } else { ?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/view.png" width="16" height="16" title="查看" alt=""/></a>
<?php } ?>
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
<input type="submit" value=" 批量刪除 " class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="button" value="導出SQL" class="btn" onclick="Go('?file=database&action=export&table=<?php echo $table;?>');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>