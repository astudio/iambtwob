<?php
defined('IN_DESTOON') or exit('Access Denied');
preg_match("/^http:\/\/s[0-9]{1,5}\.cnzz\.com\/stat\.php\?id=[0-9]{5,11}&web_id=[0-9]{5,11}$/", $stats) or $stats = '';
?>
<tr>
<td class="tl">主頁流量統計地址</td>
<td class="tr">
<input type="text" name="setting[stats]" id="stats" value="<?php echo $stats;?>" size="70"/>&nbsp;&nbsp;
<?php 
	if($stats) {
	$tmp = explode('web_id=', $stats);
	$web_id = $tmp[1];
?>
<a href="http://www.cnzz.com/stat/website.php?web_id=<?php echo $web_id;?>" class="t" target="_blank">查看統計</a>
<?php } else { ?>
<a href="http://www.cnzz.com/" class="t" target="_blank">帳號申請</a>
<?php } ?><br/><br/>
提示：註冊後獲取的統計代碼形式為：<br/>&lt;script src="<span class="f_red">http://s21.cnzz.com/stat.php?id=1234567&web_id=1234567</span>" language="JavaScript"&gt;&lt;/script&gt;<br/>
其中 <span class="f_red">http://s21.cnzz.com/stat.php?id=1234567&web_id=1234567</span> 即為統計地址
</td>
</tr>