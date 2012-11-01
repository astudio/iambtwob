<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">廣告搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="job" value="<?php echo $job;?>"/>
<input type="hidden" name="pid" value="<?php echo $pid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $order_select;?>&nbsp;
<?php echo ajax_area_select('areaid', '地區(分站)', $areaid);?>&nbsp;
廣告位ID： <input type="text" name="pid" value="<?php echo $pid;?>" size="2" class="t_c"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&job=<?php echo $job;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo $pid ? $P[$pid]['name'] : '廣告列表';?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="40">排序</th>
<th>ID</th>
<?php if($pid == 0) { ?>
<th>廣告類型</th>
<?php } ?>
<th>廣告名稱</th>
<th>出價</th>
<th>單位</th>
<th>點擊</th>
<th>開始時間</th>
<th>結束時間</th>
<th>剩餘(天)</th>
<th>狀態</th>
<th>審核</th>
<th>會員</th>
<th width="80">操作</th>
</tr>
<?php foreach($ads as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="aids[]" value="<?php echo $v['aid'];?>"/></td>
<td><input type="text" size="2" name="listorder[<?php echo $v['aid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['aid'];?></td>
<?php if($pid == 0) { ?>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&job=<?php echo $job;?>&typeid=<?php echo $v['typeid'];?>"><?php echo $TYPE[$v['typeid']];?></a></td>
<?php } ?>
<td align="left" title="編輯:<?php echo $v['editor'];?>&#10;添加時間:<?php echo $v['adddate'];?>&#10;更新時間:<?php echo $v['editdate'];?>">&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&aid=<?php echo $v['aid'];?>&pid=<?php echo $v['pid'];?>"><?php echo $v['title'];?></a></td>
<td class="f_red f_b"><?php echo $v['amount'];?></td>
<td><?php echo $v['currency'] == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?></td>
<td><?php echo $v['hits'];?></td>
<td><?php echo $v['fromdate'];?></td>
<td><?php echo $v['todate'];?></td>
<td<?php if($v['days']<5) echo ' class="f_red"';?>><?php echo $v['days'];?></td>
<td><?php echo $v['process'];?></td>
<td><?php echo $v['status']==3 ? '已通過' : '<span class="f_red">待審核</span>';?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=view&aid=<?php echo $v['aid'];?>" target="_blank"/><img src="admin/image/view.png" width="16" height="16" title="預覽此廣告" alt=""></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&aid=<?php echo $v['aid'];?>&pid=<?php echo $v['pid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&aids=<?php echo $v['aid'];?>&pid=<?php echo $v['pid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order_ad&pid=<?php echo $pid;?>';"/>&nbsp;
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中廣告嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&pid=<?php echo $pid;?>'}else{return false;}"/>&nbsp;
<?php if($pid) { ?>
<?php if($job == 'check') { ?>
<input type="button" value=" 廣告列表 " class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&job=&pid=<?php echo $pid;?>';"/>&nbsp;
<?php } else { ?>
<input type="button" value=" 審核廣告 " class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&job=check&pid=<?php echo $pid;?>';"/>&nbsp;
<?php } ?>
<input type="button" value=" 添加廣告 " class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=add&pid=<?php echo $pid;?>';"/>
<?php } ?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(<?php echo $job == 'check' ? 3 : 2;?>);</script>
<?php include tpl('footer');?>