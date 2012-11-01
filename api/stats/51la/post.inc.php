<?php
defined('IN_DESTOON') or exit('Access Denied');
preg_match("/^[0-9]{5,11}$/", $stats) or $stats = '';
?>
<tr>
<td class="tl">公司流量統計帳號</td>
<td class="tr">
<input type="text" name="setting[stats]" id="stats" value="<?php echo $stats;?>" size="10"/>&nbsp;&nbsp;
<?php if($stats) { ?>
<a href="http://www.51.la/?<?php echo $stats;?>" class="t" target="_blank">查看統計</a>
<?php } else { ?>
<a href="http://www.51.la/" class="t" target="_blank">帳號申請</a>
<?php } ?><br/><br/>
提示：註冊後獲取的統計代碼"...http://js.users.51.la/<span class="f_red">1234567</span>.js..."中<span class="f_red">1234567</span>即為統計帳號
</td>
</tr>