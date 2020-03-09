<?php

include("../main/nav_header.php");

$title = $connect->escape_string($_POST['title']);
$content = $connect->escape_string($_POST['content']);

$cs_no = $_POST['cs_no'];
$modify_id = $_POST['modify_id'];

//TODO: 글 수정 프로세스 추가

if ($modify_id != null) {
    $sql = "update cs_board set title='{$title}', content='{$content}' where id='{$modify_id}'";

} else {
    $sql = "insert into cs_board(title, content, views, create_date, category, writer_uuid)";
    $sql .= " values('{$title}', '{$content}', 0, now(), {$cs_no}, '{$_SESSION['member_uuid']}')";
}


$res = mysqli_query($connect, $sql);


// db 입력 성공
if ($res) {
    // 수정 할 아이디 값이 널이 아니면 == 글 수정한 상황
    if ($modify_id != null) {

        if ($cs_no <= 1) {
            echo "<script> alert('공지사항이 수정되었습니다.'); location.replace('../board/view_board_details.php?post_no='+{$modify_id});</script>";
        } elseif ($cs_no <= 2) {
            echo "<script> alert('1:1 문의가 수정되었습니다.'); location.replace('../board/view_board_details.php?post_no='+{$modify_id});</script>";
        } else {
            echo "<script> alert('입고 요청이 수정되었습니다.'); location.replace('../board/view_board_details.php?post_no='+{$modify_id});</script>";
        }

        // 수정 할 아이디 값이 널이면 == 글을 새로 작성한 상황
    } else {
        if ($cs_no <= 1) {
            echo "<script> alert('공지사항이 등록되었습니다.'); location.replace('../board/cs_main.php?cs_no=1');</script>";
        } elseif ($cs_no <= 2) {
            echo "<script> alert('1:1 문의가 등록되었습니다.'); location.replace('../board/cs_main.php?cs_no=2');</script>";
        } else {
            echo "<script> alert('입고 요청되었습니다.'); location.replace('../board/cs_main.php?cs_no=3');</script>";
        }
    }

} else {
    // db 입력 실패
    echo "fail";
    echo mysqli_error($connect);
}


?>
