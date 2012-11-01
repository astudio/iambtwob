<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">詞語搜索</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">詞語管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="50"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>查找詞語</th>
<th>替換為</th>
<th>攔截</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['bid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['bid'];?>][replacefrom]" type="text" size="50" value="<?php echo $v['replacefrom'];?>"/></td>
<td><input name="post[<?php echo $v['bid'];?>][replaceto]" type="text" size="50" value="<?php echo $v['replaceto'];?>"/></td>
<td>
<input name="post[<?php echo $v['bid'];?>][deny]" type="radio" value="1" <?php if($v['deny']) echo 'checked';?>/> 是
<input name="post[<?php echo $v['bid'];?>][deny]" type="radio" value="0" <?php if(!$v['deny']) echo 'checked';?>/> 否
</td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td><textarea name="post[0][replacefrom]" rows="10" cols="50"></textarea></td>
<td><textarea name="post[0][replaceto]" rows="10" cols="50"></textarea></td>
<td>
<input name="post[0][deny]" type="radio" value="1"/> 是
<input name="post[0][deny]" type="radio" value="0" checked/> 否
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個詞語？確定要刪除嗎？')) return false;" class="btn"/>&nbsp;&nbsp;<input type="submit" name="submit" value="刪除選中" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個詞語？確定要刪除嗎？')) return false;" class="btn"/></td>
</tr>
<tr>
<td colspan="4"><div class="pages"><?php echo $pages;?></div></td>
</tr>
<tr>
<td> </td>
<td colspan="3">
&nbsp;&nbsp;1、批量添加時，查找和替換詞語一行一個，互相對應<br/>
&nbsp;&nbsp;2、如果選擇攔截，則匹配到查找詞語時直接提示，拒絕提交<br/>
&nbsp;&nbsp;3、例如「您*好」格式，可替換「您好」之間的干擾字符<br/>
&nbsp;&nbsp;4、為不影響程序效率，請不要設置過多過濾內容<br/>
&nbsp;&nbsp;5、過濾僅對前台會員提交信息生效，後台不受限制<br/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>