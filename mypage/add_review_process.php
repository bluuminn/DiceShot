<?php

include("../main/nav_header.php");

$title = $connect->escape_string($_POST['title']);
$content = $connect->escape_string($_POST['content']);

$order_no = $_POST['order_no'];
$product_id = $_POST['product_id'];
$ordered_product_id = $_POST['ordered_product_id'];
$rating = $_POST['rating'];


$add_review = "insert into review(product_id, writer_uuid, write_date, title, contents, rating)";
$add_review .= " values('{$product_id}','{$_SESSION['member_uuid']}', now(), '{$title}', '{$content}','{$rating}')";

$add_review_result = mysqli_query($connect, $add_review);


// 리뷰 등록이 완료 되면
if ($add_review_result) {

    // 주문 정보 상품 테이블 리뷰 정보 업데이트
    $update_ordered_product_info = "UPDATE ordered_product SET is_review=1 WHERE id={$ordered_product_id}";
    $update_ordered_product_info_result = mysqli_query($connect, $update_ordered_product_info);


    // 주문 정보 상품 테이블 리뷰 정보 업데이트 되면
    if ($update_ordered_product_info_result) {

        // 주문번호로 주문 정보 상품 리스트 조회
        $get_ordered_products = "select is_review from ordered_product where order_no='{$order_no}'";
        $get_ordered_products_result = mysqli_query($connect, $get_ordered_products);

        // 상품 리스트 가져오면
        if ($get_ordered_products_result) {

            // 주문 번호로 조회한 상품 개수
            $total_product_count = mysqli_num_rows($get_ordered_products_result);

            $review_cnt = 0;

            // 상품 개수만큼 반복
            while ($prod_info = mysqli_fetch_assoc($get_ordered_products_result)) {

                // 리뷰작성여부가 참이면
                if ($prod_info['is_review']) {

                    // 리뷰 카운트 +1
                    $review_cnt++;
                }
            }


            // 만약 상품 개수와 리뷰 카운트 수가 같으면
            // => 한 주문번호의 모든 상품 리뷰 작성완료라는 뜻
            if ($total_product_count == $review_cnt) {

                // 주문정보 테이블의 리뷰 작성 여부 업데이트
                $update_order_info = "UPDATE order_info SET is_review=1 WHERE order_no='{$order_no}'";
                $update_order_info_result = mysqli_query($connect, $update_order_info);

                if (!$update_order_info_result) {
                    echo '주문 정보 테이블 리뷰 정보 업데이트 안됨 : ' . mysqli_error($connect) . '<br>';
                }
            } else {
                echo "<script> alert('주문 정보 테이블 업데이트 안됨 '+{$total_product_count}+ ' / ' +{$review_cnt});</script>";

            }
        }
    } else {
        echo '주문 정보 상품 테이블 리뷰 정보 업데이트 안됨 : ' . mysqli_error($connect) . '<br>';

    }
    // db 입력 성공
    echo "<script> alert('리뷰가 등록되었습니다.'); document.location.href='../mypage/view_order_detail.php?order_no='+'{$order_no}'</script>";


} else {
    // db 입력 실패
    echo "fail";
    echo mysqli_error($connect);
}


?>
