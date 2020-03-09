<?php


// header 연결
include("../main/nav_header.php");

$query = "select id from order_info order by order_date desc";
$result = mysqli_query($connect, $query);
if ($result) {
    $total = mysqli_num_rows($result);
}

$page = ($_GET['page']) ? $_GET['page'] : 1;

$LIST_SIZE = 10;
$BLOCK_SIZE = 5;

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

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<style>
    .scale {
        transform: scale(1);
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transition: all 0.2s ease-in-out; /* 부드러운 모션을 위해 추가*/
    }

    .scale:hover {
        transform: scale(3);
        -webkit-transform: scale(3);
        -moz-transform: scale(3);
        -ms-transform: scale(3);
        -o-transform: scale(3);
    }

    .order_table {
        margin-bottom: 10px;
    }

    .order_button {
        padding: 5px 10px;
        font-size: 14px;
    }

    .order_header {
        font-weight: 500;
        font-size: 18px;
    }

    .order_content {
        font-size: 18px;
    }

</style>

<script type="text/javascript">
    function del_confirm(id) {
        var conf = confirm("상품을 삭제하면 되돌릴 수 없어요. 정말 삭제하시겠어요?");
        if (conf) {
            document.location.href = 'delete_process.php?&id=' + id;
        } else {
            return;
        }
    }


</script>

<body>

<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 style="text-align: center; color: #111111">주문 관리</h2>

            </div>
        </div>
    </section>


    <section>
        <div class="col-lg-3" style="margin-left: 50px; margin-top: 60px; max-width: 180px; position: fixed">
            <div class="list-group">
                <a href="product_management.php" class="list-group-item">상품 관리</a>
                <a href="order_management.php" class="list-group-item active">주문 관리</a>
                <!--                <a href="member_management.php" class="list-group-item">회원 관리</a>-->
            </div>
        </div>
        <div class="container">
            <a href="form_register_product.php" style="float: right; margin-bottom: 20px">
                <input class="btn btn-d btn-round" type="button" value="상품 등록">
            </a>
            <table class="table table-border">
                <tbody>
                <tr style="text-align: center; background: #f9f9f9;">
                    <td width="30"><input type="checkbox"></td>
                    <td width="80">주문번호</td>
                    <td width="80">주문일자</td>
                    <td width="200">주문상품정보</td>
                    <td width="100">결제금액</td>
                    <td width="100">주문상태</td>
                    <td width="60">출고상태</td>
                </tr>

                <?

                $start_point = ($page - 1) * $LIST_SIZE;
                $get_show_data_query = "select * from order_info order by order_no desc limit {$start_point}, {$LIST_SIZE}";
                $get_show_data_result = mysqli_query($connect, $get_show_data_query);

                if ($get_show_data_result) {
                    $total = mysqli_num_rows($get_show_data_result);
                }

                if ($total > 0) {
                    while ($order = mysqli_fetch_assoc($get_show_data_result)) {

                        $total_price = 0;
                        $payment_amount = 0;

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
                                    $payment_amount = $product['price'] * $product_id['amount'];
                                    $total_price += $payment_amount;
                                }
                            }
                        }

                        ?>
                        <tr style="text-align: center;">

                            <!--                    체크박스-->
                            <td style="vertical-align: middle"><input type="checkbox"></td>


                            <!--                    대표이미지-->

                            <!--

                            <td width="30"><input type="checkbox"></td>
                            <td width="100">주문번호</td>
                            <td width="100">주문시간</td>
                            <td width="60"></td>
                            <td width="100">주문상품정보</td>
                            <td width="100">결제금액</td>
                            <td width="100">주문상태</td>
                            <td width="60">관리</td>

                             -->
                            <td style="vertical-align: middle">
                                <a href="./order_info_detail.php?order_no=<?= $order['order_no'] ?>">
                                    <?= $order['order_no']; ?>
                                </a>
                            </td>

                            <td style="vertical-align: middle">

                                <?
                                $date = date_create($order['order_date']);
                                echo date_format($date, "Y/m/d");
                                ?>

                            </td>

                            <td style="text-align: left; vertical-align: middle">
                                <img src="<?= $product['img_path'] ?>"
                                     alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"
                                     style="width: 60px; height: auto;">
                                <?
                                if ((int)$product_cnt <= 1) {
                                    echo $product['title'];
                                } else {
                                    echo $product['title'] . ' 외 ' . ((int)$product_cnt - 1) . '건';
                                }
                                ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?
                                // 총 가격이 3만원 미만이면 배송비 2500원 추가
                                if ($total_price < 30000) {
                                    $shipping = 2500;
                                } else {
                                    $shipping = 0;
                                }
                                echo number_format($total_price + $shipping);
                                ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?= $order['progress_status'] ?>
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

                                <!-- Modal -->
                                <div class="modal fade" id="insertBlack" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 id="myModalLabel">송장을 입력해주세요.</h4>
                                            </div>

                                            <div class="modal-body">
                                                <input class="form-control" type="text" id="post_number">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-default"
                                                        data-dismiss="modal"
                                                        onclick="delete_contents();">닫기
                                                </button>
                                                <button type="button" class="btn btn-round btn-success"
                                                        data-dismiss="modal"
                                                        onclick="insertPost();">확인
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </td>

                        </tr>
                    <? }
                } else { ?>

                    <td colspan="11" style="font-size: 20px; color: #333; text-align: center; padding: 100px">
                        등록된 상품이 없어요.<br>
                        상품을 등록해주세요!
                    </td>

                <? } ?>

                </tbody>
            </table>
        </div>


        <script>

            let order_id = "aa";

            function order(number) {
                order_id = number;
            }

            // var NOTIFYID="";
            // var NONNOTIFYID="";
            // var NCONTENT="";


            // $(document).ready(function() {
            //     $('#insertBlack').on('show.bs.modal', function(event) {
            //         NOTIFYID = $(event.relatedTarget).data('notifyid');
            //         NONNOTIFYID = $(event.relatedTarget).data('nonnotifyid');
            //         NCONTENT = $(event.relatedTarget).data('ncontent');
            //     });
            // });


            function insertPost() {

                //order_info index
                let order_info_id = order_id;
                //input value
                let invoice = $('#post_number').val();

                //form이 없으므로 여기서 생성해줌
                let form = document.createElement("form");
                form.setAttribute("charset", "UTF-8");
                form.setAttribute("method", "Post"); // Get 또는 Post 입력
                form.setAttribute("action", "./update_invoice.php");

                //같이 보낼 필드 생성하고 값 넣어줌
                //id문자열 넣을 필드
                let hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", "order_info_id");
                hiddenField.setAttribute("value", order_info_id);
                form.appendChild(hiddenField);

                // 같이 보낼 필드 생성하고 값 넣어줌
                // id 문자열 넣을 필드
                let hiddenField2 = document.createElement("input");
                hiddenField2.setAttribute("type", "hidden");
                hiddenField2.setAttribute("name", "invoice");
                hiddenField2.setAttribute("value", invoice);
                form.appendChild(hiddenField2);

                //html의 body에 붙여주는 듯
                document.body.appendChild(form);

                //submit
                form.submit();


                //input 초기화
                $('#post_number').val("");
            }

            function delete_contents() {
                //input 초기화
                $('#post_number').val("");
            }

        </script>


        <div class="container">
            <table style="margin-left: auto; margin-right: auto">
                <tbody>
                <tr>
                    <td>
                        <ul class="pagination" style="margin-top: 140px;">
                            <?
                            if ($now_block > 1) { ?>
                                <li class="page-item">
                                    <a class="page-link"
                                       href="<?= $_SERVER['PHP_SELF'] ?>?page=1">처음</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                       href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $start_page - 1 ?>">이전</a>
                                </li>
                            <? } else { ?>
                                <!--                                    <li class="page-item">-->
                                <!--                                        <a class="page-link">처음</a>-->
                                <!--                                    </li>-->
                                <!--                                    <li class="page-item">-->
                                <!--                                        <a class="page-link">이전</a>-->
                                <!--                                    </li>-->
                                <?
                            }
                            for ($p = $start_page; $p <= $end_page; $p++) {
                                if ($p == $page) {
                                    ?>
                                    <li class="page-item active">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $p ?>"><?= $p ?></a>
                                    </li>
                                <? } else { ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $p ?>"><?= $p ?></a>
                                    </li>
                                    <?
                                }
                            }

                            // 총 블럭(1~5/6~10/11~15 ..)수가 현재 블럭 수보다 작을 경우
                            if ($now_block < $total_block) { ?>
                                <li class="page-item">
                                    <a class="page-link"
                                       href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $end_page + 1 ?>">다음</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                       href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $total_page ?>">마지막</a>
                                </li>

                            <? } else { ?>
                                <!--                                    <li class="page-item">-->
                                <!--                                        <a class="page-link">다음</a>-->
                                <!--                                    </li>-->
                                <!--                                    <li class="page-item">-->
                                <!--                                        <a class="page-link">마지막</a>-->
                                <!--                                    </li>-->
                            <? } ?>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
// footer 연결
include("../main/footer.php");
?>
</body>
</html>
