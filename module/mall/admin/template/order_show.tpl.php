<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">交易詳情</div>
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
<td class="tl">手機</td>
<td><?php echo $item['buyer_mobile'];?></td>
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
<?php if($item['fee']>0) { ?>
<tr>
<td class="tl"><?php echo $item['fee_name'];?></td>
<td class="f_blue"><?php echo $item['fee'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl">數量</td>
<td><?php echo $item['number'];?></td>
</tr>
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
<?php if($item['refund_reason']) { ?>
<tr>
<td class="tl">操作理由或證據</td>
<td><?php echo $item['refund_reason'];?></td>
</tr>
<tr>
<td class="tl">操作人</td>
<td><?php echo $item['editor'];?></td>
</tr>
<tr>
<td class="tl">操作時間</td>
<td><?php echo $item['updatetime'];?></td>
</tr>
<?php } ?>
</table>

<div class="tt">買家評價<a name="comment1"></a></div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($cm['seller_star']) { ?>
<tr>
<td class="tl">買家評分</td>
<td>
<span class="f_r"><a href="#comment" onclick="Ds('c_edit');" class="t">[修改]</a></span>
<img src="<?php echo DT_PATH;?>file/image/star<?php echo $cm['seller_star'];?>.gif" width="36" height="12" alt="" align="absmiddle"/> <?php echo $STARS[$cm['seller_star']];?>
</td>
</tr>
<tr>
<td class="tl">買家評論</td>
<td><?php echo nl2br($cm['seller_comment']);?></td>
</tr>
<tr>
<td class="tl">評論時間</td>
<td class="px11"><?php echo timetodate($cm['seller_ctime'], 6);?></td>
</tr>
<?php if($cm['buyer_reply']) { ?>
<tr>
<td class="tl">賣家解釋</td>
<td style="color:#D9251D;"><?php echo nl2br($cm['buyer_reply']);?></td>
</tr>
<tr>
<td class="tl">解釋時間</td>
<td class="px11"><?php echo timetodate($cm['buyer_rtime'], 6);?></td>
</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td class="tl">買家評論</td>
<td>暫未評論</td>
</tr>
<?php } ?>
</table>

<div class="tt">賣家評價<a name="comment2"></a></div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($cm['buyer_star']) { ?>
<tr>
<td class="tl">賣家評分</td>
<td>
<span class="f_r"><a href="#comment" onclick="Ds('c_edit');" class="t">[修改]</a></span>
<img src="<?php echo DT_PATH;?>file/image/star<?php echo $cm['buyer_star'];?>.gif" width="36" height="12" alt="" align="absmiddle"/> <?php echo $STARS[$cm['buyer_star']];?>
</td>
</tr>
<tr>
<td class="tl">賣家評論</td>
<td><?php echo nl2br($cm['buyer_comment']);?></td>
</tr>
<tr>
<td class="tl">評論時間</td>
<td class="px11"><?php echo timetodate($cm['buyer_ctime'], 6);?></td>
</tr>
<?php if($cm['seller_reply']) { ?>
<tr>
<td class="tl">買家解釋</td>
<td style="color:#D9251D;"><?php echo nl2br($cm['seller_reply']);?></td>
</tr>
<tr>
<td class="tl">解釋時間</td>
<td class="px11"><?php echo timetodate($cm['seller_rtime'], 6);?></td>
</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td class="tl">賣家評論</td>
<td>暫未評論</td>
</tr>
<?php } ?>
</table>

<div id="c_edit" style="display:none;">
<div class="tt">修改評價<a name="comment"></a></div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="comment"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">買家評分</td>
<td>
<input type="radio" name="post[seller_star]" value="3"<?php echo $cm['seller_star'] == 3 ? ' checked' : '';?>/> 好評 
<input type="radio" name="post[seller_star]" value="2"<?php echo $cm['seller_star'] == 2 ? ' checked' : '';?>/> 中評 
<input type="radio" name="post[seller_star]" value="1"<?php echo $cm['seller_star'] == 1 ? ' checked' : '';?>/> 差評 
<input type="radio" name="post[seller_star]" value="0"<?php echo $cm['seller_star'] == 0 ? ' checked' : '';?>/> 待評
</td>
</tr>
<tr>
<td class="tl">買家評論</td>
<td><textarea name="post[seller_comment]" style="width:300px;height:60px;"><?php echo $cm['seller_comment'];?></textarea></td>
</tr>
<tr>
<td class="tl">評論時間</td>
<td><input type="text" style="width:150px;" name="post[seller_ctime]" value="<?php echo $cm['seller_ctime'] ? timetodate($cm['seller_ctime'], 6) : '';?>"/></td>
</tr>
<tr>
<td class="tl">賣家解釋</td>
<td><textarea name="post[buyer_reply]" style="width:300px;height:60px;"><?php echo $cm['buyer_reply'];?></textarea></td>
</tr>
<tr>
<td class="tl">解釋時間</td>
<td><input type="text" style="width:150px;" name="post[buyer_rtime]" value="<?php echo $cm['buyer_rtime'] ? timetodate($cm['buyer_rtime'], 6) : '';?>"/></td>
</tr>

<tr>
<td class="tl">賣家評分</td>
<td>
<input type="radio" name="post[buyer_star]" value="3"<?php echo $cm['buyer_star'] == 3 ? ' checked' : '';?>/> 好評 
<input type="radio" name="post[buyer_star]" value="2"<?php echo $cm['buyer_star'] == 2 ? ' checked' : '';?>/> 中評 
<input type="radio" name="post[buyer_star]" value="1"<?php echo $cm['buyer_star'] == 1 ? ' checked' : '';?>/> 差評 
<input type="radio" name="post[buyer_star]" value="0"<?php echo $cm['buyer_star'] == 0 ? ' checked' : '';?>/> 待評
</td>
</tr>
<tr>
<td class="tl">賣家評論</td>
<td><textarea name="post[buyer_comment]" style="width:300px;height:60px;"><?php echo $cm['buyer_comment'];?></textarea></td>
</tr>
<tr>
<td class="tl">評論時間</td>
<td><input type="text" style="width:150px;" name="post[buyer_ctime]" value="<?php echo $cm['buyer_ctime'] ? timetodate($cm['buyer_ctime'], 6) : '';?>"/></td>
</tr>
<tr>
<td class="tl">買家解釋</td>
<td><textarea name="post[seller_reply]" style="width:300px;height:60px;"><?php echo $cm['seller_reply'];?></textarea></td>
</tr>
<tr>
<td class="tl">解釋時間</td>
<td><input type="text" style="width:150px;" name="post[seller_rtime]" value="<?php echo $cm['seller_rtime'] ? timetodate($cm['seller_rtime'], 6) : '';?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></div>
</form>
</div>
<script type="text/javascript">
function check() {
	return confirm('確定要修改該訂單的評論嗎？');
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>