<?php
// db 연결
include("../main/db_connection.php");


// 로그인 페이지에서 받아온 정보 값 변수
$id = $_POST['mem_id'];
$pw = $_POST['password'];

$prevPage = $_SERVER['HTTP_REFERER'];

$query = "SELECT * FROM member WHERE mem_id='$id'";
$result = mysqli_query($connect, $query);

if ($info = mysqli_fetch_array($result)) {
//    echo("id : %s  pw : %s", $info['mem_id'], $info['pw']);

    // 비밀번호 일치
    if ($pw == $info['pw']) {

        session_start();
        $_SESSION['mem_id'] = $id;
        $_SESSION['nickname'] = $info['nickname'];

        echo '<script>location.href=history.go(-2);</script>';

//        echo "<script>location.href=history.back(-2)</script>";

        // 비밀번호 불일치
    } else {
        echo "<script>alert('입력하신 정보와 일치하는 회원을 찾을 수 없습니다.'); history.back()</script>";
        exit();
    }

    // 아이디 정보 없음
} else {
    echo "<script>alert('입력하신 정보와 일치하는 회원을 찾을 수 없습니다.'); history.back()</script>";
    exit();
}


?>
