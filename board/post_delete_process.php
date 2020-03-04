<?php

// header 연결
include("../main/nav_header.php");


$post_id = $_GET['id'];
$cs_no = $_GET['cs_no'];


$query = "delete from cs_board where id='$post_id'";
$result = mysqli_query($connect, $query);

if ($result) {
    $back_url = "../board/cs_main.php?cs_no={$cs_no}";
    echo $back_url;
    echo "<script>alert('삭제되었습니다.');location.replace('{$back_url}');</script>";

} else {
    echo "삭제에 실패했습니다.";
    echo mysqli_error($connect);
}

?>
