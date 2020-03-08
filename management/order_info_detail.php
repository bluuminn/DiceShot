<?php

// header 연결
include("../main/nav_header.php");


$order_no = $_GET['order_no'];

// 주문번호의 주문 상품 리스트를 가져옴
$get_order_info = "select * from order_info where order_no='{$order_no}'";
$order_info_result = mysqli_query($connect, $get_order_info);
if ($order_info_result) {
    $order = mysqli_fetch_assoc($order_info_result);
}

// 주문 상품 정보 가져옴
$get_order_products = "select * from ordered_product where order_no='{$order_no}'";
$order_products_result = mysqli_query($connect, $get_order_products);

if ($order_products_result) {
    $products_count = mysqli_num_rows($order_products_result);

}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">


<body>

<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3" style="margin-bottom: 50px">
                <h3 style="text-align: center; margin-bottom: 30px; color: #111111">주문 내역 상세</h3>
                <h4 style="text-align: center; color: #111111">주문번호 : <?= $order['order_no']; ?></h4>
                <h4 style="text-align: center; color: #111111">주문시간 : <?= $order['order_date']; ?></h4>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 style="margin-top: 100px; color: #111111">주문 상품 정보</h2>

            <table class="table table-border" style="margin-top: 10px;">
                <tbody>
                <tr style="text-align: center; background: #f9f9f9;">
                    <td width="200"></td>
                    <td width="400">상품정보</td>
                    <td width="200">판매가</td>
                    <td width="200">상품수량</td>
                    <td width="200">합계</td>
                    <td width="200">출고 상태</td>
                </tr>


                <?

                while ($products_list = mysqli_fetch_assoc($order_products_result)) {

                    $query = "select * from product where id='{$products_list['product_id']}'";
                    $result = mysqli_query($connect, $query);

                    $product = mysqli_fetch_assoc($result);

                    $total_price += $product['price'] * $products_list['amount'];

                    ?>


                    <tr style="text-align: center">

                        <td class="hidden-xs" style="vertical-align: middle">
                            <div class="scale">
                                <a href="#">
                                    <img src="<?= $product['img_path'] ?>"
                                         alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"
                                         style="width: 60px; height: auto"/>
                                </a>
                            </div>
                        </td>

                        <td style="text-align: left; vertical-align: middle">
                            <a href="../product/detail_product.php?prod_id=<?= $product['id'] ?>">
                                <?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>
                            </a>
                        </td>


                        <td style="vertical-align: middle">
                            <?= $product['price'] ?>
                        </td>

                        <td style="vertical-align: middle">
                            <?= $products_list['amount'] ?>
                        </td>

                        <td style="vertical-align: middle">
                            <?= number_format($product['price'] * $products_list['amount']) ?>
                        </td>

                        <td style="vertical-align: middle">
                            <? if ($order['progress_status'] == "결제완료") { ?>
                                <button class="btn btn-success btn-round order_button"
                                        size="5" onclick="order(<?= $order['id']; ?>);" data-toggle="modal"
                                        data-target="#insertBlack"
                                        data-notifyid=<?= $order['order_no']; ?> data-nonnotifyid="${list.NONNOTIFYID}"
                                        data-ncontent="${list.NCONTENT }">출고
                                </button>
                            <? } else { ?>
                            <font color=red>출고 완료</font><br/>
                                송장번호:
                            <? echo $order['invoice'];
                            } ?>
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
                    <td colspan="6"> 상품금액(<?= number_format($total_price); ?>) + 배송비(<? if ($shipping < 2500) {
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
                        <?= $order['payment_info'] ?>
                    </div>
                </div>

            </div>


            <h2 style="margin-top: 100px; color: #111111">배송 정보</h2>
            <hr>
            <div style="padding-top: 10px; padding-bottom: 200px; font-size: 16px">
                <div class="row">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        수령인
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $order['recipient_name'] ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        우편번호
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $order['zipcode'] ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        주소
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $order['addr1'] . ' ' . $order['addr2'] ?>
                    </div>
                </div>

                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        연락처
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $order['recipient_contact'] ?>
                    </div>
                </div>


                <div class="row" style="vertical-align: middle">
                    <div class="col-sm-2" style="margin-bottom: 20px">
                        배송요청사항
                    </div>
                    <div class="col-sm-10" style="margin-bottom: 20px">
                        <?= $order['delivery_msg'] ?>
                    </div>
                </div>
            </div>

            <div class="font-alt mt-30 col-sm-offset-5" style="margin-bottom: 200px">
                <input class="btn btn-border-d btn-round" type="button" onclick="back()" value="이전 페이지로">

                <script>
                    function back() {
                        location.href = './order_management.php';
                    }
                </script>
            </div>
    </section>

</div>


<?php

// footer 연결
include("../main/footer.php");

?>

</body>
</html>
