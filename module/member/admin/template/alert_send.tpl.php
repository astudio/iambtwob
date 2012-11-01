<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">發送商機</div>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<input type="hidden" name="first" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 郵件標題</td>
<td><input type="text" size="50" name="title" value="<?php echo $title;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 每輪發送</td>
<td><input type="text" size="5" name="num" value="<?php echo $num;?>"/> 封</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 商機數量</td>
<td><input type="text" size="5" name="total" value="<?php echo $total;?>"/> 條</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 查詢條件</td>
<td><input type="text" size="60" name="sql" value="<?php echo $sql;?>"/> <?php tips('附加的SQL查詢條件 以AND開頭');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 排序方式</td>
<td><input type="text" size="20" name="ord" value="<?php echo $ord;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 選擇模板</td>
<td><?php echo tpl_select('alert', 'mail', 'template', '默認模板', '');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 開始發送 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>