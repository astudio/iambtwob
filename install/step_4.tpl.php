<?php
defined('IN_DESTOON') or exit('Access Denied');
include IN_ROOT.'/header.tpl.php';
?>
<div class="head">
	<div>
		<strong>程序初始化設置</strong><br/>
		配置數據庫連接參數、超級管理員賬號及其他參數
	</div>
</div>
<div class="body">
<div>
<iframe id="db_tester" name="db_tester" style="display:none;"></iframe>
<form action="index.php" method="post" id="db_form" target="db_tester">
<input type="hidden" name="step" value="db_test"/>
<input type="hidden" name="tdb_host" id="tdb_host"/>
<input type="hidden" name="tdb_user" id="tdb_user"/>
<input type="hidden" name="tdb_pass" id="tdb_pass"/>
<input type="hidden" name="tdb_name" id="tdb_name"/>
<input type="hidden" name="ttb_pre" id="ttb_pre"/>
<input type="hidden" name="ttb_test" id="ttb_test"/>
</form>
<script type="text/javascript">
function test() {
	if($('db_host').value == '') {
		alert('請填寫數據庫服務器');
		$('db_host').focus();
		return;
	}
	$('tdb_host').value = $('db_host').value;

	if($('db_user').value == '') {
		alert('請填寫數據庫用戶名');
		$('db_user').focus();
		return;
	}
	$('tdb_user').value = $('db_user').value;
	$('tdb_pass').value = $('db_pass').value;

	if($('db_name').value == '') {
		alert('請填寫數據庫名');
		$('db_name').focus();
		return;
	}
	$('tdb_name').value = $('db_name').value;

	if($('tb_pre').value == '') {
		alert('請填寫數據表前綴');
		$('tb_pre').focus();
		return;
	}
	$('ttb_pre').value = $('tb_pre').value;
	$('db_form').submit();
}
function check() {
	if($('db_host').value == '') {
		alert('請填寫數據庫服務器');
		$('db_host').focus();
		return false;
	}

	if($('db_user').value == '') {
		alert('請填寫數據庫用戶名');
		$('db_user').focus();
		return false;
	}

	if($('db_name').value == '') {
		alert('請填寫數據庫名');
		$('db_name').focus();
		return false;
	}

	if($('tb_pre').value == '') {
		alert('請填寫數據表前綴');
		$('tb_pre').focus();
		return false;
	}

	if($('username').value.length < 4) {
		alert('超級管理員戶名最少4位');
		$('username').focus();
		return false;
	}

	if(!$('username').value.match(/^[a-z0-9]+$/)) {
		alert('超級管理員戶名只能使用小寫字母(a-z)、數字(0-9)');
		$('username').focus();
		return false;
	}

	if($('password').value.length < 6) {
		alert('超級管理員密碼最少6位');
		$('password').focus();
		return false;
	}

	if($('email').value.length < 6) {
		alert('請填寫超級管理員Email[重要]');
		$('email').focus();
		return false;
	}

	var dt_path = '<?php echo $DT_PATH;?>';
	if($('path').value == '') {
		alert('系統安裝路徑不能為空，如果安裝在網站根目錄，請填寫/ ');
		$('path').focus();
		return false;
	}
	if(dt_path && $('path').value != dt_path) {
		if(!confirm('確定要改變系統安裝路徑?')) {
			$('path').value = dt_path;
		}
	}
	var dt_url = '<?php echo $DT_URL;?>';
	if($('url').value == '') {
		alert('網站訪問地址不能為空，請填寫當前網站訪問地址');
		$('url').focus();
		return false;
	}
	if(dt_url && $('url').value != dt_url) {
		if(!confirm('確定要改變網站訪問地址?')) {
			$('url').value = dt_url;
		}
	}

	if($('cookie_pre').value == '') {
		alert('Cookie前綴不能為空');
		$('cookie_pre').focus();
		return false;
	}
	$('tip').style.display = '';
	$('submit').disabled = true;
	return true;
}
</script>
<form action="index.php" method="post" id="dform" onsubmit="return check();">
<input type="hidden" name="step" value="5"/>
<table cellpadding="2" cellspacing="1" width="100%">
<tr>
<td>數據庫服務器</td>
<td><input name="db_host" type="text" id="db_host" value="<?php echo $CFG['db_host'];?>" style="width:150px"/></td>
<td colspan="2">通常為localhost或服務器IP地址</td>
</tr>
<tr>
<td>數據庫用戶名</td>
<td><input name="db_user" type="text" id="db_user" value="<?php echo $CFG['db_user'];?>" style="width:150px"/></td>
<td>數據庫密碼</td>
<td><input name="db_pass" type="text" id="db_pass" value="" style="width:150px"/></td>
</tr>
<tr>
<td>數據庫名</td>
<td><input name="db_name" type="text" id="db_name" value="<?php echo $CFG['db_name'];?>" style="width:150px" onblur="$('ttb_test').value=0;test();void(0);"/></td>
<td>數據表前綴</td>
<td><input name="tb_pre" type="text" id="tb_pre" value="<?php echo $CFG['tb_pre'];?>" style="width:150px"/></td>
</tr>
<tr>
<td colspan="2"><span id="tip" style="color:blue;display:none;"><img src="load.gif" width="10" height="10" align="absmiddle"/> 安裝正在進行，請稍候...</span></td>
<td> </td>
<td><input type="button" value="測試數據庫連接" onclick="$('ttb_test').value=1;test();void(0);"/></td>
</tr>

<tr>
<td>超級管理員戶名</td>
<td><input name="username" type="text" id="username" value="destoon" style="width:150px"/></td>
<td colspan="2">只能使用小寫字母(a-z)、數字(0-9)</td>
</tr>
<tr>
<td>超級管理員密碼</td>
<td><input name="password" type="text" id="password" value="" style="width:150px"/></td>
<td colspan="2">建議使用6位以上數字、字母、特殊符號組合</td>
</tr>

<tr>
<td>超級管理員Email</td>
<td><input name="email" type="text" id="email" value="admin@admin.com" style="width:150px"/></td>
<td>Cookie前綴</td>
<td title="字母開頭，_結尾，隨機生成，一般無須修改"><input name="cookie_pre" type="text" id="cookie_pre"  value="<?php echo $CFG['cookie_pre'];?>" style="width:150px"/></td>
</tr>
<tr title="系統自動識別，如無錯誤，請勿修改">
<td>系統安裝路徑</td>
<td><input name="path" type="text" id="path" value="<?php echo $DT_PATH;?>" style="width:150px"/></td>
<td>網站訪問地址</td>
<td><input name="url" type="text" id="url" value="<?php echo $DT_URL;?>" style="width:150px"/></td>
</tr>

</table>

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
<input type="button" value="上一步(P)" onclick="history.back(-1);"/>
<input type="submit" value="下一步(N)" id="submit"/>
&nbsp;&nbsp;
<input type="button" value="取消(C)" onclick="if(confirm('您確定要退出安裝嚮導嗎？')) window.close();"/>
</form>
<?php
include IN_ROOT.'/footer.tpl.php';
?>