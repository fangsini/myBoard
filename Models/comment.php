<?php
/*comment.php*/
class comment{
	/*构造函数*/
	function __construct(){

	}
	/*add方法
	*@author sini
	*@param $uid int 用户id
	*@param $content string 评论内容
	*@return boolean
	*/
	static function add($uid,$content){
		global $db;
		try{
			$query = $db->prepare('insert into comment(user_id,
				content,publish_time) values (?,?,?)');
			$query->execute(array($uid,$content,date('Y-m-d H:i:s')));
			return true;
		}catch(PDOExecption $e){
			echo $e;
			return false;
		}
	}
	/*printAll方法
	*输出所有评论
	*@return array|false
	*/
	static function printAll(){
		global $db;
		try{
			$query = $db->query('select user_id,content,
				publish_time from comment');
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOExecption $e){
			echo $e;
			return false;
		}
	}
}
?>