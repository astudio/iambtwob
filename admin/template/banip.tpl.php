<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">IP禁止</div>
<form action="?" method="post">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
IP地址/段 <input type="text" size="30" name="ip"/>&nbsp;
有效期至 <?php echo dcalendar('todate');?>&nbsp;
<input type="submit" value="添 加" class="btn"/>&nbsp;
</td>
</tr>
<tr>
<td>
&nbsp;1、IP禁止僅對網站前台生效，建議不要添加過多，以免影響程序效率<br/>
&nbsp;2、支持禁用IP段，例如填192.168.*.*將禁用所有192.168開頭的IP<br/>
&nbsp;3、有效期不填表示永久禁用<br/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">禁止列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>IP地址/段</th>
<th>地區</th>
<th>有效期至</th>
<th>狀態</th>
<th>操作人</th>
<th>禁止時間</th>
<th width="25"></th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['totime'];?></td>
<td><?php echo $v['status'];?></td>
<td><?php echo $v['editor'];?></td>
<td><?php echo $v['addtime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 批量刪除 " class="btn" onclick="if(confirm('確定要刪除選中記錄嗎？此操作將不可撤銷')){this.form.action='?file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>