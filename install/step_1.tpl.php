<?php
defined('IN_DESTOON') or exit('Access Denied');
include IN_ROOT.'/header.tpl.php';
?>
<noscript><br/><br/><center><h3>您的瀏覽器不支持JavaScript,請更換支持JavaScript的瀏覽器</h1></center><br/><br/></noscript>
<div class="head">
	<div>
		<strong>歡迎使用，Destoon B2B網站管理系統V<?php echo DT_VERSION;?> <?php echo strtoupper($CFG['charset']);?> 安裝嚮導</strong><br/>
		請仔細閱讀以下軟件使用協議，在理解並同意協議的基礎上安裝本軟件
	</div>
</div>
<div class="body">
<div>
<textarea style="width:100%;height:190px;margin:0 0 10px 0;">
<?php echo $license;?>
</textarea>
<strong style="color:red;">注意</strong>：本軟件僅限個人免費使用，非個人用戶(公司、協會、政府部門等)必須購買授權後正式建站
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
<input type="hidden" name="step" value="2"/>
<input type="submit" value="我同意(10)" id="read" disabled/>
<input type="button" value="打印(P)" onclick="Print();"/>
&nbsp;&nbsp;
<input type="button" value="取消(C)" onclick="if(confirm('您確定要退出安裝嚮導嗎？')) window.close();"/>
</form>
<textarea style="display:none;" id="license">
<?php echo nl2br($license);?>
</textarea>
<script type="text/javascript">
function Print() {
	var w = window.open('','','');
	w.opener = null;
	w.document.write('<html><head><meta http-equiv="Content-Type" content="text/html;charset=utf-8" /></head><body><div style="width:650px;font-size:10pt;line-height:19px;font-family:Verdana,Arial;">'+$('license').value+'</div></body></html>');
	w.window.print();
}
var i = 9;
var interval=window.setInterval(
	function() {
		if(i == 0) {
			$('read').value = '我同意(I)';
			$('read').disabled = false;
		} else {
			$('read').value = '我同意('+i+')';
			i--;
		}
	}, 
1000);
</script>
<?php
include IN_ROOT.'/footer.tpl.php';
?>
<script type="text/javascript" src="http://www.destoon.com/install.php?release=<?php echo DT_RELEASE;?>&charset=<?php echo $CFG['charset'];?>&domain=<?php echo urlencode(get_env('url'));?>"></script>