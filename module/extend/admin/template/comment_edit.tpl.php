<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">修改評論 </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 評論人</td>
<td><a href="javascript:_user('<?php echo $username;?>');" class="t"><?php echo $username ? $username : 'Guest';?></a> IP - <?php echo $ip;?> <input type="checkbox" name="post[hidden]" value="1" <?php if($hidden) echo 'checked';?>/> 匿名評論</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 評論原文</td>
<td><a href="<?php echo $item_linkurl;?>" target="_blank" class="t"><?php echo $item_title;?></a></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 引用內容</td>
<td><textarea name="post[quotation]" id="quotation"  rows="8" cols="70"><?php echo $quotation;?></textarea><br/>請不要修改代碼結構，僅可修改文字內容</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 評論內容</td>
<td>

<input type="radio" name="post[star]" value="3" id="star_3"<?php echo $star == 3 ? ' checked' : '';?>/><label for="star_3"> 好評 <img src="<?php echo DT_PATH;?>file/image/star3.gif" width="36" height="12" alt="" align="absmiddle"/></label>
<input type="radio" name="post[star]" value="2" id="star_2"<?php echo $star == 2 ? ' checked' : '';?>/><label for="star_2"> 中評 <img src="<?php echo DT_PATH;?>file/image/star2.gif" width="36" height="12" alt="" align="absmiddle"/></label>
<input type="radio" name="post[star]" value="1" id="star_1"<?php echo $star == 1 ? ' checked' : '';?>/><label for="star_1"> 差評 <img src="<?php echo DT_PATH;?>file/image/star1.gif" width="36" height="12" alt="" align="absmiddle"/></label>

<textarea name="post[content]" id="content"  rows="8" cols="70"><?php echo $content;?></textarea></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 回復評論</td>
<td>
<textarea name="post[reply]" id="reply" rows="8" cols="70"><?php echo $reply;?></textarea>
<?php 
if($reply) echo $editor ? '<br/>管理員 '.$editor.' 於 '.$replytime.' 回復' : '<br/>會員 '.$replyer.' 於 '.$replytime.' 回復';
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 評論狀態</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通過
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待審
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 確 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(<?php echo $status == 3 ? 0 : 1;?>);</script>
<?php include tpl('footer');?>