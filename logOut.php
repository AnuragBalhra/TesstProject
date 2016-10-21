<?php
include "dblib.php";
include "clublib.php";

flipOnlineState();

unset($_SESSION["session"]);
session_destroy();
header("Location:login.php");
exit();

?>