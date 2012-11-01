<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">記錄搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&itemid=<?php echo $itemid;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<div class="tt">訂單列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="30"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>下單時間</th>
<th>禮品</th>
<th>會員名</th>
<th>訂單狀態</th>
<th>備註信息</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['oid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/><input name="post[<?php echo $v['oid'];?>][itemid]" type="hidden" value="<?php echo $v['itemid'];?>"/></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo dsubstr($v['title'], 30, '..');?></a></td>
<td title="IP:<?php echo $v['ip'];?>(<?php echo ip2area($v['ip']);?>)"><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><input name="post[<?php echo $v['oid'];?>][status]" type="text" size="10" value="<?php echo $v['status'];?>" id="status_<?php echo $v['oid'];?>"/>
<select onchange="if(this.value)Dd('status_<?php echo $v['oid'];?>').value=this.value;">
<option value="">備選狀態</option>
<option value="處理中">處理中</option>
<option value="審核中">審核中</option>
<option value="已取消">已取消</option>
<option value="已發貨">已發貨</option>
<option value="已完成">已完成</option>
</select>
</td>
<td><input name="post[<?php echo $v['oid'];?>][note]" type="text" size="15" value="<?php echo $v['note'];?>"/></td>
</tr>
<?php }?>
<tr>
<td> </td>
<td height="30" colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個訂單？確定要刪除嗎？')) return false;" class="btn"/></td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>