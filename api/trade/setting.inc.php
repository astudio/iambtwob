<?php
defined('IN_DESTOON') or exit('Access Denied');
?>
<tr>
<td class="tl">支付寶擔保交易</td>
<td>
<input type="radio" name="setting[trade]" value="alipay"  <?php if($trade){ ?>checked <?php } ?> onclick="Ds('dtrade');"/> 開啟&nbsp;&nbsp;
<input type="radio" name="setting[trade]" value=""  <?php if(!$trade){ ?>checked <?php } ?> onclick="Dh('dtrade');"/> 關閉&nbsp;&nbsp;&nbsp;&nbsp;
<img src="<?php echo DT_PATH;?>api/trade/alipay/ico.gif" align="absmiddle"/> <a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=https://b.alipay.com/order/productStorePay.htm" target="_blank" class="t">[申請帳號]</a>
</td>
</tr>
<tbody id="dtrade" style="display:<?php if(!$trade) echo 'none';?>">
<tr>
<td class="tl">顯示名稱</td>
<td><input name="setting[trade_nm]" type="text" value="<?php echo $trade_nm;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">官方網站</td>
<td><input name="setting[trade_hm]" type="text" value="<?php echo $trade_hm;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">商戶ID</td>
<td><input name="setting[trade_id]" type="text" value="<?php echo $trade_id;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">安全密鑰</td>
<td><input name="setting[trade_pw]" type="text" id="trade_pw" size="41" value="<?php echo $trade_pw;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">商戶帳號</td>
<td><input name="setting[trade_ac]" type="text" value="<?php echo $trade_ac;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">接口類型</td>
<td>
<select name="setting[trade_tp]">
<option value="0" <?php if($trade_tp == 0) echo 'selected';?>>平台商擔保交易</option>
<option value="1" <?php if($trade_tp == 1) echo 'selected';?>>平台商雙功能</option>
</select> <?php tips('建議申請 平台商擔保交易');?>
</td>
</tr>
<tr>
<td class="tl">接收服務器通知文件名</td>
<td><input type="text" size="30" name="setting[trade_nu]" value="<?php echo $trade_nu;?>"/> <?php tips('默認為notify.php 保存於 api/trade/alipay/1/notify.php(平台商擔保交易)和api/trade/alipay/2/notify.php(平台商雙功能)<br/>建議你修改此文件名，然後在此填寫新文件名，以防受到騷擾');?></td>
</tr>
</tbody>