<?php

// header 연결
include("../main/nav_header.php");


// 주문 번호 가져오기
$order_no = $_POST['order_no'];

$get_order_query = "select * from order_info where order_no='{$order_no}'";
$get_order_result = mysqli_query($connect, $get_order_query);
if ($get_order_result) {
    $order = mysqli_fetch_assoc($get_order_result);
} else {
    echo "주문정보 가져오기 실패: " . mysqli_error($connect);
}

$status = "구매확정";

$status_update_query = "UPDATE order_info SET progress_status='{$status}' WHERE order_no='{$order_no}'";
$status_update_result = mysqli_query($connect, $status_update_query);

if (!$status_update_result) {
    echo "주문 상태 업데이트 실패: " . mysqli_error($connect);

} else {
    echo "<script>
    document.location.href='./orderlist.php';
    </script>";
}

?>