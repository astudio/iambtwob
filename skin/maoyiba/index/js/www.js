// JavaScript Document

function t_menu(num,type){
if(type=="1")
{
if(num=="2"){
$("#t_cld"+num).removeAttr("class");
$("#t_cld"+num).addClass("t_ul_hover2");
}
else
{
$("#t_cld"+num).removeAttr("class");
$("#t_cld"+num).addClass("t_ul_hover");
}
}
else
{
$("#t_cld"+num).removeAttr("class");
$("#t_cld"+num).addClass("ul_out_hover");
}
}

function hm1(x,y){
if(y=="1"){
document.getElementById("hm1_"+x+"_1").className="r1_1on";
document.getElementById("hm1_"+x+"_2").className="r1_2out";
document.getElementById("hmcon1_"+x+"_1").className="show";
document.getElementById("hmcon1_"+x+"_2").className="hide";
}
else{
document.getElementById("hm1_"+x+"_1").className="r1_1out";
document.getElementById("hm1_"+x+"_2").className="r1_1on";
document.getElementById("hmcon1_"+x+"_2").className="show";
document.getElementById("hmcon1_"+x+"_1").className="hide";
}
}

function hm(id,conid,c_num,num,cnon,cnout){
for(i=1;i<=num;i++){
if(i==c_num){
document.getElementById(id+i).className=cnon+" c_hand";
document.getElementById(conid+i).className="show";
}else{
document.getElementById(id+i).className=cnout+" c_hand";
document.getElementById(conid+i).className="hide";
}
}
}

/*¼ÓÈëÊÕ²Ø¼Ð*/
function addfavorite(url,title)
{
try
{
window.external.addfavorite(url,title);
}
catch (e)
{
try
{
window.sidebar.addPanel(title, url, "");
}
catch (e)
{
alert("¼ÓÈëÊÕ²ØÊ§°Ü£¬ÇëÊ¹ÓÃctrl+d½øÐÐÌí¼Ó");
}
}
}

/*ÉèÎªÊ×Ò³*/
function sethome(obj,vrl){
try{
obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
}
catch(e){
if(window.netscape) {
try {
netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
}
catch (e) {
alert("´Ë²Ù×÷±»ä¯ÀÀÆ÷¾Ü¾ø£¡\nÇëÔÚä¯ÀÀÆ÷µØÖ·À¸ÊäÈë\"about:config\"²¢»Ø³µ\nÈ»ºó½« [signed.applets.codebase_principal_support]µÄÖµÉèÖÃÎª'true',Ë«»÷¼´¿É¡£");
}
var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
prefs.setCharPref('browser.startup.homepage',vrl);
}
}
}

function call(val,num){
$("#seled").html(val);
$("#cls").attr("value",num);
$("#top_sel").css("visibility","hidden");
}

$(function(){
$("#left_menu ul li").mouseover(function(event){
$(this).addClass("m1_hover").children("ul").addClass("ul_hover");
})
})
$(function(){
$("#left_menu ul li ").mouseout(function(){
$(this).removeClass("m1_hover").children("ul").removeClass("ul_hover");
})
})

$(function(){
$("#h_s121").mouseover(function(){
$(this).children("ul").css("visibility","visible");})})

$(function(){
$("#h_s121").mouseout(function(){
$(this).children("ul").css("visibility","hidden");})
})

function scrollTitle(changeSpeed,scrollSpeed){
	var con = document.getElementById("list_con");
	var list = document.getElementById("news_list");
	list.innerHTML += list.innerHTML;
	var items = list.getElementsByTagName("li");
	var timer_1 = setInterval(_scrollTitle,changeSpeed);
	var heightAll =0;
	for(var i=0;i<items.length;i++){
		heightAll += items[i].offsetHeight;
	}
	var heightHalf = parseInt(heightAll/2);
	con.onmouseover = function(){
		if(timer_1){
			clearInterval(timer_1);
			timer_1=null;
		}
	}
	con.onmouseout = function(){
		if(timer_1){
			clearInterval(timer_1);
			timer_1=null;
		}
		timer_1 = setInterval(_scrollTitle,changeSpeed);
	}
	function _scrollTitle(){
		var timer;
		var num = 30;
		timer = setInterval(scrollTop,scrollSpeed);
		function scrollTop(){
			if(con.scrollTop<heightHalf){
				con.scrollTop += 3;
				num -= 3;
			}else{
				con.scrollTop = 0;
			}
			if(num <= 0){
				clearInterval(timer);
			}
		}
	}
}
//服务项目下拉菜单

$(document).ready(function(){
$("#fwdiv").hover(
function(){
$(".fw-list").show();
},
function(){
$(".fw-list").hide();
}
)
})

