<?php
// db 연결
include("../main/db_connection.php");


// 로그인 페이지에서 받아온 정보 값 변수
$email = $_POST['member_email'];
$pw = $_POST['password'];
$auto_login = $_POST['auto_login'];
$prevPage = $_POST['prevPage'];

$query = "SELECT * FROM member WHERE email='$email'";
$result = mysqli_query($connect, $query);


if ($member = mysqli_fetch_array($result)) {
//    echo"email : %s  password : %s", $info['email'], $info['password'];


    //$hash_pw에 db에서 받아온 아이디열의 비밀번호를 저장합니다.
    $hash_pw = $member['password'];

    //입력된 비밀번호와 db에 저장된 비밀번호 일치 조건문
    if (password_verify($pw, $hash_pw)) {
        //만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운후 main.php파일로 넘어갑니다.

        session_start();
        $_SESSION['member_email'] = $member['email'];
        $_SESSION['nickname'] = $member['nickname'];
        $_SESSION['member_uuid'] = $member['uuid'];

        if ($auto_login != null) {
            setcookie("auto_login_member_uuid", $member['uuid'], time() + (3600 * 24 * 90), "/");
        }


        if (isset($_COOKIE['temp_cart'])) {

            $member_uuid = $member['uuid'];

            // 임시 장바구니 값 가져와서 배열화
            $temp_cart_array = unserialize($_COOKIE['temp_cart']);

            // 임시 장바구니 개수 만큼 반복
            for ($i = 0; $i < sizeof($temp_cart_array); $i++) {

                // 인덱스에 해당하는 값 상품번호랑 수량으로 분리
                $split_info = explode('/', $temp_cart_array[$i]);

                $product_id = $split_info[0];
                $amount = $split_info[1];

                $stock_query = "SELECT stock FROM product WHERE id='{$product_id}'";
                $stock_query_result = mysqli_query($connect, $stock_query);
                $product_stock = mysqli_fetch_assoc($stock_query_result);

                if ($amount > $product_stock['stock']) {
                    echo '<script> alert("재고가 부족합니다."); history.back(); </script>';
                    exit;
                }

                $is_product = "SELECT amount FROM cart WHERE member_uuid='{$member_uuid}' AND product_id={$product_id}";
                $prod_result = mysqli_query($connect, $is_product);
                $product = mysqli_fetch_array($prod_result);


                if ($product['amount']) {

                    $update_count = $product['amount'] + $amount;

                    //이미 존재할 경우 amount 업데이트 해줌
                    $update = "UPDATE cart SET amount='{$update_count}', added_date=now() WHERE member_uuid='{$member_uuid}' AND product_id={$product_id}";

                    if (mysqli_query($connect, $update)) {

                    } else {
                        echo '<script> alert("장바구니에 추가되지 않았습니다.....");  </script>';
                        echo("쿼리오류 발생1: " . mysqli_error($connect));
                    }

                } else {
                    $query = "insert into cart(member_uuid, product_id, amount, added_date) values('{$member_uuid}', '{$product_id}', '{$amount}', now())";
                    $result = mysqli_query($connect, $query);

                    if ($result) {

                    } else {
                        echo '<script> alert("장바구니에 추가되지 않았습니다."); </script>';
                        echo("쿼리오류 발생2: " . mysqli_error($connect));

                    }

                }
            }

            setcookie('temp_cart', '', time() - 99999999, '/');
        }


        //TODO: 회원가입눌렀다가 로그인 누르면 회원가입 화면으로 넘어감 수정해야함.. 현재는 메인으로 넘어가게 연결함
//        header("location:../main/index.php");

// 로그인 처리를 마치고 원래 페이지로 이동시킴

        header("location:" . $prevPage);

//        echo '<script>location.href="../main/index.php";</script>';
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
