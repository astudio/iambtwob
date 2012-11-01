<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">分站添加</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 所在地區</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 分站名稱</td>
<td><input name="post[name]" type="text" id="name" size="20" value="<?php echo $name;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 綁定域名</td>
<td><input name="post[domain]" type="text" size="40" value="<?php echo $domain;?>"/><?php tips('例如http://xian.destoon.com/,以 / 結尾<br/>同時在服務器端綁定此域名至網站根目錄，如果不綁定請勿填寫');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> IP地址名稱</td>
<td><input name="post[iparea]" type="text" size="60" value="<?php echo $iparea;?>"/><?php tips('一般為常見城市名稱，多個地名用|分割。例如開通的是廣東分站，可以填寫廣州|深圳|佛山等，系統將根據這些名稱按IP地址自動跳轉分站');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 字母索引</td>
<td><input name="post[letter]" type="text" id="letter" size="4" value="<?php echo $letter;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 排序</td>
<td><input name="post[listorder]" type="text" id="listorder" size="4" value="<?php echo $listorder;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 分站首頁模板</td>
<td><?php echo tpl_select('index', 'city', 'post[template]', '默認模板', $template);?><?php tips('請在模板目錄city目錄裡建立index-xxx.htm規則的模板，然後在此選擇。模板內容請參考網站首頁模板。如果不選擇，系統默認使用網站首頁模板。');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO標題)</td>
<td><input name="post[seo_title]" type="text" id="seo_title" value="<?php echo $seo_title;?>" size="61"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br/>&nbsp;&nbsp;(網頁關鍵詞)</td>
<td><textarea name="post[seo_keywords]" cols="60" rows="3" id="seo_keywords"><?php echo $seo_keywords;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br/>&nbsp;&nbsp;(網頁描述)</td>
<td><textarea name="post[seo_description]" cols="60" rows="3" id="seo_description"><?php echo $seo_description;?></textarea></td>
</tr>
</table>


<div class="sbt"><input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('areaid_1').value == 0) {
		Dmsg('請選擇所在地區', 'areaid', 1);
		return false;
	}
	if(Dd('name').value == '') {
		Dmsg('請填寫分站名稱', 'name');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>