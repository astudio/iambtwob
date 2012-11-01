<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">問題搜索</div>
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
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">問題管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="50"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>問題</th>
<th>答案</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['qid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['qid'];?>][question]" type="text" size="50" value="<?php echo $v['question'];?>"/></td>
<td><input name="post[<?php echo $v['qid'];?>][answer]" type="text" size="50" value="<?php echo $v['answer'];?>"/></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td><textarea name="post[0][question]" rows="10" cols="50"></textarea></td>
<td><textarea name="post[0][answer]" rows="10" cols="50"></textarea></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個驗證問題？確定要刪除嗎？')) return false;" class="btn"/>&nbsp;&nbsp;<input type="submit" name="submit" value="刪除選中" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個詞語？確定要刪除嗎？')) return false;" class="btn"/></td>
</tr>
<tr>
<td colspan="4"><div class="pages"><?php echo $pages;?></div></td>
</tr>
<tr>
<td> </td>
<td colspan="3">
&nbsp;&nbsp;1、批量添加時，問題和答案一行一個，互相對應<br/>
&nbsp;&nbsp;2、如果答案不唯一，建議在問題裡寫清楚答案<br/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>