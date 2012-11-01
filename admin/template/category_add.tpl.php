<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<div class="tt">分類添加</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 上級分類</td>
<td><?php echo category_select('category[parentid]', '請選擇', $parentid, $mid);?><?php tips('如果不選擇，則為頂級分類');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 分類名稱</td>
<td><textarea name="category[catname]"  id="catname" style="width:200px;height:100px;overflow:visible;" onblur="get_letter(this.value);"></textarea><?php tips('允許批量添加，一行一個，點回車換行');?><br/><span id="dcatname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 分類目錄[英文名]</td>
<td><input name="category[catdir]" type="text" id="catdir" size="20" /> <input type="button" class="btn" value="目錄檢測" onclick="ckDir();"><?php tips('限[a-z]、[A-z]、[0-9]、_、- 、/<br/>該分類相關的html文件將保存在此目錄<br/>如果需要生成多級目錄，請用 / 分隔目錄<br/>如果不填寫則自動將分類id作為目錄');?> <span id="dcatdir" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 字母索引</td>
<td><input name="category[letter]" type="text" id="letter" size="2" /><?php tips('填寫分類名稱後系統會自動獲取 如果沒有獲取成功請填寫<br/>例如 分類名稱為 嘉客 則填寫 j');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 級別</td>
<td><input name="category[level]" type="text" size="2" value="1"/><?php tips('0 - 不在首頁顯示 1 - 正常顯示 2 - 首頁和上級分類並列顯示');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 分類模板</td>
<td><?php echo tpl_select('list', $MODULE[$mid]['module'], 'category[template]', '默認模板');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('show', $MODULE[$mid]['module'], 'category[show_template]', '默認模板');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO標題)</td>
<td><input name="category[seo_title]" type="text" size="61"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br/>&nbsp; (網頁關鍵詞)</td>
<td><textarea name="category[seo_keywords]" cols="60" rows="3" id="seo_keywords"></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br/>&nbsp; (網頁描述)</td>
<td><textarea name="category[seo_description]" cols="60" rows="3" id="seo_description"></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 權限設置</td>
<td class="f_blue">如果沒有特殊需要，以下選項不需要設置，全選或全不選均代表擁有對應權限</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允許瀏覽分類</td>
<td><?php echo group_checkbox('category[group_list][]');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允許瀏覽分類信息內容</td>
<td><?php echo group_checkbox('category[group_show][]');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允許發佈信息</td>
<td><?php echo group_checkbox('category[group_add][]');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"/></div>
</form>
<script type="text/javascript">
function ckDir() {
	if(Dd('catdir').value == '') {
		Dtip('請填寫分類目錄');
		Dd('catdir').focus();
		return false;
	}
	var url = '?file=category&action=ckdir&mid=<?php echo $mid;?>&catdir='+Dd('catdir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	if(Dd('catname').value == '') {
		Dmsg('請填寫分類名稱', 'catname');
		return false;
	}
	return true;
}
function get_letter(catname) {
	makeRequest('file=<?php echo $file;?>&mid=<?php echo $mid;?>&action=letter&catname='+catname, '?', '_get_letter');
}
function _get_letter() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			if(Dd('catdir').value == '') Dd('catdir').value = xmlHttp.responseText;
			if(Dd('letter').value == '') Dd('letter').value = xmlHttp.responseText.substr(0,1);
		}
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>