<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">發送郵件</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<input type="hidden" name="preview" id="preview" value="0"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 收件人</td>
<td>
	<input type="radio" name="sendtype" value="1" id="s1" onclick="ck(1);" checked/> <label for="s1">單收件人</label>
	<input type="radio" name="sendtype" value="2" id="s2" onclick="ck(2);"/> <label for="s2">多收件人</label>
	<input type="radio" name="sendtype" value="3" id="s3" onclick="ck(3);"/> <label for="s3">列表群發</label>
</td>
</tr>
<tbody id="t1" style="display:;">
<tr>
<td class="tl"><span class="f_red">*</span> 郵件地址</td>
<td><input type="text" size="30" name="email" value="<?php echo $email;?>"/></td>
</tr>
</tbody>
<tbody id="t2" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> 郵件地址</td>
<td class="f_gray"><textarea name="emails" rows="4" cols="50"></textarea> [一行一個郵件地址]</td>
</tr>
</tbody>
<tbody id="t3" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> 郵件列表</td>
<td class="f_red">
<?php
	$mails = glob(DT_ROOT.'/file/email/*.txt');
	echo '<select name="maillist" id="maillist"><option value="0">請選擇郵件列表</option>';
	if($mails) {
		foreach($mails as $m) {
			$tmp = basename($m);
			echo '<option value="'.$tmp.'">'.$tmp.'</option>';
		}
	} else {
		echo '<option value="">無郵件列表</option>';
	}
	echo '</select>';
?>
&nbsp;&nbsp;<a href="javascript:" onclick="if(Dd('maillist').value != 0){window.open('file/email/'+Dd('maillist').value);}else{alert('請先選擇郵件列表');Dd('maillist').focus();}" class="t">[查看選中]</a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=make" class="t">[獲取列表]</a>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 每輪發送郵件數</td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_red">*</span> 郵件標題</td>
<td><input type="text" size="60" name="title" id="title"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 發件人郵箱</td>
<td><input type="text" size="30" name="sender" id="sender" value="<?php echo $DT['mail_sender'];?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 發件人名稱</td>
<td><input type="text" size="30" name="name" id="name" value="<?php echo $DT['mail_name'];?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 郵件正文</td>
<td>
<textarea name="content" id="content" class="dsn"></textarea><?php echo deditor($moduleid, 'content', 'Destoon', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 選擇模板</td>
<td><?php echo tpl_select('email', 'mail', 'template', '請選擇', '', 'id="template" onchange="Ds(\'fd\');"');?><span id="dtemplate" class="f_red"></span><br/>
<span class="f_gray">
- 模板為模板目錄/mail/目錄下的email模板系列，請在發送之前設置模板內容<br/>
- 模板支持系統變量和會員資料，會員資料保存於$user數組，例如{$user[username]}表示會員名<br/>
- 如果選擇了模板，郵件地址必須是已存在會員的郵件地址，此時郵件標題支持插入變量<br/>
- 如果是給非會員發送郵件，請不要使用變量<br/>
</span>
</td>
</tr>
<tr id="fd" style="display:none;">
<td class="tl"><span class="f_hid">*</span> 郵件字段</td>
<td><input type="text" size="5" name="fields" value="email"/> 需要和郵件導出時一致，默認為email</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn" onclick="Dd('preview').value=0;this.form.target='';"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value=" 預 覽 " class="btn" onclick="Dd('preview').value=1;this.form.target='_blank';"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
var i = 1;
function ck(id) {
	Dd('t'+i).style.display='none';
	Dd('t'+id).style.display='';
	i = id;
}
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('標題最少2字，當前已輸入'+l+'字', f);
		return false;
	}
	f = 'content';
	l = FCKLen();
	if(l < 5 && Dd('template').value == '') {
		Dmsg('內容最少5字，當前已輸入'+l+'字', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>