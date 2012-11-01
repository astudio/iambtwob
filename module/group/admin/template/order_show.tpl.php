<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">交易詳情</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">商品名稱</td>
<td class="tr"><a href="<?php echo $td['linkurl'];?>" target="_blank" class="t f_b"><?php echo $td['title'];?></a></td>
</tr>
<tr>
<td class="tl">訂單單號</td>
<td><?php echo $item['itemid'];?></td>
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
<td class="tl">訂單密碼</td>
<td><?php echo $item['password'];?></td>
</tr>
<tr>
<td class="tl">金額</td>
<td class="f_red"><?php echo $item['amount'];?></td>
</tr>
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
</table>

<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>