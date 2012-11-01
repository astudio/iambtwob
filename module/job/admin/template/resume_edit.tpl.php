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
<td class="tl"><span class="f_red">*</span> 簡歷名稱</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '級別', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>


<tr>
<td class="tl"><span class="f_red">*</span> 行業/職位</td>
<td><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '', $catid, $moduleid, 'size="2" style="height:120px;width:180px;"');?><br/><input type="button" value="搜索分類" onclick="schcate(<?php echo $moduleid;?>);" class="btn"/> <span id="dcatid" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 真實姓名</td>
<td><input name="post[truename]" type="text" id="truename" size="20" value="<?php echo $truename;?>"/> <br/><span id="dtruename" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 免冠照片</td>
<td><input name="post[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 性別</td>
<td>
<?php
foreach($GENDER as $k=>$v) {
	if($k == 0) continue;
?>
<input type="radio" name="post[gender]" id="gender_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $gender ? ' checked' : '';?>/><label for="gender_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 婚姻狀況</td>
<td>
<?php
foreach($MARRIAGE as $k=>$v) {
	if($k == 0) continue;
?>
<input type="radio" name="post[marriage]" id="marriage_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $marriage ? ' checked' : '';?>/><label for="marriage_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 現居住地</td>
<td><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 生日</td>
<td>
<input name="post[byear]" type="text" id="byear" size="4" value="<?php echo $byear;?>"/> 年
<select name="post[bmonth]">
<?php for($i = 1; $i < 13; $i++) {
	echo '<option value="'.$i.'"'.($i == $bmonth ? ' selected' : '').'>'.$i.'</option>';
}
?>
</select>
月
<select name="post[bday]">
<?php for($i = 1; $i < 32; $i++) {
	echo '<option value="'.$i.'"'.($i == $bday ? ' selected' : '').'>'.$i.'</option>';
}
?>
</select>
日

<span id="dbyear" class="f_red"></span>
</td>
</tr>


<tr>
<td class="tl"><span class="f_hid">*</span> 身高</td>
<td><input name="post[height]" type="text" id="height" size="10"  value="<?php echo $height;?>"/> cm <span id="dheight" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 體重</td>
<td><input name="post[weight]" type="text" id="weight" size="10" value="<?php echo $weight;?>"/> kg <span id="dweight" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 學歷</td>
<td>
<?php
foreach($EDUCATION as $k=>$v) {
	if($k == 0) continue;
?>
<input type="radio" name="post[education]" id="education_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $education ? ' checked' : '';?>/><label for="education_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
&nbsp;&nbsp;(以上)
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 畢業院校</td>
<td><input name="post[school]" type="text" id="school" size="30" value="<?php echo $school;?>"/> <span id="dschool" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 所學專業</td>
<td><input name="post[major]" type="text" id="major" size="30" value="<?php echo $major;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 專業技能</td>
<td><input name="post[skill]" type="text" size="50" value="<?php echo $skill;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 語言水平</td>
<td><input name="post[language]" type="text"  size="50" value="<?php echo $language;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 工作性質</td>
<td>
<?php
foreach($TYPE as $k=>$v) {
?>
<input type="radio" name="post[type]" id="type_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $type ? ' checked' : '';?>/><label for="type_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 期望薪資</td>
<td><input name="post[minsalary]" type="text" id="minsalary" size="6" value="<?php echo $minsalary;?>"/> 至 <input name="post[maxsalary]" type="text" id="maxsalary" size="6" value="<?php echo $maxsalary;?>"/> <?php echo $DT['money_unit'];?>/月 (不填或者填0為不限)</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 工作經驗</td>
<td>
<input type="text" name="post[experience]"  value="<?php echo $experience;?>" size="4" id="experience"/> &nbsp;&nbsp;年 <span id="dexperience" class="f_red"></span></td>
</tr>

<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>

<tr>
<td class="tl"><span class="f_red">*</span> 自我鑒定</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 聯繫手機</td>
<td><input name="post[mobile]" id="mobile" type="text" size="30" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 電子郵件</td>
<td><input name="post[email]" id="email" type="text" size="30" value="<?php echo $email;?>"/> <span id="demail" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 聯繫電話</td>
<td><input name="post[telephone]" id="telephone" type="text" size="30" value="<?php echo $telephone;?>"/> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 聯繫地址</td>
<td><input name="post[address]" type="text" size="60" value="<?php echo $address;?>"/></td>
</tr>
<?php if($DT['im_qq']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td class="tr"><input name="post[qq]" type="text" size="30" value="<?php echo $qq;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_ali']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
<td class="tr"><input name="post[ali]" type="text" size="30" value="<?php echo $ali;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_msn']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td class="tr"><input name="post[msn]" type="text" size="30" value="<?php echo $msn;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_skype']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td class="tr"><input name="post[skype]" type="text" size="30" value="<?php echo $skype;?>"/></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 求職狀態</td>
<td>
<select name="post[situation]">
<?php
foreach($SITUATION as $k=>$v) {
?>
<option value="<?php echo $k;?>"<?php echo $k == $situation ? ' selected' : ''?>><?php echo $v;?></option> 
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 簡歷狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通過
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待審
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';"/> 拒絕
<input type="radio" name="post[status]" value="4" <?php if($status == 4) echo 'checked';?>/> 過期
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?>/> 刪除
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 拒絕理由</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 公開程度</td>
<td>
<input type="radio" name="post[open]" value="3" <?php if($open == 3) echo 'checked';?>/> 開放
<input type="radio" name="post[open]" value="2" <?php if($open == 2) echo 'checked';?>/> 僅網站可見
<input type="radio" name="post[open]" value="1" <?php if($open == 1) echo 'checked';?>/> 關閉
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 瀏覽次數</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 會員名</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[資料]</a></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 內容收費</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('不填或填0表示繼承模塊設置價格，-1表示不收費<br/>大於0的數字表示具體收費價格');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('resume', $module, 'post[template]', '默認模板', $template, 'id="template"');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
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
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫簡歷名稱', f);
		return false;
	}
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('請選擇求職行業', 'catid', 1);
		return false;
	}
	f = 'truename';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫真實姓名', f);
		return false;
	}
	f = 'areaid';
	if(Dd(f).value == 0) {
		Dmsg('請選擇居住地區', f, 1);
		return false;
	}
	f = 'byear';
	if(Dd(f).value.length != 4) {
		Dmsg('請填寫生日', f);
		return false;
	}
	f = 'school';
	if(Dd(f).value.length < 2) {
		Dmsg('請填寫畢業院校', f);
		return false;
	}
	f = 'experience';
	if(Dd(f).value.length < 1) {
		Dmsg('請填寫工作經驗', f);
		return false;
	}
	f = 'mobile';
	if(Dd(f).value.length < 7) {
		Dmsg('請填寫聯繫手機', f);
		return false;
	}
	f = 'email';
	if(Dd(f).value.length < 6) {
		Dmsg('請填寫電子郵件', f);
		return false;
	}
	f = 'content';
	l = FCKLen();
	if(l < 5) {
		Dmsg('自我鑒定最少5字，當前已輸入'+l+'字', f);
		return false;
	}	
	<?php echo $FD ? fields_js() : '';?>
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>