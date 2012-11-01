<?php
defined('IN_DESTOON') or exit('Access Denied');
preg_match("/^[0-9a-zA-z_\-]{4,20}$/", $kf) or $kf = '';
?>
<tr>
<td class="tl">公司在線客服帳號</td>
<td class="tr">
<input type="text" name="setting[kf]" id="kf" value="<?php echo $kf;?>" size="10"/>&nbsp;&nbsp;
<?php if($kf) { ?>
<a href="http://www.53kf.com/" class="t" target="_blank">帳號管理</a>
<?php } else { ?>
<a href="http://www.53kf.com/" class="t" target="_blank">帳號申請</a>
<?php } ?><br/><br/>
提示：註冊後獲取的客服代碼"...http://chat.53kf.com/kf.php?arg=<span class="f_red">abc123</span>&style=0..."中<span class="f_red">abc123</span>即為客服帳號
</td>
</tr>