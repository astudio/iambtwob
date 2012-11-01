<?php
defined('IN_DESTOON') or exit('Access Denied');
include IN_ROOT.'/header.tpl.php';
?>
<div class="head">
	<div>
		<strong>檢查系統運行環境</strong><br/>
		檢查當前服務器環境配置是否支持Destoon正常運行
	</div>
</div>
<div class="body">
<div>
	<table cellpadding="4" cellspacing="1" width="100%" bgcolor="#F1F1F1">
	<tr bgcolor="#C0C0C0" align="center">
	<td>檢查項目</td>
	<td>當前環境</td>
	<td>要求環境</td>
	<td>推薦環境</td>
	<td>檢測結果</td>
	</tr>
	<tr bgcolor="#D4D0C8" align="center">
	<td>PHP版本</td>
	<td><?php echo $PHP_VERSION;?></td>
	<td>4.3.0及以上</td>
	<td>5.0.0及以上</td>
	<td><?php echo $php_pass ? '<span style="color:blue;">通過</span>' : '<span style="color:red;">PHP版本過低</span>';?></td>
	</tr>
	<tr bgcolor="#D4D0C8" align="center">
	<td>MySQL版本</td>
	<td><?php echo $PHP_MYSQL;?></td>
	<td>4.0.0及以上</td>
	<td>5.0.0及以上</td>
	<td><?php echo $mysql_pass ? '<span style="color:blue;">通過</span>' : '<span style="color:red;">MySQL版本過低</span>';?></td>
	</tr>
	<tr bgcolor="#D4D0C8" align="center">
	<td>GD庫</td>
	<td><?php echo $PHP_GD;?></td>
	<td>jpg gif png</td>
	<td>jpg gif png</td>
	<td><?php echo $gd_pass ? '<span style="color:blue;">通過</span>' : '<span style="color:red;">無法處理圖片</span>';?></td>
	</tr>
	<tr bgcolor="#D4D0C8" align="center">
	<td>URL打開文件</td>
	<td><?php echo $PHP_URL ? '支持' : '不支持';?></td>
	<td>支持</td>
	<td>支持</td>
	<td><?php echo $url_pass ? '<span style="color:blue;">通過</span>' : '<span style="color:red;">建議開啟</span>';?></td>
	</tr>
	</table>
	<br/>
	<br/>
	<?php
	if($pass) {
		echo '&nbsp;&nbsp;服務器環境配置通過檢測，請點 下一步(N) 繼續安裝';
	} else {
		echo '&nbsp;&nbsp;<span style="color:red;">服務器環境配置未通過檢測，安裝無法進行!</span> <br/><br/>&nbsp;&nbsp;請按提示配置好服務器環境後重新運行本安裝嚮導。';
	}
	?>
</div>
</div>
<div class="foot">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="215">
<div class="progress">
<div id="progress"></div>
</div>
</td>
<td id="percent"></td>
<td height="40" align="right">

<form action="index.php" method="post" id="dform">
<input type="hidden" name="step" value="3"/>
<input type="button" value="上一步(P)" onclick="history.back(-1);"/>
<input type="submit" value="下一步(N)"<?php if(!$pass) echo ' disabled';?>/>
&nbsp;&nbsp;
<input type="button" value="取消(C)" onclick="if(confirm('您確定要退出安裝嚮導嗎？')) window.close();"/>
</form>
<?php
include IN_ROOT.'/footer.tpl.php';
?>