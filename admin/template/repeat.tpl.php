<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">檢測條件</div>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 模塊</td>
<td>
<select name="mid">
<option value="0">請選擇</option>
<?php foreach($MODULE as $m) { if(!$m['islink'] && $m['moduleid']>4) { ?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : '';?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 字段</td>
<td><input type="text" size="10" name="key" value="<?php echo $key;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 數量</td>
<td><input type="text" size="10" name="num" value="<?php echo $num;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 關鍵詞</td>
<td><input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 狀態</td>
<td>
<select name="status">
<option value="0"<?php echo $status==0 ? ' selected' : '';?>>回收站</option>
<option value="1"<?php echo $status==1 ? ' selected' : '';?>>已拒絕</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>待審核</option>
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>已通過</option>
<option value="4"<?php echo $status==4 ? ' selected' : '';?>>已過期</option>
</select>
</td>
</tr>
<tr>
<td class="tl"></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="開始檢測" class="btn" onclick="this.value='檢測中..';this.blur();this.className='btn f_gray';"/>&nbsp;
<input type="button" value="重新檢測" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<?php if($submit) { ?>
<div class="tt">檢測結果</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>名稱</th>
<th>重複次數</th>
<th width="60">查看</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;&nbsp;<img src="admin/image/htm.gif" align="absmiddle"/> <a href="?moduleid=<?php echo $mid;?>&action=<?php echo $act;?>&kw=<?php echo $v['kw'];?>" target="_blank"><?php echo $v[$key];?></a></td>
<td><?php echo $v['num'];?></td>
<td><a href="?moduleid=<?php echo $mid;?>&action=<?php echo $act;?>&kw=<?php echo $v['kw'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16"/></a></td>
</tr>
<?php }?>
<?php } else { ?>
<tr>
<td class="f_blue" height="40">&nbsp;- 指定範圍沒有檢測到重複信息&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[重新檢測]</a></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>