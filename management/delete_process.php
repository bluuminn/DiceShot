<?php

// header 연결
include("../main/nav_header.php");


$delete_product_id = $_GET['id'];

$query = "delete from product where id='$delete_product_id'";
$result = mysqli_query($connect, $query);

if ($result) {
    echo '<script>alert("삭제되었습니다.");location.replace("../management/manage_main.php");</script>';
} else {
    echo "삭제에 실패했습니다.";
    echo mysqli_error($connect);
}

?>
