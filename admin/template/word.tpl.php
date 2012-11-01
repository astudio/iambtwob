<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($submit) { ?>
<div class="tt">保存成功</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> HTML代碼</td>
<td><textarea name="content" id="content" style="width:600px;height:150px;margin:3px;font-family:Fixedsys,verdana;"><?php echo $content;?></textarea>
</td>
</tr>
<tr>
<td></td>
<td>
<input type="button" value="復 制" class="btn" onclick="CopyCode();"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="返 回" class="btn" onclick="Go('?file=<?php echo $file;?>&rand=<?php echo $DT_TIME;?>');"/>&nbsp;&nbsp;
提示：複製代碼之後，切換編輯器到源代碼模式後粘貼即可
</td>
</tr>
</table>
<div class="tt">效果預覽</div>
<div style="padding:10px;background:#FFFFFF;font-size:14px;"><?php echo $content;?></div>
<script type="text/javascript">
function CopyCode() {
	Dd('content').select();
	if(isIE) {
		clipboardData.setData('text', Dd('content').value);
	} else {
		confirm('您的瀏覽器不支持JS複製，請按Ctrl+C複製');
	}
}
</script>
<?php } else { ?>
<div class="tt">什麼是編輯助手？</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td style="padding:3px 10px 3px 10px;line-height:22px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;當您使用word製作了一篇圖文並茂的文檔，通過後台發佈時，發現文檔內容裡的圖片並不能直接粘貼到編輯器裡。由於word的加密方式不公開，在不安裝插件的情況下，常規的方法目前無法有效的解決此問題。於是一張一張的上傳佔用了您大量的寶貴時間……<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;編輯助手可以通過以下三步幫您快速解決此問題：<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1、複製一份您的word文件，然後修改新的文件名為英文和數字格式(注意：中文的文件名可能無法被助手識別)，例如「word.doc」；<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、雙擊打開新的word文件，點擊文件，選擇另存為，保存類型選擇「網頁 (*.htm，*.html)」；<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、假如您的word文件名為word.doc，通過另存後，會生成一個word.htm文件和一個word.files目錄，選擇這個文件和目錄壓縮為.zip格式文件，在下面上傳；<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;小提示：本工具同樣可以處理您製作的或從網上另存的htm靜態頁面，原理是相同的。<br/>
</td>
</tr>
</table>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<div class="tt">上傳zip壓縮文件</div>
<form method="post" action="?" enctype="multipart/form-data" target="send" onsubmit="return Upcheck();" id="up">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="upload"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 選擇文件</td>
<td>
&nbsp;<input name="uploadfile" id="uploadfile" type="file" size="25" onchange="Upcheck();Dd('up').submit();"/>&nbsp;&nbsp;
<input type="submit" value=" 上 傳 " class="btn" id="upbtn"/>
</td>
</tr>
</table>
</form>
<div style="display:none;" id="maindiv">
<div class="tt">上傳成功</div>
<form method="post" action="?" onsubmit="return WdCheck();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="word" id="word" value=""/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 讀取文件</td>
<td>
&nbsp;
<select name="wd_charset" id="wd_charset">
<option value="gbk">GBK編碼</option>
<option value="utf-8">UTF-8編碼</option>
</select>&nbsp;
<input name="wd_nr" id="wd_nr" type="checkbox" value="1" checked/> <label for="wd_nr">過濾空行</label>&nbsp;
<input name="wd_note" id="wd_note" type="checkbox" value="1" checked/> <label for="wd_note">過濾註釋</label>&nbsp;
<input name="wd_span" id="wd_span" type="checkbox" value="1" checked/> <label for="wd_span">過濾span</label>&nbsp;
<input name="wd_style" id="wd_style" type="checkbox" value="1" checked/> <label for="wd_style">過濾style</label>&nbsp;
<input name="wd_class" id="wd_class" type="checkbox" value="1" checked/> <label for="wd_class">過濾class</label>&nbsp;
<input type="button" value=" 讀 取 " class="btn" onclick="ReadWord();"/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> HTML代碼</td>
<td><textarea name="content" id="content" style="width:600px;height:150px;margin:8px;font-family:Fixedsys,verdana;"></textarea>
</td>
</tr>
<tr>
<td></td>
<td><input type="checkbox" name="water" value="1" checked/> 圖片添加水印&nbsp;&nbsp;<input type="submit" name="submit" value="保 存" class="btn" id="save"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="預 覽" class="btn" onclick="RunCode();"/></td>
</tr>
</table>
</form>
<form method="post" action="?" id="runcode_form" target="_blank">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="run"/>
<input type="hidden" name="code" id="code" value=""/>
<input type="hidden" name="temp" id="temp" value=""/>
</form>
</div>
<script type="text/javascript">
function Upcheck() {
	Dh('maindiv');
	if(Dd('uploadfile').value=='') {
		alert('請選擇zip文件');
		return false;
	}
	Dd('upbtn').value = '上傳中..';
}
function Upsuccess(s) {
	Ds('maindiv');
	Dd('word').value = s;
	Dd('up').reset();
	Dd('upbtn').value = '上 傳';
	ReadWord();
}
function ReadWord() {
	var p = 'file=<?php echo $file;?>&action=read&word='+Dd('word').value+'&charset='+Dd('wd_charset').value;
	p += '&wd_nr='+(Dd('wd_nr').checked ? 1 : 0);
	p += '&wd_note='+(Dd('wd_note').checked ? 1 : 0);
	p += '&wd_span='+(Dd('wd_span').checked ? 1 : 0);
	p += '&wd_style='+(Dd('wd_style').checked ? 1 : 0);
	p += '&wd_class='+(Dd('wd_class').checked ? 1 : 0);
	makeRequest(p, '?', '_ReadWord');
}
function _ReadWord() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Dd('content').value = xmlHttp.responseText;
		} else {
			alert('抱歉，讀取失敗，請檢查壓縮包內的htm文件');
		}
	}
}
function RunCode() {
	if(Dd('content').value == '') {
		if(confirm('您還沒有讀取文件，是否現在讀取？')) ReadWord();
		return false;
	}
	Dd('code').value = Dd('content').value;
	Dd('temp').value = Dd('word').value;
	Dd('runcode_form').submit();
}
function WdCheck() {
	if(Dd('content').value == '') {
		if(confirm('您還沒有讀取文件，是否現在讀取？')) ReadWord();
		return false;
	}
	Dd('save').value = '處理中..';
}
</script>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>