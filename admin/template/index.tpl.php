<?php
defined('IN_DESTOON') or exit('Access Denied');
$edition = edition(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8 echo DT_CHARSET;?>"/>
<title>管理中心 - <?php echo $DT['sitename']; ?> - Powered By Destoon B2B <?php echo $edition;?> V<?php echo DT_VERSION; ?> R<?php echo DT_RELEASE;?> <?php echo strtoupper(DT_CHARSET);?> <?php echo strtoupper(DT_LANG);?></title>
<meta name="robots" content="noindex,nofollow"/>
<meta name="generator" content="Destoon B2B,www.destoon.com"/>
</head>
<noscript><br/><br/><br/><center><h1>您的瀏覽器不支持JavaScript,請更換支持JavaScript的瀏覽器</h1></center></noscript>
<noframes><br/><br/><br/><center><h1>您的瀏覽器不支持框架,請更換支持框架的瀏覽器</h1></center></noframes>
<script type="text/javascript" src="file/script/config.js"></script>
<frameset cols="<?php echo $DT['admin_left'];?>,7,*" frameborder="no" border="0" framespacing="0" name="fra"> 
<frame name="left" noresize scrolling="auto" src="?action=left">
<frame name="side" noresize scrolling="no" src="?action=side">
<frame name="main" noresize scrolling="yes" src="?action=main">
</frameset>
</html>