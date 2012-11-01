<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
load('profile.js');
?>
<div class="tt">會員資料修改</div>
<form method="post" action="?" onsubmit="return Dcheck();" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="username" value="<?php echo $username;?>"/>
<input type="hidden" name="gid" value="<?php echo $groupid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="member[regid]" value="<?php echo $regid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 會員登錄名</td>
<td><strong><?php echo $username;?></strong>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&username=<?php echo urlencode($username);?>&catid=1#editusername" class="t">[修改會員名]</a></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 通行證戶名</td>
<td><input type="text" size="30" name="member[passport]" id="passport" value="<?php echo $passport;?>"/>&nbsp;<span id="dpassport" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 會員組</td>
<td><?php echo group_select('member[groupid]', '會員組', $groupid, 'id="groupid"');?>&nbsp;<span id="dgroupid" class="f_red"></span></td>
</tr>
<?php if($userid != $_userid) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 登錄密碼</td>
<td><input type="password" size="20" name="member[password]" id="password" onblur="validator('password');" autocomplete="off"/>&nbsp;<span id="dpassword" class="f_red"></span> <span class="f_gray">如不更改,請留空</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 重複輸入密碼</td>
<td><input type="password" size="20" name="member[cpassword]" id="cpassword" autocomplete="off"/>&nbsp;<span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 支付密碼</td>
<td><input type="password" size="20" name="member[payword]" id="payword" onblur="validator('payword');" autocomplete="off"/>&nbsp;<span id="dpayword" class="f_red"></span> <span class="f_gray">如不更改,請留空</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 重複支付密碼</td>
<td><input type="password" size="20" name="member[cpayword]" id="cpayword" autocomplete="off"/>&nbsp;<span id="dcpayword" class="f_red"></span></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> Email</td>
<td><input type="text" size="30" name="member[email]" id="email" value="<?php echo $email;?>" onblur="validator('email');"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vemail ? 'v' : 'u';?>_email.gif" width="16" height="16" title="<?php echo $vemail ? '已通過' : '未通過';?>郵件認證" align="absmiddle"/></a>&nbsp;<span id="demail" class="f_red"></span> <span class="f_gray">[不公開]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 真實姓名</td>
<td><input type="text" size="10" name="member[truename]" id="truename" value="<?php echo $truename;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vtruename ? 'v' : 'u';?>_truename.gif" width="16" height="16" title="<?php echo $vtruename ? '已通過' : '未通過';?>實名認證" align="absmiddle"/></a>&nbsp;<span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 性別</td>
<td>
<input type="radio" name="member[gender]" value="1" <?php if($gender == 1) echo 'checked="checked"';?>/> 先生
<input type="radio" name="member[gender]" value="2" <?php if($gender == 2) echo 'checked="checked"';?>/> 女士
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 所在地區</td>
<td><?php echo ajax_area_select('member[areaid]', '請選擇', $areaid);?>&nbsp;<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 部門</td>
<td><input type="text" size="20" name="member[department]" id="department" value="<?php echo $department;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 職位</td>
<td><input type="text" size="20" name="member[career]" id="career" value="<?php echo $career;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 手機號碼</td>
<td><input type="text" size="20" name="member[mobile]" id="mobile" value="<?php echo $mobile;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vmobile ? 'v' : 'u';?>_mobile.gif" width="16" height="16" title="<?php echo $vmobile ? '已通過' : '未通過';?>手機認證" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td><input type="text" size="20" name="member[qq]" id="qq" value="<?php echo $qq;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
<td><input type="text" size="20" name="member[ali]" id="ali" value="<?php echo $ali;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td><input type="text" size="30" name="member[msn]" id="msn" value="<?php echo $msn;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td><input type="text" size="20" name="member[skype]" id="skype" value="<?php echo $skype;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 站內信提示音</td>
<td class="tr">
<div id="audition"></div>
<input type="radio" name="member[sound]" value="0" <?php if($sound==0) { ?>checked="checked"<?php } ?> id="sound_0"/><label for="sound_0"> 無</label>&nbsp;&nbsp;
<input type="radio" name="member[sound]" value="1" <?php if($sound==1) { ?>checked="checked"<?php } ?> id="sound_1"/> <a href="javascript:Inner('audition', sound('message_1'));Dd('sound_1').checked=true;void(0);" title="點擊試聽">提示音1</a>&nbsp;&nbsp;
<input type="radio" name="member[sound]" value="2" <?php if($sound==2) { ?>checked="checked"<?php } ?> id="sound_2"/> <a href="javascript:Inner('audition', sound('message_2'));Dd('sound_2').checked=true;void(0);" title="點擊試聽">提示音2</a>&nbsp;&nbsp;
<input type="radio" name="member[sound]" value="3" <?php if($sound==3) { ?>checked="checked"<?php } ?> id="sound_3"/> <a href="javascript:Inner('audition', sound('message_3'));Dd('sound_3').checked=true;void(0);" title="點擊試聽">提示音3</a>&nbsp;&nbsp;
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 收款銀行</td>
<td>
<select name="member[bank]">
<option value="">收款方式</option>
<?php foreach($BANKS as $v) { ?>
<option value="<?php echo $v;?>" <?php if($bank == $v) { ?>selected<?php } ?>><?php echo $v;?></option>;
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 收款帳號</td>
<td><input type="text" size="30" name="member[account]" id="account" value="<?php echo $account;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vbank ? 'v' : 'u';?>_bank.gif" width="16" height="16" title="<?php echo $vbank ? '已通過' : '未通過';?>銀行帳號認證" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $DT['trade_nm'];?>帳號</td>
<td><input type="text" size="30" name="member[trade]" id="trade" value="<?php echo $trade;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vbank ? 'v' : 'u';?>_trade.gif" width="16" height="16" title="<?php echo $vbank ? '已通過' : '未通過';?><?php echo $DT['trade_nm'];?>帳號認證" align="absmiddle"/></a></td>
</tr>
<?php echo $MFD ? fields_html('<td class="tl">', '<td>', $user, $MFD) : '';?>
</table>
<div class="tt"><span class="f_hid">*</span> 公司資料</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 公司名稱</td>
<td><input type="text" size="60" name="member[company]" id="company" value="<?php echo $company;?>" onblur="validator('company');"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vcompany ? 'v' : 'u';?>_company.gif" width="16" height="16" title="<?php echo $vcompany ? '已通過' : '未通過';?>工商認證" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司類型</td>
<td><?php echo dselect($COM_TYPE, 'member[type]', '請選擇', $type, 'id="type"', 0);?>&nbsp;<span id="dtype" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 形象圖片</td>
<td><input name="member[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span><br/>
<span class="f_gray">建議使用LOGO、辦公環境等標誌性圖片，最佳大小為<?php echo $MOD['thumb_width'];?>px*<?php echo $MOD['thumb_height'];?>px</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 主營行業</td>
<td>
<div id="catesch"></div><div id="cate"><?php echo ajax_category_select('', '', 0, 4, 'size="2" style="height:80px;width:160px;"');?></div>
<input type="button" value=" 添加↓ " class="btn" onclick="addcate(<?php echo $MOD['cate_max'];?>);"/>
<input type="button" value=" ×刪除 " class="btn" onclick="delcate();"/>
<?php if($DT['schcate_limit']) { ?><input type="button" class="btn" value=" 搜索 " onclick="schcate(4);"/><?php } ?>
&nbsp;最多可添加 <strong class="f_red"><?php echo $MOD['cate_max'];?></strong> 個主營行業
<br/><select name="cates" id="cates" size="2" style="height:100px;width:380px;margin-top:5px;">
<?php if(is_array($cates)) { foreach($cates as $c) { ?>
<option value="<?php echo $c;?>"><?php echo strip_tags(cat_pos(get_cat($c), '/'));?></option>
<?php } } ?>
</select>
<input type="hidden" name="member[catid]" value="<?php echo $catid;?>" id="catid"/><br/>
<span id="dcatid" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 主要經營範圍</td>
<td><input type="text" size="80" name="member[business]" id="business" value="<?php echo $business;?>"/>&nbsp;<span id="dbusiness" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 經營模式</td>
<td>
<span id="com_mode"><?php echo dcheckbox($COM_MODE, 'member[mode][]', $mode, 'onclick="check_mode(this,'.$MOD['mode_max'].');"', 0);?></span> <span class="f_gray">(最多可選<?php echo $MOD['mode_max'];?>種)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司規模</td>
<td><?php echo dselect($COM_SIZE, 'member[size]', '請選擇規模', $size, '', 0);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 註冊資本</td>
<td><?php echo dselect($MONEY_UNIT, 'member[regunit]', '', $regunit, '', 0);?> <input type="text" size="6" name="member[capital]" id="capital" value="<?php echo $capital;?>"/> 萬</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司成立年份</td>
<td><input type="text" size="15" name="member[regyear]" id="regyear" value="<?php echo $regyear;?>"/>&nbsp;<span id="dregyear" class="f_red"></span> <span class="f_gray">(年份，如：2004)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司地址</td>
<td><input type="text" size="60" name="member[address]" id="address" value="<?php echo $address;?>"/>&nbsp;<span id="daddress" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 郵政編碼</td>
<td><input type="text" size="8" name="member[postcode]" id="postcode" value="<?php echo $postcode;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 公司電話</td>
<td><input type="text" size="20" name="member[telephone]" id="telephone" value="<?php echo $telephone;?>"/>&nbsp;<span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司傳真</td>
<td><input type="text" size="20" name="member[fax]" id="fax" value="<?php echo $fax;?>"/></td>
</tr><tr>
<td class="tl"><span class="f_hid">*</span> 公司Email</td>
<td><input type="text" size="30" name="member[mail]" id="mail" value="<?php echo $mail;?>"/> <span class="f_gray">[公開]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司網址</td>
<td><input type="text" size="30" name="member[homepage]" id="homepage" value="<?php echo $homepage;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 銷售的產品(服務)</td>
<td><input type="text" size="50" name="member[sell]" id="sell" value="<?php echo $sell;?>"/> <span class="f_gray">多個產品或服務請用'|'號隔開</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 採購的產品(服務)</td>
<td><input type="text" size="50" name="member[buy]" id="buy" value="<?php echo $buy;?>"/> <span class="f_gray">多個產品或服務請用'|'號隔開</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司介紹</td>
<td><textarea name="member[introduce]" id="introduce" class="dsn"><?php echo $introduce;?></textarea>
<?php echo deditor($moduleid, 'introduce', $MOD['editor'], '95%', 300);?><br/><span id="dintroduce" class="f_red"></span></td>
</tr>
<?php echo $CFD ? fields_html('<td class="tl">', '<td>', $user, $CFD) : '';?>
</table>
<div class="tt">資料認證</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 企業資料是否通過認證</td>
<td>
<input type="radio" name="member[validated]" value="1" <?php if($validated) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[validated]" value="0" <?php if(!$validated) echo 'checked';?>/> 否
<?php tips('一般由第三方認證機構或網站對會員總體資料的認證');?><a name="vv"></a>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 認證名稱或機構</td>
<td><input type="text" name="member[validator]" size="30" value="<?php echo $validator;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 認證日期</td>
<td><?php echo dcalendar('member[validtime]', $validtime);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 郵件認證</td>
<td>
<input type="radio" name="member[vemail]" value="1" <?php if($vemail) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vemail]" value="0" <?php if(!$vemail) echo 'checked';?>/> 否
<?php tips('開啟郵件發送後，此項由會員自行認證');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 手機認證</td>
<td>
<input type="radio" name="member[vmobile]" value="1" <?php if($vmobile) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vmobile]" value="0" <?php if(!$vmobile) echo 'checked';?>/> 否
<?php tips('開啟短信發送後，此項由會員自行認證');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 銀行認證</td>
<td>
<input type="radio" name="member[vbank]" value="1" <?php if($vbank) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vbank]" value="0" <?php if(!$vbank) echo 'checked';?>/> 否
<?php tips('一般在會員提現之後，由網站進行付款認證，認證之後會員的收款信息將不可修改');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $DT['trade_nm'];?>帳號認證</td>
<td>
<input type="radio" name="member[vtrade]" value="1" <?php if($vtrade) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vtrade]" value="0" <?php if(!$vtrade) echo 'checked';?>/> 否
<?php tips('會員通過支付寶擔保交易之後，系統自動認證');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 實名認證</td>
<td>
<input type="radio" name="member[vtruename]" value="1" <?php if($vtruename) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vtruename]" value="0" <?php if(!$vtruename) echo 'checked';?>/> 否
<?php tips('一般由會員在線提交身份證或其他證件電子文檔或傳真件，由網站進行認證');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司認證</td>
<td>
<input type="radio" name="member[vcompany]" value="1" <?php if($vcompany) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vcompany]" value="0" <?php if(!$vcompany) echo 'checked';?>/> 否
<?php tips('一般由會員在線提交營業執照、組織機構代碼證等電子文檔或傳真件，由網站進行認證');?>
</td>
</tr>
</table>
<div class="tt">高級設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 主頁風格目錄</td>
<td><input type="text" size="20" name="member[skin]" value="<?php echo $skin;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 主頁模板目錄</td>
<td><input type="text" size="20" name="member[template]" value="<?php echo $template;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 綁定域名</td>
<td><input type="text" size="30" name="member[domain]" id="domain" value="<?php echo $domain;?>"/><?php tips('例如 www.destoon.com 不帶http<br/>同時需要會員將此域名IP指向本站服務器');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 域名ICP備案號</td>
<td><input type="text" size="30" name="member[icp]" id="icp" value="<?php echo $icp;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 站內信黑名單</td>
<td><input type="text" size="60" name="member[black]" id="black" value="<?php echo $black;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 客服專員</td>
<td><input type="text" size="20" name="member[support]" id="support" value="<?php echo $support;?>"/> <a href="javascript:_user(Dd('support').value);" class="t">[資料]</a> <?php tips('填寫客服會員名，填寫後會員可以看到此客服的聯繫方式，以便提供一對一服務');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 推薦註冊人 </td>
<td><input type="text" size="20" name="member[inviter]" id="inviter" value="<?php echo $inviter;?>"/> <a href="javascript:_user(Dd('inviter').value);" class="t">[資料]</a> <?php tips('推薦此會員註冊的會員名，系統自動記錄，一般無須填寫');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 會員資料是否完整</td>
<td>
<input type="radio" name="member[edittime]" value="1"<?php if($edittime) echo ' checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[edittime]" value="0"<?php if(!$edittime) echo ' checked';?>/> 否&nbsp;&nbsp;
<span class="f_gray">如果選擇是，系統將不再提示會員完善資料</span>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn">&nbsp;&nbsp;<input type="button" value=" 前 台 " class="btn" onclick="window.open('?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $userid;?>');"/>&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
var vid = '';
function validator(id) {
	if(!Dd(id).value) return false;
	vid = id;
	makeRequest('moduleid=<?php echo $moduleid;?>&action=member&job='+id+'&value='+Dd(id).value+'&userid=<?php echo $userid;?>', AJPath, 'dvalidator')
}
function dvalidator() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		Dd('d'+vid).innerHTML = xmlHttp.responseText ? xmlHttp.responseText : '';
	}
}
function Dcheck() {
	if(Dd('groupid').value == 0) {
		Dmsg('請選擇會員組', 'groupid');
		return false;
	}
	<?php if($userid != $_userid) { ?>
	if(Dd('password').value != '') {
		if(Dd('cpassword').value == '') {
			Dmsg('請重複輸入密碼', 'cpassword');
			return false;
		}
		if(Dd('password').value != Dd('cpassword').value) {
			Dmsg('兩次輸入的密碼不一致', 'password');
			return false;
		}
	}
	if(Dd('payword').value != '') {
		if(Dd('cpayword').value == '') {
			Dmsg('請重複輸入支付密碼', 'cpayword');
			return false;
		}
		if(Dd('payword').value != Dd('cpayword').value) {
			Dmsg('兩次輸入的支付密碼不一致', 'payword');
			return false;
		}
	}
	<?php } ?>
	if(Dd('passport').value == '') {
		Dmsg('請填寫通行證', 'passport');
		return false;
	}
	if(Dd('email').value == '') {
		Dmsg('請填寫電子郵箱', 'email');
		return false;
	}
	if(Dd('truename').value == '') {
		Dmsg('請填寫真實姓名', 'truename');
		return false;
	}
	if(Dd('areaid_1').value == 0) {
		Dmsg('請選擇所在地', 'areaid');
		return false;
	}
	<?php echo $MFD ? fields_js($MFD) : '';?>
	<?php if($groupid > 5) { ?>
	<?php echo $CFD ? fields_js($CFD) : '';?>
	if(Dd('company').value == '') {
		Dmsg('請填寫公司名稱', 'company');
		return false;
	}
	if(Dd('type').value == '') {
		Dmsg('請選擇公司類型', 'type');
		return false;
	}
	if(Dd('catid').value.length < 2) {
		Dmsg('請選擇公司主營行業', 'catid');
		return false;
	}
	if(Dd('business').value.length < 2) {
		Dmsg('請填寫主要經營範圍', 'business');
		return false;
	}
	if(Dd('regyear').value.length < 4) {
		Dmsg('請填寫公司成立年份', 'regyear');
		return false;
	}
	if(Dd('address').value.length < 2) {
		Dmsg('請填寫公司地址', 'address');
		return false;
	}
	if(Dd('telephone').value.length < 6) {
		Dmsg('請填寫公司電話', 'telephone');
		return false;
	}
	if(FCKLen('introduce') < 5) {
		Dmsg('公司介紹不能少於5字，當前已經輸入'+FCKLen('introduce')+'字', 'introduce');
		return false;
	}
	<?php } ?>
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>