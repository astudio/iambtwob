<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">添加管理員</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 會員名</td>
<td>
<input type="text" size="20" name="username" id="username" value="<?php echo $username;?>"/>
&nbsp;&nbsp;<a href="javascript:if(Dd('username').value)_user(Dd('username').value);" class="t" title="點擊查看填寫會員的詳細資料">[資料]</a>
&nbsp;&nbsp;<a href="?moduleid=2&action=add" class="t" target="_blank" title="如果會員還沒有註冊，請點這裡添加">[添加]</a>
<span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 管理員類別</td>
<td>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="1" id="admin_1" onclick="Dh('ro');" checked/><label for="admin_1"> 超級管理員</label> <span class="f_gray">擁有除創始人特權外的所有權限</span>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="2" id="admin_2" onclick="Ds('ro');"/><label for="admin_2"> 普通管理員</label> <span class="f_gray">擁有系統分配的權限</span>
<div class="b10">&nbsp;</div>
<style type="text/css">
#ro {padding:5px 10px 10px 10px;border-top:#FFFFFF 1px solid;}
#ro div {width:25%;float:left;height:30px;}
#ro p {margin:2px;color:#FF6600;}
</style>
<div id="ro" style="display:none;">
<p>↓快捷選擇一個管理角色(非必選)</p>
<?php 
foreach($MODULE as $m) {
	if($m['moduleid'] == 1 || $m['moduleid'] == 3 || $m['islink']) continue;
?>
<div><input type="checkbox" name="roles[<?php echo $m['moduleid'];?>]" value="1" id="ro_<?php echo $m['moduleid'];?>"/><label for="ro_<?php echo $m['moduleid'];?>"> <?php echo $m['name'];?>模塊管理員</label></div>
<?php } ?>
<div><input type="checkbox" name="roles[template]" value="1" id="ro_template"/><label for="ro_template"> 模板風格管理員</label></div>
<div><input type="checkbox" name="roles[database]" value="1" id="ro_database"/><label for="ro_database"> 數據庫管理員</label></div>
<div><input type="checkbox" onclick="checkall(this.form);" id="ro_all"/><label for="ro_all"> 全選/反選</label></div>
<p><?php echo ajax_area_select('aid', '分站權限');?></p>
</div>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 角色名稱</td>
<td><input type="text" size="20" name="role" id="role"/> <span class="f_gray">可以為角色名稱，例如編輯、美工、某分站編輯等，也可以為該管理員的備註</span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="下一步" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('請填寫會員名', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>