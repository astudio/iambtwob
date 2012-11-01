<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">商友搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
會員ID:<input type="text" name="userid" value="<?php echo $userid;?>" size="5"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>&nbsp;
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">管理商友</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>姓名</th>
<th>會員</th>
<th>公司</th>
<th colspan="8">聯繫方式</th>
<th>會員ID</th>
<th width="120">添加時間</th>
<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="備註:<?php echo $v['note'];?>">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td align="left">&nbsp;<?php echo $v['truename'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<?php echo $v['company'];?></td>

<td width="20"><?php if($v['homepage']) { ?><a href="<?php echo $v['homepage'];?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/homepage.gif" title="公司主頁" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><?php if($v['mobile']) { ?><a href="?moduleid=2&file=sms&mobile=<?php echo $v['mobile'];?>" target="_blank"><img src="<?php echo DT_SKIN;?>image/mobile.gif" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><?php if($v['username']) { ?> <a href="?moduleid=2&file=message&action=send&touser=<?php echo $v['username'];?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/msg.gif" title="發送站內信" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td> 

<td width="20"><?php if($v['email']) { ?><a href="?moduleid=2&file=sendmail&email=<?php echo $v['email'];?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/email.gif" title="發送Email <?php echo $v['email'];?>" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><?php if($v['qq']) { echo im_qq($v['qq']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['ali']) { echo im_ali($v['ali']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['msn']) { echo im_msn($v['msn']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['skype']) { echo im_skype($v['skype']); } else { echo '&nbsp;'; } ?></td>

<td><a href="javascript:_user('<?php echo $v['userid'];?>', 'userid');"><?php echo $v['userid'];?></a></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中商友嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;&nbsp;&nbsp;備註：會員ID代表商友的添加人(擁有者)
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>