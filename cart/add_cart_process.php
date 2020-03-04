<?php

session_start();
include("../main/db_connection.php");
//include("../main/nav_header.php");


$member_uuid = $_POST['member_uuid'];
$product_id = $_POST['product_id'];
$amount = $_POST['amount'];

//echo "<script> alert('member_uuid : '+'{$_SESSION['member_uuid']}'); </script>";


if (isset($_SESSION['member_uuid'])) {

    $stock_query = "SELECT stock FROM product WHERE id={$product_id}";
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
            echo '<script>
            if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
                location.href="checkout.php";
            } else {
                history.back();
            }

            </script>';
        } else {
            echo '<script> alert("장바구니에 추가되지 않았습니다....");  </script>';
            echo("쿼리오류 발생: " . mysqli_error($connect));
        }

    } else {
        $query = "insert into cart(member_uuid, product_id, amount, added_date) values('{$member_uuid}', '{$product_id}', '{$amount}', now())";
        $result = mysqli_query($connect, $query);

        if ($result) {
            echo '<script>
            if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
                location.href="./checkout.php";
            } else {
                history.back();
            }

            </script>';


        } else {
            echo '<script> alert("장바구니에 추가되지 않았습니다.");  </script>';
            echo("쿼리오류 발생: " . mysqli_error($connect));

        }

    }


    // 비회원일 때
} else {
//    echo '<script>alert("세션이 없습니다.");</script>';

    $add_info = $product_id . '/' . $amount;

    // 비회원 장바구니
    // 임시 장바구니 쿠키가 있으면
    if (isset($_COOKIE['temp_cart'])) {

        // 임시 장바구니 쿠키가 갖고 있는 배열 가져옴
        $array = unserialize($_COOKIE['temp_cart']);

        // 상품이 배열 안에 없으면
        if (!in_array($add_info, $array)) {

            //상품의 id가 쿠키에 저장된 배열의 요소가 아니면 해당 배열의 맨 앞에 추가해서 다시 쿠키에 저장해줌
            array_unshift($array, $add_info);

            //배열을 다시 serialize해줌
            $temp_cart_array = serialize($array);

            //동일한 이름을 가진 쿠키에 저장해줌(덮어씌워지는듯)
            setcookie('temp_cart', $temp_cart_array, time() + 86400, '/');

            echo '<script>
            if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
                location.href="checkout.php";
            } else {
                history.back();
            }</script>';

        }
        // 상품이 배열 안에 있으면
        //TODO: 개수 추가 해줘야함
//        } else {

//            // 배열에서 해당 상품 아이디의 인덱스 값을 찾아서 반환
//            $array_index = array_search($add_info, $array);
//
//            // 상품번호/수량 형식으로 되어있는거를 '/'기준으로 나누어서 배열로 저장
//            $split_info = explode('/', $array[$array_index]);
//
//            $test1 =
//            echo $split_info[0] . '/test/' . $split_info[1];
//            echo '<br>';
//
//            $tmp_amount = $split_info[1];
//
//            (int)$amount;
//            (int)$tmp_amount;
//
//            $tmp_amount += $amount;
//
//            echo $product_id . '/test2/' . $tmp_amount;
//
//            $add_info = $product_id . '/' . (string)$tmp_amount;
//
//            $replace = array($array_index => $add_info);
//            $array = array_replace($array, $replace);
//
//            // 배열을 스트링화 함
//            $temp_cart_array = serialize($array);
//
//            // 쿠키값 변경
//            setcookie('temp_cart', $temp_cart_array, time() + 86400, '/');
//        }


        //쿠키가 존재하지 않을 경우
    } else {

        //상품의 id값을 담을 배열 선언
        $temp_cart = [];

        //배열에 상품의 id값을 추가해줌
        array_push($temp_cart, $add_info);

        //쿠키에 담기위해서 serialize해줌
        $temp_cart_array = serialize($temp_cart);

        //배열을 담는 쿠키 생성
        setcookie('temp_cart', $temp_cart_array, time() + 86400, '/');


        echo '<script>
            if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
                location.href="checkout.php";
            } else {
                history.back();
            }</script>';
    }

}


?>