<?php
include("../main/nav_header.php");

$keyword = $_GET['keyword'];
?>


<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>

<div class="main">
    <section class="module bg-dark-60 shop-page-header" data-background="../images/diceshot/products/play_weykick.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt"><? echo "'" . $keyword . "'" . ' 검색 결과' ?></h2>

                </div>
            </div>
        </div>
    </section>

    <!--    <hr class="divider-w" style="margin-top: 30px">-->

    <?
    $query = "select * from product where title like '%$keyword%' or eng_title like '%$keyword%' order by id desc";
    //    $query = mysqli_query("select * from product where title like '%$keyword%' order by id desc");
    $result = mysqli_query($connect, $query);
    $total = mysqli_num_rows($result);

    ?>

    <section class="module-small">
        <div class="container">
            총 <?= $total ?>개의 상품
        </div>
    </section>


    <section class="module-small">
        <div class="container">
                <? while ($product = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-sm-3">
                        <div class="shop-item">
                            <div class="shop-item-image">
                                <img src="<?= $product['img_path'] ?>"
                                     alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"/>

                                <form name="cart" method="post" action="../cart/add_cart_process.php">
                                    <div class="shop-item-detail">

                                        <button class="btn btn-round btn-b" style="margin-top: 10px"> 카트 담기
                                        </button>
                                        <input type="hidden" name="member_uuid"
                                               value="<?= $_SESSION['member_uuid']; ?>">
                                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                        <input type="hidden" name="amount" value="<?= 1 ?>">

                                        <a class="btn btn-round btn-b"
                                           href="../product/detail_product.php?prod_id=<?= $product['id'] ?>"
                                           style="margin-top: 10px">
                                            상세 보기
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <h4 class="shop-item-title font-alt"><a
                                        href="#"><?= $product['title'] . ' (' . $product['eng_title'] . ')' ?></a>
                            </h4>
                            <?= '₩' . number_format($product['price']) ?>
                        </div>
                    </div>
                <? } ?>
        </div>
    </section>


    <?php

    // footer 연결
    include("../main/footer.php");


    ?>


</body>
</html>