<?php

?>


<!DOCTYPE html>
<html>
<body>
<div class="container">
    <ul class="nav nav-justified position-sticky" style="font-size: 16px; padding-bottom: 10px; padding-top: 10px">
        <li class="nav-item border-right">
            <a class="nav-link" href="#">
                <span style="color: #696969;">전체</span></a>
        </li>
        <li class="nav-item border-right">
            <a class="nav-link" href="#">
                <span style="color: #696969;">신상품</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span style="color: #696969; font-size: medium">인기</span></a>
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
            <form class="form-inline" action="../board/search_result.php">
                <input class="form-control" type="text" placeholder="검색어를 입력하세요." name="keyword"
                       style="font-size: 14px"/>
                <button class="btn btn-sm btn-outline-primary" type="submit" style="font-size: 14px; margin-left: 10px">
                    검색
                </button>
            </form>

        </li>
    </ul>
</div>
</body>
</html>