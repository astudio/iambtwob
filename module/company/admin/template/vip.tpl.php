<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt"><?php echo VIP;?>搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $group_select;?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="fromtime" <?php if($timetype == 'fromtime') echo 'selected';?>>開通時間</option>
<option value="totime" <?php if($timetype == 'totime') echo 'selected';?>>到期時間</option>
</select>&nbsp;
<?php echo dcalendar('dfromtime', $dfromtime);?> 至 <?php echo dcalendar('dtotime', $dtotime);?>&nbsp;

<select name="vip">
<option value="0"><?php echo VIP;?>指數</option>
<?php 
for($i = 1; $i < 11; $i++) {
	echo '<option value="'.$i.'"'.($i == $vip ? ' selected' : '').'>'.$i.' 級</option>';
}
?>
</select>&nbsp;
理論值：<input type="text" name="vipt" value="<?php echo $vipt;?>" size="2"/>&nbsp;
修正值：<input type="text" name="vipr" value="<?php echo $vipr;?>" size="2"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo VIP;?>管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>會員ID</th>
<th>公司名稱</th>
<th>會員名</th>
<th>會員組</th>
<th>開通時間</th>
<th>到期時間</th>
<th><?php echo VIP;?>指數</th>
<th>理論值</th>
<th>修正值</th>
<th>管理</th>
</tr>
<?php foreach($companys as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td><?php echo $v['userid'];?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['company'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $GROUP[$v['groupid']]['groupname'];?></td>
<td class="px11"><?php echo timetodate($v['fromtime'], 3);?></td>
<td class="px11"><?php echo timetodate($v['totime'], 3);?></td>
<td><img src="<?php echo DT_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif"/></td>
<td><?php echo $v['vipt'];?></td>
<td><?php echo $v['vipr'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=show&username=<?php echo $v['username'];?>"><img src="admin/image/view.png" width="16" height="16" title="會員[<?php echo $v['username'];?>]詳細資料" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="進入會員商務中心" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 更新指數 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=update';"/>&nbsp;
<input type="submit" value=" 撤銷<?php echo VIP;?> " class="btn" onclick="if(confirm('確定要撤銷選中公司<?php echo VIP;?>資格嗎嗎？')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" 更新所有 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=html&action=show&update=1';"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">名詞解釋</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><?php echo VIP;?>指數</td>
<td class="f_gray"><?php echo VIP;?>指數，是對<?php echo VIP;?>會員的綜合評分的一組1-10的數字，是理論值和修正值之和。指數越大，會員的級別、實力、可信度等越高，信息排名越靠前</td>
</tr>
<tr>
<td class="tl">理論值</td>
<td class="f_gray">理論值是由系統根據管理員設置的評分標準計算出的<?php echo VIP;?>指數值</td>
</tr>
<tr>
<td class="tl">修正值</td>
<td class="f_gray">為了消除理論值與會員實際綜合實力的誤差，由管理員進行人工干預的數值，可為正數，也可為負數</td>
</tr>
</table>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>