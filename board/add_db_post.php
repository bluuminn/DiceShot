<?php

include("../main/nav_header.php");

$title = $connect->escape_string($_POST['title']);
$content = $connect->escape_string($_POST['content']);


$cs_no = $_POST['cs_no'];


$sql = "insert into cs_board(title, content, views, create_date, category, writer_uuid)";

$sql .= " values('{$title}', '{$content}', 0, now(), {$cs_no}, '{$_SESSION['member_uuid']}')";


$res = mysqli_query($connect, $sql);


if ($res) {
    // db 입력 성공
    if ($cs_no <= 1) {
        echo "<script> alert('공지사항이 등록되었습니다.'); location.replace('../board/cs_main.php?cs_no=1');</script>";
    } elseif ($cs_no <= 2) {
        echo "<script> alert('1:1 문의가 등록되었습니다.'); location.replace('../board/cs_main.php?cs_no=2');</script>";
    } else {
        echo "<script> alert('입고 요청되었습니다.'); location.replace('../board/cs_main.php?cs_no=3');</script>";
    }

} else {
    // db 입력 실패
    echo "fail";
    echo mysqli_error($connect);
}


?>
