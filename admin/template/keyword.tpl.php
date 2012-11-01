<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<div class="tt">關鍵詞搜索</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<select name="mid">
<option value="0">模塊</option>
<?php 
foreach($MODULE as $v) {
	if(($v['moduleid'] > 0 && $v['moduleid'] < 4) || $v['islink']) continue;
	echo '<option value="'.$v['moduleid'].'"'.($mid == $v['moduleid'] ? ' selected' : '').'>'.$v['name'].'</option>';
} 
?>
</select>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="關鍵詞"/>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="條/頁"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
<div class="tt">關鍵詞管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>模塊</th>
<th>關鍵詞</th>
<th>相關詞</th>
<th>拼音</th>
<th>結果</th>
<th>總搜索</th>
<th>本月</th>
<th>本周</th>
<th>今日</th>
<th>狀態</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['itemid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><a href="?file=<?php echo $file;?>&mid=<?php echo $v['moduleid'];?>&status=<?php echo $status;?>"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><input name="post[<?php echo $v['itemid'];?>][word]" type="text" size="15" value="<?php echo $v['word'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][keyword]" type="text" size="20" value="<?php echo $v['keyword'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][letter]" type="text" size="15" value="<?php echo $v['letter'];?>"/></td>
<td><?php echo $v['items'];?></td>
<td><input name="post[<?php echo $v['itemid'];?>][total_search]" type="text" size="5" value="<?php echo $v['total_search'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][month_search]" type="text" size="5" value="<?php echo $v['month_search'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][week_search]" type="text" size="4" value="<?php echo $v['week_search'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][today_search]" type="text" size="3" value="<?php echo $v['today_search'];?>"/></td>
<td>
<select name="post[<?php echo $v['itemid'];?>][status]">
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>啟用</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>待審</option>
</select>
</td>
</tr>
<?php } ?>

<tr>
<th> </th>
<th>模塊</th>
<th>關鍵詞</th>
<th>相關詞</th>
<th>拼音</th>
<th>結果</th>
<th>總搜索</th>
<th>本月</th>
<th>本周</th>
<th>今日</th>
<th>狀態</th>
</tr>

<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td>
<select name="post[0][moduleid]">
<?php 
foreach($MODULE as $v) {
	if(($v['moduleid'] > 0 && $v['moduleid'] < 4) || $v['islink']) continue;
	echo '<option value="'.$v['moduleid'].'">'.$v['name'].'</option>';
} 
?>
</select>&nbsp;
</td>
<td><input name="post[0][word]" type="text" size="15" value="" onblur="get_letter(this.value);" onkeyup="Dd('keyword').value=this.value;"/></td>
<td><input name="post[0][keyword]" type="text" size="20" id="keyword"/></td>
<td><input name="post[0][letter]" id="letter" type="text" size="15" value=""/></td>
<td><input name="post[0][items]" type="text" size="3" value="0"/></td>
<td><input name="post[0][total_search]" type="text" size="5" value="1"/></td>
<td><input name="post[0][month_search]" type="text" size="5" value="1"/></td>
<td><input name="post[0][week_search]" type="text" size="4" value="1"/></td>
<td><input name="post[0][today_search]" type="text" size="3" value="1"/></td>
<td>
<select name="post[0][status]">
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>啟用</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>待審</option>
</select>
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="10">&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您選擇刪除'+_del+'個關鍵詞？確定要刪除嗎？')) return false;" class="btn"/>
</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">相關詞說明</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="f_gray">
- 設置相關詞可以使提示搜索或相關搜索更智能 例如關鍵詞『IBM』可設置『IBM,筆記本』則搜索IBM和筆記本均會提示IBM相關搜索<br/>
- 多個相關詞請用英文,分割，為了系統檢索效率，建議控制在200字內
</td>
</tr>
</table>

<script type="text/javascript">
function get_letter(word) {
	makeRequest('file=<?php echo $file;?>&action=letter&word='+word, '?', '_get_letter');
}
function _get_letter() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			if(Dd('letter').value == '') Dd('letter').value = xmlHttp.responseText;
		}
	}
}
</script>
<script type="text/javascript">Menuon(<?php echo $status==3 ? '0' : '1';?>);</script>
<?php include tpl('footer');?>