<?php

include("../main/db_connection.php");

if (isset($_COOKIE['recent_product'])) {
    $recent_product_array = unserialize($_COOKIE['recent_product']);

}

//var_dump($recent_product_array);


?>


<html>

<style>


    #wrap {
        text-align: left;
        margin: 0 auto;
        width: 600px;
    }

    #slidemenu {
        position: fixed;
        width: 100px;
        /*border: 1px solid #111111;*/
        top: 35%;
        right: 30px;
    }

</style>

<script type="text/javascript">
    $(document).ready(function () {
        var currentPosition = parseInt($("#slidemenu").css("top"));
        $(window).scroll(function () {
            var position = $(window).scrollTop(); // 현재 스크롤바의 위치값을 반환합니다.
            $("#slidemenu").stop().animate({"top": position + currentPosition + "px"}, 1000);
        });
    });
</script>

<body>
<div id="slidemenu">
    <div style="margin-bottom: 10px; text-align: center">
        최근 본 상품
    </div>
    <ul class="list-group">

        <?
        if (isset($_COOKIE['recent_product'])) {

            for ($i = 0; $i < sizeof($recent_product_array); $i++) {
                $get_prod_query = "select * from product where id='$recent_product_array[$i]'";
                $get_prod_result = mysqli_query($connect, $get_prod_query);
                $product = mysqli_fetch_assoc($get_prod_result);
                ?>

                <li class="list-group-item" style="text-align: center">
                    <a href="../product/detail_product.php?prod_id=<?= $product['id']; ?>">
                        <img src="<?= $product['img_path']; ?>"> <?= $product['title']; ?> </a>
                </li>

                <?
            }
        } else { ?>
            <li class="list-group-item" style="text-align: center">
                최근 본<br>상품이<br>없습니다.
            </li>
            <?
        }

        ?>


    </ul>
</div>

</body>
</html>
