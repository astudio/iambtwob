<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">交易退款</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">訂單單號</td>
<td><?php echo $item['itemid'];?> <?php if($DT['trade']) { ?>(<?php echo $DT['trade_nm'];?>訂單單號:<?php echo $item['trade_no'];?>)<?php } ?></td>
</tr>
<tr>
<td class="tl">商品名稱</td>
<td class="tr"><a href="<?php echo $td['linkurl'];?>" target="_blank" class="t"><?php echo $td['title'];?></a></td>
</tr>
<tr>
<td class="tl">商品圖片</td>
<td class="tr"><a href="<?php echo $td['linkurl'];?>" target="_blank"><img src="<?php if($td['thumb']) { ?><?php echo $td['thumb'];?><?php } else { ?><?php echo DT_SKIN;?>image/nopic60.gif<?php } ?>" width="60" height="60"/></a></td>
</tr>
<tr>
<td class="tl">賣家</td>
<td><a href="javascript:_user('<?php echo $item['seller'];?>');" class="t"><?php echo $item['seller'];?></a></td>
</tr>
<tr>
<td class="tl">買家</td>
<td><a href="javascript:_user('<?php echo $item['buyer'];?>');" class="t"><?php echo $item['buyer'];?></a></td>
</tr>
<tr>
<td class="tl">郵編</td>
<td><?php echo $item['buyer_postcode'];?></td>
</tr>
<tr>
<td class="tl">地址</td>
<td><?php echo $item['buyer_address'];?></td>
</tr>
<tr>
<td class="tl">收貨人</td>
<td><?php echo $item['buyer_name'];?></td>
</tr>
<tr>
<td class="tl">電話</td>
<td><?php echo $item['buyer_phone'];?></td>
</tr>
<tr>
<td class="tl">下單時間</td>
<td><?php echo $item['addtime'];?></td>
</tr>
<tr>
<td class="tl">更新時間</td>
<td><?php echo $item['updatetime'];?></td>
</tr>
<tr>
<td class="tl">備註說明</td>
<td><?php echo $item['note'];?></td>
</tr>
<tr>
<td class="tl">金額</td>
<td class="f_red"><?php echo $item['amount'];?></td>
</tr>
<?php if($item['fee']) { ?>
<tr>
<td class="tl"><?php echo $item['fee_name'];?></td>
<td class="f_blue"><?php echo $item['fee'];?></td>
</tr>
<?php } ?>

<tr>
<td class="tl">總額</td>
<td class="f_red f_b"><?php echo $item['money'];?></td>
</tr>

<tr>
<td class="tl">物流類型</td>
<td><?php echo $item['send_type'];?></td>
</tr>
<tr>
<td class="tl">物流號碼</td>
<td><?php echo $item['send_no'];?></td>
</tr>
<tr>
<td class="tl">發貨時間</td>
<td><?php echo $item['send_time'];?></td>
</tr>

<tr>
<td class="tl">交易狀態</td>
<td><?php echo $_status[$item['status']];?></td>
</tr>
<?php if($item['buyer_reason']) { ?>
<tr>
<td class="tl">買家理由或證據</td>
<td><?php echo $item['buyer_reason'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl">受理結果</td>
<td>
<input type="radio" name="status" value="6"/> 將交易金額退還給買家<br/>
<input type="radio" name="status" value="7"/> 將交易金額支付給賣家
</td>
</tr>
<tr>
<td class="tl">操作理由</td>
<td>
<textarea name="content" id="content" class="dsn"></textarea>
<?php echo deditor($moduleid, 'content', 'Simple', '92%', 200);?>
<br/>請謹慎填寫，一經提交將不可更改
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></div>
</form>
<script type="text/javascript">
function check() {
	return confirm('確定要進行此操作嗎？此操作將不可恢復');
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>