<?php
defined('IN_DESTOON') or exit('Access Denied');
?>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinabank.com.cn" target="_blank" class="t"><strong>網銀在線 ChinaBank</strong></a></td>
<td>
<input type="radio" name="pay[chinabank][enable]" value="1"  <?php if($chinabank['enable']) echo 'checked';?> onclick="Dd('chinabank').style.display='';"/> 啟用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[chinabank][enable]" value="0"  <?php if(!$chinabank['enable']) echo 'checked';?> onclick="Dd('chinabank').style.display='none';"/> 禁用&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinabank.com.cn" target="_blank" class="t">[帳號申請]</a>
</td>
</tr>
<tbody style="display:<?php echo $chinabank['enable'] ? '' : 'none';?>" id="chinabank">
<tr>
<td class="tl">顯示名稱</td>
<td><input type="text" size="30" name="pay[chinabank][name]" value="<?php echo $chinabank['name'];?>"/></td>
</tr>
<tr>
<td class="tl">顯示順序</td>
<td><input type="text" size="2" name="pay[chinabank][order]" value="<?php echo $chinabank['order'];?>"/></td>
</tr>
<tr>
<td class="tl">商戶編號</td>
<td><input type="text" size="60" name="pay[chinabank][partnerid]" value="<?php echo $chinabank['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">支付密鑰</td>
<td><input type="text" size="60" name="pay[chinabank][keycode]" value="<?php echo $chinabank['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">扣除手續費</td>
<td><input type="text" size="2" name="pay[chinabank][percent]" value="<?php echo $chinabank['percent'];?>"/> %</td>
</tr>
</tbody>
<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.alipay.com" target="_blank" class="t"><strong>支付寶 Alipay</strong></a></td>
<td>
<input type="radio" name="pay[alipay][enable]" value="1"  <?php if($alipay['enable']) echo 'checked';?> onclick="Dd('alipay').style.display='';"/> 啟用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[alipay][enable]" value="0"  <?php if(!$alipay['enable']) echo 'checked';?> onclick="Dd('alipay').style.display='none';"/> 禁用&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.alipay.com" target="_blank" class="t">[帳號申請]</a>
</td>
</tr>
<tbody style="display:<?php echo $alipay['enable'] ? '' : 'none';?>" id="alipay">
<tr>
<td class="tl">顯示名稱</td>
<td><input type="text" size="30" name="pay[alipay][name]" value="<?php echo $alipay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">顯示順序</td>
<td><input type="text" size="2" name="pay[alipay][order]" value="<?php echo $alipay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">支付寶帳號</td>
<td><input type="text" size="30" name="pay[alipay][email]" value="<?php echo $alipay['email'];?>"/><?php tips('僅支持即時到賬接口');?></td>
</tr>
<tr>
<td class="tl">合作者身份（partnerID）</td>
<td><input type="text" size="60" name="pay[alipay][partnerid]" value="<?php echo $alipay['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">交易安全校驗碼（key）</td>
<td><input type="text" size="60" name="pay[alipay][keycode]" value="<?php echo $alipay['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">接口類型</td>
<td>
<select name="pay[alipay][service]">
<option value="create_direct_pay_by_user" <?php if($alipay['service'] == 'create_direct_pay_by_user') echo 'selected';?>>快速付款（即時到賬接口）</option>
<option value="trade_create_by_buyer" <?php if($alipay['service'] == 'trade_create_by_buyer') echo 'selected';?>>標準實物雙接口（標準雙接口）</option>
<option value="create_partner_trade_by_buyer" <?php if($alipay['service'] == 'create_partner_trade_by_buyer') echo 'selected';?>>純擔保交易接口（擔保接口）</option>
</select> <?php tips('在線充值一般建議申請 快速付款（即時到賬接口）');?>
</td>
</tr>
<tr>
<td class="tl">接收服務器通知文件名</td>
<td><input type="text" size="30" name="pay[alipay][notify]" value="<?php echo $alipay['notify'];?>"/> <?php tips('默認為notify.php 保存於 api/pay/alipay/notify.php<br/>建議你修改此文件名，然後在此填寫新文件名，以防受到騷擾');?></td>
</tr>
<tr>
<td class="tl">扣除手續費</td>
<td><input type="text" size="2" name="pay[alipay][percent]" value="<?php echo $alipay['percent'];?>"/> %</td>
</tr>
</tbody>
<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.tenpay.com" target="_blank" class="t"><strong>財付通 TenPay</strong></a></td>
<td>
<input type="radio" name="pay[tenpay][enable]" value="1"  <?php if($tenpay['enable']) echo 'checked';?> onclick="Dd('tenpay').style.display='';"/> 啟用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[tenpay][enable]" value="0"  <?php if(!$tenpay['enable']) echo 'checked';?> onclick="Dd('tenpay').style.display='none';"/> 禁用&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.tenpay.com" target="_blank" class="t">[帳號申請]</a>
</td>
</tr>
<tbody style="display:<?php echo $tenpay['enable'] ? '' : 'none';?>" id="tenpay">
<tr>
<td class="tl">顯示名稱</td>
<td><input type="text" size="30" name="pay[tenpay][name]" value="<?php echo $tenpay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">顯示順序</td>
<td><input type="text" size="2" name="pay[tenpay][order]" value="<?php echo $tenpay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">商戶編號</td>
<td><input type="text" size="60" name="pay[tenpay][partnerid]" value="<?php echo $tenpay['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">支付密鑰</td>
<td><input type="text" size="60" name="pay[tenpay][keycode]" value="<?php echo $tenpay['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">扣除手續費</td>
<td><input type="text" size="2" name="pay[tenpay][percent]" value="<?php echo $tenpay['percent'];?>"/> %</td>
</tr>
</tbody>

<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.yeepay.com" target="_blank" class="t"><strong>易寶支付 YeePay</strong></a></td>
<td>
<input type="radio" name="pay[yeepay][enable]" value="1"  <?php if($yeepay['enable']) echo 'checked';?> onclick="Dd('yeepay').style.display='';"/> 啟用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[yeepay][enable]" value="0"  <?php if(!$yeepay['enable']) echo 'checked';?> onclick="Dd('yeepay').style.display='none';"/> 禁用&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.yeepay.com" target="_blank" class="t">[帳號申請]</a>
</td>
</tr>
<tbody style="display:<?php echo $yeepay['enable'] ? '' : 'none';?>" id="yeepay">
<tr>
<td class="tl">顯示名稱</td>
<td><input type="text" size="30" name="pay[yeepay][name]" value="<?php echo $yeepay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">顯示順序</td>
<td><input type="text" size="2" name="pay[yeepay][order]" value="<?php echo $yeepay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">商戶編號</td>
<td><input type="text" size="60" name="pay[yeepay][partnerid]" value="<?php echo $yeepay['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">商戶密鑰</td>
<td><input type="text" size="60" name="pay[yeepay][keycode]" value="<?php echo $yeepay['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">扣除手續費</td>
<td><input type="text" size="2" name="pay[yeepay][percent]" value="<?php echo $yeepay['percent'];?>"/> %</td>
</tr>
</tbody>
<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.paypal.com" target="_blank" class="t"><strong>貝&nbsp;&nbsp;&nbsp;寶 PayPal</strong></a></td>
<td>
<input type="radio" name="pay[paypal][enable]" value="1"  <?php if($paypal['enable']) echo 'checked';?> onclick="Dd('paypal').style.display='';"/> 啟用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[paypal][enable]" value="0"  <?php if(!$paypal['enable']) echo 'checked';?> onclick="Dd('paypal').style.display='none';"/> 禁用&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.paypal.com" target="_blank" class="t">[帳號申請]</a>
</td>
</tr>
<tbody style="display:<?php echo $paypal['enable'] ? '' : 'none';?>" id="paypal">
<tr>
<td class="tl">顯示名稱</td>
<td><input type="text" size="30" name="pay[paypal][name]" value="<?php echo $paypal['name'];?>"/></td>
</tr>
<tr>
<td class="tl">顯示順序</td>
<td><input type="text" size="2" name="pay[paypal][order]" value="<?php echo $paypal['order'];?>"/></td>
</tr>
<tr>
<td class="tl">商戶帳號</td>
<td><input type="text" size="30" name="pay[paypal][partnerid]" value="<?php echo $paypal['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">支付幣種</td>
<td><input type="text" size="3" name="pay[paypal][currency]" value="<?php echo $paypal['currency'];?>"/> 值可以為 "CNY"、"USD"、"EUR"、"GBP"、"CAD"、"JPY"等</td>
</tr>
<tr>
<td class="tl">扣除手續費</td>
<td><input type="text" size="2" name="pay[paypal][percent]" value="<?php echo $paypal['percent'];?>"/> %</td>
</tr>
</tbody>
<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinapay.com" target="_blank" class="t"><strong>中國銀聯 ChinaPay</strong></a></td>
<td>
<input type="radio" name="pay[chinapay][enable]" value="1"  <?php if($chinapay['enable']) echo 'checked';?> onclick="Dd('chinapay').style.display='';"/> 啟用&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[chinapay][enable]" value="0"  <?php if(!$chinapay['enable']) echo 'checked';?> onclick="Dd('chinapay').style.display='none';"/> 禁用&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinapay.com" target="_blank" class="t">[帳號申請]</a> <?php tips('本接口需要 mcrypt 和 bcmath 兩個PHP擴展庫的支持，請先確認您安裝並啟用了這兩個庫');?>
</td>
</tr>
<tbody style="display:<?php echo $chinapay['enable'] ? '' : 'none';?>" id="chinapay">
<tr>
<td class="tl">顯示名稱</td>
<td><input type="text" size="30" name="pay[chinapay][name]" value="<?php echo $chinapay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">顯示順序</td>
<td><input type="text" size="2" name="pay[chinapay][order]" value="<?php echo $chinapay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">私鑰文件</td>
<td><input type="text" size="60" name="pay[chinapay][partnerid]" value="<?php echo $chinapay['partnerid'];?>"/> <?php tips('銀聯提供的Mer開頭的.key文件名，例如MerPrK_808080808080808_20101111222333.key');?></td>
</tr>
<tr>
<td class="tl">扣除手續費</td>
<td><input type="text" size="2" name="pay[chinapay][percent]" value="<?php echo $chinapay['percent'];?>"/> %</td>
</tr>
</tbody>
</table>