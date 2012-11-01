<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post">
<div class="tt">生成網頁</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td height="30">&nbsp;
<input type="submit" value=" 一鍵生成 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=all';" title="生成該模塊所有網頁"/>&nbsp;&nbsp;
<input type="submit" value=" 生成首頁 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=index';" title="生成該模塊首頁"/>&nbsp;&nbsp;
<input type="submit" value=" 生成列表 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list';" title="生成該模塊所有分類"/>&nbsp;&nbsp;
<input type="submit" value=" 生成內容 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show';" title="生成該模塊所有內容頁"/>&nbsp;&nbsp;
<input type="submit" value=" 更新下載 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&update=1';" title="更新該模塊所有下載地址等項目"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">生成<?php echo $MOD['name'];?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>起始ID</th>
<th>結束ID</th>
<th width="200">每輪生成數量</th>
<th width="200">操作</th>
</tr>
<tr align="center">
<td><input type="text" size="6" name="fid" value="<?php echo $fid;?>"/></td>
<td><input type="text" size="6" name="tid" value="<?php echo $tid;?>"/></td>
<td><input type="text" size="5" name="num" value="100"/></td>
<td><input type="submit" value=" 生成內容 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show';"/>&nbsp;
<input type="submit" value=" 更新下載 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&update=1';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">分段生成</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>選擇分類</th>
<th width="200">每輪生成數量</th>
<th width="200">操作</th>
</tr>
<tr align="center">
<td>
<?php echo category_select('catid', '選擇分類', 0, $moduleid);?>
&nbsp;&nbsp;&nbsp;&nbsp;
第 <input type="text" size="3" name="fpage" value="1"/> 頁 至 <input type="text" size="3" name="tpage" value=""/> 頁
</td>
<td><input type="text" size="5" name="num" value="100"/></td>
<td>
<input type="submit" value=" 生成列表 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=cate';"/>&nbsp;
<input type="submit" value=" 生成內容 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=item';"/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<br/>
<?php include tpl('footer');?>