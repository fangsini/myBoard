<?php

/*
*checklog.php
*用户登录检测
*/
include "../conf/config.php";

/*模块类*/
include "../Models/user.php";

if(isset($_POST['user']) && !empty($_POST['user'])
	&& isset($_POST['pwd']) && !empty($_POST['pwd'])
) {
	if(user::check($_POST['user'],$_POST['pwd'])){
		/*获取用户id*/
		$uid = user::getUserId($_POST['user']);
		/*记录session*/
		$_SESSION['userid'] = $uid;
		$_SESSION['user'] = $_POST['user'];
    	header("Location:../index.php");
	}else{
		echo "用户名或密码错误";
	}
}

?>