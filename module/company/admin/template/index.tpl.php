<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt"><?php echo $MOD['name'];?>搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="25" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $level_select;?>&nbsp;
<select name="vip">
<option value=""><?php echo VIP;?>級別</option>
<?php 
for($i = 0; $i < 11; $i++) {
	echo '<option value="'.$i.'"'.($i == $vip ? ' selected' : '').'>'.$i.' 級</option>';
}
?>
</select>&nbsp;
<?php echo $valid_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo category_select('catid', '所屬行業', $catid, $moduleid);?>&nbsp;
<?php echo ajax_area_select('areaid', '所在地區', $areaid);?>&nbsp;
<?php echo $mode_select;?>&nbsp;
<?php echo $type_select;?>&nbsp;
<?php echo $size_select;?>&nbsp;
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>圖片&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="totime" <?php if($timetype == 'totime') echo 'selected';?>>服務到期</option>
<option value="fromtime" <?php if($timetype == 'fromtime') echo 'selected';?>>服務開始</option>
<option value="validtime" <?php if($timetype == 'validtime') echo 'selected';?>>認證時間</option>
<option value="styletime" <?php if($timetype == 'styletime') echo 'selected';?>>模板到期</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
註冊資本：<input type="text" size="5" name="mincapital" value="<?php echo $mincapital;?>"/> ~ <input type="text" size="5" name="maxcapital" value="<?php echo $maxcapital;?>"/> 萬&nbsp;
會員名：<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
會員ID：<input type="text" name="uid" value="<?php echo $uid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo $MOD['name'];?>管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="14"> </th>
<th><?php echo $MOD['name'];?>名稱</th>
<th>所在地</th>
<th>註冊年份</th>
<th>註冊資本</th>
<th><?php echo VIP;?>指數</th>
<th>人氣</th>
<th width="100">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="<?php echo $MOD['name'];?>類型:<?php echo $v['type'];?>&#10;<?php echo $MOD['name'];?>規模:<?php echo $v['size'];?>">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>級" alt=""/></a><?php } ?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['company'];?></a><?php if($v['vip']) { ?> <img src="<?php echo DT_SKIN;?>image/vip.gif" align="absmiddle"/><?php } ?><?php if($v['thumb']) {?> <a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="admin/image/img.gif" width="10" height="10" title="標題圖,點擊預覽" alt=""/></a><?php } ?></td>
<td><?php echo area_pos($v['areaid'], '/');?></td>
<td><?php echo $v['regyear'];?></td>
<td><?php echo $v['capital'] ? $v['capital'].'萬'.$v['regunit'] : '未填';?></td>
<td><img src="<?php echo DT_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif"/></td>
<td><?php echo $v['hits'];?></td>
<td><a href="?moduleid=2&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改會員[<?php echo $v['username'];?>]資料" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=show&userid=<?php echo $v['userid'];?>"><img src="admin/image/view.png" width="16" height="16" title="會員[<?php echo $v['username'];?>]詳細資料" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="進入會員商務中心" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=delete&userid=<?php echo $v['userid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 刪除公司 " class="btn" onclick="if(confirm('確定要刪除選中會員嗎？系統將刪除選中用戶所有信息，此操作將不可撤銷')){this.form.action='?moduleid=2&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" 禁止訪問 " class="btn" onclick="if(confirm('確定要禁止選中會員訪問嗎？')){this.form.action='?moduleid=2&action=move&groupids=2'}else{return false;}"/>&nbsp;
<input type="submit" value=" 設置<?php echo VIP;?> " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=vip&action=add';"/>&nbsp;
<input type="submit" value=" 移動地區 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=move';"/>&nbsp;
<input type="submit" value=" 更新公司 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=update';"/>&nbsp;
<input type="submit" value=" 移動至 " class="btn" onclick="if(Dd('mgroupid').value==0){alert('請選擇會員組');Dd('mgroupid').focus();return false;}this.form.action='?moduleid=2&action=move';"/> <?php echo group_select('groupid', '會員組', 0, 'id="mgroupid"');?>&nbsp;
<?php echo level_select('level', '設置級別為</option><option value="0">取消', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>