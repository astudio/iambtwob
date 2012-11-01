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
<td class="tl">默認縮略圖[寬X高]</td>
<td>
<input type="text" size="3" name="setting[thumb_width]" value="<?php echo $thumb_width;?>"/>
X
<input type="text" size="3" name="setting[thumb_height]" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>
<tr>
<td class="tl">自動截取內容至簡介</td>
<td><input type="text" size="3" name="setting[introduce_length]" value="<?php echo $introduce_length;?>"/> 字符</td>
</tr>
<tr>
<td class="tl">編輯器工具按鈕</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>全部</option>
<option value="Destoon"<?php if($editor == 'Destoon') echo ' selected';?>>精簡</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>簡潔</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>基礎</option>
</select>
</td>
</tr>
<tr>
<td class="tl">信息排序方式</td>
<td>
<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
<select onchange="if(this.value) Dd('order').value=this.value;">
<option value="">請選擇</option>
<option value="addtime desc"<?php if($order == 'addtime desc') echo ' selected';?>>添加時間</option>
<option value="edittime desc"<?php if($order == 'edittime desc') echo ' selected';?>>更新時間</option>
<option value="fromtime desc"<?php if($order == 'fromtime desc') echo ' selected';?>>開始時間</option>
<option value="itemid desc"<?php if($order == 'itemid desc') echo ' selected';?>>信息ID</option>
</select>
</td>
</tr>
<tr>
<td class="tl">列表或搜索主字段</td>
<td><input type="text" size="80" name="setting[fields]" value="<?php echo $fields;?>"/><?php tips('此項可在一定程度上提高列表或搜索效率，請勿隨意修改以免導致SQL錯誤');?></td>
</tr>
<tr>
<td class="tl">分類屬性參數</td>
<td>
<input type="radio" name="setting[cat_property]" value="1"  <?php if($cat_property) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[cat_property]" value="0"  <?php if(!$cat_property) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">下載內容遠程圖片</td>
<td>
<input type="radio" name="setting[save_remotepic]" value="1"  <?php if($save_remotepic) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_remotepic]" value="0"  <?php if(!$save_remotepic) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">清除內容鏈接</td>
<td>
<input type="radio" name="setting[clear_link]" value="1"  <?php if($clear_link) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[clear_link]" value="0"  <?php if(!$clear_link) echo 'checked';?>/> 關閉
</td>
</tr>
<tr>
<td class="tl">內容關聯鏈接</td>
<td>
<input type="radio" name="setting[keylink]" value="1"  <?php if($keylink) echo 'checked';?>/> 開啟&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[keylink]" value="0"  <?php if(!$keylink) echo 'checked';?>/> 關閉
&nbsp;&nbsp;
<a href="?file=keylink&item=<?php echo $moduleid;?>" target="_blank" class="t">[管理鏈接]</a>
</td>
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
<td class="tl">全文搜索</td>
<td>
<input type="radio" name="setting[fulltext]" value="1" <?php if($fulltext==1){ ?>checked <?php } ?>/> LIKE&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fulltext]" value="2" <?php if($fulltext==2){ ?>checked <?php } ?>/> MATCH&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fulltext]" value="0" <?php if($fulltext==0){ ?>checked <?php } ?>/> 關閉
<?php tips('此項會增加服務器負擔，請根據需要和服務器配置決定是否開啟。MATCH模式需要MySQL 4以上版本，且需要在MySQL的my.ini添加ft_min_word_len=1才能支持2個漢字的中文搜索。如果不能設置可以使用LIKE模式，但是效率會低於MATCH模式。<br/>開啟MATCH模式請在數據庫維護裡執行以下SQL添加全文索引<br/>ALTER TABLE `'.$table_data.'` ADD FULLTEXT (`content`);<br/>全文索引佔用一定數據空間，如果不開啟MATCH模式可以執行以下語句刪除索引<br/>ALTER TABLE `'.$table_data.'` DROP INDEX `content`;');?></td>
</tr>
<tr>
<td class="tl">級別中文別名</td>
<td>
<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
<br/>用 | 分隔不同別名 依次對應 1|2|3|4|5|6|7|8|9 級 <?php echo level_select('post[level]', '提交後點此預覽效果');?>
</td>
</tr>
<tr>
<td class="tl">首頁幻燈信息數量</td>
<td><input type="text" size="3" name="setting[page_islide]" value="<?php echo $page_islide;?>"/></td>
</tr>

<tr>
<td class="tl">首頁分類信息數量</td>
<td><input type="text" size="3" name="setting[page_icat]" value="<?php echo $page_icat;?>"/></td>
</tr>

<tr>
<td class="tl">展會資訊模塊ID</td>
<td><input type="text" size="3" name="setting[news_id]" value="<?php echo $news_id;?>"/><?php tips('可以調用文章模型數據作為展會報道、展館介紹、展會服務等內容源');?></td>
</tr>

<tr>
<td class="tl">展會資訊分類ID</td>
<td><input type="text" size="3" name="setting[cat_news]" value="<?php echo $cat_news;?>"/></td>
</tr>

<tr>
<td class="tl">展會資訊數量</td>
<td><input type="text" size="3" name="setting[cat_news_num]" value="<?php echo $cat_news_num;?>"/></td>
</tr>
<tr>
<td class="tl">展會服務分類ID</td>
<td><input type="text" size="3" name="setting[cat_service]" value="<?php echo $cat_service;?>"/></td>
</tr>

<tr>
<td class="tl">展會服務數量</td>
<td><input type="text" size="3" name="setting[cat_service_num]" value="<?php echo $cat_service_num;?>"/></td>
</tr>

<tr>
<td class="tl">展館介紹分類ID</td>
<td><input type="text" size="3" name="setting[cat_hall]" value="<?php echo $cat_hall;?>"/></td>
</tr>
<tr>
<td class="tl">展館介紹數量</td>
<td><input type="text" size="3" name="setting[cat_hall_num]" value="<?php echo $cat_hall_num;?>"/></td>
</tr>


<tr>
<td class="tl">列表信息分頁數量</td>
<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
</tr>


<tr>
<td class="tl">內容圖片最大寬度</td>
<td><input type="text" size="3" name="setting[max_width]" value="<?php echo $max_width;?>"/> px</td>
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
<td class="tl">內容頁是否生成html</td>
<td>
<input type="radio" name="setting[show_html]" value="1"  <?php if($show_html){ ?>checked <?php } ?> onclick="Dd('show_html').style.display='';Dd('show_php').style.display='none';"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[show_html]" value="0"  <?php if(!$show_html){ ?>checked <?php } ?> onclick="Dd('show_html').style.display='none';Dd('show_php').style.display='';"/> 否
</td>
</tr>
<tbody id="show_html" style="display:<?php echo $show_html ? '' : 'none'; ?>">
<tr>
<td class="tl">HTML內容頁文件名前綴</td>
<td><input name="setting[htm_item_prefix]" type="text" id="htm_item_prefix" value="<?php echo $htm_item_prefix;?>" size="10"></td>
</tr>
<tr>
<td class="tl">HTML內容頁地址規則</td>
<td><?php echo url_select('setting[htm_item_urlid]', 'htm', 'item', $htm_item_urlid);?></td>
</tr>
</tbody>
<tr id="show_php" style="display:<?php echo $show_html ? 'none' : ''; ?>">
<td class="tl">PHP內容頁地址規則</td>
<td><?php echo url_select('setting[php_item_urlid]', 'php', 'item', $php_item_urlid);?></td>
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
<td class="tl">允許瀏覽信息內容</td>
<td><?php echo group_checkbox('setting[group_show][]', $group_show);?></td>
</tr>
<tr>
<td class="tl">允許瀏覽聯繫方式</td>
<td><?php echo group_checkbox('setting[group_contact][]', $group_contact);?></td>
</tr>
<tr>
<td class="tl">允許搜索信息</td>
<td><?php echo group_checkbox('setting[group_search][]', $group_search);?></td>
</tr>
<tr>
<td class="tl">允許設置標題顏色</td>
<td><?php echo group_checkbox('setting[group_color][]', $group_color);?></td>
</tr>
<tr>
<td class="tl">審核發佈信息</td>
<td>
<input type="radio" name="setting[check_add]" value="2"  <?php if($check_add == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_add]" value="1"  <?php if($check_add == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_add]" value="0"  <?php if($check_add == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
<tr>
<td class="tl">發佈信息啟用驗證碼</td>
<td>
<input type="radio" name="setting[captcha_add]" value="2"  <?php if($captcha_add == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_add]" value="1"  <?php if($captcha_add == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_add]" value="0"  <?php if($captcha_add == 0) echo 'checked';?>> 全部關閉
</td>
</tr>
<tr>
<td class="tl">發佈信息啟用驗問題</td>
<td>
<input type="radio" name="setting[question_add]" value="2"  <?php if($question_add == 2) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_add]" value="1"  <?php if($question_add == 1) echo 'checked';?>> 全部啟用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_add]" value="0"  <?php if($question_add == 0) echo 'checked';?>> 全部關閉
</td>
</tr>

<tr>
<td class="tl">會員是否收費</td>
<td>
<input type="radio" name="setting[fee_mode]" value="1"  <?php if($fee_mode == 1) echo 'checked';?>> 繼承會員組設置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_mode]" value="0"  <?php if($fee_mode == 0) echo 'checked';?>> 全部啟用
</td>
</tr>
<tr>
<td class="tl">會員收費使用</td>
<td>
<input type="radio" name="setting[fee_currency]" value="money"  <?php if($fee_currency == 'money') echo 'checked';?>/> <?php echo $DT['money_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_currency]" value="credit"  <?php if($fee_currency == 'credit') echo 'checked';?>/> <?php echo $DT['credit_name'];?>
</td>
</tr>
<tr>
<td class="tl">發佈信息收費</td>
<td><input type="text" size="5" name="setting[fee_add]" value="<?php echo $fee_add;?>"/> <?php echo $fee_currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?>/條</td>
</tr>
<tr>
<td class="tl">查看信息收費</td>
<td><input type="text" size="5" name="setting[fee_view]" value="<?php echo $fee_view;?>"/> <?php echo $fee_currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?>/條</td>
</tr>
<tr>
<td class="tl">收費有效時間</td>
<td><input type="text" size="5" name="setting[fee_period]" value="<?php echo $fee_period;?>"/> 分鐘 <?php tips('如果支付時間超過有效時間，系統將重新收費<br/>填零表示不重複收費');?></td>
</tr>
<tr>
<td class="tl">未支付內容顯示</td>
<td><input type="text" size="5" name="setting[pre_view]" value="<?php echo $pre_view;?>"/> 字符</td>
</tr>
</table>
<div class="tt"><?php echo $DT['credit_name'];?>規則</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">發佈信息獎勵</td>
<td>
<input type="text" size="5" name="setting[credit_add]" value="<?php echo $credit_add;?>"/>
</td>
</tr>
<tr>
<td class="tl">信息被刪除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del]" value="<?php echo $credit_del;?>"/>
</td>
</tr>
<tr>
<td class="tl">信息設置顏色扣除</td>
<td>
<input type="text" size="5" name="setting[credit_color]" value="<?php echo $credit_color;?>"/>
</td>
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