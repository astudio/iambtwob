<?php
defined('IN_DESTOON') or exit('Access Denied');
include IN_ROOT.'/header.tpl.php';
?>
<div class="head">
	<div>
		<strong>檢查目錄/文件屬性</strong><br/>
		檢查需要寫操作的目錄/文件是否有寫操作權限
	</div>
</div>
<div class="body">
<div>
	<table cellpadding="4" cellspacing="1" width="100%" bgcolor="#F1F1F1">
	<tr bgcolor="#C0C0C0" align="center">
	<td width="15%">目錄/文件</td>
	<td width="8%">屬性</td>
	<td width="15%">目錄/文件</td>
	<td width="8%">屬性</td>
	<td width="15%">目錄/文件</td>
	<td width="8%">屬性</td>
	</tr>
	<?php foreach($FILES as $k=>$v) { ?>
	<?php if($k%3 == 0) { ?>
	<tr bgcolor="#D4D0C8" align="center">
	<?php } ?>
	<td align="left">&nbsp;<?php echo $v['name'];?></td>
	<td><?php echo $v['write'] ? '<span style="color:blue;">可寫</span>' : '<span style="color:red;">不可寫</span>';?></td>
	<?php if($k%3 == 2) { ?>
	</tr>
	<?php } ?>
	<?php } ?>
	</table>
	<br/>
	<?php
	if($pass) {
		echo '&nbsp;&nbsp;目錄/文件屬性通過檢測，請點 下一步(N) 繼續安裝';
	} else {
		echo '<br/>&nbsp;&nbsp;<span style="color:red;">目錄/文件屬性未通過檢測，安裝無法進行!</span> <br/><br/>&nbsp;&nbsp;';
		if($ISWIN) {
			echo '請設置不可寫目錄/文件(含子目錄及文件)寫入權限';
		} else {
			echo '請設置不可寫目錄/文件(含子目錄及文件)屬性為可寫('.sprintf('%o', DT_CHMOD).')';
		}
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
<input type="hidden" name="step" value="4"/>
<input type="button" value="上一步(P)" onclick="history.back(-1);"/>
<input type="submit" value="下一步(N)"<?php if(!$pass) echo ' disabled';?>/>
&nbsp;&nbsp;
<input type="button" value="取消(C)" onclick="if(confirm('您確定要退出安裝嚮導嗎？')) window.close();"/>
</form>
<?php
include IN_ROOT.'/footer.tpl.php';
?>