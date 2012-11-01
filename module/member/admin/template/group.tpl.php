<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">會員組管理</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="120">排序</th>
<th width="120">ID</th>
<th>會員組</th>
<th width="120">類型</th>
<th width="120"><?php echo VIP;?>指數</th>
<th width="150">操作</th>
</tr>
<?php foreach($groups as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<?php if($k > 5) { ?>
<td>&nbsp;<input type="text" size="2" name="listorder[<?php echo $v['groupid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<?php } else { ?>
<td>&nbsp;<?php echo $v['listorder'];?></td>
<?php } ?>
<td>&nbsp;<?php echo $v['groupid'];?></td>
<td><?php echo $v['groupname'];?></td>
<td>&nbsp;<?php echo $v['type'];?></td>
<td>&nbsp;<?php echo $v['vip'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&groupid=<?php echo $v['groupid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<?php if($v['groupid'] > 7) { ?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&groupid=<?php echo $v['groupid'];?>"  onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
<?php } else {?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order';"/>
</div>
</form>
<div class="tt">注意事項</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="f_gray">
&nbsp;&nbsp;- ID為5和6的會員組必須是扣費模式，否則可能導致會員無法正常註冊<br/>
&nbsp;&nbsp;- 會員組請按服務的範圍(服務級別)由低到高依次排序，否則將影響會員的升級<br/>
&nbsp;&nbsp;- 扣費模式會員組可以註冊時選擇，包年模式需要會員在線升級<br/>
</td>
</tr>
</table>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>