<?php


include("../main/db_connection.php");

$amount = $_POST['amount'];
$cart_id = $_POST['cart_id'];

$update = "UPDATE cart SET amount={$amount} WHERE id={$cart_id}";

if (mysqli_query($connect, $update)) {
    // echo '<script> alert("수량 수정 완료"); history.back(); </script>';
    echo '<script> history.back(); </script>';

} else {
    echo '<script> alert("수량 수정 실패"); </script>';
    echo ("쿼리오류 발생: " . mysqli_error($connect));
}

?>