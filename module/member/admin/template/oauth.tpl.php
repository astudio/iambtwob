<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">會員搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="export" id="export" value="<?php echo $export;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<select name="site">
<option value="">平台接口</option>
<?php
foreach($OAUTH as $k=>$v) {
	echo '<option value="'.$k.'" '.($site == $k ? 'selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>&nbsp;
<?php echo $order_select;?>
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>頭像&nbsp;
<input type="checkbox" name="link" value="1"<?php echo $link ? ' checked' : '';?>/>網址&nbsp;
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn" onclick="Dd('export').value=0;"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<div class="tt">帳號綁定</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="70">頭像</th>
<th>暱稱</th>
<th>會員名</th>
<th>平台</th>
<th>綁定時間</th>
<th>上次登錄</th>
<th>登錄次數</th>
<th width="40">操作</th>
</tr>
<?php foreach($members as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php if($v['url']) { ?><a href="<?php echo $v['url'];?>" target="_blank" class="t"><?php } ?><img src="<?php echo $v['avatar'];?>" width="50" style="margin:10px 0 10px 0;"/><?php if($v['url']) { ?></a><?php } ?></td>
<td><?php if($v['url']) { ?><a href="<?php echo $v['url'];?>" target="_blank" class="t"><?php } ?><?php echo $v['nickname'];?><?php if($v['url']) { ?></a><?php } ?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>')"><?php echo $v['username'];?></a></td>
<td title="<?php echo $OAUTH[$v['site']]['name'];?>"><img src="api/oauth/<?php echo $v['site'];?>/ico.png"/></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td class="px11"><?php echo $v['logindate'];?></td>
<td><?php echo $v['logintimes'];?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return confirm('確定要解除會員綁定嗎？此操作將不可撤銷');"><img src="admin/image/delete.png" width="16" height="16" title="解除綁定" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 解除綁定 " class="btn" onclick="if(confirm('確定要解除會員綁定嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>