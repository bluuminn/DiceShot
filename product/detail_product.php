<?php

include("../main/db_connection.php");

$product_id = $_GET['prod_id'];

$query = "select * from product where id='$product_id'";
$result = mysqli_query($connect, $query);
$product = mysqli_fetch_assoc($result);


//최근 본 상품
//쿠키가 존재할 경우
if (isset($_COOKIE['recent_product'])) {

    //쿠키가 갖고 있는 배열 가져옴
    $array = unserialize($_COOKIE['recent_product']);
    //배열의 크기가 3을 초과할 경우 앞의 3개만 남기고 뒤는 자름
    //ㄴ> 이렇게 자르지 않으면 a,b,c,d가 있을때 중복검사 때문에 d를 봐도 d가 추가되지 않아서 최신에 보이지 않음
    $array_count = count($array);
    if ($array_count >= 3) {
        $temp = array_slice($array, 0, 2); //0번째 인덱스부터 5개만 자름(2번째 인덱스까지)
        $array = $temp;
    }


    // 상품이 배열 안에 없으면
    if (!in_array($product['id'], $array)) {

        //상품의 id가 쿠키에 저장된 배열의 요소가 아니면 해당 배열의 맨 앞에 추가해서 다시 쿠키에 저장해줌
        array_unshift($array, $product['id']);

        //배열을 다시 serialize해줌
        $recent_product_array = serialize($array);

        //동일한 이름을 가진 쿠키에 저장해줌(덮어씌워지는듯)
        setcookie('recent_product', $recent_product_array, time() + 86400, '/');


        // 상품이 배열 안에 있으면
    } else {

        // 배열에서 해당 상품 아이디의 인덱스 값을 찾아서 반환
        $array_index = array_search($product['id'], $array);


        // 해당 인덱스의 값을 삭제
        unset($array[$array_index]);
        $array = array_values($array);
//        array_splice($array, $array_index, 1);

        // 배열의 맨 앞에 추가
        array_unshift($array, $product['id']);

        // 배열을 스트링화 함
        $recent_product_array = serialize($array);

        // 쿠키값 변경
        setcookie('recent_product', $recent_product_array, time() + 86400, '/');
    }


    //쿠키가 존재하지 않을 경우
} else {

    //상품의 id값을 담을 배열 선언
    $today = [];

    //배열에 상품의 id값을 추가해줌
    array_push($today, $product['id']);

    //쿠키에 담기위해서 serialize해줌
    $recent_product_array = serialize($today);

    //배열을 담는 쿠키 생성
    setcookie('recent_product', $recent_product_array, time() + 86400, '/');


}


// header 연결
include("../main/nav_header.php");



?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<style>
    .tab-border-selected {
        border-right: 1px solid #aaaaaa;
        border-top: 1px solid #aaaaaa;
        border-left: 1px solid #aaaaaa;
        color: #111111;
        text-align: center;
        vertical-align: middle;
        text-decoration: none;
        padding: 16px;
        font-size: 16px;
    }

    .tab-border {
        border-bottom: 1px solid #aaaaaa;
        color: #aaaaaa;
        text-align: center;
        vertical-align: middle;
        padding: 16px;
        font-size: 16px;

    }

    .tab-contents-padding {
        padding-top: 100px;
        padding-bottom: 300px;
    }

</style>

<script type="text/javascript">
    function fnMove(seq) {
        var offset = $("#" + seq).offset();
        var winH = $(window).height();
        $('html, body').animate({scrollTop: (offset.top - winH / 4)}, 400);

    }

    function init() {
        sell_price = document.cart.sell_price.value;
        amount = document.cart.amount.value;
        document.cart.sum.value = sell_price;
        change();
    }

    function add() {
        hm = document.cart.amount;
        sum = document.cart.sum;
        hm.value++;

        sum.value = numberWithCommas((hm.value) * sell_price);
    }

    function del() {
        hm = document.cart.amount;
        sum = document.cart.sum;
        if (hm.value > 1) {
            hm.value--;
            sum.value = numberWithCommas((hm.value) * sell_price);
        }
    }

    function change() {
        hm = document.cart.amount;
        sum = document.cart.sum;

        if (hm.value < 0) {
            hm.value = 0;
        }
        sum.value = numberWithCommas((hm.value) * sell_price);
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function add_cart(mem, prod) {
        // var conf = confirm("상품을 추가 하시겠어요?");
        // if (conf) {
        location.href = '../cart/add_cart_process.php?&member_id=' + mem + '&product_id=' + prod + '&amount=' + hm.value;
        // } else {
        //     return;
        // }
    }

</script>


<body onload="init()">

<div class="main">

    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mb-sm-40">
                    <a class="gallery" href="<?= $product['img_path'] ?>">
                        <img src="<?= $product['img_path'] ?>"
                             alt="<?= $product['title'] . '(' . $product['eng_title'] . ')' ?>"/>
                    </a>
                    <!--                    <ul class="product-gallery">-->
                    <!--                        <li><a class="gallery" href="../images/shop/product-8.jpg"></a><img-->
                    <!--                                    src="../images/shop/product-8.jpg" alt="Single Product"/></li>-->
                    <!--                        <li><a class="gallery" href="../images/shop/product-9.jpg"></a><img-->
                    <!--                                    src="../images/shop/product-9.jpg" alt="Single Product"/></li>-->
                    <!--                        <li><a class="gallery" href="../images/shop/product-10.jpg"></a><img-->
                    <!--                                    src="../images/shop/product-10.jpg" alt="Single Product"/></li>-->
                    <!--                    </ul>-->
                </div>

                <div class="col-sm-6">
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-sm-12"
                             style="text-decoration: underline; text-underline-position: under;">
                            <span style="font-weight: 900; font-size: 20px; color: #111;"><?= $product['brand'] ?></span>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-sm-12" style="color: #111; font-size: 30px; font-weight: 200">
                            <?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-sm-12" style="color: #111; font-size: 20px; font-weight: 200">
                            <?= $product['sub_description'] ?>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-sm-12">
                            <div style="font-weight: 500; font-size: 20px; color: #111;">
                                <?= number_format($product['price']) ?>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 0; height: 2px; background: #eeeeee">

                    <style>
                        .product-details {
                            margin-bottom: 15px
                        }
                    </style>

                    <div class="row product-details">
                        <div class="col-sm-3" style="color: gray">
                            게임 인원
                        </div>
                        <div class="col" style="color: #111">
                            <?
                            if ($product['min_people'] != $product['max_people']) {
                                echo $product['min_people'] . '~' . $product['max_people'] . '명';
                            } else {
                                echo $product['max_people'] . '명';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row product-details">
                        <div class="col-sm-3" style="color: gray">
                            난이도
                        </div>
                        <div class="col" style="color: #111">
                            <?= $product['difficulty'] ?>
                        </div>
                    </div>

                    <div class="row product-details">
                        <div class="col-sm-3" style="color: gray">
                            게임 시간
                        </div>
                        <div class="col" style="color: #111">
                            <?= $product['play_time'] ?>
                        </div>
                    </div>

                    <form name="cart" method="post" action="../cart/add_cart_process.php">

                        <div class="row product-details">
                            <div class="col-sm-3" style="color: gray">
                                구매 수량
                            </div>
                            <div class="col" style="color: #111">

                                <input type=hidden name="sell_price" value=<?= $product['price']; ?>>

                                <input class="btn btn-xs btn-border-w" type="button" value="➖" onclick="del();">
                                <input type="text" name="amount" value="1" size="3" onchange="change();"
                                       style="text-align: center" readonly="readonly">
                                <input class="btn btn-xs btn-border-w" type="button" value="➕" onclick="add();">

                            </div>
                        </div>

                        <hr>

                        <div class="row product-details"
                             style="background: #f7f7f7; color: #111; padding: 20px; margin-left: 1px; margin-right: 1px;">
                            <div align="right" style="font-size: 14px; vertical-align: middle;">
                                총 합계 금액

                                <span style="font-weight: 800; font-size: 20px;" align="right">
                                    <input type="text" style="border: none; background: #f7f7f7; text-align: right;"
                                           name="sum" size="10" readonly="readonly">
                                </span>
                            </div>
                        </div>

                        <!--                    <a href="#">-->
                        <!--                        <input class="btn btn-g col-sm-3" style="padding: 20px; font-size: 18px; font-weight: 500"-->
                        <!--                               value="찜하기">-->
                        <!--                    </a>-->

                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <input type="hidden" name="member_uuid" value="<?= $_SESSION['member_uuid']; ?>">

                        <input class="btn btn-g col-sm-6" type="submit"
                               style="padding: 20px; font-size: 18px; font-weight: 500"
                               value="장바구니 담기">
                        <!--                        </a>-->
                        <input class="btn btn-d col-sm-6" type="submit"
                               style="padding: 20px; font-size: 18px; font-weight: bold"
                               value="바로 구매">

                    </form>


                </div>
            </div>
        </div>
    </section>

    <!--    <hr style="margin-top: 100px">-->


    <!--    상품 상세 정보 -->
    <section>
        <div class="container pt-140">

            <!---->
            <!--            <button onclick="fnMove('1')">div1로 이동</button>-->
            <!--            <button onclick="fnMove('2')">div2로 이동</button>-->
            <!--            <button onclick="fnMove('3')">div3로 이동</button>-->
            <!--            <div id="div1" style="padding-bottom: 400px">div1</div>-->
            <!--            <div id="div2" style="padding-bottom: 400px">div2</div>-->
            <!--            <div id="div3" style="padding-bottom: 400px">div3</div>-->


            <!--            <nav class="nav">-->
            <!--                <ul class="nav nav-justified mt-70" style="font-size: 16px; padding-bottom: 10px; padding-top: 10px">-->

            <div class="row">
                <input class="col-sm-4 btn tab-border-selected" type="button" onclick="fnMove('detail')" value="상세정보">
                <input class="col-sm-4 btn tab-border" type="button" onclick="fnMove('reviews')" value="리뷰 ">
                <input class="col-sm-4 btn tab-border" type="button" onclick="fnMove('qna')" value="상품 문의">

            </div>

            <div id="detail" class="tab-contents-padding">
                <?= $product['description'] ?>
            </div>

        </div>
    </section>


    <!--    상품 리뷰-->
    <section>
        <div class="container">

            <div class="row">

                <input class="col-sm-4 btn tab-border" type="button" onclick="fnMove('detail')" value="상세정보">
                <input class="col-sm-4 btn tab-border-selected" type="button" onclick="fnMove('reviews')" value="리뷰 ">
                <input class="col-sm-4 btn tab-border" type="button" onclick="fnMove('qna')" value="상품 문의">

            </div>
            <div id="reviews" class="tab-contents-padding"> 리뷰 테이블 만들어야함</div>

        </div>
    </section>


    <!--    상품 문의-->
    <section>
        <div class="container">

            <div class="row">
                <input class="col-sm-4 btn tab-border" type="button" onclick="fnMove('detail')" value="상세정보">
                <input class="col-sm-4 btn tab-border" type="button" onclick="fnMove('reviews')" value="리뷰 ">
                <input class="col-sm-4 btn tab-border-selected" type="button" onclick="fnMove('qna')" value="상품 문의">
            </div>

            <div id="qna" class="tab-contents-padding"> 상품문의 테이블 만들기

                <section class="module">
                    <div class="container">
                        <div class="row">

                            <div class="col-sm-12">

                                <h4 class="font-alt mb-0">상품 문의</h4>
                                <hr class="divider-w mt-10 mb-20">


                                <table class="table" align=center style="width: 100%;">
                                    <!--                    <thead align="center">-->

                                    <!--                    </thead>-->

                                    <tbody align="center" style="border-bottom: 1px solid #dddddd">
                                    <tr style="background:#f9f9f9">
                                        <th width="60" style="text-align: center">답변상태</th>
                                        <th width="500" style="text-align: center">제목</th>
                                        <th width="100" style="text-align: center">작성자</th>
                                        <th width="100" style="text-align: center">작성일</th>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align: middle">답변완료</td>
                                        <td>
                                            <div class="panel-group" id="accordion">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title font-alt">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                               href="#support1">Support Question 1</a>
                                                        </h4>
                                                    </div>
                                                    <div class="panel-collapse collapse in" id="support1">
                                                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim
                                                            eiusmod high life accusamus terry richardson ad squid. 3
                                                            wolf moon officia aute, non cupidatat skateboard dolor
                                                            brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                            wolf moon tempor, sunt aliqua put a bird on it squid
                                                            single-origin coffee nulla assumenda shoreditch et.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--                                                <div class="panel panel-default">-->
                                                <!--                                                    <div class="panel-heading">-->
                                                <!--                                                        <h4 class="panel-title font-alt"><a class="collapsed"-->
                                                <!--                                                                                            data-toggle="collapse"-->
                                                <!--                                                                                            data-parent="#accordion"-->
                                                <!--                                                                                            href="#support2">Support-->
                                                <!--                                                                Question-->
                                                <!--                                                                2</a></h4>-->
                                                <!--                                                    </div>-->
                                                <!--                                                    <div class="panel-collapse collapse" id="support2">-->
                                                <!--                                                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim-->
                                                <!--                                                            eiusmod-->
                                                <!--                                                            high life accusamus terry richardson ad squid. 3 wolf moon-->
                                                <!--                                                            officia-->
                                                <!--                                                            aute, non cupidatat skateboard dolor brunch. Food truck-->
                                                <!--                                                            quinoa-->
                                                <!--                                                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt-->
                                                <!--                                                            aliqua put-->
                                                <!--                                                            a bird on it squid single-origin coffee nulla assumenda-->
                                                <!--                                                            shoreditch-->
                                                <!--                                                            et.-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                                <!--                                                </div>-->

                                            </div>
                                        </td>
                                        <td style="vertical-align: middle">
                                            com
                                        </td>
                                        <td style="vertical-align: middle">
                                            2019.10.14
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!--                <table class="table table-hover" align=center style="width: 100%;">

                    <tbody align="center" style="border-bottom: 1px solid #dddddd">
                    <tr style="background:#f9f9f9">
                        <th width="60" style="text-align: center">번호</th>
                        <th width="500" style="text-align: center">제목</th>
                        <th width="100" style="text-align: center">작성자</th>
                        <th width="100" style="text-align: center">작성일</th>
                        <th width="100" style="text-align: center">조회수</th>
                    </tr>

                    <?php
                /*
                                    while ($rows = mysqli_fetch_assoc($result)) { //DB에 저장된 데이터 수 (열 기준)

                                        $date = date_create($rows['create_date']);

                                        if ($total % 2 == 0) { */ ?>
                            <tr class="even">
                        <?php /*} else { */ ?>
                            <tr>
                        <?php /*} */ ?>
                        <td><?php /*echo $total */ ?></td>
                        <td align="left">
                            <a style="text-decoration: none; color: #353a3f"
                               href="../board/view_board_details.php?number=<?php /*echo $rows['id'] */ ?>">
                            <?php /*echo $rows['title'] */ ?></td>
                        <td>관리자</td>
                        <td>
                            <?php
                /*
                                            echo
                                            date_format($date, "Y/m/d");

                                            */ ?>
                        </td>
                        <td><?php /*echo $rows['views'] */ ?></td>
                        </tr>

                        <?php /*$total--;
                    } */ ?>
                    </tbody>
                </table>-->

            </div>

        </div>

        <?
        include("../product/recent_product.php");
        ?>
    </section>
</div>


<?php

// footer 연결
include("../main/footer.php");

?>

</body>
</html>
