<?php

// header 연결
include("../main/nav_header.php");


$order_info = $_POST['order_info'];
$input_info = $_POST['input_info'];
$cart_id = $_POST['cart_id'];
$addrRegiCk = $_POST['addrRegiCk'];

// 결제정보
$order_info_object = json_decode($order_info);

// 주문정보
$input_info_object = json_decode($input_info);

// 장바구니 리스트 '/'로 나누기
$cart_id_list = explode('/', $cart_id);

$cart_id_list_size = sizeof($cart_id_list);
//echo $cart_id_list_size;

// 주문일자
$order_date = date("Y-m-d H:i:s");

// 주문자 uuid
$purchaser_uuid = $_SESSION['member_uuid'];

// 결제 정보
$payment_info = $order_info_object->payment_name;
if ($payment_info == '신용카드') {
    $card_no = $order_info_object->card_no;
    $card_name = $order_info_object->card_name;

    $payment_info = $payment_info . ' / ' . $card_no . ' / ' . $card_name;
}

$zipcode = $input_info_object->postcode;
$addr1 = $input_info_object->address . " " . $input_info_object->extraAddress;
$addr2 = $input_info_object->detailAddress;
$recipient_name = $input_info_object->recipient_name;
$recipient_contact = $input_info_object->recipient_contact_first_num . '-' . $input_info_object->recipient_contact_middle_num . '-' . $input_info_object->recipient_contact_last_num;
$delivery_msg = $input_info_object->delivery_msg;


//TODO : 주문한 사용자의 정보를 가져와서 사용자한테 저장된 주소 정보가 없으면 저장하기
$get_member_query = "select * from member where uuid='{$_SESSION['member_uuid']}'";
$get_member_result = mysqli_query($connect, $get_member_query);
$member_info = mysqli_fetch_assoc($get_member_result);

if ($addrRegiCk == 'y') {
    $addr = $input_info_object->address . "+" . $input_info_object->extraAddress;
    $member_update_query = "UPDATE member SET zipcode='{$zipcode}', address1='{$addr}', address2='{$addr2}' WHERE uuid='{$_SESSION['member_uuid']}'";
    $result = mysqli_query($connect, $member_update_query);
}
if (!$result) {
    echo "멤버 주소 정보 등록 에러: " . mysqli_error($connect);
} else {
    echo "<script>alert('업데이트쿼리: '+'{$member_update_query}')</script>";
}

$get_order_info_query = "select * from order_info";
$get_order_info_result = mysqli_query($connect, $get_order_info_query);
$order_count = mysqli_num_rows($get_order_info_result);
$order_count += 1;
$order_count = sprintf('%06d', $order_count);

// 주문번호
$order_no = date("Ymd") . '-' . $order_count;

// 주문 완료된 장바구니 리스트가져와서 주문상품 테이블에 추가해주고 지우기
for ($i = 0; $i < $cart_id_list_size; $i++) {

// 주문 상품 정보 테이블에 추가
    $get_cart_query = "select * from cart where id={$cart_id_list[$i]}";
    $get_cart_result = mysqli_query($connect, $get_cart_query);
    $cart_item = mysqli_fetch_assoc($get_cart_result);

    $product_id = $cart_item['product_id'];
    $amount = $cart_item['amount'];

    $add_order_table_query = "insert into ordered_product(order_no, product_id, amount) values ('{$order_no}', '{$product_id}', '{$amount}')";
    $add_order_table_result = mysqli_query($connect, $add_order_table_query);


// 상품 판매량 업데이트
    $get_product_query = "select * from product where id={$product_id}";
    $get_product_result = mysqli_query($connect, $get_product_query);
    if ($get_product_result) {
        $product = mysqli_fetch_assoc($get_product_result);
        (int)$temp_sales = $product['sales'];
        (int)$amount;
        $sales = $temp_sales + $amount;

        (int)$temp_stock = $product['stock'];
        $stock = $temp_stock - $amount;
//        echo "<script>alert('{$sales}')</script>";

        //TODO : 재고량 수정하기
        $update_sales_query = "UPDATE product SET sales={$sales}, stock={$stock} WHERE id={$product_id}";
        $update_sales_result = mysqli_query($connect, $update_sales_query);
        if (!$update_sales_result) {
            echo '상품 판매량, 재고량 업데이트 안됨' . '<br>';
            echo mysqli_error($connect);
        }

    }


}


?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">


<body>

<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3" style="margin-bottom: 50px">
                <h3 style="text-align: center; margin-bottom: 30px; color: #111111">주문이 완료되었습니다!</h3>
                <h4 style="text-align: center; color: #111111">주문번호 : <?= $order_no; ?></h4>
                <h4 style="text-align: center; color: #111111">주문시간 : <?= $order_date; ?></h4>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 style="margin-top: 100px; color: #111111">주문 상품 정보</h2>

            <table class="table table-border">
                <tbody>
                <tr style="text-align: center; background: #f9f9f9;">
                    <td width="200"></td>
                    <td width="400">상품정보</td>
                    <td width="200">판매가</td>
                    <td width="200">상품수량</td>
                    <td width="200">합계</td>
                </tr>


                <?

                for ($i = 0; $i < $cart_id_list_size; $i++) {

                    $query = "select * from cart where id='{$cart_id_list[$i]}'";
                    $result = mysqli_query($connect, $query);

                    $cart_item = mysqli_fetch_assoc($result);

                    $get_prod_query = "select * from product where id='{$cart_item['product_id']}'";
                    $get_prod_result = mysqli_query($connect, $get_prod_query);
                    $prod_info = mysqli_fetch_assoc($get_prod_result);

                    $total_price += $prod_info['price'] * $cart_item['amount'];

                    if ($i == 0) {
                        $product_name = $prod_info['title'];
                    }

                    ?>


                    <tr style="text-align: center">

                        <td class="hidden-xs" style="vertical-align: middle">
                            <div class="scale">
                                <a href="#">
                                    <img src="<?= $prod_info['img_path'] ?>"
                                         alt="<?= $prod_info['title'] . ' (' . $prod_info['eng_title'] . ')' ?>"
                                         style="width: 60px; height: auto"/>
                                </a>
                            </div>
                        </td>

                        <td style="text-align: left; vertical-align: middle">
                            <a href="../product/detail_product.php?prod_id=<?= $prod_info['id'] ?>">
                                <?= $prod_info['title'] . ' (' . $prod_info['eng_title'] . ')' ?>
                            </a>
                        </td>


                        <td style="vertical-align: middle">
                            <?= $prod_info['price'] ?>
                        </td>

                        <td style="vertical-align: middle">
                            <?= $cart_item['amount'] ?>
                        </td>

                        <td style="vertical-align: middle">
                            <?= number_format($prod_info['price'] * $cart_item['amount']) ?>
                        </td>
                        <!--                                        <td class="pr-remove" style="vertical-align: middle">-->
                        <!--                                            <a href="#" title="Remove">-->
                        <!--                                                <i class="fa fa-times"></i>-->
                        <!--                                            </a>-->
                        <!--                                        </td>-->
                    </tr>

                <? }

                if ($total_price < 30000) {
                    $shipping = 2500;
                }
                ?>

                <tr style="text-align: right; background: #f9f9f9;">
                    <td colspan="5"> 상품금액(<?= number_format($total_price); ?>) + 배송비(<? if ($shipping < 2500) {
                            echo 0;
                        } else {
                            echo $shipping;
                        }; ?>) = <?= number_format($total_price + $shipping) ?></td>
                </tr>


                </tbody>
            </table>


            <h2 style="margin-top: 100px; color: #111111">결제 정보</h2>
            <hr>
            <div style="padding-top: 10px; padding-bottom: 30px; font-size: 16px">
                <div class="row">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        최종 결제금액
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= number_format($total_price + $shipping) ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        결제 수단
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $payment_info ?>
                    </div>
                </div>

            </div>


            <h2 style="margin-top: 100px; color: #111111">배송지 정보</h2>
            <hr>
            <div style="padding-top: 10px; padding-bottom: 200px; font-size: 16px">
                <div class="row">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        수령인
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $recipient_name ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        우편번호
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $zipcode ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        주소
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $addr1 . ' ' . $addr2 ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        연락처
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $recipient_contact ?>
                    </div>
                </div>


                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        배송요청사항
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $delivery_msg ?>
                    </div>
                </div>
            </div>

            <div class="font-alt mt-30 col-sm-offset-5" style="margin-bottom: 200px">
                <a class="btn btn-border-bk btn-round col-sm-3" href="../main/index.php">홈으로 돌아가기</a>
            </div>
    </section>

</div>


<?php

for ($i = 0; $i < $cart_id_list_size; $i++) {
// 주문 상품 정보 테이블에 데이터 추가 되면 장바구니에서 삭제
    if ($add_order_table_result) {

        $del_cart_query = "delete from cart where id={$cart_id_list[$i]}";
        $del_cart_result = mysqli_query($connect, $del_cart_query);

        if (!$del_cart_result) {
            echo '장바구니 테이블에서 주문 완료된 상품 삭제 안됨' . '<br>';
            echo mysqli_error($connect);
        }


        // 주문 상품 정보 테이블에 추가 안됨
    } else {
        echo '주문 상품 정보 테이블에 추가 안됨' . '<br>';
        echo mysqli_error($connect);

    }
}


$add_order_query = "insert into order_info(order_no, purchaser_uuid, order_date, payment_info, zipcode, addr1, addr2, delivery_msg, recipient_name, recipient_contact) 
values ('{$order_no}', '{$purchaser_uuid}', '{$order_date}', '{$payment_info}', '{$zipcode}', '{$addr1}', '{$addr2}', '{$delivery_msg}', '{$recipient_name}', '{$recipient_contact}')";
$add_order_result = mysqli_query($connect, $add_order_query);
if (!$add_order_result) {
    echo '주문정보 테이블에 데이터 추가 안됨' . '<br>';
    echo mysqli_error($connect);
}


// footer 연결
include("../main/footer.php");

?>

</body>
</html>
