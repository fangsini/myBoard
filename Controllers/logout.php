<?php
echo $_SESSION['userid'];
// unset($_SESSION['userid']);
// unset($_SESSION['user']);
exit;
header("Location:../index.php");
?>