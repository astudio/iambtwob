<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">日誌搜索</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> 至 <?php echo dcalendar('todate', $todate);?>&nbsp;
<select name="admin">
<option value="-1" <?php echo $admin == -1 ? 'selected' : '';?>>後台</option>
<option value="1" <?php echo $admin == 1 ? 'selected' : '';?>>是</option>
<option value="0" <?php echo $admin == 0 ? 'selected' : '';?>>否</option>
</select>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<div class="tt">登錄日誌</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>日誌ID</th>
<th>會員名</th>
<th>密碼[已加密]</th>
<th>時間</th>
<th>後台</th>
<th>結果</th>
<th>IP</th>
<th>地區</th>
<th>客戶端</th>
</tr>
<?php foreach($logs as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="px11"><?php echo $v['logid'];?></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&username=<?php echo $v['username'];?>"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['password'];?></td>
<td class="px11"><?php echo $v['logintime'];?></td>
<td><?php echo $v['admin'] ? '<span class="f_blue">是</span>' : '否';?></td>
<td><?php echo $v['message'];?></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&ip=<?php echo $v['loginip'];?>"><?php echo $v['loginip'];?></a></td>
<td><?php echo ip2area($v['loginip']);?></td>
<td title="<?php echo $v['agent'];?>"><input type="text" value="<?php echo $v['agent'];?>" size="20" onmouseover="this.select();"/></td>
</tr>
<?php }?>
</table>
<div class="tt">密碼工具</div>
<form action="?">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
密碼(明文)：<input type="text" size="15" name="password" id="password"/>
<input type="button" value="加 密" class="btn" onclick="md();"/>
加密結果： <input type="text" size="40" name="md5" id="md5"/>
日誌ID：<input type="text" size="5" name="logid" id="logid"/>
<input type="button" value="對 比" class="btn" onclick="cp();"/>&nbsp;
<span id="cpr" class="f_red"></span>
</td>
</tr>
<tr>
<td>
&nbsp;&nbsp;工具說明：1、用於分析帳號登錄異常情況。2、截獲暴力破解IP。3、驗證用戶帳號申訴提供的歷史密碼是否匹配
</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">
function md() {
	if(Dd('password').value == '') {
		alert('請輸入密碼(明文)');
		Dd('password').focus();
		return;
	}
	makeRequest('file=<?php echo $file;?>&moduleid=<?php echo $moduleid;?>&action=md&password='+Dd('password').value, '?', '_md');
}
function _md() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Dd('md5').value = xmlHttp.responseText;
		}
	}
}
function cp() {
	Dd('cpr').innerHTML = '';
	if(Dd('md5').value == '' || Dd('logid').value == '') {
		alert('請加密密碼或輸入需要對比的日誌ID');
		return;
	}
	makeRequest('file=<?php echo $file;?>&moduleid=<?php echo $moduleid;?>&action=cp&password='+Dd('md5').value+'&logid='+Dd('logid').value, '?', '_cp');
}
function _cp() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Dd('cpr').innerHTML = xmlHttp.responseText;
		}
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>