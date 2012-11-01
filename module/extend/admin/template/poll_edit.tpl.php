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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>票選</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 票選分類</td>
<td><?php echo type_select('poll', 1, 'post[typeid]', '請選擇分類', $typeid, 'id="typeid"');?> <a href="?file=type&item=<?php echo $file;?>" class="t">[管理分類]</a> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 票選標題</td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '級別', $level);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 票選有效期</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> 至 <?php echo dcalendar('post[totime]', $totime);?> <?php echo tips('不填表示不限時間');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 票選說明</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Destoon', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 投票選項限制</td>
<td>
<input name="post[poll_max]" type="text" id="poll_max" size="5" value="<?php echo $poll_max;?>"/> <?php echo tips('填0表示所有項目都可以投票一次，填數字表示最多可以對N個項目投票一次');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 每頁顯示項目</td>
<td>
<input name="post[poll_page]" type="text" id="poll_page" size="5" value="<?php echo $poll_page;?>"/> <?php echo tips('前台顯示時，每頁顯示的項目數量');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 每行顯示項目</td>
<td>
<input name="post[poll_cols]" type="text" id="poll_cols" size="5" value="<?php echo $poll_cols;?>"/> <?php echo tips('前台顯示時，每行顯示的項目數量');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 前台排序方式</td>
<td>
<select name="post[poll_order]">
<option value="0">默認排序</option>
<option value="1"<?php echo $poll_order == 1 ? ' selected' : '';?>>投票次數排序</option>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 標題圖片大小</td>
<td>
<input name="post[thumb_width]" type="text" id="thumb_width" size="5" value="<?php echo $thumb_width;?>"/> X <input name="post[thumb_height]" type="text" id="thumb_height" size="5" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>
<tr title="請保持時間格式">
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
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
<tr>
<td class="tl"><span class="f_hid">*</span> 票選模板</td>
<td><?php echo tpl_select('poll', 'chip', 'post[template_poll]', '默認模板', $template_poll);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 結果模板</td>
<td><?php echo tpl_select('poll', $module, 'post[template]', '默認模板', $template);?></td>
</tr>
<?php if($DT['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地區(分站)</td>
<td><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'typeid';
	l = Dd(f).value;
	if(l == 0) {
		Dmsg('請選擇票選分類', f);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('標題最少2字，當前已輸入'+l+'字', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>