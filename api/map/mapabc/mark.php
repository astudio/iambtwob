<?php
require '../../../common.inc.php';
include DT_ROOT.'/api/map/mapabc/config.inc.php';
$map = isset($map) ? $map : '';
preg_match("/^[0-9\.\,]{17,21}$/", $map) or $map = $map_mid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 echo DT_CHARSET;?>" />
<title>MapABC - 點擊標注位置</title>
<style type="text/css">
html{height:100%}
body{height:100%;margin:0px;padding:0px}
#map{height:100%}
</style>
<script type="text/javascript">window.onerror=function(){return true;}</script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/config.js"></script>
<script type="text/javascript" src="http://app.mapabc.com/apis?&t=flashmap&v=2.4&key=<?php echo $map_key;?>"></script>
<script type="text/javascript">
var mapObj=null;
function mapInit() {
	var mapoption = new MMapOptions();
	mapoption.toolbar = MConstants.ROUND; //設置地圖初始化工具條，ROUND:新版圓工具條
	mapoption.overviewMap = MConstants.SHOW; //設置鷹眼地圖的狀態，SHOW:顯示，HIDE:隱藏（默認）
	mapoption.scale = MConstants.SHOW; //設置地圖初始化比例尺狀態，SHOW:顯示（默認），HIDE:隱藏。
	mapoption.zoom = 13;//要加載的地圖的縮放級別
	mapoption.center = new MLngLat(<?php echo $map;?>);//要加載的地圖的中心點經緯度坐標
	mapoption.language = MConstants.MAP_CN;//設置地圖類型，MAP_CN:中文地圖（默認），MAP_EN:英文地圖
	mapoption.fullScreenButton = MConstants.SHOW;//設置是否顯示全屏按鈕，SHOW:顯示（默認），HIDE:隱藏
	mapoption.centerCross = MConstants.SHOW;//設置是否在地圖上顯示中心十字,SHOW:顯示（默認），HIDE:隱藏
	mapoption.toolbarPos=new MPoint(20,20); //設置工具條在地圖上的顯示位置
	mapObj = new MMap("map", mapoption); //地圖初始化
	mapObj.addEventListener(mapObj,MConstants.MOUSE_CLICK,MclickMouse);//鼠標點擊事件
}
function MclickMouse(param){	
	window.opener.document.getElementById('map').value = param.eventX+','+param.eventY;
	window.close();
}
</script>
</head>
<body onload="mapInit();">
<div id="map"></div>
</body>
</html>