<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">IP解鎖</div>
<form action="?" method="post">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="unban"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
IP地址： <input type="text" name="ip" size="30"/> &nbsp; <input type="submit" name="submit" value="刪 除" class="btn"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">鎖定列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>IP</th>
<th>來自</th>
<th>鎖定時間</th>
<th width="25"></th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="ip[]" value="<?php echo $v['ip'];?>"/></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['addtime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=unban&ip=<?php echo $v['ip'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
</div>
<div class="btns">
<input type="submit" value="刪除選定" class="btn" onclick="if(confirm('確定要刪除選中IP嗎？')){this.form.action='?file=<?php echo $file;?>&action=unban'}else{return false;}"/>
</div>
</form>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>