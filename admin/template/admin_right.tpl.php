<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<div class="tt">管理員[<?php echo $username;?>]會員面板管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">刪除</th>
<th>排序</th>
<th>名稱</th>
<th>地址</th>
</tr>
<?php foreach($dmenus as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="right[<?php echo $v['adminid'];?>][delete]" type="checkbox" value="1"/></td>
<td><input name="right[<?php echo $v['adminid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td><input name="right[<?php echo $v['adminid'];?>][title]" type="text" size="12" value="<?php echo $v['title'];?>"/> <?php echo dstyle('right['.$v['adminid'].'][style]', $v['style']);?></td>
<td><input name="right[<?php echo $v['adminid'];?>][url]" type="text" size="60" value="<?php echo $v['url'];?>"/></td>
</tr>
<?php }?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td><input name="right[0][listorder]" type="text" size="3" value=""/></td>
<td><input name="right[0][title]" type="text" size="12" value="" id="p_title"/> <?php echo dstyle('right[0][style]');?></td>
<td><input name="right[0][url]" type="text" size="60" value="" id="p_url"/>
</td>
</tr>
<tr>
<td height="30"> </td>
<td colspan="4">
&nbsp;
<input type="submit" name="submit" value="更 新" class="btn"/>&nbsp;
<select onchange="if(this.value){Dd('p_title').value=this.options[selectedIndex].innerHTML;Dd('p_url').value=this.value;}" style="width:120px;">
<option value="">常用操作</option>
<?php
foreach($MODULE as $m) {
	if($m['islink']) continue;
	$mid = $m['moduleid'];
?>
<?php if($mid == 1) { ?>
<option value="?action=html">生成首頁</option>
<option value="?action=tag">更新標籤</option>
<?php
	include DT_ROOT.'/admin/menu.inc.php';
	foreach($menu as $m) {
		echo '<option value="'.$m[1].'">'.$m[0].'</option>';
	}
?>
<?php } else if($mid == 3) { ?>
<option value="">--------------------</option>
<?php
	include DT_ROOT.'/module/extend/admin/menu.inc.php';
	foreach($menu as $m) {
		if(strpos($m[1], 'setting') !== false) continue;
		echo '<option value="'.$m[1].'">'.$m[0].'</option>';
	}
?>
<?php } else if($mid == 2) { ?>
<option value="">--------------------</option>
<?php
	include DT_ROOT.'/module/member/admin/menu.inc.php';
	foreach($menu as $m) {
		if(strpos($m[1], 'setting') !== false) continue;
		echo '<option value="'.$m[1].'">'.$m[0].'</option>';
	}
	foreach($menu_finance as $m) {
		echo '<option value="'.$m[1].'">'.$m[0].'</option>';
	}
	foreach($menu_relate as $m) {
		echo '<option value="'.$m[1].'">'.$m[0].'</option>';
	}
?>
<?php } else if($mid == 4) { ?>
<option value="">--------------------</option>
<?php
	include DT_ROOT.'/module/company/admin/menu.inc.php';
	foreach($menu as $m) {
		if(strpos($m[1], 'setting') !== false) continue;
		echo '<option value="'.$m[1].'">'.$m[0].'</option>';
	}
?>
<?php } else { ?>
<option value="">--------------------</option>
<option value="?moduleid=<?php echo $mid;?>&action=add"><?php echo $m['name'];?>添加</option>
<option value="?moduleid=<?php echo $mid;?>"><?php echo $m['name'];?>管理</option>
<option value="?moduleid=<?php echo $mid;?>&action=check"><?php echo $m['name'];?>審核</option>
<option value="?mid=<?php echo $mid;?>&file=category"><?php echo $m['name'];?>分類</option>
<option value="?moduleid=<?php echo $mid;?>&file=html"><?php echo $m['name'];?>更新</option>
<option value="?moduleid=<?php echo $mid;?>&file=setting"><?php echo $m['name'];?>設置</option>
<?php if($mid == 9) { ?>
<option value="?moduleid=<?php echo $mid;?>&file=resume&action=add">簡歷添加</option>
<option value="?moduleid=<?php echo $mid;?>&file=resume">簡歷管理</option>
<option value="?moduleid=<?php echo $mid;?>&file=resume&action=check">簡歷審核</option>
<?php } ?>
<?php } ?>
<?php } ?>
</select>
&nbsp;&nbsp;
<strong>提示</strong>：添加常用操作可以自動分配對應權限
</td>
</tr>
</table>
</form>

<?php if($user['admin'] != 1) { ?>

<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<div class="tt">管理員[<?php echo $username;?>]權限分配</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">刪除</th>
<th>模塊ID</th>
<th>文件(file)</th>
<th>動作(action)</th>
<th>分類ID(catid)</th>
</tr>
<?php foreach($drights as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="right[<?php echo $v['adminid'];?>][delete]" type="checkbox" value="1"/></td>
<td align="left"><input name="right[<?php echo $v['adminid'];?>][moduleid]" type="text" size="2" value="<?php echo $v['moduleid'];?>"/> <?php echo $v['module'];?></td>
<td align="left"><input name="right[<?php echo $v['adminid'];?>][file]" type="text" size="10" value="<?php echo $v['file'];?>"/> <?php echo $v['name'];?></td>
<td><input name="right[<?php echo $v['adminid'];?>][action]" type="text" size="25" value="<?php echo $v['action'];?>"/></td>
<td><input name="right[<?php echo $v['adminid'];?>][catid]" type="text" size="45" value="<?php echo $v['catid'];?>"/>
</td>

</tr>
<?php }?>

<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td align="left"><input name="right[-1][moduleid]" type="text" size="10"/></td>
<td align="left"><input name="right[-1][file]" type="text" size="10"/></td>
<td><input name="right[-1][action]" type="text" size="25"/></td>
<td><input name="right[-1][catid]" type="text" size="45"/></td>
</tr>

<tr align="center">
<td class="f_red">選擇</td>
<td id="moduleids" align="left">
<select name="right[0][moduleid]" size="2" style="height:200px;width:100px;" onchange="get_file(this.value);">
<option value="0">選擇模塊[單選]</option>
<?php foreach($MODULE as $k=>$v) { if(!$v['islink']) {?>
<option value="<?php echo $k;?>"><?php echo $v['name'];?>[<?php echo $k;?>]</option>
<?php }} ?>
</select>
</td>
<td id="files" align="left">
<select name="right[0][file]" size="2" style="height:200px;width:150px;" onchange="get_action(this.value);">
<option value="">選擇文件[單選]</option>
</select>
</td>
<td id="actions">
<select name="right[0][action][]" size="2" multiple style="height:200px;width:150px;">
<option>選擇動作[按Ctrl鍵多選]</option>
</select>
</td>
<td id="catids">
<select name="right[0][catid][]" size="2" multiple style="height:200px;width:300px;">
<option>選擇分類多選[按Ctrl鍵多選]</option>
</select>
</td>
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="4"><input type="submit" name="submit" value="更 新" class="btn"/> 提示：動作和分類可按住Ctrl鍵多選</td>
</tr>
</table>
</form>
<script type="text/javascript">
var html_file = Dd('files').innerHTML;
var html_action = Dd('actions').innerHTML;
var html_catid = Dd('catids').innerHTML;
function get_file(mid) {
	if(mid) {
		makeRequest('file=<?php echo $file;?>&action=ajax&mid='+mid, '?', '_get_file');
	}
}
function _get_file() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			var s = xmlHttp.responseText.split('|');
			Dd('files').innerHTML = s[0] != 0 ? s[0] : html_file;
			Dd('catids').innerHTML = s[1] != 0 ? s[1] : html_catid;
		}
	}
}
function get_action(fi, mid) {
	if(mid) {
		makeRequest('file=<?php echo $file;?>&action=ajax&mid='+mid+'&fi='+fi, '?', '_get_action');
	}
}
function _get_action() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		Dd('actions').innerHTML = xmlHttp.responseText != 0 ? xmlHttp.responseText : html_action;
	}
}
</script>
<?php } ?>
<script type="text/javascript">Menuon(2);</script>
<br/>
<?php include tpl('footer');?>