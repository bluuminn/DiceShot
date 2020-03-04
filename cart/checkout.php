<?php


// header 연결
include("../main/nav_header.php");

//echo $_SESSION['member_uuid'];

$query = "select * from cart where member_uuid='{$_SESSION['member_uuid']}'";
$result = mysqli_query($connect, $query);
if ($result) {
    $total = mysqli_num_rows($result);
//    echo 'total : ' . $total;
}
$total_price = 0;
$shipping = 0;

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<!-- 장바구니 관련 -->
<script type="text/javascript" language="JavaScript">


    //document.forms는 현재 document에 존재하는 <form> element 들이 담긴 collection (an HTMLCollection)을 반환합니다.
    //-------------------------------------
    // document.form은 HTML에서 form안의 element를 name기반으로 찾아가고
    // document.getElementById는 HTML안의 모든 element를 id기반으로 찾아갑니다.
    // ==================================
    // <form name=xxx>
    // <input name="aaa" ...>
    // </form>
    // ==================================
    // <input id="aaa" ...>
    // ==================================
    // 전,후자 로aaa의 element를 찾아가는조건입니다.
    //-------------------------------------


    function init() {
        var obj = document.getElementsByName("chk[]");
        for (var i = 0; i < obj.length; i++) obj[i].checked = true;
    }

    function del_confirm(id) {
        var conf = confirm("해당 상품을 삭제하시겠어요?");
        if (conf) {

            post_to_url('./del_cart_process.php', {'delete_no': id});

            // document.location.href = './del_cart_process.php?&id=' + id;
        } else {
            return;
        }
    }

    function del_checked_confirm() {

        var checkboxes = document.getElementsByName("chk[]");
        var tmp = '';
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                tmp = tmp.concat(checkboxes[i].value, '/');
            }
        }

        tmp = tmp.slice(0, -1);

        var conf = confirm("선택한 상품을 삭제하시겠어요?");
        if (conf) {

            post_to_url('./del_cart_process.php', {'delete_nums': tmp});

        } else {
            return;
        }
    }

    function chkBox(bool) { // 전체선택/해제
        var obj = document.getElementsByName("chk[]");
        for (var i = 0; i < obj.length; i++) obj[i].checked = bool;
    }

    function revBox() { // 전체반전
        var obj = document.getElementsByName("chk[]");
        for (var i = 0; i < obj.length; i++) obj[i].checked = !obj[i].checked;
    }

    function order() {
        var checkboxes = document.getElementsByName("chk[]");
        var tmp = '';
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                tmp = tmp.concat(checkboxes[i].value, '/');
            }
        }

        tmp = tmp.slice(0, -1);

        // document.location.href='../order/order.php';
        // document.order.value = tmp;
        // document.checkoutform.action = '../order/order.php?order=' + tmp;
        post_to_url('../order/order.php', {'order_no': tmp});
    }

    function post_to_url(path, params, method) {
        method = method || "post"; // Set method to post by default, if not specified.
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form1 = document.createElement("form");
        form1.setAttribute("method", method);
        form1.setAttribute("action", path);
        for (var key in params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form1.appendChild(hiddenField);
        }
        document.body.appendChild(form1);
        form1.submit();
    }

</script>

<body onload="init()">

<div class="main">
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 align="center" style="font-weight: bold; color: #000">장바구니</h1>
                    <h4 align="center" style="margin-bottom: 80px">주문하실 상품명 및 수량을 정확하게 확인해주세요.</h4>
                </div>
            </div>
            <!--            <hr class="divider-w pt-20">-->

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-border">
                        <tbody>
                        <tr style="text-align: center; background: #f9f9f9;">


                            <td width="60">
                                <label>
                                    <input type="checkbox" checked onclick=chkBox(this.checked)>
                                </label>
                            </td>
                            <td width="60"></td>
                            <td width="400">상품 정보</td>
                            <td width="150">수량</td>
                            <td width="150">상품금액</td>
                            <td width="60"></td>
                        </tr>


                        <?

                        if (isset($_SESSION['member_uuid'])) {

                            if ($total > 0) {

                                while ($member_cart_list = mysqli_fetch_assoc($result)) {

                                    $get_prod_query = "select * from product where id='{$member_cart_list['product_id']}'";
                                    $get_prod_result = mysqli_query($connect, $get_prod_query);
                                    $prod_info = mysqli_fetch_assoc($get_prod_result);

                                    $total_price += $prod_info['price'] * $member_cart_list['amount'];


                                    ?>


                                    <tr style="text-align: center">

                                        <td style="vertical-align: middle">
                                            <input type="checkbox" name="chk[]"
                                                   value="<?= $member_cart_list['id'] ?>">
                                        </td>

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
                                            <!--                                            <input type=hidden name="sell_price" value=--><?//= $prod_info['price'] * $member_cart_list['amount'] ?>
                                            <input type=hidden name="sell_price" value=<?= $prod_info['price'] ?>>

                                            <!--                                            <input type="button" value=" - " onclick="del();">-->
                                            <!--                                            <input type="text" name="amount" value="1" size="3" onchange="change();"-->
                                            <!--                                                   style="text-align: center" readonly="readonly">-->
                                            <!--                                            <input type="button" value=" + " onclick="add();">-->


                                            <form method="post" action="./cart_amount_update.php">
                                                <input type="text" id="amount" name="amount"
                                                       value="<?= $member_cart_list['amount']; ?>"
                                                       size="3" style="text-align: center">
                                                <input type="hidden" id="cartid" name="cart_id"
                                                       value="<?= $member_cart_list['id']; ?>">
                                                <input class="btn btn-xs btn-border-bk btn-round"
                                                       type="submit" value="변경">
                                            </form>


                                        </td>
                                        <td style="vertical-align: middle">
                                            <?= number_format($prod_info['price'] * $member_cart_list['amount']) ?>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <input type="button" style="border: none; background: none" value="❌"
                                                   onclick="del_confirm(<?= $member_cart_list['id'] ?>)">
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
                            } else { ?>

                                <td colspan="6"
                                    style="font-size: 20px; color: #333; text-align: center; padding: 100px">
                                    장바구니가 비었습니다.
                                </td>


                            <? }

                            // 세션 없을 때 > 비회원
                        } else {

                            if (isset($_COOKIE['temp_cart'])) {
                                $temp_cart_array = unserialize($_COOKIE['temp_cart']);


                                for ($i = 0; $i < sizeof($temp_cart_array); $i++) {
                                    $split_info = explode('/', $temp_cart_array[$i]);

                                    $get_prod_query = "select * from product where id={$split_info[0]}";
                                    $get_prod_result = mysqli_query($connect, $get_prod_query);
                                    $product = mysqli_fetch_assoc($get_prod_result);

                                    $total_price += $product['price'] * $split_info[1];

                                    ?>

                                    <tr style="text-align: center">

                                        <td style="vertical-align: middle">
                                            <input type="checkbox" name="chk[]"
                                                   value="<?= $i ?>">
                                        </td>

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
                                            <!--                                            <input type=hidden name="sell_price" value=--><?//= $prod_info['price'] * $member_cart_list['amount'] ?>
                                            <input type=hidden name="sell_price" value=<?= $product['price'] ?>>

                                            <!--                                            <input type="button" value=" - " onclick="del();">-->
                                            <!--                                            <input type="text" name="amount" value="1" size="3" onchange="change();"-->
                                            <!--                                                   style="text-align: center" readonly="readonly">-->
                                            <!--                                            <input type="button" value=" + " onclick="add();">-->


                                            <form method="post" action="./cart_amount_update.php">
                                                <input type="text" id="amount" name="amount"
                                                       value="<?= $split_info[1]; ?>"
                                                       size="3" style="text-align: center">
                                                <input type="hidden" id="cartid" name="cart_id"
                                                       value="<?= $i; ?>">
                                                <input class="btn btn-xs btn-border-bk btn-round"
                                                       type="submit" value="변경">
                                            </form>


                                        </td>
                                        <td style="vertical-align: middle">
                                            <?= number_format($product['price'] * $split_info[1]) ?>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <input type="button" style="border: none; background: none" value="❌"
                                                   onclick="del_confirm(<?= $i ?>)">
                                        </td>
                                        <!--                                        <td class="pr-remove" style="vertical-align: middle">-->
                                        <!--                                            <a href="#" title="Remove">-->
                                        <!--                                                <i class="fa fa-times"></i>-->
                                        <!--                                            </a>-->
                                        <!--                                        </td>-->
                                    </tr>

                                    <?
                                }


                                if ($total_price < 30000) {
                                    $shipping = 2500;
                                }

                            } else { ?>

                                <td colspan="6"
                                    style="font-size: 20px; color: #333; text-align: center; padding: 100px">
                                    장바구니가 비었습니다.
                                </td>

                                <?
                            }

                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row mt-70">
                <div>
                    <input class="btn btn-border-d btn-round" type="button" onclick="del_checked_confirm()"
                           value="선택상품 삭제">
                </div>
                <div class="col-sm-5 col-sm-offset-7">
                    <div class="shop-Cart-totalbox">
                        <!--                        <h4 class="font-alt">Cart Totals</h4>-->
                        <table class="table table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>상품 금액</th>
                                <td>
                                    <?= number_format($total_price) ?>
                                </td>
                            </tr>
                            <tr>
                                <th>배송비<? /*if ($shipping > 0) {
                                        echo number_format(30000) . '원 이상 무료 배송!';
                                    }*/ ?> </th>
                                <td><?= $shipping; ?></td>
                            </tr>
                            <tr class="shop-Cart-totalprice">
                                <th>합계</th>
                                <td><?= number_format($total_price + $shipping) ?></td>
                            </tr>
                            </tbody>
                        </table>

                        <!--주문할때 필요한 정보
                        1. 회원 uuid
                        2. 각 상품 정보
                        3. 각 상품 수량-->
                        <!--                        <form name="checkoutform" method="post">-->
                        <button class="btn btn-lg btn-block btn-round btn-d" onclick="order()" type="submit"
                                style="font-weight: bold; font-size: 14px">주문하기
                        </button>
                        <!--                        </form>-->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php

// footer 연결
include("../main/footer.php");

?>

</body>
</html>