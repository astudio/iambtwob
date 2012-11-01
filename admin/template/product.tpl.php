<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">產品搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;產品名：
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">產品管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">刪除</th>
<th>產品ID</th>
<th>排序</th>
<th>產品名稱</th>
<th>計量單位</th>
<th>分類ID</th>
<th>所屬分類</th>
<th>屬性數量</th>
<th>屬性參數</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['pid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><?php echo $v['pid'];?></td>
<td><input name="post[<?php echo $v['pid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][title]" type="text" size="20" value="<?php echo $v['title'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][unit]" type="text" size="5" value="<?php echo $v['unit'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][catid]" type="text" size="5" value="<?php echo $v['catid'];?>"/></td>
<td><?php echo cat_pos($v['catid'], ' ', 1);?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $v['pid'];?>&action=manage"><?php echo $v['items'];?></a></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $v['pid'];?>&action=add"><img src="admin/image/new.png" width="16" height="16" title="添加屬性" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $v['pid'];?>&action=manage"><img src="admin/image/child.png" width="16" height="16" title="管理屬性" alt=""/></a>&nbsp;
</td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td></td>
<td><input name="post[0][listorder]" type="text" size="3" value=""/></td>
<td><input name="post[0][title]" type="text" size="20" value=""/></td>
<td><input name="post[0][unit]" type="text" size="5" value=""/></td>
<td colspan="5" align="left">&nbsp;&nbsp;<?php echo ajax_category_select('post[0][catid]', '選擇分類', $catid, $moduleid);?></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="8">
&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value=" 更 新 " onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個產品類型？確定要刪除嗎？')) return false;" class="btn"/>
</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<form action="?" method="post" onsubmit="return check();">
<div class="tt">同步屬性</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="copy"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;源產品ID：<input type="text" size="5" name="fpid" id="fpid"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
目標產品ID：<input type="text" size="20" name="tpid" id="tpid"/>&nbsp;
<input type="submit" value="確定" class="btn"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;<strong>使用說明</strong></td>
</tr>
<tr>
<td style="padding:10px;color:#666666;">
1、如果一個產品屬於多個分類，首先按分類多次添加此產品，然後在任意一個同名產品下建立屬性，屬性建立之後，可以做為源產品ID將屬性同步到其他指定的目標產品。<br/>
2、目標產品ID如果有多個，請用英文逗號(,)分割開。目標產品沒有而源產品有的屬性，將被創建；目標產品和源產品同名的屬性，將被更新。
</td>
</tr>
</table>
</form>
<script type="text/javascript">
function check() {
	if(Dd('fpid').value == '') {
		alert('請填寫源產品ID');
		Dd('fpid').focus();
		return false;
	}
	if(Dd('tpid').value == '') {
		alert('請填寫目標產品ID');
		Dd('tpid').focus();
		return false;
	}
	return confirm('確定要同步屬性嗎？此操作將不可撤銷');
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>