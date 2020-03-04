<?php

// db 연결
include("../main/nav_header.php");


$title = $_GET['title'];
$normal_price = $_GET['normal_price'];
$discount_price = $_GET['discount_price'];
$game_main_image = null;

if ($title == 'rummikub') {
    $title = '루미큐브 (Rummikub)';
    $game_main_image = '../images/products/rummikub_classic.jpg';
} elseif($title == 'skullking'){
    $title = '스컬킹 (Skull King)';
    $game_main_image = '../images/products/skullking.png';

} elseif($title == 'drecksau'){
    $title = '드렉사우 (Drecksau)';
    $game_main_image = '../images/products/drecksau.png';

} elseif($title == 'davinci_code'){
    $title = '다빈치코드 (Davinci Code)';
    $game_main_image = '../images/products/davincicode.png';

}

?>


<!DOCTYPE html>
<html lang="en">

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield; /* Firefox */
    }
</style>

<body>
<div class="container">
    <ul class="nav nav-justified" style="font-size: 16px; padding-bottom: 10px; padding-top: 10px">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span style="color: #696969;">전체</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span style="color: #696969;">신상품</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span style="color: #696969;">인기</span></a>
        </li>
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="#">-->
        <!--                <span style="color: #696969;">할인</span></a>-->
        <!--        </li>-->
        <li class="nav-item">
            <!--            <a class="nav-link" href="#">-->
            <!--                <span style="color: #696969;">검색</span></a>-->

            <!--            <form class="form-inline" action="">-->
            <!--                <input class="form-control" type="text" placeholder="검색어를 입력하세요.">-->
            <!--                <input class="btn btn-primary" value="검색" type="submit">-->
            <!--            </form>-->
            <form class="form-inline">
                <input class="form-control" type="text" placeholder="검색어를 입력하세요." style="font-size: 14px"/>
                <button class="btn btn-sm btn-outline-primary" type="submit" style="font-size: 14px; margin-left: 10px">
                    검색
                </button>
            </form>

        </li>
    </ul>
</div>


<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-6">
            <img src=<? echo $game_main_image?>>

        </div>
        <div class="col-md-6">
            <h3>
                <?php
                echo $title;
                ?>
<!--                루미큐브 클래식 (Rummikub Classic)-->
            </h3>
            <small>세 번째로 가장 많이 팔리는 세계적인 베스트셀러</small><br>
            <span class="badge badge-warning">Hot!</span>
            <hr>


            <div class="row">
                <div class="col-sm-3" style="color: gray;">
                    정상가
                </div>
                <div class="col" style="text-decoration: line-through">
                    <?php
                    echo number_format($normal_price);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    판매가
                </div>
                <div class="col">
                    <h5>
                        <?php
                        echo number_format($discount_price);
                        ?>
                    </h5>
                </div>
            </div>

            <br style="padding-top: 10px">

            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    게임인원
                </div>
                <div class="col">
                    2명 ~ 4명
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    대상연령
                </div>
                <div class="col">
                    만 8세 이상
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    게임시간
                </div>
                <div class="col">
                    60분
                </div>
            </div>

            <br style="padding-top: 10px">

            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    장르
                </div>
                <div class="col">
                    가족게임
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    브랜드
                </div>
                <div class="col">
                    코리아보드게임즈
                </div>
            </div>

            <br style="padding-top: 10px">


            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    주문 수량
                </div>
                <div class="col" style="color: gray">

                    <form class="form-inline">
                        <button class="btn btn-sm btn-outline-light" type="submit" style="text-align: center">
                            ➖
                        </button>
                        <input class="form-control form-control-sm" type="number" min="1" max="99" name="order_count"
                               id="order_count" style="font-size: 14px"/>
                        <button class="btn btn-sm btn-outline-light" type="submit" style="text-align: center;">
                            ➕
                        </button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3" style="color: gray">
                    브랜드
                </div>
                <div class="col">
                    코리아보드게임즈
                </div>
            </div>

        </div>
    </div>
</div>
<hr>


</body>
</html>