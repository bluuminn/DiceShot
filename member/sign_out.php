<?php
session_start();
session_destroy();

setcookie("auto_login_member_uuid", "", time()-9999999999, "/");
header("location:../main/index.php");
//echo '<script>location.href="../main/index.php";</script>';
//echo '<script>history.back();</script>';
?>