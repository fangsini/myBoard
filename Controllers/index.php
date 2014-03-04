<?php
/*Controllers/index.php*/
include "../conf/config.php";

/*模型类*/
include "../Models/comment.php";

if(isset($_POST['sub'])){
	if(!isset($_SESSION['userid'])){
		header("Location:../login.php");
	}else{
		/*调用Models/comment.php，增加评论记录*/
		if(comment::add($_SESSION['userid'],$_POST['content'])){
			header("Location:../index.php");
		}else{
			echo "评论失败";
		}

	}
}
?>