<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<style type="text/css">
.t1 {width:200px;padding:3px 10px 3px 10px;color:#006699;}
.t2 {width:100px;padding:3px 10px 3px 10px;color:green;text-align:center;}
.t2 span {color:red;}
.t3 {padding:5px 10px 5px 10px;line-height:180%;}
</style>
<div class="tt">系統體檢</div>
<table cellpadding="2" cellspacing="1" class="tb" style="line-height:200%;">
<tr>
<th>項目</th>
<th>值</th>
<th>說明</th>
</tr>
<?php
	$D = is_write(DT_ROOT.'/file/') && is_write(DT_ROOT.'/file/cache/') && is_write(DT_ROOT.'/file/cache/tpl/') && is_write(DT_ROOT.'/file/upload/');
?>
<tr>
<td class="t1">file目錄是否可寫</td>
<td class="t2"><?php echo $D ? '可寫' : '<span>不可寫</span>';?></td>
<td class="t3">
file目錄及所有子目錄和子文件都必須設置可寫，否則會出現以下問題：<br/>
系統緩存無法更新<br/>
後台無法登錄<br/>
登錄後台不顯示密碼輸入框<br/>
前台頁面無法正常顯示<br/>
文件無法上傳<br/>
</td>
</tr>
<?php
	$S = 0;
	foreach($MODULE as $v) {
		if($v['moduleid'] > 1 && $v['domain']) $S = 1;
	}
	if($CFG['com_domain']) $S = 1;
	if(!$S && $DT['city']) {
		$r = $db->get_one("SELECT areaid FROM {$DT_PRE}city WHERE domain<>''");
		if($r) $S = 1;
	}
	$D = $CFG['cookie_domain'];
	if($S) {
?>
<tr>
<td class="t1">Cookie作用域</td>
<td class="t2"><?php echo $D ? $D : '<span>未設置</span>';?></td>
<td class="t3">
當前系統使用過二級域名，未設置Cookie作用域會出現以下問題：<br/>
驗證碼/驗證問題校驗錯誤<br/>
會員登錄狀態顯示錯誤<br/>
評論不顯示<br/>
</td>
</tr>
<?php } ?>

<?php
	if($CFG['skin'] == $CFG['template'] && $CFG['template'] != 'default') {
?>
<tr>
<td class="t1">模板和風格目錄</td>
<td class="t2"><span>同名</span></td>
<td class="t3">
模板和風格目錄同名會導致模板被下載，建議模板和風格使用不相同的目錄名稱
</td>
</tr>
<?php } ?>

<?php
	$D = ini_get('allow_url_fopen');
?>
<tr>
<td class="t1">允許使用URL打開文件<br/>allow_url_fopen</td>
<td class="t2"><?php echo $D ? 'On' : '<span>Off</span>';?></td>
<td class="t3">
建議設置為On，否則會出現以下問題：<br/>
遠程圖片無法保存<br/>
網絡圖片無法上傳<br/>
一鍵登錄無法登錄<br/>
</td>
</tr>

<?php
	$D = ini_get('memory_limit');
?>
<tr>
<td class="t1">程序最多允許使用內存量<br/>memory_limit</td>
<td class="t2"><?php echo $D;?></td>
<td class="t3">
內存設置過小會導致部分操作無法進行，顯示空白
</td>
</tr>

<?php
	$D = ini_get('post_max_size');
?>
<tr>
<td class="t1">POST最大字節數<br/>post_max_size</td>
<td class="t2"><?php echo $D;?></td>
<td class="t3">
大於<?php echo $D;?>的文件無法上傳<br/>
大於<?php echo $D;?>的信息無法提交
</td>
</tr>

<?php
	$D = ini_get('upload_max_filesize');
?>
<tr>
<td class="t1">允許最大上傳文件<br/>upload_max_filesize</td>
<td class="t2"><?php echo $D;?></td>
<td class="t3">
大於<?php echo $D;?>的文件無法上傳
</td>
</tr>

<?php
	$D = function_exists('fsockopen');
?>
<tr>
<td class="t1">fsockopen</td>
<td class="t2"><?php echo $D ? '支持' : '<span>不支持</span>';?></td>
<td class="t3">
如果不支持，將會出現以下問題：<br/>
充值接口無法使用<br/>
手機短信無法發送<br/>
電子郵件無法發送<br/>
一鍵登錄無法登錄<br/>

</td>
</tr>

<?php
	$D = function_exists('curl_init');
?>
<tr>
<td class="t1">curl</td>
<td class="t2"><?php echo $D ? '支持' : '<span>不支持</span>';?></td>
<td class="t3">
如果不支持，將會出現以下問題：<br/>
一鍵登錄無法登錄<br/>
</td>
</tr>

<?php
	$D = function_exists('json_decode');
?>
<tr>
<td class="t1">json</td>
<td class="t2"><?php echo $D ? '支持' : '<span>不支持</span>';?></td>
<td class="t3">
如果不支持，將會出現以下問題：<br/>
一鍵登錄無法登錄<br/>
</td>
</tr>

</table>
</div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>