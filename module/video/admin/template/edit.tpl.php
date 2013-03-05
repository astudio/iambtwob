<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
load('player.js');
//var_dump($FD);die;
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 所屬分類</td>
<td><?php echo $_admin == 1 ? category_select('post[catid]', '選擇分類', $catid, $moduleid) : ajax_category_select('post[catid]', '選擇分類', $catid, $moduleid);?>&nbsp;&nbsp;<input type="checkbox" name="post[islink]" value="1" id="islink" onclick="_islink();" <?php if($islink) echo 'checked';?>/> 嵌入Youtube影片<span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>標題</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '級別', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr id="link" style="display:<?php echo $islink ? '' : 'none';?>;">
<td class="tl"><span class="f_red">*</span> Youtube連結網址</td>
<td><input name="post[youtubeurl]" type="text" id="youtubeurl" size="60" value="<?php echo $youtubeurl;?>"/> <span id="dyoutubeurl" class="f_red"></span></td>
</tr>
<tbody id="basic" style="display:<?php echo $islink ? 'none' : '';?>;">
<tr>
<td class="tl"><span class="f_red">*</span> 標題圖片</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[刪除]</span><span id="dthumb" class="f_red"></span></td>
</tr>
<?php if($MOD['swfu']) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 視頻地址</td>
<td>
<div style="float:left;"><input name="post[video]" id="video" type="text" size="60" value="<?php echo $video;?>"/>&nbsp;&nbsp;</div><div style="width:34px;height:20px;float:left;"><span id="spanButtonPlaceHolder"></span></div><table cellspacing="0" style="display:none;">
<tr>
	<td>Files Queued:</td>
	<td id="tdFilesQueued"></td>
</tr>			
<tr>
	<td>Files Uploaded:</td>
	<td id="tdFilesUploaded"></td>
</tr>			
<tr>
	<td>Errors:</td>
	<td id="tdErrors"></td>
</tr>
<tr>
	<td>Current Speed:</td>
	<td id="tdCurrentSpeed"></td>
</tr>			
<tr>
	<td>Average Speed:</td>
	<td id="tdAverageSpeed"></td>
</tr>			
<tr>
	<td>Moving Average Speed:</td>
	<td id="tdMovingAverageSpeed"></td>
</tr>			
<tr>
	<td>Time Remaining</td>
	<td id="tdTimeRemaining"></td>
</tr>			
<tr>
	<td>Time Elapsed</td>
	<td id="tdTimeElapsed"></td>
</tr>
<tr>
	<td>Size Uploaded</td>
	<td id="tdSizeUploaded"></td>
</tr>			
<tr>
	<td>Progress Event Count</td>
	<td id="tdProgressEventCount"></td>
</tr>	
</table><div style="float:left;">&nbsp;&nbsp;<span onclick="vs();" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="vh();Dd('video').value='';" class="jt">[刪除]</span>&nbsp;&nbsp; 
<span class="f_gray">進度：<span id="tdPercentUploaded">0%</span></span> <span id="dvideo" class="f_red"></span></div>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/swfupload/swfupload.speed.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/swfupload/handlers_video.js"></script>
<script type="text/javascript">
	var swfu;
	//window.onload = function() {
		var settings = {
			flash_url : "<?php echo DT_PATH;?>file/swfupload/swfupload.swf",
			upload_url: "<?php echo DT_PATH;?>upload.php",
			post_params: {"from": "file", "width": "100", "height": "100", "swf_userid": "<?php echo $_userid;?>", "swf_username": "<?php echo $_username;?>", "swf_groupid": "<?php echo $_groupid;?>", "swf_auth": "<?php echo md5($_userid.$_username.$_groupid.DT_KEY.$DT_IP);?>", "swfupload": "1"},
			file_size_limit : "1000 MB",
			//file_types : "*.*",
			file_types : "*.<?php echo str_replace('|', ';*.', $MOD['upload']);?>",
			file_types_description : "視頻文件",
			//file_upload_limit : 100,
			file_upload_limit : 10,
			file_queue_limit : 0,

			debug: false,

			// Button settings
			button_image_url: "<?php echo DT_PATH;?>file/swfupload/upload1.png",
			button_width: "34",
			button_height: "20",
			button_placeholder_id: "spanButtonPlaceHolder",
			
			moving_average_history_size: 40,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_dialog_complete_handler: fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			
			custom_settings : {
				tdFilesQueued : document.getElementById("tdFilesQueued"),
				tdFilesUploaded : document.getElementById("tdFilesUploaded"),
				tdErrors : document.getElementById("tdErrors"),
				tdCurrentSpeed : document.getElementById("tdCurrentSpeed"),
				tdAverageSpeed : document.getElementById("tdAverageSpeed"),
				tdMovingAverageSpeed : document.getElementById("tdMovingAverageSpeed"),
				tdTimeRemaining : document.getElementById("tdTimeRemaining"),
				tdTimeElapsed : document.getElementById("tdTimeElapsed"),
				tdPercentUploaded : document.getElementById("tdPercentUploaded"),
				tdSizeUploaded : document.getElementById("tdSizeUploaded"),
				tdProgressEventCount : document.getElementById("tdProgressEventCount")
			}
		};
		swfu = new SWFUpload(settings);
	 //};
</script>
<div id="v_player"></div>
</td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 視頻地址</td>
<td><input name="post[video]" id="video" type="text" size="60" value="<?php echo $video;?>"/>&nbsp;&nbsp;<span onclick="Dfile(<?php echo $moduleid;?>, Dd('video').value, 'video', '<?php echo $MOD['upload'];?>');" class="jt">[上傳]</span>&nbsp;&nbsp;<span onclick="vs();" class="jt">[預覽]</span>&nbsp;&nbsp;<span onclick="Dd('video').value='';" class="jt">[刪除]</span> <span id="dvideo" class="f_red"></span>
<div id="v_player"></div>
</td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 視頻寬度</td>
<td><input name="post[width]" id="width" type="text" size="5" value="<?php echo $width;?>"/> px&nbsp;&nbsp;&nbsp;高度 <input name="post[height]" id="height" type="text" size="5" value="<?php echo $height;?>"/> px <span id="dsize" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 播放器</td>
<td>
<?php
foreach($PLAYER as $k=>$v) {
?>
<input type="radio" name="post[player]" id="type_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $player ? ' checked' : '';?>/><label for="type_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 1;
</script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/property.js"></script>
<?php if($itemid) { ?><script type="text/javascript">setTimeout("load_property()", 1000);</script><?php } ?>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr>
<td class="tl"><span class="f_hid">*</span> 視頻說明</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> 視頻系列</td>
<td><input name="post[tag]" id="tag" type="text" size="50" value="<?php echo $tag;?>"/> <span id="dtag" class="f_red"></span><?php tips('填寫一個視頻的關鍵詞或者系列名稱，以便關聯同系列的視頻');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 會員名</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[資料]</a> <span id="dusername" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通過
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待審
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';"/> 拒絕
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?>/> 刪除
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 拒絕理由</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加時間</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<?php if($DT['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地區(分站)</td>
<td><?php echo ajax_area_select('post[areaid]', '請選擇', $areaid);?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 瀏覽次數</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容收費</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('不填或填0表示繼承模塊設置價格，-1表示不收費<br/>大於0的數字表示具體收費價格');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 內容模板</td>
<td><?php echo tpl_select('show', $module, 'post[template]', '默認模板', $template, 'id="template"');?><?php tips('如果沒有特殊需要，一般不需要選擇<br/>系統會自動繼承分類或模塊設置');?></td>
</tr>
<?php if($MOD['show_html']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 自定義文件路徑</td>
<td><input type="text" size="50" name="post[filepath]" value="<?php echo $filepath;?>" id="filepath"/>&nbsp;<input type="button" value="重名檢測" onclick="ckpath(<?php echo $moduleid;?>, <?php echo $itemid;?>);" class="btn"/>&nbsp;<?php tips('可以包含目錄和文件 例如 destoon/b2b.html<br/>請確保目錄和文件名合法且可寫入，否則可能生成失敗');?>&nbsp; <span id="dfilepath" class="f_red"></span></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">單頁采編</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 目標網址</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" 獲 取 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 管理規則 " class="btn" onclick="window.open('?file=fetch');"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('請選擇所屬分類', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('請填寫視頻名稱', f);
		return false;
	}	
	if(Dd('islink').checked) {
		f = 'youtubeurl';
		l = Dd(f).value.length;
		if(l < 10) {
			Dmsg('請填寫Youtube連結網址', f);
			return false;		
		}
	} else {
		f = 'thumb';
		l = Dd(f).value.length;
		if(l < 10) {
			Dmsg('請上傳標題圖片', f);
			return false;
		}
		f = 'video';
		l = Dd(f).value.length;
		if(l < 10) {
			Dmsg('請填寫視頻地址', f);
			return false;
		}
		if(!Dd('width').value) {
			Dmsg('請填寫視頻寬度', 'size');
			return false;
		}
		if(!Dd('height').value) {
			Dmsg('請填寫視頻高度', 'size');
			return false;
		}
	}
	<?php echo $FD ? fields_js() : '';?>
	if(Dd('property_require') != null) {
		var ptrs = Dd('property_require').getElementsByTagName('option');
		for(var i = 0; i < ptrs.length; i++) {		
			f = 'property-'+ptrs[i].value;
			if(Dd(f).value == 0 || Dd(f).value == '') {
				Dmsg('請填寫或選擇'+ptrs[i].innerHTML, f);
				return false;
			}
		}
	}
	return true;
}
function vs() {
	if(Dd('video').value.length > 5) {
		var p = i = 0;
		while(i < 100) {
			if(Dd('type_'+i).checked) {p = i;break}
			i++;
		}
		Ds('v_player');
		Inner('v_player', player(Dd('video').value,Dd('width').value,Dd('height').value,p,1)+'<br/><a href="javascript:" onclick="vh();" class="t">[關閉預覽]</a>');
	} else {
		vh();
	}
}
function vh() {Inner('v_player', '');Dh('v_player');}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>