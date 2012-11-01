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
<input type="text" size="20" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $group_select;?>&nbsp;
<?php echo $gender_select;?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn" onclick="Dd('export').value=0;"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>&nbsp;
<input type="submit" value="導出CSV" class="btn" onclick="Dd('export').value=1;"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="m.regtime" <?php if($timetype == 'm.regtime') echo 'selected';?>>註冊時間</option>
<option value="m.logintime" <?php if($timetype == 'm.logintime') echo 'selected';?>>登錄時間</option>
<option value="c.totime" <?php if($timetype == 'c.totime') echo 'selected';?>>服務到期</option>
<option value="c.fromtime" <?php if($timetype == 'c.fromtime') echo 'selected';?>>服務開始</option>
<option value="c.validtime" <?php if($timetype == 'c.validtime') echo 'selected';?>>認證時間</option>
<option value="c.styletime" <?php if($timetype == 'c.styletime') echo 'selected';?>>模板到期</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> 至 <?php echo dcalendar('totime', $totime);?>&nbsp;
<?php echo $DT['money_name'];?>：<input type="text" size="3" name="minmoney" value="<?php echo $minmoney;?>"/> ~ <input type="text" size="3" name="maxmoney" value="<?php echo $maxmoney;?>"/>&nbsp;
<?php echo $DT['credit_name'];?>：<input type="text" size="3" name="mincredit" value="<?php echo $mincredit;?>"/> ~ <input type="text" size="3" name="maxcredit" value="<?php echo $maxcredit;?>"/>&nbsp;
短信：<input type="text" size="3" name="minsms" value="<?php echo $minsms;?>"/> ~ <input type="text" size="3" name="maxsms" value="<?php echo $maxsms;?>"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo category_select('catid', '所屬行業', $catid, 4);?>&nbsp;
<?php echo ajax_area_select('areaid', '所在地區', $areaid);?>&nbsp;
<?php echo $mode_select;?>&nbsp;
<?php echo $type_select;?>&nbsp;
<?php echo $size_select;?>&nbsp;
<select name="vip">
<option value=""><?php echo VIP;?>級別</option>
<?php 
for($i = 0; $i < 11; $i++) {
	echo '<option value="'.$i.'"'.($i == $vip ? ' selected' : '').'>'.$i.' 級</option>';
}
?>
</select>&nbsp;
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>圖片&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo $valid_select;?>&nbsp;
<?php echo $vprofile_select;?>&nbsp;
<?php echo $vemail_select;?>&nbsp;
<?php echo $vmobile_select;?>&nbsp;
<?php echo $vtruename_select;?>&nbsp;
<?php echo $vbank_select;?>&nbsp;
<?php echo $vcompany_select;?>&nbsp;
會員名：<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
會員ID：<input type="text" name="uid" value="<?php echo $uid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<div class="tt">聯繫會員</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>公司</th>
<th>姓名</th>
<th>職位</th>
<th>性別</th>
<th>電話</th>
<th>手機</th>
<th colspan="8">聯繫方式</th>
<th width="40">狀態</th>
<th width="50">操作</th>
</tr>
<?php foreach($members as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="會員名:<?php echo $v['username'];?>&#10;會員ID:<?php echo $v['userid'];?>&#10;會員組:<?php echo $GROUP[$v['groupid']]['groupname'];?>">
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['company'];?></a><?php if($v['vip']) {?> <img src="<?php echo DT_SKIN;?>image/vip.gif" title="<?php echo VIP;?>:<?php echo $v['vip'];?>"/><?php } ?></td>
<td><?php echo $v['truename'];?></td>
<td><?php echo $v['career'];?></td>
<td><?php echo gender($v['gender']);?></td>
<td><?php echo $v['telephone'];?></td>
<td><?php echo $v['mobile'];?></td>

<td width="20"><?php if($v['mobile']) { ?><a href="?moduleid=2&file=sms&mobile=<?php echo $v['mobile'];?>" target="_blank"><img src="<?php echo DT_SKIN;?>image/mobile.gif" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><a href="?moduleid=2&file=message&action=send&touser=<?php echo $v['username'];?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/msg.gif" title="發送站內信" alt=""/></a></td> 

<td width="20"><a href="?moduleid=2&file=sendmail&email=<?php echo $v['email'];?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/email.gif" title="發送Email <?php echo $v['email'];?>" alt=""/></a></td>


<td width="20"><?php if($DT['im_web']) { echo im_web($v['username']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['qq']) { echo im_qq($v['qq']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['ali']) { echo im_ali($v['ali']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['msn']) { echo im_msn($v['msn']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['skype']) { echo im_skype($v['skype']); } else { echo '&nbsp;'; } ?></td>


<td><?php $ol = online($v['userid']);if($ol == 1) { ?><span class="f_red">在線</span><?php } else if($ol == -1) { ?><span class="f_blue">隱身</span><?php } else { ?><span class="f_gray">離線</span><?php } ?></td>

<td>
<a href="javascript:_user('<?php echo $v['username'];?>')"><img src="admin/image/view.png" width="16" height="16" title="會員[<?php echo $v['username'];?>]詳細資料" alt=""/></a> 
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="進入會員商務中心" alt=""/></a> 
</td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(4);</script>
<?php include tpl('footer');?>