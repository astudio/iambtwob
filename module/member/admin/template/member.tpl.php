<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">會員搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $group_select;?>&nbsp;
<?php echo $gender_select;?>&nbsp;
<?php echo ajax_area_select('areaid', '所在地區', $areaid);?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="regtime" <?php if($timetype == 'regtime') echo 'selected';?>>註冊時間</option>
<option value="logintime" <?php if($timetype == 'logintime') echo 'selected';?>>登錄時間</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<?php echo $DT['money_name'];?>：<input type="text" size="3" name="minmoney" value="<?php echo $minmoney;?>"/> ~ <input type="text" size="3" name="maxmoney" value="<?php echo $maxmoney;?>"/>&nbsp;
<?php echo $DT['credit_name'];?>：<input type="text" size="3" name="mincredit" value="<?php echo $mincredit;?>"/> ~ <input type="text" size="3" name="maxcredit" value="<?php echo $maxcredit;?>"/>&nbsp;
短信：<input type="text" size="3" name="minsms" value="<?php echo $minsms;?>"/> ~ <input type="text" size="3" name="maxsms" value="<?php echo $maxsms;?>"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo $vprofile_select;?>&nbsp;
<?php echo $vemail_select;?>&nbsp;
<?php echo $vmobile_select;?>&nbsp;
<?php echo $vtruename_select;?>&nbsp;
<?php echo $vbank_select;?>&nbsp;
<?php echo $vcompany_select;?>&nbsp;
<?php echo $vtrade_select;?>&nbsp;
會員名：<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
會員ID：<input type="text" name="uid" value="<?php echo $uid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">會員管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>會員ID</th>
<th>會員名稱</th>
<th>公司</th>
<th><?php echo $DT['money_name'];?></th>
<th><?php echo $DT['credit_name'];?></th>
<th>短信</th>
<th>性別</th>
<th>會員組</th>
<th>註冊時間</th>
<th>最後登錄</th>
<th>登錄次數</th>
<th width="100">操作</th>
</tr>
<?php foreach($members as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td class="px11"><?php echo $v['userid'];?></td>
<td align="left">&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&action=show&userid=<?php echo $v['userid'];?>" title="<?php echo $v['truename'];?>"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<a href="<?php echo userurl($v['username']);?>" target="_blank"><?php echo $v['company'];?></a></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=record&username=<?php echo $v['username'];?>" target="_blank"><?php echo $v['money'];?></a></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=credit&username=<?php echo $v['username'];?>" target="_blank"><?php echo $v['credit'];?></a></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=sms&username=<?php echo $v['username'];?>&action=record" target="_blank"><?php echo $v['sms'];?></a></td>
<td><?php echo gender($v['gender']);?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&groupid=<?php echo $v['groupid'];?>"><?php echo $GROUP[$v['groupid']]['groupname'];?></a></td>
<td class="px11"><?php echo $v['regdate'];?></td>
<td class="px11"><?php echo $v['logindate'];?></td>
<td class="px11"><?php echo $v['logintimes'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=show&userid=<?php echo $v['userid'];?>"><img src="admin/image/view.png" width="16" height="16" title="會員[<?php echo $v['username'];?>]詳細資料" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="進入會員商務中心" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&userid=<?php echo $v['userid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="刪除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 刪除會員 " class="btn" onclick="if(confirm('確定要刪除選中會員嗎？系統將刪除選中用戶所有信息，此操作將不可撤銷')){this.form.action='?moduleid=<?php echo $moduleid;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" 禁止訪問 " class="btn" onclick="if(confirm('確定要禁止選中會員訪問嗎？')){this.form.action='?moduleid=<?php echo $moduleid;?>&action=move&groupids=2'}else{return false;}"/>&nbsp;
<input type="submit" value=" 設置<?php echo VIP;?> " class="btn" onclick="this.form.action='?moduleid=4&file=vip&action=add';"/>&nbsp;
<input type="submit" value=" <?php echo $DT['money_name'];?>增減 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=record&action=add';"/>&nbsp;
<input type="submit" value=" <?php echo $DT['credit_name'];?>獎懲 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=credit&action=add';"/>&nbsp;
<input type="submit" value=" 短信增減 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=sms&action=add';"/>&nbsp;
<input type="submit" value=" 貿易提醒 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=alert&action=add';"/>&nbsp;
<input type="submit" value=" 移動至 " class="btn" onclick="if(Dd('mgroupid').value==0){alert('請選擇會員組');Dd('mgroupid').focus();return false;}this.form.action='?moduleid=<?php echo $moduleid;?>&action=move';"/> <?php echo group_select('groupid', '會員組', 0, 'id="mgroupid"');?> 
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">修改會員名</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="rename"/>
<a name="#editusername"></a>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;當前會員名： <input type="text" name="cusername" size="20" value="<?php echo $username;?>"/> &nbsp; 新會員名： <input type="text" name="nusername" size="20"<?php if($catid) echo ' style="color:#FF6600;" value="請輸入新會員名" onclick="if(this.value==\'請輸入新會員名\')this.value=\'\';"';?>/>  &nbsp; <input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;<span class="f_gray">如無特殊情況，建議不要頻繁修改會員名</span>
</td>
</tr>
</table>
</form>
<div class="tt">IP查詢</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;IP地址： <input type="text" name="ip" size="30" id="ip"/> &nbsp; <input type="button"  value=" 查 詢 " class="btn" onclick="_ip(Dd('ip').value);"/>&nbsp;&nbsp;<span class="f_gray">可查詢IP所在地區</span>
</td>
</tr>
</table>
<div class="tt">IP解鎖</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="unlock"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;IP地址： <input type="text" name="ip" size="30"/> &nbsp; <input type="submit" name="submit" value=" 解 鎖 " class="btn"/>&nbsp;&nbsp;<span class="f_gray">可解除因登錄失敗次數過多而被鎖定登錄的IP</span>
</td>
</tr>
</table>
</form>
<br/><br/><br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>