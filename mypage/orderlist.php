<?php


// header 연결
include("../main/nav_header.php");

$cs_no = $_GET['cs_no'];

if (isset($_SESSION['member_uuid'])) {

} else {
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='../member/sign_in.php';</script>";
}

// 로그인 멤버의 주문 내역 가져오는 쿼리
$query = "select * from order_info where purchaser_uuid='{$_SESSION['member_uuid']}' order by order_date desc";
$result = mysqli_query($connect, $query);

if ($result) {
    // 주문 내역 개수 출력
    $total = mysqli_num_rows($result);
}

$page = ($_GET['page']) ? $_GET['page'] : 1;

$LIST_SIZE = 5;
$BLOCK_SIZE = 10;

$total_page = ceil($total / $LIST_SIZE);
$total_block = ceil($total_page / $BLOCK_SIZE);
$now_block = ceil($page / $BLOCK_SIZE);

$start_page = ($now_block * $BLOCK_SIZE) - ($BLOCK_SIZE - 1);
if ($start_page <= 1) {
    $start_page = 1;
}

$end_page = $now_block * $BLOCK_SIZE;
if ($total_page <= $end_page) {
    $end_page = $total_page;
}


//for ($i = 1; $i <= 100; $i++) {
//    $add_query = "insert into order_info(order_no, purchaser_uuid, order_date, payment_info, zipcode, addr1, addr2, recipient_name, recipient_contact)";
//
//    $order_count = sprintf('%06d', ($i * 100));
//    $order_no = date("Ymd") . '-' . $order_count;
//    $recipient_name = '팀노바 ' . $i;
//    $zipcode = sprintf('%05d', $i);
//    $addr2 = '동작구 ' . $i;
//    $contact_last = sprintf('%04d', $i);
//    $contact = '010-0000-' . $contact_last;
//    $add_query .= " values('{$order_no}', '{$_SESSION['member_uuid']}', now(), '카카오페이', '{$zipcode}', '서울특별시', '{$addr2}', '{$recipient_name}', '{$contact}')";
//    $add_result = mysqli_query($connect, $add_query);
//
//    if (!$add_result) {
//        echo $i . '번째 추가 명령 에러 : ';
//        echo mysqli_error($connect) . "<br>";
//    } else {
//
//        for ($j = 1; $j <= 3; $j++) {
//            $add_ordered_product = "insert into ordered_product(order_no, product_id, amount)";
//
//            $tmp_prod_id = 28 + $j;
//            $add_ordered_product .= " values('{$order_no}', '{$tmp_prod_id}', 1)";
//            $add_ordered_product_result = mysqli_query($connect, $add_ordered_product);
//
//            if (!$add_ordered_product_result) {
//
//                echo $j . '번째 주문 상품 추가 명령 에러 : ';
//                echo mysqli_error($connect) . "<br>";
//            }
//        }
//
//    }
//}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<style>
    .order_table {
        margin-bottom: 10px;
    }

    .order_button {
        padding: 5px 10px;
    }

    .order_header {
        font-weight: 500;
        font-size: 18px;
    }

    .order_content {
        font-size: 18px;
    }

</style>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">

    function change_status() {
        //TODO: 컨펌창 띄워서 구매 확정 여부 물어보기
        // 1. 구매확정: progress_status 배송중 > 배송완료 수정
        // 2. 취소: 돌아가기
        // 3. 예외: 7일 지나면 자동으로 배송완료로 수정하기 (이건 보류)

        // order_no = order_no.stringify(order_no);
        alert("order_no: " + order_no);
        var conf = confirm("상품을 수령하셨나요? 구매확정 처리 하시겠어요?");
        if (conf) {
            alert('confirm ck');
            post_to_url('./change_delivery_status.php', {"order_no": order_no});

        } else {
            return;
        }

    }

    function post_to_url(path, params, method) {
        method = method || "post"; // Set method to post by default, if not specified.
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);


        for (var key in params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }

        document.body.appendChild(form);
        form.submit();
    }

</script>

<body>

<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 style="text-align: center; color: #111111">주문내역</h2>
                <div class="module-subtitle">
                    주문 내역 조회가 가능합니다.
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="col-lg-3" style="margin-left: 50px; max-width: 180px; position: fixed">
            <div class="list-group pt-60">
                <a href="orderlist.php"
                   class="list-group-item active">주문 내역</a>
                <a href="wishlist.php" class="list-group-item">
                    관심 상품
                </a>
                <a href="modify_info.php" class="list-group-item">
                    내 정보 수정
                </a>
            </div>
        </div>


        <div class="container">

            <?php

            $start_point = ($page - 1) * $LIST_SIZE;
            $get_show_data_query = "select * from order_info where purchaser_uuid='{$_SESSION['member_uuid']}' order by order_date desc limit {$start_point}, {$LIST_SIZE}";
            $get_show_data_result = mysqli_query($connect, $get_show_data_query);


            if ($total > 0) {

                //DB에 저장된 데이터 수 (열 기준)
                while ($order = mysqli_fetch_assoc($get_show_data_result)) {
                    $total_price = 0;

                    // 주문번호로 주문상품테이블에서 상품리스트를 가져옴
                    $get_product_list_query = "select * from ordered_product where order_no='{$order['order_no']}' order by id desc";
                    $get_product_list_result = mysqli_query($connect, $get_product_list_query);

                    // 주문 번호별 주문 상품 개수
                    $product_cnt = mysqli_num_rows($get_product_list_result);


                    // 주문번호로 주문상품테이블에서 상품리스트를 잘 가져왔으면...
                    if ($get_product_list_result) {

                        // 상품 아이디를 담아서 반복
                        while ($product_id = mysqli_fetch_assoc($get_product_list_result)) {
                            // 상품 아이디로 상품 정보 가져옴
                            $get_product_query = "select * from product where id='{$product_id['product_id']}'";
                            $get_product_result = mysqli_query($connect, $get_product_query);

                            // 상품 가져오는 쿼리 성공하면
                            if ($get_product_result) {
                                $product = mysqli_fetch_assoc($get_product_result);
                                $total_price += $product['price'];
                            }
                        }

                        if ($total_price < 30000) {
                            $shipping = 2500;
                        } else {
                            $shipping = 0;
                        }
                        ?>

                        <div style="font-size: 24px; margin: 8px; color: #111111">
                            <?
                            $date = date_create($order['order_date']);
                            echo date_format($date, "Y/m/d");
                            ?>
                        </div>

                        <div style="border-width:1px; padding:10px 20px; margin-bottom: 50px; border: 1px solid #dddddd">

                            <a href="./view_order_detail.php?order_no=<?= $order['order_no'] ?>">

                                <div class="col-sm-12">

                                    <h4 style="padding-bottom: 5px">
                                        <?
                                        if ((int)$product_cnt <= 1) {
                                            echo $product['title'];
                                        } else {
                                            echo $product['title'] . ' 외 ' . ((int)$product_cnt - 1) . '건';
                                        }
                                        ?>

                                    </h4>

                                </div>
                            </a>

                            <hr style="border: 0.5px solid #dddddd">


                            <table>
                                <tbody>
                                <tr>
                                    <td width="15%" style="padding-right: 20px; padding-right: 20px">
                                        <img src="<?= $product['img_path'] ?>"
                                             alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"
                                             style="width: auto; height: auto;">
                                    </td>
                                    <td width="70%">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td width="200" class="order_header" style="padding-bottom: 10px;">
                                                    주문번호
                                                </td>
                                                <td width="1000" class="order_content" style="padding-bottom: 10px">
                                                    <?= $order['order_no'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="order_header" style="padding-bottom: 10px">
                                                    결제금액
                                                </td>
                                                <td width="1000" class="order_content" style="padding-bottom: 10px">
                                                    <?= number_format($total_price + $shipping) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="order_header">
                                                    주문상태
                                                </td>
                                                <td width="1000" class="order_content">
                                                    <?= $order['progress_status'] ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                    <td width="10%">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>

                                                    <? if ($order['progress_status'] == '배송중' || $order['progress_status'] == '결제완료') { ?>

                                                    <? } elseif (!$order['is_review'] && $order['progress_status'] == '구매확정') { ?>
                                                        <input class="btn btn-success btn-round order_button"
                                                               size="10" value="리뷰 작성" style="margin-bottom: 5px">

                                                    <? } else { ?>
                                                        <input class="btn btn-border-d btn-round order_button"
                                                               size="10" value="리뷰 보기" style="margin-bottom: 5px">
                                                    <? } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="btn btn-border-bk btn-round order_button"
                                                           size="10" value="1:1 문의" style="margin-bottom: 5px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <? if ($order['progress_status'] == '배송중') { ?>
                                                        <input class="btn btn-primary btn-round order_button"
                                                               size="10" value="구매확정"
                                                               onclick="change_status()">
                                                    <? } ?>
                                                    <script>
                                                        var order_no = "<?= $order['order_no'] ?>";
                                                        // alert('test: ' + test)
                                                    </script>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?
                    }
                }

            } else { ?>

                <div class="module-subtitle pt-140" style="font-size: 25px">
                    주문 내역이 없습니다.
                </div>

            <? } ?>


            <!--    <a class="btn btn-default pull-right">글작성</a>-->

            <div class="container">
                <table style="margin-left: auto; margin-right: auto">
                    <tbody>
                    <tr>
                        <td>
                            <ul class="pagination" style="margin-top: 140px;">
                                <?
                                if ($now_block > 1) {
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $start_page - 1 ?>">이전</a>
                                    </li>
                                    <?
                                }
                                for ($p = $start_page; $p <= $end_page; $p++) {
                                    if ($p == $page) {
                                        ?>
                                        <li class="page-item active">
                                            <a class="page-link"
                                               href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                    <? } else { ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                               href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                        <?
                                    }
                                }

                                if ($now_block < $total_block) { ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $end_page + 1 ?>">다음</a>
                                    </li>
                                <? } ?>
                            </ul>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!--<div class="col" style="text-align: center; margin-top: 40px;">
    <h4 class="col">공지사항</h4>
    <small class="col">다이스샷의 새로운 소식들과 유용한 정보들을 한곳에서 확인하세요.</small>
    <br><br><br><br>
</div>-->


<?php
// footer 연결
include("../main/footer.php");
?>

</body>
</html>
