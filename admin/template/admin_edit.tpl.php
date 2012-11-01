<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="username" value="<?php echo $user['username'];?>"/>
<div class="tt">修改管理員</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 會員名</td>
<td><a href="javascript:_user('<?php echo $user['username'];?>');" class="t">[<?php echo $user['username'];?>]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 管理員類別</td>
<td>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="1" id="admin_1"<?php echo $user['admin'] == 1 ? ' checked' : '';?>/><label for="admin_1"> 超級管理員</label> <span class="f_gray">擁有除創始人特權外的所有權限</span>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="2" id="admin_2"<?php echo $user['admin'] == 2 ? ' checked' : '';?>/><label for="admin_2"> 普通管理員</label> <span class="f_gray">擁有系統分配的權限</span>
<div class="b10">&nbsp;</div>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 分站權限</td>
<td><?php echo ajax_area_select('aid', '請選擇', $user['aid']);?> <span class="f_gray">分站權限僅對<span class="f_red">普通管理員</span>生效</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 角色名稱</td>
<td><input type="text" size="20" name="role" id="role" value="<?php echo $user['role'];?>"/> <span class="f_gray">可以為角色名稱，例如編輯、美工、某分站編輯等，也可以為該管理員的備註</span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="修 改" class="btn"></div>
</form>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>