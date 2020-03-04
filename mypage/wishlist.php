<?php


// header 연결
include("../main/nav_header.php");

if (isset($_SESSION['member_uuid'])) {

} else {

    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='../member/sign_in.php';</script>";

}
//$result = mysqli_query($connect, $query);
//if ($result) {
//    $total = mysqli_num_rows($result);
//}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>


<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 style="text-align: center; color: #111111">관심 상품</h2>
                <div class="module-subtitle">
                    관심 상품으로 등록한 목록입니다.
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <!-- Sidebar Column -->
            <div class="col-lg-2" style="max-width: 180px">
                <div class="list-group">
                    <a href="orderlist.php"
                       class="list-group-item">주문 내역</a>
                    <a href="wishlist.php" class="list-group-item active">
                        관심 상품
                    </a>
                    <a href="modify_info.php" class="list-group-item">
                        내 정보 수정
                    </a>
                </div>
            </div>

            <div class="col-lg-10">

                <?php

                if ($total > 0) {


                } else { ?>

                    <div class="module-subtitle pt-140" style="font-size: 25px">
                        등록된 관심 상품이 없습니다.
                    </div>
                <? } ?>



                <? if ($cs_no <= 1) {
                    if ($_SESSION['member_email'] == 'adming') { ?>

                        <a href="./create_post.php?cs_no=1">
                            <input class="btn btn-d btn-round" type="button" value="글쓰기"
                                   style="float: right; margin-top: 10px">
                        </a>

                    <? }
                } elseif ($cs_no <= 2) { ?>
                    <a href="./create_post.php?cs_no=2">
                        <input class="btn btn-d btn-round" type="button" value="글쓰기"
                               style="float: right; margin-top: 10px">
                    </a>
                <? } elseif ($cs_no <= 3) { ?>
                    <a href="./create_post.php?cs_no=3">
                        <input class="btn btn-d btn-round" type="button" value="글쓰기"
                               style="float: right; margin-top: 10px">
                    </a>

                <? } ?>


                <!--    <a class="btn btn-default pull-right">글작성</a>-->


<!--                페이지네이션-->
<!--                <div class="container">-->
<!--                    <div class="row">-->
<!--                        <div class="col-sm-offset-2">-->
<!--                            <ul class="pagination" style="margin-top: 140px">-->
<!--                                <li class="page-item"><a class="page-link" href="#">이전</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">4</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">5</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">6</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">7</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">8</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">9</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">10</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">다음</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->


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
