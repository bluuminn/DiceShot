<?php

// db 연결
include("../main/nav_header.php");

?>


<!DOCTYPE html>
<html lang="en">

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

<!-- Page Content -->
<div class="container">




    <!-- Content Row -->
    <div class="row">

        <!-- Sidebar Column -->
        <div class="col-lg-2">

            <!-- Page Heading/Breadcrumbs -->
            <h3 style="padding-top: 40px; padding-bottom: 40px"> 고객센터 </h3>

            <div class="list-group">
                <a href="#" class="list-group-item active">공지사항</a>
                <a href="#" class="list-group-item">FAQ</a>
                <a href="#" class="list-group-item">1:1 문의</a>
                <a href="#" class="list-group-item">입고 요청</a>
            </div>
        </div>

        <!-- Content Column -->
        <div class="col" style="text-align: center; margin-top: 40px;">
<!--        <div class="col-lg-10 mb-5" style="text-align: center">-->
            <h4 class="col">공지사항</h4>
            <small class="col">다이스샷의 새로운 소식들과 유용한 정보들을 한곳에서 확인하세요.</small>
            <br><br><br><br>

            <?php
            include("../board/notice_table.php");
            ?>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<?php
include("../main/footer.php");
?>

<!-- Bootstrap core JavaScript -->
<script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
