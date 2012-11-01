<?php
require '../../../common.inc.php';
include DT_ROOT.'/api/map/mapabc/config.inc.php';
$map = isset($map) ? $map : '';
preg_match("/^[0-9\.\,]{17,21}$/", $map) or $map = $map_mid;
$company = isset($company) ? trim(strip_tags($company)) : '';
$address = isset($address) ? trim(strip_tags($address)) : '';
($company && $address) or exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 echo DT_CHARSET;?>" />
<title>MapABC</title>
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
	mapObj.addEventListener(mapObj,MConstants.ADD_OVERLAY,addOverlayEvent);
}
var tipOption=new MTipOptions();
function addFlashTip(){
	mapObj.removeAllOverlays();
	var fontstyle=new MFontStyle();
	fontstyle.size=13;
	fontstyle.color=0x333333;
	fontstyle.bold=true;

	var fontstyle1=new MFontStyle();
	fontstyle1.size=12;
	fontstyle1.color=0x333333;//內容字體顏色無效
	fontstyle1.bold=false;

	tipOption.title="<?php echo $company;?>";
	tipOption.titleFontStyle=fontstyle;

	tipOption.content="<?php echo $address;?>";
	tipOption.contentFontStyle=fontstyle1;

	tipOption.roundRectSize=20;//tip矩形圓邊長度
	tipOption.tipType=MConstants.FLASH_BUBBLE_TIP;
	tipOption.hasShadow=true;
}
function addMarker(){
	addFlashTip();
	var markerOption = new MMarkerOptions();
	markerOption.imageUrl="http://code.mapabc.com/images/lan_1.png";
	markerOption.picAgent=false;
	markerOption.imageAlign=MConstants.BOTTOM_CENTER;
	markerOption.tipOption = tipOption;
	markerOption.canShowTip= true;
	var marker = new MMarker(new MLngLat(<?php echo $map;?>),markerOption);
	marker.id="marker01";
	mapObj.addOverlay(marker,true) ;
}
function addOverlayEvent(param){
	mapObj.openOverlayTip(param.overlayId);
}
</script>
</head>
<body onload="mapInit();addMarker();">
<div id="map"></div>
</body>
</html>