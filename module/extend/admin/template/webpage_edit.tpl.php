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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>單頁</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 單頁標題</td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '級別', $level);?> &nbsp;<input type="checkbox" name="post[islink]" value="1" id="islink" onclick="_islink();"  <?php if($islink) echo 'checked';?>/> 外部鏈接 <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr id="link" style="display:<?php echo $islink ? '' : 'none';?>;">
<td class="tl"><span class="f_red">*</span> 鏈接地址</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="50" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<tbody id="basic" style="display:<?php echo $islink ? 'none' : '';?>;">
<tr>
<td class="tl"><span class="f_hid">*</span> 單頁內容</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Default', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl" height="30"><span class="f_hid">*</span> 內容選項</td>
<td><input type="checkbox" name="post[save_remotepic]" value="1"/> 下載內容遠程圖片
<input type="checkbox" name="post[clear_link]" value="1"/> 清除內容鏈接
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 保存路徑</td>
<td><input name="post[filepath]" type="text" size="20" value="<?php echo $filepath;?>"/> <span class="f_gray">如不填寫則生成在網站根目錄，否則請以『/』結尾，例如『about/』</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 文件名稱</td>
<td><input name="post[filename]" type="text" size="20" value="<?php echo $filename;?>"/> <span class="f_gray">如不填寫則自動按ID生成文件名，例如『page-1.html』</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 綁定域名</td>
<td><input name="post[domain]" type="text" size="60" value="<?php echo $domain;?>"/><?php tips('例如設置的生成路徑為machine/index.html<br/>那麼可以綁定machine.xxx.com至machine目錄<br/>此處填寫http://machine.xxx.com/');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO標題</td>
<td><input name="post[seo_title]" type="text" size="60" value="<?php echo $seo_title;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO關鍵詞</td>
<td><input name="post[seo_keywords]" type="text" size="60" value="<?php echo $seo_keywords;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO描述</td>
<td><input name="post[seo_description]" type="text" size="60" value="<?php echo $seo_description;?>"/></td>
</tr>
</tbody>
<?php if($DT['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地區(分站)</td>
<td><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 分組標識</td>
<td><input name="post[item]" type="text" size="10" value="<?php echo $item;?>"/><?php tips('單頁的分組標識，如果不理解含義，請勿修改');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('webpage', $module, 'post[template]', '默認模板', $template);?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('標題最少2字，當前已輸入'+l+'字', f);
		return false;
	}
	if(Dd('islink').checked) {
		f = 'linkurl';
		l = Dd(f).value.length;
		if(l < 12) {
			Dmsg('請輸入正確的鏈接地址', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>