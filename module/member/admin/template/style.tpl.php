<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">模板搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $type_select;?>&nbsp;
<select name="groupid">
<option value="0">會員組</option>
<?php foreach($GROUP as $v) { if($v['groupid'] < 5) continue; ?>
<option value="<?php echo $v['groupid'];?>"<?php echo $v['groupid'] == $groupid ? ' selected' : '';?>><?php echo $v['groupname'];?></option>
<?php } ?>
</select>
價格:<input type="text" size="3" name="minfee" value="<?php echo $minfee;?>"/>~
<input type="text" size="3" name="maxfee" value="<?php echo $maxfee;?>" />&nbsp;
<select name="currency">
<option value="">單位</option>
<option value="money"<?php echo $currency == 'money' ? ' selected' : '';?>><?php echo $DT['money_name'];?></option>
<option value="credit"<?php echo $currency == 'credit' ? ' selected' : '';?>><?php echo $DT['credit_name'];?></option>
<option value="free"<?php echo $currency == 'free' ? ' selected' : '';?>>免費</option>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">管理模板</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="50">排序</th>
<th width="220">預覽圖</th>
<th>風格目錄</th>
<th>模板目錄</th>
<th>詳細信息</th>
<th>會員組</th>
<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><input name="listorder[<?php echo $v['itemid'];?>]" type="text" size="2" value="<?php echo $v['listorder'];?>"/></td>
<td style="padding:5px 0 5px 0;" title="點擊預覽"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>" target="_blank"><img src="<?php echo $v['thumb'];?>" style="margin:0 0 5px 0;"/><br/>
<strong><?php echo $v['title'];?></strong></a>
</td>
<td><?php echo $v['skin'];?></td>
<td><a href="?file=template&dir=<?php echo $v['template'];?>"><?php echo $v['template'];?></a></td>
<td align="left">
<div style="line-height:22px;padding:0 8px 0 8px;">
分類：<?php echo $v['typeid'] ? $TYPE[$v['typeid']]['typename'] : '未分類';?><br/>
價格：<?php echo $v['fee'] ? ($v['currency'] == 'money' ? '<span class="f_red">'.$v['fee'].$DT['money_unit'].'/月</span>' : '<span class="f_blue">'.$v['fee'].$DT['credit_unit'].'/月</span>') : '<span class="f_green">免費</span>';?><br/>
人氣：<?php echo $v['hits'];?><br/>
收益：<span class="f_red"><?php echo $v['money'].$DT['money_unit'];?></span>&nbsp;&nbsp;<span class="f_blue"><?php echo $v['credit'].$DT['credit_unit'];?></span><br/>
作者：<?php echo $v['author'];?><br/>
日期：<?php echo $v['adddate'];?>
</div>
</td>
<td><?php echo $v['group'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order';"/>&nbsp;
<input type="submit" value=" 刪 除 " class="btn" onclick="if(confirm('確定要刪除選中模板嗎？此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>