<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">站內信件轉發</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">提示</td>
<td>可以通過此功能將會員的未讀站內信發送至其註冊郵箱</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 時間範圍</td>
<td>
<input type="text" size="5" name="hour" id="hour" value="48"/> 小時<?php tips('發送超過此時間未讀的站內信 建議設置24小時以上<br/>每封站內信只發送一次，已經發送過的不會重複發送');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 每輪發送郵件數</td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
<?php if($lasttime) { ?>
<tr>
<td class="tl">上次發送</td>
<td><?php echo $lasttime;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 開始發送 " class="btn" onclick="if(!confirm('確定發送超過 '+Dd('hour').value+' 小時未讀的站內信至會員信箱嗎？')) return false;"></div>
</form>
<script type="text/javascript">Menuon(3);</script>
<?php include tpl('footer');?>