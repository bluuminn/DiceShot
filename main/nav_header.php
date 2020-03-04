<?php

session_start();

// db 연결
include("../main/db_connection.php");


if (isset($_COOKIE['auto_login_member_uuid'])) {
    $get_member_query = "select * from member where uuid='{$_COOKIE['auto_login_member_uuid']}'";
    $get_member_result = mysqli_query($connect, $get_member_query);
    $member = mysqli_fetch_assoc($get_member_result);

    $_SESSION['member_email'] = $member['email'];
    $_SESSION['nickname'] = $member['nickname'];
    $_SESSION['member_uuid'] = $member['uuid'];
}


$difficult_url = '../product/product_list.php?cate_no=101';
$num_of_person_url = '../product/product_list.php?cate_no=102';
$brand_url = '../product/product_list.php?cate_no=103';
$accessory_url = '../product/product_list.php?cate_no=104';
$new_arrival_url = '../product/product_list.php?cate_no=200';
$hot_url = '../product/product_list.php?cate_no=300';

?>


<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    Document Title
    =============================================
    -->
    <title>Dice Shot | Let's Play! 다이스 샷</title>
    <!--
    Favicons
    =============================================
    -->
    <link rel="apple-touch-icon" sizes="57x57" href="../images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicons/favicon-16x16.png">
    <link rel="manifest" href="../images/favicons/manifest.json">
    <!--    <meta name="msapplication-TileColor" content="#000000">-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../assets/images/favicons/ms-icon-144x144.png">
    <!--    <meta name="theme-color" content="#000000">-->
    <meta name="theme-color" content="#ffffff">
    <!--
    Stylesheets
    =============================================

    -->
    <!-- Default stylesheets-->
    <link href="../assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="../assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="../assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="../assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="../assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="../assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="../assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="../assets/css/colors/default.css" rel="stylesheet">
</head>

<!--<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60" class="pt-140">-->
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">

<main>

    <!--    <div class="page-loader">-->
    <!--        <div class="loader">Loading...</div>-->
    <!--    </div>-->

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span
                            class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="../main/index.php">
                    <img src="../images/diceshot/icon/logo/diceshot_logo_bk.png" alt="Dice Shot"
                         style="width: 180px; height: auto;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="custom-collapse">
                <ul class="nav navbar-nav navbar-right right">

                    <?php
                    if (isset($_SESSION['member_email'])) {
                        $nickname = $_SESSION['nickname'];

                        if ($_SESSION['member_email'] == 'adming') { ?>

                            <li class="dropdown">
                                <a class="dropdown-toggle" href="../mypage/orderlist.php" data-toggle="dropdown">
                                    manage
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="../management/product_management.php">상품 관리</a></li>
                                    <li><a href="../management/order_management.php">주문 관리</a></li>
                                    <li><a href="../management/member_management.php">회원 관리</a></li>
                                </ul>
                            </li>
                        <? } ?>

                        <li class="dropdown">
                            <a class="dropdown-toggle" href="../mypage/orderlist.php" data-toggle="dropdown">
                                <?php echo '안녕하세요 ' . $nickname; ?> 님
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="../mypage/orderlist.php">주문 내역</a></li>
                                <li><a href="../mypage/wishlist.php">관심 상품</a></li>
                                <li><a href="../mypage/modify_info.php">내 정보 수정</a></li>
                                <li><a href="../member/sign_out.php">로그아웃</a></li>
                            </ul>

                        </li>

                    <?php } else { ?>

                        <li class="navbar-cart-item"><a class="nav-link" href="../member/sign_up.php">회원가입</a></li>
                        <li class="navbar-cart-item"><a class="nav-link" href="../member/sign_in.php">로그인</a></li>

                    <?php } ?>

                    <li class="dropdown"><a class="dropdown-toggle" href="../board/cs_main.php?cs_no=1"
                                            data-toggle="dropdown">고객센터</a>
                        <ul class="dropdown-menu">
                            <li><a href="../board/cs_main.php?cs_no=1">공지사항</a></li>
                            <li><a href="../board/cs_main.php?cs_no=2">1:1 문의</a></li>
                            <li><a href="../board/cs_main.php?cs_no=3">입고 요청</a></li>
                        </ul>
                    </li>

                    <li class="navbar-cart-item"><a class="nav-link" href="../cart/checkout.php">장바구니</a></li>
                </ul>


                <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle" href="../product/product_list.php"
                                            data-toggle="dropdown">전체</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown"><a class="dropdown-toggle" href="<? echo $difficult_url ?>"
                                                    data-toggle="dropdown">난이도</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<? echo $difficult_url ?>&detail_code=1">초급</a>
                                    </li>
                                    <li><a href="<? echo $difficult_url ?>&detail_code=2">중급</a>
                                    </li>
                                    <li><a href="<? echo $difficult_url ?>&detail_code=3">고급</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="<? echo $num_of_person_url ?>"
                                                    data-toggle="dropdown">인원</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<? echo $num_of_person_url ?>&detail_code=1">2인 전용</a>
                                    </li>
                                    <li><a href="<? echo $num_of_person_url ?>&detail_code=2">2인 이상</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="<? echo $brand_url ?>"
                                                    data-toggle="dropdown">브랜드</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<? echo $brand_url ?>&detail_code=1">코리아보드게임즈</a></li>
                                    <li><a href="<? echo $brand_url ?>&detail_code=2">행복한바오밥</a></li>
                                    <li><a href="<? echo $brand_url ?>&detail_code=3">코드코드</a></li>
                                    <li><a href="<? echo $brand_url ?>&detail_code=4">보드엠팩토리</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="<? echo $accessory_url ?>"
                                                    data-toggle="dropdown">악세서리</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<? echo $accessory_url ?>&detail_code=1">카드 슬리브</a></li>
                                    <li><a href="<? echo $accessory_url ?>&detail_code=2">플레이 매트</a></li>
                                    <li><a href="<? echo $accessory_url ?>&detail_code=3">주사위</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="navbar-cart-item"><a class="nav-link" href="<? echo $new_arrival_url ?>">
                            신상품
                        </a>
                    </li>

                    <li class="navbar-cart-item"><a class="nav-link" href="<? echo $hot_url ?>">
                            인기
                        </a>
                    </li>


                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">검색</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-search">
                                <form role="form" action="../product/search_result.php">
                                    <input class="form-control" type="text" name="keyword" id="keyword"
                                           placeholder="검색어를 입력하세요...">
                                    <button class="search-btn" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</main>
</body>
</html>