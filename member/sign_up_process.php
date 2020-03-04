w<?php
// db 연결
include("../main/db_connection.php");

// 회원가입 페이지에서 받아온 정보 값 변수
$email = $_POST['email'];
$pw = $_POST['password'];
$re_password = $_POST['re-password'];
$name = $_POST['member_name'];
$nickname = $_POST['nickname'];
$first_num = $_POST['first_num'];
$middle_num = $_POST['middle_num'];
$last_num = $_POST['last_num'];
$year = $_POST['yyyy'];
$month = $_POST['mm'];
$day = $_POST['dd'];


// 생년월일 합친 변수
$date_of_birth = NULL;

// 휴대폰 번호 합친 변수
$phone_number = NULL;


if ($email == NULL || $pw == NULL || $re_password == NULL || $name == NULL || $nickname == NULL || $first_num == NULL || $middle_num == NULL || $last_num == NULL) {
    if ($email == null) {
        echo 'email is null';
    }

    if ($pw == null) {
        echo 'password is null';
    }

    if ($re_password == null) {
        echo 're_password is null';
    }

    if ($name == null) {
        echo 'name is null';
    }

    if ($nickname == null) {
        echo 'nickname is null';
    }

    if ($first_num == null) {
        echo 'first_num is null';
    }

    if ($middle_num == null) {
        echo 'middle_num is null';
    }

    if ($last_num == null) {
        echo 'last_num is null';
    }
//    echo "<script>alert('필수 정보를 모두 입력해주세요.'); history.back()</script>";
    exit();
}

//비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
if ($pw != $re_password) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back()</script>";
    exit();

    // 비밀번호와 비밀번호 확인이 일치하면
} else {

    if (strlen($pw) >= 8) {
        //비밀번호는 암호화 처리
        $secure_password = password_hash($pw, PASSWORD_DEFAULT);

    } else {
        echo "<script>alert('비밀번호를 8자리 이상 입력해주세요.'); history.back()</script>";
        exit();
    }

}


// 연, 월, 일이 널이 아니면
if ($year != NULL && $month != NULL && $day != NULL) {
//    echo "생년월일 널 아님";
    // 생년월일 변수에 합쳐서 담아줌
    $date_of_birth = $year . "-" . $month . "-" . $day;

} else {
//    echo "생년월일 널임";
    $format = 'year : %1$s || month : %2$s || day : %3$s';

    $date_of_birth = NULL;
}

$phone_number = $first_num . '-' . $middle_num . '-' . $last_num;


$check = "SELECT * from member WHERE email='$email'";
$result = $connect->query($check);
if ($result->num_rows >= 1) {
//    echo "<a href=./sign_up.php>back page</a>";
    echo '<script>alert("이미 사용 중인 이메일입니다."); history.back()</script>';
    exit();
}


//회원의 고유 번호 생성
function uuidgen4()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

$uuid = uuidgen4();


// 생년월일 null
if ($date_of_birth == null) {
    $query = "INSERT INTO member (uuid, email, password, member_name, nickname, phone_number) VALUES ('$uuid','$email', '$secure_password', '$name', '$nickname', '$phone_number')";

} else {
    $query = "INSERT INTO member (uuid, email, password, member_name, nickname, phone_number, date_of_birth) VALUES ('$uuid','$email', '$secure_password', '$name', '$nickname', '$phone_number', STR_TO_DATE('$date_of_birth','%Y-%m-%d'))";
}

//$format = 'mem_id : %1$s || pw : %2$s || pw_ck : %3$s || name : %4$s || nickname : %5$s || gender : %6$s || day_of_month : %7$s || email : %8$s || mobile_num :  %9$s';
//printf($format, $id, $pw, $pw_ck, $name, $nickname, $gender, $day_of_birth, $email, $mobile_num);

$result = $connect->query($query);

if ($result) {
    echo "<script> alert('회원가입 완료!'); location.replace('../member/sign_in.php');</script>";

} else {
    echo mysqli_error($connect);

}


?>