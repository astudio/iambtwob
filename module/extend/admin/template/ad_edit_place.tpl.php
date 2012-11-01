<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="runcode_form" target="_blank">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="runcode"/>
<input type="hidden" name="codes" value=""/>
</form>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="pid" value="<?php echo $pid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">修改廣告位</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">廣告位ID</td>
<td><input name="place[pid]" type="text" size="5" value="<?php echo $pid;?>"/> <a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>" target="_blank" class="t">[查看]</a>
<br/><span class="f_gray">[注意]修改廣告位ID可以恢復誤刪除的廣告位。但如果填寫的ID存在，可能導致一個SQL錯誤</span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 廣告位名稱</td>
<td><input name="place[name]" id="name" type="text" size="30" value="<?php echo $name;?>"/> <?php echo dstyle('place[style]', $style);?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">廣告位示意圖</td>
<td><input name="place[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,0,0, Dd('thumb').value,true);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span></td>
</tr>
<tr>
<td class="tl">廣告位介紹</td>
<td><input name="place[introduce]" type="text" size="60" value="<?php echo $introduce;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 廣告位類型</td>
<td>
<?php foreach($TYPE as $k=>$v) {
	if($k) echo '<input name="place[typeid]" type="radio" value="'.$k.'" '.($k == $typeid ? 'checked' : '').' id="p'.$k.'" onclick="sh('.$k.');"/> <label for="p'.$k.'">'.$v.'&nbsp;</label>';
}
?>
<br/><span class="f_gray">[注意] 如果修改了廣告位類型，請務必修改此廣告位下所有廣告</span>
</td>
</tr>
<tr id="wh" style="display:<?php echo $typeid == 3 || $typeid == 4 || $typeid == 5 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 廣告位大小</td>
<td><input name="place[width]" id="width" type="text" size="5" value="<?php echo $width;?>"/> X <input name="place[height]" id="height" type="text" size="5" value="<?php echo $height;?>"/> <span class="f_gray">[寬 X 高 px]</span> <span id="dsize" class="f_red"></span>
</td>
</tr>
<tr id="md" style="display:<?php echo $typeid == 6 || $typeid == 7 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 所屬模塊</td>
<td><?php echo module_select('place[moduleid]', '請選擇', $mid, 'id="mids"');?> <span id="dmids" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 廣告位價格</td>
<td><input name="place[price]" type="text" size="5" value="<?php echo $price;?>"/> <?php echo $unit;?>/月 <span class="f_gray">[0或不填表示待議]</span></td>
</tr>
<tr>
<td class="tl">默認廣告代碼</td>
<td><textarea name="place[code]" id="code" style="width:98%;height:50px;overflow:visible;font-family:Fixedsys,verdana;"><?php echo $code;?></textarea><br/>
<input type="button" value=" 運行代碼 " class="btn" onclick="runcode();"/><span class="f_gray">&nbsp;當廣告位下無廣告時，顯示此代碼，支持html、css、js 如果廣告位採用js調用，此處不建議使用js代碼</span><span id="dcode" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">網站前台顯示</td>
<td>
<input type="radio" name="place[open]" value="1" <?php if($open) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="place[open]" value="0" <?php if(!$open) echo 'checked';?>/> 否
<span class="f_gray">如果選擇否，將不在前台廣告列表裡顯示，此時會員不能在線訂購，並非不顯示廣告</span>
</td>
</tr>
<tr>
<td class="tl">廣告代碼模板</td>
<td><?php echo tpl_select('ad_code', $module, 'place[template]', '默認模板', $template, 'id="template"');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function sh(id) {
	if(id == 6 || id == 7) {
		Ds('md');Dh('wh');
	} else if(id == 3 || id == 4 || id == 5) {
		Dh('md');Ds('wh');
	} else {
		Dh('md');Dh('wh');
	}
}
function check() {
	var l;
	var f;
	f = 'name';
	l = Dd(f).value.length;
	if(l < 1) {
		Dmsg('請填寫廣告位名稱', f);
		return false;
	}
	if(Dd('p3').checked || Dd('p4').checked || Dd('p5').checked) {
		if(Dd('width').value.length < 2 || Dd('height').value.length < 2) {
			Dmsg('請填寫廣告位大小', 'size');
			return false;
		}
	}
	if(Dd('p6').checked || Dd('p7').checked) {
		if(Dd('mids').value == 0) {
			Dmsg('請選擇所屬模塊', 'mids');
			return false;
		}
	}
	return true;
}
function runcode() {
	if(Dd('code').value.length < 3) {
		Dmsg('請填寫代碼', 'code');
		return false;
	}
	Dd('codes').value = Dd('code').value;
	Dd('runcode_form').submit();
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>