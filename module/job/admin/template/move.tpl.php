<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt"><?php echo $menus[$menuid][0];?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr class="on">
<td>
<input type="radio" name="fromtype" value="catid" <?php echo $itemid ? '' : 'checked';?> id="f_1"/><label for="f_1">從指定分類ID</label>&nbsp;&nbsp;
<input type="radio" name="fromtype" value="itemid" <?php echo $itemid ? 'checked' : '';?> id="f_2"/><label for="f_2">從指定信息ID</label>
</td>
<td></td>
<td>&nbsp;目標分類</td>
</tr>
<tr>
<td width="220" align="center" title="多個ID用,分開 結尾和開頭不能有,">
<textarea style="height:300px;width:200px;" name="fromids"><?php echo $itemid;?></textarea>
</td>
<td width="60" align="center"><strong>&rarr;</strong></td>
<td><?php echo category_select('tocatid', '', 0, $moduleid, 'size="2" style="height:300px;width:150px;"');?></td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;<a href="?file=category&mid=<?php echo $moduleid;?>" target="_blank" class="f_b t">分類ID查詢</a></td>
<td> </td>
<td><input type="submit" name="submit" value=" 移 動 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></td>
</tr>
</table>
</div>
</form>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>