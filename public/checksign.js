$(function(){
	init();
});

function init() {
	flagName = flagPwd = flagRepwd = flagEmail = false;
	$("#user").blur(checkName);
	$("#pwd").blur(checkPwd);
	$("#repwd").blur(checkRepwd);
	$("#email").blur(checkEmail);
	$_id("sub").disabled = true;
}
function $_id(id) {
	return document.getElementById(id);
}
function checkName() {
	/*用ajax验证名字的唯一性，即nickname*/
	var xmlhttp = buildXmlhttp();
	var name = $("#user").val();
	var url = "Controllers/checksign.php?action=checkname&userName="+name;
	xmlhttp.open("get",url,true);
	xmlhttp.onreadystatechange=displayName;
	xmlhttp.send(null);
}
function checkPwd() {
	/*验证密码长度>=6*/
	var obj = $("#pwd").val();
	if(obj.length < 6) {
		$("#pwd-tips").html("错误，密码长度必须大于等于6");
		flagPwd = false;
	}else {
		$("#pwd-tips").html("");
		flagPwd = true;
	}
	checkSubmit();
}
function checkRepwd() {
	/*验证确认密码*/
	var repwd = $("#repwd").val();
	var pwd = $("#pwd").val();
	if(repwd != pwd) {
		$("#repwd-tips").html("验证密码不正确");
		flagRepwd = false;
	}else {
		$("#repwd-tips").html("");
		flagRepwd = true;
	}
	checkSubmit();
}
function checkEmail() {
	/*用ajax验证邮箱的格式和检查唯一性*/
	var email = $("#email").val();
	var url = "Controllers/checksign.php?action=checkemail&mail="+email;
	var xmlhttp = buildXmlhttp();
	xmlhttp.open("get",url,true);
	xmlhttp.onreadystatechange = displayEmail;
	xmlhttp.send(null);
}
/*ajax*/
/*创建xmlhttp对象
*@return xmlhttp
*/
function buildXmlhttp() {
	try{
		xmlhttp = new ActiveXObject('Msxm12.XMLHTTP');
	}catch(e){
		try{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}catch(e){
			try{
				xmlhttp = new XMLHttpRequest();
			}catch(e){}
		}
	}
	return xmlhttp;
}

function displayName() {
	if(xmlhttp.readyState == 4){
		if(xmlhttp.status==200){
			$("#name-tips").html(xmlhttp.responseText);
			if(xmlhttp.responseText != ""){
				flagName = false;
			}else {
				flagName = true;
			}
		}else {
			alert("网络连接失败");
		}
	}
	checkSubmit();
}

function displayEmail() {
	if(xmlhttp.readyState == 4){
		if(xmlhttp.status == 200) {
			$("#email-tips").html(xmlhttp.responseText);
			if(xmlhttp.responseText != ""){
				flagEmail = false;
			}else {
				flagEmail = true;
			}
		}else {
			alert("网络连接失败");
		}
	}
	checkSubmit();
}
function checkSubmit() {
	if(flagName && flagPwd && flagRepwd && flagEmail){
		$_id("sub").disabled = false; 
	}else {
		$_id("sub").disabled = true; 
	}
}
