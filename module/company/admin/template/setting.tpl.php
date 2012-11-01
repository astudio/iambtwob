<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('基本設置'),
    array('SEO優化'),
    array('權限收費'),
    array('定義字段', '?file=fields&tb='.$table),
    array('模板管理', '?file=template&dir='.$module),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">基本設置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">信息排序方式</td>
<td>
<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
<select onchange="if(this.value) Dd('order').value=this.value;">
<option value="">請選擇</option>
<option value="vip desc"<?php if($order == 'vip desc') echo ' selected';?>><?php echo VIP;?>級別</option>
<option value="userid desc"<?php if($order == 'userid desc') echo ' selected';?>>會員ID</option>
</select>
</td>
</tr>
<tr>
<td class="tl">列表或搜索主字段</td>
<td><input type="text" size="80" name="setting[fields]" value="<?php echo $fields;?>"/><?php tips('此項可在一定程度上提高列表或搜索效率，請勿隨意修改以免導致SQL錯誤');?></td>
</tr>
<tr>
<td class="tl">內容分表</td>
<td>
<input type="radio" name="setting[split]" value="1"  <?php if($split) echo 'checked';?> onclick="Ds('split_b');Dh('split_a');confirm('提示:開啟之前必須先拆分內容\n\n此設置比較關鍵，開啟後建議不要再關閉');"/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[split]" value="0"  <?php if(!$split) echo 'checked';?> onclick="Ds('split_a');Dh('split_b');confirm('提示:關閉之前必須先合併內容');"/> 關閉
&nbsp;&nbsp;
<span style="display:none;" id="split_a">
<a href="?file=split&mid=<?php echo $moduleid;?>&action=merge" target="_blank" class="t" onclick="return confirm('確定要合併內容嗎？合併成功之後請立即關閉內容分表\n\n建議在合併之前備份一次數據庫');">[合併內容]</a>
</span>
<span style="display:none;" id="split_b">
<a href="?file=split&mid=<?php echo $moduleid;?>" target="_blank" class="t" onclick="return confirm('確定要拆分內容嗎？合併成功之後請立即開啟內容分表\n\n建議在拆分之前備份一次數據庫');">[拆分內容]</a>
</span>
&nbsp;<?php tips('如果開啟內容分表，內容表將根據id號50萬數據創建一個分區<br/>如果你的數據少於50萬，則不需要開啟，當前最大id為'.$maxid.'，'.($maxid > 500000 ? '建議開啟' : '無需開啟').'<br/>如果需要開啟，請先點拆分內容，然後保存設置<br/>如果需要關閉，請先點合併內容，然後保存設置<br/>此項一旦開啟，請不要隨意關閉，以免出現未知錯誤，同時全文搜索將關閉');?>
<input type="hidden" name="maxid" value="<?php echo $maxid;?>"/>
</td>
</tr>
<tr>
<td class="tl">公司主頁顯示評論</td>
<td>
<input type="radio" name="setting[comment]" value="1"  <?php if($comment){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment]" value="0"  <?php if(!$comment){ ?>checked <?php } ?>/> 關閉 </td>
</tr>
<tr>
<td class="tl">公司主頁信息鏈接到主站</td>
<td>
<input type="radio" name="setting[homeurl]" value="1"  <?php if($homeurl){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[homeurl]" value="0"  <?php if(!$homeurl){ ?>checked <?php } ?>/> 關閉 </td>
</tr>
<tr>
<td class="tl">資料未完善公司主頁</td>
<td>
<input type="radio" name="setting[openall]" value="1"  <?php if($openall){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[openall]" value="0"  <?php if(!$openall){ ?>checked <?php } ?>/> 關閉 </td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>到期自動刪除</td>
<td>
<input type="radio" name="setting[delvip]" value="1"  <?php if($delvip){ ?>checked <?php } ?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[delvip]" value="0"  <?php if(!$delvip){ ?>checked <?php } ?>/> 關閉
<?php tips('如果選擇開啟，服務到期之後，系統自動將'.VIP.'會員設置成普通會員<br/>如果選擇關閉，服務到期之後，會員可以繼續使用'.VIP.'服務，需要管理員從過期'.VIP.'裡手動刪除');?>
</td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>指數計算規則</td>
<td>
	<table cellpadding="3" cellspacing="1" width="400" bgcolor="#E5E5E5" style="margin:5px;">
	<tr align="center">
	<td>項目</td>
	<td>值</td>
	<td>最大值</td>
	</tr>
	<tr align="center">
	<td>會員組<?php echo VIP;?>指數</td>
	<td>相等</td>
	<td><input type="text" size="2" name="setting[vip_maxgroupvip]" value="<?php echo $vip_maxgroupvip;?>"/></td>
	</tr>
	<tr align="center">
	<td>企業資料認證</td>
	<td><input type="text" size="2" name="setting[vip_cominfo]" value="<?php echo $vip_cominfo;?>"/></td>
	<td><?php echo $vip_cominfo;?></td>
	</tr>
	<tr align="center">
	<td>VIP年份（單位：值/年）</td>
	<td><input type="text" size="2" name="setting[vip_year]" value="<?php echo $vip_year;?>"/></td>
	<td><input type="text" size="2" name="setting[vip_maxyear]" value="<?php echo $vip_maxyear;?>"/></td>
	</tr>
	<tr align="center">
	<td>5張以上資質證書</td>
	<td><input type="text" size="2" name="setting[vip_honor]" value="<?php echo $vip_honor;?>"/></td>
	<td><?php echo $vip_honor;?></td>
	</tr>
	</table>
	<span class="f_gray">&nbsp;&nbsp;所有數值均為整數。<?php echo VIP;?>指數滿分10分，故最大值之和應等於10</span>
</td>
</tr>

<tr>
<td class="tl">公司主頁地圖接口</td>
<td>
<select name="setting[map]">
<option value="">請選擇</option>
<?php
$dirs = list_dir('api/map');
foreach($dirs as $v) {
	$selected = ($map && $v['dir'] == $map) ? 'selected' : '';
	echo "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
echo '</select>';
tips('位於./api/map/目錄,一個目錄即為一個地圖接口，請注意配置對應的config.inc.php文件默認坐標和key<br/>請不要頻繁更換接口，以免用戶的設置失效。');
?>
</td> 
</tr>


<tr>
<td class="tl">公司主頁統計接口</td>
<td>
<select name="setting[stats]">
<option value="">請選擇</option>
<?php
$dirs = list_dir('api/stats');
foreach($dirs as $v) {
	$selected = ($stats && $v['dir'] == $stats) ? 'selected' : '';
	echo "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
echo '</select>';
tips('位於./api/stats/目錄,一個目錄即為一個統計接口<br/>請不要頻繁更換接口，以免用戶的設置失效。');
?>
</td> 
</tr>

<tr>
<td class="tl">公司主頁客服接口</td>
<td>
<select name="setting[kf]">
<option value="">請選擇</option>
<?php
$dirs = list_dir('api/kf');
foreach($dirs as $v) {
	$selected = ($kf && $v['dir'] == $kf) ? 'selected' : '';
	echo "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
echo '</select>';
tips('位於./api/kf/目錄,一個目錄即為一個客服接口<br/>請不要頻繁更換接口，以免用戶的設置失效。');
?>
</td> 
</tr>

<tr>
<td class="tl">級別中文別名</td>
<td>
<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
<br/>用 | 分隔不同別名 依次對應 1|2|3|4|5|6|7|8|9 級 <?php echo level_select('post[level]', '提交後點此預覽效果');?>
</td>
</tr>

<tr>
<td class="tl">首頁名企推薦數量</td>
<td><input type="text" size="3" name="setting[page_irec]" value="<?php echo $page_irec;?>"/></td>
</tr>

<tr>
<td class="tl">首頁最新<?php echo VIP;?>數量</td>
<td><input type="text" size="3" name="setting[page_ivip]" value="<?php echo $page_ivip;?>"/></td>
</tr>

<tr>
<td class="tl">首頁企業新聞數量</td>
<td><input type="text" size="3" name="setting[page_inews]" value="<?php echo $page_inews;?>"/></td>
</tr>

<tr>
<td class="tl">首頁最新加入數量</td>
<td><input type="text" size="3" name="setting[page_inew]" value="<?php echo $page_inew;?>"/></td>
</tr>

<tr>
<td class="tl">列表信息分頁數量</td>
<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
</tr>


<tr>
<td class="tl">按分類瀏覽列數</td>
<td><input type="text" size="3" name="setting[page_subcat]" value="<?php echo $page_subcat;?>"/></td>
</tr>

</table>
</div>

<div id="Tabs1" style="display:none">
<div class="tt">SEO優化</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">首頁是否生成html</td>
<td>
<input type="radio" name="setting[index_html]" value="1"  <?php if($index_html){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[index_html]" value="0"  <?php if(!$index_html){ ?>checked <?php } ?>/> 否
</td>
</tr>
<tr>
<td class="tl">列表頁是否生成html</td>
<td>
<input type="radio" name="setting[list_html]" value="1"  <?php if($list_html){ ?>checked <?php } ?> onclick="Dd('list_html').style.display='';Dd('list_php').style.display='none';"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[list_html]" value="0"  <?php if(!$list_html){ ?>checked <?php } ?> onclick="Dd('list_html').style.display='none';Dd('list_php').style.display='';"/> 否
</td>
</tr>
<tbody id="list_html" style="display:<?php echo $list_html ? '' : 'none'; ?>">
<tr>
<td class="tl">HTML列表頁文件名前綴</td>
<td><input name="setting[htm_list_prefix]" type="text" id="htm_list_prefix" value="<?php echo $htm_list_prefix;?>" size="10"></td>
</tr>
<tr>
<td class="tl">HTML列表頁地址規則</td>
<td><?php echo url_select('setting[htm_list_urlid]', 'htm', 'list', $htm_list_urlid);?><?php tips('提示:規則列表可在./api/url.inc.php文件裡自定義');?></td>
</tr>
</tbody>
<tr id="list_php" style="display:<?php echo $list_html ? 'none' : ''; ?>">
<td class="tl">PHP列表頁地址規則</td>
<td><?php echo url_select('setting[php_list_urlid]', 'php', 'list', $php_list_urlid);?></td>
</tr>

<tr>
<td class="tl">模塊首頁Title<br/>(網頁標題)</td>
<td><input name="setting[seo_title_index]" type="text" id="seo_title_index" value="<?php echo $seo_title_index;?>" style="width:90%;"/><br/> 
常用變量：<?php echo seo_title('seo_title_index', array('modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?><br/>
支持頁面PHP變量，例如{$MOD[name]}表示模塊名稱
</td>
</tr>
<tr>
<td class="tl">模塊首頁Keywords<br/>(網頁關鍵詞)</td>
<td><input name="setting[seo_keywords_index]" type="text" id="seo_keywords_index" value="<?php echo $seo_keywords_index;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_keywords_index', array('modulename', 'sitename', 'sitetitle'));?>
</td>
</tr>
<tr>
<td class="tl">模塊首頁Description<br/>(網頁描述)</td>
<td><input name="setting[seo_description_index]" type="text" id="seo_description_index" value="<?php echo $seo_description_index;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_description_index', array('modulename', 'sitename', 'sitetitle'));?>
</td>
</tr>

<tr>
<td class="tl">列表頁Title<br/>(網頁標題)</td>
<td><input name="setting[seo_title_list]" type="text" id="seo_title_list" value="<?php echo $seo_title_list;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_title_list', array('catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">列表頁Keywords<br/>(網頁關鍵詞)</td>
<td><input name="setting[seo_keywords_list]" type="text" id="seo_keywords_list" value="<?php echo $seo_keywords_list;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_keywords_list', array('catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?></td>
</tr>
<tr>
<td class="tl">列表頁Description<br/>(網頁描述)</td>
<td><input name="setting[seo_description_list]" type="text" id="seo_description_list" value="<?php echo $seo_description_list;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_description_list', array('catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?></td>
</tr>

<tr>
<td class="tl">內容頁Title<br/>(網頁標題)</td>
<td><input name="setting[seo_title_show]" type="text" id="seo_title_show" value="<?php echo $seo_title_show;?>" style="width:90%;"/><br/>
<?php echo seo_title('seo_title_show', array('showtitle', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">內容頁Keywords<br/>(網頁關鍵詞)</td>
<td><input name="setting[seo_keywords_show]" type="text" id="seo_keywords_show" value="<?php echo $seo_keywords_show;?>" style="width:90%;"/><br/>
<?php echo seo_title('seo_keywords_show', array('showtitle', 'catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
</td>
</tr>
<tr>
<td class="tl">內容頁Description<br/>(網頁描述)</td>
<td><input name="setting[seo_description_show]" type="text" id="seo_description_show" value="<?php echo $seo_description_show;?>" style="width:90%;"/><br/>
<?php echo seo_title('seo_description_show', array('showtitle', 'showintroduce', 'catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
</td>
</tr>
<tr>
<td class="tl">搜索頁Title<br/>(網頁標題)</td>
<td><input name="setting[seo_title_search]" type="text" id="seo_title_search" value="<?php echo $seo_title_search;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_title_search', array('kw', 'areaname', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">搜索頁Keywords<br/>(網頁關鍵詞)</td>
<td><input name="setting[seo_keywords_search]" type="text" id="seo_keywords_search" value="<?php echo $seo_keywords_search;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_keywords_search', array('kw', 'areaname', 'catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
</td>
</tr>
<tr>
<td class="tl">搜索頁Description<br/>(網頁描述)</td>
<td><input name="setting[seo_description_search]" type="text" id="seo_description_search" value="<?php echo $seo_description_search;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_description_search', array('kw', 'areaname', 'catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
</td>
</tr>
</table>
</div>


<div id="Tabs2" style="display:none">
<div class="tt">權限收費</div>
<table cellpadding="2" cellspacing="1" class="tb">

<tr>
<td class="tl">允許瀏覽模塊首頁</td>
<td><?php echo group_checkbox('setting[group_index][]', $group_index);?></td>
</tr>
<tr>
<td class="tl">允許瀏覽分類列表</td>
<td><?php echo group_checkbox('setting[group_list][]', $group_list);?></td>
</tr>

<tr>
<td class="tl">允許搜索信息</td>
<td><?php echo group_checkbox('setting[group_search][]', $group_search);?></td>
</tr>

<tr>
<td class="tl">允許查看公司主頁聯繫方式</td>
<td><?php echo group_checkbox('setting[group_contact][]', $group_contact);?></td>
</tr>

<tr>
<td class="tl">允許查看公司主頁採購列表</td>
<td><?php echo group_checkbox('setting[group_buy][]', $group_buy);?></td>
</tr>

<tr>
<td class="tl">允許在公司主頁留言</td>
<td><?php echo group_checkbox('setting[group_message][]', $group_message);?></td>
</tr>

<tr>
<td class="tl">允許在公司主頁詢盤</td>
<td><?php echo group_checkbox('setting[group_inquiry][]', $group_inquiry);?></td>
</tr>

<tr>
<td class="tl">允許在公司主頁報價</td>
<td><?php echo group_checkbox('setting[group_price][]', $group_price);?></td>
</tr>

</table>
</div>

<div class="sbt">
<input type="submit" name="submit" value="確 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="展 開" id="ShowAll" class="btn" onclick="TabAll();" title="展開/合併所有選項"/>
</div>
</form>
<script type="text/javascript">
var tab = <?php echo $tab;?>;
var all = <?php echo $all;?>;
function TabAll() {
	var i = 0;
	while(1) {
		if(Dd('Tabs'+i) == null) break;
		Dd('Tabs'+i).style.display = all ? (i == tab ? '' : 'none') : '';
		i++;
	}
	Dd('ShowAll').value = all ? '展 開' : '合 並';
	all = all ? 0 : 1;
}
window.onload=function() {
	if(tab) Tab(tab);
	if(all) {all = 0; TabAll();}
}
</script>
<?php include tpl('footer');?>