<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="type" value="<?php echo $type;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="tb" value="<?php echo $tb;?>"/>
<input type="hidden" name="data[type]" value="<?php echo $type;?>"/>
<input type="hidden" name="data[mid]" value="<?php echo $mid;?>"/>
<input type="hidden" name="data[tb]" value="<?php echo $tb;?>"/>
<input type="hidden" name="data[lasttime]" value="<?php echo $lasttime;?>"/>
<input type="hidden" name="data[lastid]" value="<?php echo $lastid;?>"/>
<div class="tt">導入設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 導入類型</td>
<td>
<?php
	if($type == 0) {
		echo $MODULE[$mid]['name'];
	} else if($type == 1) {
		echo '會員';
	} else if($type == 2) {
		echo $tb;
	}
?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 配置名稱</td>
<td class="f_gray">
<input type="text" name="name" size="30" value="<?php echo $name;?>" id="name"/><br/>
- 限數字、字母、下劃線、中劃線、點 系統將創建配置文件至 file/data/ 目錄
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 配置說明</td>
<td class="f_gray">
<input type="text" name="data[title]" size="60" value="<?php echo $title;?>"/><br/>
- 配置的一些說明、備註文字 支持中文
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 數據源</td>
<td>
<input type="radio" name="data[database]" value="mysql" id="d_0" <?php echo $database == 'mysql' ? 'checked' : '';?>/><label for="d_0"/> MySQL</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="data[database]" value="mssql" id="d_1" <?php echo $database == 'mssql' ? 'checked' : '';?>/><label for="d_1"/> MSSQL2000</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="data[database]" value="access" id="d_2" <?php echo $database == 'access' ? 'checked' : '';?>/><label for="d_2"/> Access</label>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 主機地址</td>
<td class="f_gray">
<input type="text" name="data[db_host]" size="40" value="<?php echo $db_host;?>"/><br/>
- Access文件請傳至網站目錄 例如 file/data/access.mdb 然後 填寫 file/data/access.mdb
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 戶名</td>
<td><input type="text" name="data[db_user]" size="20" value="<?php echo $db_user;?>"/> </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 密碼</td>
<td><input type="text" name="data[db_pass]" size="20" value="<?php echo $db_pass;?>"/> </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 數據庫</td>
<td><input type="text" name="data[db_name]" size="20" value="<?php echo $db_name;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 數據表</td>
<td class="f_gray">
<input type="text" name="data[db_table]" size="60" value="<?php echo $db_table;?>" id="db_table"/><br/>
- 如果是單個表，填寫表全名；如果是多個表，請填寫例如 table_a a,table_b b<br/>
- MySQL數據庫 如果導入的數據和當前系統在同一服務器的不同數據庫，則填寫 數據庫名.表名 例如 name.table<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 主鍵字段</td>
<td class="f_gray">
<input type="text" name="data[db_key]" size="20" value="<?php echo $db_key;?>" id="db_key"/><br/>
- 表的主鍵，如果沒有，請先創建一個主鍵<br/>
- 如果多表聯合請加聯合表簡稱 例如 a.id<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 源數據字符集</td>
<td class="f_gray">
<input type="text" name="data[db_charset]" size="10" value="<?php echo $db_charset;?>" id="db_charset"/><br/>
- 如果字符集與當前系統一致，則無需填寫，一般為UTF-8、GBK等<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 導入條件</td>
<td class="f_gray">
<input type="text" name="data[db_condition]" size="80" value="<?php echo $db_condition;?>"/><br/>
- 支持SQL語句，必須以AND開頭，例如 AND id>1000、AND a.id=b.id
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 上次導入ID</td>
<td class="f_gray">
<input type="text" name="data[lastid]" size="5" value="<?php echo $lastid ? $lastid : 0;?>"/><br/>
- 系統將記錄上次導入ID，以免下次導入時重複導入
</td>
</tr>
</table>
<div class="tt">字段對應關係</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl" align="center"><span class="f_hid">*</span> 對應說明</td>
<td colspan="3" class="f_gray">
- PHP不支持MSSQL和Access的 ntext,nvarchar..類型，請在導入前修改為text,varchar..類型<br/>
- 值處理填寫數字或者字符串代表字段的默認值，如果需要函數處理，請將參數設置為* <br/>
- 例 md5(*) 表示對源字段md5加密 md5(md5(*)) 表示加密2次<br/>
- 例 strtotime(*) 表示將2010-01-01日期格式轉換為Unix時間戳<br/>
- 例 date('Y-m-d', *) 表示將Unix時間戳轉換為類似2010-01-01日期格式<br/>
- 值處理支持變量或變量組合或變量+函數組合，源數據保存在 $F 數組，對應轉換結果保存在 $T 數組<br/>
- 例 $F['a'].$F['b'] 表示連接兩個源數據字段a和b<br/>
- 例 date('Y-m-d', $F['a']) 將源字段a轉換為日期格式<br/>
- 如果導入會員數據，會員名或Email重複的數據將被自動丟棄<br/>
</td>
</tr>
<tr align="center">
<th>字段</th>
<th>名稱(參考)</th>
<th>源字段</th>
<th>值處理</th>
</tr>
<?php foreach($fields as $k=>$f) { ?>
<tr align="center">
<td class="tl"><?php echo $k;?></td>
<td><?php echo isset($names[$k]) ? $names[$k] : '';?></td>
<td><input type="text" size="15" name="data[fields][<?php echo $k;?>][name]" value="<?php echo $f['name'];?>"/></td>
<td><input type="text" size="30" name="data[fields][<?php echo $k;?>][value]" value="<?php echo $f['value'];?>"/></td>
</tr>
<?php } ?>
<?php foreach($fields_d as $k=>$f) { ?>
<tr align="center">
<td class="tl"><?php echo $k;?></td>
<td><?php echo isset($names[$k]) ? $names[$k] : '';?></td>
<td><input type="text" size="15" name="data[fields][<?php echo $k;?>][name]" value="<?php echo $f['name'];?>"/></td>
<td><input type="text" size="30" name="data[fields][<?php echo $k;?>][value]" value="<?php echo $f['value'];?>"/></td>
</tr>
<?php } ?>
</table>
<div class="tt">PHP處理代碼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> PHP代碼</td>
<td class="f_gray">
- 如果需要在導出過程中執行PHP代碼，請FTP保存PHP代碼至 file/data/配置名稱.inc.php<br/>
- 代碼將在源數據循環讀出時執行，源數據保存在 $F 數組，對應轉換結果保存在 $T 數組<br/>
</td>
</tr>
<tr>
<td class="tl"> </td>
<td height="30"><input type="submit" name="submit" value="保 存" class="btn"/>&nbsp;&nbsp;<input type="button" value="返 回" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/></td>
</tr>
</table>
</form>
<br/>
<script type="text/javascript">
function check() {
	if(Dd('name').value.length < 1) {
		alert('請填寫配置名稱');
		Dd('name').focus();
		return false;
	}
	if(Dd('db_table').value.length < 1) {
		alert('請填寫數據表');
		Dd('db_table').focus();
		return false;
	}
	if(Dd('db_key').value.length < 1) {
		alert('請填寫主鍵字段');
		Dd('db_key').focus();
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>