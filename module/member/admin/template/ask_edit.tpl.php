<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">問題受理</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 問題分類</td>
<td><?php echo $TYPE[$typeid]['typename'];?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 問題標題</td>
<td><?php echo $title;?></td>
</tr>
<tr class="on">
<td class="tl"><span class="f_hid">*</span> 問題內容</td>
<td><?php echo $content;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 會員名</td>
<td><a href="javascript:_user('<?php echo $username;?>');"><?php echo $username;?></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 提交時間</td>
<td><?php echo $addtime;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 問題回復</td>
<td><textarea name="reply" id="reply" class="dsn"><?php echo $reply;?></textarea><?php echo deditor($moduleid, 'reply', 'Destoon', '98%', 300);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 受理狀態</td>
<td>
<input type="radio" name="status" value="0"<?php echo $status == 0 ? ' checked' : '';?>/> 待受理
<input type="radio" name="status" value="1"<?php echo $status == 1 ? ' checked' : '';?>/> 受理中
<input type="radio" name="status" value="2"<?php echo $status == 2 ? ' checked' : '';?>/> 已解決
<input type="radio" name="status" value="3"<?php echo $status == 3 ? ' checked' : '';?>/> 未解決
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 受理人</td>
<td><?php echo $admin;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 受理時間</td>
<td><?php echo $admintime;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 會員評分</td>
<td><?php echo $stars[$star];?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>