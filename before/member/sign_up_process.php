w<?php
// db 연결
include("../main/db_connection.php");

// 회원가입 페이지에서 받아온 정보 값 변수
$id = $_POST['mem_id'];
$pw = $_POST['password'];
$pw_ck = $_POST['ck_password'];
$name = $_POST['mem_name'];
$nickname = $_POST['mem_nickname'];
$gender = $_POST['gender'];
$year = $_POST['yyyy'];
$month = $_POST['mm'];
$day = $_POST['dd'];
$email = $_POST['email'];
$mobile_num = $_POST['mobile_num'];

// 생년월일 합친 변수
$date_of_birth = NULL;

// 연, 월, 일이 널이 아니면
if ($year != NULL && $month != NULL && $day != NULL) {
//    echo "생년월일 널 아님";
    // 생년월일 변수에 합쳐서 담아줌
    $date_of_birth = $year . "-" . $month . "-" . $day;
//    echo $date_of_birth;
} else {
//    echo "생년월일 널임";
    $format = 'year : %1$s || month : %2$s || day : %3$s';
//    printf($format, $year, $month, $day);

    $date_of_birth = NULL;
}

//if ($gender != null) {
//    echo "<script>alert('gender : {$gender} 널 아님'); history.back()</script>";
////    exit();
//} else {
//    echo "<script>alert('gender : {$gender} 널....'); history.back()</script>";
//    $gender = NULL;
////    exit();
//}

//비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
if ($pw != $pw_ck) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back()</script>";
    exit();
}

if ($id == NULL || $pw == NULL || $pw_ck == NULL || $name == NULL || $nickname == NULL || $email == NULL || $mobile_num == NULL) {
//    echo "필수 정보를 입력해주세요";
    echo "<script>alert('필수 정보를 모두 입력해주세요.'); history.back()</script>";
//    echo "<a href=./sign_up.php>back page</a>";
    exit();
}


$check = "SELECT * from member WHERE mem_id='$id'";
$result = $connect->query($check);
if ($result->num_rows >= 1) {
//    echo "<a href=./sign_up.php>back page</a>";
    echo "<script>alert(\"{$id}는 이미 사용 중인 아이디 입니다.\"); history.back()</script>";
    exit();
}


// 생년월일, 성별이 모두 null
if ($date_of_birth == null && $gender == null) {
    $query = "INSERT INTO member (mem_id, pw, mem_name, nickname, email, mobile_num) VALUES ('$id', '$pw', '$name', '$nickname', '$email', '$mobile_num')";


    // 생년월일 ok && 성별 null
} elseif ($date_of_birth != null && $gender == null) {
    $query = "INSERT INTO member (mem_id, pw, mem_name, nickname, date_of_birth, email, mobile_num) VALUES ('$id', '$pw', '$name', '$nickname', STR_TO_DATE('$date_of_birth','%Y-%m-%d'), '$email', '$mobile_num')";


    // 생년월일 null && 성별 ok
} elseif ($date_of_birth == null && gender != null) {
    $query = "INSERT INTO member (mem_id, pw, mem_name, nickname, gender, email, mobile_num) VALUES ('$id', '$pw', '$name', '$nickname', '$gender', '$email', '$mobile_num')";


    // 생년월일, 성별 모두 ok
} else {
    $query = "INSERT INTO member (mem_id, pw, mem_name, nickname, date_of_birth, gender, email, mobile_num) VALUES ('$id', '$pw', '$name', '$nickname', STR_TO_DATE('$date_of_birth','%Y-%m-%d'), '$gender', '$email', '$mobile_num')";
}

//$format = 'mem_id : %1$s || pw : %2$s || pw_ck : %3$s || name : %4$s || nickname : %5$s || gender : %6$s || day_of_month : %7$s || email : %8$s || mobile_num :  %9$s';
//printf($format, $id, $pw, $pw_ck, $name, $nickname, $gender, $day_of_birth, $email, $mobile_num);

$result = $connect->query($query);

//printf($result);

if ($result) {
//if ($query) {
    echo "<script> alert('회원가입 완료!'); location.replace('sign_in.php');</script>";
} else {
    echo mysqli_error($connect);
//    die('MySQL connect ERROR : ' . mysqli_free_result($query));
//    echo "<script> alert('fail' . mysqli_error();); history.back();</script>";
}

//if ($sign_up) {
////    echo "회원가입 완료!";
//    echo "<script>alert('회원가입 완료!'); location.replace('../sign_in/sign_in.php');</script>";
//}


?>