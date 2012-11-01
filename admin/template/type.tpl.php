<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">分類管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">刪除</th>
<th>ID</th>
<th>排序</th>
<th>名稱</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['typeid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><?php echo $v['typeid'];?></td>
<td><input name="post[<?php echo $v['typeid'];?>][listorder]" type="text" size="5" value="<?php echo $v['listorder'];?>" maxlength="3"/></td>
<td align="left">&nbsp;&nbsp;<input name="post[<?php echo $v['typeid'];?>][typename]" type="text" size="20" value="<?php echo $v['typename'];?>" maxlength="20" style="width:200px;color:<?php echo $v['style'];?>"/> <?php echo dstyle('post['.$v['typeid'].'][style]', $v['style']);?></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td></td>
<td class="f_red">新增</td>
<td><input name="post[0][listorder]" type="text" size="5" value="" maxlength="3"/></td>
<td align="left">&nbsp;&nbsp;<input name="post[0][typename]" type="text" size="20" value="" maxlength="20" style="width:200px;"/> <?php echo dstyle('post[0][style]');?></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個分類？確定要刪除嗎？')) return false;" class="btn"/></td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(<?php echo $menuon;?>);</script>
<?php include tpl('footer');?>