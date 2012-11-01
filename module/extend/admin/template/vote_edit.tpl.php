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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>投票</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 投票分類</td>
<td><?php echo type_select('vote', 1, 'post[typeid]', '請選擇分類', $typeid, 'id="typeid"');?> <a href="?file=type&item=<?php echo $file;?>" class="t">[管理分類]</a> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 投票標題</td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '級別', $level);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 投票有效期</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> 至 <?php echo dcalendar('post[totime]', $totime);?> <?php echo tips('不填表示不限時間');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 鏈接至</td>
<td><input name="post[linkto]" type="text" id="linkto" size="50" value="<?php echo $linkto;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 投票說明</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Destoon', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 投票類別</td>
<td>
<input type="radio" name="post[choose]" value="0" id="choose_0"<?php if(!$choose) echo ' checked';?> onclick="Dh('vote_num');"/><label for="choose_0"> 單選</label>
<input type="radio" name="post[choose]" value="1" id="choose_1"<?php if($choose) echo ' checked';?> onclick="Ds('vote_num');"/><label for="choose_1"> 多選</label>
</td>
</tr>

<tr id="vote_num" style="display:<?php echo $choose ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 必選數量</td>
<td>
<input name="post[vote_min]" type="text" id="vote_min" size="5" value="<?php echo $vote_min;?>"/>
至
<input name="post[vote_max]" type="text" id="vote_max" size="5" value="<?php echo $vote_max;?>"/>
</td>
</tr>
<?php for($i=1;$i<11;$i++) { $s = 's'.$i; ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 投票主題<?php echo $i;?></td>
<td><input name="post[s<?php echo $i;?>]" type="text" id="s<?php echo $i;?>" size="50" value="<?php echo $$s;?>"/></td>
</tr>
<?php } ?>
<tr title="請保持時間格式">
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 投票模板</td>
<td><?php echo tpl_select('vote', 'chip', 'post[template_vote]', '默認模板', $template_vote);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 結果模板</td>
<td><?php echo tpl_select('vote', $module, 'post[template]', '默認模板', $template);?></td>
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
		Dmsg('請選擇投票分類', f);
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