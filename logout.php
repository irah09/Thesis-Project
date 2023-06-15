<?php
session_start();
session_unset();
session_destroy();
setcookie('uid', $_SESSION['uid'], time() -1);
header("Location:index.php");
?>