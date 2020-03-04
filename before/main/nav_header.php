<?php

session_start();

// db 연결
include("../main/db_connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dice Shot</title>

    <!--     Bootstrap core CSS -->
        <link href="../bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="../bootstrap/vendor/bootstrap/css/litera_bootstrap.min.css" rel="stylesheet">-->

    <!--     Custom styles for this template -->
    <link href="../bootstrap/css/modern-business.css" rel="stylesheet">


</head>

<body>

<nav class="navbar fixed-top navbar-expand-xl navbar-light bg-white fixed-top">
    <!--<nav class="navbar fixed-top navbar-light bg-white fixed-top">-->
    <div class="container">

        <a class="navbar-brand" href="../main/index.php">
            <img src="../images/icons/logo.png" alt="Dice Shot" style="width: 200px; height: auto"></a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--        <div class="collapse navbar-collapse col-sm-6" id="navbarResponsive">-->
        <!--        <ul class="navbar-nav justify-content-center">-->
        <!--            <li class="nav-item">-->
        <!--                <a class="nav-link" href="about.html"> 전체 </a>-->
        <!--            </li>-->
        <!--            <li class="nav-item">-->
        <!--                <a class="nav-link" href="about.html"> 신상품 </a>-->
        <!--            </li>-->
        <!---->
        <!--            <li class="nav-item">-->
        <!--                <a class="nav-link" href="about.html"> 인기 </a>-->
        <!--            </li>-->
        <!---->
        <!--            <li class="nav-item">-->
        <!--                <a class="nav-link" href="about.html"> 할인 </a>-->
        <!--            </li>-->
        <!--        </ul>-->
        <!--        </div>-->


        <ul class="navbar-nav">
            <?php
            if (isset($_SESSION['mem_id'])) {
                $nickname = $_SESSION['nickname'];

                echo "
                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        안녕하세요. {$nickname} 님</a>
                    <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"navbarDropdown\">
                      <a class=\"dropdown-item\" href=\"#\">주문 내역</a>
                      <a class=\"dropdown-item\" href=\"#\">관심 상품</a>
                      <a class=\"dropdown-item\" href=\"#\">내 정보 수정</a>
                      <a class=\"dropdown-item\" href=\"../member/sign_out.php\">로그아웃</a>
                    </div>
                </li>";

            } else {
                echo '<li class="nav-item"><a class="nav-link" href="../member/sign_up.php">회원가입</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="../member/sign_in.php">로그인</a></li>';
            }

            echo '<li class="nav-item"><a class="nav-link" href="../member/cart.html">장바구니</a></li>';
            echo '
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        고객센터
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../board/notice_page.php">공지사항</a>
                        <a class="dropdown-item" href="#">FAQ</a>
                        <a class="dropdown-item" href="#">1:1 문의</a>
                        <a class="dropdown-item" href="#">입고 요청</a>
                    </div>
              </li>';

            ?>

        </ul>
    </div>
</nav>
</body>
</html>
