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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>排名</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 排名模塊</td>
<td>
<input type="radio" name="post[mid]" value="5" id="m_5"<?php if($mid == 5) echo ' checked';?>/><label for="m_5"> 供應</label>
<input type="radio" name="post[mid]" value="6" id="m_6"<?php if($mid == 6) echo ' checked';?>/><label for="m_6"> 求購</label>
<input type="radio" name="post[mid]" value="4" id="m_4"<?php if($mid == 4) echo ' checked';?>/><label for="m_4"> 公司</label>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 關鍵詞</td>
<td><input type="text" size="20" name="post[word]" id="word" value="<?php echo $word;?>"/> <span id="dword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 出價</td>
<td><input type="text" size="20" name="post[price]" id="price" value="<?php echo $price;?>"/> <span id="dprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 單位</td>
<td>
<input type="radio" name="post[currency]" value="money" <?php if($currency == 'money') echo 'checked';?>/> <?php echo $DT['money_name'];?>&nbsp;
<input type="radio" name="post[currency]" value="credit" <?php if($currency == 'credit') echo 'checked';?>/> <?php echo $DT['credit_name'];?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 信息ID</td>
<td><input type="text" size="10" name="post[tid]" id="key_id" value="<?php echo $tid;?>" onfocus="Sid();"/> <a href="javascript:Sid();" class="t">選擇..</a> <span id="dkey_id" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 投放時段</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> 至 <?php echo dcalendar('post[totime]', $totime);?> <span id="dtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 會員名稱</td>
<td><input type="text" size="20" name="post[username]" id="username" value="<?php echo $username;?>"/> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 排名狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通過&nbsp;
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待審
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 備註事項</td>
<td><input type="text" size="60" name="post[note]" value="<?php echo $note;?>"/></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function Sid() {
	if(Dd('m_4').checked) {
		select_item('4&itemid='+Dd('key_id').value);
	} else if(Dd('m_5').checked) {
		select_item('5&itemid='+Dd('key_id').value);
	} else if(Dd('m_6').checked) {
		select_item('6&itemid='+Dd('key_id').value);
	}
}
function check() {
	var l;
	var f;
	f = 'word';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請輸入關鍵詞', f);
		return false;
	}
	f = 'price';
	l = Dd(f).value.length;
	if(l < 1) {
		Dmsg('請填寫出價', f);
		return false;
	}
	f = 'key_id';
	l = Dd(f).value.length;
	if(l < 1) {
		Dmsg('請填寫信息ID', f);
		return false;
	}	
	if(Dd('postfromtime').value.length != 10 || Dd('posttotime').value.length != 10) {
		Dmsg('請選擇投放時段', 'time');
		return false;
	}
	f = 'username';
	l = Dd(f).value.length;
	if(l < 3) {
		Dmsg('請填寫會員名稱', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>