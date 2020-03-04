<?php

include("../main/db_connection.php");

$delete_no = $_POST['delete_no'];
$delete_nums = $_POST['delete_nums'];

$delete_no_list = explode('/', $delete_nums);


// 선택 상품 삭제
// 값 받아와서 구분자로 나눠서 배열에 담고
// 배열사이즈 만큼 반복
if ($delete_nums != null) {
    for ($i = 0; $i < sizeof($delete_no_list); $i++) {
        $delete = "DELETE from cart WHERE id={$delete_no_list[$i]}";
        $result = mysqli_query($connect, $delete);

        if ($result) {
            echo '<script>alert("상품이 삭제되었습니다.");location.replace("../cart/checkout.php");</script>';
        } else {
            echo "삭제에 실패했습니다.";
            echo mysqli_error($connect);
        }
    }
}


// 상품 개별 삭제
// 카트 아이디값 받아와서 삭제
if ($delete_no != null) {
    $delete = "DELETE from cart WHERE id={$delete_no}";
    $result = mysqli_query($connect, $delete);

    if ($result) {
        echo '<script>alert("상품이 삭제되었습니다.");location.replace("../cart/checkout.php");</script>';
    } else {
        echo "삭제에 실패했습니다.";
        echo mysqli_error($connect);
    }
}


?>
