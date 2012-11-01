<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
if(isset($dialog)) {
?>
<script type="text/javascript">
var new_top = Number(parent.Dd('Dtop').style.top.replace('px', ''));
if(new_top > 100) new_top -= 50;
try{parent.Dd('Dtop').style.top=new_top+'px';}catch(e){}
</script>
<?php
} else {
	show_menu($menus);
}
?>
<div class="tt">會員資料</div>
<table cellpadding="2" cellspacing="1" class="tb">

<tr>
<td class="tl">會員名</td>
<td>&nbsp;<a href="<?php echo $linkurl;?>" target="_blank"><?php echo $username;?></a>
[<?php $ol = online($userid);if($ol == 1) { ?><span class="f_red">在線</span><?php } else if($ol == -1) { ?><span class="f_blue">隱身</span><?php } else { ?><span class="f_gray">離線</span><?php } ?>]
</td>
<td class="tl">會員ID</td>
<td>&nbsp;<?php echo $userid;?>&nbsp;&nbsp;
</tr>

<tr>
<td class="tl">即時通訊</td>
<td>&nbsp;
<?php if($DT['im_web']) { ?><?php echo im_web($username);?> <?php } ?>
<a href="?moduleid=2&file=sendmail&email=<?php echo $email;?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/email.gif" title="發送Email <?php echo $email;?>" align="absmiddle"/></a> 
<?php if($mobile) { ?><a href="?moduleid=2&file=sms&mobile=<?php echo $mobile;?>" target="_blank"><img src="<?php echo DT_SKIN;?>image/mobile.gif" title="發送短信" align="absmiddle"/></a> <?php } ?>
<a href="?moduleid=2&file=message&action=send&touser=<?php echo $username;?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/msg.gif" title="發送站內信" align="absmiddle"/></a>
<?php echo im_qq($qq);?>  
<?php echo im_ali($ali);?> 
<?php echo im_msn($msn);?> 
<?php echo im_skype($skype);?> 
<a href="<?php echo $linkurl;?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/homepage.gif" title="公司主頁" align="absmiddle"/></a> 
</td>
<td class="tl">會員組</td>
<td class="f_red">&nbsp;<?php echo $GROUP[$groupid]['groupname'];?></td>
</tr>
<tr>
<td class="tl">快捷管理</td>
<td class="f_gray">&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $userid;?>" class="t" target="_blank" title="點擊登入會員商務中心">會員前台</a> | 
<a href="?moduleid=<?php echo $moduleid;?>&action=edit&userid=<?php echo $userid;?>" class="t"<?php if(isset($dialog)) {?> target="_blank"<?php } ?>>修改資料</a> | 
<a href="?moduleid=<?php echo $moduleid;?>&action=move&groupids=2&userid=<?php echo $userid;?>" class="t"<?php if(isset($dialog)) {?> target="_blank"<?php } ?> onclick="return confirm('確定要禁止此會員訪問嗎？');">禁止訪問</a> | 
<a href="?moduleid=<?php echo $moduleid;?>&action=delete&userid=<?php echo $userid;?>&forward=<?php echo urlencode('?moduleid='.$moduleid);?>" class="t"<?php if(isset($dialog)) {?> target="_blank"<?php } ?> onclick="return confirm('確定要刪除此會員嗎？系統將刪除選中用戶所有信息，此操作將不可撤銷');">刪除會員</a>

</td>
<td class="tl">通行證名</td>
<td>&nbsp;<?php echo $passport;?></td>
</tr>
<tr>
<td class="tl">姓 名</td>
<td>&nbsp;<?php echo $truename;?></td>
<td class="tl">性 別</td>
<td>&nbsp;<?php echo $gender == 1 ? '先生' : '女士';?></td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>指數</td>
<td>&nbsp;<img src="<?php echo DT_SKIN;?>image/vip_<?php echo $vip;?>.gif"/></td>
<td class="tl">登錄次數</td>
<td>&nbsp;<?php echo $logintimes;?></td>
</tr>
<?php if($totime) { ?>
<tr>
<td class="tl">服務開始日期</td>
<td>&nbsp;<?php echo timetodate($fromtime, 3);?></td>
<td class="tl">服務結束日期</td>
<td>&nbsp;<?php echo timetodate($totime, 3);?><?php echo $totime < $DT_TIME ? ' <span class="f_red">[已過期]</span>' : '';?></td>
</tr>
<?php } ?>
<tr>
<td class="tl">上次登錄</td>
<td>&nbsp;<?php echo timetodate($logintime, 6);?></td>
<td class="tl">登錄IP</td>
<td>&nbsp;<?php echo $loginip;?> - <?php echo ip2area($loginip);?></td>
</tr>
<tr>
<td class="tl">註冊時間</td>
<td>&nbsp;<?php echo timetodate($regtime, 6);?></td>
<td class="tl">註冊IP</td>
<td>&nbsp;<?php echo $regip;?> - <?php echo ip2area($regip);?></td>
</tr>
<tr>
<td class="tl"><?php echo $DT['money_name'];?>餘額</td>
<td>&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=record&username=<?php echo $username;?>" target="_blank"><strong class="f_red"><?php echo $money;?></strong></a> <?php echo $DT['money_unit'];?></td>
<td class="tl"><?php echo $DT['money_name'];?>鎖定</td>
<td>&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=record&username=<?php echo $username;?>" target="_blank"><strong class="f_gray"><?php echo $locking;?></strong></a> <?php echo $DT['money_unit'];?></td>
</tr>
<tr>
<td class="tl">短信餘額</td>
<td>&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=sms&action=record&username=<?php echo $username;?>" target="_blank"><strong class="f_red"><?php echo $sms;?></strong></a> 條</td>
<td class="tl">會員<?php echo $DT['credit_name'];?></td>
<td>&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=credit&kw=<?php echo $username;?>" target="_blank"><strong class="f_blue"><?php echo $credit;?></strong></a> <?php echo $DT['credit_unit'];?></td>
</tr>
</table>
<div class="tt">公司資料</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">公司主頁</td>
<td colspan="3">&nbsp;<a href="<?php echo $linkurl;?>" target="_blank" style="color:red;"><?php echo $linkurl;?></a></td>
</tr>
<tr>
<td class="tl">公司名</td>
<td>&nbsp;<?php echo $company;?></td>
<td class="tl">公司類型</td>
<td>&nbsp;<?php echo $type;?></td>
</tr>
<td class="tl">經營模式</td>
<td>&nbsp;<?php echo $mode;?></td>
<td class="tl">主營範圍</td>
<td>&nbsp;<?php echo $business;?></td>
</tr>
<tr>
<td class="tl">註冊資本</td>
<td>&nbsp;<?php echo $capital;?>萬<?php echo $regunit;?></td>
<td class="tl">公司規模</td>
<td>&nbsp;<?php echo $size;?></td>
</tr>
<tr>
<td class="tl">成立年份</td>
<td>&nbsp;<?php echo $regyear;?></td>
<td class="tl">公司所在地</td>
<td>&nbsp;<?php echo area_pos($areaid, '/');?></td>
</tr>
<tr>
<td class="tl">銷售的產品 (提供的服務)</td>
<td>&nbsp;<?php echo $sell;?></td>
<td class="tl">採購的產品 (需要的服務)</td>
<td>&nbsp;<?php echo $buy;?></td>
</tr>
<?php if($catid) { ?>
<?php $MOD['linkurl'] = $MODULE[4]['linkurl'];?>
<tr>
<td class="tl">主營行業：</td>
<td colspan="3">
	<?php $catids = explode(',', substr($catid, 1, -1));?>
	<table cellpadding="2" cellspacing="2" width="100%">
	<?php foreach($catids as $i=>$c) { ?>
	<?php if($i%3==0) echo '<tr>';?>
	<td width="33%"><?php echo cat_pos(get_cat($c), ' / ', '_blank');?></td>
	<?php if($i%3==2) echo '</tr>';?>
	<?php } ?>
	</table>
</td>
</tr>
<?php } ?>
</table>

<div class="tt">聯繫方式</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">姓 名</td>
<td>&nbsp;<?php echo $truename;?></td>
<td class="tl">手 機</td>
<td>&nbsp;<?php if($mobile) { ?><a href="?moduleid=2&file=sms&mobile=<?php echo $mobile;?>" target="_blank"><img src="<?php echo DT_SKIN;?>image/mobile.gif" title="發送短信" align="absmiddle"/></a> <?php } ?><?php echo $mobile;?></td>
</tr>
<tr>
<td class="tl">部 門</td>
<td>&nbsp;<?php echo $department;?></td>
<td class="tl">職 位</td>
<td>&nbsp;<?php echo $career;?></td>
</tr>
<tr>
<td class="tl">電 話</td>
<td>&nbsp;<?php echo $telephone;?></td>
<td class="tl">傳 真</td>
<td>&nbsp;<?php echo $fax;?></td>
</tr>
<tr>
<td class="tl">Email (不公開)</td>
<td>&nbsp;<a href="?moduleid=2&file=sendmail&email=<?php echo $email;?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/email.gif" title="發送Email <?php echo $email;?>" alt="" align="absmiddle"/></a> <?php echo $email;?></td>
<td class="tl">Email (公開)</td>
<td>&nbsp;<?php if($mail) { ?><a href="?moduleid=2&file=sendmail&email=<?php echo $email;?>" target="_blank"><img width="16" height="16" src="<?php echo DT_SKIN;?>image/email.gif" title="發送Email <?php echo $mail;?>" alt="" align="absmiddle"/></a> <?php } ?><?php echo $mail;?></td>
</tr>
<tr>
<td class="tl">QQ</td>
<td>&nbsp;<?php echo im_qq($qq);?> <?php echo $qq;?></td>
<td class="tl">阿里旺旺</td>
<td>&nbsp;<?php echo im_ali($ali);?> <?php echo $ali;?></td>
</tr>
<tr>
<td class="tl">MSN</td>
<td>&nbsp;<?php echo im_msn($msn);?> <?php echo $msn;?></td>
<td class="tl">Skype</td>
<td>&nbsp;<?php echo im_skype($skype);?> <?php echo $skype;?></td>
</tr>
<tr>
<td class="tl">網 址</td>
<td>&nbsp;<?php echo $homepage;?></td>
<td class="tl">郵 編</td>
<td>&nbsp;<?php echo $postcode;?></td>
</tr>
<tr>
<td class="tl">公司經營地址</td>
<td colspan="3">&nbsp;<?php echo $address;?></td>
</tr>
</table>
<div class="tt">其他信息</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">推薦註冊人</td>
<td>&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&action=show&username=<?php echo $inviter;?>" target="_blank"><?php echo $inviter;?></a></td>
</tr>
<tr>
<td class="tl">企業資料是否通過認證</td>
<td>&nbsp;<?php echo $validated ? '是' : '否';?></td>
</tr>
<tr>
<td class="tl">認證名稱或機構</td>
<td>&nbsp;<?php echo $validator;?></td>
</tr>
<tr>
<td class="tl">認證日期</td>
<td>&nbsp;<?php echo $validtime ? timetodate($validtime, 3) : '';?></td>
</tr>
<tr>
<td class="tl">主頁風格目錄 </td>
<td>&nbsp;<?php echo $skin;?></td>
</tr>
<tr>
<td class="tl">主頁模板目錄 </td>
<td>&nbsp;<?php echo $template;?></td>
</tr>
<tr>
<td class="tl">頂級域名</td>
<td>&nbsp;<?php echo $domain;?></td>
</tr>
<tr>
<td class="tl">ICP備案號</td>
<td>&nbsp;<?php echo $icp;?></td>
</tr>
<tr>
<td class="tl">黑名單</td>
<td>&nbsp;<?php echo $black;?></td>
</tr>
<tr>
<td class="tl">資料更新時間</td>
<td>&nbsp;<?php echo $edittime ? timetodate($edittime, 6) : '';?></td>
</tr>
<?php if(!isset($dialog)) { ?>
<tr>
<td class="tl"> </td>
<td colspan="3" height="30"><input type="button" value=" 修 改 " class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&action=edit&userid=<?php echo $userid;?>&forward=<?php echo urlencode($DT_URL);?>';"/>&nbsp;&nbsp;<input type="button" value=" 前 台 " class="btn" onclick="window.open('?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $userid;?>');"/>&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
<?php } ?>
</table>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>