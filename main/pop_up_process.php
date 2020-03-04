<?php
$check_24h = $_POST['check_24h'];

if ($check_24h != null) {
    setcookie("check_24h", 'check_24h_on', time() + (3600 * 24), "/");
}
?>