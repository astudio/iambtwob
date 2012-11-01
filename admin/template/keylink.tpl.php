<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">鏈接搜索</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="關鍵詞或鏈接地址"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>&item=<?php echo $item;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">關聯鏈接</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="60">刪除</th>
<th>關鍵詞</th>
<th>鏈接</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['itemid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][title]" type="text" size="30" value="<?php echo $v['title'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][url]" type="text" size="50" value="<?php echo $v['url'];?>"/></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td><input name="post[0][title]" type="text" size="30" value=""/></td>
<td><input name="post[0][url]" type="text" size="50" value="http://"/></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個關聯鏈接？確定要刪除嗎？')) return false;" class="btn"/>&nbsp;
<input type="button" value="導 出" class="btn" onclick="window.location='?file=<?php echo $file;?>&item=<?php echo $item;?>&action=export';"/>&nbsp;
&nbsp;&nbsp;&nbsp;提示：過多的關聯鏈接會影響頁面打開或生成速度</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<input type="hidden" name="action" value="add"/>
<div class="tt">批量添加</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="60" align="center"><span class="f_red">*</span> 內容</td>
<td>
<textarea name="content" style="width:500px;height:100px;"><?php echo $content;?></textarea><br/>
一行一個，關鍵詞和鏈接用|分割，例如：Destoon B2B|http://www.destoon.com
</td>
</tr>
<tr>
<td></td>
<td>&nbsp;&nbsp;<input type="submit" name="submit" value=" 確 定 " class="btn"/></td>
</tr>
</table>
</form>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">鏈接導入</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="60" align="center"><span class="f_red">*</span> 模塊</td>
<td>&nbsp;&nbsp;
<select name="fid" id="fid">
<option value="">請選擇</option>
<?php 
foreach($MODULE as $v) {
	if($v['moduleid'] > 4 && $v['moduleid'] != $item && !$v['islink']) echo '<option value="'.$v['moduleid'].'"'.($fid == $v['moduleid'] ? ' selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>&nbsp;&nbsp;
<input type="button" value="查 看" class="btn" onclick="if(Dd('fid').value){window.open('?file=<?php echo $file;?>&item='+Dd('fid').value);}else{alert('請選擇模塊');}"/>&nbsp;&nbsp;
<input type="submit" value="導 入" class="btn"/>
</td>
</tr>
</table>
</form>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>