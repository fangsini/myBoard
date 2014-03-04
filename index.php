<?php
include "conf/config.php";

/*模型类*/
include "Models/comment.php";
include "Models/user.php";

$result = comment::printAll();
if(!$result){
	$result = array();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>index</title>
</head>
<body>
	<?php
	if(isset($_SESSION['userid'])) {
		echo "欢迎".user::getUserName($_SESSION['userid']);
		echo "<a href='Controllers/logout.php'>退出</a>";
	}else {
		echo "请"."<a href='login.php'>登录</a>";
	}
	?>
	<h2>你的评论</h2>
	<form action="Controllers/index.php" method="POST">
		<textarea name="content" id="" cols="30" rows="10"></textarea>
		<input type="submit" name="sub" value="提交" />
	</form>
	<ul>
		<?php
		foreach($result as $row){
			/*Models/user.php的getUserName获取名字*/
			$user_name = user::getUserName($row['user_id']);
		?>
		<li><span><?=$user_name?></span>:<?=$row['content']?><span><?=$row['publish_time']?></span></li>
		<?php
		}
		?>
	</ul>
</body>
</html>