<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">新數據</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>字段</th>
<th>數據</th>
</tr>
<?php foreach($T as $k=>$v) { ?>
<tr>
<td class="tl"><?php echo $k;?></td>
<td>&nbsp;<?php echo $v;?></td>
</tr>
<?php } ?>
</table>
<div class="tt">源數據</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>字段</th>
<th>數據</th>
</tr>
<?php foreach($F as $k=>$v) { ?>
<tr>
<td class="tl"><?php echo $k;?></td>
<td>&nbsp;<?php echo $v;?></td>
</tr>
<?php } ?>
</table>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>