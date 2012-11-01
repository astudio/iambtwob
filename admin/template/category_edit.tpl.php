<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="catid" value="<?php echo $catid;?>"/>
<div class="tt">分類修改</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 上級分類</td>
<td><?php echo category_select('category[parentid]', '請選擇', $parentid, $mid);?><?php tips('如果不選擇，則為頂級分類');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 分類名稱</td>
<td><input name="category[catname]" type="text" id="catname" size="20" value="<?php echo $catname;?>"/> <?php echo dstyle('category[style]', $style);?> <span id="dcatname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 分類目錄[英文名]</td>
<td><input name="category[catdir]" type="text" id="catdir" size="20" value="<?php echo $catdir;?>"/><?php tips('限英文、數字、中劃線、下劃線，該分類相關的html文件將保存在此目錄');?> <span id="dcatdir" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 字母索引</td>
<td><input name="category[letter]" type="text" id="letter" size="2" value="<?php echo $letter;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 級別</td>
<td><input name="category[level]" type="text" size="2" value="<?php echo $level;?>"/><?php tips('0 - 不在首頁顯示 1 - 正常顯示 2 - 首頁和上級分類並列顯示');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 分類模板</td>
<td><?php echo tpl_select('list', $MODULE[$mid]['module'], 'category[template]', '默認模板', $template);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('show', $MODULE[$mid]['module'], 'category[show_template]', '默認模板', $show_template);?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO標題)</td>
<td><input name="category[seo_title]" type="text" id="seo_title" value="<?php echo $seo_title;?>" size="61"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br/>&nbsp; (網頁關鍵詞)</td>
<td><textarea name="category[seo_keywords]" cols="60" rows="3" id="seo_keywords"><?php echo $seo_keywords;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br/>&nbsp; (網頁描述)</td>
<td><textarea name="category[seo_description]" cols="60" rows="3" id="seo_description"><?php echo $seo_description;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 權限設置</td>
<td class="f_blue">如果沒有特殊需要，以下選項不需要設置，全選或全不選均代表擁有對應權限</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允許瀏覽分類</td>
<td><?php echo group_checkbox('category[group_list][]', $group_list);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允許瀏覽分類信息內容</td>
<td><?php echo group_checkbox('category[group_show][]', $group_show);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允許發佈信息</td>
<td><?php echo group_checkbox('category[group_add][]', $group_add);?></td>
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
	if(Dd('catdir').value == '') {
		Dmsg('請填寫分類目錄', 'catdir');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>