<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">發送短信</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<input type="hidden" name="preview" id="preview" value="0"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 收信人</td>
<td>
	<input type="radio" name="sendtype" value="1" id="s1" onclick="ck(1);" checked/> <label for="s1">單收信人</label>
	<input type="radio" name="sendtype" value="2" id="s2" onclick="ck(2);"/> <label for="s2">多收信人</label>
	<input type="radio" name="sendtype" value="3" id="s3" onclick="ck(3);"/> <label for="s3">列表群發</label>
</td>
</tr>
<tbody id="t1" style="display:;">
<tr>
<td class="tl"><span class="f_red">*</span> 接收號碼</td>
<td><input type="text" size="35" name="mobile" value="<?php echo $mobile;?>"/></td>
</tr>
</tbody>
<tbody id="t2" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> 接收號碼</td>
<td class="f_gray"><textarea name="mobiles" rows="4" cols="35"></textarea><br/>[一行一個接收號碼]</td>
</tr>
</tbody>
<tbody id="t3" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> 號碼列表</td>
<td class="f_red">
<?php
	echo '<select name="mobilelist" id="mobilelist"><option value="0">請選擇號碼列表</option>';
	$mails = glob(DT_ROOT.'/file/mobile/*.txt');
	if($mails) {
		foreach($mails as $m) {
			$tmp = basename($m);
			echo '<option value="'.$tmp.'">'.$tmp.'</option>';
		}
	} else {
		echo '<option value="">無號碼列表</option>';
	}
	echo '</select>';
?>
&nbsp;&nbsp;<a href="javascript:" onclick="if(Dd('mobilelist').value != 0){window.open('file/mobile/'+Dd('mobilelist').value);}else{alert('請先選擇號碼列表');Dd('mobilelist').focus();}" class="t">[查看選中]</a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=make" class="t">[獲取列表]</a>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 每輪發送短信數</td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_red">*</span> 短信內容</td>
<td>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" width="250"><textarea name="content" id="content" rows="15" cols="35" onkeyup="S();" onblur="S();"></textarea></td>
<td valign="top" class="f_gray"><br/>
- 當前已輸入<strong id="len1">0</strong>字，簽名<strong id="len2">0</strong>字，共<strong id="len3" class="f_red">0</strong>字，分<strong id="len4" class="f_blue">0</strong>條短信 (<?php echo $DT['sms_len'];?>字/條)<br/>
- 以上分條僅為系統估算，實際分條以運營商返回數據為準<br/>
- 內容支持變量，會員資料保存於$user數組<br/>
- 例 {$user[username]} 表示會員名<br/>
- 例 {$user[company]} 表示公司名<br/>
- 如果是給非會員發送短信，請不要使用變量<br/>
<?php if(!$DT['sms'] || !$DT['sms_uid'] || !$DT['sms_key']) { ?>
<span class="f_red">- 注意：無法發送，未設置發送參數</span> <a href="?file=setting" class="t">點此設置</a><br/>
<?php } ?>
<span id="dcontent" class="f_red"></span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 短信簽名</td>
<td><input type="text" size="35" name="sign" id="sign" value="<?php echo $DT['sms_sign'];?>" onkeyup="S();" onblur="S();"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn" onclick="Dd('preview').value=0;this.form.target='';"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value=" 預 覽 " class="btn" onclick="Dd('preview').value=1;this.form.target='_blank';"/></div>
</form>
<script type="text/javascript">
var sms_len = <?php echo $DT['sms_len'];?>;
function S() {
	var sms_sign = Dd('sign').value;
	var len_1 = Dd('content').value.length;
	var len_2 = sms_sign.length;
	Dd('len1').innerHTML = len_1;
	Dd('len2').innerHTML = len_2;
	Dd('len3').innerHTML = len_1+len_2;
	Dd('len4').innerHTML = Math.ceil((len_1+len_2)/sms_len);
}
S();
var i = 1;
function ck(id) {
	Dd('t'+i).style.display='none';
	Dd('t'+id).style.display='';
	i = id;
}
function check() {
	var l;
	var f;
	f = 'content';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('內容不能為空', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>