<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 所屬分類</td>
<td><?php echo $_admin == 1 ? category_select('post[catid]', '選擇分類', $catid, $moduleid) : ajax_category_select('post[catid]', '選擇分類', $catid, $moduleid);?> <span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>名稱</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '級別', $level, 'id="level"');?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 封面圖片</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,Dd('level').value==2 ? 300 : <?php echo $MOD['thumb_width'];?>,Dd('level').value==2 ? 225 : <?php echo $MOD['thumb_height'];?>,Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span><span id="dthumb" class="f_red"></span></td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 1;
</script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/property.js"></script>
<?php if($itemid) { ?><script type="text/javascript">setTimeout("load_property()", 1000);</script><?php } ?>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>說明</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?> id="status_3"/><label for="status_3"> 通過</label>
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?> id="status_2"/><label for="status_2">  待審</label>
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';" id="status_1"/><label for="status_1">  拒絕</label>
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?> id="status_0"/><label for="status_0">  刪除</label>
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 拒絕理由</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公開程度</td>
<td class="tr">
<input type="radio" name="post[open]" value="3" <?php if($open == 3) echo 'checked';?> id="o_3" onclick="Dh('op_2');Dh('op_1');"/><label for="o_3"> 開放</label>
<input type="radio" name="post[open]" value="2" <?php if($open == 2) echo 'checked';?> id="o_2" onclick="Ds('op_2');Dh('op_1');"/><label for="o_2"> 密碼驗證</label>
<input type="radio" name="post[open]" value="1" <?php if($open == 1) echo 'checked';?> id="o_1" onclick="Dh('op_2');Ds('op_1');"/><label for="o_1"> 問題驗證</label>
</td>
</tr>

<tr id="op_2" style="display:<?php echo $open == 2 ? '' : 'none';?>;">
<td class="tl"><span class="f_red">*</span> 驗證密碼</td>
<td class="tr"><input name="post[password]" type="text" id="password" size="30" value="<?php echo $password;?>"/> <span id="dpassword" class="f_red"></span></td>
</tr>

<tr id="op_1" style="display:<?php echo $open == 1 ? '' : 'none';?>;">
<td class="tl"><span class="f_red">*</span> 驗證問題</td>
<td class="tr"><input name="post[question]" type="text" id="question" size="30" value="<?php echo $question;?>"/> 
答案 <input name="post[answer]" type="text" id="answer" size="30" value="<?php echo $answer;?>"/> <span id="dqa" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<?php if($DT['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地區(分站)</td>
<td><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 瀏覽次數</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容收費</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('不填或填0表示繼承模塊設置價格，-1表示不收費<br/>大於0的數字表示具體收費價格');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('show', $module, 'post[template]', '默認模板', $template, 'id="template"');?><?php tips('如果沒有特殊需要，一般不需要選擇<br/>系統會自動繼承分類或模塊設置');?></td>
</tr>
<?php if($MOD['show_html']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 自定義文件路徑</td>
<td><input type="text" size="50" name="post[filepath]" value="<?php echo $filepath;?>" id="filepath"/>&nbsp;<input type="button" value="重名檢測" onclick="ckpath(<?php echo $moduleid;?>, <?php echo $itemid;?>);" class="btn"/>&nbsp;<?php tips('可以包含目錄和文件 例如 destoon/b2b.html<br/>請確保目錄和文件名合法且可寫入，否則可能生成失敗');?>&nbsp; <span id="dfilepath" class="f_red"></span></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" <?php echo $action == 'add' ? '下一步' : '確 定';?> " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">單頁采編</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 目標網址</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" 獲 取 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 管理規則 " class="btn" onclick="window.open('?file=fetch');"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('請選擇所屬分類', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('標題最少2字，當前已輸入'+l+'字', f);
		return false;
	}
	f = 'thumb';
	l = Dd(f).value.length;
	if(l < 10) {
		Dmsg('請上傳封面圖片', f);
		return false;
	}
	if(Dd('o_2').checked) {
		f = 'password';
		l = Dd(f).value.length;
		if(l < 1) {
			Dmsg('請填寫密碼', f);
			return false;
		}
	}
	if(Dd('o_1').checked) {
		f = 'question';
		l = Dd(f).value.length;
		if(l < 1) {
			Dmsg('請填寫問題', 'qa');
			return false;
		}
		f = 'answer';
		l = Dd(f).value.length;
		if(l < 1) {
			Dmsg('請填寫答案', 'qa');
			return false;
		}
	}
	<?php echo $FD ? fields_js() : '';?>
	if(Dd('property_require') != null) {
		var ptrs = Dd('property_require').getElementsByTagName('option');
		for(var i = 0; i < ptrs.length; i++) {		
			f = 'property-'+ptrs[i].value;
			if(Dd(f).value == 0 || Dd(f).value == '') {
				Dmsg('請填寫或選擇'+ptrs[i].innerHTML, f);
				return false;
			}
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>